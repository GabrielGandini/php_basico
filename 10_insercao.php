<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Clientes</title>
</head>
<body>
    <form method="post" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os valores enviados
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    // Validação simples
    if (empty($nome) || empty($email)) {
        echo "<p style='color: red;'>Por favor, preencha todos os campos.</p>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color: red;'>Digite um email válido!</p>";
        exit;
    }

    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exercicio";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");

    // Verifica a conexão
    if ($conn->connect_error) {
        die("<p style='color: red;'>Falha na conexão: " . $conn->connect_error . "</p>");
    }

    // Prepara o comando SQL com segurança contra SQL Injection
    $stmt = $conn->prepare("INSERT INTO clientes (nome, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $email);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Cliente cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro ao cadastrar: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
