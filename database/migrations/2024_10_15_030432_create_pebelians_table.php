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
        Schema::create('pebelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_pelanggan');
            // $table->unsignedBigInteger('id_datapenjualan');
            $table->string('status');
            // $table->string('total_bayar');
            $table->string('jenis_pengiriman');
            $table->string('pilih_pembayaran');
            $table->timestamps();

            $table->foreign('id_product')->references('id')->on('products');
            // $table->foreign('id_pelanggan')->references('id')->on('planggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pebelians');
    }
};
