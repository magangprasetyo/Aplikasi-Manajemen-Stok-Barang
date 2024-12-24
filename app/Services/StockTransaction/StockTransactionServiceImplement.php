<?php

namespace App\Services\StockTransaction;

use LaravelEasyRepository\Service;
use App\Repositories\StockTransaction\StockTransactionRepository;

class StockTransactionServiceImplement extends Service implements StockTransactionService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(StockTransactionRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)

    public function createStockTransaction(array $data)
    {
      $data['user_id'] = auth()->user()->id; // Ambil user_id dari auth
          // Tentukan status berdasarkan type
      $data['status'] = $data['type'] === 'masuk' ? 'pending' : 'pending';
    // Jika type keluar, periksa apakah quantity tidak melebihi stok yang masuk sebelumnya
      return $this->mainRepository->createStockTransaction($data);
    }

    public function getallStockTransaction()
    {
      return $this->mainRepository->getallStockTransaction();
    }
}
