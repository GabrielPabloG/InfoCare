<?php
require_once '../Model/Medicamento.php';
require_once 'conexao.php';

class DaoMedicamento {
    
    public function insert(Medicamento $medicamento) {
        try {
            $conn = Conexao::getConexao();
            
            $sql = "INSERT INTO medicacao (nome, dosagem, horario, posologia, composicao) 
                    VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $medicamento->getNome(),
                $medicamento->getDosagem(),
                $medicamento->getHorario(),
                $medicamento->getPosologia(),
                $medicamento->getComposicao()
            ]);
            
            // Retorna o ID gerado para podermos usar na associação N:M logo em seguida
            return $conn->lastInsertId();
            
        } catch (PDOException $e) {
            echo "Erro ao cadastrar medicamento: " . $e->getMessage();
            return false;
        }
    }

    public function update(Medicamento $medicamento) {
        try {
            $conn = Conexao::getConexao();
            $sql = "UPDATE medicacao SET nome = ?, dosagem = ?, horario = ?, posologia = ?, composicao = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                $medicamento->getNome(),
                $medicamento->getDosagem(),
                $medicamento->getHorario(),
                $medicamento->getPosologia(),
                $medicamento->getComposicao(),
                $medicamento->getId()
            ]);
        } catch (PDOException $e) {
            echo "Erro ao atualizar medicamento: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $conn = Conexao::getConexao();
            $sql = "DELETE FROM medicacao WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Erro ao excluir medicamento: " . $e->getMessage();
            return false;
        }
    }

    // Método útil para listar todos os medicamentos disponíveis no sistema
    public function listAll() {
        $conn = Conexao::getConexao();
        $sql = "SELECT * FROM medicacao ORDER BY nome";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>