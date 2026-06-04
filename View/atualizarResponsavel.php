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
        <link href="../css/Res.css" type="text/css" rel="stylesheet">
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
        include_once '../Dao/conexao.php';
       ?>

         <header class="cabecalho">
           <a href="../View/homeResponsavel.php"> <h1 class="logo"></h1>
            </a>
            <div class="menu">
               <nav>
                   <ul>
                   </ul>
                </nav>
            </div>
             <br>
             <br>
                <h3>Edite seus dados:</h3>

        <div class="box" style="margin-top: 1em;">
            
        <form action="../Controller/rotinasAtualizar.php" method="post">
            
            <?php
            
            $conexao = abrirConexao();
            
                $dados = "SELECT tbresponsavel.nomeResponsavel, 
				tbresponsavel.cpfResponsavel, 
				tbresponsavel.sexoResponsavel, 
				tbresponsavel.NascResponsavel, 
				tbresponsavel.emailResponsavel, 
				tbresponsavel.senhaResponsavel,
				tbenderecoresponsavel.ruaEnderecoResponsavel, 
				tbenderecoresponsavel.bairroEnderecoResponsavel, 
				tbenderecoresponsavel.cepEnderecoResponsavel, 
				tbenderecoresponsavel.numCasaEnderecoResponsavel,
				tbTelefoneresponsavel.numeroTelefoneresponsavel
				FROM tbresponsavel 
				INNER JOIN tbenderecoresponsavel 
				ON tbresponsavel.codEnderecoResponsavel = tbenderecoresponsavel.codEnderecoResponsavel
				INNER JOIN tbTelefoneresponsavel ON tbresponsavel.codResponsavel = tbTelefoneresponsavel.codResponsavel
				WHERE tbresponsavel.codResponsavel = ".$_SESSION['codUsuario'];
            //echo($dados);
                
                 $resultado = $conexao->query($dados);

                while($linharesultado = mysqli_fetch_array($resultado)){
                    $nome = $linharesultado['nomeResponsavel'];
                    $cpf = $linharesultado['cpfResponsavel'];
                    $sexo = $linharesultado['sexoResponsavel'];
                    $nasc = $linharesultado['NascResponsavel'];
                    $email = $linharesultado['emailResponsavel'];
                    $senha = $linharesultado['senhaResponsavel'];
					$telefone = $linharesultado['numeroTelefoneresponsavel'];
                    
                    $rua = $linharesultado['ruaEnderecoResponsavel'];
                    $bairro = $linharesultado['bairroEnderecoResponsavel'];
                    $cep = $linharesultado['cepEnderecoResponsavel'];
                    $numCasa = $linharesultado['numCasaEnderecoResponsavel'];
                }
            
            echo('
            
            <div class="form-row">
                <div class="form-group col-md-3 col-sm-4">
                    <input type="text" class="form-control" id="nomePessoa" name="nomePessoa" value="'.$nome.'" required="" placeholder="Nome">
                </div>
                <div class="form-group col-md-3 col-sm-4 ">
                    <input type="email" class="form-control" id="emailPessoa" name="emailPessoa" value="'.$email.'" placeholder="E-mail" required="" >
                </div>
                <div class="form-group col-md-2 col-sm-4 col-6">
                    <input type="password" class="form-control" id="senhaPessoa" name="senhaPessoa" value="'.$senha.'" name= placeholder="Senha">
                </div>
            
                
                <div class="form-group col-md-2 col-sm-3 col-6">
                    <input type="text" class="form-control" id="cpfPessoa" value="'.$cpf.'" name="cpfPessoa" required="" placeholder="CPF" onblur="TestaCPF(this.value);">
                </div>
                
                <script type="text/javascript">$("#cpfPessoa").mask("999.999.999-99");</script>
                
                
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-3 col-8">   
                <select  class="form-control" id="sexoPessoa" name="sexoPessoa" value="'.$sexo.'" required="">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                </div>
                
                <div class="form-group col-md-2 col-sm-4 col-10">
                    <input type="date" class="form-control" id="nascPessoa" value="'.$nasc.'" name="nascPessoa" required="" placeholder="Data Nascimento">
                </div>     
                
                 
                <div class="form-group col-md-3 col-sm-4 col-6">
                    <input type="text" class="form-control" id="cepEndereco" name="cepEndereco" value="'.$cep.'" required="" placeholder="CEP" onblur="pesquisacep(this.value);">
                </div>
                    
                    <script type="text/javascript">$("#cepEndereco").mask("00000-000");</script>
                    
                <div class="form-group col-md-3 col-sm-6 col-6">
                    <input type="text" class="form-control" id="ruaEndereco" value="'.$rua.'" name="ruaEndereco" required="" placeholder="Rua">
                </div>
                    
                </div>
            
                <div class="form-row">
                <div class="form-group col-md-3 col-sm-5 col-7">
                    <input type="text" class="form-control" id="bairroEndereco" value="'.$bairro.'" name="bairroEndereco" required="" placeholder="Bairro">
                </div>
                    
                <div class="form-group col-md-1 col-sm-3 col-4">
                    <input type="text" class="form-control" id="numCasaEndereco" value="'.$numCasa.'" name="numCasaEndereco" required="" placeholder="Núm Casa">
                </div>
                    
                <div id="telefonePessoa" class="form-group col-md-3 col-sm-4 col-8">
                    <input type="tel" class="form-control" id="telefonePessoa1" value="'.$telefone.'" name="telefonePessoa[]"  required="" placeholder="Telefone da pessoa">
                </div>
                
                <script type="text/javascript">$("#telefonePessoa1").mask("(00) 0000-00009");</script>

            </div>
            
            <div class="enviar">
                <a href="homeResponsavel.php" class="btn btn-primary" id="registerUser">Voltar</a>
                <input type="submit" class="btn btn-primary" id="loginUser" name="login" value="Editar">
            </div>
            
            ');
            
            ?>
            
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
        campo.id = "telefonePessoa"+i;
        campo.name = "telefonePessoa[]";
        campo.createPattern = "\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}";
        campo.placeholder = "Telefone da pessoa";
        telefonePessoa.appendChild(campo);
        $("#telefonePessoa"+i).mask("(00) 0000-00009");
        
        console.log(campo, i);
        i++;
    });

</script>
</html>
