<?php

namespace App\Repositories\Categorie;

use LaravelEasyRepository\Repository;

interface CategorieRepository extends Repository{

    public function getAllCategorie();

    public function createCategorie(array $data);

    public function deleteCategorieById($id);

    public function updateCategorie($id, array $data);

    public function findCategorieById($id);
}
