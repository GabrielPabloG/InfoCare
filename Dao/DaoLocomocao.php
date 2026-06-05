<?php
require_once 'conexao.php';
require_once '../Model/Locomocao.php';

class DaoLocomocao {
    public function insert(Locomocao $locomocao) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO locomocao (locomocao_sozinho, cadeirante, tempo_cadeirante, acamado, tempo_acamado, apoio_fisico, esporte_terapia) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $locomocao->getLocomocaoSozinho(),
            $locomocao->getCadeirante(),
            $locomocao->getTempoCadeirante(),
            $locomocao->getAcamado(),
            $locomocao->getTempoAcamado(),
            $locomocao->getApoioFisico(),
            $locomocao->getEsporteTerapia()
        ]);
        
        return $conn->lastInsertId();
    }

    public function update(Locomocao $locomocao) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE locomocao SET locomocao_sozinho = ?, cadeirante = ?, tempo_cadeirante = ?, acamado = ?, tempo_acamado = ?, apoio_fisico = ?, esporte_terapia = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $locomocao->getLocomocaoSozinho(),
            $locomocao->getCadeirante(),
            $locomocao->getTempoCadeirante(),
            $locomocao->getAcamado(),
            $locomocao->getTempoAcamado(),
            $locomocao->getApoioFisico(),
            $locomocao->getEsporteTerapia(),
            $locomocao->getId()
        ]);
    }

    public function delete($id) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM locomocao WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM locomocao WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $locomocao = new Locomocao();
            $locomocao->setId($row['id']);
            $locomocao->setLocomocaoSozinho($row['locomocao_sozinho']);
            $locomocao->setCadeirante($row['cadeirante']);
            $locomocao->setTempoCadeirante($row['tempo_cadeirante']);
            $locomocao->setAcamado($row['acamado']);
            $locomocao->setTempoAcamado($row['tempo_acamado']);
            $locomocao->setApoioFisico($row['apoio_fisico']);
            $locomocao->setEsporteTerapia($row['esporte_terapia']);
            return $locomocao;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM locomocao";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $locomocoes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $locomocao = new Locomocao();
            $locomocao->setId($row['id']);
            $locomocao->setLocomocaoSozinho($row['locomocao_sozinho']);
            $locomocao->setCadeirante($row['cadeirante']);
            $locomocao->setTempoCadeirante($row['tempo_cadeirante']);
            $locomocao->setAcamado($row['acamado']);
            $locomocao->setTempoAcamado($row['tempo_acamado']);
            $locomocao->setApoioFisico($row['apoio_fisico']);
            $locomocao->setEsporteTerapia($row['esporte_terapia']);
            $locomocoes[] = $locomocao;
        }
        return $locomocoes;
    }
}
