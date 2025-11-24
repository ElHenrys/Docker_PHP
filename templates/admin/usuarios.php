<?php
// Datos de ejemplo. Luego vendrán de MariaDB.
$usuarios = [
    [
        'dni'   => '12345678',
        'nombre'=> 'Juan Pérez',
        'email'=> 'juan.perez@empresa.com',
        'departamento' => 'Calidad',
        'role' => 'Usuario',
        'permisos' => [
            'calidad' => ['ver' => true,  'crear' => true],
            'control_gestion' => ['ver' => true,  'crear' => false],
            'reporting' => ['ver' => false, 'crear' => false],
            'rrhh' => ['ver' => false, 'crear' => false],
        ]
    ],
    [
        'dni'   => '87654321',
        'nombre'=> 'Ana López',
        'email'=> 'ana.lopez@empresa.com',
        'departamento' => 'Reporting',
        'role' => 'Administrador',
        'permisos' => [
            'calidad' => ['ver' => true,  'crear' => true],
            'control_gestion' => ['ver' => true,  'crear' => true],
            'reporting' => ['ver' => true,  'crear' => true],
            'rrhh' => ['ver' => true, 'crear' => true],
        ]
    ],
    [
        'dni'   => '11223344',
        'nombre'=> 'Carlos Ruiz',
        'email'=> 'carlos.ruiz@empresa.com',
        'departamento' => 'Control de gestión',
        'role' => 'Usuario',
        'permisos' => [
            'calidad' => ['ver' => true,  'crear' => false],
            'control_gestion' => ['ver' => true,  'crear' => true],
            'reporting' => ['ver' => true,  'crear' => false],
            'rrhh' => ['ver' => false, 'crear' => false],
        ]
    ],
    [
        'dni'   => '55667788',
        'nombre'=> 'María García',
        'email'=> 'maria.garcia@empresa.com',
        'departamento' => 'RRHH',
        'role' => 'Usuario',
        'permisos' => [
            'calidad' => ['ver' => false,  'crear' => false],
            'control_gestion' => ['ver' => false,  'crear' => false],
            'reporting' => ['ver' => true, 'crear' => false],
            'rrhh' => ['ver' => true, 'crear' => true],
        ]
    ],
];
?>

<?php include __DIR__ . '/../layout/header.php'; ?>

<h1 class="mb-4">Administrador – Permisos por usuario</h1>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="busquedaDni" class="form-label">Buscar por DNI</label>
                <input 
                    type="text" 
                    id="busquedaDni" 
                    class="form-control form-control-sm"
                    placeholder="Ingresa DNI">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary btn-sm" id="btnLimpiarBusqueda">
                    Limpiar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Usuarios (ejemplo, luego desde MariaDB)</h5>

        <div class="table-responsive">
            <table class="table table-hover table-sm align-middle" id="tablaUsuarios">
                <thead class="table-light">
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Departamento base</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr data-dni="<?= htmlspecialchars($u['dni']) ?>">
                            <td>
                                <a href="#" 
                                   class="link-dni" 
                                   data-dni="<?= htmlspecialchars($u['dni']) ?>">
                                    <?= htmlspecialchars($u['dni']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($u['nombre']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['departamento']) ?></td>
                            <td><?= htmlspecialchars($u['role']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <small class="text-muted">
            Mostrando <?= count($usuarios) ?> usuarios de ejemplo. 
            Más adelante esto vendrá paginado desde MariaDB.
        </small>
    </div>
</div>

<!-- Exponemos los usuarios a JS para el modal -->
<script>
    window.usuariosAdmin = <?= json_encode($usuarios, JSON_UNESCAPED_UNICODE); ?>;
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
