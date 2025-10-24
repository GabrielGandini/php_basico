<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>
    
  <form action="" method="post">


        <label for="nome">Nome do Produto:</label><br>
        <input type="text" id="nome" name="nome"><br><br>
        
        <label for="preco">Preço:</label><br>
        <input type="number" step="0.01" id="preco" name="preco"><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>

    <hr>

    <?php
    // Conexão com o banco de dados
    $host = "localhost";
    $usuario = "root";
    $senha = "Senai@118";
    $banco = "exercicio";

    $conn = new mysqli($host, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST["nome"];
        $preco = $_POST["preco"];

        // Validação
        if (empty($nome)) {
            echo "<p style='color:red;'>Erro: O nome do produto não pode estar vazio.</p>";
        } else if (!is_numeric($preco) || $preco <= 0) {
            echo "<p style='color:red;'>Erro: O preço deve ser um número positivo.</p>";
        } else {
            // Preparando a query para evitar SQL injection
            $stmt = $conn->prepare("INSERT INTO produtos (nome, preco) VALUES (?, ?)");
            $stmt->bind_param("sd", $nome, $preco);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>Produto cadastrado com sucesso!</p>";
            } else {
                echo "<p style='color:red;'>Erro ao cadastrar produto: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>
</body>
</html>
