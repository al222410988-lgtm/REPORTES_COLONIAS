<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homeLY - Detalle del Reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
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

        .detail-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out 0.2s both;
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

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .category-badge {
            background: var(--primary-gradient);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-badge {
            background: var(--success-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .description-section {
            background: rgba(102, 126, 234, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 4px solid #667eea;
        }

        .description-text {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #333;
        }

        .images-section {
            margin-bottom: 2rem;
        }

        .image-container {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .image-label {
            font-weight: 600;
            color: #667eea;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .supporters-section {
            background: rgba(250, 112, 154, 0.05);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 4px solid #fa709a;
        }

        .supporters-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .supporter-badge {
            background: var(--warning-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .supporter-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(250, 112, 154, 0.4);
        }

        #map {
            height: 300px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateX(5px);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 600;
            color: #333;
        }

        .admin-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .admin-header {
            background: var(--dark-gradient);
            color: white;
            padding: 1.5rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(102, 126, 234, 0.2);
            border-radius: 15px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            height: auto;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            outline: none;
        }

        .btn-update {
            background: var(--success-gradient);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-update::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-update:hover::before {
            left: 100%;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(79, 172, 254, 0.4);
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

            .detail-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .main-content, .info-card, .admin-panel {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }

            .report-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo-section">
                <h1>homeLY</h1>
                <p>Detalle del Reporte Comunitario</p>
            </div>
            <a href="/dashboard" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Volver al Dashboard
            </a>
        </div>
    </header>

    <div class="container">
        <div class="detail-container">
            <div class="main-content">
                <div class="report-header">
                    <div class="category-badge">
                        <?php switch($reporte->categoria):
                            case ('areas_verdes'): ?>
                                <i class="bi bi-tree-fill"></i> Áreas Verdes
                                <?php break; ?>
                            <?php case ('calles'): ?>
                                <i class="bi bi-road-fill"></i> Calles
                                <?php break; ?>
                            <?php case ('fugas'): ?>
                                <i class="bi bi-droplet-fill"></i> Fugas
                                <?php break; ?>
                            <?php case ('alumbrado'): ?>
                                <i class="bi bi-lightbulb-fill"></i> Alumbrado
                                <?php break; ?>
                            <?php default: ?>
                                <?php echo e($reporte->categoria); ?>

                        <?php endswitch; ?>
                    </div>
                    <div class="status-badge">
                        <i class="bi bi-clock-fill me-1"></i>
                        <?php echo e($reporte->estado); ?>

                    </div>
                </div>

                <div class="description-section">
                    <h3 class="mb-3">
                        <i class="bi bi-text-paragraph me-2"></i>
                        Descripción del Problema
                    </h3>
                    <p class="description-text"><?php echo e($reporte->descripcion); ?></p>
                </div>

                <?php if($reporte->imagen_problema): ?>
                <div class="images-section">
                    <div class="image-label">
                        <i class="bi bi-image-fill"></i>
                        Evidencia del Problema
                    </div>
                    <div class="image-container">
                        <img src="/storage/<?php echo e($reporte->imagen_problema); ?>" alt="Evidencia del problema" class="img-fluid">
                    </div>
                </div>
                <?php endif; ?>

                <?php if($reporte->imagen_solucion): ?>
                <div class="images-section">
                    <div class="image-label">
                        <i class="bi bi-check-circle-fill"></i>
                        Evidencia de la Solución
                    </div>
                    <div class="image-container">
                        <img src="/storage/<?php echo e($reporte->imagen_solucion); ?>" alt="Evidencia de la solución" class="img-fluid">
                    </div>
                </div>
                <?php endif; ?>

                <?php if($reporte->usuariosApoyo && $reporte->usuariosApoyo->count() > 0): ?>
                <div class="supporters-section">
                    <h3 class="mb-3">
                        <i class="bi bi-people-fill me-2"></i>
                        Personas que Apoyan este Reporte
                    </h3>
                    <div class="supporters-grid">
                        <?php $__currentLoopData = $reporte->usuariosApoyo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="supporter-badge">
                            <i class="bi bi-person-fill"></i>
                            <?php echo e($u->nombre); ?>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="mt-4">
                    <h3 class="mb-3">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        Ubicación del Reporte
                    </h3>
                    <div id="map"></div>
                </div>
            </div>

            <div class="sidebar">
                <div class="info-card">
                    <h3 class="mb-4">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Información del Reporte
                    </h3>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Reportado por</div>
                            <div class="info-value"><?php echo e($reporte->usuario->nombre); ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-calendar-fill"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Fecha del reporte</div>
                            <div class="info-value"><?php echo e($reporte->created_at->format('d/m/Y H:i')); ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-geo-fill"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Dirección</div>
                            <div class="info-value"><?php echo e($reporte->direccion); ?></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Total de apoyos</div>
                            <div class="info-value"><?php echo e($reporte->usuariosApoyo->count()); ?> personas</div>
                        </div>
                    </div>

                    <?php if($reporte->admin): ?>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-shield-check-fill"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Atendido por</div>
                            <div class="info-value"><?php echo e($reporte->admin->nombre); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- 🔥 PANEL ADMIN -->
        <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->rol == 'admin' || Auth::user()->rol == 'superadmin'): ?>
        <div class="admin-panel">
            <div class="admin-header">
                <h3 class="mb-0">
                    <i class="bi bi-gear-fill me-2"></i>
                    Panel de Administración
                </h3>
            </div>

            <form method="POST" action="/reporte/actualizar/<?php echo e($reporte->id); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                
                <div class="form-floating">
                    <select class="form-select" name="estado" id="estado">
                        <option value="pendiente" <?php echo e($reporte->estado == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                        <option value="en_proceso" <?php echo e($reporte->estado == 'en_proceso' ? 'selected' : ''); ?>>En proceso</option>
                        <option value="finalizado" <?php echo e($reporte->estado == 'finalizado' ? 'selected' : ''); ?>>Finalizado</option>
                    </select>
                    <label for="estado">Estado del Reporte</label>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" 
                              name="mensaje_admin" 
                              id="mensaje_admin" 
                              placeholder="Mensaje para el ciudadano..."
                              style="height: 120px; resize: none;"><?php echo e($reporte->mensaje_admin ?? ''); ?></textarea>
                    <label for="mensaje_admin">Mensaje para el ciudadano</label>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-image-fill me-2"></i>
                        Evidencia de solución (opcional)
                    </label>
                    <input type="file" name="imagen_solucion" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn-update">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Actualizar Reporte
                </button>
            </form>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([<?php echo e($reporte->latitud); ?>, <?php echo e($reporte->longitud); ?>], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([<?php echo e($reporte->latitud); ?>, <?php echo e($reporte->longitud); ?>]).addTo(map);
        
        // Add popup with address
        marker.bindPopup('<b><?php echo e($reporte->categoria); ?></b><br><?php echo e($reporte->direccion); ?>').openPopup();
    </script>
</body>
</html><?php /**PATH C:\Users\52722\homeLY\resources\views/detalle_reporte.blade.php ENDPATH**/ ?>