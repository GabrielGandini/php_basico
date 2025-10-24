<?php
// Página de login (15a_sistema.php)
session_start();

// Usuário e senha padrão (simulação de banco de dados)
$usuario_correto = 'admin';
$senha_correta_hash = password_hash('123', PASSWORD_DEFAULT); // senha: 123

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica credenciais
    if ($usuario === $usuario_correto && password_verify($senha, $senha_correta_hash)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: 15b_restrita.php");
        exit;
    } else {
        $erro = "😵 Usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background-color: #0a0a0a;
            color: #eaeaea;
            font-family: "JetBrains Mono", monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: #1a1a1a;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px #00ffcc;
            text-align: center;
        }
        input {
            margin: 10px 0;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #222;
            color: #00ffcc;
            width: 200px;
        }
        button {
            background: #00ffcc;
            color: #111;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #00ccaa;
        }
        p {
            color: red;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <form method="post" action="">
        <h2>🧠 Login do Sistema</h2>
        <label for="usuario">Usuário:</label><br>
        <input type="text" name="usuario" required><br>
        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" required><br>
        <button type="submit">Entrar</button>

        <?php
        if (isset($erro)) {
            echo "<p>$erro</p>";
        }
        ?>
    </form>

</body>
</html>
