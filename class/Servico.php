<?php
include_once "config/conexao.php";

class Servico
{
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $descontinuado;
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
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }
    public function getPreco()
    {
        return $this->preco;
    }
    public function setPreco(string $preco)
    {
        $this->preco = $preco;
    }
    public function getDescontinuado()
    {
        return $this->descontinuado;
    }
    public function setDescontinuado(string $descontinuado)
    {
        $this->descontinuado = $descontinuado;
    }

    // Inserir
    public function inserir(): bool
    {
        $sql = "INSERT servico (nome, descricao, preco, descontinuado)
        values (:nome, :descricao, :preco, b'0')";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":preco", $this->preco);
        if ($cmd->execute()) {
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return true;
    }


    // Atualizar
    public function atualizar(): bool
    {
        if (!$this->id) return false;

        $sql = "UPDATE servico
                    set nome = :nome, descricao = :descricao, preco = :preco
            WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":preco", $this->preco);
        return $cmd->execute();
    }


    // Listar
    public static function listar(): array
    {
        $cmd = obterPdo()->query("select * from servico order by id desc");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar Ativos
    public static function ListarAtivo(): array
    {
        $cmd = obterPdo()->query("SELECT * FROM servicos WHERE descontinuado=b'0' ORDER BY id ASC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);

    }


    // buscar por ID
    public function buscarPorId(int $id): bool
    {
        $sql = "SELECT * FROM  servico WHERE id = :id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id", $id, PDO::PARAM_INT);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            $this->id = $dados["id"];
            $this->nome = $dados["nome"];
            $this->descricao = $dados["descricao"];
            $this->preco = $dados["preco"];
            $this->descontinuado = $dados["descontinuado"];
            return true;
        }
        return false;
    }

    public static function excluir(int $id): bool {
        $sql = "UPDATE servicos SET descontinuado=b'1' WHERE id = :id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id", $id, PDO::PARAM_INT);
        return $cmd->execute();
    }
}