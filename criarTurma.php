<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serie = intval($_POST['serie']);
    $entrada = $_POST['alunos'];

    // Insere a turma
    $stmt = $db->prepare("INSERT INTO turmas (serie) VALUES (?)");
    $stmt->bind_param("i", $serie);
    $stmt->execute();
    $idTurma = $stmt->insert_id;
    $stmt->close();

    // Processa os alunos
    $alunos = explode(';', $entrada);
    $stmtAluno = $db->prepare("INSERT INTO alunos (id_turma, nome, genero) VALUES (?, ?, ?)");

    foreach ($alunos as $linha) {
        $linha = trim($linha);
        if (preg_match('/^(.+)\s+\((M|F)\)$/i', $linha, $matches)) {
            $nome = trim($matches[1]);
            $genero = strtoupper($matches[2]);
            $stmtAluno->bind_param("iss", $idTurma, $nome, $genero);
            $stmtAluno->execute();
        }
    }

    $stmtAluno->close();
    header("Location: index.php");
    exit;
} else {
    header("Location: novaTurma.php");
    exit;
}
