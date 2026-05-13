<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->string('imagen_path', 500)->nullable()->after('youtube_url');
            $table->string('imagen_forma', 20)->nullable()->default('circulo')->after('imagen_path');
            $table->string('imagen_marco', 20)->nullable()->default('ninguno')->after('imagen_forma');
        });
    }

    public function down(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->dropColumn(['imagen_path', 'imagen_forma', 'imagen_marco']);
        });
    }
};
