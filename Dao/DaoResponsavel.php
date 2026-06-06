<?php
require_once 'conexao.php';
require_once '../Model/Responsavel.php';

class DaoResponsavel {

    public function insert(Responsavel $responsavel) {
        try {
            $conn = Conexao::getConexao();

            $sql = "INSERT INTO responsavel (nome, cpf, sexo, nascimento, email, senha, rua, bairro, cep, numero_casa)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $responsavel->getNome(),
                $responsavel->getCpf(),
                $responsavel->getSexo(),
                $responsavel->getNascimento(),
                $responsavel->getEmail(),
                $responsavel->getSenha(),
                $responsavel->getRua(),
                $responsavel->getBairro(),
                $responsavel->getCep(),
                $responsavel->getNumeroCasa()
            ]);

            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar responsável: " . $e->getMessage();
            return false;
        }
    }

    public function update(Responsavel $responsavel) {
        try {
            $conn = Conexao::getConexao();
            
            // Monta a base da query (tudo MENOS a senha)
            $sql = "UPDATE responsavel SET 
                    nome = ?, cpf = ?, sexo = ?, nascimento = ?, 
                    email = ?, senha = ?, rua = ?, bairro = ?, 
                    cep = ?, numero_casa = ?";
            
            // Array com os valores correspondentes
            $valores = [
                $responsavel->getNome(), $responsavel->getCpf(), $responsavel->getSexo(),
                $responsavel->getNascimento(), $responsavel->getEmail(), $responsavel->getSenha(),
                $responsavel->getRua(), $responsavel->getBairro(), $responsavel->getCep(),
                $responsavel->getNumeroCasa()
            ];

            // Se a senha NÃO for nula, adicionamos ela na query
            if ($responsavel->getSenha() !== null) {
                $sql .= ", senha = ?";
                $valores[] = $responsavel->getSenha(); // Adiciona o hash na lista de valores
            }

            // Finaliza a query com o WHERE e adiciona o ID na lista de valores
            $sql .= " WHERE id = ?";
            $valores[] = $responsavel->getId();

            $stmt = $conn->prepare($sql);
            return $stmt->execute($valores);
            
        } catch (PDOException $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $conn = Conexao::getConexao();

            $sql = "DELETE FROM responsavel WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Erro ao deletar responsável: " . $e->getMessage();
            return false;
        }
    }

    public function listAll() {
        try {
            $conn = Conexao::getConexao();

            $sql = "SELECT * FROM responsavel";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $responsaveis = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $responsavel = new Responsavel();
                $responsavel->setId($row['id']);
                $responsavel->setNome($row['nome']);
                $responsavel->setCpf($row['cpf']);
                $responsavel->setSexo($row['sexo']);
                $responsavel->setNascimento($row['nascimento']);
                $responsavel->setEmail($row['email']);
                $responsavel->setSenha($row['senha']);
                $responsavel->setRua($row['rua']);
                $responsavel->setBairro($row['bairro']);
                $responsavel->setCep($row['cep']);
                $responsavel->setNumeroCasa($row['numero_casa']);

                $responsaveis[] = $responsavel;
            }

            return $responsaveis;
        } catch (PDOException $e) {
            echo "Erro ao listar responsáveis: " . $e->getMessage();
            return [];
        }
    }

    public function getById($id) {
        try {
            $conn = Conexao::getConexao();

            $sql = "SELECT * FROM responsavel WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $responsavel = new Responsavel();
                $responsavel->setId($row['id']);
                $responsavel->setNome($row['nome']);
                $responsavel->setCpf($row['cpf']);
                $responsavel->setSexo($row['sexo']);
                $responsavel->setNascimento($row['nascimento']);
                $responsavel->setEmail($row['email']);
                $responsavel->setSenha($row['senha']);
                $responsavel->setRua($row['rua']);
                $responsavel->setBairro($row['bairro']);
                $responsavel->setCep($row['cep']);
                $responsavel->setNumeroCasa($row['numero_casa']);

                return $responsavel;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro ao buscar responsável: " . $e->getMessage();
            return null;
        }
    }
}
