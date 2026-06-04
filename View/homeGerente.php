<?php
	include_once '../Dao/conexao.php';
	$result_idoso = "SELECT codIdoso, nomeIdoso, sexoIdoso, cpfIdoso, nascIdoso, nomeResponsavel, declinioCongnitivo, dificuldadeFala, audicao, acidenteVascularEncefalico, traumatismoCranioEncefalico, hipertensaoArterial, hipotireoidismo, tipoDiabetes, tipoCancer, localFratura, tipoCirurgia, outrasPatologias, usoMedicamento, tratamentoRealizado, peso, altura, pressaoArterial, pulsacao, respiracao, temperatura, dextro, spo2, utilizacaoOculos, proteseAuditiva, carteiraVacinacao, tabagista, etilista, dependenciaEtilismo, tipoSanguineo, usoProteseDentaria, marcaProteseDentaria, modeloProtoseDentaria, usoMedicamentoContinuo, usoSubstanciaPsicoativa, alergiaMedicamento, convenio, encaminhamentoUnidadeHospitalar, atividadeManual, integridadePele, hidratacaoPele, dermatite, prurido, micoseUnha, escamacaoPele, ictericiaPele, feridaPele, petequiaPele, hematomaPele, ulceraPele, ascultacao, tipoTosse, tipoDispineia, grauUlcera, outraEspecificacao, alimentacaoSolo, dificuldadeDegluticao, usoSonda, restricaoAlimento, preferenciaAlimento, locomocaoSolo, cadeirante, tempoCadeirante, acamacao, tempoAcamacao, apoioFisico, esporteTerapia, statusComunicacao, agressividade, temperamento, anterioridadeCasaRepouso, irritabilidade, conclusaoHemograma, tipoUrina, parasitologicoFezes, glicemiaJejum, colesterol, tipoHepatite, hiv, vdrl, atestadoNeurologico, raioxPulmao, receituarioMedico, frequenciaEvacuacao, aspecto, coloracaoUrina, odorUrina, frequenciaUrina, queixaGases, usoFraldaGeriatrica, marcaFraldaGeriatrica From tbIdoso
    INNER JOIN tbResponsavel
    ON tbIdoso.codResponsavel = tbResponsavel.codResponsavel
    INNER JOIN tbProntuarioFixo
    ON tbIdoso.codProntuarioFixo = tbProntuarioFixo.codProntuarioFixo
    INNER JOIN tbAntecedencia
    ON tbProntuarioFixo.codAntecedencia = tbAntecedencia.codAntecedencia
    INNER JOIN tbQuestionamento
    ON tbProntuarioFixo.codQuestionamento = tbQuestionamento.codQuestionamento
    INNER JOIN tbPele
    ON tbProntuarioFixo.codPele = tbPele.codPele
    INNER JOIN tbPulmonar
    ON tbProntuarioFixo.codPulmonar = tbPulmonar.codPulmonar
    INNER JOIN tbAlimentacao
    ON tbProntuarioFixo.codAlimentacao = tbAlimentacao.codAlimentacao
    INNER JOIN tbLocomocao
    ON tbProntuarioFixo.codLocomocao = tbLocomocao.codLocomocao
    INNER JOIN tbRelacionamento
    ON tbProntuarioFixo.codRelacionamento = tbRelacionamento.codRelacionamento
    INNER JOIN tbExame
    ON tbProntuarioFixo.codExame = tbExame.codExame
    INNER JOIN tbEliminacao
    ON tbProntuarioFixo.codEliminacao = tbEliminacao.codEliminacao";
	$resultado_idoso = mysqli_query($conn, $result_idoso);
?>
<html>
    
    <head>
        <meta charset="utf-8"/>
        <title>InfoCare</title>
        <link href="../css/default.css" rel="stylesheet">
         <link href="../css/component.css" rel="stylesheet">
         <link href="../cssModal/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Ger.css">
        <link rel="icon" type="imagem/png" href="../img/infocare-logo.png"/>

        <script src="../js/modernizr.custom.js"></script>
       

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
                 </div>
            </div>
        </div>
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
    if(isset($img)) echo "<img src='../upload/".$img."' class='avatar'><input type='file' required name='foto' style='opacity: 0; margin-top: 30%; cursor: pointer;'>";
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
        
            <!--<li><a href="listarRes.php" id="">Responsáveis</a></li>
            <li><a href="#containerM" id="pacientes">Pacientes</a></li>
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
        $_SESSION['direto'] = 0;
        include 'verificacao.php';
    ?>    
        
</div>
        
        
        <div id="containerM" role="main">
			<div class="page-header" style="margin-top: -5%;">
				<h1>Pacientes Cadastrados</h1>
                <form action="cadastroIdosoTab.php">
                <button type="submit" class="btn btn-success" style="font-family:comfortaa; font-size: 17px;" data-dismiss="modal">+ Adicionar Idoso</button>  
                </form>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nome do Paciente</th>
                                <th>CPF do Paciente</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php while($rows_idoso = mysqli_fetch_assoc($resultado_idoso)){ ?>
								<tr>
									<td><?php echo $rows_idoso['codIdoso']; ?></td>
									<td><?php echo $rows_idoso['nomeIdoso']; ?></td>
                                    <td><?php echo $rows_idoso['cpfIdoso']; ?></td>
									<td>
										<button type="button" class="btn btn-xs btn-primaryM" data-toggle="modal" data-target="#myModal<?php echo $rows_idoso['codIdoso']; ?>">Visualizar</button>
                                        
                                        <form action="../pdf/index.php" method="POST">
										<button class="btn btn-xs btn-primaryM" type="submit"><input type="hidden" name="idIdoso" value="<?php echo $rows_idoso['codIdoso']; ?>">Visualizar</button>
                                        </form>
                                        
										<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $rows_idoso['codIdoso']; ?>" data-whatevernome="<?php echo $rows_idoso['nomeIdoso']; ?>"data-whateverdetalhes="<?php echo $rows_idoso['sexoIdoso']; ?>">Editar</button>
                                        
                                        <form action="../Controller/apagarIdoso.php" method="POST">
										<button class="btn btn-xs btn-danger" type="submit"><input type="hidden" name="idIdoso" value="<?php echo $rows_idoso['codIdoso']; ?>">Apagar</button>
                                        </form>
									</td>
								</tr>
								<!-- Inicio Modal -->
								<div class="modal fade" id="myModal<?php echo $rows_idoso['codIdoso']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title text-center" id="myModalLabel"><?php echo $rows_idoso['nomeIdoso']; ?></h4>
											</div>
											<div class="modal-body">
                                                <p><b>Código:</b> <?php echo $rows_idoso['codIdoso']; ?></p>
                                                <p><b>Nome:</b> <?php echo $rows_idoso['nomeIdoso']; ?></p>
                                                <p><b>Sexo:</b> <?php echo $rows_idoso['sexoIdoso']; ?></p>
                                                <p><b>Nascimento:</b> <?php $nasc = date_create($rows_idoso['nascIdoso']); echo date_format($nasc, 'd-m-Y'); ?></p>
                                                <p><b>Nome do responsável:</b> <?php echo $rows_idoso['nomeResponsavel']; ?></p>
                                                <br>
                                                <p><b>ANTECEDÊNCIA</b> </p>
                                                
                                                <p><b>declinioCongnitivo:</b> <?php echo $rows_idoso['declinioCongnitivo']; ?>;</p>
                                                <p><b>dificuldadeFala:</b> <?php echo $rows_idoso['dificuldadeFala']; ?>;</p>
                                                <p><b>audicao:</b> <?php echo $rows_idoso['audicao']; ?>;</p>
                                                <p><b>acidenteVascularEncefalico:</b> <?php echo $rows_idoso['acidenteVascularEncefalico']; ?>;</p>
                                                <p><b>traumatismoCranioEncefalico:</b> <?php echo $rows_idoso['traumatismoCranioEncefalico']; ?>;</p>
                                                <p><b>hipertensaoArterial:</b> <?php echo $rows_idoso['hipertensaoArterial']; ?>;</p>
                                                <p><b>hipotireoidismo:</b> <?php echo $rows_idoso['hipotireoidismo']; ?>;</p>
                                                <p><b>tipoDiabetes:</b> <?php echo $rows_idoso['tipoDiabetes']; ?>;</p>
                                                <p><b>tipoCancer:</b> <?php echo $rows_idoso['tipoCancer']; ?>;</p>
                                                <p><b>localFratura:</b> <?php echo $rows_idoso['localFratura']; ?>;</p>
                                                <p><b>tipoCirurgia:</b> <?php echo $rows_idoso['tipoCirurgia']; ?>;</p>
                                                <p><b>outrasPatologias:</b> <?php echo $rows_idoso['outrasPatologias']; ?>;</p>
                                                <p><b>usoMedicamento:</b> <?php echo $rows_idoso['usoMedicamento']; ?>;</p>
                                                <p><b>tratamentoRealizado:</b> <?php echo $rows_idoso['tratamentoRealizado']; ?>.</p>
                                                <br>
                                                <p><b>QUESTIONAMENTO</b></p>
                                                <p><b>peso:</b> <?php echo $rows_idoso['peso']; ?>;</p>
                                                <p><b>altura:</b> <?php echo $rows_idoso['altura']; ?>;</p>
                                                <p><b>pressaoArterial:</b> <?php echo $rows_idoso['pressaoArterial']; ?>;</p> 
                                                <p><b>pulsacao:</b> <?php echo $rows_idoso['pulsacao']; ?>;</p>
                                                <p><b>respiracao:</b> <?php echo $rows_idoso['respiracao']; ?>;</p>
                                                <p><b>temperatura:</b> <?php echo $rows_idoso['temperatura']; ?>;</p>
                                                <p><b>dextro:</b> <?php echo $rows_idoso['dextro']; ?>;</p>
                                                <p><b>spo2:</b> <?php echo $rows_idoso['spo2']; ?>;</p>
                                                <p><b>utilizacaoOculos:</b> <?php echo $rows_idoso['utilizacaoOculos']; ?>;</p>
                                                <p><b>proteseAuditiva:</b> <?php echo $rows_idoso['proteseAuditiva']; ?>;</p>
                                                <p><b>carteiraVacinacao:</b> <?php echo $rows_idoso['carteiraVacinacao']; ?>;</p>
                                                <p><b>tabagista:</b> <?php echo $rows_idoso['tabagista']; ?>;</p>
                                                <p><b>etilista:</b> <?php echo $rows_idoso['etilista']; ?>;</p>
                                                <p><b>dependenciaEtilismo:</b> <?php echo $rows_idoso['dependenciaEtilismo']; ?>;</p>
                                                <p><b>tipoSanguineo:</b> <?php echo $rows_idoso['tipoSanguineo']; ?>;</p>
                                                <p><b>usoProteseDentaria:</b> <?php echo $rows_idoso['usoProteseDentaria']; ?>;</p>
                                                <p><b>marcaProteseDentaria:</b> <?php echo $rows_idoso['marcaProteseDentaria']; ?>;</p>
                                                <p><b>modeloProtoseDentaria:</b> <?php echo $rows_idoso['modeloProtoseDentaria']; ?>;</p>
                                                <p><b>usoMedicamentoContinuo:</b> <?php echo $rows_idoso['usoMedicamentoContinuo']; ?>;</p>
                                                <p><b>usoSubstanciaPsicoativa:</b> <?php echo $rows_idoso['usoSubstanciaPsicoativa']; ?>;</p>
                                                <p><b>alergiaMedicamento:</b> <?php echo $rows_idoso['alergiaMedicamento']; ?>;</p>
                                                <p><b>convenio:</b> <?php echo $rows_idoso['convenio']; ?>;</p>
                                                <p><b>encaminhamentoUnidadeHospitalar:</b> <?php echo $rows_idoso['encaminhamentoUnidadeHospitalar']; ?>;</p>
                                                <p><b>atividadeManual:</b> <?php echo $rows_idoso['atividadeManual']; ?>.</p>
                                                <br>
                                                <p><b>PELE</b> </p>
                                                <p><b>integridadePele:</b> <?php echo $rows_idoso['integridadePele']; ?>;</p>
                                                <p><b>hidratacaoPele:</b> <?php echo $rows_idoso['hidratacaoPele']; ?>;</p>
                                                <p><b>dermatite:</b> <?php echo $rows_idoso['dermatite']; ?>;</p>
                                                <p><b>prurido:</b> <?php echo $rows_idoso['prurido']; ?>;</p>
                                                <p><b>micoseUnha:</b> <?php echo $rows_idoso['micoseUnha']; ?>;</p>
                                                <p><b>escamacaoPele:</b> <?php echo $rows_idoso['escamacaoPele']; ?>;</p>
                                                <p><b>ictericiaPele:</b> <?php echo $rows_idoso['ictericiaPele']; ?>;</p>
                                                <p><b>feridaPele:</b> <?php echo $rows_idoso['feridaPele']; ?>;</p>
                                                <p><b>petequiaPele:</b> <?php echo $rows_idoso['petequiaPele']; ?>;</p>
                                                <p><b>hematomaPele:</b> <?php echo $rows_idoso['hematomaPele']; ?>;</p>
                                                <p><b>ulceraPele:</b> <?php echo $rows_idoso['ulceraPele']; ?>;</p>
                                                <p><b>grauUlcera:</b> <?php echo $rows_idoso['grauUlcera']; ?>;</p>
                                                <p><b>outraEspecificacao:</b> <?php echo $rows_idoso['outraEspecificacao']; ?>.</p>
                                                <br>
                                                <p><b>PULMONAR</b> </p>
                                                <p><b>ascultacao:</b> <?php echo $rows_idoso['ascultacao']; ?>;</p>
                                                <p><b>tipoTosse:</b> <?php echo $rows_idoso['tipoTosse']; ?>;</p>
                                                <p><b>tipoDispineia:</b> <?php echo $rows_idoso['tipoDispineia']; ?>.</p>
                                                <br>
                                                <p><b>ALIMENTAÇÃO</b></p>
                                                <p><b>alimentacaoSolo:</b> <?php echo $rows_idoso['alimentacaoSolo']; ?>;</p>
                                                <p><b>dificuldadeDegluticao:</b> <?php echo $rows_idoso['dificuldadeDegluticao']; ?>;</p>
                                                <p><b>usoSonda:</b> <?php echo $rows_idoso['usoSonda']; ?>;</p>
                                                <p><b>restricaoAlimento:</b> <?php echo $rows_idoso['restricaoAlimento']; ?>;</p>
                                                <p><b>preferenciaAlimento:</b> <?php echo $rows_idoso['preferenciaAlimento']; ?>.</p>
                                                <br>
                                                <p><b>LOCOMOÇÃO</b> </p>
                                                <p><b>locomocaoSolo:</b> <?php echo $rows_idoso['locomocaoSolo']; ?>;</p>
                                                <p><b>cadeirante:</b> <?php echo $rows_idoso['cadeirante']; ?>;</p>
                                                <p><b>tempoCadeirante:</b> <?php echo $rows_idoso['tempoCadeirante']; ?>;</p>
                                                <p><b>acamacao:</b> <?php echo $rows_idoso['acamacao']; ?>;</p>
                                                <p><b>tempoAcamacao:</b> <?php echo $rows_idoso['tempoAcamacao']; ?>;</p>
                                                <p><b>apoioFisico:</b> <?php echo $rows_idoso['apoioFisico']; ?>;</p>
                                                <p><b>esporteTerapia:</b> <?php echo $rows_idoso['esporteTerapia']; ?>.</p>
                                                <br>
                                                <p><b>RELACIONAMENTO</b> </p>
                                                <p><b>statusComunicacao:</b> <?php echo $rows_idoso['statusComunicacao']; ?>;</p>
                                                <p><b>agressividade:</b> <?php echo $rows_idoso['agressividade']; ?>;</p>
                                                <p><b>temperamento:</b> <?php echo $rows_idoso['temperamento']; ?>;</p>
                                                <p><b>anterioridadeCasaRepouso:</b> <?php echo $rows_idoso['anterioridadeCasaRepouso']; ?>;</p>
                                                <p><b>irritabilidade:</b> <?php echo $rows_idoso['irritabilidade']; ?>.</p>
                                                <br>
                                                <p><b>EXAME</b> </p>
                                                <p><b>conclusaoHemograma:</b><?php echo $rows_idoso['conclusaoHemograma']; ?>;</p>
                                                <p><b>tipoUrina:</b> <?php echo $rows_idoso['tipoUrina']; ?>;<p>
                                                <p><b>parasitologicoFezes:</b> <?php echo $rows_idoso['parasitologicoFezes']; ?>;</p>
                                                <p><b>glicemiaJejum:</b> <?php echo $rows_idoso['glicemiaJejum']; ?>;</p>
                                                <p><b>colesterol:</b> <?php echo $rows_idoso['colesterol']; ?>;</p>
                                                <p><b>tipoHepatite:</b> <?php echo $rows_idoso['tipoHepatite']; ?>;</p>
                                                <p><b>hiv:</b> <?php echo $rows_idoso['hiv']; ?>;</p>
                                                <p><b>vdrl:</b> <?php echo $rows_idoso['vdrl']; ?>;</p>
                                                <p><b>atestadoNeurologico:</b> <?php echo $rows_idoso['atestadoNeurologico']; ?>;</p>
                                                <p><b>raioxPulmao:</b> <?php echo $rows_idoso['raioxPulmao']; ?>;</p>
                                                <p><b>receituarioMedico:</b> <?php echo $rows_idoso['receituarioMedico']; ?>.</p>
                                                <br>
                                                <p><b>ELIMINAÇÃO</b></p>
                                                <p><b>frequenciaEvacuacao:</b> <?php echo $rows_idoso['frequenciaEvacuacao']; ?>;</p>
                                                <p><b>aspecto:</b> <?php echo $rows_idoso['aspecto']; ?>;</p>
                                                <p><b>coloracaoUrina:</b> <?php echo $rows_idoso['coloracaoUrina']; ?>;</p>
                                                <p><b>odorUrina:</b> <?php echo $rows_idoso['odorUrina']; ?>;</p>
                                                <p><b>frequenciaUrina:</b> <?php echo $rows_idoso['frequenciaUrina']; ?>;</p>
                                                <p><b>queixaGases:</b> <?php echo $rows_idoso['queixaGases']; ?>;</p>
                                                <p><b>usoFraldaGeriatrica:</b> <?php echo $rows_idoso['usoFraldaGeriatrica']; ?>;</p>
                                                <p><b>marcaFraldaGeriatrica:</b> <?php echo $rows_idoso['marcaFraldaGeriatrica']; ?>.</p>
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
				<h4 class="modal-title" id="exampleModalLabel">Curso</h4>
			  </div>
			  <div class="modal-body">
				<form method="POST" action="../Controller/processa.php" enctype="multipart/form-data">
				  <div class="form-group">
					<label for="recipient-name" class="control-label">Nome:</label>
					<input name="nomeIdoso" type="text" class="form-control" id="recipient-name">
				  </div>
				  <div class="form-group">
					<label for="message-text" class="control-label">Detalhes:</label>
					<textarea name="sexoIdoso" class="form-control" id="detalhes"></textarea>
				  </div>
				<input name="codIdoso" type="hidden" class="form-control" id="id-curso" value="">
				
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
		  var recipientdetalhes = button.data('whateverdetalhes')
		  var modal = $(this)
		  modal.find('.modal-title').text('ID ' + recipient)
		  modal.find('#id-curso').val(recipient)
		  modal.find('#recipient-name').val(recipientnome)
		  modal.find('#detalhes').val(recipientdetalhes)
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