<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homeLY - Estadísticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/notificaciones.css">
    <link rel="stylesheet" href="/analytics.css">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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

        .analytics-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .analytics-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .analytics-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .analytics-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }

        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .chart-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out;
            transition: all 0.3s ease;
        }

        .chart-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        .chart-header {
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-title i {
            color: #667eea;
        }

        .chart-description {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .insights-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .insight-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .insight-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .insight-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .insight-icon.high {
            background: var(--danger-gradient);
        }

        .insight-icon.medium {
            background: var(--warning-gradient);
        }

        .insight-icon.low {
            background: var(--success-gradient);
        }

        .insight-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .insight-content p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
            line-height: 1.5;
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

            .analytics-container {
                padding: 0 1rem;
            }

            .analytics-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .chart-card {
                padding: 1.5rem;
            }

            .chart-container {
                height: 250px;
            }

            .insights-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo-section">
                <h1>homeLY</h1>
                <p>Estadísticas y Análisis</p>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div class="notification-bell">
                    <i class="bi bi-bell-fill" style="font-size: 1.2rem;"></i>
                </div>
                <a href="/perfil" class="user-info">
                    <div class="user-avatar">
                        <?php echo e(substr(auth()->user()->nombre, 0, 1)); ?>

                    </div>
                    <div>
                        <div class="fw-semibold"><?php echo e(auth()->user()->nombre); ?></div>
                        <small class="text-muted"><?php echo e(auth()->user()->rol == 'admin' ? 'Administrador' : 'Super Admin'); ?></small>
                    </div>
                </a>
                <form method="POST" action="/logout">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Salir
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="analytics-container">
        <div class="analytics-header">
            <h1 class="analytics-title">
                <i class="bi bi-graph-up"></i>
                Estadísticas de Reportes
            </h1>
            <p class="analytics-subtitle">Análisis detallado de la actividad comunitaria</p>
        </div>

        <!-- GRÁFICOS PRINCIPALES -->
        <div class="analytics-grid">
            <!-- GRÁFICO DE CATEGORÍAS -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="bi bi-pie-chart-fill"></i>
                        Reportes por Categoría
                    </h3>
                    <p class="chart-description">Distribución de reportes según tipo de problema</p>
                </div>
                <div class="chart-container">
                    <canvas id="chartCategorias"></canvas>
                </div>
            </div>

            <!-- GRÁFICO DE ESTADOS -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="bi bi-bar-chart-fill"></i>
                        Reportes por Estado
                    </h3>
                    <p class="chart-description">Estado actual de todos los reportes</p>
                </div>
                <div class="chart-container">
                    <canvas id="chartEstados"></canvas>
                </div>
            </div>

            <!-- GRÁFICO TEMPORAL -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="bi bi-graph-up-arrow"></i>
                        Evolución Mensual
                    </h3>
                    <p class="chart-description">Tendencia de reportes en los últimos meses</p>
                </div>
                <div class="chart-container">
                    <canvas id="chartMensual"></canvas>
                </div>
            </div>

            <!-- TOP APOYOS -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">
                        <i class="bi bi-trophy-fill"></i>
                        Reportes Más Apoyados
                    </h3>
                    <p class="chart-description">Top 10 reportes con más apoyos</p>
                </div>
                <div class="chart-container">
                    <canvas id="chartApoyos"></canvas>
                </div>
            </div>
        </div>

        <!-- INSIGHTS Y ANÁLISIS -->
        <div class="insights-grid">
            <div class="insight-card">
                <div class="insight-header">
                    <div class="insight-icon high">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="insight-content">
                        <h4>Categoría Crítica</h4>
                        <p id="categoriaCritica">Analizando datos...</p>
                    </div>
                </div>
            </div>

            <div class="insight-card">
                <div class="insight-header">
                    <div class="insight-icon low">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="insight-content">
                        <h4>Categoría Menor</h4>
                        <p id="categoriaMenor">Analizando datos...</p>
                    </div>
                </div>
            </div>

            <div class="insight-card">
                <div class="insight-header">
                    <div class="insight-icon medium">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <div class="insight-content">
                        <h4>Tiempo Promedio de Resolución</h4>
                        <p id="tiempoResolucion">Calculando...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/notificaciones.js"></script>
    <script src="/analytics.js"></script>
</body>
</html>
<?php /**PATH C:\Users\52722\homeLY\resources\views/analytics.blade.php ENDPATH**/ ?>