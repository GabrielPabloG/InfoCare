<?php 
session_start();
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();
$idGerente = $_SESSION['user_id'];

try {
    // Busca os dados do gerente no banco refatorado
    $sql = "SELECT nome, cpf, sexo, nascimento, email, salario, rua, bairro, cep, numero_casa 
            FROM gerente WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idGerente]);
    $func = $stmt->fetch(PDO::FETCH_ASSOC);

    // Busca o telefone principal dele
    $sqlTel = "SELECT numero FROM telefone WHERE entidade_tipo = 'gerente' AND entidade_id = ? LIMIT 1";
    $stmtTel = $conn->prepare($sqlTel);
    $stmtTel->execute([$idGerente]);
    $telefone = '';
    if ($telDb = $stmtTel->fetch(PDO::FETCH_ASSOC)) {
        $telefone = $telDb['numero'];
    }

} catch (PDOException $e) {
    die("Erro ao carregar os dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InfoCare - Atualizar Perfil Gerente</title>
        
        <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="../css/Func.css" type="text/css" rel="stylesheet">
        
        <script type="text/javascript" src="prototype.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.mask.min.js"></script>
        
        <script type="text/javascript">
            function limpa_formulario_cep() {
                document.getElementById('rua').value=("");
                document.getElementById('bairro').value=("");
            }

            function meu_callback(conteudo) {
                if (!("erro" in conteudo)) {
                    document.getElementById('rua').value=(conteudo.logradouro);
                    document.getElementById('bairro').value=(conteudo.bairro);
                } else {
                    limpa_formulario_cep();
                    alert("CEP não encontrado.");
                }
            }
            
            function pesquisacep(valor) {
                var cep = valor.replace(/\D/g, '');
                if (cep != "") {
                    var validacep = /^[0-9]{8}$/;
                    if(validacep.test(cep)) {
                        document.getElementById('rua').value="...";
                        document.getElementById('bairro').value="...";
                        var script = document.createElement('script');
                        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
                        document.body.appendChild(script);
                    } else {
                        limpa_formulario_cep();
                        alert("Formato de CEP inválido.");
                    }
                } else {
                    limpa_formulario_cep();
                }
            }
            
            function TestaCPF(strCPF) {
                var Soma, Resto;
                Soma = 0;
                var cpf = strCPF.replace(/\D/g, '');
                if (cpf == "00000000000"){ document.getElementById("cpf").setCustomValidity('Inválido'); return false; }
                for (i=1; i<=9; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
                Resto = (Soma * 10) % 11;
                if ((Resto == 10) || (Resto == 11)) Resto = 0;
                if (Resto != parseInt(cpf.substring(9, 10))){ document.getElementById("cpf").setCustomValidity('Inválido'); return false; }
                Soma = 0;
                for (i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
                Resto = (Soma * 10) % 11;
                if ((Resto == 10) || (Resto == 11)) Resto = 0;
                if (Resto != parseInt(cpf.substring(10, 11))){ document.getElementById("cpf").setCustomValidity('Inválido'); return false; }
                document.getElementById("cpf").setCustomValidity('');
                return true;
            }
        </script>
    </head>
    
    <body class="fundo" id="fundoCadastro">    
        <header class="cabecalho">
           <a href="../View/homeGerente.php"> <h1 class="logo"></h1></a>
            <div class="menu">
               <nav><ul></ul></nav>
            </div>
        </header>

        <div class="box" style="margin-top: 1em;">
            <form action="../Controller/rotinasAtualizarGerente.php" method="post" class="container">
                
                <h3>Edite seus dados (Gerente):</h3>
                <br>
                
                <input type="hidden" name="id" value="<?php echo $idGerente; ?>">

                <div class="form-row">
                    <div class="form-group col-md-3 col-sm-4">
                        <label>Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($func['nome']); ?>" required placeholder="Nome">
                    </div>
                    <div class="form-group col-md-3 col-sm-4 ">
                        <label>E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($func['email']); ?>" required placeholder="E-mail">
                    </div>
                    <div class="form-group col-md-3 col-sm-4">
                        <label>Nova Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Deixe em branco para manter">
                    </div>
                    <div class="form-group col-md-3 col-sm-4">
                        <label>CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo htmlspecialchars($func['cpf']); ?>" required placeholder="CPF" onblur="TestaCPF(this.value);">
                    </div>
                    <script type="text/javascript">$("#cpf").mask("000.000.000-00");</script>
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-3 col-sm-4">   
                        <label>Sexo</label>
                        <select class="form-control" id="sexo" name="sexo" required>
                            <option value="Masculino" <?php if($func['sexo'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
                            <option value="Feminino" <?php if($func['sexo'] == 'Feminino') echo 'selected'; ?>>Feminino</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-sm-4">
                        <label>Data Nascimento</label>
                        <input type="date" class="form-control" id="nascimento" name="nascimento" value="<?php echo htmlspecialchars($func['nascimento']); ?>" required>
                    </div>     
                    <div class="form-group col-md-3 col-sm-4">
                        <label>CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" value="<?php echo htmlspecialchars($func['cep']); ?>" required placeholder="CEP" onblur="pesquisacep(this.value);">
                    </div>
                    <script type="text/javascript">$("#cep").mask("00000-000");</script>
                    <div class="form-group col-md-3 col-sm-4">
                        <label>Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua" value="<?php echo htmlspecialchars($func['rua']); ?>" required placeholder="Rua">
                    </div>
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-3 col-sm-4">
                        <label>Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo htmlspecialchars($func['bairro']); ?>" required placeholder="Bairro">
                    </div>
                    <div class="form-group col-md-2 col-sm-2">
                        <label>N° Casa</label>
                        <input type="text" class="form-control" id="numero_casa" name="numero_casa" value="<?php echo htmlspecialchars($func['numero_casa']); ?>" required placeholder="N°">
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-3">
                        <label>Salário</label>
                        <input type="number" step="0.01" class="form-control" id="salario" name="salario" value="<?php echo htmlspecialchars($func['salario']); ?>" required placeholder="Salário">
                    </div>

                    <div id="divTelefones" class="form-group col-md-4 col-sm-3">
                        <label>Telefone</label>
                        <input type="tel" class="form-control" id="telefone1" name="telefone[]" value="<?php echo htmlspecialchars($telefone); ?>" required placeholder="Telefone Principal">
                    </div>
                    <script type="text/javascript">$("#telefone1").mask("(00) 00000-0000");</script>
                </div>
            
                <div class="enviar mt-4 mb-5">
                    <a href="homeGerente.php" class="btn btn-secondary">Voltar</a>&nbsp;&nbsp;&nbsp;
                    <input type="submit" class="btn btn-primary" value="Salvar Alterações">
                    <button type="button" class="btn btn-info" id="adicionarTelefone">Adicionar Outro Telefone</button>
                </div>
            </form>
        </div>
        
        <script type="text/javascript" language="javascript">
            const adicionar = document.getElementById("adicionarTelefone");
            const divTelefones = document.getElementById("divTelefones");
            let i = 2 ;
            
            adicionar.addEventListener("click", function(event) {
                let campo = document.createElement("input");
                campo.type = "tel";
                campo.className = "form-control mt-2";
                campo.id = "telefone"+i;
                campo.name = "telefone[]";
                campo.placeholder = "Outro Telefone";
                divTelefones.appendChild(campo);
                $("#telefone"+i).mask("(00) 00000-0000");
                i++;
            });
        </script>
    </body>
</html>