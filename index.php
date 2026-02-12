<?php
require_once 'IMC.php';

$peso = '';
$altura = '';
$erro = null;
$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aceita vírgula ou ponto como separador decimal
    $pesoInput = isset($_POST['peso']) ? str_replace(',', '.', $_POST['peso']) : '';
    $alturaInput = isset($_POST['altura']) ? str_replace(',', '.', $_POST['altura']) : '';

    $peso = $pesoInput;
    $altura = $alturaInput;

    $pesoFloat = (float) $pesoInput;
    $alturaFloat = (float) $alturaInput;

    $imcCalculadora = new IMC();

    if (!$imcCalculadora->validarEntrada($pesoFloat, $alturaFloat)) {
        $erro = 'Peso ou altura inválidos. Verifique se o peso é maior que 0 e a altura está entre 0 e 3 metros.';
    } else {
        try {
            $valorImc = $imcCalculadora->calcularIMC($pesoFloat, $alturaFloat);
            $classificacao = $imcCalculadora->classificarIMC($valorImc);

            $resultado = [
                'imc' => $valorImc,
                'classificacao' => $classificacao
            ];
        } catch (Exception $e) {
            $erro = 'Ocorreu um erro ao calcular o IMC: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de IMC</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 24px 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 24px;
        }
        label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px 0;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0069d9;
        }
        .erro {
            margin-top: 16px;
            padding: 10px;
            border-radius: 4px;
            background-color: #f8d7da;
            color: #721c24;
        }
        .resultado {
            margin-top: 16px;
            padding: 10px;
            border-radius: 4px;
            background-color: #d4edda;
            color: #155724;
        }
        .rodape {
            margin-top: 16px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Calculadora de IMC</h1>

    <form method="post" action="">
        <label for="peso">Peso (kg):</label>
        <input
            type="text"
            name="peso"
            id="peso"
            placeholder="Ex: 70.5"
            value="<?php echo htmlspecialchars($peso, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="altura">Altura (m):</label>
        <input
            type="text"
            name="altura"
            id="altura"
            placeholder="Ex: 1.75"
            value="<?php echo htmlspecialchars($altura, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <button type="submit">Calcular</button>
    </form>

    <?php if ($erro): ?>
        <div class="erro">
            <?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <div class="resultado">
            <p><strong>IMC:</strong> <?php echo number_format($resultado['imc'], 2, ',', '.'); ?></p>
            <p><strong>Classificação:</strong> <?php echo htmlspecialchars($resultado['classificacao'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>

    <div class="rodape">
        Este cálculo é apenas uma referência e não substitui avaliação profissional.
    </div>
</div>
</body>
</html>
