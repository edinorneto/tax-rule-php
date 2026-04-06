<?php

function carregar_produtos($caminho) {
    if (!file_exists($caminho)) {
        return [];
    }

    $json = file_get_contents($caminho);

    if ($json === false) {
        echo 'Erro ao ler o arquivo. Verifique permissões.';
        return [];
    }

    $dados = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'Arquivo corrompido ou mal formatado. Retornando lista vazia.';
        return [];
    }

    return $dados;
}

function salvar_produtos($caminho, $produtos) {
    $json = json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if (file_put_contents($caminho, $json) === false) {
        echo 'Erro ao salvar arquivo. Verifique permissões ou espaço em disco.';
        return;
    }
}

function atualizar_produto($arquivo, $id, $novos_dados) { // recebe caminho do JSON, id que quero att e array com campos vindos do formulário
    $dados = carregar_produtos($arquivo); // 1 - carregar le o arquivo json e retorna um array de produtos (minha funcao pronta, so indicar o que ela recebe)

    foreach ($dados as $i => $produto) { // 2 - achar. para cada indice do array => produto
        if ($id == $produto['id']) { // se o produto atual, é id que quero
            $produto_atualizado = $produto; // atualizo, inicio o merge

            foreach ($novos_dados as $campo => $valor) { // 3 - alterar. pra cada campo que veio do formulário 

                if ($campo === 'id' || $campo === 'data_cadastro') continue; // se houve alteração em algum campo desse desconsidere

                if (trim((string)$valor) === '') continue; // se ficar em branco desconsidere

                if ($campo === 'preco' || $campo === 'estoque') { // se for preco ou estoque e o valor não for numérico desconsidere
                    if (!is_numeric($valor)) continue;
                    $produto_atualizado[$campo] = floatval($valor); // se nao, converta pra valor
                    continue;
                }

                $produto_atualizado[$campo] = trim((string)$valor); // se for um campo sem ser os mencioados, salva o valor

            }

            $dados[$i] = $produto_atualizado; // faz a atualizacao a partir do id
            salvar_produtos($arquivo, $dados); // salva
            return $produto_atualizado; // retorna o valor atualizado

        }
    }
    
    return false; // se nao achar, retorna falso

}

function alternar_status($arquivo, $id) {
    
    $dados = carregar_produtos($arquivo);

    foreach ($dados as $i => $produto) {
        $produto_atualizado = $produto;

        if ($id == $produto['id']) {
            
            $novo_status = ($produto_atualizado['ativo'] === '1') ? '0' : '1';
            $produto_atualizado['ativo'] = $novo_status;

            $dados[$i] = $produto_atualizado;

            salvar_produtos($arquivo, $dados);
            return $produto_atualizado;
        }
    }

    return false;

}

?>