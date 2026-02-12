<?php
session_start();
require_once 'IMC.php';

$nome = '';
$peso = '';
$altura = '';
$erro = null;
$resultado = null;
$mensagemSalvo = null;

// Recupera (e limpa) resultado salvo em sessão após redirect
if (isset($_SESSION['flash_resultado'])) {
    $flash = $_SESSION['flash_resultado'];
    unset($_SESSION['flash_resultado']);

    $resultado = $flash['resultado'] ?? null;
    $mensagemSalvo = $flash['mensagem'] ?? null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';

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
            // Calcula IMC e classificação
            $valorImc = $imcCalculadora->calcularIMC($pesoFloat, $alturaFloat);
            $classificacao = $imcCalculadora->classificarIMC($valorImc);

            // Tenta salvar no banco de dados
            try {
                // Ajuste aqui se suas credenciais forem diferentes
                $pdo = new PDO(
                    'mysql:host=localhost:3307;dbname=calculador_imc;charset=utf8mb4',
                    'root',        // usuário
                    ''             // senha
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare(
                    'INSERT INTO registros_imc (nome, peso, altura, imc, classificacao)
                     VALUES (:nome, :peso, :altura, :imc, :classificacao)'
                );

                $stmt->execute([
                    ':nome'          => $nome !== '' ? $nome : null,
                    ':peso'          => $pesoFloat,
                    ':altura'        => $alturaFloat,
                    ':imc'           => $valorImc,
                    ':classificacao' => $classificacao
                ]);

                // Guarda resultado na sessão e redireciona (PRG)
                $_SESSION['flash_resultado'] = [
                    'resultado' => [
                        'imc' => $valorImc,
                        'classificacao' => $classificacao
                    ],
                    'mensagem' => 'Registro salvo no banco de dados com sucesso.'
                ];

                header('Location: index.php');
                exit;
            } catch (PDOException $e) {
                // Se der erro no banco, mostra mensagem, mas ainda exibe o cálculo
                $erro = 'Erro ao salvar no banco de dados: ' . $e->getMessage();
                $resultado = [
                    'imc' => $valorImc,
                    'classificacao' => $classificacao
                ];
            }
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
            background: url(https://imgs.search.brave.com/cOA0ZQ0mSwgx-YGbaIXzMinTpo80kAikhVx2bPOlEbs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93YWxs/cGFwZXJiYXQuY29t/L2ltZy85MTQ0OC1m/aXRuZXNzLXdhbGxw/YXBlci10b3AtZnJl/ZS1maXRuZXNzLWJh/Y2tncm91bmQuanBn);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;

            margin: 0;
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            /* centraliza horizontal */
            align-items: center;
            /* centraliza vertical */
        }

        .container {
            max-width: 480px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 24px 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

        input[type="text"],
        input[type="number"] {
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

        .info {
            margin-top: 8px;
            padding: 8px;
            border-radius: 4px;
            background-color: #cce5ff;
            color: #004085;
            font-size: 14px;
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
            <label for="nome">Nome (opcional):</label>
            <input
                type="text"
                name="nome"
                id="nome"
                placeholder="Seu nome"
                value="<?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>">

            <label for="peso">Peso (kg):</label>
            <input
                type="text"
                name="peso"
                id="peso"
                placeholder="Ex: 70.5"
                value="<?php echo htmlspecialchars($peso, ENT_QUOTES, 'UTF-8'); ?>"
                required>

            <label for="altura">Altura (m):</label>
            <input
                type="text"
                name="altura"
                id="altura"
                placeholder="Ex: 1.75"
                value="<?php echo htmlspecialchars($altura, ENT_QUOTES, 'UTF-8'); ?>"
                required>

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

        <?php if ($mensagemSalvo): ?>
            <div class="info">
                <?php echo htmlspecialchars($mensagemSalvo, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <div class="rodape">
            Este cálculo é apenas uma referência e não substitui avaliação profissional.
        </div>
    </div>
</body>

</html>
