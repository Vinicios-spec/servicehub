<?php
include_once "config/conexao.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Cliente
{
    private $id;
    private $usuario_id;
    private $telefone;
    private $cpf;
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
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }
    public function setUsuarioId(string $usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone(string $telefone)
    {
        $this->telefone = $telefone;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
    public function setCpf(string $cpf)
    {
        $this->cpf = $cpf;
    }

    // Inserir
    public function inserir(): bool
    {
        $sql = "INSERT clientes (usuario_id, telefone, cpf)
    values (:usuario_id, :telefone, :cpf)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":usuario_id", $this->usuario_id);
        $cmd->bindValue(":telefone", $this->telefone);
        $cmd->bindValue(":cpf", $this->cpf);
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

        $sql = "UPDATE clientes
                    set usuario_id = :usuario_id, telefone = :telefone, cpf = :cpf,
            WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $this->id);
        $cmd->bindValue(":usuario_id", $this->usuario_id);
        $cmd->bindValue(":telefone", $this->telefone);
        $cmd->bindValue(":cpf", $this->cpf);
        return $cmd->execute();
    }

    // Listar
    public static function listar(): array
    {
        $cmd = obterPdo()->query("select * from clientes order by id desc");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }


    // Buscar por ID
    public function buscarPorId(int $id): bool
    {
        $sql = "SELECT * FROM  clientes WHERE id = :id";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            $this->id = $dados['id'];
            $this->setUsuarioId($dados['usuario_id']);
            $this->setTelefone($dados['telefone']);
            $this->setCpf($dados['cpf']);
            return true;
        }
        return false;
    }

        // Buscar por Usuario

     public function buscarPorUsuario(int $usuario_id): bool
    {
        $sql = "SELECT * FROM  clientes WHERE usuario_id = :usuario_id LIMIT 1";
        $cmd = obterPdo()->prepare($sql);
        $cmd->bindValue(":usuario", $usuario_id, PDO::PARAM_INT);
        $cmd->execute();

        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            $this->id = $dados['id'];
            $this->setUsuarioId($dados['usuario_id']);
            $this->setTelefone($dados['telefone']);
            $this->setCpf($dados['cpf']);
            return true;
        }
        return false;
    }

}
