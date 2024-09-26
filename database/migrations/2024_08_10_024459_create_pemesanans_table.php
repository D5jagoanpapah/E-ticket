<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->bigIncrements('id_pemesanan');
            $table->unsignedInteger('id_customer');
            $table->unsignedInteger('id_paket');
            $table->date('tanggal_pemesanan');
            $table->integer('jumlah_peserta');
            $table->enum('status_pemesanan', ['Menunggu', 'Dikonfirmasi']);
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('pemesanans');
    }
}
