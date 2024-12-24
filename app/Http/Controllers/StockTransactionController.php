<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Services\StockTransaction\StockTransactionService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StockTransactionController extends Controller
{

    use AuthorizesRequests, ValidatesRequests;
    private $stocktransactionService;

    public function __construct(StockTransactionService $stocktransactionService)
    {
        $this->stocktransactionService = $stocktransactionService;
    }

    public function createStockTransaction(Request $request)
    {
        // Proses pembuatan transaksi stok
    $createStockTransaction = $this->stocktransactionService->createStockTransaction($request->all());

    if ($createStockTransaction) {
        // Redirect ke view tertentu dengan pesan sukses
        return redirect()->route('dashboard_manager')->with('success', 'Transaksi stok berhasil dibuat!');
    }

        // Redirect kembali jika gagal
        return redirect()->back()->with('error', 'Gagal membuat transaksi stok. Silakan coba lagi.');
    }

    public function getallStockTransaction()
    {
        $createStockTransaction =  $this->stocktransactionService->getallStockTransaction();
        return response()->json([
            'status' => 'success',
            'data' => $createStockTransaction,
        ]);

    }

    public function dashboardManager()
    {
        $allStockTransactions = $this->stocktransactionService->getallStockTransaction();
    
        // Pisahkan transaksi berdasarkan masuk dan diterima
        $stockMasuk = $allStockTransactions->filter(function ($transaction) {
            return $transaction->type === 'masuk' && $transaction->status === 'diterima';
        });

        // Pisahkan transaksi berdasarkan keluar dan dikeluarkan
        $stockKeluar = $allStockTransactions->filter(function ($transaction) {
            return $transaction->type === 'keluar' && $transaction->status === 'dikeluarkan';
        });

    
        // Kelompokkan transaksi berdasarkan product_id
        $groupedByProduct = $allStockTransactions->groupBy('product_id');
    
        // Hitung stok akhir untuk setiap produk
        $stockSummary = $groupedByProduct->map(function ($transactions, $productId) {
            // Total berdasarkan type 'masuk' dan status 'diterima'
            $totalMasuk = $transactions->where('type', 'masuk')->where('status', 'diterima')->sum('quantity');

            // Total berdasarkan type 'keluar' dan status 'dikeluarkan'
            $totalKeluar = $transactions->where('type', 'keluar')->where('status', 'dikeluarkan')->sum('quantity');

    
            // Pastikan relasi product->name ada dan valid
            $productName = $transactions->first()->product->name ?? 'Unknown'; // Tambahkan null coalescing operator
    
            return [
                'product_id' => $productId,
                'name' => $productName,
                'stok_akhir' => $totalMasuk - $totalKeluar,
            ];
        });
    
        // Filter stok tipis (misalnya stok < 5 atau < 100, sesuaikan kebutuhan Anda)
        $stockTipis = $stockSummary->filter(function ($summary) {
            return $summary['stok_akhir'] < 10; // Sesuaikan limit sesuai kebutuhan
        });
    
        return view('project.dashboard_manager', [
            'stockTipis' => $stockTipis,
            'stockMasuk' => $stockMasuk,
            'stockKeluar' => $stockKeluar,
            'title' => 'Dashboard Manager'
        ]);
        // return response()    ->json($stockTipis); // Jika ingin mengembalikan response JSON
    }

    public function dashboardStaff()
    {
        $allStockTransactions = $this->stocktransactionService->getallStockTransaction();

        $transaksiPending = $allStockTransactions->filter(function ($transaction) {
            return $transaction->status === 'pending';
        });
        return view('project.dashboard_staff', [
            'transaksiPending' => $transaksiPending,
            'title' => 'Dashboard Staff'
        ]);
        // return response()->json($transaksiPending);
    }

    public function konfirmasiStock()
    {
        $allStockTransactions = $this->stocktransactionService->getallStockTransaction();
        $transaksiPending = $allStockTransactions->filter(function ($transaction) {
            return $transaction->status === 'pending';
        });
        return view('project.content.layouts.staff.konfirmasi_stok', [
            'transaksiPending' => $transaksiPending,
            'title' => 'Konfirmasi Stok'
        ]);
    }

    public function confirmTransaction(Request $request, $id)
    {
        $transaction = StockTransaction::find($id);

        // Set status berdasarkan type
        if ($transaction->type === 'masuk') {
            if ($request->status == 'diterima') {
                $transaction->status = 'diterima';
            } elseif ($request->status == 'ditolak') {
                $transaction->status = 'ditolak';
            }
        } elseif ($transaction->type === 'keluar') {
            if ($request->status == 'dikeluarkan') {
                $transaction->status = 'dikeluarkan';
            } elseif ($request->status == 'ditolak') {
                $transaction->status = 'ditolak';
            }
        }

        $transaction->save();

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
    }
}
