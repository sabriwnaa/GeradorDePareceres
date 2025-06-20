<?php
require_once 'conexao.php';
$idConceito = intval($_GET['id_conceito'] ?? 0);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Parecer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Parecer(es)</h1>
        <form action="criarParecer.php" method="post">
            <input type="hidden" name="id_conceito" value="<?= $idConceito ?>">

            <label for="textos">Digite os pareceres (separados por ponto e vírgula `;`):</label><br>
            <textarea name="textos" id="textos" rows="6" cols="60" required></textarea><br><br>

            <p>Use <strong>(nome)</strong> para o nome do aluno e <strong>_</strong> para o marcador de gênero ("a" ou "o").</p>

            <button type="submit">Cadastrar</button>
            <a href="index.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
