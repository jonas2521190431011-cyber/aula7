<?php

namespace App\DAO;

use App\Model\Movimentacao;
use App\Config\Database;
use PDO;

class MovimentacaoDAO
{
    private PDO $conexao;


    public function __construct()
    {
        $database = new Database();

        $this->conexao = $database->conectar();
    }


       public function inserir(Movimentacao $movimentacao): bool
    {
        $sql = "INSERT INTO movimentacao
                (
                    idPessoa,
                    Credito,
                    Debito,
                    DataOperacao,
                    Observacao
                )
                VALUES
                (
                    :idPessoa,
                    :credito,
                    :debito,
                    :dataOperacao,
                    :observacao
                )";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(
            ':idPessoa',
            $movimentacao->getIdPessoa(),
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':credito',
            $movimentacao->getCredito()
        );

        $stmt->bindValue(
            ':debito',
            $movimentacao->getDebito()
        );

        $stmt->bindValue(
            ':dataOperacao',
            $movimentacao->getDataOperacao()
        );

        $stmt->bindValue(
            ':observacao',
            $movimentacao->getObservacao()
        );

        return $stmt->execute();
    }


    
    public function listar(): array
    {
        $sql = "SELECT
                    movimentacao.*,
                    pessoas.nome AS pessoa_nome

                FROM movimentacao

                LEFT JOIN pessoas
                    ON movimentacao.idPessoa = pessoas.id

                ORDER BY
                    movimentacao.DataOperacao DESC,
                    movimentacao.id DESC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}