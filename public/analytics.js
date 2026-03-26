class AnalyticsManager {
    constructor() {
        this.charts = {};
        this.colors = {
            primary: '#667eea',
            secondary: '#764ba2',
            success: '#28a745',
            warning: '#ffc107',
            danger: '#dc3545',
            info: '#17a2b8'
        };
        this.init();
    }

    async init() {
        // Esperar a que el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.loadCharts());
        } else {
            this.loadCharts();
        }
    }

    async loadCharts() {
        // Cargar Chart.js si no está disponible
        if (typeof Chart === 'undefined') {
            await this.loadChartJS();
        }

        // Inicializar todos los gráficos
        await this.initReportesPorCategoria();
        await this.initReportesPorEstado();
        await this.initReportesPorMes();
        await this.initApoyosPorReporte();
        await this.initMapaCalor();
        await this.initZonasRiesgo();
    }

    async loadChartJS() {
        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }

    async initReportesPorCategoria() {
        try {
            const response = await fetch('/api/analytics/reportes-por-categoria');
            const data = await response.json();

            const ctx = document.getElementById('chartCategorias');
            if (!ctx) return;

            this.charts.categorias = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.data,
                        backgroundColor: Object.values(data.colors),
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: { size: 12 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed / total) * 100).toFixed(1);
                                    return `${context.label}: ${context.parsed} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error cargando gráfico de categorías:', error);
        }
    }

    async initReportesPorEstado() {
        try {
            const response = await fetch('/api/analytics/reportes-por-estado');
            const data = await response.json();

            const ctx = document.getElementById('chartEstados');
            if (!ctx) return;

            this.charts.estados = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Reportes',
                        data: data.data,
                        backgroundColor: Object.values(data.colors),
                        borderRadius: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error cargando gráfico de estados:', error);
        }
    }

    async initReportesPorMes() {
        try {
            const response = await fetch('/api/analytics/reportes-por-mes');
            const data = await response.json();

            const ctx = document.getElementById('chartMensual');
            if (!ctx) return;

            this.charts.mensual = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Reportes por Mes',
                        data: data.data,
                        borderColor: this.colors.primary,
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: this.colors.primary,
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error cargando gráfico mensual:', error);
        }
    }

    async initApoyosPorReporte() {
        try {
            const response = await fetch('/api/analytics/apoyos-por-reporte');
            const data = await response.json();

            const ctx = document.getElementById('chartApoyos');
            if (!ctx) return;

            this.charts.apoyos = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Apoyos',
                        data: data.data,
                        backgroundColor: 'rgba(40, 167, 69, 0.8)',
                        borderColor: '#28a745',
                        borderWidth: 2,
                        borderRadius: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error cargando gráfico de apoyos:', error);
        }
    }

    async initMapaCalor() {
        try {
            const response = await fetch('/api/analytics/mapa-calor');
            const data = await response.json();

            const container = document.getElementById('mapaCalor');
            if (!container) return;

            // Crear mapa de calor simple (simulado)
            container.innerHTML = this.createMapaCalorHTML(data);
        } catch (error) {
            console.error('Error cargando mapa de calor:', error);
        }
    }

    createMapaCalorHTML(data) {
        return `
            <div class="heatmap-container">
                <div class="heatmap-legend">
                    <div class="legend-item">
                        <div class="legend-color low"></div>
                        <span>Baja</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color medium"></div>
                        <span>Media</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color high"></div>
                        <span>Alta</span>
                    </div>
                </div>
                <div class="heatmap-grid">
                    ${data.map(zona => `
                        <div class="heatmap-zone intensity-${this.getIntensityClass(zona.intensidad)}" 
                             title="${zona.categoria}: ${zona.total} reportes">
                            <div class="zone-label">${zona.categoria}</div>
                            <div class="zone-count">${zona.total}</div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    }

    getIntensityClass(intensidad) {
        if (intensidad >= 70) return 'high';
        if (intensidad >= 40) return 'medium';
        return 'low';
    }

    async initZonasRiesgo() {
        try {
            const response = await fetch('/api/analytics/zonas-riesgo');
            const data = await response.json();

            const container = document.getElementById('zonasRiesgo');
            if (!container) return;

            container.innerHTML = this.createZonasRiesgoHTML(data);
        } catch (error) {
            console.error('Error cargando zonas de riesgo:', error);
        }
    }

    createZonasRiesgoHTML(data) {
        return `
            <div class="risk-zones-container">
                ${data.map(zona => `
                    <div class="risk-zone risk-${this.getRiskClass(zona.nivel_riesgo)}">
                        <div class="risk-header">
                            <h4>${zona.zona}</h4>
                            <span class="risk-level">${zona.nivel_riesgo}</span>
                        </div>
                        <div class="risk-stats">
                            <div class="stat">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>${zona.total_reportes} reportes</span>
                            </div>
                        </div>
                        <div class="risk-recommendation">
                            <i class="bi bi-lightbulb-fill"></i>
                            <p>${zona.recomendacion}</p>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
    }

    getRiskClass(nivel) {
        switch (nivel.toLowerCase()) {
            case 'crítico': return 'critical';
            case 'alto': return 'high';
            case 'medio': return 'medium';
            default: return 'low';
        }
    }

    // Método para actualizar todos los gráficos
    async refreshCharts() {
        // Destruir gráficos existentes
        Object.values(this.charts).forEach(chart => {
            if (chart) chart.destroy();
        });

        // Recargar
        await this.loadCharts();
    }

    // Método para exportar datos
    exportData() {
        // Implementar exportación a CSV/PDF
        console.log('Exportando datos...');
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    if (window.analyticsManager) {
        window.analyticsManager.destroy();
    }
    window.analyticsManager = new AnalyticsManager();
});

// Hacer disponible globalmente
window.AnalyticsManager = AnalyticsManager;
