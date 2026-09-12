<?php

require "../vendor/autoload.php";

use App\Model\Pessoa;
use App\DAO\PessoaDAO;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;

    $nome = $_POST['nome'] ?? '';

    $telefone = $_POST['telefone'] ?? null;

    $cpf = $_POST['cpf'] ?? '';

    $endereco = $_POST['endereco'] ?? null;


    if (!$id) {
        header("Location: pessoa-list.php");
        exit;
    }


    $pessoa = new Pessoa();

    $pessoa->setId((int)$id);

    $pessoa->setNome(
        mb_strtoupper($nome, 'UTF-8')
    );

    $pessoa->setTelefone($telefone);

    $pessoa->setCpf($cpf);

    if ($endereco !== null) {

        $pessoa->setEndereco(
            mb_strtoupper($endereco, 'UTF-8')
        );

    } else {

        $pessoa->setEndereco(null);

    }


    $dao = new PessoaDAO();


    if ($dao->atualizar($pessoa)) {

        echo "<script>
            alert('Dados atualizados com sucesso!');
            window.location='pessoa-list.php';
        </script>";

    } else {

        echo "<script>
            alert('Erro ao atualizar os dados!');
            window.location='pessoa-list.php';
        </script>";

    }
}
?>