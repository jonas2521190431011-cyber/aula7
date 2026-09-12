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
   
    <div class="container" style="position: relative; overflow: hidden; min-height: 90vh; display: flex; flex-direction: column;">
        <video autoplay loop muted playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1; opacity: 1;">
            <source src="img/meuvideo.mp4" type="video/mp4">
        </video>

        <div style="position: relative; z-index: 1; padding: 20px;">
            <?= $content ?>
        </div>
    </div>
<?php else: ?>
    
    <div class="container">
        <?= $content ?>
    </div>
<?php endif; ?>

</body>
</html>