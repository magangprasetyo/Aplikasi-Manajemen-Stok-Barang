<?php

namespace App\Repositories\ProductAttribute;

use LaravelEasyRepository\Repository;

interface ProductAttributeRepository extends Repository{

    public function getAllProductAttribute();

    public function createProductAttribute(array $data);
    
}
