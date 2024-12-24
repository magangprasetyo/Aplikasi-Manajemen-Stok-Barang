<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'description',
        'purchase_price',
        'selling_price',
        'image',
        'minimum_stock',
    ];

    // app/Models/Item.php
    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function ProductAttribute()
    {
        return $this->hasOne(ProductAttribute::class, 'productattribute_id', 'id'); 
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class, 'product_id');
    }

}
