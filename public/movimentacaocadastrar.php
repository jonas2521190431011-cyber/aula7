```php
<?php

require __DIR__ . "/../vendor/autoload.php";

use App\Model\Movimentacao;
use App\DAO\MovimentacaoDAO;





if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: movimentacaocreate.php'
    );

    exit;

}




$idPessoa = (int) (
    $_POST['idPessoa'] ?? 0
);

$observacao = trim(
    $_POST['observacao'] ?? ''
);

$tipo = $_POST['tipo'] ?? '';

$valor = (float) (
    $_POST['valor'] ?? 0
);

$dataOperacao =
    $_POST['dataOperacao']
    ?? date('Y-m-d');





if (
    $idPessoa <= 0 ||
    $observacao === '' ||
    $valor <= 0 ||
    !in_array(
        $tipo,
        ['CREDITO', 'DEBITO'],
        true
    )
) {

    echo "

        <script>

            alert(
                'Preencha todos os campos corretamente!'
            );

            window.location =
                'movimentacaocreate.php';

        </script>

    ";

    exit;
}




$movimentacao =
    new Movimentacao();


$movimentacao->setIdPessoa(
    $idPessoa
);


$movimentacao->setObservacao(
    $observacao
);


$movimentacao->setDataOperacao(
    $dataOperacao
);




if ($tipo === 'CREDITO') {

    $movimentacao->setCredito(
        $valor
    );

    $movimentacao->setDebito(
        null
    );

}



if ($tipo === 'DEBITO') {

    $movimentacao->setDebito(
        $valor
    );

    $movimentacao->setCredito(
        null
    );

}




try {

    $dao =
        new MovimentacaoDAO();


    if (
        $dao->inserir(
            $movimentacao
        )
    ) {

        echo "

            <script>

                alert(
                    'Movimentação cadastrada com sucesso!'
                );

                window.location =
                    'movimentacaolist.php';

            </script>

        ";

    } else {

        echo "

            <script>

                alert(
                    'Erro ao cadastrar movimentação!'
                );

                window.location =
                    'movimentacaocreate.php';

            </script>

        ";

    }

} catch (Exception $e) {

    echo "

        <h2>Erro ao cadastrar movimentação</h2>

        <p>

            " .
            htmlspecialchars(
                $e->getMessage()
            )
            . "

        </p>

        <a
            href='movimentacaocreate.php'
        >

            Voltar

        </a>

    ";

}

exit;
