<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            // Origen del personaje: tema | dicebear | custom | ninguno
            $table->string('personaje_origen', 20)->default('tema')->after('template');
            // Para 'custom': ruta del archivo subido por el usuario
            $table->string('personaje_path', 255)->nullable()->after('personaje_origen');
            // Para 'dicebear': estilo y semilla
            $table->string('personaje_estilo', 30)->nullable()->after('personaje_path');
            $table->string('personaje_seed', 100)->nullable()->after('personaje_estilo');
        });
    }

    public function down(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->dropColumn([
                'personaje_origen',
                'personaje_path',
                'personaje_estilo',
                'personaje_seed',
            ]);
        });
    }
};
