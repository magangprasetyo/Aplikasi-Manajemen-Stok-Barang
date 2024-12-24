<?php

namespace App\Repositories\Supplier;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Supplier;

class SupplierRepositoryImplement extends Eloquent implements SupplierRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }

    public function getAllSupplier()
    {
        return $this->model->all();
    }

    public function createSupplier(array $data)
    {
        return $this->model->create($data);
    }

    public function deleteSupplierById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function findSupplierById($id)
    {
        return $this->model->find($id);
    }

    public function updateSupplier($id, array $data)
    {
        $product = $this->findSupplierById($id);
        $product->update($data);
        return $product;
    }

}
