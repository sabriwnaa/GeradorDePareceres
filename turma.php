<?php
require_once 'conexao.php';

$idTurma = intval($_GET['id'] ?? 0);
$resultado = $db->query("SELECT * FROM turmas WHERE id = $idTurma");
$turma = $resultado->fetch_assoc();

if (!$turma) {
    die("Turma não encontrada.");
}

$alunos = $db->query("SELECT * FROM alunos WHERE id_turma = $idTurma ORDER BY nome ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Turma - Série <?= $turma['serie'] ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Turma - Série <?= $turma['serie'] ?></h1>

        <h2>Alunos</h2>
        <?php if ($alunos->num_rows > 0): ?>
            <ul>
                <?php while ($aluno = $alunos->fetch_assoc()): ?>
                    <li>
                        <?= htmlspecialchars($aluno['nome']) ?> (<?= $aluno['genero'] ?>)
                        <a href="editarAluno.php?id=<?= $aluno['id'] ?>">Editar</a> |
                        <a href="removerAluno.php?id=<?= $aluno['id'] ?>&id_turma=<?= $idTurma ?>">Remover</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Nenhum aluno cadastrado. Cadastre os alunos ao criar a turma.</p>
        <?php endif; ?>

        <p><a href="index.php">⬅ Voltar</a></p>
        <p><a href="excluirTurma.php?id=<?= $idTurma ?>">🗑️ Excluir turma</a></p>
    </div>
</body>
</html>
