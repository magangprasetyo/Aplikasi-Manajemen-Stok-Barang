<?php

namespace App\Services\Supplier;

use LaravelEasyRepository\BaseService;

interface SupplierService extends BaseService{

    // fungsi melihat Supplier semua
    public function getAllSupplier();

    // fungsi menambahkan Supplier 
    public function createSupplier(array $data);

    // fungsi menghapus createSupplier
    public function deleteSupplierById($id);

    //fungsi menampilkan bedasarkan id
    public function findSupplierById($id);

    //fungsi mengupdate Supplier
    public function updateSupplier($id, array $data);
}
