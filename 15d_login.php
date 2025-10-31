<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['cor'] = $_POST['cor'];
    header('Location: 15d_perfil.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login de Usuário</title>
</head>
<body style="font-family: Arial; background-color: #f2f2f2; text-align: center; padding-top: 50px;">
    <h2>🎨 Escolha seu estilo, baby!</h2>
    <form method="post" action="">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cor">Cor Favorita:</label><br>
        <select id="cor" name="cor" required>
            <option value="#FFD700">Dourado</option>
            <option value="#FF69B4">Rosa Choque</option>
            <option value="#00BFFF">Azul Céu</option>
            <option value="#32CD32">Verde Neon</option>
            <option value="#000000ff">Preto</option>
            <option value="#ffffffbd">Branco</option>
            <option value="#c80000b0">Vermelho</option>
            <option value="#e2902bff">Laranja</option>
            <option value="#00ff00ff">Verde claro</option>
            <option value="#023ab5ff">Azul escuro</option>
            
        </select><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>
