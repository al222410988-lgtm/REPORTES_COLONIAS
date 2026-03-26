<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homeLY - Notificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        .notifications-container {
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

        .notifications-stats {
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

        .notifications-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .notification-card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            border-left: 4px solid;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .notification-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .notification-card:hover::before {
            left: 100%;
        }

        .notification-card:hover {
            transform: translateX(10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .notification-card.info {
            border-left-color: #667eea;
        }

        .notification-card.warning {
            border-left-color: #fa709a;
        }

        .notification-card.success {
            border-left-color: #4facfe;
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .notification-type {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .notification-type.info {
            background: var(--primary-gradient);
            color: white;
        }

        .notification-type.warning {
            background: var(--warning-gradient);
            color: white;
        }

        .notification-type.success {
            background: var(--success-gradient);
            color: white;
        }

        .notification-time {
            color: #6c757d;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notification-message {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .notification-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-view-report {
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
        }

        .btn-view-report:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(51, 8, 103, 0.4);
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

            .notifications-container {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }

            .section-title {
                font-size: 2rem;
            }

            .notifications-stats {
                grid-template-columns: 1fr;
            }

            .notification-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .notification-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn-view-report {
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
                <p>Centro de Notificaciones</p>
            </div>
            <a href="/dashboard" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Volver al Dashboard
            </a>
        </div>
    </header>

    <div class="container">
        <div class="notifications-container">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="bi bi-bell-fill me-2"></i>
                    Notificaciones
                </h2>
                <p class="section-subtitle">Mantente informado sobre las actualizaciones de tu comunidad</p>
            </div>

            <?php if($notificaciones && $notificaciones->count() > 0): ?>
            <div class="notifications-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div class="stat-number"><?php echo e($notificaciones->count()); ?></div>
                    <div class="stat-label">Total de notificaciones</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stat-number"><?php echo e($notificaciones->where('created_at', '>=', now()->subDays(7))->count()); ?></div>
                    <div class="stat-label">Última semana</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="stat-number"><?php echo e($notificaciones->where('created_at', '>=', now()->subDays(1))->count()); ?></div>
                    <div class="stat-label">Hoy</div>
                </div>
            </div>

            <div class="notifications-list">
                <?php $__currentLoopData = $notificaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="notification-card <?php echo e($index % 3 == 0 ? 'info' : ($index % 3 == 1 ? 'warning' : 'success')); ?>">
                    <div class="notification-header">
                        <div class="notification-type <?php echo e($index % 3 == 0 ? 'info' : ($index % 3 == 1 ? 'warning' : 'success')); ?>">
                            <?php if($index % 3 == 0): ?>
                                <i class="bi bi-info-circle-fill"></i> Información
                            <?php elseif($index % 3 == 1): ?>
                                <i class="bi bi-exclamation-triangle-fill"></i> Alerta
                            <?php else: ?>
                                <i class="bi bi-check-circle-fill"></i> Actualización
                            <?php endif; ?>
                        </div>
                        <div class="notification-time">
                            <i class="bi bi-clock-fill"></i>
                            <?php echo e($n->created_at->diffForHumans()); ?>

                        </div>
                    </div>
                    
                    <div class="notification-message">
                        <?php echo e($n->mensaje); ?>

                    </div>
                    
                    <div class="notification-actions">
                        <a href="/reporte/<?php echo e($n->reporte_id); ?>" class="btn-view-report">
                            <i class="bi bi-eye-fill"></i>
                            Ver Reporte
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-bell-slash-fill"></i>
                </div>
                <h3 class="empty-title">No tienes notificaciones</h3>
                <p class="empty-description">
                    No hay notificaciones nuevas en este momento. Te informaremos cuando haya actualizaciones importantes sobre los reportes de tu comunidad.
                </p>
                <a href="/dashboard" class="btn-view-report" style="margin-top: 2rem;">
                    <i class="bi bi-house-fill"></i>
                    Volver al Dashboard
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\52722\homeLY\resources\views/notificaciones.blade.php ENDPATH**/ ?>