<?php

require "../vendor/autoload.php";

use App\Model\Pessoa;
use App\DAO\PessoaDAO;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'] ?? '';
    $nome = mb_strtoupper($nome, 'UTF-8');

    $telefone = $_POST['telefone'] ?? null;

    $cpf = $_POST['cpf'] ?? '';

    $endereco = $_POST['endereco'] ?? null;

    if ($endereco !== null) {
        $endereco = mb_strtoupper($endereco, 'UTF-8');
    }

    // Cria o objeto Pessoa
    $pessoa = new Pessoa();

    $pessoa->setNome($nome);
    $pessoa->setTelefone($telefone);
    $pessoa->setCpf($cpf);
    $pessoa->setEndereco($endereco);

    // Cria o DAO
    $dao = new PessoaDAO();

    // Salva no banco
    if ($dao->inserir($pessoa)) {

        echo "<script>
            alert('Dados salvos com sucesso!');
            window.location='pessoa-create.php';
        </script>";

    } else {

        echo "<script>
            alert('Erro ao salvar dados!');
            window.location='pessoa-create.php';
        </script>";
    }
}
?> 