<?php
require_once 'conexao.php';
require_once 'funcoes.php';

$idTurma = intval($_POST['id_turma'] ?? 0);
$conceitosSelecionados = $_POST['conceito'] ?? [];

$pareceres = [];

foreach ($conceitosSelecionados as $idAluno => $idConceito) {
    $resAluno = $db->query("SELECT * FROM alunos WHERE id = $idAluno");
    $resParecer = $db->query("SELECT * FROM pareceres WHERE id_conceito = $idConceito ORDER BY RAND() LIMIT 1");

    if ($resAluno && $resParecer && $resAluno->num_rows && $resParecer->num_rows) {
        $aluno = $resAluno->fetch_assoc();
        $modelo = $resParecer->fetch_assoc()['texto'];

        $textoFinal = gerarTextoParecer($modelo, $aluno['nome'], $aluno['genero']);
        $pareceres[] = $textoFinal;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pareceres Gerados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Pareceres Gerados</h1>

    <?php if (empty($pareceres)): ?>
        <p>Nenhum parecer pôde ser gerado.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($pareceres as $p): ?>
                <li><?= $p ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="index.php">⬅ Voltar à página inicial</a></p>
</div>
</body>
</html>
