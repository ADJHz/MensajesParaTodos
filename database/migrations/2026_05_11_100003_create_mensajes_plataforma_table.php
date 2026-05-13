<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensajes_plataforma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ocasion_id')->constrained('ocasiones')->cascadeOnDelete();
            $table->string('code', 10)->unique();
            $table->string('destinatario');
            $table->text('mensaje');
            $table->string('remitente');
            $table->string('youtube_url')->nullable();
            $table->enum('estado', ['pendiente', 'pagado'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensajes_plataforma');
    }
};
