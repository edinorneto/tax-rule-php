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

    else {

        foreach ($erros as $erro) {
            echo $erro . '<br>';
        }
    }
?>