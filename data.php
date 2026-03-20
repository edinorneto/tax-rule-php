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