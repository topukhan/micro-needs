<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $limit = 50;
        $sortBy = 'price';
        $order = 'desc';
        $response = Http::get('https://dummyjson.com/products?limit=' . $limit.'&sortBy=' . $sortBy .'&order=' . $order);
        $apiProducts = $response->json();
        $products = $apiProducts['products'] ?? [];

         $createdCount = 0;
         $time = now();

         foreach ($products as $product) {
            if ($createdCount >= $limit) {
                break;
            }
            $images = json_encode($product['images'] ?? []);
            $tags = json_encode($product['tags'] ?? []);
            // dd($images, $tags, gettype($images));
            Product::create([
                'name' => $product['title'] ?? 'No name',
                'barcode' => $this->generateUniqueBarcode(),
                'thumbnail' => $product['thumbnail'] ?? null,
                'images' => $images ?? null,
                'category' => $product['category'] ?? null,
                'brand' => $product['brand'] ?? null,
                'warrantyInformation' => $product['warrantyInformation'] ?? null,
                'availabilityStatus' => $product['availabilityStatus'] ?? null,
                'rating' => $product['rating'] ?? 0,
                'tags' => $tags ?? null,
                'price' => $product['price'] ?? 0,
                'description' => $product['description'] ?? '',
                'quantity' => $product['stock'] ?? 0,
                'created_at' => $time,
                'updated_at' => $time,
            ]);
            
            $createdCount++;
        }

    }

    private function generateUniqueBarcode()
    {
        return mt_rand(100000000000, 999999999999);
    }
}
