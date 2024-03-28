<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define la relación en la que un comentario pertenece a un solo usuario.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define la relación en la que un comentario pertenece a una sola pelicula.
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    // Define la relación en la que un comentario pertenece a una sola serie.
    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }
}
