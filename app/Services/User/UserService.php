<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function createUser(array $data);

    public function getAllUser();

    public function findUserById($id);

    public function updateUser($id, array $data);

    public function deleteUserById($id);

    public function validateAndLogin(array $credentials);

    public function createProduct(array $data);

    public function getAllProduck();

    public function countProduk();

}