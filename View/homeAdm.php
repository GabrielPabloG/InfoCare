<?php
	include_once '../Dao/conexao.php';

	$result_idoso = "SELECT * From tbgerente";
	$resultado_idoso = mysqli_query($conn, $result_idoso);
?>
<html>
    
    <head>
        <title>InfoCare</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link href="../css/default.css" rel="stylesheet">
        <link href="../css/component.css" rel="stylesheet">
        <link href="../cssModal/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/adm.css">
        <script type="text/javascript" src="prototype.js"></script>
        <script src="../js/modernizr.custom.js"></script>
        <script type="text/javascript" language="javascript">
        
            //Verifica se CPF é válido
	function TestaCPF(strCPF) {
		var Soma, Resto, borda_original;
		Soma = 0;
        
        var cpf = strCPF.replace(/\D/g, '');
		
		if (cpf == "00000000000"){
			document.getElementById("recipient-cpf").setCustomValidity('Inválido');
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
			document.getElementById("recipient-cpf").setCustomValidity('Inválido');
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
			document.getElementById("recipient-cpf").setCustomValidity('Inválido');
			return false;
		}
		
		document.getElementById("recipient-cpf").setCustomValidity('');
		return true;
	}//Verifica se CPF é válido
	function TestaCPF(strCPF) {
		var Soma, Resto, borda_original;
		Soma = 0;
        
        var cpf = strCPF.replace(/\D/g, '');
		
		if (cpf == "00000000000"){
			document.getElementById("recipient-cpf").setCustomValidity('Inválido');
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
			document.getElementById("recipient-cpf").setCustomValidity('Inválido');
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
			document.getElementById("recipient-cpf").setCustomValidity('Inválido');
			return false;
		}
		
		document.getElementById("recipient-cpf").setCustomValidity('');
		return true;
	}
        </script>
        
         <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    </head>
    
    <body>
        
        <header class="cabecalho">
           <a href="../View/homeAdm.php"> <h1 class="logo"></h1>
            </a>
            <div class="novomenu">
          <div id="dl-menu" class="dl-menuwrapper">
              <br><br>
						<button class="dl-trigger" style="background-color: transparent"></button>
						<ul class="dl-menu" style=" background-color: rgba(52,103,125,0.8);">
							<li>
								<a href="#containerM">Gerente</a>
                            </li>
                            
                            <li>
								<a href="../View/logout.php">Sair</a>
                            </li>
              </ul>
                 </div>
            </div>
            <div class="menu">
               
            </div>
        </header>
        <div class="lixo">
            <?php 
            session_start();
        include_once '../Dao/conexao.php';
        $conexao = abrirConexao();

        $msg = false;

        if(isset($_FILES['foto'])) {
            $extensao = strrchr($_FILES['foto']['name'], '.');
            $novoNome = md5($_FILES['foto']['name'].rand(1, 999)) . $extensao;
            $diretorio = "../upload/";
        
            if($extensao != '.jpg' && $extensao != '.jpeg' && $extensao != '.png') {
                echo('');
            }
            else {
                move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novoNome);
        
                $sqlCode = "INSERT INTO foto (nomeFoto, dataFoto, codAdm) VALUES('".$novoNome."', NOW(), ".$_SESSION['codUsuario'].")";
            if($conexao->query($sqlCode)) {
                $msg = "";
                
                $consulta = "SELECT nomeFoto FROM foto WHERE codAdm = ".$_SESSION['codUsuario'];
    
    $resultado = $conexao->query($consulta);
                
                $numresultado = mysqli_num_rows($resultado);
                if($numresultado > 0) {
                    while($linharesultado = mysqli_fetch_array($resultado)){
                        $img = $linharesultado['nomeFoto'];
                    }
                }
                else {
                    $img = 'user.png';
                }
            }
            else {
                $msg = "";
            }
        }
        
    }
?>
            
    <div class="loginbox">
    <form action="homeAdm.php" method="post" enctype="multipart/form-data">
        <?php  
            $consulta = "SELECT nomeFoto FROM foto WHERE codAdm = ".$_SESSION['codUsuario'];
    
    $resultado = $conexao->query($consulta);
                
                $numresultado = mysqli_num_rows($resultado);
                if($numresultado > 0) {
                    while($linharesultado = mysqli_fetch_array($resultado)){
                        $img = $linharesultado['nomeFoto'];
                    }
                }
     if(isset($img)) echo "<img src='../upload/".$img."' class='avatar'> <input type='file' required name='foto' style='opacity: 0; margin-top: 30%; cursor: pointer;'>";
                else echo "<img src='../upload/user.png' class='avatar'> <input type='file' required name='foto' style='opacity: 0; margin-top: 30%; cursor: pointer;'>";
        ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        <input type="submit" class="btn btn-terceiro" value="Mudar" style="margin-left: 30%; position: relative">
    </form>
    
            <h1><?php echo('ADM');?></h1>
            <div class="indicador"><p>Administrador(a)<p></div>
                <br>
        <ul>
            <!--<li><a href="#containerM" id="registerUser">Gerente</a></li>-->
            <!--<li>
            <li><a href="#"><i class="fas fa-user-friends"aria-hidden="true"></i> Notificações </a></li>
            <li><a href="#"></a></li>-->
        </ul>
            </div>
            
       <?php
        echo($_SESSION['cadastrou']);
        $_SESSION['cadastrando1'] = '';
        $_SESSION['cadastrando2'] = '';
        $_SESSION['cargo'] = 'Funcionario';
        include 'verificacao.php';
    ?>    
        
</div>
<div id="containerM" role="main">
			<div class="page-header">
				<h1>Gerentes Cadastrados</h1>
                <form action="cadastro.php">
                <button type="submit" class="btn btn-success" style="font-family:comfortaa; font-size: 17px;" data-dismiss="modal">+ Adicionar Gerente</button>
                
</form>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nome do Gerente</th>
                                <th>CPF do Gerente</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php while($rows_idoso = mysqli_fetch_assoc($resultado_idoso)){ ?>
								<tr>
									<td><?php echo $rows_idoso['codGerente']; ?></td>
									<td><?php echo $rows_idoso['nomeGerente']; ?></td>
                                    <td><?php echo $rows_idoso['cpfGerente']; ?></td>
									<td>
										<button type="button" class="btn btn-xs btn-primaryM" data-toggle="modal" data-target="#myModal<?php echo $rows_idoso['codGerente']; ?>">Visualizar</button>
										<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $rows_idoso['codGerente']; ?>" data-whatevernome="<?php echo $rows_idoso['nomeGerente']; ?>"data-whateversexo="<?php echo $rows_idoso['sexoGerente']; ?> "data-whatevercpf="<?php echo $rows_idoso['cpfGerente']; ?> "data-whatevernasc="<?php echo $rows_idoso['nascGerente']; ?> "data-whateveremail="<?php echo $rows_idoso['emailGerente']; ?>" >Editar</button>
                                        
                                        <form action="../Controller/apagarGerente.php" method="POST">
                                            <br>
										<button class="btn btn-xs btn-danger" type="submit"><input type="hidden" name="idGerente" value="<?php echo $rows_idoso['codGerente']; ?>">Apagar</button>
                                        </form>
                                        
									</td>
								</tr>
								<!-- Inicio Modal -->
								<div class="modal fade" id="myModal<?php echo $rows_idoso['codGerente']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title text-center" id="myModalLabel"><?php echo $rows_idoso['nomeGerente']; ?></h4>
											</div>
											<div class="modal-body">
                                                <p> <b>Código:</b>  <?php echo $rows_idoso['codGerente']; ?></p>
                                                <p> <b>Nome do Gerente:</b> <?php echo $rows_idoso['nomeGerente']; ?></p>
                                                <p> <b>Sexo do Gerente:</b> <?php echo $rows_idoso['sexoGerente']; ?></p>
                                                <p> <b>CPF do Gerente:</b> <?php echo $rows_idoso['cpfGerente']; ?></p>
                                                <p> <b>Data Gerente:</b> <?php echo $rows_idoso['nascGerente']; ?></p>
                                                <p> <b>E-mail do Gerente:</b> <?php echo $rows_idoso['emailGerente']; ?></p>
											</div>
										</div>
									</div>
								</div>
								<!-- Fim Modal -->
							<?php } ?>
						</tbody>
					 </table>
				</div>
			</div>		
		</div>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel"></h4>
			  </div>
			  <div class="modal-body">
				<form method="POST" action="../Controller/processaGerente.php" enctype="multipart/form-data">
				  <div class="form-group">
					<label for="recipient-name" class="control-label">Nome:</label>
					<input name="nomeGerente" type="text" class="form-control" id="recipient-name">
                      
                      <label for="recipient-sexo" class="control-label">Sexo:</label>
					<input name="sexoGerente" type="text" class="form-control" id="recipient-sexo">
                      
                      <label for="recipient-cpf" class="control-label" >CPF:</label>
					<input name="cpfGerente" type="text" class="form-control" id="recipient-cpf" onblur="TestaCPF(this.value);">
                      
                      <script type="text/javascript">$("#recipient-cpf").mask("999.999.999-99");</script>
                      
                      <label for="recipient-nasc" class="control-label">Data de Nascimento:</label>
					<input name="nascGerente" type="date" class="form-control" id="recipient-nasc" required value="<?php $sql = "SELECT nascGerente FROM tbGerente"; $resultado = mysqli_query($conn, $sql); while($rows = mysqli_fetch_assoc($resultado)){ echo($rows['nascGerente']); }?>">
                      
                      <label for="recipient-email" class="control-label">E-mail:</label>
					<input name="emailGerente" type="text" class="form-control" id="recipient-email">
                      
                    </div>
				<input name="codGerente" type="hidden" class="form-control" id="id-curso" value="">
				
				<button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-danger">Alterar</button>
			 
				</form>
			  </div>
			  
			</div>
		  </div>
		</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../cssModal/js/bootstrap.min.js"></script>
	<script type="text/javascript">
        
		$('#exampleModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 
		  var recipient = button.data('whatever') 
		  var recipientnome = button.data('whatevernome')
		  var recipientsexo = button.data('whateversexo')
          var recipientcpf = button.data('whatevercpf')
          var recipientnasc = button.data('whatevernasc')
          var recipientemail = button.data('whateveremail')
		  var modal = $(this)
		  modal.find('.modal-title').text(recipientnome)
		  modal.find('#id-curso').val(recipient)
		  modal.find('#recipient-name').val(recipientnome)
		  modal.find('#recipient-sexo').val(recipientsexo)
          modal.find('#recipient-cpf').val(recipientcpf)
          modal.find('#recipient-email').val(recipientemail)
            
            
		})
	</script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		        <script src="../js/jquery.dlmenu.js"></script>
		<script>
			$(function() {
				$( '#dl-menu' ).dlmenu({
					animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
				});
			});
		</script>
    </body>
    
    
    
</html>