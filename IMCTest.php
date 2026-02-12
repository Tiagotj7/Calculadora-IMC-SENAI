<?php

require_once 'IMC.php';

$imc = new IMC();

function executarTeste($descricao, $condicao) {
    if ($condicao) {
        echo " PASSOU: $descricao\n";
    } else {
        echo " FALHOU: $descricao\n";
    }
}

$resultadoIMC = $imc->calcularIMC(70, 1.75);
executarTeste(
    "Cálculo correto do IMC (70kg, 1.75m)",
    $resultadoIMC === 22.86
);


$classificacao = $imc->classificarIMC(22.86);
executarTeste(
    "Classificação Peso normal",
    $classificacao === "Peso normal"
);


$classificacao = $imc->classificarIMC(27);
executarTeste(
    "Classificação Sobrepeso",
    $classificacao === "Sobrepeso"
);


$validacao = $imc->validarEntrada(70, 1.75);
executarTeste(
    "Validação entrada válida (70kg, 1.75m)",
    $validacao === true
);


$validacao = $imc->validarEntrada(0, 1.75);
executarTeste(
    "Validação peso inválido (0kg)",
    $validacao === false
);


$validacao = $imc->validarEntrada(70, 3.5);
executarTeste(
    "Validação altura inválida (3.5m)",
    $validacao === false
);

