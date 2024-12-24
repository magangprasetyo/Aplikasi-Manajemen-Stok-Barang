<?php

namespace App\Repositories\StockTransaction;

use LaravelEasyRepository\Repository;

interface StockTransactionRepository extends Repository{

    // Write something awesome :)

    public function createStockTransaction(array $data);
    
    public function getallStockTransaction();
}
