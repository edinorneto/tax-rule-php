<?php
require_once 'config.php';
require_once 'data.php';
require_once 'tax_rules.php';

$produto_id = $_POST['produto'] ?? "";
$regime = $_POST['regime'] ?? "";
$regiao = $_POST['regiao'] ?? "";
$estado = $_POST['estado'] ?? "";

if ($regiao === 'externa') {
    $regiao_chave = $regiao . "/" . $estado;
} else {
    $regiao_chave = $regiao;
}

switch ($regime) {
    case 'ttd xx':
    case 'convenio xx':
        $resultado = obter_informacoes($regime, $regiao_chave);
        break;
    default:
        $resultado = null;
        break;
}

$produtos = carregar_produtos(ARQUIVO_JSON);
$produto_selecionado = null;

foreach ($produtos as $p) {
    if ($p['id'] == $produto_id) {
        $produto_selecionado = $p;
        break;
    }
}
?>