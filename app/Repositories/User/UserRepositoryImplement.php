<?php

namespace App\Repositories\User;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    protected $supplier;

    protected $product;

    public function __construct(User $model, Supplier $supplier, Product $product)
    {
        $this->model = $model;
        $this->supplier = $supplier;
        $this->product = $product;
    }

    // Write something awesome :)

    /**
     * @inheritDoc
     */
    public function createUser(array $data)
    {
        return $this->model->create($data);
    }

    public function getAllUser()
    {
        return $this->model->all();
    }

    public function findUserById($id)
    {
        return $this->model->find($id);
    }

    public function updateUser($id, array $data)
    {
        $user = $this->findUserById($id);
        $user->update($data);
        return $user;
    }

    public function deleteUserById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * function
     * @param array $credentials
     * @return bool
     */
    public function attemptLogin(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    // Mendapatkan pengguna yang sedang login
    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function createProduct(array $data)
    {
        return $this->product->create($data);
    }

    public function getAllProduck()
    {
        return $this->product->all();
    }

    public function countProduk()
    {
        return product::count();
    }
}
