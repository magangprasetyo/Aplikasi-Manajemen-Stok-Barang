<?php

namespace App\Services\ProductAttribute;

use LaravelEasyRepository\BaseService;

interface ProductAttributeService extends BaseService{

    public function getAllProductAttribute();

    public function createProductAttribute(array $data);
    
}
