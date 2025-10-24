<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Upload de Imagem</title>
    <style>
        body {
            background-color: #111;
            color: #eee;
            font-family: "JetBrains Mono", monospace;
            text-align: center;
            padding-top: 50px;
        }
        form {
            background: #1a1a1a;
            display: inline-block;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px #00ff99;
        }
        input, button {
            margin-top: 10px;
            padding: 8px;
            border: none;
            border-radius: 6px;
        }
        input[type="file"] {
            background: #222;
            color: #00ff99;
        }
        button {
            background: #00ff99;
            color: #111;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }
        button:hover {
            background: #00cc77;
        }
        img {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #00ff99;
        }
    </style>
</head>
<body>

    <form method="post" enctype="multipart/form-data">
        <label for="imagem">Selecione uma imagem:</label><br>
        <input type="file" name="imagem" accept="image/*" required><br>
        <button type="submit">Enviar Upload</button>
    </form>

    <?php
    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $diretorio_destino = 'uploads/';

        // Cria a pasta se não existir
        if (!is_dir($diretorio_destino)) {
            mkdir($diretorio_destino, 0777, true);
        }

        $nome_arquivo = basename($_FILES['imagem']['name']);
        $tipo_arquivo = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

        // Verifica se é imagem
        $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($tipo_arquivo, $tipos_permitidos)) {
            echo "<p style='color:red;'>⚠️ Tipo de arquivo não permitido. Envie apenas imagens!</p>";
            exit;
        }

        // Evita sobrescrita criando um nome único
        $nome_unico = uniqid("img_", true) . "." . $tipo_arquivo;
        $caminho_completo = $diretorio_destino . $nome_unico;

        // Move o arquivo enviado
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_completo)) {
            echo "<p style='color:#00ff99;'>✅ Upload realizado com sucesso!</p>";
            echo "<img src='$caminho_completo' alt='Imagem enviada' style='max-width:300px;'>";
        } else {
            echo "<p style='color:red;'>❌ Erro ao fazer upload do arquivo.</p>";
        }
    }
    ?>

</body>
</html>

