class NotificacionManager {
    constructor() {
        this.notificaciones = [];
        this.noLeidas = 0;
        this.intervalo = null;
        this.contenedor = null;
        this.botonNotificaciones = null;
        this.contadorNotificaciones = null;
        this.init();
    }

    init() {
        // Crear contenedor de notificaciones si no existe
        this.crearContenedorNotificaciones();
        
        // Iniciar polling para verificar nuevas notificaciones
        this.iniciarPolling();
        
        // Cargar notificaciones iniciales
        this.cargarNotificaciones();
    }

    crearContenedorNotificaciones() {
        // Buscar o crear el botón de notificaciones
        this.botonNotificaciones = document.querySelector('.notification-bell');
        if (!this.botonNotificaciones) {
            console.warn('Botón de notificaciones no encontrado');
            return;
        }

        // Crear contador de notificaciones
        this.contadorNotificaciones = document.querySelector('.notification-count');
        if (!this.contadorNotificaciones) {
            this.contadorNotificaciones = document.createElement('span');
            this.contadorNotificaciones.className = 'notification-count';
            this.contadorNotificaciones.style.display = 'none';
            this.botonNotificaciones.appendChild(this.contadorNotificaciones);
        }

        // Crear dropdown de notificaciones
        this.contenedor = document.createElement('div');
        this.contenedor.className = 'notification-dropdown';
        this.contenedor.innerHTML = `
            <div class="notification-header">
                <h6>Notificaciones</h6>
                <button class="btn btn-sm btn-link mark-all-read">Marcar todas como leídas</button>
            </div>
            <div class="notification-list">
                <div class="notification-loading">Cargando...</div>
            </div>
        `;

        // Agregar al body o al contenedor padre
        document.body.appendChild(this.contenedor);

        // Event listeners
        this.botonNotificaciones.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggleDropdown();
        });

        // Marcar todas como leídas
        this.contenedor.querySelector('.mark-all-read').addEventListener('click', () => {
            this.marcarTodasLeidas();
        });

        // Cerrar dropdown al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!this.contenedor.contains(e.target) && !this.botonNotificaciones.contains(e.target)) {
                this.cerrarDropdown();
            }
        });
    }

    iniciarPolling() {
        // Verificar nuevas notificaciones cada 30 segundos
        this.intervalo = setInterval(() => {
            this.verificarNuevasNotificaciones();
        }, 30000);
    }

    async cargarNotificaciones() {
        try {
            const response = await fetch('/api/notificaciones');
            const data = await response.json();
            
            this.notificaciones = data.notificaciones;
            this.noLeidas = data.no_leidas;
            
            this.actualizarContador();
            this.renderizarNotificaciones();
        } catch (error) {
            console.error('Error cargando notificaciones:', error);
        }
    }

    async verificarNuevasNotificaciones() {
        try {
            const response = await fetch('/api/notificaciones/no-leidas');
            const data = await response.json();
            
            if (data.count !== this.noLeidas) {
                this.noLeidas = data.count;
                this.actualizarContador();
                
                if (data.count > 0) {
                    this.mostrarNotificacionNueva();
                }
                
                // Recargar notificaciones si hay nuevas
                await this.cargarNotificaciones();
            }
        } catch (error) {
            console.error('Error verificando notificaciones:', error);
        }
    }

    actualizarContador() {
        if (this.contadorNotificaciones) {
            if (this.noLeidas > 0) {
                this.contadorNotificaciones.textContent = this.noLeidas > 99 ? '99+' : this.noLeidas;
                this.contadorNotificaciones.style.display = 'flex';
                this.botonNotificaciones.classList.add('has-notifications');
            } else {
                this.contadorNotificaciones.style.display = 'none';
                this.botonNotificaciones.classList.remove('has-notifications');
            }
        }
    }

    renderizarNotificaciones() {
        const lista = this.contenedor.querySelector('.notification-list');
        
        if (this.notificaciones.length === 0) {
            lista.innerHTML = `
                <div class="notification-empty">
                    <i class="bi bi-bell-slash"></i>
                    <p>No tienes notificaciones</p>
                </div>
            `;
            return;
        }

        lista.innerHTML = this.notificaciones.map(notif => `
            <div class="notification-item ${!notif.leida ? 'unread' : ''}" data-id="${notif.id}">
                <div class="notification-icon">
                    ${this.getIconoPorTipo(notif.tipo)}
                </div>
                <div class="notification-content">
                    <div class="notification-title">${notif.titulo}</div>
                    <div class="notification-message">${notif.mensaje}</div>
                    <div class="notification-time">${this.formatearTiempo(notif.created_at)}</div>
                </div>
                <div class="notification-actions">
                    ${!notif.leida ? `
                        <button class="btn btn-sm btn-link mark-read" data-id="${notif.id}">
                            <i class="bi bi-check2"></i>
                        </button>
                    ` : ''}
                    <button class="btn btn-sm btn-link delete-notification" data-id="${notif.id}">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
        `).join('');

        // Agregar event listeners a las acciones
        lista.querySelectorAll('.mark-read').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                this.marcarComoLeida(btn.dataset.id);
            });
        });

        lista.querySelectorAll('.delete-notification').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                this.eliminarNotificacion(btn.dataset.id);
            });
        });

        lista.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', () => {
                if (!item.classList.contains('unread')) return;
                
                const id = item.dataset.id;
                this.marcarComoLeida(id);
                
                // Navegar al reporte si aplica
                const datos = this.notificaciones.find(n => n.id == id)?.datos_adicionales;
                if (datos && datos.reporte_id) {
                    window.location.href = `/reporte/${datos.reporte_id}`;
                }
            });
        });
    }

    getIconoPorTipo(tipo) {
        const iconos = {
            'info': '<i class="bi bi-info-circle-fill text-info"></i>',
            'success': '<i class="bi bi-check-circle-fill text-success"></i>',
            'warning': '<i class="bi bi-exclamation-triangle-fill text-warning"></i>',
            'error': '<i class="bi bi-x-circle-fill text-danger"></i>',
            'urgent': '<i class="bi bi-exclamation-octagon-fill text-danger"></i>'
        };
        return iconos[tipo] || iconos['info'];
    }

    formatearTiempo(fecha) {
        const ahora = new Date();
        const fechaNotif = new Date(fecha);
        const diff = ahora - fechaNotif;
        
        const minutos = Math.floor(diff / 60000);
        const horas = Math.floor(diff / 3600000);
        const dias = Math.floor(diff / 86400000);
        
        if (minutos < 1) return 'Ahora';
        if (minutos < 60) return `Hace ${minutos} min`;
        if (horas < 24) return `Hace ${horas} h`;
        if (dias < 7) return `Hace ${dias} d`;
        
        return fechaNotif.toLocaleDateString('es-ES');
    }

    toggleDropdown() {
        this.contenedor.classList.toggle('show');
        if (this.contenedor.classList.contains('show')) {
            // Posicionar dropdown
            const rect = this.botonNotificaciones.getBoundingClientRect();
            this.contenedor.style.top = rect.bottom + 10 + 'px';
            this.contenedor.style.right = window.innerWidth - rect.right + 'px';
        }
    }

    cerrarDropdown() {
        this.contenedor.classList.remove('show');
    }

    async marcarComoLeida(id) {
        try {
            const response = await fetch(`/api/notificaciones/${id}/leida`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                }
            });
            
            if (response.ok) {
                const notificacion = this.notificaciones.find(n => n.id == id);
                if (notificacion) {
                    notificacion.leida = true;
                    notificacion.fecha_leida = new Date();
                    this.noLeidas--;
                    this.actualizarContador();
                    this.renderizarNotificaciones();
                }
            }
        } catch (error) {
            console.error('Error marcando notificación como leída:', error);
        }
    }

    async marcarTodasLeidas() {
        try {
            const response = await fetch('/api/notificaciones/todas-leidas', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                }
            });
            
            if (response.ok) {
                this.notificaciones.forEach(n => {
                    n.leida = true;
                    n.fecha_leida = new Date();
                });
                this.noLeidas = 0;
                this.actualizarContador();
                this.renderizarNotificaciones();
            }
        } catch (error) {
            console.error('Error marcando todas como leídas:', error);
        }
    }

    async eliminarNotificacion(id) {
        try {
            const response = await fetch(`/api/notificaciones/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                }
            });
            
            if (response.ok) {
                const index = this.notificaciones.findIndex(n => n.id == id);
                if (index !== -1) {
                    const notificacion = this.notificaciones[index];
                    if (!notificacion.leida) {
                        this.noLeidas--;
                    }
                    this.notificaciones.splice(index, 1);
                    this.actualizarContador();
                    this.renderizarNotificaciones();
                }
            }
        } catch (error) {
            console.error('Error eliminando notificación:', error);
        }
    }

    mostrarNotificacionNueva() {
        // Mostrar una notificación del navegador si está disponible
        if ('Notification' in window && Notification.permission === 'granted') {
            new Notification('homeLY - Nueva Notificación', {
                body: 'Tienes nuevas notificaciones pendientes',
                icon: '/icon.png'
            });
        }
    }

    // Método estático para enviar notificaciones desde otros componentes
    static enviarNotificacion(titulo, mensaje, tipo = 'info', datos = null) {
        // Este método puede ser usado por otros componentes para enviar notificaciones
        console.log('Notificación:', { titulo, mensaje, tipo, datos });
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    if (window.notificacionManager) {
        window.notificacionManager.destroy();
    }
    window.notificacionManager = new NotificacionManager();
});

// Solicitar permiso para notificaciones del navegador
if ('Notification' in window && Notification.permission === 'default') {
    Notification.requestPermission();
}
