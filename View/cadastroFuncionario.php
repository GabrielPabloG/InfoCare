<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoCare - Cadastro de Funcionário</title>
    
    <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../css/Gerente.css" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="imagens/favicon.ico">
        
    <script type="text/javascript" src="prototype.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    
    <script type="text/javascript">
        function limpa_formulario_cep() {
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
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
                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
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

        function validardataDeNascimento(data){
            dataAtual = new Date();
            data = new Date(data);
            if (data < dataAtual){
                return true;
            } else {
                alert("Data inválida");
                document.getElementById('nascimento').value=("");
                return false;
            }
        }
    </script>
</head>

<body>
    <?php
       include_once ("verificacao.php");
    ?>

    <header class="cabecalho">
       <a href="../View/listCuidador.php"><h1 class="logo"></h1></a>
    </header>
    <br><br><br><br><br><br>

    <form action="../Controller/processaCuidador.php" method="post" class="container">
        <h3>Dados do Funcionário</h3>
        <h4>*Preencha todos os campos:</h4>
        <br>
        
        <div class="form-row">
            <div class="form-group col-md-3 col-sm-4">
                <input type="text" class="form-control" id="nome" name="nome" required="" placeholder="Nome*">
            </div>
            <div class="form-group col-md-3 col-sm-4">
                <input type="email" class="form-control" id="email" name="email" required="" placeholder="E-mail*">
            </div>
            <div class="form-group col-md-3 col-sm-4">
                <input type="password" class="form-control" id="senha" name="senha" required="" placeholder="Senha*">
            </div>
            <div class="form-group col-md-3 col-sm-4">
                <input type="text" class="form-control" id="cpf" name="cpf" required="" placeholder="CPF*" onblur="TestaCPF(this.value);">
            </div>
            <script type="text/javascript">$("#cpf").mask("000.000.000-00");</script>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-2 col-sm-4">   
                <select class="form-control" id="sexo" name="sexo" required="">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            <div class="form-group col-md-2 col-sm-4">
                <input type="date" class="form-control" id="nascimento" name="nascimento" required="" onchange="validardataDeNascimento(this.value);" placeholder="Data Nascimento*">
            </div>     
            <div class="form-group col-md-3 col-sm-4">
                <input type="text" class="form-control" id="cep" name="cep" required="" placeholder="CEP*" onblur="pesquisacep(this.value);">
            </div>
            <script type="text/javascript">$("#cep").mask("00000-000");</script>
            <div class="form-group col-md-5 col-sm-4">
                <input type="text" class="form-control" id="rua" name="rua" required="" placeholder="Rua*">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-4 col-sm-5">
                <input type="text" class="form-control" id="bairro" name="bairro" required="" placeholder="Bairro*">
            </div>
            <div class="form-group col-md-2 col-sm-3">
                <input type="text" class="form-control" id="numero_casa" name="numero_casa" required="" placeholder="N° casa*">
            </div>
            
            <div class="form-group col-md-3 col-sm-4">
                <input type="number" step="0.01" class="form-control" id="salario" name="salario" required="" placeholder="Salário (Ex: 2500.00)*">
            </div>

            <div id="divTelefones" class="form-group col-md-3 col-sm-4">
                <input type="tel" class="form-control" id="telefone1" name="telefone[]" required="" placeholder="Telefone*">
            </div>
            <script type="text/javascript">$("#telefone1").mask("(00) 00000-0000");</script>
        </div>
        
        <div class="enviar mt-3 mb-5">
            <a href="listCuidador.php" class="btn btn-secondary">Voltar</a>&nbsp;&nbsp;&nbsp;
            <input type="submit" class="btn btn-primary" name="cadastrar" value="Cadastrar">
            <button type="button" class="btn btn-info" id="adicionarTelefone">Adicionar Outro Telefone</button>
        </div>
        
        <?php if(isset($_SESSION['cadastrando1'])) echo "<p class='text-info'>" . $_SESSION['cadastrando1'] . "</p>"; ?>
    </form>

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