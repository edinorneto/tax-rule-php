<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICMS Tax Rule Simulator</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <h1>Simulação de Regra de ICMS de SC - Com base na UF </h1>
    <form action="process.php" method="get">
        <label for="Digite para qual estado deseja consultar:"></label>
        <input type="radio" name="UF" id="SC">
        <label for="UF">SC</label>
        <input type="radio" name="UF" id="PR">
        <label for="UF">PR</label>
        <input type="radio" name="UF" id="RS">
        <label for="UF">RS</label>
        <input type="radio" name="UF" id="MT">
        <label for="UF">MT</label>
        <input type="radio" name="UF" id="SP">
        <label for="UF">SP</label>
        <button type="submit">Consultar</button>
    </form>
</body>
</html>