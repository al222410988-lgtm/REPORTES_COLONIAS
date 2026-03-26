<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\NotificacionTiempoRealController;
use App\Http\Controllers\AnalyticsController;

Route::get('/notificaciones', [NotificacionController::class, 'index'])->middleware('auth');

// NOTIFICACIONES EN TIEMPO REAL
Route::get('/api/notificaciones', [NotificacionTiempoRealController::class, 'index'])->middleware('auth');
Route::post('/api/notificaciones/{id}/leida', [NotificacionTiempoRealController::class, 'marcarLeida'])->middleware('auth');
Route::post('/api/notificaciones/todas-leidas', [NotificacionTiempoRealController::class, 'marcarTodasLeidas'])->middleware('auth');
Route::delete('/api/notificaciones/{id}', [NotificacionTiempoRealController::class, 'eliminar'])->middleware('auth');
Route::get('/api/notificaciones/no-leidas', [NotificacionTiempoRealController::class, 'getNoLeidasCount'])->middleware('auth');

// ANALYTICS Y GRÁFICOS
Route::get('/api/analytics/reportes-por-categoria', [AnalyticsController::class, 'getReportesPorCategoria'])->middleware('auth');
Route::get('/api/analytics/reportes-por-estado', [AnalyticsController::class, 'getReportesPorEstado'])->middleware('auth');
Route::get('/api/analytics/reportes-por-mes', [AnalyticsController::class, 'getReportesPorMes'])->middleware('auth');
Route::get('/api/analytics/apoyos-por-reporte', [AnalyticsController::class, 'getApoyosPorReporte'])->middleware('auth');
Route::get('/api/analytics/mapa-calor', [AnalyticsController::class, 'getMapaCalor'])->middleware('auth');
Route::get('/api/analytics/zonas-riesgo', [AnalyticsController::class, 'getZonasAltoRiesgo'])->middleware('auth');

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout']);

// RUTAS PROTEGIDAS
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ReporteController::class, 'dashboard']);
    Route::get('/dashboard/filtrado', [ReporteController::class, 'dashboardResidente']);
    Route::get('/reporte/crear', [ReporteController::class, 'create']);
    Route::post('/reporte/guardar', [ReporteController::class, 'store']);
    Route::get('/reporte/{id}', [ReporteController::class, 'show']);
    Route::post('/reporte/actualizar/{id}', [ReporteController::class, 'actualizar']);
    Route::get('/perfil', [PerfilController::class, 'index']);
    Route::post('/perfil/actualizar', [PerfilController::class, 'update']);
    Route::get('/analytics', [AnalyticsController::class, 'index'])->middleware('auth');
});

Route::middleware('auth')->group(function () {

    Route::get('/admin/crear', [AdminController::class, 'createAdmin']);
    Route::post('/admin/guardar', [AdminController::class, 'storeAdmin']);
    Route::get('/admin/solicitudes', [AdminController::class, 'solicitudes'])->middleware('auth');
Route::get('/admin/aprobar/{id}', [AdminController::class, 'aprobar'])->middleware('auth');
Route::get('/reporte/eliminar/{id}', [ReporteController::class, 'eliminar'])->middleware('auth');
Route::get('/reporte/apoyar/{id}', [ReporteController::class, 'apoyar'])->middleware('auth');
});