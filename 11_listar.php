<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #0e0e0e;
            color: #f2f2f2;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            background: linear-gradient(90deg, #ff0077, #ffcc00);
            color: black;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 70%;
            box-shadow: 0 0 15px rgba(255, 0, 85, 0.2);
            background-color: #1a1a1a;
        }
        th, td {
            border: 1px solid #444;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #ff0077;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #2a2a2a;
        }
        tr:hover {
            background-color: #ff007720;
        }
        p {
            color: #aaa;
        }
        a {
            color: #ff0077;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>👥 Lista de Clientes</h1>

<?php
// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exercicio";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("<p style='color: red;'>💀 Falha na conexão: " . $conn->connect_error . "</p>");
}

// Consulta para buscar todos os clientes
$sql = "SELECT id, nome, email FROM clientes";
$result = $conn->query($sql);

// Exibe em formato de tabela
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nenhum cliente encontrado 😢</p>";
}

// Fecha a conexão
$conn->close();
?>

    <p><a href="cadastro_clientes.php">⬅ Voltar ao cadastro</a></p>
</body>
</html>
