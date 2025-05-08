<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',        // Título del blog
        'content',      // Contenido del blog
        'image_path',   // Ruta de la imagen asociada al blog
        'category_id',  // ID de la categoría a la que pertenece el blog
        'user_id',      // ID del usuario que creó el blog
        // otros campos que desees permitir para asignación masiva
    ];

    /**
     * Define la relación con el modelo Category.
     * Un blog pertenece a una categoría.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Define la relación con el modelo User.
     * Un blog pertenece a un usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
