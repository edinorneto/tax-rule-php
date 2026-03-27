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

$cfop      = isset($resultado['cfop'])      ? $resultado['cfop']      : '-';
$cst       = isset($resultado['cst'])       ? $resultado['cst']       : '-';
$trib_icms = isset($resultado['trib_icms']) ? $resultado['trib_icms'] : '-';
$icms      = isset($resultado['icms'])      ? $resultado['icms']      : '-';
$ipi       = isset($resultado['ipi'])       ? $resultado['ipi']       : '-';
$pis       = isset($resultado['pis'])       ? $resultado['pis']       : '-';    
$cofins    = isset($resultado['cofins'])    ? $resultado['cofins']    : '-';
$descricao = isset($resultado['descricao']) ? $resultado['descricao'] : '-';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Consulta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="page-header">
        <a href="consulta.php" class="nav-back">Nova consulta</a>
        <div class="eyebrow">Resultado fiscal</div>
        <h1>Informações para <span>NF-e</span></h1>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-hl">
                <div class="dot dot-g"></div>
                <h2><?= $produto_selecionado['nome'] ?? '-' ?></h2>
            </div>
            <span class="badge b-o"><?= strtoupper($regime) ?></span>
        </div>

        <div class="rs">
            <div class="rst">1 · Dados do produto</div>
            <div class="rt">
                <div class="rr">
                    <span class="rl">Nome</span>
                    <span class="rv"><?= $produto_selecionado['nome'] ?? '-' ?></span>
                </div>
                <div class="rr">
                    <span class="rl">NCM</span>
                    <span class="rv"><?= $produto_selecionado['ncm'] ?? '-' ?></span>
                </div>
                <div class="rr">
                    <span class="rl">Preço unitário</span>
                    <span class="rv">R$ <?= number_format($produto_selecionado['preco'] ?? 0, 2, ',', '.') ?></span>
                </div>
                <div class="rr">
                    <span class="rl">Estoque</span>
                    <span class="rv"><?= $produto_selecionado['estoque'] ?? '-' ?> <?= $produto_selecionado['unidade'] ?? '' ?></span>
                </div>
                <div class="rr tot">
                    <span class="rl">Valor total</span>
                    <span class="rv">R$ <?= number_format(($produto_selecionado['preco'] ?? 0) * ($produto_selecionado['estoque'] ?? 0), 2, ',', '.') ?></span>
                </div>
            </div>
        </div>

        <div class="rs">
            <div class="rst">2 · Dados fiscais</div>
            <div class="rt">
                <div class="rr">
                    <span class="rl">CFOP</span>
                    <span class="rv"><?= $cfop ?></span>
                </div>
                <div class="rr">
                    <span class="rl">CST</span>
                    <span class="rv"><?= $cst ?></span>
                </div>
                <div class="rr">
                    <span class="rl">Tributação ICMS</span>
                    <span class="rv"><?= $trib_icms ?></span>
                </div>
                <div class="rr">
                    <span class="rl">Destino</span>
                    <span class="rv"><?= strtoupper($regiao_chave) ?></span>
                </div>
            </div>
        </div>

        <div class="rs">
            <div class="rst">3 · Alíquotas</div>
            <div class="tg-grid">
                <div class="tc">
                    <div class="tl">ICMS</div>
                    <div class="tv <?= $icms !== '0' && $icms !== '-' ? 'hi' : 'zero' ?>"><?= $icms ?></div>
                    <div class="tu">%</div>
                </div>
                <div class="tc">
                    <div class="tl">IPI</div>
                    <div class="tv zero"><?= $ipi ?></div>
                    <div class="tu">%</div>
                </div>
                <div class="tc">
                    <div class="tl">PIS</div>
                    <div class="tv zero"><?= $pis ?></div>
                    <div class="tu">%</div>
                </div>
                <div class="tc">
                    <div class="tl">COFINS</div>
                    <div class="tv zero"><?= $cofins ?></div>
                    <div class="tu">%</div>
                </div>
            </div>
        </div>

        <div class="rs">
            <div class="rst">4 · Descrição legal</div>
            <div class="legal"><?= $descricao ?></div>
        </div>

        <div class="rs">
            <div class="btn-row">
                <a href="consulta.php" class="btn btn-s">← Nova consulta</a>
                <a href="index.php" class="btn btn-p">Menu principal</a>
            </div>
        </div>

    </div>

    <footer class="page-footer">
        Projeto de estudo · <a href="https://www.linkedin.com/in/edinor-de-souza-neto/" target="_blank">Edinor de Souza Neto</a> · PHP 8.x
    </footer>

</body>
</html>