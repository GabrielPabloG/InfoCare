<?php
require_once 'conexao.php';
require_once '../Model/Exame.php';

class DaoExame {
    public function insert(Exame $exame) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO exame (hemograma_conclusao, urina_tipo, parasitologico_fezes, glicemia_jejum, colesterol, hepatite_tipo, hiv, vdrl, atestado_neurologico, raiox_pulmao, receituario_medico) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $exame->getHemogramaConclusao(),
            $exame->getUrinaTipo(),
            $exame->getParasitologicoFezes(),
            $exame->getGlicemiaJejum(),
            $exame->getColesterol(),
            $exame->getHepatiteTipo(),
            $exame->getHiv(),
            $exame->getVdrl(),
            $exame->getAtestadoNeurologico(),
            $exame->getRaioxPulmao(),
            $exame->getReceituarioMedico()
        ]);
        
        return $conn->lastInsertId();
    }

    public function update(Exame $exame) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE exame SET hemograma_conclusao = ?, urina_tipo = ?, parasitologico_fezes = ?, glicemia_jejum = ?, colesterol = ?, hepatite_tipo = ?, hiv = ?, vdrl = ?, atestado_neurologico = ?, raiox_pulmao = ?, receituario_medico = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $exame->getHemogramaConclusao(),
            $exame->getUrinaTipo(),
            $exame->getParasitologicoFezes(),
            $exame->getGlicemiaJejum(),
            $exame->getColesterol(),
            $exame->getHepatiteTipo(),
            $exame->getHiv(),
            $exame->getVdrl(),
            $exame->getAtestadoNeurologico(),
            $exame->getRaioxPulmao(),
            $exame->getReceituarioMedico(),
            $exame->getId()
        ]);
    }

    public function delete($id) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM exame WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM exame WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $exame = new Exame();
            $exame->setId($row['id']);
            $exame->setHemogramaConclusao($row['hemograma_conclusao']);
            $exame->setUrinaTipo($row['urina_tipo']);
            $exame->setParasitologicoFezes($row['parasitologico_fezes']);
            $exame->setGlicemiaJejum($row['glicemia_jejum']);
            $exame->setColesterol($row['colesterol']);
            $exame->setHepatiteTipo($row['hepatite_tipo']);
            $exame->setHiv($row['hiv']);
            $exame->setVdrl($row['vdrl']);
            $exame->setAtestadoNeurologico($row['atestado_neurologico']);
            $exame->setRaioxPulmao($row['raiox_pulmao']);
            $exame->setReceituarioMedico($row['receituario_medico']);
            return $exame;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM exame";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $exames = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $exame = new Exame();
            $exame->setId($row['id']);
            $exame->setHemogramaConclusao($row['hemograma_conclusao']);
            $exame->setUrinaTipo($row['urina_tipo']);
            $exame->setParasitologicoFezes($row['parasitologico_fezes']);
            $exame->setGlicemiaJejum($row['glicemia_jejum']);
            $exame->setColesterol($row['colesterol']);
            $exame->setHepatiteTipo($row['hepatite_tipo']);
            $exame->setHiv($row['hiv']);
            $exame->setVdrl($row['vdrl']);
            $exame->setAtestadoNeurologico($row['atestado_neurologico']);
            $exame->setRaioxPulmao($row['raiox_pulmao']);
            $exame->setReceituarioMedico($row['receituario_medico']);
            $exames[] = $exame;
        }
        return $exames;
    }
}
