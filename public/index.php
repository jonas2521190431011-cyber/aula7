<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controller\HomeController;
use App\DAO\PessoaDAO;
use App\Model\Pessoa;

$pessoaDAO = new PessoaDAO();

// Processa o cadastro de pessoas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    $p = new Pessoa();
    $p->setNome($_POST['nome']);
    $p->setCpf($_POST['cpf']);
    $p->setTelefone($_POST['telefone'] ?? null);
    $p->setEndereco($_POST['endereco'] ?? null);

    $pessoaDAO->cadastrar($p);
    header('Location: index.php?pagina=listar'); 
    exit;
}

ob_start(); 

$pagina = $_GET['pagina'] ?? 'home';


if ($pagina === 'home') {
    $controller = new HomeController();
    echo $controller->index();
} 
elseif ($pagina === 'cadastrar') {
    ?>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Cadastrar Nova Pessoa</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" maxlength="100" required>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" placeholder="Apenas números" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" maxlength="15">
                </div>
                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" maxlength="255">
                </div>
                <button type="submit" name="cadastrar" class="btn btn-success">Salvar no Banco</button>
            </form>
        </div>
    </div>
    <?php
} 
elseif ($pagina === 'listar') {
    $pessoas = $pessoaDAO->listar();
    ?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Pessoas Cadastradas</h2>
        <a href="index.php?pagina=cadastrar" class="btn btn-primary">Nova Pessoa</a>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pessoas)): ?>
                <?php foreach ($pessoas as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nome']) ?></td>
                        <td><?= htmlspecialchars($p['cpf']) ?></td>
                        <td><?= htmlspecialchars($p['telefone'] ?? '') ?></td>
                        <td><?= htmlspecialchars($p['endereco'] ?? '') ?></td>
                        <td>
                            <a href="index.php?pagina=editar&id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?pagina=excluir&id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Nenhuma pessoa cadastrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
}
elseif ($pagina === 'movimentacoes') {
    require __DIR__ . '/movimentacaolist.php';
}
elseif ($pagina === 'editar') {
    require __DIR__ . '/pessoaeditar.php';
}
elseif ($pagina === 'excluir') {
    require __DIR__ . '/pessoaexcluir.php';
}
elseif ($pagina === 'pesquisar') {
    require __DIR__ . '/pessoapesquisar.php';
}

$content = ob_get_clean();
require "layout.php";
?>