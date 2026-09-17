<?php


$transacoes = [
    ["nome" => "Ana", "tipo" => "entrada", "valor" => 1500.00],
    ["nome" => "Ana", "tipo" => "saida", "valor" => 450.00],
    ["nome" => "Carlos", "tipo" => "entrada", "valor" => 2000.00],
    ["nome" => "Carlos", "tipo" => "saida", "valor" => 1200.00],
];

$saldos = [];


foreach ($transacoes as $item) {
    $nome = $item["nome"];
    $valor = ($item["tipo"] === "entrada") ? $item["valor"] : -$item["valor"];

    if (!isset($saldos[$nome])) {
        $saldos[$nome] = 0.0;
    }

    $saldos[$nome] += $valor;
}


foreach ($saldos as $pessoa => $saldo) {
    echo $pessoa . ": R$ " . number_format($saldo, 2, ',', '.') . PHP_EOL;
}