<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotificaciones(Request $request)
    {
        $user = $request->user();
        $notificaciones = $user->notifications()->orderBy('created_at', 'desc')->get();

        $unreadCount = $user->notifications()->where('read', false)->count();

        return response()->json([
            'notificaciones' => $notificaciones,
            'unreadCount' => $unreadCount
        ]);
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marcada como leida']);
    }
}
