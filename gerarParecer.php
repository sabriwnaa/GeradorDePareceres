<?php
require_once 'conexao.php';
$idTurma = intval($_GET['id_turma'] ?? 0);
$alunos = $db->query("SELECT * FROM alunos WHERE id_turma = $idTurma ORDER BY nome ASC");
$conceitos = $db->query("SELECT * FROM conceitos ORDER BY peso ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerar Pareceres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Gerar Pareceres</h1>
    <form action="verParecer.php" method="post">
        <input type="hidden" name="id_turma" value="<?= $idTurma ?>">

        <?php foreach ($alunos as $aluno): ?>
            <p>
                <strong><?= htmlspecialchars($aluno['nome']) ?></strong> (<?= $aluno['genero'] ?>):
                <select name="conceito[<?= $aluno['id'] ?>]" required>
                    <option value="">Selecione</option>
                    <?php foreach ($conceitos as $conceito): ?>
                        <option value="<?= $conceito['id'] ?>"><?= $conceito['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        <?php endforeach; ?>

        <button type="submit">Gerar Pareceres</button>
        <a href="index.php">Cancelar</a>
    </form>
</div>
</body>
</html>
