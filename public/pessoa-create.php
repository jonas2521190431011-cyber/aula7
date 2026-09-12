<?php
require_once 'Conexao.php'; // Inclui a conexão com o banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe e limpa os dados do formulário
    $nome = trim($_POST['nome'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    
    if (!empty($nome) && !empty($cpf)) {
        try {
           
            $sql = "INSERT INTO pessoas (nome, cpf, telefone, endereco) 
                    VALUES (:nome, :cpf, :telefone, :endereco)";
            
            $stmt = $pdo->prepare($sql);
            
           
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':telefone', $telefone);
            $stmt->bindValue(':endereco', $endereco);

            
            $stmt->execute();

            
            echo "<script>
                    alert('Pessoa cadastrada com sucesso!');
                    window.location.href = 'index.php';
                  </script>";
            exit;

        } catch (PDOException $e) {
            
            if ($e->getCode() == 23000) {
                echo "<script>
                        alert('Erro: Este CPF já está cadastrado!');
                        window.history.back();
                      </script>";
            } else {
                echo "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    } else {
        echo "<script>
                alert('Preencha todos os campos obrigatórios (Nome e CPF)!');
                window.history.back();
              </script>";
    }
} else {
    
    header('Location: index.php');
    exit;
}
?>