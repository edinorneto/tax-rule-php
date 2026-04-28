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
                                <?php $ativo = !empty($item['ativo']); ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['nome'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($item['categoria'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($item['ncm'] ?? '') ?></td>
                                    <td>R$ <?= number_format((float)($item['preco'] ?? 0), 2, ',', '.') ?></td>
                                    <td><?= htmlspecialchars(number_format((float)($item['estoque'] ?? 0), 2, ',', '.')) ?></td>
                                    <td><?= $ativo ? 'Ativo' : 'Inativo' ?></td>
                                    <td>
                                        <a href="editar.php?id=<?= urlencode((string)($item['id'] ?? '')) ?>">Editar</a>

                                        <form action="process_status.php" method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars((string)($item['id'] ?? '')) ?>">
                                            <button type="submit" style="background:none;border:none;color:#0d6efd;cursor:pointer;padding:0;">
                                                <?= $ativo ? 'Inativar' : 'Ativar' ?>
                                            </button>
                                        </form>

                                        <form action="process_apagar.php" method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars((string)($item['id'] ?? '')) ?>">
                                            <button type="submit"
                                                    style="background:none;border:none;color:#dc3545;cursor:pointer;padding:0;"
                                                    onclick="return confirm('Tem certeza que deseja apagar este produto permanentemente?');">
                                                Apagar
                                            </button>
                                        </form>
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