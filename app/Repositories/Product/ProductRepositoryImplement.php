<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Product;

class ProductRepositoryImplement extends Eloquent implements ProductRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function findProductById($id)
    {
        return Product::find($id);
    }


    public function updateProduct($id, array $data)
    {
        $product = $this->findProductById($id);
        $product->update($data);
        return $product;
    }

    public function deleteProductById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getAllProducts()
    {
        // Ambil semua data produk dari database
        return Product::all();
    }

    public function getAllExport()
    {
        return Product::all();
    }

}
