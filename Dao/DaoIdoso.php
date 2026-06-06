<?php
require_once 'conexao.php';
require_once '../Model/Idoso.php';

class DaoIdoso {

    public function insert(Idoso $idoso) {
        try {
            $conn = Conexao::getConexao();

            $sql = "INSERT INTO idoso (nome, sexo, cpf, nascimento, responsavel_id, prontuario_fixo_id)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $idoso->getNome(),
                $idoso->getSexo(),
                $idoso->getCpf(),
                $idoso->getNascimento(),
                $idoso->getResponsavelId(),
                $idoso->getProntuarioFixoId()
            ]);

            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar idoso: " . $e->getMessage();
            return false;
        }
    }

    public function update(Idoso $idoso) {
        try {
            $conn = Conexao::getConexao();

            $sql = "UPDATE idoso SET nome = ?, sexo = ?, cpf = ?, nascimento = ?, responsavel_id = ?, prontuario_fixo_id = ?
                    WHERE id = ?";

            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                $idoso->getNome(),
                $idoso->getSexo(),
                $idoso->getCpf(),
                $idoso->getNascimento(),
                $idoso->getResponsavelId(),
                $idoso->getProntuarioFixoId(),
                $idoso->getId()
            ]);
        } catch (PDOException $e) {
            echo "Erro ao atualizar idoso: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $conn = Conexao::getConexao();

            $sql = "DELETE FROM idoso WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Erro ao deletar idoso: " . $e->getMessage();
            return false;
        }
    }

    public function listAll() {
        try {
            $conn = Conexao::getConexao();

            $sql = "SELECT * FROM idoso";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $idosos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idoso = new Idoso();
                $idoso->setId($row['id']);
                $idoso->setNome($row['nome']);
                $idoso->setSexo($row['sexo']);
                $idoso->setCpf($row['cpf']);
                $idoso->setNascimento($row['nascimento']);
                $idoso->setResponsavelId($row['responsavel_id']);
                $idoso->setProntuarioFixoId($row['prontuario_fixo_id']);

                $idosos[] = $idoso;
            }

            return $idosos;
        } catch (PDOException $e) {
            echo "Erro ao listar idosos: " . $e->getMessage();
            return [];
        }
    }

    public function getById($id) {
        try {
            $conn = Conexao::getConexao();

            $sql = "SELECT * FROM idoso WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idoso = new Idoso();
                $idoso->setId($row['id']);
                $idoso->setNome($row['nome']);
                $idoso->setSexo($row['sexo']);
                $idoso->setCpf($row['cpf']);
                $idoso->setNascimento($row['nascimento']);
                $idoso->setResponsavelId($row['responsavel_id']);
                $idoso->setProntuarioFixoId($row['prontuario_fixo_id']);

                return $idoso;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro ao buscar idoso: " . $e->getMessage();
            return null;
        }
    }

    public function cadastrarIdoso($idoso, $fixo = null) {
        return $this->insert($idoso);
    }

    public function atualizarIdoso($idoso, $pessoa = null) {
        return $this->update($idoso);
    }
}