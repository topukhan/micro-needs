<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();
        $limit = 200;
        $sortBy = 'price';
        $order = 'desc';
        $response = Http::get('https://dummyjson.com/products?limit='.$limit.'&sortBy='.$sortBy.'&order='.$order);
        $apiProducts = $response->json();
        $products = $apiProducts['products'] ?? [];

        $time = now();
        $productData = [];

        foreach ($products as $product) {
            if (count($productData) >= $limit) {
                break;
            }

            $productData[] = [
                'name' => $product['title'] ?? 'No name',
                'barcode' => $this->generateUniqueBarcode(),
                'thumbnail' => $product['thumbnail'] ?? null,
                'images' => json_encode($product['images'] ?? []),
                'category' => $product['category'] ?? null,
                'brand' => $product['brand'] ?? null,
                'warrantyInformation' => $product['warrantyInformation'] ?? null,
                'availabilityStatus' => $product['availabilityStatus'] ?? null,
                'rating' => $product['rating'] ?? 0,
                'tags' => json_encode($product['tags'] ?? []),
                'price' => $product['price'] ?? 0,
                'description' => $product['description'] ?? '',
                'quantity' => $product['stock'] ?? 0,
                'created_at' => $time,
                'updated_at' => $time,
            ];
        }

        // Insert all products in a single query
        Product::insert($productData);
    }

    private function generateUniqueBarcode()
    {
        return mt_rand(10000000, 99999999);
    }
}
