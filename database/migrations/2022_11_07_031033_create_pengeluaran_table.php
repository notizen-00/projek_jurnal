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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun_pengeluaran');
            $table->foreignId('kontak_id')->constrained('kontak');
            $table->date('tgl_transaksi');
            $table->enum('metode_pembayaran',['Cek & Giro','Kartu Kredit','Kas Tunai','Transfer Bank']);
            $table->string('no_pengeluaran');
            $table->string('alamat_penagihan');
            $table->string('memo')->nullable();
            $table->string('lampiran')->nullable();
            $table->string('total');
            $table->string('status_pengeluaran');
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
        Schema::dropIfExists('pengeluaran');
    }
};
