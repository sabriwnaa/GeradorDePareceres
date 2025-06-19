<?php
$db = new mysqli("localhost", "root", "", "geradorpareceres");
if ($db->connect_error) {
    die("Erro na conexão com o banco de dados: " . $db->connect_error);
}
?>
