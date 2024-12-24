<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository{

    /**
     * Create User
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data);

    public function getAllUser();

    public function findUserById($id);

    public function updateUser($id, array $data);

    public function deleteUserById($id);

    /**
     * attempt login
     * @param array $credentials
     * @return mixed
     */
    public function attemptLogin(array $credentials);

    public function getAuthenticatedUser();

    public function createProduct(array $data);

    public function getAllProduck();

    public function countProduk();

    
}
