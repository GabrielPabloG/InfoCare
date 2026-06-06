<?php
require_once 'conexao.php';
require_once '../Model/Gerente.php';

class DaoGerente {
    
    public function insert(Gerente $gerente) {
        try {
            $conn = Conexao::getConexao();
            
            $sql = "INSERT INTO gerente (nome, cpf, sexo, nascimento, salario, email, senha, rua, bairro, cep, numero_casa) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $gerente->getNome(),
                $gerente->getCpf(),
                $gerente->getSexo(),
                $gerente->getNascimento(),
                $gerente->getSalario(),
                $gerente->getEmail(),
                $gerente->getSenha(),
                $gerente->getRua(),
                $gerente->getBairro(),
                $gerente->getCep(),
                $gerente->getNumeroCasa()
            ]);
            
            // Retorna o ID gerado para podermos usar no DaoTelefone ou DaoFoto lá no Controller
            return $conn->lastInsertId(); 
            
        } catch (PDOException $e) {
            echo "Erro ao cadastrar gerente: " . $e->getMessage();
            return false;
        }
    }

    public function update(Gerente $gerente) {
            try {
            $conn = Conexao::getConexao();
            
            // Monta a base da query (tudo MENOS a senha)
            $sql = "UPDATE gerente SET 
                    nome = ?, cpf = ?, sexo = ?, nascimento = ?, 
                    email = ?, salario = ?, rua = ?, bairro = ?, 
                    cep = ?, numero_casa = ?";
            
            // Array com os valores correspondentes
            $valores = [
                $gerente->getNome(), $gerente->getCpf(), $gerente->getSexo(),
                $gerente->getNascimento(), $gerente->getEmail(), $gerente->getSalario(),
                $gerente->getRua(), $gerente->getBairro(), $gerente->getCep(),
                $gerente->getNumeroCasa()
            ];

            // Se a senha NÃO for nula, adicionamos ela na query
            if ($gerente->getSenha() !== null) {
                $sql .= ", senha = ?";
                $valores[] = $gerente->getSenha(); // Adiciona o hash na lista de valores
            }

            // Finaliza a query com o WHERE e adiciona o ID na lista de valores
            $sql .= " WHERE id = ?";
            $valores[] = $gerente->getId();

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
            
            $sql = "DELETE FROM gerente WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$id]);
            
        } catch (PDOException $e) {
            echo "Erro ao deletar gerente: " . $e->getMessage();
            return false;
        }
    }

    public function listAll() {
        try {
            $conn = Conexao::getConexao();
            
            $sql = "SELECT * FROM gerente";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            $gerentes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $gerente = new Gerente();
                $gerente->setId($row['id']);
                $gerente->setNome($row['nome']);
                $gerente->setCpf($row['cpf']);
                $gerente->setSexo($row['sexo']);
                $gerente->setNascimento($row['nascimento']);
                $gerente->setSalario($row['salario']);
                $gerente->setEmail($row['email']);
                $gerente->setSenha($row['senha']);
                $gerente->setRua($row['rua']);
                $gerente->setBairro($row['bairro']);
                $gerente->setCep($row['cep']);
                $gerente->setNumeroCasa($row['numero_casa']);
                
                $gerentes[] = $gerente;
            }
            
            return $gerentes;
            
        } catch (PDOException $e) {
            echo "Erro ao listar gerentes: " . $e->getMessage();
            return [];
        }
    }

    public function getById($id) {
        try {
            $conn = Conexao::getConexao();
            
            $sql = "SELECT * FROM gerente WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $gerente = new Gerente();
                $gerente->setId($row['id']);
                $gerente->setNome($row['nome']);
                $gerente->setCpf($row['cpf']);
                $gerente->setSexo($row['sexo']);
                $gerente->setNascimento($row['nascimento']);
                $gerente->setSalario($row['salario']);
                $gerente->setEmail($row['email']);
                $gerente->setSenha($row['senha']);
                $gerente->setRua($row['rua']);
                $gerente->setBairro($row['bairro']);
                $gerente->setCep($row['cep']);
                $gerente->setNumeroCasa($row['numero_casa']);
                
                return $gerente;
            }
            
            return null;
            
        } catch (PDOException $e) {
            echo "Erro ao buscar gerente: " . $e->getMessage();
            return null;
        }
    }
}