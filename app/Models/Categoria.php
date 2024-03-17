<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;
    protected $table = "categorias";
    protected $primaryKey = "id";

    protected $fillable = [
        "categoria_padre_id",
        "nombre",
        "nombre_slug",
        "estado"
    ];

    public function padre(): BelongsTo
    {
        return $this->belongsTo(Categoria::class,"categoria_padre_id","id")->withDefault();
    }

    public function hijos(): HasMany
    {
        return $this->hasMany(Categoria::class,"id","categoria_padre_id");
    }
}
