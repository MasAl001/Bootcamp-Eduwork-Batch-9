<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'stock',
        'price',
        'product_category_id',
    ];
    
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
