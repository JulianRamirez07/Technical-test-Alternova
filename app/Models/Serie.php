<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define la relación en la que una serie puede tener muchos comentarios.
    public function serieComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Define la relación en la que una serie puede tener muchas calificaciones.
    public function serieRatings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
