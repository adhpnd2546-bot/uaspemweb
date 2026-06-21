<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petani_id')->constrained('petani')->cascadeOnDelete();
            $table->string('nama_lahan');
            $table->string('komoditas', 50);
            $table->decimal('luas_lahan', 10, 2);
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->date('tanggal_tanam')->nullable();
            $table->string('status_fase', 50)->default('persiapan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lahan');
    }
};
