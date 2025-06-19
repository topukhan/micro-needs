<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Filters\Product\CategoryFilter;
use App\Filters\Product\SearchFilter;
use App\Filters\Product\SortFilter;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductController extends Controller
{
    // Display a listing of products
    public function index(Request $request)
    {
        $cacheKey = 'products_'.md5(json_encode($request->all()));
        $fromCache = Cache::has($cacheKey);
        $products = Cache::remember($cacheKey, now()->addMinutes(60), function () {
            $fromCache = false;

            return app(Pipeline::class)
                ->send(Product::query())
                ->through([
                    SearchFilter::class,
                    CategoryFilter::class,
                    SortFilter::class,
                ])
                ->thenReturn()
                ->orderBy('id', 'desc')
                ->paginate(10);
        });

        // Handle AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('product.partials.product-list', compact('products'))->render(),
                'pagination' => $products->appends($request->all())->links()->render(),
                'total' => $products->total(),
                'from_cache' => $fromCache,
                'search_summary' => $this->getSearchSummary($request, $products->total()),
            ]);
        }

        return view('product.index', compact('products', 'fromCache'));
    }

    private function getSearchSummary(Request $request, $total)
    {
        $summary = '';

        if ($request->filled('search')) {
            $summary .= 'Searching for "<strong>'.e($request->search).'</strong>"';
        }

        if ($request->filled('category')) {
            $summary .= ($summary ? ' ' : '').'in category "<strong>'.
                       ucfirst(str_replace('-', ' ', $request->category)).'</strong>"';
        }

        if ($request->filled('sort')) {
            $summary .= ($summary ? ' ' : '').'sorted by "<strong>'.
                       ucfirst(str_replace('_', ' ', $request->sort)).'</strong>"';
        }

        $summary .= ($summary ? ' - ' : '').$total.' result(s) found';

        return $summary;
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('product.create');
    }

    // Store a newly created product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $barcode = $this->generateUniqueBarcode();

        Product::create(array_merge($request->all(), ['barcode' => $barcode]));
        Cache::forget('products_*');
        Cache::flush();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    private function generateUniqueBarcode()
    {
        do {
            $barcode = mt_rand(100000000000, 999999999999);
        } while (Product::where('barcode', $barcode)->exists());

        return $barcode;
    }

    private function updateBarcode(Product $product)
    {
        if ($product->barcode === null) {
            $product->barcode = $this->generateUniqueBarcode();
            $product->save();
        }

        return $product->barcode;
    }

    public function show(Product $product)
    {
        if (! $product) {
            return to_route('products.index')->with('error', 'Product not found');
        }

        $product->barcode ?: $this->updateBarcode($product);

        $barcodeImage = $this->generateBarcodeImage($product);

        return view('product.show', compact('product', 'barcodeImage'));
    }

    public function generateBarcodeImage(Product $product)
    {
        try {
            // Check GD extension
            if (! extension_loaded('gd') || ! function_exists('imagecreatefromstring')) {
                throw new \RuntimeException('GD extension not available');
            }

            // Check barcode generator
            if (! class_exists(\Picqer\Barcode\BarcodeGeneratorPNG::class)) {
                throw new \RuntimeException('Barcode generator package not installed');
            }

            // Validate barcode
            if (empty($product->barcode) || ! preg_match('/^[0-9]+$/', $product->barcode)) {
                throw new \InvalidArgumentException('Invalid barcode format');
            }

            $generator = new BarcodeGeneratorPNG;
            $barcodeData = $generator->getBarcode($product->barcode, $generator::TYPE_CODE_128);

            if (empty($barcodeData)) {
                throw new \RuntimeException('Barcode generation failed');
            }

            $barcodeImage = imagecreatefromstring($barcodeData);
            if ($barcodeImage === false) {
                throw new \RuntimeException('Failed to create image from barcode data');
            }

            $width = imagesx($barcodeImage);
            $height = imagesy($barcodeImage);
            $extraHeight = 20;
            $finalImage = imagecreatetruecolor($width, $height + $extraHeight);

            if ($finalImage === false) {
                throw new \RuntimeException('Failed to create final image');
            }

            $white = imagecolorallocate($finalImage, 255, 255, 255);
            imagefill($finalImage, 0, 0, $white);
            imagecopy($finalImage, $barcodeImage, 0, 0, 0, 0, $width, $height);

            $color = imagecolorallocate($finalImage, 0, 0, 0);
            $font = 3;
            $text = implode(' ', str_split($product->barcode));
            $charWidth = imagefontwidth($font);
            $textWidth = $charWidth * strlen($text);
            $x = ($width - $textWidth) / 2;
            $y = $height + 2;

            imagestring($finalImage, $font, $x, $y, $text, $color);

            ob_start();
            $success = imagepng($finalImage);
            $imageData = ob_get_clean();

            if (! $success || empty($imageData)) {
                throw new \RuntimeException('Failed to generate PNG image');
            }

            return base64_encode($imageData);
        } catch (\Exception $e) {
            Log::error('Barcode generation failed: '.$e->getMessage());

            return false;
        }
    }

    // Show the form for editing the product
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    // Update the specified product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $product->update($request->all());
        Cache::forget('products_*'); // wildcard not work in file or db driver for cache when forget
        Cache::flush();

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    // Remove the specified product
    public function destroy(Product $product)
    {
        $product->delete();
        Cache::forget('products_*'); // wildcard not work in file or db driver for cache when forget
        Cache::flush();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
