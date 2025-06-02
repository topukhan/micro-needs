<?php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of products
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('product.index', compact('products'));
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
            'quantity' => 'required|integer|min:0'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    // Display the specified product
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
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
            'quantity' => 'required|integer|min:0'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    // Remove the specified product
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}