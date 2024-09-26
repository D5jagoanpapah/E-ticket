<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->bigIncrements('id_paket');
            $table->string('nama_paket', '25');
            $table->text('deskripsi');
            $table->decimal('harga', 20, 2);
            $table->integer('durasi');
            $table->date('tanggal_keberangkatan');
            $table->date('tanggal_kepulangan');
            $table->integer('ketersediaan');
            $table->string('lokasi', '50');
            $table->enum('status', ['Tersedia', 'Penuh', 'Dibatalkan']);
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
        Schema::dropIfExists('pakets');
    }
}
