<?php

require "../vendor/autoload.php";

use App\Model\Movimentacao;
use App\DAO\MovimentacaoDAO;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idPessoa = $_POST['idPessoa'] ?? null;

    $observacao = $_POST['observacao'] ?? '';

    $tipo = $_POST['tipo'] ?? '';

    $valor = $_POST['valor'] ?? 0;

    $dataOperacao = $_POST['dataOperacao'] ?? null;

    $movimentacao = new Movimentacao();

    $movimentacao->setIdPessoa((int)$idPessoa);

    $movimentacao->setObservacao($observacao);

    $movimentacao->setDataOperacao($dataOperacao);



    if ($tipo === 'CREDITO') {

        $movimentacao->setCredito((float)$valor);

        $movimentacao->setDebito(null);
    }

    if ($tipo === 'DEBITO') {

        $movimentacao->setDebito((float)$valor);

        $movimentacao->setCredito(null);
    }
    $dao = new MovimentacaoDAO();

    if ($dao->inserir($movimentacao)) {

        echo "<script>

            alert('Movimentação cadastrada com sucesso!');

            window.location = 'movimentacao-create.php';

        </script>";

    } else {

        echo "<script>

            alert('Erro ao cadastrar movimentação!');

            window.location = 'movimentacao-create.php';

        </script>";
    }
}