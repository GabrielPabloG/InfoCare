<?php
require_once 'conexao.php';
require_once '../Model/Relacionamento.php';

class DaoRelacionamento {
    public function insert(Relacionamento $relacionamento) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO relacionamento (status_comunicacao, agressividade, temperamento, anterioridade_casa_repouso, irritabilidade) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $relacionamento->getStatusComunicacao(),
            $relacionamento->getAgressividade(),
            $relacionamento->getTemperamento(),
            $relacionamento->getAnterioridadeCasaRepouso(),
            $relacionamento->getIrritabilidade()
        ]);
        
        return $conn->lastInsertId();
    }

    public function update(Relacionamento $relacionamento) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE relacionamento SET status_comunicacao = ?, agressividade = ?, temperamento = ?, anterioridade_casa_repouso = ?, irritabilidade = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $relacionamento->getStatusComunicacao(),
            $relacionamento->getAgressividade(),
            $relacionamento->getTemperamento(),
            $relacionamento->getAnterioridadeCasaRepouso(),
            $relacionamento->getIrritabilidade(),
            $relacionamento->getId()
        ]);
    }

    public function delete($id) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM relacionamento WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM relacionamento WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $relacionamento = new Relacionamento();
            $relacionamento->setId($row['id']);
            $relacionamento->setStatusComunicacao($row['status_comunicacao']);
            $relacionamento->setAgressividade($row['agressividade']);
            $relacionamento->setTemperamento($row['temperamento']);
            $relacionamento->setAnterioridadeCasaRepouso($row['anterioridade_casa_repouso']);
            $relacionamento->setIrritabilidade($row['irritabilidade']);
            return $relacionamento;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM relacionamento";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $relacionamentos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $relacionamento = new Relacionamento();
            $relacionamento->setId($row['id']);
            $relacionamento->setStatusComunicacao($row['status_comunicacao']);
            $relacionamento->setAgressividade($row['agressividade']);
            $relacionamento->setTemperamento($row['temperamento']);
            $relacionamento->setAnterioridadeCasaRepouso($row['anterioridade_casa_repouso']);
            $relacionamento->setIrritabilidade($row['irritabilidade']);
            $relacionamentos[] = $relacionamento;
        }
        return $relacionamentos;
    }
}
