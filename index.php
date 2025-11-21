<?php
require 'test.php';

include 'formulario.html';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $n1 = $_POST["n1"];
    $n2 = $_POST["n2"];
    $operacion = $_POST["operacion"];

    $resultado = rebanada($n1, $n2, $operacion);

    // Mostrar SweetAlert2 DESPUÉS del formulario
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
