<?php
require_once 'conexao.php';

$idTurma = intval($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['confirmar'] === 'sim') {
        $db->query("DELETE FROM alunos WHERE id_turma = $idTurma");
        $db->query("DELETE FROM turmas WHERE id = $idTurma");
        header("Location: index.php");
        exit;
    } else {
        header("Location: turma.php?id=$idTurma");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Turma</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Confirmar Exclusão</h1>
        <p>Tem certeza de que deseja excluir esta turma e todos os seus alunos?</p>
        <form method="post">
            <button type="submit" name="confirmar" value="sim">Sim, excluir</button>
            <button type="submit" name="confirmar" value="nao">Não, cancelar</button>
        </form>
    </div>
</body>
</html>
