<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homeLY - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:w3@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/notificaciones.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --dark-gradient: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,133.3C960,128,1056,96,1152,90.7C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
            z-index: -1;
        }

        .main-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin: 2rem auto;
            max-width: 1200px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.6s ease-out;
            position: relative;
        }

        .notification-bell {
            position: absolute;
            top: 2rem;
            right: 2rem;
            background: var(--primary-gradient);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            text-decoration: none;
        }

        .notification-bell:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-gradient);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo-section h1 {
            font-size: 2rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }

        .logo-section p {
            color: #6c757d;
            margin: 0;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 15px;
            text-decoration: none;
            color: inherit;
        }

        .user-info:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--success-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .profile-btn {
            background: var(--dark-gradient);
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(51, 8, 103, 0.4);
            color: white;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(238, 90, 36, 0.4);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 0;
        }

        .action-card:hover::before {
            opacity: 1;
        }

        .action-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .action-card * {
            position: relative;
            z-index: 1;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            background: var(--primary-gradient);
            transition: all 0.3s ease;
        }

        .action-card:hover .action-icon {
            transform: scale(1.1);
            background: white;
            color: #667eea;
        }

        .action-card.crear .action-icon {
            background: var(--success-gradient);
        }

        .action-card h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .action-card p {
            color: #6c757d;
            margin: 0;
            font-size: 0.9rem;
        }

        .action-card:hover p {
            color: rgba(255, 255, 255, 0.9);
        }

        .reports-section {
            margin-bottom: 3rem;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .section-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filter-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .filter-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .filter-btn {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(102, 126, 234, 0.2);
            color: #667eea;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .filter-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .filter-btn.active {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .filter-btn i {
            font-size: 0.9rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .report-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .report-header {
            padding: 1.5rem;
            background: var(--primary-gradient);
            color: white;
        }

        .report-category {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .report-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .report-status {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .report-body {
            padding: 1.5rem;
        }

        .report-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .author-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--success-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .author-info {
            flex: 1;
        }

        .author-name {
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .supports-count {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .support-btn {
            background: var(--warning-gradient);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .support-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(250, 112, 154, 0.4);
        }

        .support-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
        }

        .report-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .btn-action {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 10px;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-view {
            background: var(--dark-gradient);
            color: white;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(51, 8, 103, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(238, 90, 36, 0.4);
        }

        .alert {
            border-radius: 15px;
            border: none;
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
            animation: slideDown 0.5s ease-out;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.9);
            color: white;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.9);
            color: white;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .main-header {
                margin: 1rem;
                padding: 1rem;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .reports-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .section-header {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
@if(session('error'))
<div class="container">
    <div class="alert alert-danger" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
    </div>
</div>
@endif

@if(session('success'))
<div class="container">
    <div class="alert alert-success" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
    </div>
</div>
@endif

<header class="main-header">
    <div class="header-content">
        <div class="logo-section">
            <h1>homeLY</h1>
            <p>Gestión comunitaria inteligente</p>
        </div>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div class="notification-bell">
                <i class="bi bi-bell-fill" style="font-size: 1.2rem;"></i>
            </div>
            <a href="/perfil" class="user-info">
                <div class="user-avatar">
                    {{ substr(auth()->user()->nombre, 0, 1) }}
                </div>
                <div>
                    <div class="fw-semibold">{{ auth()->user()->nombre }}</div>
                    <small class="text-muted">Residente</small>
                </div>
            </a>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    Salir
                </button>
            </form>
        </div>
    </div>
</header>

<div class="container">
    <div class="action-buttons">
        <a href="/reporte/crear" class="action-card crear">
            <div class="action-icon">
                <i class="bi bi-plus-circle-fill"></i>
            </div>
            <h3>Crear Reporte</h3>
            <p>Reporta un problema en tu comunidad</p>
        </a>
    </div>

    <section class="reports-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-clipboard-data-fill"></i>
                Mis Reportes
            </h2>
            <div class="badge bg-primary">
                {{ $reportes->count() }} reportes
            </div>
        </div>

        <!-- FILTROS POR ESTADO -->
        <div class="filter-section">
            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filtrarReportes('todos')">
                    <i class="bi bi-grid-fill"></i>
                    Todos
                </button>
                <button class="filter-btn" onclick="filtrarReportes('pendiente')">
                    <i class="bi bi-clock-fill"></i>
                    Pendientes
                </button>
                <button class="filter-btn" onclick="filtrarReportes('en_proceso')">
                    <i class="bi bi-arrow-repeat-fill"></i>
                    En Proceso
                </button>
                <button class="filter-btn" onclick="filtrarReportes('finalizado')">
                    <i class="bi bi-check-circle-fill"></i>
                    Finalizados
                </button>
            </div>
        </div>

        <div class="reports-grid">
            @foreach($reportes as $r)
            @php
            $yaApoyo = $r->apoyos->where('usuario_id', auth()->id())->count();
            @endphp

            <div class="report-card">
                <div class="report-header">
                    <div class="report-category">
                        @switch($r->categoria)
                            @case('areas_verdes')
                                <i class="bi bi-tree-fill me-2"></i> Áreas Verdes
                                @break
                            @case('calles')
                                <i class="bi bi-road-fill me-2"></i> Calles
                                @break
                            @case('fugas')
                                <i class="bi bi-droplet-fill me-2"></i> Fugas
                                @break
                            @case('alumbrado')
                                <i class="bi bi-lightbulb-fill me-2"></i> Alumbrado
                                @break
                            @default
                                {{ $r->categoria }}
                        @endswitch
                    </div>
                    <div class="report-meta">
                        <span><i class="bi bi-calendar3 me-1"></i> {{ $r->created_at->format('d/m/Y') }}</span>
                        <span class="report-status">{{ $r->estado }}</span>
                    </div>
                </div>
                
                <div class="report-body">
                    <div class="report-author">
                        <div class="author-avatar">
                            {{ substr($r->usuario->nombre, 0, 1) }}
                        </div>
                        <div class="author-info">
                            <p class="author-name">{{ $r->usuario->nombre }}</p>
                            <p class="supports-count">
                                <i class="bi bi-hand-thumbs-up-fill me-1"></i>
                                {{ $r->apoyos->count() }} apoyos
                            </p>
                        </div>
                        @if($r->usuario_id != auth()->id())
                            @if($yaApoyo == 0)
                                <a href="/reporte/apoyar/{{ $r->id }}" class="support-btn">
                                    <i class="bi bi-hand-thumbs-up-fill"></i>
                                    Apoyar
                                </a>
                            @else
                                <button class="support-btn" disabled>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Apoyado
                                </button>
                            @endif
                        @else
                            <button class="support-btn" disabled>
                                <i class="bi bi-person-fill"></i>
                                Tu reporte
                            </button>
                        @endif
                    </div>
                    
                    <div class="report-actions">
                        <a href="/reporte/{{ $r->id }}" class="btn-action btn-view">
                            <i class="bi bi-eye-fill"></i>
                            Ver detalles
                        </a>
                        @if($r->usuario_id == auth()->id())
                            <a href="/reporte/eliminar/{{ $r->id }}" 
                               class="btn-action btn-delete"
                               onclick="return confirm('¿Estás seguro de que deseas eliminar este reporte?')">
                                <i class="bi bi-trash-fill"></i>
                                Eliminar
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/notificaciones.js"></script>

<script>
// Función para filtrar reportes por estado
function filtrarReportes(estado) {
    // Actualizar botón activo
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');

    // Construir URL con parámetro de filtro
    const url = new URL(window.location);
    if (estado === 'todos') {
        url.searchParams.delete('estado');
    } else {
        url.searchParams.set('estado', estado);
    }

    // Redirigir a la página filtrada
    window.location.href = url.toString();
}

// Mantener el estado del filtro activo al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const estadoActual = urlParams.get('estado') || 'todos';
    
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.textContent.toLowerCase().includes(estadoActual) || 
            (estadoActual === 'todos' && btn.textContent.includes('Todos'))) {
            btn.classList.add('active');
        }
    });
});
</script>
</body>
</html>
