<?php 
    require_once 'data.php';
    require_once 'config.php';

    $produtos = carregar_produtos(ARQUIVO_JSON);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Fiscal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="page-header">
        <a href="index.php" class="nav-back">Menu principal</a>
        <div class="eyebrow">Consulta fiscal</div>
        <h1>Tributos para <span>Nota Fiscal</span></h1>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-hl">
                <div class="dot"></div>
                <h2>Parâmetros da consulta</h2>
            </div>
        </div>

        <div class="card-body">
            <form action="process_consulta.php" method="post">

                <div class="form-group">
                    <label>Produto <span class="req">*</span></label>
                    <select name="produto">
                        <option value="" disabled selected>Selecione um produto</option>
                        <?php foreach ($produtos as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Regime tributário <span class="req">*</span></label>
                    <select name="regime">
                        <option value="" disabled selected>Selecione o regime</option>
                        <option value="ttd xx">TTD XX</option>
                        <option value="convenio xx">Convênio XX</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tipo de venda <span class="req">*</span></label>
                    <select name="regiao">
                        <option value="" disabled selected>Selecione</option>
                        <option value="interna/sc">Interna (SC)</option>
                        <option value="externa">Externa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Estado de destino</label>
                    <select name="estado">
                        <option value="" disabled selected>Selecione o estado</option>
                        <option value="pr">PR</option>
                        <option value="rs">RS</option>
                        <option value="mt">MT</option>
                        <option value="ms">MS</option>
                    </select>
                </div>

                <div class="btn-row">
                    <a href="index.php" class="btn btn-s">Cancelar</a>
                    <button type="submit" class="btn btn-p">Calcular tributos →</button>
                </div>

            </form>
        </div>
    </div>

    <footer class="page-footer">
        Projeto de estudo · <a href="https://www.linkedin.com/in/edinor-de-souza-neto/" target="_blank">Edinor de Souza Neto</a> · PHP 8.x
    </footer>

</body>
</html>