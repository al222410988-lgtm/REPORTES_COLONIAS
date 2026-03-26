<?php

namespace App\Http\Controllers;

use App\Models\NotificacionTiempoReal;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionTiempoRealController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notificaciones = NotificacionTiempoReal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $noLeidas = NotificacionTiempoReal::where('user_id', $user->id)
            ->where('leida', false)
            ->count();

        return response()->json([
            'notificaciones' => $notificaciones,
            'no_leidas' => $noLeidas
        ]);
    }

    public function marcarLeida($id)
    {
        $notificacion = NotificacionTiempoReal::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($notificacion) {
            $notificacion->marcarComoLeida();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function marcarTodasLeidas()
    {
        NotificacionTiempoReal::where('user_id', Auth::id())
            ->where('leida', false)
            ->update([
                'leida' => true,
                'fecha_leida' => now()
            ]);

        return response()->json(['success' => true]);
    }

    public function eliminar($id)
    {
        $notificacion = NotificacionTiempoReal::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($notificacion) {
            $notificacion->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function getNoLeidasCount()
    {
        $count = NotificacionTiempoReal::where('user_id', Auth::id())
            ->where('leida', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    // Método para enviar notificaciones en tiempo real (usado por otros controladores)
    public static function enviarNotificacion($userId, $titulo, $mensaje, $tipo = 'info', $categoria = 'sistema', $datosAdicionales = null)
    {
        $notificacion = NotificacionTiempoReal::crearNotificacion($userId, $titulo, $mensaje, $tipo, $categoria, $datosAdicionales);
        
        // Aquí podrías integrar WebSocket o Pusher para notificaciones en tiempo real
        // Por ahora, la notificación se guardará en la base de datos
        
        return $notificacion;
    }
}
