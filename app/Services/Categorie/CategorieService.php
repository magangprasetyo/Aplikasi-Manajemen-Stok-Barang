<?php

namespace App\Services\Categorie;

use LaravelEasyRepository\BaseService;

interface CategorieService extends BaseService{

    public function getAll();

    public function createCategorie(array $data);

    public function deleteCategorieById($id);

    public function findCategorieById($id);

    //fungsi mengupdate Categorie
    public function updateCategorie($id, array $data);
}
