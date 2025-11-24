<?php
session_start();

$page = $_GET['page'] ?? 'home';
$templatesDir = __DIR__ . '/../templates';

$templatePath = '';

switch ($page) {
    case 'admin_usuarios':
        // Página de administración de usuarios
        $templatePath = $templatesDir . '/admin/usuarios.php';
        break;

    case 'home':
        // Página principal
        $templatePath = $templatesDir . '/home/home.php';
        break;

    case 'tickets':
        // Página principal
        $templatePath = $templatesDir . '/ticket/tickets.php';
        break;

    default:
        // Comprobamos si existe una plantilla con el mismo nombre en la raíz de templates
        if (file_exists($candidate)) {
            $templatePath = $candidate;
        } else {
            $templatePath = $templatesDir . '/404.php';
        }
        break;
}

include $templatePath;