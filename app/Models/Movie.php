<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define la relación en la que una película puede tener muchos comentarios.
    public function movieComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Define la relación en la que una película puede tener muchas calificaciones.
    public function movieRatings(): HasMany
    {
        return $this->hasMany(Rating::class, 'movie_id');
    }
}
