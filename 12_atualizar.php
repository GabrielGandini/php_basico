<?php
// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exercicio";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("<p style='color:red;'>💀 Falha na conexão: " . $conn->connect_error . "</p>");
}

// Inicializa a variável cliente
$cliente = null;

// Verifica se o ID foi passado via URL (para edição)
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // segurança: converte pra número inteiro
    $sql = "SELECT * FROM clientes WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    } else {
        echo "<p style='color:orange;'>⚠ Cliente não encontrado.</p>";
        exit;
    }
}

// Verifica se o formulário foi enviado (para atualizar o cliente)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    if (!empty($nome) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "UPDATE clientes SET nome = '$nome', email = '$email' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:limegreen;'>✅ Cliente atualizado com sucesso!</p>";
        } else {
            echo "<p style='color:red;'>❌ Erro ao atualizar: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color:orange;'>⚠ Preencha todos os campos corretamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <style>
        body {
            background-color: #111;
            color: #f0f0f0;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 40px;
        }
        form {
            background-color: #1b1b1b;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 0 15px #ff0077;
        }
        input {
            margin: 10px 0;
            padding: 10px;
            width: 90%;
            border: none;
            border-radius: 6px;
            background-color: #2b2b2b;
            color: #fff;
        }
        button {
            background-color: #ff0077;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #ff3399;
        }
        a {
            display: block;
            margin-top: 15px;
            color: #ff0077;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>✏️ Editar Cliente</h1>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $cliente['id'] ?? ''; ?>">

        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome'] ?? ''); ?>" required><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($cliente['email'] ?? ''); ?>" required><br>

        <button type="submit">Atualizar</button>
    </form>

    <a href="listar_clientes.php">⬅ Voltar à lista de clientes</a>

</body>
</html>




