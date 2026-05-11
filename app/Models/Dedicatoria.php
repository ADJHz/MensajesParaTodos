<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Dedicatoria extends Model
{
    protected $fillable = ['code', 'mama_name', 'message', 'remitente'];

    protected static function booted(): void
    {
        static::creating(function (Dedicatoria $dedicatoria) {
            do {
                $code = Str::upper(Str::random(6));
            } while (self::where('code', $code)->exists());

            $dedicatoria->code = $code;
        });
    }
}
