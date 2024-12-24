<?php

namespace App\Services\Product;

use LaravelEasyRepository\BaseService;

interface ProductService extends BaseService{

    public function findProductById($id);

    public function updateProduct($id, array $data);

    public function deleteProductById($id);

    public function getAllExport();
}
