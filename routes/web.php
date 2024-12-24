<?php

use App\Http\Controllers\categorieController;
use App\Http\Controllers\CategorieController as ControllersCategorieController;
use App\Http\Controllers\CategotieController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerProductAttribute;
use App\Http\Controllers\ManajerGudangController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\SupplierController;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Route;

//view beginning
Route::get('/', function () {
    return redirect()->route('sign-in2'); // Redirect ke halaman sign-in
})->name('index');


Route::get('/dashboardAdmin', [Controller::class, 'dashboardAdmin'])->name('dashboard')->middleware('guest');

//authentucation
Route::get('authentication/sign-in', function () {
    return view('project.content.authentication.sign-in', ['title' => 'Sign In']);
})->name('sign-in2');

Route::get('authentication/sign-up', function () {
    return view('project.content.authentication.sing-up', ['title' => 'Sign Up']);
})->name('sign-up2');

//view data Product Admin
Route::get('layouts/data_produk', [Controller::class, 'getAllProduckAdmin'])
    ->name('layouts.admin.data_produk');
//getall categori tampilan
Route::get('layouts/data_categori', [CategotieController::class, 'getAllCategoriAdmin'])
    ->name('layouts.admin.data_categori');

//getall supplier tampilan
Route::get('data_supplier', [SupplierController::class, 'getAllSupplier'])
    ->name('layouts.admin.data_supplier');


//view tampilan tambah categori
Route::get('/tambah-categori', function () {
    return view('project.content.crud.tambah_categori', ['title' => 'tambah categori']); // Sesuaikan dengan lokasi file Blade
})->name('tambah-categori');

//view tampilan tambah supplier
Route::get('/tambah-supplier', function () {
    return view('project.content.crud.tambah_supplier', ['title' => 'tambah supplier']); // Sesuaikan dengan lokasi file Blade
})->name('tambah-supplier');

//view tampilan tambah pengguna
Route::get('/tambah-pengguna', function () {
    return view('project.content.crud.tambah_pengguna', ['title' => 'tambah pengguna']); // Sesuaikan dengan lokasi file Blade
})->name('tambah-pengguna');

//bagian admin riwayat transaksi
Route::get('/riwayatTransaksi', [Controller::class, 'riwayatTransaksi'])->name('riwayatTransaksi')->middleware('guest');
Route::get('/atributproduct', [Controller::class, 'atributproduct'])->name('atributproduct')->middleware('guest');
Route::get('/tambahatributProdcut', [ControllerProductAttribute::class, 'tambahatributProdcut'])->name('tambahatributProdcut')->middleware('guest');
Route::get('/stockOpname', [Controller::class, 'stockOpname'])->name('stockOpname')->middleware('guest');
Route::get('/pengaturanStock', [Controller::class, 'pengaturanStock'])->name('pengaturanStock')->middleware('guest');


Route::get('/edit_minimum_stock/{id}', [Controller::class, 'edit_minimum_stock'])->name('edit_minimum_stock');
Route::post('/product/{id}/update-minimum-stock', [Controller::class, 'updateMinimumStock'])->name('updateMinimumStock');
Route::get('/laporan_stock', [Controller::class, 'laporan_stock'])->name('laporan_stock')->middleware('guest');

// proses dalam web ini api 

Route::post('/proses_register', [\App\Http\Controllers\LoginController::class, 'register'])->name('register');
Route::post('/proses_login', [\App\Http\Controllers\LoginController::class, 'login'])->name('proses_login');

//Berikut LogOut
Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// Supplier
Route::get('/layouts/supplier', [SupplierController::class, 'getAllSupplier'])->name('getAllSupplier');
Route::post('/createSupplier', [SupplierController::class, 'createSupplier'])->name('createSupplier');
Route::delete('/deleteSupplierById/{id}', [SupplierController::class, 'deleteSupplierById'])->name('deleteSupplierById');
Route::get('/findSupplierById/{id}', [SupplierController::class, 'findSupplierById'])->name('findSupplierById');
Route::put('/updateSupplier/{id}', [SupplierController::class, 'updateSupplier'])->name('updateSupplier');
Route::get('/findUpdateSupplier/{id}', [SupplierController::class, 'findUpdateSupplier'])->name('findUpdateSupplier');

//Categori
Route::post('/createCategorie',[CategotieController::class, 'create'])->name('createCategorie');
Route::delete('/deleteCategorieById/{id}', [CategotieController::class, 'deleteCategorieById'])->name('deleteCategorieById');
Route::get('/getAllCategorie', [CategotieController::class, 'get'])->name('getAllCategorie');
Route::get('/findCategorieById/{id}', [CategotieController::class, 'findCategorieById'])->name('findCategorieById');
Route::put('/updateCategorie/{id}', [CategotieController::class, 'updateCategorie'])->name('updateCategorie');
Route::get('/findUpdateCategori/{id}', [CategotieController::class, 'findUpdateCategori'])->name('findUpdateCategori');

//Produck
Route::post('/createProduct',[Controller::class, 'createProduct'])->name('createProduct');
// Route::get('/products/{id}', [Controller::class, 'findProductById'])->name('findProductById');
Route::get('/products/{id}', [Controller::class, 'findProductById'])->name('data_product');
Route::put('/products/{id}', [Controller::class, 'updateProduct'])->name('updateProduct');
Route::get('/findUpdate/{id}', [Controller::class, 'findUpdate'])->name('findUpdate');
Route::delete('/products/{id}', [Controller::class, 'deleteProductById'])->name('deleteProductById');
Route::get('layouts/tambahData', [Controller::class, ]);
Route::get('/createGetProduct', [Controller::class, 'createGetProduct'])->name('createGetProduct');

Route::get('/layouts/lihat_produck', function () {
    return view('project.content.crud.lihat_produck', ['title' => 'Lihat Product']);
})->name('lihat_produck');

//pengguna getAllUser
Route::post('/createUser',[PenggunaController::class, 'createUser'])->name('createUser');
Route::get('/data_pengguna', [PenggunaController::class, 'getAllUser'])->name('getAllUser');
Route::get('/pengguna/{id}', [PenggunaController::class, 'findUserById'])->name('findUserById');
Route::put('/updateUser/{id}', [PenggunaController::class, 'updateUser'])->name('updateUser');
Route::get('/findUpdateUser/{id}', [PenggunaController::class, 'findUpdateUser'])->name('findUpdateUser');
Route::delete('/pengguna/{id}', [PenggunaController::class, 'deleteUserById'])->name('deleteUserById');




//manajer gudang 
Route::get('layouts/data_produk/manager_Gudang', [ManajerGudangController::class, 'getAllProduck'])
    ->name('data_produk');
Route::get('/products/manager/{id}', [ManajerGudangController::class, 'findProductManager'])->name('findProductManager');
Route::get('/layouts/supplier', [ManajerGudangController::class, 'getAllSupplier'])->name('getSupplierManager');
Route::get('/findCategorieById/manager/{id}', [ManajerGudangController::class, 'findSupplierById'])->name('findSupplierManager');

Route::get('/export-products', [Controller::class, 'exportProduct'])->name('export.products');

Route::get('/layouts/manager/transaksi', [ManajerGudangController::class, 'layoutTransaksi'])->name('layoutTransaksi'); 

// atribut ProductAttribute

Route::get('/atribut', [ControllerProductAttribute::class, 'getAllProductAttribute'])->name('getAllProductAttribute');
Route::post('/atribut', [ControllerProductAttribute::class, 'createProductAttribute'])->name('createProductAttribute');

//Stock Transaction
Route::post('/stock', [StockTransactionController::class, 'createStockTransaction'])->name('createStockTransaction');
Route::get('/stock', [StockTransactionController::class, 'getallStockTransaction'])->name('getallStockTransaction');
Route::get('/dashboardManager', [StockTransactionController::class, 'dashboardManager'])->name('dashboard_manager');


//staff
Route::get('/dashboardStaff', [StockTransactionController::class, 'dashboardStaff'])->name('dashboard_staff')->middleware('guest');
Route::get('/konfirmasiStock', [StockTransactionController::class, 'konfirmasiStock'])->name('layouts.staff.konfirmasi_stok')->middleware('guest');
Route::post('/confirmTransaction/{id}', [StockTransactionController::class, 'confirmTransaction'])->name('confirmTransaction');