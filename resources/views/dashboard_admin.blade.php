<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homeLY - Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/notificaciones.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
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

        .logout-btn {
            background: var(--danger-gradient);
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
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem 2rem;
        }

        .admin-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out;
        }

        .stats-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .stats-title {
            font-size: 1.5rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stats-grid {
            display: grid;
            gap: 1rem;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            background: rgba(102, 126, 234, 0.05);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .actions-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .action-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .btn-action {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-action:hover::before {
            left: 100%;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-action.create {
            background: var(--success-gradient);
        }

        .btn-action.create:hover {
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.4);
        }

        .btn-action.requests {
            background: var(--warning-gradient);
        }

        .btn-action.requests:hover {
            box-shadow: 0 10px 20px rgba(250, 112, 154, 0.4);
        }

        .btn-action.analytics {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-action.analytics:hover {
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .content-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(102, 126, 234, 0.2);
            color: #667eea;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-btn:hover, .filter-btn.active {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
        }

        .reports-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .report-card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
            border-left: 4px solid;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .report-card.low-priority {
            border-left-color: #28a745;
        }

        .report-card.medium-priority {
            border-left-color: #ffc107;
        }

        .report-card.high-priority {
            border-left-color: #dc3545;
        }

        .report-header {
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(102, 126, 234, 0.1);
        }

        .report-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .category-badge {
            background: var(--primary-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .priority-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
            color: white;
        }

        .priority-badge.low {
            background: var(--success-gradient);
        }

        .priority-badge.medium {
            background: var(--warning-gradient);
        }

        .priority-badge.high {
            background: var(--danger-gradient);
        }

        .report-info {
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
            font-size: 0.9rem;
        }

        .supports-count {
            color: #6c757d;
            font-size: 0.8rem;
            margin: 0;
        }

        .report-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }

        .status-pendiente {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-en_proceso {
            background: rgba(79, 172, 254, 0.1);
            color: #4facfe;
            border: 1px solid rgba(79, 172, 254, 0.3);
        }

        .status-finalizado {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .report-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-view {
            background: var(--dark-gradient);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
            justify-content: center;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(51, 8, 103, 0.4);
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

        @media (max-width: 1024px) {
            .admin-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .sidebar {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
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

            .container {
                padding: 0 1rem 2rem;
            }

            .stats-card, .actions-card, .main-content {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }

            .sidebar {
                grid-template-columns: 1fr;
            }

            .reports-grid {
                grid-template-columns: 1fr;
            }

            .content-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-buttons {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo-section">
                <h1>homeLY</h1>
                <p>Panel de Administración</p>
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
                        <small class="text-muted">Administrador</small>
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
        <div class="admin-container">
            <div class="sidebar">
                <div class="stats-card">
                    <div class="stats-header">
                        <h3 class="stats-title">
                            <i class="bi bi-graph-up me-2"></i>
                            Estadísticas
                        </h3>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $reportes->count() }}</div>
                            <div class="stat-label">Total de Reportes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $reportes->where('estado', 'pendiente')->count() }}</div>
                            <div class="stat-label">Pendientes</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $reportes->where('estado', 'en_proceso')->count() }}</div>
                            <div class="stat-label">En Proceso</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $reportes->where('estado', 'finalizado')->count() }}</div>
                            <div class="stat-label">Finalizados</div>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->rol == 'superadmin')
                <div class="actions-card">
                    <h3 class="action-title">
                        <i class="bi bi-gear-fill"></i>
                        Acciones Administrativas
                    </h3>
                    <div class="action-buttons">
                        <a href="/admin/crear" class="btn-action create">
                            <i class="bi bi-person-plus-fill"></i>
                            Crear Administrador
                        </a>
                        <a href="/admin/solicitudes" class="btn-action requests">
                            <i class="bi bi-person-check-fill"></i>
                            Solicitudes de Admin
                        </a>
                        <a href="/analytics" class="btn-action analytics">
                            <i class="bi bi-graph-up"></i>
                            Ver Estadísticas
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <div class="main-content">
                <div class="content-header">
                    <h2 class="content-title">
                        <i class="bi bi-clipboard-data-fill"></i>
                        Reportes Comunitarios
                    </h2>
                    <div class="filter-buttons">
                        <button class="filter-btn active" onclick="filterReports('all')">Todos</button>
                        <button class="filter-btn" onclick="filterReports('pendiente')">Pendientes</button>
                        <button class="filter-btn" onclick="filterReports('en_proceso')">En Proceso</button>
                        <button class="filter-btn" onclick="filterReports('finalizado')">Finalizados</button>
                    </div>
                </div>

                <div class="reports-grid" id="reportsGrid">
                    @foreach($reportes as $r)
                    @php
                        $apoyos = $r->apoyos->count();
                        
                        if($apoyos < 4){
                            $nivel = "Baja Prioridad";
                            $color = "low-priority";
                            $priorityClass = "low";
                        }elseif($apoyos <= 8){
                            $nivel = "Prioridad Media";
                            $color = "medium-priority";
                            $priorityClass = "medium";
                        }else{
                            $nivel = "Alta Prioridad";
                            $color = "high-priority";
                            $priorityClass = "high";
                        }
                    @endphp
                    
                    <div class="report-card {{ $color }}" data-status="{{ $r->estado }}">
                        <div class="report-header">
                            <div class="report-meta">
                                <div class="category-badge">
                                    @switch($r->categoria)
                                        @case('areas_verdes')
                                            <i class="bi bi-tree-fill"></i> Áreas Verdes
                                            @break
                                        @case('calles')
                                            <i class="bi bi-road-fill"></i> Calles
                                            @break
                                        @case('fugas')
                                            <i class="bi bi-droplet-fill"></i> Fugas
                                            @break
                                        @case('alumbrado')
                                            <i class="bi bi-lightbulb-fill"></i> Alumbrado
                                            @break
                                        @default
                                            {{ $r->categoria }}
                                    @endswitch
                                </div>
                                <div class="priority-badge {{ $priorityClass }}">
                                    {{ $nivel }}
                                </div>
                            </div>
                            
                            <div class="report-author">
                                <div class="author-avatar">
                                    {{ substr($r->usuario->nombre, 0, 1) }}
                                </div>
                                <div class="author-info">
                                    <p class="author-name">{{ $r->usuario->nombre }}</p>
                                    <p class="supports-count">
                                        <i class="bi bi-hand-thumbs-up-fill me-1"></i>
                                        {{ $apoyos }} apoyos
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="report-info">
                            <div class="report-status status-{{ str_replace('_', '-', $r->estado) }}">
                                @switch($r->estado)
                                    @case('pendiente')
                                        <i class="bi bi-clock-fill"></i> Pendiente
                                        @break
                                    @case('en_proceso')
                                        <i class="bi bi-arrow-repeat-fill"></i> En Proceso
                                        @break
                                    @case('finalizado')
                                        <i class="bi bi-check-circle-fill"></i> Finalizado
                                        @break
                                @endswitch
                            </div>
                            
                            <div class="report-actions">
                                <a href="/reporte/{{ $r->id }}" class="btn-view">
                                    <i class="bi bi-eye-fill"></i>
                                    Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterReports(status) {
            const reports = document.querySelectorAll('.report-card');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Update active button
            buttons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.textContent.toLowerCase().includes(status) || 
                    (status === 'all' && btn.textContent === 'Todos')) {
                    btn.classList.add('active');
                }
            });
            
            // Filter reports
            reports.forEach(report => {
                if (status === 'all') {
                    report.style.display = 'block';
                } else {
                    const reportStatus = report.getAttribute('data-status');
                    report.style.display = reportStatus === status ? 'block' : 'none';
                }
            });
        }
    </script>
    <script src="/notificaciones.js"></script>
</body>
</html>