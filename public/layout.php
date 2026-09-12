<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema CRUD - Pessoas</title>
   
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>
 <nav>
<nav>
    <a href="index.php" style="margin-left: 0; font-size: 1.2em;">Sistema CRUD</a>
    <div>
        <a href="index.php?pagina=home">Início</a>
        <a href="index.php?pagina=listar">Pessoas</a>
        <a href="index.php?pagina=cadastrar">Cadastrar</a>
        <a href="index.php?pagina=pesquisar">Pesquisar</a>
    </div>
</nav>
    <div class="container">
        <?= $content ?? '' ?>
    </div>

</body>
</html>