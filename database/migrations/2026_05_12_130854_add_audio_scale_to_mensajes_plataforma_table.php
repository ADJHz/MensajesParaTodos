<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->unsignedTinyInteger('audio_scale')
                ->default(100)
                ->after('audio_pos_y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->dropColumn(['audio_scale']);
        });
    }
};
