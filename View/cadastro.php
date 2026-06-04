<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>InfoCare</title>
        <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="../css/Ger.css" type="text/css" rel="stylesheet">
        
        <script type="text/javascript" src="prototype.js"></script>
        
        <script type="text/javascript">
            
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('ruaEndereco').value=("");
            document.getElementById('bairroEndereco').value=("");

    }
            

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('ruaEndereco').value=(conteudo.logradouro);
            document.getElementById('bairroEndereco').value=(conteudo.bairro);

        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('ruaEndereco').value="...";
                document.getElementById('bairroEndereco').value="...";


                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
        
        //Verifica se CPF é válido
	function TestaCPF(strCPF) {
		var Soma, Resto, borda_original;
		Soma = 0;
        
        var cpf = strCPF.replace(/\D/g, '');
		
		if (cpf == "00000000000"){
			document.getElementById("cpfPessoa").setCustomValidity('Inválido');
			return false;
		}
		
		for (i=1; i<=9; i++){
			Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
		}
		
		Resto = (Soma * 10) % 11;
		if ((Resto == 10) || (Resto == 11)){
			Resto = 0;
		}
		
		if (Resto != parseInt(cpf.substring(9, 10))){
			document.getElementById("cpfPessoa").setCustomValidity('Inválido');
			return false;
		}
		
		Soma = 0;
		for (i = 1; i <= 10; i++){
			Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
		}
		
		Resto = (Soma * 10) % 11;
		if ((Resto == 10) || (Resto == 11)){
			Resto = 0;
		}
		
		if (Resto != parseInt(cpf.substring(10, 11))){
			document.getElementById("cpfPessoa").setCustomValidity('Inválido');
			return false;
		}
		
		document.getElementById("cpfPessoa").setCustomValidity('');
		return true;
	}
    </script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    </head>
    <body class="fundo" id="fundoCadastro">    
        
        <?php
        include_once ("verificacao.php");
       ?>

         <header class="cabecalho">
           <a href="../View/homeGerente.php"> <h1 class="logo"></h1>
            </a>
            <div class="menu">
               <nav>
                   <ul>  
                   </ul>
                </nav>
            </div>
             <br><br>
                <h3>Dados do Gerente</h3>
                <h4>*Preencha todos os campos:</h4>
        <div class="box" style="margin-top: 1em;">
            
        <form action="../Controller/rotinasCadastroFuncionario.php" method="post">
            
            <div class="form-row">
                <div class="form-group col-md-3 col-sm-6 col-20">
                    <input type="text" class="form-control" id="nomePessoa" name="nomePessoa" required="" placeholder="Nome*">
                </div>
                <div class="form-group col-md-3 col-sm-6 col-15 ">
                    <input type="email" class="form-control" id="emailPessoa" name="emailPessoa" placeholder="E-mail*" required="" >
                </div>
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="password" class="form-control" id="senhaPessoa" name="senhaPessoa" placeholder="Senha*">
                </div>
            
                
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="cpfPessoa" name="cpfPessoa" required="" placeholder="CPF*" onblur="TestaCPF(this.value);">
                </div>
                
                <script type="text/javascript">$("#cpfPessoa").mask("999.999.999-99");</script>
                
                
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-3 col-4">   
                <select  class="form-control" id="sexoPessoa" name="sexoPessoa" required="">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                </div>
                
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="date" class="form-control" onchange="validardataDeNascimento(this.value);" id="nascPessoa" name="nascPessoa" required="" placeholder="Data Nascimento*">
                </div>     
                
                 
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="cepEndereco" name="cepEndereco" required="" placeholder="CEP*" onblur="pesquisacep(this.value);">
                </div>
                    
                    <script type="text/javascript">$("#cepEndereco").mask("00000-000");</script>
                    
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="ruaEndereco" name="ruaEndereco" required="" placeholder="Rua*">
                </div>
                    

                </div>
            
                <div class="form-row">
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="bairroEndereco" name="bairroEndereco" required="" placeholder="Bairro*">
                </div>
                    
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type="text" class="form-control" id="numCasaEndereco" name="numCasaEndereco" required="" placeholder="N° casa*">
                </div>
                    
                <div id="telefonePessoa" class="form-group col-md-3 col-sm-6 col-15">
                    <input type="tel" class="form-control" id="telefonePessoa1" name="telefonePessoa[]" required="" placeholder="Telefone*">
                </div>
                
                <script type="text/javascript">$("#telefonePessoa1").mask("(00) 0000-0000");</script>
            </div>
                    <fieldset class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="hidden" name="cargoFuncionario" id="cargoFuncionario1" value="Gerente" checked>
                        <label class="form-check-label" for="cargoFuncionario1">
                            
                        </label>
                    </div>
              </fieldset>
            
            <div class="form-row">
                <div class="form-group col-md-2 col-sm-5 col-5">
                   
                </div>
                </div>
            
            <div class="enviar">
                <a href="homeAdm.php" class="btn btn-primary" id="registerUser">Voltar</a>&nbsp;&nbsp;&nbsp;
                <input type="submit" class="btn btn-primary" id="loginUser" name="login" value="Cadastrar">
            </div>
                     
        </form>
       
        
        <div class="extras">
           
        </div>
         </div>
            
        </header>
        
    </body>
    <script type="text/javascript" language="javascript">
    const adicionar = document.getElementById("adicionarTelefone");
    const telefonePessoa = document.getElementById("telefonePessoa");

    let i = 2 ;
    
    adicionar.addEventListener("click", function(event) {
        let campo = document.createElement("input");
        campo.type = "tel";
        campo.class = "form-control";
        campo.id = "telefonePessoa"+i;
        campo.name = "telefonePessoa[]";
        campo.createPattern = "\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}";
        campo.placeholder = "Telefone da pessoa";
        telefonePessoa.appendChild(campo);
        $("#telefonePessoa"+i).mask("(00) 0000-00009");
        
        console.log(campo, i);
        i++;
    });
        
       function validardataDeNascimento(data){

            dataAtual= new Date();

            data=new Date(data);

            if (data<dataAtual){
                console.log("Data Valida");
                return true;
            } else {
                alert("Data inválida");
                document.getElementById('nascPessoa').value=("");
                return false;
            }


        } 

</script>
</html>
