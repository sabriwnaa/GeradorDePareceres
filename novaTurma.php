<?php
require_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Turma</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Nova Turma</h1>

        <form action="criarTurma.php" method="post">
            <label for="serie">Série (número):</label><br>
            <input type="number" name="serie" id="serie" required><br><br>

            <label for="alunos">Alunos e gêneros (separe com ponto e vírgula, e indique o gênero com (M) ou (F)):</label><br>
            <textarea name="alunos" id="alunos" rows="6" cols="60" placeholder="Exemplo: Ana (F); João (M); Pedro (M)" required></textarea><br><br>

            <button type="submit">Cadastrar Turma</button>
            <a href="index.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
