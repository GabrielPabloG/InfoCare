<?php
require_once 'conexao.php';
require_once '../Model/Eliminacao.php';

class DaoEliminacao {
    public function insert(Eliminacao $eliminacao) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO eliminacao (frequencia_evacuacao, aspecto_fezes, coloracao_urina, odor_urina, frequencia_urina, queixa_gases, usa_fralda, marca_fralda) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $eliminacao->getFrequenciaEvacuacao(),
            $eliminacao->getAspectoFezes(),
            $eliminacao->getColoracaoUrina(),
            $eliminacao->getOdorUrina(),
            $eliminacao->getFrequenciaUrina(),
            $eliminacao->getQueixaGases(),
            $eliminacao->getUsaFralda(),
            $eliminacao->getMarcaFralda()
        ]);
        
        return $conn->lastInsertId();
    }

    public function update(Eliminacao $eliminacao) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE eliminacao SET frequencia_evacuacao = ?, aspecto_fezes = ?, coloracao_urina = ?, odor_urina = ?, frequencia_urina = ?, queixa_gases = ?, usa_fralda = ?, marca_fralda = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $eliminacao->getFrequenciaEvacuacao(),
            $eliminacao->getAspectoFezes(),
            $eliminacao->getColoracaoUrina(),
            $eliminacao->getOdorUrina(),
            $eliminacao->getFrequenciaUrina(),
            $eliminacao->getQueixaGases(),
            $eliminacao->getUsaFralda(),
            $eliminacao->getMarcaFralda(),
            $eliminacao->getId()
        ]);
    }

    public function delete($id) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM eliminacao WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM eliminacao WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $eliminacao = new Eliminacao();
            $eliminacao->setId($row['id']);
            $eliminacao->setFrequenciaEvacuacao($row['frequencia_evacuacao']);
            $eliminacao->setAspectoFezes($row['aspecto_fezes']);
            $eliminacao->setColoracaoUrina($row['coloracao_urina']);
            $eliminacao->setOdorUrina($row['odor_urina']);
            $eliminacao->setFrequenciaUrina($row['frequencia_urina']);
            $eliminacao->setQueixaGases($row['queixa_gases']);
            $eliminacao->setUsaFralda($row['usa_fralda']);
            $eliminacao->setMarcaFralda($row['marca_fralda']);
            return $eliminacao;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM eliminacao";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $eliminacoes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $eliminacao = new Eliminacao();
            $eliminacao->setId($row['id']);
            $eliminacao->setFrequenciaEvacuacao($row['frequencia_evacuacao']);
            $eliminacao->setAspectoFezes($row['aspecto_fezes']);
            $eliminacao->setColoracaoUrina($row['coloracao_urina']);
            $eliminacao->setOdorUrina($row['odor_urina']);
            $eliminacao->setFrequenciaUrina($row['frequencia_urina']);
            $eliminacao->setQueixaGases($row['queixa_gases']);
            $eliminacao->setUsaFralda($row['usa_fralda']);
            $eliminacao->setMarcaFralda($row['marca_fralda']);
            $eliminacoes[] = $eliminacao;
        }
        return $eliminacoes;
    }
}
