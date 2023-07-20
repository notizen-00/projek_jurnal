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
        Schema::create('retur', function (Blueprint $table) {
            $table->id();
            $table->string('uid_retur');
            $table->string('no_transaksi');
            $table->integer('jumlah_retur');
            $table->integer('product_id');
            $table->string('keterangan_retur')->nullable();
            $table->string('status_retur')->nullable();
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
        Schema::dropIfExists('retur');
    }
};
