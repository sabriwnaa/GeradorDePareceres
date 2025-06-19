<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerador de Pareceres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gerador de Pareceres</h1>

    <h2>Turmas</h2>
    <?php
    $turmas = $conn->query("SELECT * FROM turmas ORDER BY serie ASC");

    if ($turmas->num_rows > 0) {
        echo "<ul>";
        while ($turma = $turmas->fetch_assoc()) {
            echo "<li>
                    Série {$turma['serie']}
                    <a href='turma.php?id={$turma['id']}'>Ver turma</a> |
                    <a href='gerarParecer.php?id_turma={$turma['id']}'>Gerar parecer</a>
                </li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nenhuma turma cadastrada. <a href='novaTurma.php'>Cadastrar nova turma</a></p>";
    }
    ?>

    <p><a href="novaTurma.php">➕ Cadastrar nova turma</a></p>

    <h2>Conceitos</h2>
    <?php
    $conceitos = $conn->query("SELECT c.*, COUNT(p.id) AS total_pareceres
                               FROM conceitos c
                               LEFT JOIN pareceres p ON c.id = p.id_conceito
                               GROUP BY c.id
                               ORDER BY peso ASC");

    if ($conceitos->num_rows > 0) {
        echo "<ul>";
        while ($conceito = $conceitos->fetch_assoc()) {
            echo "<li>
                    Conceito: <strong>{$conceito['nome']}</strong> |
                    Pareceres cadastrados: {$conceito['total_pareceres']}
                    <a href='novoParecer.php?id_conceito={$conceito['id']}'>Cadastrar parecer</a>
                </li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nenhum conceito cadastrado. Cadastre diretamente no banco de dados com nome e peso (por enquanto).</p>";
    }
    ?>

</body>
</html>
