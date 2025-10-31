<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['cor'])) {
    header('Location: 15d_login.php');
    exit();
}

$nome = $_SESSION['nome'];
$cor = $_SESSION['cor'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($nome) ?></title>
</head>
<body style="background-color: <?= htmlspecialchars($cor) ?>; color: #fff; font-family: Arial; text-align: center; padding-top: 100px;">
    <h1>👋 Olá, <?= htmlspecialchars($nome) ?>!</h1>
    <p>Seja bem-vindo(a) ao seu cantinho colorido 💫</p>
    <p><a href="15d_logout.php" style="color: white; text-decoration: underline;">Sair</a></p>
</body>
</html>
