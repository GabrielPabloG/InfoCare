<?php
require_once 'conexao.php';
require_once '../Model/Pulmonar.php';

class DaoPulmonar {
    public function insert(Pulmonar $pulmonar) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO pulmonar (tipo_tosse, auscultacao, tipo_dispneia) 
                VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $pulmonar->getTipoTosse(),
            $pulmonar->getAuscultacao(),
            $pulmonar->getTipoDispneia()
        ]);
        
        return $conn->lastInsertId();
    }

    public function update(Pulmonar $pulmonar) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE pulmonar SET tipo_tosse = ?, auscultacao = ?, tipo_dispneia = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $pulmonar->getTipoTosse(),
            $pulmonar->getAuscultacao(),
            $pulmonar->getTipoDispneia(),
            $pulmonar->getId()
        ]);
    }

    public function delete($id) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM pulmonar WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM pulmonar WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pulmonar = new Pulmonar();
            $pulmonar->setId($row['id']);
            $pulmonar->setTipoTosse($row['tipo_tosse']);
            $pulmonar->setAuscultacao($row['auscultacao']);
            $pulmonar->setTipoDispneia($row['tipo_dispneia']);
            return $pulmonar;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM pulmonar";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $pulmonares = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pulmonar = new Pulmonar();
            $pulmonar->setId($row['id']);
            $pulmonar->setTipoTosse($row['tipo_tosse']);
            $pulmonar->setAuscultacao($row['auscultacao']);
            $pulmonar->setTipoDispneia($row['tipo_dispneia']);
            $pulmonares[] = $pulmonar;
        }
        return $pulmonares;
    }
}
