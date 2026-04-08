<?php 
require_once 'data.php';
require_once 'config.php';

$produtos = carregar_produtos(ARQUIVO_JSON);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <section class="card">
            <header class="card-header">
                <h1>Lista de Produtos</h1>
                <a href="produto-form.php" class="btn btn-primary">Novo Produto</a>
            </header>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>NCM</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($produtos)) { ?>
                            <?php foreach ($produtos as $item) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['nome'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($item['categoria'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($item['ncm'] ?? '') ?></td>
                                    <td>R$ <?= number_format((float)($item['preco'] ?? 0), 2, ',', '.') ?></td>
                                    <td><?= htmlspecialchars(number_format((float)($item['estoque'] ?? 0), 2, ",", ".")) ?></td>
                                    <?php $ativo = !empty($item['ativo']); ?>
                                    <td><?= $ativo ? 'Ativo' : 'Inativo' ?></td>
                                    <td>
                                        <a href="produto-form.php?id=<?= urlencode((string)($item['id'] ?? '')) ?>">Editar</a>
                                        <a href="produto-status.php?id=<?= urlencode((string)($item['id'] ?? '')) ?>">
                                            <?= $ativo ? 'Inativar' : 'Ativar' ?>
                                        </a>
                                        <a href="produto-apagar.php?id=<?= urlencode((string)($item['id'] ?? '')) ?>"
                                        onclick="return confirm('Tem certeza que deseja apagar este produto?');">
                                        Apagar
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7">Nenhum produto encontrado.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>