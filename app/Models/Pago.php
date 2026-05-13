<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    protected $fillable = [
        'mensaje_id', 'user_id', 'stripe_session_id',
        'stripe_payment_intent', 'monto', 'moneda', 'estado',
    ];

    public function mensaje(): BelongsTo
    {
        return $this->belongsTo(MensajePlataforma::class, 'mensaje_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
