<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wali_kelas', function (Blueprint $table) {
            $table->id();

            // nama wali kelas
            $table->string('nama_wali');

            // nama kelas
            $table->string('nama_kelas')->unique();

            // komentar/pesan wali kelas
            $table->text('komentar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wali_kelas');
    }
};