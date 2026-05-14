<?php
require_once 'data.php';
require_once 'config.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    header('Location: index.php');
    exit;
}

$id = trim($_POST['id'] ?? '');

if ($id !== '') {
    apagar_produto(ARQUIVO_JSON, $id);
}

header('Location: produtos.php');
exit;