<?php

require __DIR__ . "/../vendor/autoload.php";

use App\DAO\MovimentacaoDAO;


$dao =
    new MovimentacaoDAO();


$movimentacoes =
    $dao->listar();

?>


<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Movimentações</title>

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
            font-weight: bold;
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


    <div
        style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        "
    >

        <h2>

            Movimentações

        </h2>


        <a
            href="movimentacaocreate.php"
            class="btn"
        >

            + Nova Movimentação

        </a>

    </div>



    <?php if (!empty($movimentacoes)): ?>


        <table>

            <thead>

                <tr>

                    <th>
                        ID
                    </th>

                    <th>
                        Pessoa
                    </th>

                    <th>
                        Descrição
                    </th>

                    <th>
                        Tipo
                    </th>

                    <th>
                        Valor
                    </th>

                    <th>
                        Data
                    </th>

                </tr>

            </thead>


            <tbody>


                <?php foreach (
                    $movimentacoes
                    as $movimentacao
                ): ?>


                    <?php

                    if (
                        !empty(
                            $movimentacao['Credito']
                        )
                        &&
                        $movimentacao['Credito'] > 0
                    ) {

                        $tipo =
                            'Entrada';

                        $valor =
                            $movimentacao['Credito'];

                    } else {

                        $tipo =
                            'Saída';

                        $valor =
                            $movimentacao['Debito']
                            ?? 0;

                    }

                    ?>


                    <tr>


                        <td>

                            <?= htmlspecialchars(
                                $movimentacao['id']
                            ) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars(
                                $movimentacao['pessoa_nome']
                                ??
                                'Não encontrada'
                            ) ?>

                        </td>


                        <td>

                            <?= htmlspecialchars(
                                $movimentacao['Observacao']
                                ??
                                ''
                            ) ?>

                        </td>


                        <td>

                            <?php if (
                                $tipo === 'Entrada'
                            ): ?>

                                <strong>

                                    Entrada

                                </strong>

                            <?php else: ?>

                                <strong>

                                    Saída

                                </strong>

                            <?php endif; ?>

                        </td>


                        <td>

                            R$

                            <?= number_format(
                                (float)$valor,
                                2,
                                ',',
                                '.'
                            ) ?>

                        </td>


                        <td>

                            <?= !empty(
                                $movimentacao['DataOperacao']
                            )

                                ?

                                date(
                                    'd/m/Y',
                                    strtotime(
                                        $movimentacao[
                                            'DataOperacao'
                                        ]
                                    )
                                )

                                :

                                '-'
                            ?>

                        </td>


                    </tr>


                <?php endforeach; ?>


            </tbody>

        </table>


    <?php else: ?>


        <div class="alert alert-warning">

            Nenhuma movimentação cadastrada.

        </div>


    <?php endif; ?>


</div>


</body>

</html>