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
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('nama_panggilan');
            $table->integer('tipe_kontak');
            $table->string('nama_kontak');
            $table->string('no_hp')->nullable();
            $table->string('no_identitas')->nullable();
            $table->string('info_lain')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('fax')->nullable();
            $table->string('telepon')->nullable();
            $table->string('alamat_pembayaran')->nullable();
            $table->string('alamat_pengiriman')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('status_kontak');
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
        Schema::dropIfExists('kontak');
    }
};
