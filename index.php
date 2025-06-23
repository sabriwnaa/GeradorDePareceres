<?php
require_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerador de Pareceres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gerador de Pareceres</h1>

        <div class="containerColunas">
            <div class="coluna" style='border-right: 1px solid black;'>
                <div class='cabecalho'>
                    <h2>Turmas</h2>
                     <a class='botao'  href="novaTurma.php"> + </a>
                
                </div>
                <?php
                $resultadoTurmas = $db->query("SELECT * FROM turmas ORDER BY serie ASC");

                if ($resultadoTurmas && $resultadoTurmas->num_rows > 0) {
                    echo "<div class='lista'>";
                    while ($turma = $resultadoTurmas->fetch_assoc()) {
                        echo "<div class='itemLista'>
                                <a style='text-decoration:none;' href='turma.php?id={$turma['id']}'>{$turma['serie']}º ano</a>
                                <a class='botao' href='gerarParecer.php?id_turma={$turma['id']}'>Gerar parecer</a>
                            </div>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='lista'> <p>Nenhuma turma cadastrada.</p> 
                    <a class='botao' href='novaTurma.php'>Cadastrar nova turma</a></div>";
                }
                ?>
            </div>

            <div class="coluna">
                <h2>Conceitos</h2>
                <?php
                $sql = "
                    SELECT c.*, COUNT(p.id) AS total_pareceres
                    FROM conceitos c
                    LEFT JOIN pareceres p ON c.id = p.id_conceito
                    GROUP BY c.id
                    ORDER BY peso ASC
                ";
                $resultadoConceitos = $db->query($sql);

                if ($resultadoConceitos && $resultadoConceitos->num_rows > 0) {
                    echo "<ul>";
                    while ($conceito = $resultadoConceitos->fetch_assoc()) {
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
            </div>
        </div>
    </div>
</body>
</html>
