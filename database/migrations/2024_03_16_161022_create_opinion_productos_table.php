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
        Schema::create('opinion_productos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("producto_id");
            $table->string("nombres_apellidos");
            $table->integer("cantidad_estrellas")->default(1);
            $table->string("comentario");
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opinion_productos');
    }
};
