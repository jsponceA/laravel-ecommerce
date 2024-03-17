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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("categoria_id")->nullable();
            $table->string("titulo")->unique()->nullable();
            $table->string("titulo_slug")->nullable();
            $table->string("descripcion_corta")->nullable();
            $table->text("contenido")->nullable();
            $table->boolean("destacado")->default(0);
            $table->boolean("estado")->default(1);
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
