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
        // Obtiene todas las notificaciones ordenadas por fecha
        $notificaciones = $user->notifications()->orderBy('created_at', 'desc')->get();
        // Cuenta las notificaciones no leídas
        $unreadCount = $user->notifications()->where('read', false)->count();

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
        $notification->read = true; // Marca como leída
        $notification->save(); // Guarda el cambio

        return response()->json(['message' => 'Notification marcada como leida']);
    }
}
