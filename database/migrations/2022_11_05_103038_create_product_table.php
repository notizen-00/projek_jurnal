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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_produk');
            $table->foreignId('gudang_id')->constrained('gudang')->nullable();
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->integer('batas_minimum');
            $table->string('unit');
            $table->string('harga_beli');
            $table->string('harga_jual');
            $table->integer('status_produk');
            $table->string('image_produk')->nullable();
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
        Schema::dropIfExists('product');
    }
};
