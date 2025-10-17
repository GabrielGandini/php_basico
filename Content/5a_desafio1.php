<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Verificação de Idade</title>
</head>
<body>
    <h2>Verificação de Acesso</h2>
    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br><br>

        <label for="ano">Ano de Nascimento:</label>
        <input type="number" name="ano" required><br><br>

        <button type="submit">Verificar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $anoNascimento = $_POST['ano'];
        $anoAtual = date("Y");
        $idade = $anoAtual - $anoNascimento;

        if ($idade >= 18) {
            echo "<p style='color: green;'>Acesso permitido, $nome!</p>";
            echo "<p>Sua idade: $idade anos.</p>";

            // Abre o arquivo e registra o acesso
            $arquivo = fopen('log_acessos.txt', 'a');
            $linha = $nome . ';' . $idade . " anos\n";
            fwrite($arquivo, $linha);
            fclose($arquivo);
        } else {
            echo "<p style='color: red;'>Acesso negado, menor de idade.</p>";
        }
    }
    ?>
</body>
</html>
