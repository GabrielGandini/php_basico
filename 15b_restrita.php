<?php
// Página restrita (15b_restrita.php)
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: 15a_sistema.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Zona Restrita</title>
    <style>
        body {
            background: radial-gradient(circle at top, #0f0f0f, #000);
            color: #00ffcc;
            font-family: "JetBrains Mono", monospace;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        h2 {
            font-size: 2rem;
            text-shadow: 0 0 20px #00ffcc;
            animation: flicker 2s infinite;
        }

        p {
            margin-top: 10px;
            color: #ccc;
        }

        a {
            margin-top: 20px;
            background: #00ffcc;
            color: #111;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 0 15px #00ffcc;
        }

        a:hover {
            background: #00ccaa;
            box-shadow: 0 0 25px #00ffcc;
        }

        @keyframes flicker {
            0%, 18%, 22%, 25%, 53%, 57%, 100% {
                opacity: 1;
            }
            20%, 24%, 55% {
                opacity: 0.3;
            }
        }

        .glow-line {
            position: absolute;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #00ffcc, transparent);
            animation: move 3s linear infinite;
            top: 0;
        }

        @keyframes move {
            0% { top: 0; opacity: 0; }
            50% { opacity: 1; }
            100% { top: 100%; opacity: 0; }
        }
    </style>
</head>
<body>

<div class="glow-line"></div>

<h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?> 😎</h2>
<p>Esta é uma área restrita — apenas mentes autorizadas podem estar aqui.</p>

<a href="15c_logout.php">Sair do Sistema</a>

</body>
</html>
