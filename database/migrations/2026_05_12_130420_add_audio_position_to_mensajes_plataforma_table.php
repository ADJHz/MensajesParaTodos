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
            $table->unsignedTinyInteger('audio_pos_x')
                ->default(88)
                ->after('audio_lyrics');
            $table->unsignedTinyInteger('audio_pos_y')
                ->default(88)
                ->after('audio_pos_x');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->dropColumn(['audio_pos_x', 'audio_pos_y']);
        });
    }
};
