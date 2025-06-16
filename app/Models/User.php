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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function blogs()
{
    return $this->hasMany(Blog::class);
}
}
