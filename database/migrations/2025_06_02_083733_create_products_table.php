<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('barcode')->unique()->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('warrantyInformation')->nullable();
            $table->string('availabilityStatus')->nullable();
            $table->decimal('rating')->default('0');
            $table->json('tags')->nullable();
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
