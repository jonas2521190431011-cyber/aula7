<?php

use App\DAO\PessoaDAO;
use App\Model\Pessoa;

$dao = new PessoaDAO();

// Captura o ID da URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?pagina=listar");
    exit;
}

// Lógica de Atualização ao enviar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p = new Pessoa();
    $p->setId((int)$_POST['id']);
    $p->setNome($_POST['nome']);
    $p->setCpf($_POST['cpf']);
    $p->setTelefone($_POST['telefone'] ?? null);
    $p->setEndereco($_POST['endereco'] ?? null);

    // Se o seu DAO usa o método 'atualizar' ou 'editar':
    if (method_exists($dao, 'atualizar')) {
        $dao->atualizar($p);
    } elseif (method_exists($dao, 'editar')) {
        $dao->editar($p);
    }

    header("Location: index.php?pagina=listar");
    exit;
}

// Busca os dados da pessoa para preencher o formulário
$pessoa = $dao->buscarPorId((int)$id);

if (!$pessoa) {
    header("Location: index.php?pagina=listar");
    exit;
}

// Transforma em array se o retorno for um Objeto Pessoa
if (is_object($pessoa)) {
    $pessoaData = [
        'id' => method_exists($pessoa, 'getId') ? $pessoa->getId() : $pessoa->id,
        'nome' => method_exists($pessoa, 'getNome') ? $pessoa->getNome() : $pessoa->nome,
        'cpf' => method_exists($pessoa, 'getCpf') ? $pessoa->getCpf() : $pessoa->cpf,
        'telefone' => method_exists($pessoa, 'getTelefone') ? $pessoa->getTelefone() : $pessoa->telefone,
        'endereco' => method_exists($pessoa, 'getEndereco') ? $pessoa->getEndereco() : $pessoa->endereco,
    ];
} else {
    $pessoaData = $pessoa;
}
?>

<h2>Editar Pessoa</h2>

<form method="POST" action="index.php?pagina=editar&id=<?= htmlspecialchars($pessoaData['id']) ?>" style="margin-top: 20px;">

    <input type="hidden" name="id" value="<?= htmlspecialchars($pessoaData['id']) ?>">

    <div style="margin-bottom: 15px;">
        <label for="nome" style="display: block; font-weight: 600; margin-bottom: 5px;">Nome Completo</label>
        <input 
            type="text" 
            id="nome" 
            name="nome" 
            maxlength="100" 
            value="<?= htmlspecialchars($pessoaData['nome']) ?>" 
            required
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
        >
    </div>

    <div style="margin-bottom: 15px;">
        <label for="cpf" style="display: block; font-weight: 600; margin-bottom: 5px;">CPF</label>
        <input 
            type="text" 
            id="cpf" 
            name="cpf" 
            maxlength="11" 
            value="<?= htmlspecialchars($pessoaData['cpf']) ?>" 
            required
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
        >
    </div>

    <div style="margin-bottom: 15px;">
        <label for="telefone" style="display: block; font-weight: 600; margin-bottom: 5px;">Telefone</label>
        <input 
            type="text" 
            id="telefone" 
            name="telefone" 
            maxlength="15" 
            value="<?= htmlspecialchars($pessoaData['telefone'] ?? '') ?>"
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
        >
    </div>

    <div style="margin-bottom: 15px;">
        <label for="endereco" style="display: block; font-weight: 600; margin-bottom: 5px;">Endereço</label>
        <input 
            type="text" 
            id="endereco" 
            name="endereco" 
            maxlength="255" 
            value="<?= htmlspecialchars($pessoaData['endereco'] ?? '') ?>"
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"
        >
    </div>

    <div style="margin-top: 20px; display: flex; gap: 10px;">
        <button type="submit" class="btn">Salvar Alterações</button>
        <a href="index.php?pagina=listar" class="btn btn-danger" style="text-decoration: none;">Cancelar</a>
    </div>

</form> 