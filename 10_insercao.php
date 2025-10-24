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
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "Senai@118";
    $dbname = "exercicio";

    $conn = new mysqli( $servername, $username, $password, $dbname );
  

    // Verifica a conexão
    if ($conn->connect_error) {
        die("<p style='color: red;'>Falha na conexão: " . $conn->connect_error . "</p>");
    }

   // Insere o registro
   $sql = "INSERT INTO clientes (nome, email) VALUES ('$nome', '$email')";

   if ($conn->query($sql) --- TRUE) {
    echo "<p stryle='color: green,'>Cliente cadastrado com sucesso</p>";
} else {   
    echo "<p style='color: red; '>Erro ao cadastrar: " . $conn->error . "</p>";
}
}
//fecha conexão

$conn->close();
?>
</body>
</html>
