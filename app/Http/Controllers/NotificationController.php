<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Devuelve las notificaciones del usuario autenticado y el conteo de no leídas
    public function getNotificaciones(Request $request)
    {
        $user = $request->user(); // Usuario autenticado

        // Si el usuario no está autenticado o la relación no existe, retorna vacío
        if (!$user || !method_exists($user, 'notifications')) {
            return response()->json([
                'notificaciones' => [],
                'unreadCount' => 0
            ]);
        }

        // Formatear notificaciones para el frontend
        $notificaciones = $user->notifications()->orderBy('created_at', 'desc')->get()->map(function($n) {
            return [
                'message' => $n->data['message'] ?? 'Tienes una nueva notificación',
                'url' => $n->data['url'] ?? '#',
                'read' => $n->read_at ? true : false,
                'created_at' => $n->created_at
            ];
        });

        // Cuenta las notificaciones no leídas
        $unreadCount = $user->notifications()->whereNull('read_at')->count() ?? 0;

        // Retorna las notificaciones y el conteo en formato JSON
        return response()->json([
            'notificaciones' => $notificaciones,
            'unreadCount' => $unreadCount
        ]);
    }

    // Marca una notificación como leída
    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::findOrFail($id); // Busca la notificación por ID
        $notification->read_at = now(); // Marca como leída
        $notification->save(); // Guarda el cambio

        return response()->json(['message' => 'Notification marcada como leida']);
    }
}
