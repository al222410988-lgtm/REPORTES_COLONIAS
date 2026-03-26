<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homeLY - Nuevo Reporte</title>
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

        .form-container {
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

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .section-label {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        .form-select {
            cursor: pointer;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            cursor: pointer;
            width: 100%;
        }

        .file-upload input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.8);
            border: 2px dashed rgba(102, 126, 234, 0.3);
            border-radius: 15px;
            color: #6c757d;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-label:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: #667eea;
            color: #667eea;
        }

        .location-controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-input {
            flex: 1;
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }

        .search-input input {
            padding-left: 3rem;
        }

        .btn-location {
            background: var(--success-gradient);
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-location:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 172, 254, 0.4);
            color: white;
        }

        #map {
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        .map-info {
            background: rgba(102, 126, 234, 0.1);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-submit {
            background: var(--success-gradient);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            flex: 1;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(79, 172, 254, 0.4);
        }

        .btn-cancel {
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
            border: 2px solid rgba(108, 117, 125, 0.2);
            padding: 1rem 2rem;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .btn-cancel:hover {
            background: rgba(108, 117, 125, 0.2);
            color: #495057;
            transform: translateY(-2px);
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

            .form-container {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .location-controls {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo-section">
                <h1>homeLY</h1>
                <p>Crear nuevo reporte comunitario</p>
            </div>
            <a href="/dashboard" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Volver al Dashboard
            </a>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h2 class="section-title">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Nuevo Reporte
            </h2>

            <form method="POST" action="/reporte/guardar" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                
                <div class="form-grid">
                    <div class="form-section">
                        <h3 class="section-label">
                            <i class="bi bi-info-circle-fill"></i>
                            Información del Reporte
                        </h3>
                        
                        <div class="form-floating">
                            <select class="form-select" name="categoria" id="categoria" required>
                                <option value="">Selecciona una categoría</option>
                                <option value="areas_verdes">Áreas Verdes</option>
                                <option value="calles">Calles</option>
                                <option value="fugas">Fugas</option>
                                <option value="alumbrado">Alumbrado</option>
                            </select>
                            <label for="categoria">Categoría</label>
                        </div>

                        <div class="form-floating">
                            <textarea class="form-control" 
                                      name="descripcion" 
                                      id="descripcion" 
                                      placeholder="Describe el problema..."
                                      style="height: 120px; resize: none;"
                                      required></textarea>
                            <label for="descripcion">Descripción detallada</label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-image-fill me-2"></i>
                                Evidencia fotográfica (opcional)
                            </label>
                            <div class="file-upload">
                                <input type="file" name="imagen" id="imagen" accept="image/*">
                                <label for="imagen" class="file-upload-label">
                                    <i class="bi bi-cloud-upload-fill"></i>
                                    <span id="file-name">Seleccionar imagen</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="section-label">
                            <i class="bi bi-geo-alt-fill"></i>
                            Ubicación del Problema
                        </h3>
                        
                        <div class="location-controls">
                            <div class="search-input">
                                <span class="search-icon">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       id="buscar" 
                                       placeholder="Buscar dirección...">
                            </div>
                            <button type="button" class="btn-location" onclick="buscarDireccion()">
                                <i class="bi bi-search"></i>
                                Buscar
                            </button>
                        </div>

                        <button type="button" class="btn-location w-100 mb-3" onclick="miUbicacion()">
                            <i class="bi bi-geo-alt-fill"></i>
                            Usar mi ubicación actual
                        </button>

                        <div id="map"></div>
                        
                        <div class="map-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Tip:</strong> Haz clic en el mapa para seleccionar la ubicación exacta del problema.
                        </div>
                    </div>
                </div>

                <input type="hidden" id="latitud" name="latitud">
                <input type="hidden" id="longitud" name="longitud">
                <input type="hidden" id="direccion" name="direccion">

                <div class="action-buttons">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Enviar Reporte
                    </button>
                    <a href="/dashboard" class="btn-cancel">
                        <i class="bi bi-x-circle me-2"></i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // File upload label update
        document.getElementById('imagen').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Seleccionar imagen';
            document.getElementById('file-name').textContent = fileName;
        });

        // Initialize map
        var map = L.map('map').setView([19.4326, -99.1332], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ' OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        // Map click handler
        map.on('click', function(e) {
            let lat = e.latlng.lat;
            let lng = e.latlng.lng;

            document.getElementById('latitud').value = lat;
            document.getElementById('longitud').value = lng;

            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);

            // Reverse geocoding
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(r => r.json())
                .then(data => {
                    document.getElementById('direccion').value = data.display_name;
                })
                .catch(err => {
                    console.error('Error getting address:', err);
                });
        });

        // Search address function
        function buscarDireccion() {
            let query = document.getElementById('buscar').value;
            if (!query) {
                alert('Por favor ingresa una dirección para buscar');
                return;
            }

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        let lat = parseFloat(data[0].lat);
                        let lon = parseFloat(data[0].lon);

                        map.setView([lat, lon], 15);

                        if (marker) map.removeLayer(marker);
                        marker = L.marker([lat, lon]).addTo(map);

                        document.getElementById('latitud').value = lat;
                        document.getElementById('longitud').value = lon;
                        document.getElementById('direccion').value = data[0].display_name;
                    } else {
                        alert('No se encontró la dirección. Intenta con una búsqueda más específica.');
                    }
                })
                .catch(err => {
                    console.error('Error searching address:', err);
                    alert('Error al buscar la dirección. Intenta de nuevo.');
                });
        }

        // Get current location function
        function miUbicacion() {
            if (!navigator.geolocation) {
                alert('Tu navegador no soporta geolocalización');
                return;
            }

            // Show loading state
            const btn = event.target;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Obteniendo ubicación...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    let lat = position.coords.latitude;
                    let lng = position.coords.longitude;

                    map.setView([lat, lng], 15);

                    if (marker) map.removeLayer(marker);
                    marker = L.marker([lat, lng]).addTo(map);

                    document.getElementById('latitud').value = lat;
                    document.getElementById('longitud').value = lng;

                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById('direccion').value = data.display_name;
                            document.getElementById('buscar').value = data.display_name;
                        })
                        .catch(err => {
                            console.error('Error getting address:', err);
                        });

                    // Reset button
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                },
                function(error) {
                    console.error('Geolocation error:', error);
                    alert('No se pudo obtener tu ubicación. Asegúrate de haber dado permiso de ubicación.');
                    
                    // Reset button
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            );
        }

        // Enter key handler for search
        document.getElementById('buscar').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                buscarDireccion();
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\52722\homeLY\resources\views/crear_reporte.blade.php ENDPATH**/ ?>