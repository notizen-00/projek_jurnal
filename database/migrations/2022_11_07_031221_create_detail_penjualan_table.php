<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontak_id')->contstrained('kontak');
            $table->foreignId('penjualan_id')->constrained('penjualan');
            $table->foreignId('product_id')->constrained('product');
            $table->string('deskripsi')->nullable();
            $table->string('qty');
            $table->string('satuan');
            $table->string('harga_satuan');
            $table->string('diskon');
            $table->string('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
