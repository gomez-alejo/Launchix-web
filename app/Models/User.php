<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
    protected $allowFilter = [ 
        'id',
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
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function scopeIncluded($query)
    {
        $allowedIncludes = ['blogs', 'comments', 'likes'];

        if (request()->has('include')) {
            $includes = explode(',', request('include'));
            $includes = array_intersect($includes, $allowedIncludes);
            $query->with($includes);
        }

        return $query;
    }

    public function scopeFilter(Builder $query)
    {

        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');

        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {

            if ($allowFilter->contains($filter)) {

                $query->where($filter, 'LIKE', '%' . $value . '%');//nos retorna todos los registros que conincidad, asi sea en una porcion del texto
            }
        }



    }

}
