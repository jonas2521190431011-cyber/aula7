<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\HomeController;
use App\DAO\PessoaDAO;
use App\Model\Pessoa;

$pessoaDAO = new PessoaDAO();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {

    $p = new Pessoa();

    $p->setNome($_POST['nome'] ?? '');
    $p->setCpf($_POST['cpf'] ?? '');
    $p->setTelefone($_POST['telefone'] ?? null);
    $p->setEndereco($_POST['endereco'] ?? null);

    $pessoaDAO->cadastrar($p);

    header('Location: index.php?pagina=listar');
    exit;
}


$pagina = $_GET['pagina'] ?? 'home';

ob_start();

switch ($pagina) {

   

    case 'home':

        $controller = new HomeController();

        echo $controller->index();

        break;


   

    case 'cadastrar':
        ?>

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">

                <h4 class="mb-0">
                    Cadastrar Nova Pessoa
                </h4>

            </div>

            <div class="card-body">

                <form method="POST">

                    <div class="mb-3">

                        <label for="nome" class="form-label">
                            Nome Completo
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nome"
                            name="nome"
                            maxlength="100"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label for="cpf" class="form-label">
                            CPF
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="cpf"
                            name="cpf"
                            maxlength="11"
                            placeholder="Apenas números"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label for="telefone" class="form-label">
                            Telefone
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="telefone"
                            name="telefone"
                            maxlength="15"
                        >

                    </div>


                    <div class="mb-3">

                        <label for="endereco" class="form-label">
                            Endereço
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="endereco"
                            name="endereco"
                            maxlength="255"
                        >

                    </div>


                    <button
                        type="submit"
                        name="cadastrar"
                        class="btn btn-success"
                    >
                        Salvar no Banco
                    </button>

                </form>

            </div>

        </div>

        <?php
        break;


   

    case 'listar':

        $pessoas = $pessoaDAO->listar();

        ?>

        <div
            style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:20px;
            "
        >

            <h2>
                Pessoas Cadastradas
            </h2>

            <a
                href="index.php?pagina=cadastrar"
                class="btn"
            >
                Nova Pessoa
            </a>

        </div>


        <table>

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

                            <td>
                                <?= htmlspecialchars($p['id']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($p['nome']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($p['cpf']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($p['telefone'] ?? '') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($p['endereco'] ?? '') ?>
                            </td>

                            <td>

                                <a
                                    href="index.php?pagina=editar&id=<?= $p['id'] ?>"
                                    class="btn"
                                >
                                    Editar
                                </a>

                                <a
                                    href="index.php?pagina=excluir&id=<?= $p['id'] ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir?')"
                                >
                                    Excluir
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="6"
                            style="text-align:center;"
                        >
                            Nenhuma pessoa cadastrada.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

        <?php

        break;


   
    case 'editar':

        require __DIR__ . '/pessoaeditar.php';

        break;


    case 'excluir':

        require __DIR__ . '/pessoaexcluir.php';

        break;


 
    case 'pesquisar':

        require __DIR__ . '/pessoapesquisar.php';

        break;


  
    case 'movimentacoes':

        require __DIR__ . '/movimentacaolist.php';

        break;


    

    case 'movimentacao-cadastrar':

        require __DIR__ . '/movimentacaocreate.php';

        break;


  

    default:

        echo '
            <div class="alert alert-danger">
                Página não encontrada.
            </div>
        ';

        break;
}

$content = ob_get_clean();

require __DIR__ . '/layout.php';