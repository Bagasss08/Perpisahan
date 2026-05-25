<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();

            $table->string('nama');

            $table->string('nisn')->unique();

            $table->date('tanggal_lahir');

            // relasi wali kelas
            $table->foreignId('wali_kelas_id')
                ->constrained('wali_kelas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->enum('status', [
                'LULUS',
                'TIDAK LULUS'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};