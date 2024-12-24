<?php

namespace App\Repositories\Supplier;

use LaravelEasyRepository\Repository;

interface SupplierRepository extends Repository{

    // fungsi lihat semua supplier
    public function getAllSupplier();

    // fungsi nambah supplier 
    public function createSupplier(array $data);

    // fungsi menghapus supplier
    public function deleteSupplierById($id);

    // fungsi mengedit supplier
    public function updateSupplier($id, array $data);

    //fungsi melihat bedasarkan id
    public function findSupplierById($id);
}
