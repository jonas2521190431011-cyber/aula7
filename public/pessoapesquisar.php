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

<form method="GET" action="index.php" style="margin-bottom: 20px; margin-top: 15px;">
    <input type="hidden" name="pagina" value="pesquisar">
    <div style="display: flex; gap: 10px;">
        <input
            type="text"
            style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"
            name="pesquisa"
            placeholder="Digite nome, telefone, CPF ou endereço"
            value="<?= htmlspecialchars($pesquisa) ?>"
        >
        <button type="submit" class="btn">Pesquisar</button>
    </div>
</form>

<?php if ($pesquisa !== ''): ?>
    <hr style="margin: 20px 0;">

    <?php if (count($pessoas) > 0): ?>
        <h4>Resultado da pesquisa</h4>

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
                        <td><?= htmlspecialchars($pessoa['id']) ?></td>
                        <td><?= htmlspecialchars($pessoa['nome']) ?></td>
                        <td><?= htmlspecialchars($pessoa['telefone'] ?? '') ?></td>
                        <td><?= htmlspecialchars($pessoa['cpf']) ?></td>
                        <td><?= htmlspecialchars($pessoa['endereco'] ?? '') ?></td>
                        <td>
                            <a href="index.php?pagina=editar&id=<?= $pessoa['id'] ?>" class="btn">Editar</a>
                            <a href="index.php?pagina=excluir&id=<?= $pessoa['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta pessoa?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="margin-top: 15px; color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 4px;">
            Nenhuma pessoa encontrada.
        </p>
    <?php endif; ?>
<?php endif; ?>