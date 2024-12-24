<?php

namespace App\Repositories\Categorie;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Categorie;

class CategorieRepositoryImplement extends Eloquent implements CategorieRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Categorie $model)
    {
        $this->model = $model;
    }

    public function getAllCategorie()
    {
        return $this->model->all();
    }

    public function createCategorie(array $data)
    {
        return $this->model->create($data);
    }

    public function deleteCategorieById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function updateCategorie($id, array $data)
    {
        $categorie = $this->findCategorieById($id);
        $categorie->update($data);
        return $categorie;
    }

    public function findCategorieById($id)
    {
        return $this->model->find($id);
    }
}
