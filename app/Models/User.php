<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\User
 *
 * @property int    $id
 * @property string $username
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescription($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'firstName',
        'lastName',
        'username',
        'email',
        'password',
        'description',
        'profile_picture', // Ruta de la foto de perfil
        'cover_picture',   // Ruta de la foto de portada
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function blogs()
{
    return $this->hasMany(Blog::class);
}


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Relación con notificaciones personalizadas
    public function notifications()
    {
        // Un usuario puede tener muchas notificaciones
        return $this->hasMany(Notification::class);
    }
}
