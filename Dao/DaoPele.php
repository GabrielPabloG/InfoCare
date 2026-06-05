<?php
require_once 'conexao.php';
require_once '../Model/Pele.php';

class DaoPele {
    public function insert(Pele $pele) {
        $conn = Conexao::getConexao();
        $sql = "INSERT INTO pele (integridade, hidratacao, dermatite, prurido, micose_unha, escamacao, ictericia, ferida, petequia, hematoma, ulcera, grau_ulcera, outra_especificacao) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $pele->getIntegridade(),
            $pele->getHidratacao(),
            $pele->getDermatite(),
            $pele->getPrurido(),
            $pele->getMicoseUnha(),
            $pele->getEscamacao(),
            $pele->getIctericia(),
            $pele->getFerida(),
            $pele->getPetequia(),
            $pele->getHematoma(),
            $pele->getUlcera(),
            $pele->getGrauUlcera(),
            $pele->getOutraEspecificacao()
        ]);
        
        return $conn->lastInsertId(); // Retorna o ID para amarrarmos no Prontuario Fixo depois
    }

    public function update(Pele $pele) {
        $conn = Conexao::getConexao();
        $sql = "UPDATE pele SET integridade = ?, hidratacao = ?, dermatite = ?, prurido = ?, micose_unha = ?, escamacao = ?, ictericia = ?, ferida = ?, petequia = ?, hematoma = ?, ulcera = ?, grau_ulcera = ?, outra_especificacao = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $pele->getIntegridade(),
            $pele->getHidratacao(),
            $pele->getDermatite(),
            $pele->getPrurido(),
            $pele->getMicoseUnha(),
            $pele->getEscamacao(),
            $pele->getIctericia(),
            $pele->getFerida(),
            $pele->getPetequia(),
            $pele->getHematoma(),
            $pele->getUlcera(),
            $pele->getGrauUlcera(),
            $pele->getOutraEspecificacao(),
            $pele->getId()
        ]);

        public function delete($id) {
            $conn = Conexao::getConexao();
            $sql = "DELETE FROM pele WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$id]);
        }
    }

    public function getById($id) {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM pele WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pele = new Pele();
            $pele->setId($row['id']);
            $pele->setIntegridade($row['integridade']);
            $pele->setHidratacao($row['hidratacao']);
            $pele->setDermatite($row['dermatite']);
            $pele->setPrurido($row['prurido']);
            $pele->setMicoseUnha($row['micose_unha']);
            $pele->setEscamacao($row['escamacao']);
            $pele->setIctericia($row['ictericia']);
            $pele->setFerida($row['ferida']);
            $pele->setPetequia($row['petequia']);
            $pele->setHematoma($row['hematoma']);
            $pele->setUlcera($row['ulcera']);
            $pele->setGrauUlcera($row['grau_ulcera']);
            $pele->setOutraEspecificacao($row['outra_especificacao']);
            return $pele;
        }
        return null;
    }

    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM pele";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $peles = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pele = new Pele();
            $pele->setId($row['id']);
            $pele->setIntegridade($row['integridade']);
            $pele->setHidratacao($row['hidratacao']);
            $pele->setDermatite($row['dermatite']);
            $pele->setPrurido($row['prurido']);
            $pele->setMicoseUnha($row['micose_unha']);
            $pele->setEscamacao($row['escamacao']);
            $pele->setIctericia($row['ictericia']);
            $pele->setFerida($row['ferida']);
            $pele->setPetequia($row['petequia']);
            $pele->setHematoma($row['hematoma']);
            $pele->setUlcera($row['ulcera']);
            $pele->setGrauUlcera($row['grau_ulcera']);
            $pele->setOutraEspecificacao($row['outra_especificacao']);
            $peles[] = $pele;
        }
        return $peles;
    }
}