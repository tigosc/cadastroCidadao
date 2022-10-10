<?php

function gerarPis(){
    $num = array(rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9), rand(0, 9));

    $ar = array(3 * $num[0], 2 * $num[1], 9 * $num[2], 8 * $num[3], 7 * $num[4], 6 * $num[5], 5 * $num[6], 4 * $num[7], 3 * $num[8], 2 * $num[9]);

    $soma = 0;
    foreach ($ar as &$n) {
        $soma += $n;
    }

    $div = $soma % 11;
    $digito = 11 - $div;

    if ($digito > 9) {
        $digito = 0;
    }

    $pis = '';
    foreach ($num as &$dig) {
        $pis .= $dig;
    }

    $pis .= $digito;
    return $pis;
}