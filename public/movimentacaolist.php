<?php

require "../vendor/autoload.php";

use App\DAO\MovimentacaoDAO;

$dao = new MovimentacaoDAO();

$movimentacoes = $dao->listar();

ob_start();

?>

<h2 class="mb-4">Lista de Movimentações</h2>


<?php if (count($movimentacoes) > 0): ?>

    <div class="table-responsive">

        <table class="table table-striped table-hover table-bordered">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Pessoa</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Data</th>

                </tr>

            </thead>


            <tbody>

                <?php foreach ($movimentacoes as $movimentacao): ?>


                    <?php

                    /*
                        DESCOBRIR SE É CRÉDITO OU DÉBITO
                    */

                    if (
                        $movimentacao['Credito'] !== null
                        && $movimentacao['Credito'] > 0
                    ) {

                        $tipo = 'Entrada';

                        $valor = $movimentacao['Credito'];

                    } else {
                        $tipo = 'Saída';
                        $valor = $movimentacao['Debito'];
                    }
                    ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($movimentacao['id']) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars(
                                $movimentacao['pessoa_nome']
                            ) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars(
                                $movimentacao['Observacao']
                            ) ?>
                        </td>
                        <td>
                            <?php if ($tipo === 'Entrada'): ?>
                                <span class="badge bg-success">
                                    Entrada
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger">
                                    Saída
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            R$
                            <?= number_format(
                                $valor,
                                2,
                                ',',
                                '.'
                            ) ?>
                        </td>
                        <td>
                            <?= date(
                                'd/m/Y',
                                strtotime(
                                    $movimentacao['DataOperacao']
                                )
                            ) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        Nenhuma movimentação cadastrada.
    </div>
<?php endif; ?>
<?php
$content = ob_get_clean();
require "layout.php";
require "footer.php";
?>