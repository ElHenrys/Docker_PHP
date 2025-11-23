<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" conten="width=device-width, initial-scale=1.0">
        <title>Ticketera - Home</title>

        <!--Boostraps-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Estilos globales -->
        <link rel="stylesheet" href="/css/main.css">
    </head>

    <body class="bg-light">

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">

                <!-- Marca -->
                <a class="navbar-brand d-flex align-items-center" href="/public/index.php">
                    🎫 Ticketera
                </a>

                <!-- Botón móvil -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido -->
                <div class="collapse navbar-collapse" id="navbarNav">

                    <!-- Menú izquierdo -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Usuarios</a>
                        </li>
                    </ul>

                    <!-- Búsqueda centro -->
                    <form class="d-flex mx-auto w-50" role="search">
                        <input 
                            class="form-control form-control-sm"
                            type="search"
                            placeholder="Buscar ticket..."
                            aria-label="Buscar"
                        >
                    </form>

                    <!-- Botón nuevo ticket derecha -->
                    <button type="button" class="btn btn-light btn-sm ms-3" id="btnNuevoTicket">
                        ➕ Nuevo ticket
                    </button>

                </div>
            </div>
        </nav>
        <div class="container mt-5">
        </div> <!-- cierro container -->

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
        // Cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function () {
            const btnNuevoTicket = document.getElementById('btnNuevoTicket');

            if (!btnNuevoTicket) return;

            btnNuevoTicket.addEventListener('click', function () {

                Swal.fire({
                    title: 'Nuevo ticket',
                    width: 800,
                    html: `
                        <form id="formNuevoTicket">
                            <!-- Departamento (simulado, luego vendrá de BD) -->
                            <div class="mb-3 text-start">
                                <label for="tkDepartamento" class="form-label">
                                    Departamento <small class="text-muted">(ejemplo, luego desde BD)</small>
                                </label>
                                <select id="tkDepartamento" class="form-select form-select-sm">
                                    <option value="">Selecciona un departamento</option>
                                    <option value="calidad">Calidad</option>
                                    <option value="control_gestion">Control de gestión</option>
                                    <option value="reporting">Reporting</option>
                                    <option value="rrhh">RRHH</option>
                                </select>
                            </div>

                            <!-- Tipo de ticket (simulado, luego dependerá del departamento) -->
                            <div class="mb-3 text-start">
                                <label for="tkTipo" class="form-label">
                                    Tipo de ticket <small class="text-muted">(ejemplo)</small>
                                </label>
                                <select id="tkTipo" class="form-select form-select-sm">
                                    <option value="">Selecciona un tipo</option>
                                    <option value="nuevo_desarrollo">Nuevo desarrollo</option>
                                    <option value="modificacion">Modificaciones</option>
                                    <option value="incidencia">Incidencia</option>
                                </select>
                            </div>

                            <!-- Asunto -->
                            <div class="mb-3 text-start">
                                <label for="tkAsunto" class="form-label">Asunto</label>
                                <input 
                                    type="text" 
                                    id="tkAsunto" 
                                    class="form-control form-control-sm" 
                                    maxlength="100"
                                    placeholder="Resumen breve del ticket (máx. 100 caracteres)">
                            </div>

                            <!-- Descripción con toolbar simple -->
                            <div class="mb-3 text-start">
                                <label class="form-label">Descripción</label>
                                <div class="btn-group btn-group-sm mb-2" role="group" aria-label="Toolbar descripción">
                                    <button type="button" class="btn btn-outline-secondary" data-cmd="bold"><b>B</b></button>
                                    <button type="button" class="btn btn-outline-secondary" data-cmd="italic"><i>I</i></button>
                                    <button type="button" class="btn btn-outline-secondary" data-cmd="underline"><u>U</u></button>
                                </div>
                                <div 
                                    id="tkDescripcion" 
                                    class="form-control"
                                    style="height: 180px; overflow:auto; background-color: #fff;"
                                    contenteditable="true">
                                </div>
                                <small class="text-muted">Máx. 2000 caracteres.</small>
                            </div>

                            <!-- Adjunto -->
                            <div class="mb-2 text-start">
                                <label for="tkAdjunto" class="form-label">Adjunto</label>
                                <input type="file" id="tkAdjunto" class="form-control form-control-sm">
                            </div>
                        </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Crear ticket',
                    cancelButtonText: 'Cancelar',
                    focusConfirm: false,
                    didOpen: (popup) => {
                        // Toolbar de formato para la descripción
                        const toolbarButtons = popup.querySelectorAll('[data-cmd]');
                        const descripcion = popup.querySelector('#tkDescripcion');

                        toolbarButtons.forEach(btn => {
                            btn.addEventListener('click', () => {
                                const cmd = btn.getAttribute('data-cmd');

                                if (cmd === 'fontSize') {
                                    document.execCommand('fontSize', false, btn.getAttribute('data-size'));
                                } else if (cmd === 'foreColor') {
                                    document.execCommand('foreColor', false, btn.getAttribute('data-color'));
                                } else {
                                    document.execCommand(cmd, false, null);
                                }

                                descripcion.focus();
                            });
                        });
                    },
                    preConfirm: () => {
                        const depto = document.getElementById('tkDepartamento').value;
                        const tipo = document.getElementById('tkTipo').value;
                        const asunto = document.getElementById('tkAsunto').value.trim();
                        const descripcionDiv = document.getElementById('tkDescripcion');
                        const descripcionTexto = descripcionDiv.textContent.trim(); // solo texto para contar

                        if (!depto) {
                            return Swal.showValidationMessage('Selecciona un departamento');
                        }
                        if (!tipo) {
                            return Swal.showValidationMessage('Selecciona un tipo de ticket');
                        }
                        if (!asunto) {
                            return Swal.showValidationMessage('El asunto es obligatorio');
                        }
                        if (descripcionTexto.length === 0) {
                            return Swal.showValidationMessage('La descripción es obligatoria');
                        }
                        if (descripcionTexto.length > 2000) {
                            return Swal.showValidationMessage('La descripción supera los 2000 caracteres');
                        }

                        // Devuelvo los datos para usarlos después (por ahora solo demo)
                        return {
                            departamento: depto,
                            tipo: tipo,
                            asunto: asunto,
                            descripcionHtml: descripcionDiv.innerHTML
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Aquí luego harás un fetch/POST al backend con result.value
                        console.log('Datos del ticket (demo):', result.value);

                        Swal.fire({
                            icon: 'success',
                            title: 'Ticket creado',
                            text: 'Más adelante aquí haremos el guardado real en la base de datos.'
                        });
                    }
                });
            });
        });
        </script>

</body>
</html>
