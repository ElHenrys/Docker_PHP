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
                            <a class="nav-link" href="/public/index.php?page=tickets">Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Proyectos</a>
                        </li>
                        <!-- NUEVO: Admin -->
                        <li class="nav-item">
                            <a class="nav-link" href="/public/index.php?page=admin_usuarios">
                                Admin
                            </a>
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
        