<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dedicatorias', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('mama_name', 100);
            $table->text('message');
            $table->string('remitente', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dedicatorias');
    }
};
