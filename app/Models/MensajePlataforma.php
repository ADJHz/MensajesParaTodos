<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MensajePlataforma extends Model
{
    protected $table = 'mensajes_plataforma';

    protected $fillable = [
        'user_id', 'ocasion_id', 'code', 'destinatario',
        'mensaje', 'remitente', 'youtube_url', 'estado',
        'imagen_path', 'imagen_forma', 'imagen_marco', 'template',
        'personaje_origen', 'personaje_path', 'personaje_estilo', 'personaje_seed',
        'audio_url', 'audio_titulo', 'audio_artista', 'audio_thumb', 'audio_start', 'audio_end',
        'audio_display_mode', 'audio_lyrics',
        'audio_pos_x', 'audio_pos_y',
        'audio_scale',
    ];

    protected $casts = [
        'audio_start' => 'integer',
        'audio_end'   => 'integer',
        'audio_pos_x' => 'integer',
        'audio_pos_y' => 'integer',
        'audio_scale' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ocasion(): BelongsTo
    {
        return $this->belongsTo(Ocasion::class, 'ocasion_id');
    }

    public function pago(): HasOne
    {
        return $this->hasOne(Pago::class, 'mensaje_id');
    }

    public function isPagado(): bool
    {
        return $this->estado === 'pagado';
    }
}
