<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InfoCare - Cadastro de Funcionário</title>
        <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="../css/cssGerente.css" type="text/css" rel="stylesheet">
        
        <script type="text/javascript" src="prototype.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.mask.min.js"></script>
        
        <script type="text/javascript">
        function limpa_formulário_cep() {
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                document.getElementById('rua').value=(conteudo.logradouro);
                document.getElementById('bairro').value=(conteudo.bairro);
            } else {
                limpa_formulário_cep();
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
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } else {
                limpa_formulário_cep();
            }
        };
        
        function TestaCPF(strCPF) {
            var Soma, Resto;
            Soma = 0;
            var cpf = strCPF.replace(/\D/g, '');
            
            if (cpf == "00000000000"){
                document.getElementById("cpf").setCustomValidity('Inválido');
                return false;
            }
            
            for (i=1; i<=9; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(cpf.substring(9, 10))){
                document.getElementById("cpf").setCustomValidity('Inválido');
                return false;
            }
            
            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(cpf.substring(10, 11))){
                document.getElementById("cpf").setCustomValidity('Inválido');
                return false;
            }
            
            document.getElementById("cpf").setCustomValidity('');
            return true;
        }
        </script>
    </head>
    <body class="fundo" id="fundoCadastro">    
        
        <?php
         include_once ("verificacao.php");
        ?>

         <header class="cabecalho">
           <a href="../View/homeGerente.php"> <h1 class="logo"></h1></a>
            <div class="menu">
               <nav>
                   <ul>  
                   </ul>
                </nav>
            </div>
             <br><br>
                <h3>Preencha os campos:</h3>
                <h4>*Preencha todos os campos:</h4>
        <div class="box" style="margin-top: 1em;">
            
        <form action="../Controller/rotinasCadastroFuncionario.php" method="post">
            
            <div class="form-row">
                <div class="form-group col-md-3 col-sm-6 col-20">
                    <input type="text" class="form-control" id="nome" name="nome" required="" placeholder="Nome">
                </div>
                <div class="form-group col-md-3 col-sm-6 col-15 ">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required="" >
                </div>
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                </div>
            
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="cpf" name="cpf" required="" placeholder="CPF" onblur="TestaCPF(this.value);">
                </div>
                
                <script type="text/javascript">$("#cpf").mask("000.000.000-00");</script>
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-3 col-4">   
                        <select class="form-control" id="sexo" name="sexo" required="">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                </div>
                
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="date" class="form-control" id="nascimento" onchange="validardataDeNascimento(this.value);" name="nascimento" required="" placeholder="Data Nascimento">
                </div>     
                 
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="cep" name="cep" required="" placeholder="CEP" onblur="pesquisacep(this.value);">
                </div>
                    
                <script type="text/javascript">$("#cep").mask("00000-000");</script>
                    
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="rua" name="rua" required="" placeholder="Rua">
                </div>
                </div>
            
                <div class="form-row">
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="bairro" name="bairro" required="" placeholder="Bairro">
                </div>
                    
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="numero_casa" name="numero_casa" required="" placeholder="Número casa">
                </div>

                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="number" step="0.01" class="form-control" id="salario" name="salario" required="" placeholder="Salário (Ex: 2500.00)">
                </div>
                    
                <div id="divTelefone" class="form-group col-md-3 col-sm-6 col-15">
                    <input type="tel" class="form-control" id="telefone1" name="telefone[]" required="" placeholder="Telefone">
                </div>
                
                <script type="text/javascript">$("#telefone1").mask("(00) 00000-0000");</script>
            </div>
            
            <div class="enviar mt-3">
                <a href="homeGerente.php" class="btn btn-secondary" id="voltarBtn">Voltar</a>&nbsp;&nbsp;&nbsp;
                <input type="submit" class="btn btn-primary" id="btnCadastrar" name="cadastrar" value="Cadastrar">
                <button type="button" class="btn btn-info" id="adicionarTelefone">Adicionar Outro Telefone</button>
            </div>
                     
        </form>
         </div>
            
        </header>
        
    </body>
    <script type="text/javascript" language="javascript">
    const adicionar = document.getElementById("adicionarTelefone");
    const divTelefone = document.getElementById("divTelefone");

    let i = 2;
    
    adicionar.addEventListener("click", function(event) {
        let campo = document.createElement("input");
        campo.type = "tel";
        campo.className = "form-control mt-2"; // mt-2 para dar um espacinho do de cima
        campo.id = "telefone"+i;
        // Permite enviar múltiplos telefones como Array para o PHP
        campo.name = "telefone[]"; 
        campo.placeholder = "Outro Telefone";
        divTelefone.appendChild(campo);
        $("#telefone"+i).mask("(00) 00000-0000");
        
        i++;
    });
        
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
</html>