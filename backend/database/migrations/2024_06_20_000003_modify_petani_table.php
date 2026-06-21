<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('petani', function (Blueprint $table) {
            $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatan')->onDelete('set null');
            $table->foreignId('desa_id')->nullable()->after('kecamatan_id')->constrained('desa')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('petani', function (Blueprint $table) {
            $table->dropForeign(['kecamatan_id']);
            $table->dropForeign(['desa_id']);
            $table->dropColumn(['kecamatan_id', 'desa_id']);
        });
    }
};
