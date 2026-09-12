<?php

use App\DAO\PessoaDAO;

$dao = new PessoaDAO();

$pessoas = [];

$pesquisa = $_GET['pesquisa'] ?? '';

if ($pesquisa !== '') {
    $pessoas = $dao->pesquisar($pesquisa);
}
?>

<h2>Pesquisar Pessoa</h2>

<form method="GET" action="index.php">

    <input type="hidden" name="pagina" value="pesquisar">

    <div style="display: flex; gap: 10px; margin: 20px 0;">

        <input
            type="text"
            name="pesquisa"
            placeholder="Digite nome, telefone, CPF ou endereço"
            value="<?= htmlspecialchars($pesquisa) ?>"
            style="flex: 1; padding: 12px; border: 1px solid #ccc; border-radius: 7px;"
        >

        <button type="submit" class="btn">
            Pesquisar
        </button>

    </div>

</form>

<?php if ($pesquisa !== ''): ?>

    <h3>Resultado da pesquisa</h3>

    <?php if (!empty($pessoas)): ?>

        <table>

            <thead>
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

                            <a
                                href="index.php?pagina=editar&id=<?= $pessoa['id'] ?>"
                                class="btn"
                            >
                                Editar
                            </a>

                            <a
                                href="index.php?pagina=excluir&id=<?= $pessoa['id'] ?>"
                                class="btn btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir esta pessoa?')"
                            >
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php else: ?>

        <p>
            Nenhuma pessoa encontrada.
        </p>

    <?php endif; ?>

<?php endif; ?>