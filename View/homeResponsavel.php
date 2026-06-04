<?php
	include_once '../Dao/conexao.php';
	
?>
<html>
    
    <head>
        <title>InfoCare</title>
         <link href="../css/default.css" rel="stylesheet">
         <link href="../css/component.css" rel="stylesheet">
         <link href="../cssModal/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/Res.css">
        <link rel="icon" type="imagem/png" href="../img/infocare-logo.png"/>
         <script src="../js/modernizr.custom.js"></script>
        <link href="../css/component.css" rel="stylesheet">
    </head>
    
    <body>
        <header class="cabecalho">
           <a href="../View/homeResponsavel.php"> <h1 class="logo"></h1>
            </a>
             <div class="novomenu">
          <div id="dl-menu" class="dl-menuwrapper">
              <br><br>
						<button class="dl-trigger" style="background-color: transparent"></button>
						<ul class="dl-menu" style=" background-color: rgba(52,103,125,0.8);">
                            <li>
								<a href="../View/homeResponsavel.php">Familiar</a>
                            </li>
                            <li>
								<a href="../View/logout.php">Sair</a>
                            </li>
              </ul>
                 </div>
            </div>
        
        </header>
        <div class="lixo">
            
            <?php 
            session_start();
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
    ON tbProntuarioFixo.codEliminacao = tbEliminacao.codEliminacao WHERE tbResponsavel.codResponsavel =".$_SESSION['codUsuario'];
    //echo($result_idoso);
	$resultado_idoso = mysqli_query($conn, $result_idoso);
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
        
                $sqlCode = "INSERT INTO foto (nomeFoto, dataFoto, codResponsavel) VALUES('".$novoNome."', NOW(), ".$_SESSION['codUsuario'].")";
            if($conexao->query($sqlCode)) {
                $msg = "";
                
                $consulta = "SELECT nomeFoto FROM foto WHERE codResponsavel = ".$_SESSION['codUsuario'];
    
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
    <form action="homeResponsavel.php" method="post" enctype="multipart/form-data">
        <?php  
            $consulta = "SELECT nomeFoto FROM foto WHERE codResponsavel = ".$_SESSION['codUsuario'];
    
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
                
            
            <h1><?php echo($_SESSION['nomeSessao']);?></h1>
                <div class="indicador"><p>Responsável<p></div>
                <br>
        <ul>
            <hr style="height:2px; border:none; width: 220px; color:#C1C1C1; background-color:#fff; margin-top: 0px; margin-bottom: 0px;"/>
            <li><a href="atualizarResponsavel.php"><i class="fas fa-user"  aria-hidden="true"></i>Perfil</a></li>
            <br> <br>
           <!--<li><a href="visualizarProntuario.php"><i class="fas fa-comment" aria-hidden="true"></i>Visualizar Prontuários</a></li>
            <br> <br> <br> <br>
            <hr style="height:2px; border:none; color:#C1C1C1; background-color:#fff; margin-top: 0px; margin-bottom: 0px;"/>
            
            <li><a href="#"><i class="fas fa-user-friends"aria-hidden="true"></i> Notificações </a></li>
            <li><a href="#"></a></li>-->
        </ul>
            </div>
        
            
       <?php
        echo($_SESSION['cadastrou']);
        $_SESSION['cadastrando1'] = '';
        $_SESSION['cadastrando2'] = '';
        $_SESSION['cargo'] = 'Responsavel';
        $_SESSION['cpfUsuario'];
        include 'verificacao.php';
    ?>    
        
</div>
        
        <div id="containerM" role="main">
			<div class="page-header">
				<h1>Familiares na Clinica</h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nome do Familiar</th>
                                <th>CPF do Familiar</th>
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
										<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $rows_idoso['codIdoso']; ?>" data-whatevernome="<?php echo $rows_idoso['nomeIdoso']; ?>"data-whateverdetalhes="<?php echo $rows_idoso['sexoIdoso']; ?>">Editar</button>
                                        
                                        <form action="../Controller/apagarIdoso.php" method="POST">
										<button class="btn btn-xs btn-danger" type="submit"><input type="hidden" name="idIdoso" value="<?php echo $rows_idoso['codIdoso']; ?>">Apagar</button>
                                        </form>
                                        
                                            <button class="btn btn-xs btn-suc" style="margin-top: -14%; margin-left: 22%; color: white !important;" type="submit"><a href="visualizarProntuario.php">Prontuário</a></button>
                                        
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
												<p>Código: <?php echo $rows_idoso['codIdoso']; ?></p>
												<p>Nome: <?php echo $rows_idoso['nomeIdoso']; ?></p>
												<p>Sexo: <?php echo $rows_idoso['sexoIdoso']; ?></p>
                                                <p>Nascimento: <?php $nasc = date_create($rows_idoso['nascIdoso']); echo date_format($nasc, 'd-m-Y'); ?></p>
                                                <p>Nome do responsável: <?php echo $rows_idoso['nomeResponsavel']; ?></p>
                                                <br>
                                                <p>Antecedência: </p>
                                                <p>declinioCongnitivo: <?php echo $rows_idoso['declinioCongnitivo']; ?>; dificuldadeFala: <?php echo $rows_idoso['dificuldadeFala']; ?>;
                                                audicao: <?php echo $rows_idoso['audicao']; ?>;
                                                acidenteVascularEncefalico: <?php echo $rows_idoso['acidenteVascularEncefalico']; ?>;
                                                traumatismoCranioEncefalico: <?php echo $rows_idoso['traumatismoCranioEncefalico']; ?>;
                                                hipertensaoArterial: <?php echo $rows_idoso['hipertensaoArterial']; ?>;
                                                hipotireoidismo: <?php echo $rows_idoso['hipotireoidismo']; ?>;
                                                tipoDiabetes: <?php echo $rows_idoso['tipoDiabetes']; ?>;
                                                tipoCancer: <?php echo $rows_idoso['tipoCancer']; ?>;
                                                localFratura: <?php echo $rows_idoso['localFratura']; ?>;
                                                tipoCirurgia: <?php echo $rows_idoso['tipoCirurgia']; ?>;
                                                outrasPatologias: <?php echo $rows_idoso['outrasPatologias']; ?>;
                                                usoMedicamento: <?php echo $rows_idoso['usoMedicamento']; ?>;
                                                tratamentoRealizado: <?php echo $rows_idoso['tratamentoRealizado']; ?>.</p>
                                                <p>Questionamento: </p>
                                                <p>peso: <?php echo $rows_idoso['peso']; ?>;
                                                altura: <?php echo $rows_idoso['altura']; ?>;
                                                pressaoArterial: <?php echo $rows_idoso['pressaoArterial']; ?>; 
                                                pulsacao: <?php echo $rows_idoso['pulsacao']; ?>;
                                                respiracao: <?php echo $rows_idoso['respiracao']; ?>;
                                                temperatura: <?php echo $rows_idoso['temperatura']; ?>;
                                                dextro: <?php echo $rows_idoso['dextro']; ?>;
                                                spo2: <?php echo $rows_idoso['spo2']; ?>;
                                                utilizacaoOculos: <?php echo $rows_idoso['utilizacaoOculos']; ?>;
                                                proteseAuditiva: <?php echo $rows_idoso['proteseAuditiva']; ?>;
                                                carteiraVacinacao: <?php echo $rows_idoso['carteiraVacinacao']; ?>;
                                                tabagista: <?php echo $rows_idoso['tabagista']; ?>;
                                                etilista: <?php echo $rows_idoso['etilista']; ?>;
                                                dependenciaEtilismo: <?php echo $rows_idoso['dependenciaEtilismo']; ?>;
                                                tipoSanguineo: <?php echo $rows_idoso['tipoSanguineo']; ?>;
                                                usoProteseDentaria: <?php echo $rows_idoso['usoProteseDentaria']; ?>;
                                                marcaProteseDentaria: <?php echo $rows_idoso['marcaProteseDentaria']; ?>;
                                                modeloProtoseDentaria: <?php echo $rows_idoso['modeloProtoseDentaria']; ?>;
                                                usoMedicamentoContinuo: <?php echo $rows_idoso['usoMedicamentoContinuo']; ?>;
                                                usoSubstanciaPsicoativa: <?php echo $rows_idoso['usoSubstanciaPsicoativa']; ?>;
                                                alergiaMedicamento: <?php echo $rows_idoso['alergiaMedicamento']; ?>;
                                                convenio: <?php echo $rows_idoso['convenio']; ?>;
                                                encaminhamentoUnidadeHospitalar: <?php echo $rows_idoso['encaminhamentoUnidadeHospitalar']; ?>;
                                                atividadeManual: <?php echo $rows_idoso['atividadeManual']; ?>.</p>
                                                <p>Pele: </p>
                                                <p>integridadePele: <?php echo $rows_idoso['integridadePele']; ?>;
                                                hidratacaoPele: <?php echo $rows_idoso['hidratacaoPele']; ?>;
                                                dermatite: <?php echo $rows_idoso['dermatite']; ?>;
                                                prurido: <?php echo $rows_idoso['prurido']; ?>;
                                                micoseUnha: <?php echo $rows_idoso['micoseUnha']; ?>;
                                                escamacaoPele: <?php echo $rows_idoso['escamacaoPele']; ?>;
                                                ictericiaPele: <?php echo $rows_idoso['ictericiaPele']; ?>;
                                                feridaPele: <?php echo $rows_idoso['feridaPele']; ?>;
                                                petequiaPele: <?php echo $rows_idoso['petequiaPele']; ?>;
                                                hematomaPele: <?php echo $rows_idoso['hematomaPele']; ?>;
                                                ulceraPele: <?php echo $rows_idoso['ulceraPele']; ?>;
                                                grauUlcera: <?php echo $rows_idoso['grauUlcera']; ?>;
                                                outraEspecificacao: <?php echo $rows_idoso['outraEspecificacao']; ?>.</p>
                                                <p>Pulmonar: </p>
                                                <p>ascultacao: <?php echo $rows_idoso['ascultacao']; ?>;
                                                tipoTosse: <?php echo $rows_idoso['tipoTosse']; ?>;
                                                tipoDispineia: <?php echo $rows_idoso['tipoDispineia']; ?>.</p>
                                                <p>Alimentação: </p>
                                                <p>alimentacaoSolo: <?php echo $rows_idoso['alimentacaoSolo']; ?>;
                                                dificuldadeDegluticao: <?php echo $rows_idoso['dificuldadeDegluticao']; ?>;
                                                usoSonda: <?php echo $rows_idoso['usoSonda']; ?>;
                                                restricaoAlimento: <?php echo $rows_idoso['restricaoAlimento']; ?>;
                                                preferenciaAlimento: <?php echo $rows_idoso['preferenciaAlimento']; ?>.</p>
                                                <p>Locomoção: </p>
                                                <p>locomocaoSolo: <?php echo $rows_idoso['locomocaoSolo']; ?>;
                                                cadeirante: <?php echo $rows_idoso['cadeirante']; ?>;
                                                tempoCadeirante: <?php echo $rows_idoso['tempoCadeirante']; ?>;
                                                acamacao: <?php echo $rows_idoso['acamacao']; ?>;
                                                tempoAcamacao: <?php echo $rows_idoso['tempoAcamacao']; ?>;
                                                apoioFisico: <?php echo $rows_idoso['apoioFisico']; ?>;
                                                esporteTerapia: <?php echo $rows_idoso['esporteTerapia']; ?>.</p>
                                                <p>Relacionamento: </p>
                                                <p>statusComunicacao: <?php echo $rows_idoso['statusComunicacao']; ?>;
                                                agressividade: <?php echo $rows_idoso['agressividade']; ?>;
                                                temperamento: <?php echo $rows_idoso['temperamento']; ?>;
                                                anterioridadeCasaRepouso: <?php echo $rows_idoso['anterioridadeCasaRepouso']; ?>;
                                                irritabilidade: <?php echo $rows_idoso['irritabilidade']; ?>.</p>
                                                <p>Exame: </p>
                                                <p>conclusaoHemograma: <?php echo $rows_idoso['conclusaoHemograma']; ?>;
                                                tipoUrina: <?php echo $rows_idoso['tipoUrina']; ?>;
                                                parasitologicoFezes: <?php echo $rows_idoso['parasitologicoFezes']; ?>;
                                                glicemiaJejum: <?php echo $rows_idoso['glicemiaJejum']; ?>;
                                                colesterol: <?php echo $rows_idoso['colesterol']; ?>;
                                                tipoHepatite: <?php echo $rows_idoso['tipoHepatite']; ?>;
                                                hiv: <?php echo $rows_idoso['hiv']; ?>;
                                                vdrl: <?php echo $rows_idoso['vdrl']; ?>;
                                                atestadoNeurologico: <?php echo $rows_idoso['atestadoNeurologico']; ?>;
                                                raioxPulmao: <?php echo $rows_idoso['raioxPulmao']; ?>;
                                                receituarioMedico: <?php echo $rows_idoso['receituarioMedico']; ?>.</p>
                                                <p>Eliminação: </p>
                                                <p>frequenciaEvacuacao: <?php echo $rows_idoso['frequenciaEvacuacao']; ?>;
                                                aspecto: <?php echo $rows_idoso['aspecto']; ?>;
                                                coloracaoUrina: <?php echo $rows_idoso['coloracaoUrina']; ?>;
                                                odorUrina: <?php echo $rows_idoso['odorUrina']; ?>;
                                                frequenciaUrina: <?php echo $rows_idoso['frequenciaUrina']; ?>;
                                                queixaGases: <?php echo $rows_idoso['queixaGases']; ?>;
                                                usoFraldaGeriatrica: <?php echo $rows_idoso['usoFraldaGeriatrica']; ?>;
                                                marcaFraldaGeriatrica: <?php echo $rows_idoso['marcaFraldaGeriatrica']; ?>.</p>
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