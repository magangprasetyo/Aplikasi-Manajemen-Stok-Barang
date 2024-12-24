<?php

namespace App\Services\Categorie;

use LaravelEasyRepository\Service;
use App\Repositories\Categorie\CategorieRepository;

class CategorieServiceImplement extends Service implements CategorieService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CategorieRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function getAll()
    {
      return $this->mainRepository->getAllCategorie();
    }

    public function createCategorie(array $data)
    {
      return $this->mainRepository->createCategorie($data);
    }

    public function deleteCategorieById($id)
    {
      return $this->mainRepository->deleteCategorieById($id);
    }

    public function findCategorieById($id)
    {
      return $this->mainRepository->findCategorieById($id);
    }

    public function updateCategorie($id, array $data)
    {
      return $this->mainRepository->update($id, $data);
    }
}
