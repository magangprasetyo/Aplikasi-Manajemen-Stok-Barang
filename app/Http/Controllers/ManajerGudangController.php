<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Supplier;
use App\Models\User;
use App\Services\Product\ProductService;
use App\Services\Supplier\SupplierService;
use App\Services\User\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ManajerGudangController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    private $userService;
    private $productService;
    private $supplierService;
    
    public function __construct(UserService $userService, ProductService $productService, SupplierService $supplierService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
        $this->supplierService = $supplierService;
    }
    public function getAllProduck()
    {
        $produck = $this->userService->getAllProduck();

        $category = Categorie::all();
        $suppliers = Supplier::all();

                        // // Mengembalikan data dalam format JSON
                        // return response()->json([
                        //     'status' => 'success',
                        //     'data' => $produck,
                        //     'title' => 'Product'
                        // ]);
        return view('project.content.layouts.manager.produk', compact('produck', 'category', 'suppliers'), ['title' => 'Data Product']);
    }

    public function findProductManager($id)
    {
        $product = $this->productService->findProductById($id);
        $ProductAttribute = ProductAttribute::where('product_id', $product->id)->get();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // return response()->json($productService);
        return view('project.content.crud.manager.lihat_product', compact('product', 'ProductAttribute'), ['title' => 'Product']);
    }

    public function getAllSupplier()
    {
        $suppliers = $this->supplierService->getAllSupplier(); // Ambil semua supplier
        // return response()->json($suppliers);
        return view('project.content.layouts.manager.supplier', compact('suppliers'), ['title' => 'Supplier']);
    }
    public function findSupplierById($id)
    {
        $findSupplierById = $this->supplierService->findSupplierById($id);

        if (!$findSupplierById) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        // return response()->json($findSupplierById);
        return view('project.content.crud.manager.lihat_supplier', compact('findSupplierById'), ['title' => 'Supplier']);
    }

    public function layoutTransaksi()
    {
        // Ambil data dari database jika perlu
        $products = Product::all();
        $users = User::all();

        // Mengarahkan ke halaman transaksi dengan data
        return view('project.content.layouts.manager.transaksi', [
            'products' => $products,
            'users' => $users,
            'title' => 'Transaksi Barang Masuk/Keluar'
        ]);
    }
}
