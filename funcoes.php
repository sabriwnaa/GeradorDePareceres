<?php
function gerarTextoParecer(string $modelo, string $nome, string $genero): string {
    $letra = ($genero === 'F') ? 'a' : 'o';
    $texto = str_replace("(nome)", $nome, $modelo);
    $texto = str_replace("_", $letra, $texto);
    return $texto;
}
