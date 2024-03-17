<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "usuarios";
    protected $primaryKey = "id";
    protected $fillable = [
        "rol_id",
        "usuario",
        "nombres",
        "apellidos",
        "telefono",
        "correo",
        "direccion",
        "foto",
        "foto",
        "password"
    ];

}
