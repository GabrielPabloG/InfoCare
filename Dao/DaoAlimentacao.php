<?php
require_once 'conexao.php';
require_once '../Model/Alimentacao.php';

class DaoAlimentacao {
    public function insert(Alimentacao $alimentacao) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO alimentacao (alimentacao_sozinho, dificuldade_degluticao, uso_sonda, restricao_alimentar, preferencia_alimentar) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $alimentacao->getAlimentacaoSozinho(),
            $alimentacao->getDificuldadeDegluticao(),
            $alimentacao->getUsoSonda(),
            $alimentacao->getRestricaoAlimentar(),
            $alimentacao->getPreferenciaAlimentar()
        ]);
        
        return $conn->lastInsertId();
    }

    public function update(Alimentacao $alimentacao) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE alimentacao SET alimentacao_sozinho = ?, dificuldade_degluticao = ?, uso_sonda = ?, restricao_alimentar = ?, preferencia_alimentar = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $alimentacao->getAlimentacaoSozinho(),
            $alimentacao->getDificuldadeDegluticao(),
            $alimentacao->getUsoSonda(),
            $alimentacao->getRestricaoAlimentar(),
            $alimentacao->getPreferenciaAlimentar(),
            $alimentacao->getId()
        ]);
    }

    public function delete($id) {
        $conn = Conexao::getConexao();
        $sql = "DELETE FROM alimentacao WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM alimentacao WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $alimentacao = new Alimentacao();
            $alimentacao->setId($row['id']);
            $alimentacao->setAlimentacaoSozinho($row['alimentacao_sozinho']);
            $alimentacao->setDificuldadeDegluticao($row['dificuldade_degluticao']);
            $alimentacao->setUsoSonda($row['uso_sonda']);
            $alimentacao->setRestricaoAlimentar($row['restricao_alimentar']);
            $alimentacao->setPreferenciaAlimentar($row['preferencia_alimentar']);
            return $alimentacao;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM alimentacao";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $alimentacoes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $alimentacao = new Alimentacao();
            $alimentacao->setId($row['id']);
            $alimentacao->setAlimentacaoSozinho($row['alimentacao_sozinho']);
            $alimentacao->setDificuldadeDegluticao($row['dificuldade_degluticao']);
            $alimentacao->setUsoSonda($row['uso_sonda']);
            $alimentacao->setRestricaoAlimentar($row['restricao_alimentar']);
            $alimentacao->setPreferenciaAlimentar($row['preferencia_alimentar']);
            $alimentacoes[] = $alimentacao;
        }
        return $alimentacoes;
    }
}
