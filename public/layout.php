<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pessoas</title>

    <link rel="stylesheet" href="css/style.css">


<body>

<nav>
    <a href="index.php?pagina=home">Início</a>
    <a href="index.php?pagina=cadastrar">Cadastrar Pessoa</a>
    <a href="index.php?pagina=listar">Listar Pessoas</a>
    <a href="index.php?pagina=pesquisar">Pesquisar Pessoas</a>
    <a href="movimentacaocreate.php">Nova Movimentação</a>
    <a href="movimentacaolist.php">Movimentações</a>
</nav>

<div class="container">
    <?= $content ?>
</div>

</body>
</html>