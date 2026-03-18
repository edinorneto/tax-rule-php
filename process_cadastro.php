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
    
    if (empty($erros)) {

        salvar_produtos(ARQUIVO_JSON, $produtos);

    }

    else {

        foreach ($erros as $erro) {
            echo $erro . '<br>';
        }
    }

?>