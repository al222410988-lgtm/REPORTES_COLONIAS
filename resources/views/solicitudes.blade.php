<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homeLY - Solicitudes de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        .back-btn {
            background: var(--dark-gradient);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(51, 8, 103, 0.4);
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem 2rem;
        }

        .requests-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out;
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

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            background: rgba(102, 126, 234, 0.05);
        }

        .stat-icon {
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

        .requests-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .request-card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
            border-left: 4px solid;
        }

        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .request-card.pending {
            border-left-color: #ffc107;
        }

        .request-header {
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(102, 126, 234, 0.1);
        }

        .request-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .request-date {
            color: #6c757d;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
            background: var(--warning-gradient);
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--success-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: #333;
            margin: 0;
            font-size: 1rem;
        }

        .user-email {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .request-actions {
            padding: 1.5rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-approve {
            background: var(--success-gradient);
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
        }

        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.4);
            color: white;
        }

        .btn-reject {
            background: var(--danger-gradient);
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
        }

        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(238, 90, 36, 0.4);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 2rem;
            border-radius: 50%;
            background: rgba(102, 126, 234, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #667eea;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }

        .empty-description {
            color: #6c757d;
            font-size: 1.1rem;
            line-height: 1.6;
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

            .requests-container {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }

            .section-title {
                font-size: 2rem;
            }

            .stats-overview {
                grid-template-columns: 1fr;
            }

            .requests-grid {
                grid-template-columns: 1fr;
            }

            .request-actions {
                flex-direction: column;
                gap: 0.75rem;
            }

            .btn-approve, .btn-reject {
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
                <p>Solicitudes de Usuarios</p>
            </div>
            <a href="/dashboard" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Volver al Panel
            </a>
        </div>
    </header>

    <div class="container">
        <div class="requests-container">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="bi bi-person-check-fill me-2"></i>
                    Solicitudes de Usuarios
                </h2>
                <p class="section-subtitle">Revisa y aprueba las solicitudes de usuarios que desean ser administradores</p>
            </div>

            @if($usuarios && $usuarios->count() > 0)
            <div class="stats-overview">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="stat-number">{{ $usuarios->count() }}</div>
                    <div class="stat-label">Total de Solicitudes</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div class="stat-number">{{ $usuarios->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                    <div class="stat-label">Esta Semana</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-fill"></i>
                    </div>
                    <div class="stat-number">{{ $usuarios->where('created_at', '>=', now()->subDays(1))->count() }}</div>
                    <div class="stat-label">Hoy</div>
                </div>
            </div>

            <div class="requests-grid">
                @foreach($usuarios as $u)
                <div class="request-card pending">
                    <div class="request-header">
                        <div class="request-meta">
                            <div class="request-date">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $u->created_at->format('d/m/Y H:i') }}
                            </div>
                            <div class="status-badge">
                                <i class="bi bi-hourglass-split me-1"></i>
                                Pendiente
                            </div>
                        </div>
                        
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ substr($u->nombre, 0, 1) }}
                            </div>
                            <div class="user-details">
                                <p class="user-name">{{ $u->nombre }}</p>
                                <p class="user-email">{{ $u->email }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="request-actions">
                        <a href="/admin/aprobar/{{ $u->id }}" class="btn-approve">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Aprobar Solicitud
                        </a>
                        
                        <a href="/admin/rechazar/{{ $u->id }}" class="btn-reject" 
                           onclick="return confirm('¿Estás seguro de que deseas rechazar esta solicitud?')">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            Rechazar
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-inbox-fill"></i>
                </div>
                <h3 class="empty-title">No hay solicitudes pendientes</h3>
                <p class="empty-description">
                    No hay solicitudes de usuarios pendientes en este momento. 
                    Cuando un usuario solicite acceso administrativo, aparecerá aquí para tu revisión.
                </p>
                <a href="/dashboard" class="btn-approve" style="margin-top: 2rem;">
                    <i class="bi bi-house-fill me-2"></i>
                    Volver al Panel
                </a>
            </div>
            @endif
        </div>
    </div>
</body>
</html>