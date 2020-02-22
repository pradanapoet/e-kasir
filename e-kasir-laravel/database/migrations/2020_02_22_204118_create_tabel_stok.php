<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelStok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->bigIncrements('id_stok');
            $table->integer('id_barang');
            $table->integer('jumlah_stok_masuk');
            $table->date('tanggal_masuk');
            $table->date('tanggal_kadaluarsa');
            $table->integer('sisa_stok');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->string('status', 10);
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
        Schema::dropIfExists('stoks');
    }
}
