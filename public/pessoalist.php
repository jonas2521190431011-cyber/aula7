<?php

require "../vendor/autoload.php";

use App\DAO\PessoaDAO;

$dao = new PessoaDAO();

$pessoas = $dao->listar();

ob_start();

?>

<h2 class="mb-4">Lista de Pessoas</h2>

<?php if (count($pessoas) > 0): ?>

```
<div class="table-responsive">

    <table class="table table-striped table-hover table-bordered">

        <thead class="table-dark">

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($pessoas as $pessoa): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($pessoa['id']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($pessoa['nome']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($pessoa['telefone'] ?? '') ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($pessoa['cpf']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($pessoa['endereco'] ?? '') ?>
                    </td>

                    <td>

                     <!-- VISUALIZAR -->
                        <a
                            href="pessoa-visualizar.php?id=<?= $pessoa['id'] ?>"
                            class="btn btn-info btn-sm"
                        >
                            Visualizar
                        </a>


                        <a
                            href="pessoa-editar.php?id=<?= $pessoa['id'] ?>"
                            class="btn btn-warning btn-sm"
                        >
                            Editar
                        </a>


                        
                        <a
                            href="pessoa-excluir.php?id=<?= $pessoa['id'] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir esta pessoa?')"
                        >
                            Excluir
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>
```

<?php else: ?>

```
<div class="alert alert-warning">
    Nenhuma pessoa cadastrada.
</div>
```

<?php endif; ?>

<?php

$content = ob_get_clean();
require "layout.php";
require "footer.php";
?>