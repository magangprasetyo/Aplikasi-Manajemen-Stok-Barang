<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Repository;

interface ProductRepository extends Repository{

    public function findProductById($id);

    public function updateProduct($id, array $data);

    public function deleteProductById($id);

    public function getAllProducts();

    public function getAllExport();
}
