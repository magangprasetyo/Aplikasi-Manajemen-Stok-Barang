<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory; 

    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'date',
        'status',
        'notes',
    ];
        // Relasi ke tabel Product
        public function product()
        {
            return $this->belongsTo(Product::class, 'product_id');
        }
    
        // Relasi ke tabel User
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
}
