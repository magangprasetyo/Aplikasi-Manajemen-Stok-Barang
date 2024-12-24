<?php

namespace App\Repositories\ProductAttribute;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ProductAttribute;

class ProductAttributeRepositoryImplement extends Eloquent implements ProductAttributeRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ProductAttribute $model)
    {
        $this->model = $model;
    }

    public function getAllProductAttribute()
    {
        return $this->model->all(); // Mengambil semua data dari tabel
    }

    public function createProductAttribute(array $data)
    {
        return $this->model->create($data);
    }
}
