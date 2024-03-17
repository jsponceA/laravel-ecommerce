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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("nombre")->unique();
            $table->boolean("estado")->default(1);
            $table->datetimes();
        });

        \App\Models\Rol::query()->create([
            "nombre"=> "Administrador",
            "estado" => 1
        ]);

        \App\Models\Rol::query()->create([
            "nombre"=> "Cliente",
            "estado" => 1
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
