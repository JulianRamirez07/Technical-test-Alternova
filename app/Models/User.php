<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Define la relación en la que un usuario pertenece a un solo rol.
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Define la relación en la que un usuario puede dar muchos comentarios.
    public function userComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Define la relación en la que un usuario puede dar muchas calificaciones.
    public function userRatings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
