<?php 
require_once 'data.php';
require_once 'config.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    header('Location: index.php');
    exit;
}

$erros = [];

$id        = trim($_POST['id'] ?? '');
$nome      = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$ncm       = trim($_POST['ncm'] ?? '');
$preco     = trim($_POST['preco'] ?? '');
$estoque   = trim($_POST['estoque'] ?? '');
$unidade   = trim($_POST['unidade'] ?? '');
$ativo = trim((string)($_POST['ativo'] ?? '1'));
if ($ativo !== '0' && $ativo !== '1') {
    $erros[] = 'Status inválido.';
}
$ativo = (int)$ativo;



if ($id === '') {
    $erros[] = 'ID do produto é obrigatório.';
}

if ($nome === '') {
    $erros[] = 'Nome é obrigatório.';
}

if ($categoria === '') {
    $erros[] = 'Categoria é obrigatória.';
}

if ($ncm === '' || !preg_match('/^\d{8}$/', $ncm)) {
    $erros[] = 'NCM deve conter 8 dígitos numéricos.';
}

if ($preco === '' || !is_numeric($preco) || (float)$preco < 0) {
    $erros[] = 'Preço inválido.';
}

if ($estoque === '' || !is_numeric($estoque) || (float)$estoque < 0) {
    $erros[] = 'Estoque inválido.';
}

if ($unidade === '') {
    $erros[] = 'Unidade é obrigatória.';
}

$sucesso = false;
$mensagem = '';

if (empty($erros)) {
    $dadosAtualizados = [
        'nome' => $nome,
        'descricao' => $descricao,
        'categoria' => $categoria,
        'ncm' => $ncm,
        'preco' => (float)$preco,
        'estoque' => (float)$estoque,
        'unidade' => $unidade,
        'ativo' => $ativo
    ];

    $sucesso = atualizar_produto(ARQUIVO_JSON, $id, $dadosAtualizados);

    if ($sucesso) {
        $mensagem = 'Produto atualizado com sucesso.';
    } else {
        $mensagem = 'Erro ao atualizar produto.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <section class="card">
            <header class="card-header">
                <h1>Atualização de Produto</h1>
            </header>

            <div class="card-body">
                <?php if (!empty($erros)) { ?>
                    <p><strong>Não foi possível atualizar:</strong></p>
                    <ul>
                        <?php foreach ($erros as $erro) { ?>
                            <li><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php } ?>
                    </ul>
                    <p>
                        <a class="btn btn-secondary" href="javascript:history.back()">Voltar</a>
                        <a class="btn btn-primary" href="produtos.php">Ir para lista</a>
                    </p>
                <?php } else { ?>
                    <p><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></p>
                    <p>
                        <a class="btn btn-secondary" href="produtos.php">Voltar para lista</a>
                        <?php if ($sucesso) { ?>
                            <a class="btn btn-primary" href="editar.php?id=<?= urlencode((string)$id) ?>">Continuar editando</a>
                        <?php } ?>
                    </p>
                <?php } ?>
            </div>
        </section>
    </main>
</body>
</html>