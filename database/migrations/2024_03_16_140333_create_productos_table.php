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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre")->unique();
            $table->string("nombre_slug")->nullable();
            $table->string("codigo_barras")->nullable();
            $table->string("codigo_sku")->nullable();
            $table->string("descripcion_corta")->nullable();
            $table->string("descripcion_larga")->nullable();
            $table->text("detalles")->nullable();
            $table->text("informacion_adicional")->nullable();
            $table->decimal("precio",11,2)->nullable();
            $table->decimal("porcentaje_descuento",11,2)->nullable();
            $table->decimal("precio_descuento",11,2)->nullable();
            $table->decimal("cantidad_stock_alerta",11,2)->nullable();
            $table->boolean("tiene_descuento")->default(0);
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
        Schema::dropIfExists('productos');
    }
};
