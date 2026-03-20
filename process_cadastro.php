<?php

require_once 'config.php';
require_once 'data.php';

    $nome = trim($_POST['nome'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $ncm = trim($_POST['ncm'] ?? '');
    $preco = trim($_POST['preco'] ?? '');
    $estoque = trim($_POST['estoque'] ?? '');
    $un = trim($_POST['unidade'] ?? '');
    $ativo = trim($_POST['ativo'] ?? 'Sim');

    $erros = [];

    if (empty($nome)) {
        $erros[] = "Nome é obrigatório.";
    }
    
    if (strlen($ncm) !== 8 || !ctype_digit($ncm)) {
        $erros[] = 'NCM inválido: deve conter exatamente 8 dígitos.';
    }

    if (!is_numeric($preco) || $preco <= 0) {
        $erros[] = 'Preço inválido.';
    }

    if (!is_numeric($estoque) || $estoque <= 0) {
        $erros[] = 'Estoque inválido.';
    }

    if (empty($un)) {
        $erros[] = 'Unidade é obrigatória.';
    }
    
    if (empty($erros)) {
        $produtos = carregar_produtos(ARQUIVO_JSON);

        $ultimo_id = 0;
        
        foreach ($produtos as $p) {
            if ($p['id'] > $ultimo_id) {
                $ultimo_id = $p['id'];
            }
        }

        $proximo_id = $ultimo_id + 1;

        $novo_produto = [
            'id' => $proximo_id,
            'nome' => $nome,
            'categoria' => $categoria,
            'ncm' => $ncm,
            'preco' => floatval($preco),
            'estoque' => floatval($estoque),
            'unidade' => $un,
            'ativo' => $ativo,
            'data_cadastro' =>  date('d/m/Y H:i')
        ];

        $produtos[] = $novo_produto;

        salvar_produtos(ARQUIVO_JSON, $produtos);

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (empty($erros)): ?>
    <div class="alert a-s">
        <span class="alert-icon">✓</span>
        <div>Produto cadastrado com sucesso!</div>
        <a href="cadastro.php" class="btn btn-s">+ Novo cadastro</a>
        <a href="index.php" class="btn btn-p">Menu principal →</a>
    </div>

<?php else: ?>
    <div class="alert a-e">
        <span class="alert-icon">✗</span>
        <div>
            <?php foreach ($erros as $erro):?>
                <p><?=$erro?></p>
            <?php endforeach; ?>
        </div>
    </div>               
    <a href="cadastro.php" class="btn btn-s">← Voltar e corrigir</a>
        
<?php endif;?>

</body>
</html>