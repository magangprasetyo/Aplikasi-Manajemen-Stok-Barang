<?php

namespace App\Services\StockTransaction;

use LaravelEasyRepository\BaseService;

interface StockTransactionService extends BaseService{

    // Write something awesome :)

    public function createStockTransaction(array $data);

    public function getallStockTransaction();
    
}
