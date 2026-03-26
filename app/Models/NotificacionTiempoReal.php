<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacionTiempoReal extends Model
{
    use HasFactory;

    protected $table = 'notificaciones_tiempo_real';

    protected $fillable = [
        'user_id',
        'titulo',
        'mensaje',
        'tipo',
        'categoria',
        'datos_adicionales',
        'leida',
        'fecha_leida',
    ];

    protected $casts = [
        'datos_adicionales' => 'array',
        'leida' => 'boolean',
        'fecha_leida' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Métodos estáticos para crear notificaciones fácilmente
    public static function crearNotificacion($userId, $titulo, $mensaje, $tipo = 'info', $categoria = 'sistema', $datosAdicionales = null)
    {
        return self::create([
            'user_id' => $userId,
            'titulo' => $titulo,
            'mensaje' => $mensaje,
            'tipo' => $tipo,
            'categoria' => $categoria,
            'datos_adicionales' => $datosAdicionales,
        ]);
    }

    public static function notificarNuevoReporte($reporteId, $adminUsers)
    {
        foreach ($adminUsers as $admin) {
            self::crearNotificacion(
                $admin->id,
                '🚨 Nuevo Reporte Creado',
                "Un nuevo reporte requiere tu atención. ID: #{$reporteId}",
                'urgent',
                'reporte',
                ['reporte_id' => $reporteId]
            );
        }
    }

    public static function notificarNuevoApoyo($reporteId, $reporteCreadorId, $apoyoUserId)
    {
        self::crearNotificacion(
            $reporteCreadorId,
            '👍 ¡Tu reporte tiene un nuevo apoyo!',
            "Alguien más apoya tu reporte #{$reporteId}",
            'success',
            'apoyo',
            ['reporte_id' => $reporteId, 'apoyo_user_id' => $apoyoUserId]
        );
    }

    public static function notificarReporteResuelto($reporteId, $reporteCreadorId)
    {
        self::crearNotificacion(
            $reporteCreadorId,
            '✅ ¡Reporte Resuelto!',
            "Tu reporte #{$reporteId} ha sido marcado como resuelto",
            'success',
            'reporte',
            ['reporte_id' => $reporteId]
        );
    }

    public function marcarComoLeida()
    {
        $this->update([
            'leida' => true,
            'fecha_leida' => now()
        ]);
    }
}
