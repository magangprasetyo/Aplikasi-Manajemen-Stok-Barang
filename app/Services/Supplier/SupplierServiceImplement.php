<?php

namespace App\Services\Supplier;

use LaravelEasyRepository\Service;
use App\Repositories\Supplier\SupplierRepository;

class SupplierServiceImplement extends Service implements SupplierService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(SupplierRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAllSupplier()
    {
        return $this->mainRepository->getAllSupplier();
    }

    public function createSupplier(array $data)
    {
        return $this->mainRepository->createSupplier($data);
        
    }

    public function deleteSupplierById($id)
    {
        return $this->mainRepository->deleteSupplierById($id);
    }

    public function findSupplierById($id)
    {
        return $this->mainRepository->findSupplierById($id);
    }

    public function updateSupplier($id, array $data)
    {
        return $this->mainRepository->update($id, $data);
    }
}
