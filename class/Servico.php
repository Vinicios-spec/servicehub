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
        values (:nome, :descricao, :preco, :descontinuado)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":preco", $this->preco);
        $cmd->bindValue(":descontinuado", $this->descontinuado);
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
                    set nome = :nome, descricao = :descricao, preco = :preco, descontinuado = :descontinuado
            WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $this->id);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":descricao", $this->descricao);
        $cmd->bindValue(":preco", $this->preco);
        $cmd->bindValue(":descontinuado", $this->descontinuado);
        return $cmd->execute();
    }


    // Listar
    public static function listar(): array
    {
        $cmd = obterPdo()->query("select * from servico order by id desc");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar Ativos


    // buscar por ID
    public function buscarPorId(int $id): bool
    {
        $sql = "SELECT * FROM  servico WHERE id = :id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            $this->id = $dados['id'];
            $this->setNome($dados['nome']);
            $this->setDescricao($dados['descricao']);
            $this->setPreco($dados['preco']);
            $this->setDescontinuado($dados['descontinuado']);
            return true;
        }
        return false;
    }
}
