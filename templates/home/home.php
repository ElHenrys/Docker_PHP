<?php include __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Panel principal</h1>

<div class="row g-4">

    <!-- Tickets abiertos -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">Tickets abiertos</h5>
                <p class="fs-3 text-primary">12</p>
                <a href="#" class="btn btn-outline-primary btn-sm">Ver detalles</a>
            </div>
        </div>
    </div>

    <!-- Tickets en progreso -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">En progreso</h5>
                <p class="fs-3 text-warning">4</p>
                <a href="#" class="btn btn-outline-warning btn-sm">Ver detalles</a>
            </div>
        </div>
    </div>

    <!-- Tickets completados -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">Completados</h5>
                <p class="fs-3 text-success">27</p>
                <a href="#" class="btn btn-outline-success btn-sm">Ver detalles</a>
            </div>
        </div>
    </div>

</div>

<hr class="my-5">

<!-- Últimos tickets -->
<h2>Últimos tickets</h2>

<table class="table table-hover mt-3 bg-white shadow-sm">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Estado</th>
            <th>Asignado a</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>123</td>
            <td>Error al iniciar sesión</td>
            <td><span class="badge bg-warning">En progreso</span></td>
            <td>Juan Pérez</td>
            <td>2025-02-01</td>
        </tr>

        <tr>
            <td>122</td>
            <td>No carga el dashboard</td>
            <td><span class="badge bg-danger">Abierto</span></td>
            <td>-</td>
            <td>2025-01-29</td>
        </tr>

        <tr>
            <td>121</td>
            <td>Mejora en módulo de reportes</td>
            <td><span class="badge bg-success">Completado</span></td>
            <td>Ana López</td>
            <td>2025-01-27</td>
        </tr>
    </tbody>
</table>

<?
