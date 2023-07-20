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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontak_id')->constrained('kontak');
            $table->foreignId('gudang_id')->constrained('gudang')->nullable();
            $table->date('tgl_transaksi');
            $table->date('tgl_jatuh_tempo');
            $table->integer('metode_pembayaran');
            $table->string('no_transaksi');
            $table->integer('status_pembelian');
            $table->string('no_referensi')->nullable();
            $table->string('pesan')->nullable();
            $table->string('memo')->nullable();
            $table->string('lampiran')->nullable();
            $table->string('total');
            $table->string('sisa_tagihan');
            $table->integer('tipe_pembelian');
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
        Schema::dropIfExists('pembelian');
    }
};
