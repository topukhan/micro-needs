<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'price',
        'description',
        'quantity',
        'barcode',
    ];

    public function toSearchableArray()
    {
        return array_merge($this->toArray(), [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'category' => (string) $this->category,
            'brand' => (string) $this->brand,
            'description' => (string) $this->description,
            'created_at' => $this->created_at->timestamp,
        ]);
    }
}
