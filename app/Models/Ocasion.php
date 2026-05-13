<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ocasion extends Model
{
    protected $table = 'ocasiones';

    protected $fillable = ['categoria_id', 'nombre', 'slug', 'emoji', 'descripcion', 'plantilla_vista', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function mensajes(): HasMany
    {
        return $this->hasMany(MensajePlataforma::class, 'ocasion_id');
    }
}
