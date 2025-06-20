<?php
require_once 'conexao.php';

$idAluno = intval($_GET['id'] ?? 0);
$idTurma = intval($_GET['id_turma'] ?? 0);

$db->query("DELETE FROM alunos WHERE id = $idAluno");

header("Location: turma.php?id=$idTurma");
exit;
