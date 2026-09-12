<?php

namespace App\DAO;

use App\Config\Database;
use App\Model\Pessoa;
use PDO;

class PessoaDAO {
    private PDO $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function cadastrar(Pessoa $p) {
        $sql = "INSERT INTO pessoas (nome, cpf, telefone, endereco) VALUES (:nome, :cpf, :telefone, :endereco)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $p->getNome());
        $stmt->bindValue(':cpf', $p->getCpf());
        $stmt->bindValue(':telefone', $p->getTelefone());
        $stmt->bindValue(':endereco', $p->getEndereco());
        return $stmt->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM pessoas ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id) {
        $sql = "SELECT * FROM pessoas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(Pessoa $p) {
        $sql = "UPDATE pessoas SET nome = :nome, cpf = :cpf, telefone = :telefone, endereco = :endereco WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $p->getNome());
        $stmt->bindValue(':cpf', $p->getCpf());
        $stmt->bindValue(':telefone', $p->getTelefone());
        $stmt->bindValue(':endereco', $p->getEndereco());
        $stmt->bindValue(':id', $p->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function pesquisar(string $termo) {
        $sql = "SELECT * FROM pessoas WHERE nome LIKE :termo OR cpf LIKE :termo OR telefone LIKE :termo OR endereco LIKE :termo ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':termo', '%' . $termo . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir(int $id) {
        $sql = "DELETE FROM pessoas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}