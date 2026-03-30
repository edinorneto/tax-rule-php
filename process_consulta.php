<?php
require_once 'config.php';
require_once 'data.php';
require_once 'tax_rules.php';

$produto_id = $_POST['produto'] ?? "";
$regime = $_POST['regime'] ?? "";
$regiao = $_POST['regiao'] ?? "";
$estado = $_POST['estado'] ?? "";

$erros = [];

// validações mínimas
if ($produto_id === "") {
    $erros[] = "Selecione um produto.";
}
if ($regime === "") {
    $erros[] = "Selecione um regime.";
}
if ($regiao === "") {
    $erros[] = "Selecione o tipo de venda.";
}
if ($regiao === "externa" && $estado === "") {
    $erros[] = "Selecione o estado de destino para venda externa.";
}

$regiao_chave = ($regiao === 'externa') ? ($regiao . "/" . $estado) : $regiao;

$resultado = [];
if (empty($erros)) {
    switch ($regime) {
        case 'ttd xx':
        case 'convenio xx':
            $resultado = obter_informacoes($regime, $regiao_chave);
            break;
        default:
            $erros[] = "Regime inválido.";
            $resultado = [];
            break;
    }
}

$produtos = carregar_produtos(ARQUIVO_JSON);
$produto_selecionado = null;

foreach ($produtos as $p) {
    if (($p['id'] ?? null) == $produto_id) {
        $produto_selecionado = $p;
        break;
    }
}

if ($produto_selecionado === null) {
    $erros[] = "Produto não encontrado.";
}

// defaults
$cfop      = $resultado['cfop']      ?? '-';
$cst       = $resultado['cst']       ?? '-';
$trib_icms = $resultado['trib_icms'] ?? '-';
$icms      = $resultado['icms']      ?? '-';
$ipi       = $resultado['ipi']       ?? '-';
$pis       = $resultado['pis']       ?? '-';
$cofins    = $resultado['cofins']    ?? '-';
$descricao = $resultado['descricao'] ?? '-';

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

<?php if (!empty($erros)): ?>
    <div class="alert a-e">
        <span class="alert-icon">✗</span>
        <div>
            <?php foreach ($erros as $erro): ?>
                <p><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <a href="consulta.php" class="btn btn-s">← Voltar</a>

<?php else: ?>
    <div class="card">
        <div class="card-header">
            <div class="card-hl">
                <div class="dot dot-g"></div>
                <h2><?= htmlspecialchars((string)($produto_selecionado['nome'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></h2>
            </div>
            <span class="badge b-o"><?= htmlspecialchars(strtoupper($regime), ENT_QUOTES, 'UTF-8') ?></span>
        </div>

        <div class="rs">
            <div class="rst">1 · Dados do produto</div>
            <div class="rt">
                <div class="rr">
                    <span class="rl">Nome</span>
                    <span class="rv"><?= htmlspecialchars((string)($produto_selecionado['nome'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="rr">
                    <span class="rl">NCM</span>
                    <span class="rv"><?= htmlspecialchars((string)($produto_selecionado['ncm'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="rr">
                    <span class="rl">Preço unitário</span>
                    <span class="rv">R$ <?= number_format((float)($produto_selecionado['preco'] ?? 0), 2, ',', '.') ?></span>
                </div>
                <div class="rr">
                    <span class="rl">Estoque</span>
                    <span class="rv">
                        <?= htmlspecialchars((string)($produto_selecionado['estoque'] ?? '-'), ENT_QUOTES, 'UTF-8') ?>
                        <?= htmlspecialchars((string)($produto_selecionado['unidade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                    </span>
                </div>
                <div class="rr tot">
                    <span class="rl">Valor total</span>
                    <span class="rv">
                        R$ <?= number_format(((float)($produto_selecionado['preco'] ?? 0)) * ((float)($produto_selecionado['estoque'] ?? 0)), 2, ',', '.') ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="rs">
            <div class="rst">2 · Dados fiscais</div>
            <div class="rt">
                <div class="rr">
                    <span class="rl">CFOP</span>
                    <span class="rv"><?= htmlspecialchars((string)$cfop, ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="rr">
                    <span class="rl">CST</span>
                    <span class="rv"><?= htmlspecialchars((string)$cst, ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="rr">
                    <span class="rl">Tributação ICMS</span>
                    <span class="rv"><?= htmlspecialchars((string)$trib_icms, ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="rr">
                    <span class="rl">Destino</span>
                    <span class="rv"><?= htmlspecialchars(strtoupper($regiao_chave), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            </div>
        </div>

        <div class="rs">
            <div class="rst">3 · Alíquotas</div>
            <div class="tg-grid">
                <div class="tc">
                    <div class="tl">ICMS</div>
                    <div class="tv <?= ($icms !== '0' && $icms !== '-') ? 'hi' : 'zero' ?>"><?= htmlspecialchars((string)$icms, ENT_QUOTES, 'UTF-8') ?></div>
                    <div class="tu">%</div>
                </div>
                <div class="tc">
                    <div class="tl">IPI</div>
                    <div class="tv zero"><?= htmlspecialchars((string)$ipi, ENT_QUOTES, 'UTF-8') ?></div>
                    <div class="tu">%</div>
                </div>
                <div class="tc">
                    <div class="tl">PIS</div>
                    <div class="tv zero"><?= htmlspecialchars((string)$pis, ENT_QUOTES, 'UTF-8') ?></div>
                    <div class="tu">%</div>
                </div>
                <div class="tc">
                    <div class="tl">COFINS</div>
                    <div class="tv zero"><?= htmlspecialchars((string)$cofins, ENT_QUOTES, 'UTF-8') ?></div>
                    <div class="tu">%</div>
                </div>
            </div>
        </div>

        <div class="rs">
            <div class="rst">4 · Descrição legal</div>
            <div class="legal"><?= htmlspecialchars((string)$descricao, ENT_QUOTES, 'UTF-8') ?></div>
        </div>

        <div class="rs">
            <div class="btn-row">
                <a href="consulta.php" class="btn btn-s">← Nova consulta</a>
                <a href="index.php" class="btn btn-p">Menu principal</a>
            </div>
        </div>
    </div>
<?php endif; ?>

    <footer class="page-footer">
        Projeto de estudo · <a href="https://www.linkedin.com/in/edinor-de-souza-neto/" target="_blank">Edinor de Souza Neto</a> · PHP 8.x
    </footer>

</body>
</html>