<?php
// Datos de ejemplo para la tabla de tickets. Luego vendrán de la base de datos.
$tickets = [
    [
        'id' => '101',
        'titulo' => 'Error al iniciar sesión',
        'estado' => 'Abierto',
        'departamento' => 'Calidad',
        'asignado' => 'Juan Pérez',
        'fecha' => '2025-02-05',
    ],
    [
        'id' => '102',
        'titulo' => 'No se genera reporte mensual',
        'estado' => 'En progreso',
        'departamento' => 'Reporting',
        'asignado' => 'Ana López',
        'fecha' => '2025-02-03',
    ],
    [
        'id' => '103',
        'titulo' => 'Actualizar módulo de RRHH',
        'estado' => 'Completado',
        'departamento' => 'RRHH',
        'asignado' => 'Carlos Ruiz',
        'fecha' => '2025-01-30',
    ],
    [
        'id' => '104',
        'titulo' => 'Agregar campo de validación',
        'estado' => 'Abierto',
        'departamento' => 'Control de gestión',
        'asignado' => 'María García',
        'fecha' => '2025-02-04',
    ],
];
?>
<?php include __DIR__ . '../../layout/header.php'; ?>

<h1 class="mb-4">Tickets</h1>

<!-- Filtros -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-end" id="filtrosTickets">
            <div class="col-md-2">
                <label for="filtroId" class="form-label">ID</label>
                <input type="text" id="filtroId" class="form-control form-control-sm" placeholder="ID">
            </div>
            <div class="col-md-3">
                <label for="filtroAsunto" class="form-label">Asunto</label>
                <input type="text" id="filtroAsunto" class="form-control form-control-sm" placeholder="Título o asunto">
            </div>
            <div class="col-md-2">
                <label for="filtroEstado" class="form-label">Estado</label>
                <select id="filtroEstado" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    <option value="Abierto">Abierto</option>
                    <option value="En progreso">En progreso</option>
                    <option value="Completado">Completado</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="filtroDepartamento" class="form-label">Departamento</label>
                <select id="filtroDepartamento" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    <option value="Calidad">Calidad</option>
                    <option value="Control de gestión">Control de gestión</option>
                    <option value="Reporting">Reporting</option>
                    <option value="RRHH">RRHH</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="filtroAsignado" class="form-label">Asignado a</label>
                <input type="text" id="filtroAsignado" class="form-control form-control-sm" placeholder="Asignado a">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-primary btn-sm w-100" id="btnLimpiarFiltros">
                    Limpiar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de tickets -->
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Lista de tickets (ejemplo, luego desde BD)</h5>
        <div class="table-responsive">
            <table class="table table-hover table-sm align-middle" id="tablaTickets">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                        <th>Departamento</th>
                        <th>Asignado a</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $t) : ?>
                        <tr 
                            data-id="<?= htmlspecialchars($t['id']) ?>"
                            data-asunto="<?= htmlspecialchars(strtolower($t['titulo'])) ?>"
                            data-estado="<?= htmlspecialchars($t['estado']) ?>"
                            data-departamento="<?= htmlspecialchars($t['departamento']) ?>"
                            data-asignado="<?= htmlspecialchars(strtolower($t['asignado'])) ?>"
                        >
                            <td><?= htmlspecialchars($t['id']) ?></td>
                            <td><?= htmlspecialchars($t['titulo']) ?></td>
                            <td><span class="badge 
                                <?php 
                                switch ($t['estado']) {
                                    case 'Abierto': echo 'bg-danger'; break;
                                    case 'En progreso': echo 'bg-warning text-dark'; break;
                                    case 'Completado': echo 'bg-success'; break;
                                    default: echo 'bg-secondary'; 
                                } ?>">
                                <?= htmlspecialchars($t['estado']) ?>
                            </span></td>
                            <td><?= htmlspecialchars($t['departamento']) ?></td>
                            <td><?= htmlspecialchars($t['asignado']) ?></td>
                            <td><?= htmlspecialchars($t['fecha']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filtroId = document.getElementById('filtroId');
    const filtroAsunto = document.getElementById('filtroAsunto');
    const filtroEstado = document.getElementById('filtroEstado');
    const filtroDepartamento = document.getElementById('filtroDepartamento');
    const filtroAsignado = document.getElementById('filtroAsignado');
    const btnLimpiar = document.getElementById('btnLimpiarFiltros');
    const filas = Array.from(document.querySelectorAll('#tablaTickets tbody tr'));

    function aplicarFiltros() {
        const idVal = filtroId.value.trim().toLowerCase();
        const asuntoVal = filtroAsunto.value.trim().toLowerCase();
        const estadoVal = filtroEstado.value;
        const departamentoVal = filtroDepartamento.value;
        const asignadoVal = filtroAsignado.value.trim().toLowerCase();

        filas.forEach(tr => {
            const id = tr.dataset.id.toLowerCase();
            const asunto = tr.dataset.asunto;
            const estado = tr.dataset.estado;
            const departamento = tr.dataset.departamento;
            const asignado = tr.dataset.asignado;

            let visible = true;

            if (idVal && !id.includes(idVal)) visible = false;
            if (asuntoVal && !asunto.includes(asuntoVal)) visible = false;
            if (estadoVal && estado !== estadoVal) visible = false;
            if (departamentoVal && departamento !== departamentoVal) visible = false;
            if (asignadoVal && !asignado.includes(asignadoVal)) visible = false;

            tr.style.display = visible ? '' : 'none';
        });
    }

    filtroId.addEventListener('input', aplicarFiltros);
    filtroAsunto.addEventListener('input', aplicarFiltros);
    filtroEstado.addEventListener('change', aplicarFiltros);
    filtroDepartamento.addEventListener('change', aplicarFiltros);
    filtroAsignado.addEventListener('input', aplicarFiltros);

    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', () => {
            filtroId.value = '';
            filtroAsunto.value = '';
            filtroEstado.value = '';
            filtroDepartamento.value = '';
            filtroAsignado.value = '';
            aplicarFiltros();
        });
    }
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>