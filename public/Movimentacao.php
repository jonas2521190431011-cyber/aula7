<?php

namespace App\Model;

class Movimentacao
{
    private ?int $id = null;
    private int $pessoaId;
    private string $descricao;
    private string $tipo;
    private float $valor;
    private string $dataMovimentacao;


    // ID
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    // PESSOA ID
    public function getPessoaId(): int
    {
        return $this->pessoaId;
    }

    public function setPessoaId(int $pessoaId): void
    {
        $this->pessoaId = $pessoaId;
    }


    // DESCRIÇÃO
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }


    // TIPO
    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }


    // VALOR
    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }


    // DATA
    public function getDataMovimentacao(): string
    {
        return $this->dataMovimentacao;
    }

    public function setDataMovimentacao(string $dataMovimentacao): void
    {
        $this->dataMovimentacao = $dataMovimentacao;
    }
}