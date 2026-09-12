<?php

namespace App\Model;

class Movimentacao
{
    private ?int $id = null;
    private ?int $idPessoa = null;
    private ?float $credito = null;
    private ?float $debito = null;
    private ?string $dataOperacao = null;
    private ?string $observacao = null;


   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    
    public function getIdPessoa(): ?int
    {
        return $this->idPessoa;
    }

    public function setIdPessoa(?int $idPessoa): void
    {
        $this->idPessoa = $idPessoa;
    }


       public function getCredito(): ?float
    {
        return $this->credito;
    }

    public function setCredito(?float $credito): void
    {
        $this->credito = $credito;
    }


    
    public function getDebito(): ?float
    {
        return $this->debito;
    }

    public function setDebito(?float $debito): void
    {
        $this->debito = $debito;
    }


    public function getDataOperacao(): ?string
    {
        return $this->dataOperacao;
    }

    public function setDataOperacao(?string $dataOperacao): void
    {
        $this->dataOperacao = $dataOperacao;
    }


        public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): void
    {
        $this->observacao = $observacao;
    }
}