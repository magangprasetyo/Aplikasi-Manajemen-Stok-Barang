<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Supplier;
use App\Services\Product\ProductService;
use App\Services\ProductAttribute\ProductAttributeService;
use App\Services\StockTransaction\StockTransactionService;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private $userService;
    private $productService;
    private $stocktransactionService;
    private $productattributeService;
    
    public function __construct(UserService $userService, ProductService $productService, StockTransactionService $stocktransactionService,  ProductAttributeService $productattributeService)
    {
        $this->userService = $userService;
        $this->productService = $productService;
        $this->stocktransactionService = $stocktransactionService;
        $this->productattributeService = $productattributeService;
    }

    public function riwayatTransaksi()
    {
        // Ambil semua transaksi stok
        $allStockTransactions = $this->stocktransactionService->getallStockTransaction();
    
        // Filter hanya data dengan status tertentu
        $filteredTransactions = $allStockTransactions->filter(function ($transaction) {
            return ($transaction->type === 'masuk' && $transaction->status === 'diterima') ||
                   ($transaction->type === 'keluar' && $transaction->status === 'dikeluarkan');
        });
    
        // Kirimkan hasil filter ke view
        return view('project.content.layouts.admin.riwayat_transaksi', [
            'filteredTransactions' => $filteredTransactions->values(), // Reset keys
            'title' => 'Riwayat Transaksi'
        ]);
    }

    public function atributproduct()
    {
        $productAttribute = $this->productattributeService->getAllProductAttribute();

        return view('project.content.crud.tambah_atributproduct', [
            'productAttribute' => $productAttribute,
            'title' => 'Atribut Product'
        ]);
    }

    public function stockOpname()
    {
        // Mengambil semua transaksi stok
        $allStockTransactions = $this->stocktransactionService->getallStockTransaction();

        // Filter untuk memastikan hanya satu transaksi per product_id
        $uniqueTransactions = $allStockTransactions->unique('product_id');

        // Proses perhitungan quantity berdasarkan type
        $calculatedTransactions = $uniqueTransactions->map(function ($transaction) use ($allStockTransactions) {
            // Ambil semua transaksi dengan product_id yang sama
            $productTransactions = $allStockTransactions->where('product_id', $transaction->product_id);

            // Hitung total quantity berdasarkan type
            $totalMasuk = $productTransactions->where('type', 'masuk')->sum('quantity');
            $totalKeluar = $productTransactions->where('type', 'keluar')->sum('quantity');

            $productName = $productTransactions->first()->product->name ?? 'Unknown';

            // Hitung hasil akhir quantity
            $finalQuantity = $totalMasuk - $totalKeluar;

            // Kembalikan data transaksi yang telah dihitung
            return [
                'product_id' => $transaction->product_id,
                'final_quantity' => $finalQuantity,
                'name' => $productName,
                'transaction' => $transaction // Referensi transaksi unik
            ];
        });

        // Mengirimkan data ke view
        return view('project.content.layouts.admin.stock_opname', [
            'calculatedTransactions' => $calculatedTransactions, // Data transaksi yang dihitung
            'title' => 'Stock Opname' // Judul halaman
        ]);
    }

    public function pengaturanStock()
    {
        $produck = $this->userService->getAllProduck();

        return view('project.content.layouts.admin.pengaturan_stock', [
            'produck' => $produck,
            'title' => 'Pengaturan Stock' // Judul halaman
        ]);
    }

    public function edit_minimum_stock($id)
    {
    // Ambil semua produk
    $produck = $this->userService->getAllProduck();

    // Cari produk berdasarkan ID untuk diedit
    $edit_minimum_stock = Product::findOrFail($id);

        return view('project.content.layouts.admin.draw', [
            'produck' => $produck, // Tetap kirimkan daftar produk
            'edit_minimum_stock' => $edit_minimum_stock,
            'title' => 'Pengaturan Stock' // Judul halaman
        ]);
    }

    public function updateMinimumStock(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'minimum_stock' => 'required|integer|min:0', // Validasi harus angka dan minimal 0
        ]);

        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Update minimum_stock
        $product->minimum_stock = $request->input('minimum_stock');
        $product->save(); // Simpan perubahan

        // Redirect atau response
        return redirect()->route('pengaturanStock', ['id' => $id])->with('success', 'Minimum stock berhasil diperbarui.');
    }

    public function laporan_stock()
    {
        return view('project.content.layouts.admin.laporan_stock', [
            'title' => 'Laporan Stock' // Laporan Stock
        ]);
    }


    
    
    public function index()
    {
        return view('example.index');
    }

    public function createProduct(Request $request)
    {

        $product = $this->userService->createProduct($request->all());

        // Mengembalikan response JSON jika berhasil
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Produk berhasil ditambahkan.',
        //     'data' => $product
        // ], 201); // 201 Created
        return redirect()->route('layouts.admin.data_produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function createGetProduct()
    {
        $categories = Categorie::all();
        $suppliers = Supplier::all();

        return view('project.content.crud.tambah_produck', compact('categories', 'suppliers'), ['title' => 'Tambah Product']);
    }

    public function getAllProduck()
    {
        $produck = $this->userService->getAllProduck();

                // Mengembalikan data dalam format JSON
                // return response()->json([
                //     'status' => 'success',
                //     'data' => $produck,
                //     'title' => 'Product'
                // ]);
        return view('project.content.layouts.manager.produk', compact('produck'), ['title' => 'Product']);
    }

    public function getAllProduckAdmin()
    {
        $produck = $this->userService->getAllProduck();
        return view('project.content.layouts.admin.data_produk', compact('produck'), ['title' => 'Product']);
    }


    public function dashboardAdmin()
    {
        $allStockTransactions = $this->stocktransactionService->getallStockTransaction();
        // Filter transaksi masuk dengan status diterima
        $stockMasuk = $allStockTransactions->filter(function ($transaction) {
            return $transaction->type === 'masuk' && $transaction->status === 'diterima';
        });

        // Pisahkan transaksi berdasarkan keluar dan dikeluarkan
        $stockKeluar = $allStockTransactions->filter(function ($transaction) {
            return $transaction->type === 'keluar' && $transaction->status === 'dikeluarkan';
        });

        // Hitung total jumlah data
        $totalStockMasuk = $stockMasuk->count();
        $totalStockKeluar = $stockKeluar->count();

        $count = $this->userService->countProduk();
        return view('project.index', [
            'totalStockKeluar' => $totalStockKeluar,
            'totalStockMasuk' => $totalStockMasuk,
            'count' => $count,
            'title' => 'Dashboard Admin'
        ]);
    }

    public function findProductById($id)
    {
        $product = $this->productService->findProductById($id);
        $ProductAttribute = ProductAttribute::where('product_id', $product->id)->get();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // return response()->json($productService);
        return view('project.content.crud.lihat_produck', compact('product', 'ProductAttribute'), ['title' => 'ProductById']);
    }

    public function findUpdate($id)
    {
        $product = $this->productService->findProductById($id);
        $categories = Categorie::all(); // Mendapatkan semua kategori
        $suppliers = Supplier::all();

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // return response()->json($productService);
        return view('project.content.crud.edit_produck', compact('product', 'categories', 'suppliers'), ['title' => 'EditProduct']);
    }

    public function updateProduct(Request $request, $id)
    {
        $data = $request->only([
            'category_id',
            'supplier_id',
            'name',
            'sku',
            'description',
            'purchase_price',
            'selling_price',
            'image'
        ]);

        try {
            $this->productService->updateProduct($id, $data);
            // return response()->json(['message' => 'Product updated successfully', 'data' => $product]);
            return redirect()->route('layouts.admin.data_produk')->with('success', 'Produk berhasil dihapus.');
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function deleteProductById($id)
    {
        $deleted = $this->productService->deleteProductById($id);

        if ($deleted) {
            return redirect()->route('layouts.admin.data_produk')->with('success', 'Produk berhasil dihapus.');
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    // public function exportToExcel()
    // {
    //     return $this->productService->exportProductsToExcel();
    // }

    public function exportProduct(Request $request)
    {
        try {
            $products = Product::with(['category', 'supplier'])->get();

        // Menggunakan service untuk mengekspor data ke Excel
        return $this->productService->getAllExport($products);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
