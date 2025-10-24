<!-- Passar id via URL -->
<!-- http://localhost/php_basico_out-2024/12_atualizar.php?id=1 -->

<?php
// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$dbname = "exercicio";
$password = "Senai@118";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$cliente = null;

// --- Se for GET: buscar cliente pelo id (com prepared statement)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_get = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if ($id_get === false) {
        echo "ID inválido.";
        exit();
    }

    $stmt = $conn->prepare("SELECT id, nome, email FROM clientes WHERE id = ?");
    $stmt->bind_param("i", $id_get);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    } else {
        echo "Cliente não encontrado.";
        exit();
    }

    $stmt->close();
}

// --- Se for POST: atualizar cliente (com prepared statement)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // validação básica
    $id_post = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = trim((string)($_POST['nome'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));

    if ($id_post === false || $id_post === null) {
        echo "<p>ID inválido.</p>";
    } elseif ($nome === '' || $email === '') {
        echo "<p>Nome e e-mail são obrigatórios.</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>E-mail inválido.</p>";
    } else {
        $stmt = $conn->prepare("UPDATE clientes SET nome = ?, email = ? WHERE id = ?");
        if ($stmt === false) {
            echo "<p>Erro ao preparar a query: " . htmlspecialchars($conn->error) . "</p>";
        } else {
            $stmt->bind_param("ssi", $nome, $email, $id_post);
            if ($stmt->execute()) {
                // redireciona pra mesma página com id no GET e mensagem (PRG pattern)
                header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id_post . "&updated=1");
                exit();
            } else {
                echo "<p>Erro ao atualizar cliente: " . htmlspecialchars($stmt->error) . "</p>";
            }
            $stmt->close();
        }
    }
}

// Se vier da atualização, pega a mensagem
$mensagem_sucesso = '';
if (isset($_GET['updated']) && $_GET['updated'] == '1') {
    $mensagem_sucesso = "<p>Cliente atualizado com sucesso!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>

<?php echo $mensagem_sucesso; ?>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo isset($cliente['id']) ? htmlspecialchars($cliente['id']) : ''; ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo isset($cliente['nome']) ? htmlspecialchars($cliente['nome']) : ''; ?>" required><br>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" value="<?php echo isset($cliente['email']) ? htmlspecialchars($cliente['email']) : ''; ?>" required><br><br>

    <button type="submit">Atualizar</button>
</form>

</body>
</html>
