<?php

use App\DAO\PessoaDAO;

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?pagina=listar");
    exit;
}

$dao = new PessoaDAO();

if ($dao->excluir((int)$id)) {
    echo "<script>
        alert('Pessoa excluída com sucesso!');
        window.location='index.php?pagina=listar';
    </script>";
} else {
    echo "<script>
        alert('Erro ao excluir a pessoa!');
        window.location='index.php?pagina=listar';
    </script>";
}
exit;