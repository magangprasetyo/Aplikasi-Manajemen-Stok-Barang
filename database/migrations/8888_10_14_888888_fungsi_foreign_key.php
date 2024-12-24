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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });

        Schema::table('product_attributes', function (Blueprint $table) 
        {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::table('stock_transactions', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['supplier_id']);
        });

        Schema::table('product_attributes', function (Blueprint $table)
        {
            $table->dropForeign(['product_id']);
        });
        Schema::table('stock_transactions', function (Blueprint $table)
        {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
        });
    }
};
