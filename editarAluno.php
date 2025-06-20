<?php
require_once 'conexao.php';

$idAluno = intval($_GET['id'] ?? 0);

// Primeiro, busca os dados do aluno
$resultado = $db->query("SELECT * FROM alunos WHERE id = $idAluno");
$aluno = $resultado->fetch_assoc();

if (!$aluno) {
    die("Aluno não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = trim($_POST['nome']);
    if ($novoNome !== '') {
        $stmt = $db->prepare("UPDATE alunos SET nome = ? WHERE id = ?");
        $stmt->bind_param("si", $novoNome, $idAluno);
        $stmt->execute();
        $stmt->close();

        header("Location: turma.php?id=" . $aluno['id_turma']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Nome do Aluno</h1>
        <form method="post">
            <label for="nome">Nome:</label><br>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($aluno['nome']) ?>" required><br><br>
            <button type="submit">Salvar</button>
            <a href="turma.php?id=<?= $aluno['id_turma'] ?>">Cancelar</a>
        </form>
    </div>
</body>
</html>
