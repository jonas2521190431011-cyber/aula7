<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pessoas</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <a href="index.php?pagina=home">Início</a>
    <a href="index.php?pagina=cadastrar">Cadastrar Pessoa</a>
    <a href="index.php?pagina=listar">Listar Pessoas</a>
    <a href="index.php?pagina=pesquisar">Pesquisar Pessoas</a>
    <a href="movimentacaocreate.php">Nova Movimentação</a>
    <a href="movimentacaolist.php">Movimentações</a>
</nav>

<?php 
    
    $paginaAtual = $_GET['pagina'] ?? 'home'; 
    $ehHome = ($paginaAtual === 'home' || $paginaAtual === '');
?>

<?php if ($ehHome): ?>
   
    
<?php else: ?>
    
    <div class="container">
        <?= $content ?>
    </div>
<?php endif; ?>

</body>
</html>