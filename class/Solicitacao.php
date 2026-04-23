<?php
include_once "config/conexao.php";

class Servico
{
    private $id;
    private $cliente_id;
    private $descricao_problema;
    private $data_preferida;
    private $status;
    private $data_cad;
    private $data_atualizacao;
    private $data_resposta;
    private $resposta_admin;
    private $endereco;
    private $pdo;

    public function __construct()
    {
        $this->pdo = obterPdo();
    }
    // Getters / Setters
    public function getId()
    {
        return $this->id;
    }
    public function getClienteId()
    {
        return $this->cliente_id;
    }
    public function setClienteId(string $cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }
    public function getDescricaoProblema()
    {
        return $this->descricao_problema;
    }
    public function setDescricaoProblema(string $descricao_problema)
    {
        $this->descricao_problema = $descricao_problema;
    }
    public function getDataPreferida()
    {
        return $this->data_preferida;
    }
    public function setDataPrefirida(string $data_preferida)
    {
        $this->data_preferida = $data_preferida;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus(string $status)
    {
        $this->status = $status;
    }
        public function getDataCad()
    {
        return $this->data_cad;
    }
    public function setDataCad(string $data_cad)
    {
        $this->data_cad = $data_cad;
    }
        public function getDataAtualizacao()
    {
        return $this->data_atualizacao;
    }
    public function setDataAtualizacao(string $data_atualizacao)
    {
        $this->data_atualizacao = $data_atualizacao;
    }
            public function getDataResposta()
    {
        return $this->data_resposta;
    }
    public function setDataResposta(string $data_resposta)
    {
        $this->data_resposta = $data_resposta;
    }
                public function getRespostaAdmin()
    {
        return $this->resposta_admin;
    }
    public function setRespostaAdmin(string $resposta_admin)
    {
        $this->resposta_admin = $resposta_admin;
    }
                    public function getEndereco()
    {
        return $this->endereco;
    }
    public function setEndereco(string $endereco)
    {
        $this->endereco = $endereco;
    }
    
}