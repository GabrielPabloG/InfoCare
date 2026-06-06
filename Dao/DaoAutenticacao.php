<?php
require_once 'conexao.php';

class DaoAutenticacao {

    public function autenticar($email, $senhaDigitada) {
        try {
            $conn = Conexao::getConexao();
            
            $tabelas = [
                'admin' => 'admin',
                'gerente' => 'gerente',
                'funcionario' => 'funcionario',
                'responsavel' => 'responsavel'
            ];

            foreach ($tabelas as $tabela => $tipoUsuario) {
                $sql = "SELECT id, nome, senha FROM {$tabela} WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$email]);
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($usuario) {
                    // Compara a senha digitada em texto limpo com o hash salvo no banco.
                    if (password_verify($senhaDigitada, $usuario['senha'])) {
                        return [
                            'id' => $usuario['id'],
                            'nome' => $usuario['nome'],
                            'tipo' => $tipoUsuario
                        ];
                    }
                }
            }

            return false; 
            
        } catch (PDOException $e) {
            echo "Erro na autenticação: " . $e->getMessage();
            return false;
        }
    }
}
?>