<?php

namespace App\Services\Product;

use App\Exports\ProductExport;
use LaravelEasyRepository\Service;
use App\Repositories\Product\ProductRepository;
use Maatwebsite\Excel\Facades\Excel;

class ProductServiceImplement extends Service implements ProductService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(ProductRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function findProductById($id)
    {
        return $this->mainRepository->findProductById($id);
    }

    public function updateProduct($id, array $data)
    {
        return $this->mainRepository->update($id, $data);
    }

    public function deleteProductById($id)
    {
        return $this->mainRepository->deleteProductById($id);
    }

    public function getAllExport()
    {
        // Mendapatkan data produk dari repository
        $products = $this->mainRepository->getAllExport();

        // Menggunakan ProductExport untuk menghasilkan file Excel
        return Excel::download(new ProductExport($products), 'products.xlsx');
    }
    
    
}
