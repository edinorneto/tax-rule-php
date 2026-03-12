<?php 
function carregar_produtos($caminho) {
    $json = file_get_contents($caminho);
    return json_decode($json, true);
}
function salvar_produtos($caminho, $produtos) {
    $json = json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($caminho, $json);
}
?>