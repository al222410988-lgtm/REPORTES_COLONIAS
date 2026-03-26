<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homeLY - Mi Perfil</title>
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

        .profile-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
        }

        /* SECCIÓN IZQUIERDA - INFORMACIÓN PERSONAL */
        .profile-info-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out;
            height: fit-content;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            font-weight: 700;
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
            animation: pulse 2s infinite;
            position: relative;
        }

        .profile-avatar::after {
            content: '';
            position: absolute;
            top: -5px;
            right: -5px;
            width: 25px;
            height: 25px;
            background: var(--success-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            color: white;
            animation: checkPulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes checkPulse {
            0% { transform: scale(0.8); opacity: 0.8; }
            50% { transform: scale(1); opacity: 1; }
            100% { transform: scale(0.8); opacity: 0.8; }
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .profile-role {
            display: inline-block;
            background: var(--success-gradient);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }

        .profile-stats {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 2rem;
        }

        .stat-item {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .stat-item:hover::before {
            left: 100%;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.2);
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .update-restriction {
            background: linear-gradient(135deg, rgba(250, 112, 154, 0.1) 0%, rgba(255, 193, 7, 0.1) 100%);
            border: 1px solid rgba(250, 112, 154, 0.2);
            border-radius: 15px;
            padding: 1rem;
            margin-top: 2rem;
            text-align: center;
            animation: slideDown 0.5s ease-out;
        }

        .update-restriction i {
            color: #fa709a;
            font-size: 1.1rem;
            margin-right: 0.5rem;
        }

        .update-restriction-text {
            color: #856404;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* SECCIÓN DERECHA - FORMULARIO DE EDICIÓN */
        .profile-edit-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.8s ease-out 0.2s both;
            height: fit-content;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            border: 2px solid rgba(102, 126, 234, 0.1);
            border-radius: 15px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
            outline: none;
        }

        .form-control:disabled {
            background: rgba(248, 249, 250, 0.8);
            border-color: rgba(206, 212, 218, 0.3);
            color: #6c757d;
            cursor: not-allowed;
        }

        .form-floating label {
            color: #6c757d;
            font-weight: 500;
            padding: 1rem 1.25rem;
        }

        .form-floating .form-control:focus ~ label {
            color: #667eea;
        }

        .btn-save {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .btn-save::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-save:hover::before {
            left: 100%;
        }

        .btn-save:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-save:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
        }

        .btn-back {
            background: var(--dark-gradient);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .btn-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-back:hover::before {
            left: 100%;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(51, 8, 103, 0.4);
            color: white;
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

        .alert-warning {
            background: rgba(255, 193, 7, 0.9);
            color: #856404;
        }

        .alert-info {
            background: rgba(23, 162, 184, 0.9);
            color: white;
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

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .profile-info-section, .profile-edit-section {
                padding: 2rem;
            }
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 0 1rem;
            }

            .profile-info-section, .profile-edit-section {
                padding: 1.5rem;
                border-radius: 20px;
            }

            .profile-header {
                margin-bottom: 2rem;
            }

            .profile-name {
                font-size: 1.5rem;
            }

            .section-title {
                font-size: 1.4rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="profile-container">
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('warning') }}
            </div>
        @endif

        <!-- SECCIÓN IZQUIERDA - INFORMACIÓN PERSONAL -->
        <div class="profile-info-section">
            <div class="profile-header">
                <div class="profile-avatar">
                    {{ substr(auth()->user()->nombre, 0, 1) }}
                </div>
                <h1 class="profile-name">{{ auth()->user()->nombre }}</h1>
                <div class="profile-role">
                    @if(auth()->user()->rol == 'admin')
                        <i class="bi bi-shield-fill me-1"></i>Administrador
                    @elseif(auth()->user()->rol == 'superadmin')
                        <i class="bi bi-shield-fill me-1"></i>Super Administrador
                    @else
                        <i class="bi bi-person-fill me-1"></i>Residente
                    @endif
                </div>
            </div>
            
            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-clipboard-data-fill"></i>
                    </div>
                    <div class="stat-number">{{ auth()->user()->reportes->count() ?? 0 }}</div>
                    <div class="stat-label">Reportes Creados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                    </div>
                    <div class="stat-number">{{ auth()->user()->apoyos->count() ?? 0 }}</div>
                    <div class="stat-label">Apoyos Dados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <div class="stat-number">{{ auth()->user()->created_at->format('d/m/Y') }}</div>
                    <div class="stat-label">Miembro Desde</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div class="stat-number">{{ auth()->user()->email }}</div>
                    <div class="stat-label">Correo Electrónico</div>
                </div>
            </div>

            @if($puedeActualizar)
                <div class="update-restriction">
                    <i class="bi bi-info-circle-fill"></i>
                    <div class="update-restriction-text">
                        Podrás actualizar tus datos nuevamente el <strong>{{ $siguienteActualizacion->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
            @endif
        </div>

        <!-- SECCIÓN DERECHA - FORMULARIO DE EDICIÓN -->
        <div class="profile-edit-section">
            <h2 class="section-title">
                <i class="bi bi-gear-fill"></i>
                Configuración de Cuenta
            </h2>

            <a href="{{ auth()->user()->rol == 'admin' || auth()->user()->rol == 'superadmin' ? '/admin/dashboard' : '/dashboard' }}" class="btn-back">
                <i class="bi bi-house-fill"></i>
                Volver al inicio
            </a>

            @if($puedeActualizar)
                <form method="POST" action="/perfil/actualizar">
                    @csrf
                    
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        <label for="email">
                            <i class="bi bi-envelope-fill me-2"></i>Correo electrónico
                        </label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="password_actual" name="password_actual" placeholder="Contraseña actual">
                        <label for="password_actual">
                            <i class="bi bi-lock-fill me-2"></i>Contraseña actual
                        </label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="password_nuevo" name="password_nuevo" placeholder="Nueva contraseña">
                        <label for="password_nuevo">
                            <i class="bi bi-shield-lock-fill me-2"></i>Nueva contraseña
                        </label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="password_confirmacion" name="password_confirmacion" placeholder="Confirmar nueva contraseña">
                        <label for="password_confirmacion">
                            <i class="bi bi-shield-check-fill me-2"></i>Confirmar nueva contraseña
                        </label>
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Guardar Cambios
                    </button>
                </form>
            @else
                <div class="update-restriction">
                    <i class="bi bi-clock-fill"></i>
                    <div class="update-restriction-text">
                        <strong>Actualización restringida</strong><br>
                        Solo puedes actualizar tus datos una vez cada 30 días.<br>
                        Próxima actualización disponible: <strong>{{ $siguienteActualizacion->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
