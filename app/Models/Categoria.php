<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['nombre', 'slug', 'emoji', 'descripcion', 'color', 'orden', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function ocasiones(): HasMany
    {
        return $this->hasMany(Ocasion::class)->where('activo', true)->orderBy('nombre');
    }
}
