<?php

namespace App\Services\ProductAttribute;

use LaravelEasyRepository\Service;
use App\Repositories\ProductAttribute\ProductAttributeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductAttributeServiceImplement extends Service implements ProductAttributeService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProductAttributeRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllProductAttribute()
    {
        return $this->mainRepository->getAllProductAttribute();
    }

    public function createProductAttribute(array $data)
    {
        // Validasi input
        $validator = Validator::make($data, [
            'product_id' => [
                'required',
                'exists:products,id', // Pastikan product_id ada di tabel products
                function ($attribute, $value, $fail) {
                    // Periksa apakah product_id sudah ada di tabel atribut produk
                    if (DB::table('product_attributes')->where('product_id', $value)->exists()) {
                        $fail('Product ID sudah memiliki atribut. Hanya satu atribut yang diperbolehkan untuk setiap produk.');
                    }
                },
            ],
        ]);
    
        // Jika validasi gagal, redirect dengan pesan error
        if ($validator->fails()) {
          return redirect()
              ->route('tambahatributProdcut') // Ganti dengan nama route view tambah atribut
              ->withErrors($validator) // Kirim error validasi
              ->withInput(); // Kirim data input yang sebelumnya dimasukkan
      }
    
        // Buat atribut produk menggunakan repository
        return $this->mainRepository->createProductAttribute($data);
    }
    
}
