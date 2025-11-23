<?php
session_start();           // Necesario para usar $_SESSION

include __DIR__ .'/../src/Helpers/test.php';
include __DIR__ . '/../templates/home/home.php';

// 1. Si llega un POST, procesamos y redirigimos
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $n1 = $_POST["n1"];
    $n2 = $_POST["n2"];
    $operacion = $_POST["operacion"];

    $resultado = rebanada($n1, $n2, $operacion);

    // Guardar el mensaje en sesión
    $_SESSION['mensaje'] = [
        'operacion' => $operacion,
        'resultado' => $resultado
    ];

    // Redirigir a la misma página para evitar reenvío del formulario
    header("Location: index.php");
    exit;
}

//include __DIR__ . '/../templates/pruebas/form_calculadora.html';
// 3. Si hay un mensaje en sesión, lo mostramos UNA sola vez
if (isset($_SESSION['mensaje'])) {
    $operacion = $_SESSION['mensaje']['operacion'];
    $resultado = $_SESSION['mensaje']['resultado'];

    // Borrar el mensaje para que no se repita en el siguiente refresh
    unset($_SESSION['mensaje']);

    echo "
    <script>
        Swal.fire({
            title: 'Resultado',
            text: 'El resultado de la operación $operacion es: $resultado',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
    ";
}