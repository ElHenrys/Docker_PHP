<?php

function rebanada($x, $y, $operacion){
    switch (strtoupper($operacion)) {
        case 'SUMA':
            return $x + $y;
            break;
        case 'RESTA':
            return $x - $y;
            break;
        case 'MULTIPLICACION':
            return $x * $y;
            break;
        case 'DIVISION':
            return $x / $y;
            break;
        default:
            echo "Operación no soportada";
            break;
    }
}

