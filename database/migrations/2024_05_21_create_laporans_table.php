<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->references('id')->on('mitra')->onDelete('cascade');
            $table->foreignId('pegawai_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('judul');
            $table->date('tanggal_laporan');
            $table->text('keterangan');
            $table->string('media_foto')->nullable();
            $table->string('media_video')->nullable();
            $table->string('metode');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}; 