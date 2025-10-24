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

// Verifica se o ID foi passado via URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // segurança: converte pra número inteiro

    // Prepara a query para deletar o cliente
    $sql = "DELETE FROM clientes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $msg = "<p style='color:limegreen;'>✅ Cliente excluído com sucesso!</p>";
    } else {
        $msg = "<p style='color:red;'>❌ Erro ao excluir cliente: " . $conn->error . "</p>";
    }
} else {
    $msg = "<p style='color:orange;'>⚠ Nenhum ID informado para exclusão.</p>";
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Cliente</title>
    <style>
        body {
            background-color: #111;
            color: #f0f0f0;
            font-family: 'Consolas', monospace;
            text-align: center;
            padding: 40px;
        }
        .box {
            background-color: #1a1a1a;
            display: inline-block;
            padding: 25px 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px #ff0044;
            animation: fadeIn 1s ease;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #ff0044;
            font-weight: bold;
        }
        a:hover {
            color: #ff3380;
            text-shadow: 0 0 8px #ff3380;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>

    <div class="box">
        <h1>💣 Exclusão de Cliente</h1>
        <?php echo $msg; ?>
        <a href="listar_clientes.php">⬅ Voltar à lista</a>
    </div>

</body>
</html>


