<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Support\Facades\Auth;

/**
 * Notificación personalizada para interacciones en blogs (me gusta y comentarios).
 * Se almacena en la base de datos y se muestra en la campanita.
 */
class BlogInteractionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $type; // 'like' o 'comment'
    protected $blog;
    protected $actor; // Usuario que realiza la acción
    protected $commentContent; // Solo para comentarios

    /**
     * @param string $type 'like' o 'comment'
     * @param $blog Instancia del blog
     * @param $actor Usuario que realiza la acción
     * @param string|null $commentContent Contenido del comentario (opcional)
     */
    public function __construct($type, $blog, $actor, $commentContent = null)
    {
        $this->type = $type;
        $this->blog = $blog;
        $this->actor = $actor;
        $this->commentContent = $commentContent;
    }

    // Solo base de datos
    public function via($notifiable)
    {
        return ['database'];
    }

    // Estructura de la notificación en la base de datos
    public function toDatabase($notifiable)
    {
        if ($this->type === 'like') {
            return [
                'message' => $this->actor->username . ' le dio me gusta a tu blog: ' . $this->blog->title,
                'url' => url('/blogs/' . $this->blog->id),
                'type' => 'like',
                'blog_id' => $this->blog->id,
                'actor_id' => $this->actor->id,
            ];
        } elseif ($this->type === 'comment') {
            return [
                'message' => $this->actor->username . ' comentó en tu blog: ' . $this->blog->title . ' - "' . $this->commentContent . '"',
                'url' => url('/blogs/' . $this->blog->id),
                'type' => 'comment',
                'blog_id' => $this->blog->id,
                'actor_id' => $this->actor->id,
            ];
        }
        return [];
    }
}
