<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Product::truncate(); // Clear existing products before import

        $apiUrl = 'http://admin.shop.packly.com/api/v1/ecommerce/shop/products';
        $perPage = 100; // Try 100 as requested
        $page = 1;

        // Fetch first page to get total
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-App-Version' => '1.0.0',
            'X-Build-Number' => '1.0.0',
            'X-Platform' => 'web'
        ])->get($apiUrl, ['page' => $page, 'per_page' => $perPage]);

        if (!$response->successful()) {
            $this->error('Failed to fetch first page: ' . $response->status() . ' - ' . $response->body());
            return 1;
        }

        $data = $response->json();
        $total = $data['total'] ?? 0;
        $totalPages = ceil($total / $perPage);

        if ($total == 0) {
            $this->info('No products to import.');
            return 0;
        }

        $this->info("Starting import of {$total} products across {$totalPages} pages.");

        $progressBar = $this->output->createProgressBar($totalPages);
        $progressBar->start();

        do {
            $products = collect($data['data'] ?? [])->map(function ($item) {
                return [
                    'name' => $item['name'],
                    'barcode' => null, // Not storing barcode to avoid duplicates
                    'thumbnail' => $item['thumbnail'],
                    'category' => $item['category']['name'] ?? null,
                    'brand' => $item['brand_name'],
                    'rating' => $item['rating_avg'],
                    'price' => $item['discount_price'] ?: $item['regular_price'],
                    'description' => null,
                    'quantity' => $item['available_stock'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            if (!empty($products)) {
                Product::insert($products);
            }

            $progressBar->advance();

            $page++;
            if ($page > $totalPages)
                break;

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-App-Version' => '1.0.0',
                'X-Build-Number' => '1.0.0',
                'X-Platform' => 'web',
            ])->get($apiUrl, ['page' => $page, 'per_page' => $perPage]);
            if (!$response->successful()) {
                $this->error("Failed to fetch page {$page}: " . $response->status() . ' - ' . $response->body());
                $progressBar->finish();
                return 1;
            }
            $data = $response->json();

        } while (!empty($data['data'] ?? []));

        $progressBar->finish();
        $this->info("\nImport completed successfully.");
        return 0;
    }
}
