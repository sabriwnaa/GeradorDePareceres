<?php
require_once 'conexao.php';

$idConceito = intval($_POST['id_conceito'] ?? 0);
$textos = $_POST['textos'] ?? '';

$lista = array_map('trim', explode(';', $textos));
$stmt = $db->prepare("INSERT INTO pareceres (id_conceito, texto) VALUES (?, ?)");

foreach ($lista as $texto) {
    if (!empty($texto)) {
        $stmt->bind_param("is", $idConceito, $texto);
        $stmt->execute();
    }
}

$stmt->close();
header("Location: index.php");
exit;
