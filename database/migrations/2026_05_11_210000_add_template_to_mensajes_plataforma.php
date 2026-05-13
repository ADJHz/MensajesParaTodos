<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->string('template', 30)->default('clasico')->after('imagen_marco');
        });
    }

    public function down(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->dropColumn('template');
        });
    }
};
