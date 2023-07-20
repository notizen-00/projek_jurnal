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
        Schema::create('table_submenu', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id');
            $table->string('nama_submenu');
            $table->string('status_submenu')->nullable();
            $table->string('url_submenu');
            $table->string('icon_submenu')->nullable();
            $table->string('jenis_submenu')->nullable();
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
        Schema::dropIfExists('table_submenu');
    }
};
