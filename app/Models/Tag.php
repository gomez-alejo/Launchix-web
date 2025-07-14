<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $allowFilter = ['id', 'name'];

    public function blogs()
    {
       return $this->belongsToMany(Blog::class, 'blog_tag', 'tag_id', 'blog_id');
    }

    public function scopeIncluded($query)
    {
        $allowedIncludes = ['blogs'];

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
