<?php
require_once 'conexao.php';
require_once '../Model/Funcionario.php';

class DaoFuncionario {

    public function insert(Funcionario $funcionario) {
        try {
            $conn = Conexao::getConexao();

            $sql = "INSERT INTO funcionario (nome, cpf, sexo, nascimento, salario, email, senha, rua, bairro, cep, numero_casa, gerente_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $funcionario->getNome(),
                $funcionario->getCpf(),
                $funcionario->getSexo(),
                $funcionario->getNascimento(),
                $funcionario->getSalario(),
                $funcionario->getEmail(),
                $funcionario->getSenha(),
                $funcionario->getRua(),
                $funcionario->getBairro(),
                $funcionario->getCep(),
                $funcionario->getNumeroCasa(),
                $funcionario->getGerenteId()
            ]);

            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar funcionário: " . $e->getMessage();
            return false;
        }
    }

    public function update(Funcionario $funcionario) {
    try {
        $conn = Conexao::getConexao();
        
        // Monta a base da query (tudo MENOS a senha)
        $sql = "UPDATE funcionario SET 
                nome = ?, cpf = ?, sexo = ?, nascimento = ?, 
                email = ?, salario = ?, rua = ?, bairro = ?, 
                cep = ?, numero_casa = ?";
        
        // Array com os valores correspondentes
        $valores = [
            $funcionario->getNome(), $funcionario->getCpf(), $funcionario->getSexo(),
            $funcionario->getNascimento(), $funcionario->getEmail(), $funcionario->getSalario(),
            $funcionario->getRua(), $funcionario->getBairro(), $funcionario->getCep(),
            $funcionario->getNumeroCasa()
        ];

        // Se a senha NÃO for nula, adicionamos ela na query
        if ($funcionario->getSenha() !== null) {
            $sql .= ", senha = ?";
            $valores[] = $funcionario->getSenha(); // Adiciona o hash na lista de valores
        }

        // Finaliza a query com o WHERE e adiciona o ID na lista de valores
        $sql .= " WHERE id = ?";
        $valores[] = $funcionario->getId();

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

            $sql = "DELETE FROM funcionario WHERE id = ?";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Erro ao deletar funcionário: " . $e->getMessage();
            return false;
        }
    }

    public function listAll() {
        try {
            $conn = Conexao::getConexao();

            $sql = "SELECT * FROM funcionario";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $funcionarios = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $funcionario = new Funcionario();
                $funcionario->setId($row['id']);
                $funcionario->setNome($row['nome']);
                $funcionario->setCpf($row['cpf']);
                $funcionario->setSexo($row['sexo']);
                $funcionario->setNascimento($row['nascimento']);
                $funcionario->setSalario($row['salario']);
                $funcionario->setEmail($row['email']);
                $funcionario->setSenha($row['senha']);
                $funcionario->setRua($row['rua']);
                $funcionario->setBairro($row['bairro']);
                $funcionario->setCep($row['cep']);
                $funcionario->setNumeroCasa($row['numero_casa']);
                $funcionario->setGerenteId($row['gerente_id']);

                $funcionarios[] = $funcionario;
            }

            return $funcionarios;
        } catch (PDOException $e) {
            echo "Erro ao listar funcionários: " . $e->getMessage();
            return [];
        }
    }

    public function getById($id) {
        try {
            $conn = Conexao::getConexao();

            $sql = "SELECT * FROM funcionario WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $funcionario = new Funcionario();
                $funcionario->setId($row['id']);
                $funcionario->setNome($row['nome']);
                $funcionario->setCpf($row['cpf']);
                $funcionario->setSexo($row['sexo']);
                $funcionario->setNascimento($row['nascimento']);
                $funcionario->setSalario($row['salario']);
                $funcionario->setEmail($row['email']);
                $funcionario->setSenha($row['senha']);
                $funcionario->setRua($row['rua']);
                $funcionario->setBairro($row['bairro']);
                $funcionario->setCep($row['cep']);
                $funcionario->setNumeroCasa($row['numero_casa']);
                $funcionario->setGerenteId($row['gerente_id']);

                return $funcionario;
            }

            return null;
        } catch (PDOException $e) {
            echo "Erro ao buscar funcionário: " . $e->getMessage();
            return null;
        }
    }
}