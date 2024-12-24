<?php

namespace App\Http\Controllers;

use App\Services\Supplier\SupplierService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function getAllSupplier()
    {
        $suppliers = $this->supplierService->getAllSupplier(); // Ambil semua supplier
        // return response()->json($suppliers);
        return view('project.content.layouts.admin.data_supplier', compact('suppliers'), ['title' => 'Supplier']);
    }

    public function createSupplier(Request $request)
    {
        $this->supplierService->createSupplier($request->all());
        return redirect()->route('layouts.admin.data_supplier')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function deleteSupplierById($id)
    {
        $deleted = $this->supplierService->deleteSupplierById($id);

        if ($deleted) {
            return redirect()->route('layouts.admin.data_supplier')->with('success', 'Supplier berhasil dihapus.');
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    public function findSupplierById($id)
    {
        $findSupplierById = $this->supplierService->findSupplierById($id);

        if (!$findSupplierById) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // return response()->json($findSupplierById);
        return view('project.content.crud.lihat_supplier', compact('findSupplierById'), ['title' => 'Lihat Supplier']);
    }

    public function updateSupplier(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'address',
            'phone',
            'email'
        ]);

        try {
            $this->supplierService->updateSupplier($id, $data);
            return redirect()->route('layouts.admin.data_supplier')->with('success', 'Suppplier berhasil diubah');
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function findUpdateSupplier($id)
    {
        $findUpdateSupplier = $this->supplierService->findSupplierById($id);

        if (!$findUpdateSupplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // return response()->json($productService);
        return view('project.content.crud.edit_supplier', compact('findUpdateSupplier'), ['title' => 'Edit Categori']);
    }


}
