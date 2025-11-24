</div> <!-- cierro container -->

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ======================
            // 1) NUEVO TICKET (ya lo tenías)
            // ======================
            const btnNuevoTicket = document.getElementById('btnNuevoTicket');

            if (btnNuevoTicket) {
                btnNuevoTicket.addEventListener('click', function () {

                    Swal.fire({
                        title: 'Nuevo ticket',
                        width: 800,
                        html: `
                            <form id="formNuevoTicket">
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

                                <div class="mb-3 text-start">
                                    <label for="tkAsunto" class="form-label">Asunto</label>
                                    <input 
                                        type="text" 
                                        id="tkAsunto" 
                                        class="form-control form-control-sm" 
                                        maxlength="100"
                                        placeholder="Resumen breve del ticket (máx. 100 caracteres)">
                                </div>

                                <div class="mb-3 text-start">
                                    <label class="form-label">Descripción</label>
                                    <div class="btn-group btn-group-sm mb-2" role="group">
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
                            const descripcionTexto = descripcionDiv.textContent.trim();

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

                            return {
                                departamento: depto,
                                tipo: tipo,
                                asunto: asunto,
                                descripcionHtml: descripcionDiv.innerHTML
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('Datos del ticket (demo):', result.value);

                            Swal.fire({
                                icon: 'success',
                                title: 'Ticket creado',
                                text: 'Más adelante aquí haremos el guardado real en la base de datos.'
                            });
                        }
                    });
                });
            }

            // ======================
            // 2) ADMIN – PERMISOS POR USUARIO
            // ======================
            const inputDni = document.getElementById('busquedaDni');
            const btnLimpiar = document.getElementById('btnLimpiarBusqueda');
            const tablaUsuarios = document.getElementById('tablaUsuarios');

            if (inputDni && tablaUsuarios) {
                const filas = Array.from(tablaUsuarios.querySelectorAll('tbody tr'));

                // Filtro por DNI
                inputDni.addEventListener('input', () => {
                    const filtro = inputDni.value.trim().toLowerCase();

                    filas.forEach(tr => {
                        const dni = tr.dataset.dni.toLowerCase();
                        tr.style.display = dni.includes(filtro) ? '' : 'none';
                    });
                });

                if (btnLimpiar) {
                    btnLimpiar.addEventListener('click', () => {
                        inputDni.value = '';
                        filas.forEach(tr => tr.style.display = '');
                    });
                }

                // Click en DNI -> modal permisos
                tablaUsuarios.querySelectorAll('.link-dni').forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const dni = link.dataset.dni;
                        abrirModalPermisosUsuario(dni);
                    });
                });
            }

            // Función que abre el SweetAlert de permisos
            function abrirModalPermisosUsuario(dni) {
                const usuarios = window.usuariosAdmin || [];
                const usuario = usuarios.find(u => u.dni === dni);

                if (!usuario) {
                    Swal.fire('Error', 'Usuario no encontrado en los datos de ejemplo.', 'error');
                    return;
                }

                Swal.fire({
                    title: `Permisos de ${usuario.nombre}`,
                    width: 700,
                    html: `
                        <p class="text-start mb-3">
                            <strong>DNI:</strong> ${usuario.dni}<br>
                            <strong>Email:</strong> ${usuario.email}<br>
                            <strong>Departamento base:</strong> ${usuario.departamento}<br>
                            <strong>Rol:</strong> ${usuario.role}
                        </p>

                        <div class="table-responsive text-start">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Departamento</th>
                                        <th>Puede ver</th>
                                        <th>Puede crear</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${renderFilaPermisos('Calidad', 'calidad', usuario.permisos)}
                                    ${renderFilaPermisos('Control de gestión', 'control_gestion', usuario.permisos)}
                                    ${renderFilaPermisos('Reporting', 'reporting', usuario.permisos)}
                                    ${renderFilaPermisos('RRHH', 'rrhh', usuario.permisos)}
                                </tbody>
                            </table>
                        </div>

                        <small class="text-muted">
                            Datos de ejemplo. Más adelante esto se guardará en MariaDB.
                        </small>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar permisos',
                    cancelButtonText: 'Cancelar',
                    focusConfirm: false,
                    preConfirm: () => {
                        // Leer checkboxes
                        const resultado = {
                            dni: usuario.dni,
                            permisos: {
                                calidad: leerPermisosDepto('calidad'),
                                control_gestion: leerPermisosDepto('control_gestion'),
                                reporting: leerPermisosDepto('reporting'),
                                rrhh: leerPermisosDepto('rrhh'),
                            }
                        };

                        // Aquí luego harás el POST al backend
                        console.log('Permisos seleccionados (demo):', resultado);

                        return resultado;
                    }
                }).then(result => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Permisos actualizados',
                            text: 'Cuando esté la base de datos, aquí se confirmará el guardado real.'
                        });
                    }
                });
            }

            function renderFilaPermisos(nombreVisible, clave, permisosObj) {
                const p = permisosObj && permisosObj[clave] ? permisosObj[clave] : { ver: false, crear: false };

                return `
                    <tr>
                        <td>${nombreVisible}</td>
                        <td>
                            <input type="checkbox" id="perm_${clave}_ver" ${p.ver ? 'checked' : ''}>
                        </td>
                        <td>
                            <input type="checkbox" id="perm_${clave}_crear" ${p.crear ? 'checked' : ''}>
                        </td>
                    </tr>
                `;
            }

            function leerPermisosDepto(clave) {
                const chkVer = document.getElementById('perm_' + clave + '_ver');
                const chkCrear = document.getElementById('perm_' + clave + '_crear');
                return {
                    ver: chkVer ? chkVer.checked : false,
                    crear: chkCrear ? chkCrear.checked : false,
                };
            }
        });
        </script>

</body>
</html>
