
<?php

require __DIR__ . "/../vendor/autoload.php";

use App\DAO\PessoaDAO;





$pessoaDAO = new PessoaDAO();

$pessoas = $pessoaDAO->listar();

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Nova Movimentação</title>

    <link
        rel="stylesheet"
        href="./css/style.css?v=<?php echo time(); ?>"
    >

</head>


<body>


<nav>

    <a
        href="index.php"
        style="
            margin-left: 0;
            font-size: 1.2em;
        "
    >
        Sistema CRUD
    </a>


    <div>

        <a href="index.php?pagina=home">
            Início
        </a>

        <a href="index.php?pagina=listar">
            Pessoas
        </a>

        <a href="index.php?pagina=cadastrar">
            Cadastrar
        </a>

        <a href="index.php?pagina=pesquisar">
            Pesquisar
        </a>

        <a href="movimentacaolist.php">
            Movimentações
        </a>

        <a href="movimentacaocreate.php">
            Nova Movimentação
        </a>

    </div>

</nav>


<div class="container">


    <h2>
        Nova Movimentação
    </h2>


    <form
        action="movimentacaocadastrar.php"
        method="POST"
    >




        <div class="mb-3">

            <label for="idPessoa">

                Pessoa

            </label>


            <select
                id="idPessoa"
                name="idPessoa"
                required
            >

                <option value="">

                    Selecione uma pessoa

                </option>


                <?php foreach ($pessoas as $pessoa): ?>

                    <option
                        value="<?= htmlspecialchars($pessoa['id']) ?>"
                    >

                        <?= htmlspecialchars($pessoa['nome']) ?>

                    </option>

                <?php endforeach; ?>


            </select>

        </div>





        <div class="mb-3">

            <label for="observacao">

                Descrição

            </label>


            <input
                type="text"
                id="observacao"
                name="observacao"
                placeholder="Digite a descrição"
                maxlength="255"
                required
            >

        </div>



       
        <div class="mb-3">

            <label for="tipo">

                Tipo da movimentação

            </label>


            <select
                id="tipo"
                name="tipo"
                required
            >

                <option value="">

                    Selecione

                </option>


                <option value="CREDITO">

                    Entrada / Crédito

                </option>


                <option value="DEBITO">

                    Saída / Débito

                </option>


            </select>

        </div>




        <div class="mb-3">

            <label for="valor">

                Valor

            </label>


            <input
    type="text"
    id="valor"
    name="valor"
    placeholder="0,00"
    required
            >
        </div>

        <div class="mb-3">

            <label for="dataOperacao">

                Data da Operação

            </label>


            <input
                type="date"
                id="dataOperacao"
                name="dataOperacao"
                value="<?= date('Y-m-d') ?>"
                required
            >

        </div>



        <br>


        <button
            type="submit"
            class="btn"
        >

            Cadastrar Movimentação

        </button>


        <a
            href="movimentacaolist.php"
            class="btn"
        >

            Ver Movimentações

        </a>


    </form>


</div>


</body>

</html>
```
