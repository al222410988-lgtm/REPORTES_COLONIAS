<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Usuario;
use App\Models\Apoyo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Solo administradores y super admins pueden ver estadísticas
        if (!auth()->user() || !in_array(auth()->user()->rol, ['admin', 'superadmin'])) {
            return redirect('/dashboard')->with('error', 'No tienes permisos para ver las estadísticas');
        }

        return view('analytics');
    }

    public function getReportesPorCategoria()
    {
        $reportes = Reporte::selectRaw('categoria, COUNT(*) as total')
            ->groupBy('categoria')
            ->orderBy('total', 'desc')
            ->get();

        // Formatear para Chart.js
        $labels = [];
        $data = [];
        $colors = [
            'areas_verdes' => '#28a745',
            'calles' => '#ffc107',
            'fugas' => '#17a2b8',
            'alumbrado' => '#6610f2'
        ];

        foreach ($reportes as $reporte) {
            $labels[] = $this->formatCategoria($reporte->categoria);
            $data[] = $reporte->total;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'colors' => array_intersect_key($colors, array_flip($reportes->pluck('categoria')->toArray()))
        ]);
    }

    public function getReportesPorEstado()
    {
        $reportes = Reporte::selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->orderBy('total', 'desc')
            ->get();

        $labels = [];
        $data = [];
        $colors = [
            'pendiente' => '#ffc107',
            'en_proceso' => '#17a2b8',
            'finalizado' => '#28a745'
        ];

        foreach ($reportes as $reporte) {
            $labels[] = $this->formatEstado($reporte->estado);
            $data[] = $reporte->total;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'colors' => array_intersect_key($colors, array_flip($reportes->pluck('estado')->toArray()))
        ]);
    }

    public function getReportesPorMes()
    {
        $reportes = Reporte::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->limit(12)
            ->get();

        $labels = [];
        $data = [];

        foreach ($reportes as $reporte) {
            $labels[] = $this->formatMes($reporte->mes);
            $data[] = $reporte->total;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function getApoyosPorReporte()
    {
        $reportes = Reporte::withCount('apoyos')
            ->orderBy('apoyos_count', 'desc')
            ->limit(10)
            ->get();

        $labels = [];
        $data = [];

        foreach ($reportes as $reporte) {
            $labels[] = '#' . $reporte->id;
            $data[] = $reporte->apoyos_count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function getMapaCalor()
    {
        // Simular datos de mapa de calor (en producción, usar coordenadas reales)
        $reportes = Reporte::select('categoria', DB::raw('COUNT(*) as total'))
            ->groupBy('categoria')
            ->get();

        $mapaData = [];
        foreach ($reportes as $reporte) {
            $mapaData[] = [
                'categoria' => $this->formatCategoria($reporte->categoria),
                'total' => $reporte->total,
                'latitud' => $this->getLatitudSimulada($reporte->categoria),
                'longitud' => $this->getLongitudSimulada($reporte->categoria),
                'intensidad' => min($reporte->total * 10, 100)
            ];
        }

        return response()->json($mapaData);
    }

    public function getZonasAltoRiesgo()
    {
        // Identificar zonas con alta concentración de reportes
        $zonasRiesgo = Reporte::selectRaw('categoria, COUNT(*) as total')
            ->groupBy('categoria')
            ->having('total', '>', 5)
            ->orderBy('total', 'desc')
            ->get();

        $riesgoData = [];
        foreach ($zonasRiesgo as $zona) {
            $riesgoData[] = [
                'zona' => $this->formatCategoria($zona->categoria),
                'total_reportes' => $zona->total,
                'nivel_riesgo' => $this->calcularNivelRiesgo($zona->total),
                'recomendacion' => $this->getRecomendacion($zona->categoria, $zona->total)
            ];
        }

        return response()->json($riesgoData);
    }

    // Métodos auxiliares
    private function formatCategoria($categoria)
    {
        $formatos = [
            'areas_verdes' => 'Áreas Verdes',
            'calles' => 'Calles',
            'fugas' => 'Fugas',
            'alumbrado' => 'Alumbrado'
        ];
        return $formatos[$categoria] ?? $categoria;
    }

    private function formatEstado($estado)
    {
        $formatos = [
            'pendiente' => 'Pendiente',
            'en_proceso' => 'En Proceso',
            'finalizado' => 'Finalizado'
        ];
        return $formatos[$estado] ?? $estado;
    }

    private function formatMes($mes)
    {
        $date = \DateTime::createFromFormat('Y-m', $mes);
        return $date ? $date->format('M Y') : $mes;
    }

    private function getLatitudSimulada($categoria)
    {
        $latitudes = [
            'areas_verdes' => 19.4326,
            'calles' => 19.4260,
            'fugas' => 19.4380,
            'alumbrado' => 19.4350
        ];
        return $latitudes[$categoria] ?? 19.4326;
    }

    private function getLongitudSimulada($categoria)
    {
        $longitudes = [
            'areas_verdes' => -99.1332,
            'calles' => -99.1350,
            'fugas' => -99.1310,
            'alumbrado' => -99.1340
        ];
        return $longitudes[$categoria] ?? -99.1332;
    }

    private function calcularNivelRiesgo($total)
    {
        if ($total >= 10) return 'Crítico';
        if ($total >= 7) return 'Alto';
        if ($total >= 5) return 'Medio';
        return 'Bajo';
    }

    private function getRecomendacion($categoria, $total)
    {
        $recomendaciones = [
            'areas_verdes' => 'Programar mantenimiento preventivo de áreas verdes',
            'calles' => 'Priorizar reparación de baches y señalización',
            'fugas' => 'Inspección urgente del sistema de agua',
            'alumbrado' => 'Reemplazar luminarias dañadas en zonas afectadas'
        ];

        $base = $recomendaciones[$categoria] ?? 'Realizar inspección detallada';
        
        if ($total >= 10) {
            return $base . ' - Prioridad CRÍTICA';
        } elseif ($total >= 7) {
            return $base . ' - Prioridad ALTA';
        }
        
        return $base;
    }
}
