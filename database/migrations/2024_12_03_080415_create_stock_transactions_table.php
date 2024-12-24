<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Foreign key ke tabel produk
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->enum('type', ['masuk', 'keluar']); // Jenis transaksi: 'in' atau 'out'
            $table->integer('quantity'); // Jumlah barang
            $table->date('date'); // Tanggal transaksi
            $table->enum('status', ['pending', 'diterima', 'ditolak', 'dikeluarkan']); // Status transaksi
            $table->text('notes')->nullable(); // Catatan (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
