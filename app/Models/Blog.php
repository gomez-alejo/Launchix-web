<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $allowFilter = ['id','title', 'content', 'image_pach'];

    protected $fillable = [
        'title',        // Título del blog
        'content',      // Contenido del blog
        'image_path',   // Ruta de la imagen asociada al blog
        'category_id',  // ID de la categoría a la que pertenece el blog
        'user_id',      // ID del usuario que creó el blog
        // otros campos que desees permitir para asignación masiva
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
       return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function scopeIncluded($query)
    {
        $allowedIncludes = ['category', 'user','comments','tags', 'likes'];


        if (request()->has('include')) {
            $includes = explode(',', request('include'));
            $includes = array_intersect($includes, $allowedIncludes);
            $query->with($includes);
        }

        return $query;
    }

   public function scopeFilter($query)
    {
        if (empty($this->allowFilter) || !request()->has('filter')) {
        return $query;
        }

        $filters = request('filter');

    foreach ($filters as $filter => $value) {
        if (in_array($filter, $this->allowFilter)) {
            $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }

        return $query;
    }

}