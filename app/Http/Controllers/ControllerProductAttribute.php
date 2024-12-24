<?php

namespace App\Http\Controllers;

use App\Models\ProductAttribute;
use App\Services\ProductAttribute\ProductAttributeService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ControllerProductAttribute extends Controller
{
    private $productattributeService;
    private $userService;
    

    public function __construct(UserService $userService, ProductAttributeService $productattributeService)
    {
        $this->productattributeService = $productattributeService;
        $this->userService = $userService;
    }


    public function getAllProductAttribute()
    {
        $productAttribute = $this->productattributeService->getAllProductAttribute(); // Pastikan nama method sesuai
        return response()->json($productAttribute);
    }  
    
    public function createProductAttribute(Request $request)
    {
        try {
            // Panggil service untuk membuat atribut produk
            $productAttribute = $this->productattributeService->createProductAttribute($request->all());
    
            // Response JSON jika berhasil
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Produk berhasil ditambahkan.',
            //     'data'    => $productAttribute,
            // ], 201); // Status 201 Created

                    // Redirect ke view tertentu jika berhasil
        return redirect()->route('atributproduct')->with([
            'success' => 'Produk berhasil ditambahkan.',
        ]);
    
        } catch (ValidationException $e) {
            // Response JSON jika validasi gagal
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $e->errors(), // Detail error validasi
            ], 422); // Status 422 Unprocessable Entity
    
        } catch (\Exception $e) {
            // Response JSON jika ada error lain
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan produk.',
                'error'   => $e->getMessage(), // Opsional, bisa dihapus di production
            ], 500); // Status 500 Internal Server Error
        }
    }

    public function tambahatributProdcut()
    {

        $produck = $this->userService->getAllProduck();

        return view('project.content.crud.tambah_atribut', [
            'produck' => $produck,
            'title' => 'Tambah AtributProduct'
        ]);
    }
    
}
