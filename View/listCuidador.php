<?php
	include_once '../Dao/conexao.php';
	$result_idoso = "SELECT codFuncionario, nomeFuncionario, cpfFuncionario, sexoFuncionario, nascFuncionario, emailFuncionario, senhaFuncionario, ruaEnderecoFuncionario, bairroEnderecoFuncionario, cepEnderecoFuncionario, numCasaEnderecoFuncionario From tbfuncionario INNER JOIN tbEnderecoFuncionario ON tbfuncionario.codEnderecoFuncionario = tbEnderecoFuncionario.codEnderecoFuncionario";
$result_idoso = "Select*from tbfuncionario";
	$resultado_idoso = mysqli_query($conn, $result_idoso);
?>
<html>
    
    <head>
        <meta charset="utf-8"/>
        <title>InfoCare</title>
        <link href="../css/default.css" rel="stylesheet">
        <link href="../css/component.css" rel="stylesheet">
        <script src="../js/modernizr.custom.js"></script>
         <link href="../cssModal/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Ger.css">
        <link rel="icon" type="imagem/png" href="../img/infocare-logo.png"/>
        

    </head>
    
    <body>
        
        <div class="cabecalho">
           <a href="../View/homeGerente.php"> <h1 class="logo"></h1>
            </a>
             <div class="novomenu">
           <div id="dl-menu" class="dl-menuwrapper">
              <br><br>
						<button class="dl-trigger" style="background-color: transparent"></button>
						<ul class="dl-menu" style=" background-color: rgba(52,103,125,0.8);">
                            <li>
								<a href="../View/listarRes.php">Responsáveis</a>
                            </li>
                            <li>
								<a href="../View/listCuidador.php">Cuidadores</a>
                            </li>
                            
                             <li>
								<a href="../View/homeGerente.php">Pacientes</a>
                            </li>
                            
                            <li>
								<a href="../View/logout.php">Sair</a>
                            </li>
              </ul>
                 </div></div></div>
    <br><br><br><br>
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
        
                $sqlCode = "INSERT INTO foto(nomeFoto, dataFoto, codGerente) VALUES('".$novoNome."', NOW(), ".$_SESSION['codUsuario'].")";
            if($conexao->query($sqlCode)) {
                $msg = "";
                
                $consulta = "SELECT nomeFoto FROM foto WHERE codGerente = ".$_SESSION['codUsuario'];
    
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
    <form action="homeGerente.php" method="post" enctype="multipart/form-data">
        <?php  
            $consulta = "SELECT nomeFoto FROM foto WHERE codGerente = ".$_SESSION['codUsuario'];
    
    $resultado = $conexao->query($consulta);
                
                $numresultado = mysqli_num_rows($resultado);
                if($numresultado > 0) {
                    while($linharesultado = mysqli_fetch_array($resultado)){
                        $img = $linharesultado['nomeFoto'];
                    }
                }
    if(isset($img)) echo "<img src='../upload/".$img."' class='avatar'><input type='file' required name='foto' style='opacity: 0; margin-top: 30%; cursor: pointer;' >";
                else echo "<img src='../upload/user.png' class='avatar'>";
        ?>
       
        <br>
        <br>
        <br>
        <br>
    
       <input type="submit" class="btn btn-terceiro" value="Mudar" style="margin-left: 30%; position: relative">
    </form>
            <h1><?php echo($_SESSION['nomeSessao']);?></h1>
            <div class="indicador"><p>Gerente<p></div>
        <ul>
            <br>
             <hr style="height:2px; border:none; color:#C1C1C1; width: 220px; background-color:#fff; margin-top: 0px; margin-bottom: 0px;"/>
            <li><a href="atualizarGerente.php"><i class="fas fa-user" aria-hidden="true"></i>Perfil</a></li>
             <br> <br>
             <!--<hr style="height:2px; border:none; color:#C1C1C1; background-color:#fff; margin-top: 0px; margin-bottom: 0px;"/>
            <li><a href="listarRes.php" id="">Responsáveis</a></li>
            <li><a href="homeGerente.php" id="pacientes">Pacientes</a></li>
            <li><a href="" id="">Medicamentos</a></li>
            <li><a href="listCuidador.php" id="">Cuidadores</a></li>
            
            <!--<li><a href="#"><i class="fas fa-comment" aria-hidden="true"></i> Visualizar Prontuários</a></li>
            <li><a href="#"><i class="fas fa-user-friends"aria-hidden="true"></i> Notificações </a></li>
            <li><a href="#"></a></li>-->
        </ul>
            </div>
            
       <?php
        echo($_SESSION['cadastrou']);
        $_SESSION['cadastrando1'] = '';
        $_SESSION['cadastrando2'] = '';
        $_SESSION['cargo'] = 'Gerente';
        include 'verificacao.php';
    ?>    
        
</div>
        
        
        <div id="containerM" role="main">
			<div class="page-header" style="margin-top: -5%;">
				<h1>Cuidadores Cadastrados</h1>
                <form action="cadastroCuidador.php">
                <button type="submit" class="btn btn-success" style="font-family:comfortaa; font-size: 17px;" data-dismiss="modal">+ Adicionar Cuidador</button>  
                </form>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nome do Cuidador</th>
                                <th>CPF do Cuidador</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php while($rows_idoso = mysqli_fetch_assoc($resultado_idoso)){ ?>
								<tr>
									<td><?php echo $rows_idoso['codFuncionario']; ?></td>
									<td><?php echo $rows_idoso['nomeFuncionario']; ?></td>
                                    <td><?php echo $rows_idoso['cpfFuncionario']; ?></td>
									<td>
										<button type="button" class="btn btn-xs btn-primaryM" data-toggle="modal" data-target="#myModal<?php echo $rows_idoso['codFuncionario']; ?>">Visualizar</button>
                                        
										<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $rows_idoso['codFuncionario']; ?>" data-whatevernome="<?php echo $rows_idoso['nomeFuncionario']; ?>"data-whateversexo="<?php echo $rows_idoso['sexoFuncionario']; ?> "data-whatevercpf="<?php echo $rows_idoso['cpfFuncionario']; ?> "data-whatevernasc="<?php echo $rows_idoso['nascFuncionario']; ?> "data-whateveremail="<?php echo $rows_idoso['emailFuncionario']; ?>"
                                        rua-whatever="<?php echo $rows_idoso['ruaEnderecoFuncionario']; ?>"   
                                                >Editar</button>
                                        
                                        <form action="../Controller/apagarCuidador.php" method="POST">

										<button class="btn btn-xs btn-danger" type="submit"><input type="hidden" name="idFuncionario" value="<?php echo $rows_idoso['codFuncionario']; ?>">Apagar</button>
                                        </form>
									</td>
								</tr>
								<!-- Inicio Modal -->
								<div class="modal fade" id="myModal<?php echo $rows_idoso['codFuncionario']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title text-center" id="myModalLabel"><?php echo $rows_idoso['nomeFuncionario']; ?></h4>
											</div>
											<div class="modal-body">
												<p> Código:  <?php echo $rows_idoso['codFuncionario']; ?></p>
												<p> Nome do Cuidador: <?php echo $rows_idoso['nomeFuncionario']; ?></p>
												<p>Sexo do Cuidador: <?php echo $rows_idoso['sexoFuncionario']; ?></p>
                                                <p>CPF do Cuidador: <?php echo $rows_idoso['cpfFuncionario']; ?></p>
                                                <p>Data Nascimento: <?php echo $rows_idoso['nascFuncionario']; ?></p>
                                                <p>E-mail do Cuidador: <?php echo $rows_idoso['emailFuncionario']; ?></p>
                                                 
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
				<form method="POST" action="../Controller/processaCuidador.php" enctype="multipart/form-data">
				  <div class="form-group">
					<label for="recipient-name" class="control-label">Nome:</label>
					<input name="nomeFuncionario" type="text" class="form-control" id="recipient-name">
                      
                      <label for="recipient-sexo" class="control-label">Sexo:</label>
					<input name="sexoFuncionario" type="text" class="form-control" id="recipient-sexo">
                      
                      <label for="recipient-cpf" class="control-label">CPF:</label>
					<input name="cpfFuncionario" type="text" class="form-control" id="recipient-cpf">
                      
                      <label for="recipient-nasc" class="control-label">Data de Nascimento:</label>
					<input name="nascFuncionario" type="text" class="form-control" id="recipient-nasc">
                      
                      <label for="recipient-email" class="control-label">E-mail:</label>
					<input name="emailFuncionario" type="text" class="form-control" id="recipient-email">
                      
                    </div>
				<input name="codFuncionario" type="hidden" class="form-control" id="id-curso" value="">
				
				<button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-dangerr">Alterar</button>
			 
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
          modal.find('#recipient-nasc').val(recipientnasc)
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