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
            $table->string('audio_url', 500)->nullable()->after('youtube_url');
            $table->string('audio_titulo', 200)->nullable()->after('audio_url');
            $table->string('audio_artista', 200)->nullable()->after('audio_titulo');
            $table->string('audio_thumb', 500)->nullable()->after('audio_artista');
            $table->unsignedSmallInteger('audio_start')->default(0)->after('audio_thumb');
            $table->unsignedSmallInteger('audio_end')->default(15)->after('audio_start');
        });
    }

    public function down(): void
    {
        Schema::table('mensajes_plataforma', function (Blueprint $table) {
            $table->dropColumn(['audio_url','audio_titulo','audio_artista','audio_thumb','audio_start','audio_end']);
        });
    }
};
