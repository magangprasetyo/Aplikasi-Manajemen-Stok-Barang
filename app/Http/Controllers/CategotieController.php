<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class CategotieController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    private $categotieService;

    public function __construct(Categorie $categotieService)
    {
        $this->categotieService = $categotieService;
    }

    public function get()
    {
        $suppliers = $this->categotieService->getAll(); // Ambil semua supplier
        return response()->json($suppliers);
    }

    public function create(Request $request)
    {
        $this->categotieService->createCategorie($request->all());
        return redirect()->route('layouts.admin.data_categori')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function deleteCategorieById($id)
    {
        $deleted = $this->categotieService->deleteCategorieById($id);

        if ($deleted) {
            return redirect()->route('layouts.admin.data_categori')->with('success', 'Produk berhasil dihapus.');
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    public function findCategorieById($id)
    {
        $findCategorieById = $this->categotieService->findCategorieById($id);

        if (!$findCategorieById) {
            return response()->json(['message' => 'Categori not found'], 404);
        }

        // return response()->json($findCategorieById);
        return view('project.content.crud.lihat_categori', compact('findCategorieById'), ['title' => 'Edit Categori']);
    }

    public function updateCategorie(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'description'
        ]);

        try {
            $supplier = $this->categotieService->updateCategorie($id, $data);
            return redirect()->route('layouts.admin.data_categori')->with('success', 'Produk berhasil diubah');
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Categorie not found'], 404);
        }
    }

    public function findUpdateCategori($id)
    {
        $findCategorieById = $this->categotieService->findCategorieById($id);

        if (!$findCategorieById) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // return response()->json($productService);
        return view('project.content.crud.edit_categori', compact('findCategorieById'), ['title' => 'Edit Categori']);
    }

    public function getAllCategoriAdmin()
    {
        $categori = $this->categotieService->getAll();
        return view('project.content.layouts.admin.data_kategori', compact('categori'), ['title' => 'Data Categori']);
    }
}
