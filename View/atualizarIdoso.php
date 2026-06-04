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
        <link href="../css/cssGerente.css" type="text/css" rel="stylesheet">
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
			document.getElementById("cpfIdoso").setCustomValidity('Inválido');
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
			document.getElementById("cpfIdoso").setCustomValidity('Inválido');
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
			document.getElementById("cpfIdoso").setCustomValidity('Inválido');
			return false;
		}
		
		document.getElementById("cpfIdoso").setCustomValidity('');
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
           <a href="../View/homeGerente.php"> <h1 class="logo"></h1>
            </a>
            <div class="menu">
               <nav>
                   <ul>  
                   </ul>
                </nav>
            </div>
             <br>
             <br>
                <h3>Digite o cpf:</h3>

        <div class="box" style="margin-top: 1em;">
            
            <form action='atualizarIdoso.php' method='post'>
                <div class="form-row">
                   <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type='text' class="form-control" id='cpfIdoso' name='cpfIdoso' required='' placeholder='CPF do Idoso'> 
                    </div>
                    
                    <script type="text/javascript">$("#cpfIdoso").mask("999.999.999-99");</script>
                   
                    <div class="form-group col-md-2 col-sm-5 col-5">
                    <input type='submit' class="btn btn-primary" value='Procurar'>
                    </div></div>
                </form>
            
        <form action="../Controller/rotinasAtualizarIdoso.php" method="post">
            
            <?php

            @$cpfIdoso = $_POST['cpfIdoso'];
            
            $conexao = abrirConexao();
            
                $dados = "SELECT tbIdoso.nomeIdoso, tbIdoso.cpfIdoso, tbIdoso.sexoIdoso, tbIdoso.NascIdoso, tbResponsavel.cpfResponsavel FROM tbIdoso INNER JOIN tbResponsavel ON tbIdoso.codResponsavel = tbResponsavel.codResponsavel WHERE tbIdoso.cpfIdoso = '".$cpfIdoso."'";
            
            //echo($dados);
                
                 $resultado = $conexao->query($dados);
            
            $nome = '';
            $cpf = '';
            $sexo = '';
            $nasc = '';
            $cpf1 = '';

                while($linharesultado = mysqli_fetch_array($resultado)){
                    $nome = $linharesultado['nomeIdoso'];
                    $cpf = $linharesultado['cpfIdoso'];
                    $sexo = $linharesultado['sexoIdoso'];
                    $nasc = $linharesultado['NascIdoso'];
                    $cpf1 = $linharesultado['cpfIdoso'];
                }
            
            echo('
            
            <div class="form-row">
                <div class="form-group col-md-3 col-sm-8" id="nomeIdoso">
                    <input type="nome" class="form-control" id="nomeIdoso" name="nomeIdoso" required="" value="'.$nome.'" placeholder="Nome">
                </div>
                
                <div class="form-group col-md-3 col-sm-6">
                    <input type="text" class="form-control" id="cpfIdoso" name="cpfIdoso" required="" value="'.$cpf.'" placeholder="CPF"  readonly=“true”>
                </div>
                
                <script type="text/javascript">$("#cpfIdoso").mask("999.999.999-99");</script>

                <div class="form-group col-md-2 col-sm-4 col-10">   
                <select  class="form-control" id="sexoIdoso" name="sexoIdoso" value="'.$sexo.'" required="">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                            <option selected="selected" value="'.$sexo.'">'.$sexo.'</option>
                        </select>
                </div>
            </div>
                <div class="form-row">
                <div class="form-group col-md-2 col-sm-5 col-15">
                    <input type="date" class="form-control" id="nascIdoso" name="nascIdoso" required="" value="'.$nasc.'" placeholder="Data Nascimento">
                </div>
                
                <div class="form-group col-md-3 col-sm-5 col-25">
                    <input type="hidden" class="form-control" id="cpfPessoa" name="cpfPessoa" value="'.$cpf1.'"required="" placeholder="CPF do responsável">
                    
                </div>
                <script type="text/javascript">$("#cpfPessoa").mask("999.999.999-99");</script>
            </div>
            
            <div class="enviar">
                <a href="homeGerente.php" id="registerUser">Voltar</a>&nbsp;&nbsp;&nbsp;
                <input type="submit" class="btn btn-primary" id="loginUser" name="login" value="Registrar">
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
