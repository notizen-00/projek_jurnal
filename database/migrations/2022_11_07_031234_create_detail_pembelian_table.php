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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontak_id')->constrained('kontak');
            $table->foreignId('pembelian_id')->constrained('pembelian');
            $table->foreignId('product_id')->constrained('product');
            $table->string('deskripsi')->nullable();
            $table->integer('qty');
            $table->string('harga_satuan');
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
        Schema::dropIfExists('detail_pembelian');
    }
};
