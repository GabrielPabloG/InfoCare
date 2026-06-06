<html>
	<head>
		<meta charset="UTF-8">
		<title>Erro</title>
	</head>
	<body style="background-color: #728CA6;">
	
	</body>
</html>

<?php
    require_once '../Model/Idoso.php';
    require_once '../Model/Pessoa.php';
    require_once '../Model/ProntuarioFixo.php';
    include_once 'conexao.php';

    class DaoIdoso{
        //rotina de cadastro do usuário no banco de dados
        public function cadastrarIdoso($idoso, $fixo){
            session_start();
            $conexao = abrirconexao();
            
            $consulta1 = "SELECT codIdoso, nomeIdoso, sexoIdoso, cpfIdoso FROM tbIdoso".
            " WHERE cpfIdoso = '".$idoso->getCpf()."'";
    
            $resultado1 = $conexao->query($consulta1);
  
            $numresultado1 = mysqli_num_rows($resultado1);
            
            /*$consulta2 = "SELECT codResponsavel, cpfResponsavel FROM tbResponsavel WHERE cpfResponsavel = '".$pessoa->getCpfPessoa()."'";
            
            $resultado2 = $conexao->query($consulta2);
            
            $numresultado2 = mysqli_num_rows($resultado2);
            
            
                
                while($linharesultado = mysqli_fetch_array($resultado2)){
            $cod = $linharesultado['codResponsavel'];
        }*/ if($numresultado1 == 0) {
            
                $antecedencia = "insert into tbAntecedencia(declinioCongnitivo, dificuldadeFala, audicao, acidenteVascularEncefalico, traumatismoCranioEncefalico, hipertensaoArterial, hipotireoidismo, tipoDiabetes, tipoCancer, localFratura, tipoCirurgia, outrasPatologias, usoMedicamento, tratamentoRealizado)
                 values ('".$fixo->getDeclinioCongnitivo()."', '".$fixo->getDificuldadeFala()."', '".$fixo->getAudicao()."', '".$fixo->getAcidenteVascularEncefalico()."', '".$fixo->getTraumatismoCranioEncefalico()."', '".$fixo->getHipertensaoArterial()."', '".$fixo->getHipotireoidismo()."', '".$fixo->getTipoDiabetes()."', '".$fixo->getTipoCancer()."', '".$fixo->getLocalFratura()."', '".$fixo->getTipoCirugia()."', '".$fixo->getOutrasPatologias()."', '".$fixo->getUsoMedicamento()."' , '".$fixo->getTratamentoRealizado()."' )";
            
            $resultadoAntecedencia = $conexao->query($antecedencia);
            
            $codAntecedencia = "SELECT MAX(codAntecedencia) codAntecedencia FROM tbAntecedencia";
                
                $resultado1 = $conexao->query($codAntecedencia);

        while($linharesultado = mysqli_fetch_array($resultado1)){
            $codAntecedencia = $linharesultado['codAntecedencia'];
        }
            
            $questionamento = "insert into tbQuestionamento(peso, altura, pressaoArterial, pulsacao, respiracao, temperatura, dextro, spo2, utilizacaoOculos, proteseAuditiva, carteiraVacinacao, tabagista, etilista, dependenciaEtilismo, tipoSanguineo, usoProteseDentaria, marcaProteseDentaria, modeloProtoseDentaria, usoMedicamentoContinuo, usoSubstanciaPsicoativa, alergiaMedicamento, convenio, encaminhamentoUnidadeHospitalar, atividadeManual)
                 values ('".$fixo->getPeso()."', '".$fixo->getAltura()."','".$fixo->getPressaoArterial()."', '".$fixo->getPulsacao()."',
                 '".$fixo->getRespiracao()."', '".$fixo->getTemperatura()."', '".$fixo->getDextro()."', '".$fixo->getSpo2()."', 
                 '".$fixo->getUtilizacaoOculos()."', '".$fixo->getProteseAuditiva()."', '".$fixo->getCarteiraVacinacao()."', 
                 '".$fixo->getTabagista().
                "', '".$fixo->getEtilista()."' , '".$fixo->getDepenciaEtilismo()."', '".$fixo->getTipoSanguineo().
                "', '".$fixo->getUsoProteseDentaria()."', '".$fixo->getMarcaProteseDentaria()."', '".$fixo->getModeloProteseDentaria().
                "', '".$fixo->getUsoMedicamentoContinuo()."', '".$fixo->getUsoSubstanciaPsicoativa()."', '".$fixo->getAlergiaMedicamento().
                "', '".$fixo->getConvenio()."', '".$fixo->getEncaminhamentoUnidadeHospitalar()."', '".$fixo->getAtividadeManual()."' )";
            
            $resultadoQuestionamento = $conexao->query($questionamento);
            
            $codQuestionamento = "SELECT MAX(codQuestionamento) codQuestionamento FROM tbQuestionamento";
                
                $resultado2 = $conexao->query($codQuestionamento);

        while($linharesultado = mysqli_fetch_array($resultado2)){
            $codQuestionamento = $linharesultado['codQuestionamento'];
        }
            
            $pele = "insert into tbPele(integridadePele, hidratacaoPele, dermatite, prurido, micoseUnha, escamacaoPele, ictericiaPele, feridaPele, petequiaPele, hematomaPele, ulceraPele, grauUlcera, outraEspecificacao)
                 values ('".$fixo->getIntegridadePele()."', '".$fixo->getHidratacaoPele()."', '".$fixo->getDermatite()."', '".$fixo->getPrurido()."', '".$fixo->getMicoseUnha()."', '".$fixo->getEscamacaoPele()."', '".$fixo->getIctericiaPele()."', '".$fixo->getFeridaPele()."', '".$fixo->getPetequiaPele()."', '".$fixo->getHematomaPele()."', '".$fixo->getUlceraPele()."', '".$fixo->getGrauUlcera()."', '".$fixo->getOutraEspecificacao()."' )";
            
            $resultadoPele = $conexao->query($pele);
            
            $codPele = "SELECT MAX(codPele) codPele FROM tbPele";
                
                $resultado3 = $conexao->query($codPele);

        while($linharesultado = mysqli_fetch_array($resultado3)){
            $codPele = $linharesultado['codPele'];
        }
            
            $pulmonar = "insert into tbPulmonar(tipoTosse, ascultacao, tipoDispineia)
                 values ('".$fixo->getTipoTosse()."', '".$fixo->getAscultacao()."', '".$fixo->getTipoDispineia()."')";
            
            $resultadoPulmonar = $conexao->query($pulmonar);
            
            $codPulmonar = "SELECT MAX(codPulmonar) codPulmonar FROM tbPulmonar";
                
                $resultado4 = $conexao->query($codPulmonar);

        while($linharesultado = mysqli_fetch_array($resultado4)){
            $codPulmonar = $linharesultado['codPulmonar'];
        }
            
            $alimentacao = "insert into tbAlimentacao(alimentacaoSolo, dificuldadeDegluticao, usoSonda, restricaoAlimento, preferenciaAlimento)
                 values ('".$fixo->getAlimentacaoSolo()."', '".$fixo->getDificuldadeDegluticao()."', '".$fixo->getUsoSonda()."', '".$fixo->getRestricaoAlimento()."', '".$fixo->getPreferenciaAlimento()."')";
            
            $resultadoAlimentacao = $conexao->query($alimentacao);
            
            $codAlimentacao = "SELECT MAX(codAlimentacao) codAlimentacao FROM tbAlimentacao";
                
                $resultado5 = $conexao->query($codAlimentacao);

        while($linharesultado = mysqli_fetch_array($resultado5)){
            $codAlimentacao = $linharesultado['codAlimentacao'];
        }
            
            $locomocao = "insert into tbLocomocao(locomocaoSolo, cadeirante, tempoCadeirante, acamacao, tempoAcamacao, apoioFisico, esporteTerapia)
                 values ('".$fixo->getLocomocaoSolo()."', '".$fixo->getCadeirante()."', '".$fixo->getTempoCadeirante()."', '".$fixo->getAcamacao()."', '".$fixo->getTempoAcamacao()."', '".$fixo->getApoioFisico()."', '".$fixo->getEsporteTerapia()."')";
            
            $resultadoLocomocao = $conexao->query($locomocao);
            
            $codLocomocao = "SELECT MAX(codLocomocao) codLocomocao FROM tbLocomocao";
                
                $resultado6 = $conexao->query($codLocomocao);

        while($linharesultado = mysqli_fetch_array($resultado6)){
            $codLocomocao = $linharesultado['codLocomocao'];
        }
            
            $relacionamento = "insert into tbRelacionamento(statusComunicacao, agressividade, temperamento, anterioridadeCasaRepouso, irritabilidade)
                 values ('".$fixo->getStatusComunicacao()."', '".$fixo->getAgressividade()."', '".$fixo->getTemperamento()."', '".$fixo->getAnterioridadeCasaRepouso()."', '".$fixo->getIrritabilidade()."')";
            
            $resultadoAntecedencia = $conexao->query($relacionamento);
            
            $codRelacionamento = "SELECT MAX(codRelacionamento) codRelacionamento FROM tbRelacionamento";
                
                $resultado7 = $conexao->query($codRelacionamento);

        while($linharesultado = mysqli_fetch_array($resultado7)){
            $codRelacionamento = $linharesultado['codRelacionamento'];
        }
            
            $exame = "insert into tbExame(conclusaoHemograma, tipoUrina, parasitologicoFezes, glicemiaJejum, colesterol, tipoHepatite, hiv, vdrl, atestadoNeurologico, raioxPulmao, receituarioMedico)
                 values ('".$fixo->getConclusaoHemograma()."', '".$fixo->getTipoUrina()."', '".$fixo->getParasitologicoFezes()."', '".$fixo->getGlicemiaJejum()."', '".$fixo->getColesterol()."', '".$fixo->getTipoHepatite()."', '".$fixo->getHiv()."', '".$fixo->getVdrl()."', '".$fixo->getAtestadoNeurologico()."', '".$fixo->getRaioXPulmao()."', '".$fixo->getReceituarioMedico()."')";
            
            $resultadoExame = $conexao->query($exame);
            
            $codExame = "SELECT MAX(codExame) codExame FROM tbExame";
                
                $resultado8 = $conexao->query($codExame);

        while($linharesultado = mysqli_fetch_array($resultado8)){
            $codExame = $linharesultado['codExame'];
        }
            
            $eliminacao = "insert into tbEliminacao(frequenciaEvacuacao, aspecto, coloracaoUrina, odorUrina, frequenciaUrina, queixaGases, usoFraldaGeriatrica, marcaFraldaGeriatrica)
                 values ('".$fixo->getFrequenciaEvacuacao()."', '".$fixo->getAspectoFezes()."', '".$fixo->getColoracaoUrina()."', '".$fixo->getOdorUrina()."', '".$fixo->getFrequenciaUrina()."', '".$fixo->getQueixaGases()."', '".$fixo->getUsoFraldaGeriatrica()."', '".$fixo->getMarcaFraldaGeriatrica()."')";
            
            $resultadoElimanacao = $conexao->query($eliminacao);
            
            $codEliminacao = "SELECT MAX(codEliminacao) codEliminacao FROM tbEliminacao";
                
                $resultado9 = $conexao->query($codEliminacao);

        while($linharesultado = mysqli_fetch_array($resultado9)){
            $codEliminacao = $linharesultado['codEliminacao'];
        }
            
                $queryInsert2 = "insert into tbProntuarioFixo(dataEmissaoProntuarioFixo, codAntecedencia, codQuestionamento, codPele, codPulmonar, codAlimentacao, codLocomocao, codRelacionamento, codExame, codEliminacao)
                values (CURDATE(), ".$codAntecedencia.", ".$codQuestionamento.", ".$codPele.", ".$codPulmonar.", ".$codAlimentacao.", ".$codLocomocao.", ".$codRelacionamento.", ".$codExame.", ".$codEliminacao.")";
                
                $resultadoInsert2 = $conexao->query($queryInsert2);
                
            $codProntuarioFixo = "SELECT MAX(codProntuarioFixo) codProntuarioFixo FROM tbProntuarioFixo";
                
                $resultado11 = $conexao->query($codProntuarioFixo);

        while($linharesultado = mysqli_fetch_array($resultado11)){
            $codigo = $linharesultado['codProntuarioFixo'];
        }
            $id = $_POST['codResponsavel'];
            //values ('".."', '".."', '".."', '".."', '".."', '".."', '".."', '".."', '".."', '".."', '".."', '".."' , '".."' , '".."' )";
                
                $queryInsert1 = "insert into tbIdoso(nomeIdoso, sexoIdoso, cpfIdoso, nascIdoso, codResponsavel, codProntuarioFixo)
            values ('".$idoso->getNome()."', '".$idoso->getSexo()."', '".$idoso->getCpf()."', '".$idoso->getNascimento()."', '".$id."', ".$codigo.")";
            
            echo($queryInsert2);
            
            $resultadoInsert1 = $conexao->query($queryInsert1);
            //retorna a quantidade de inserções no banco
            
            $funfou = true;
            
            }
            else {
                $funfou = false;
            }
            
            $_SESSION['cadastrando'] = '';
            
            $msg = false;

    if(isset($_SESSION['fotoIdoso'])) {
        $extensao = strrchr($_FILES['foto']['name'], '.');
        $novoNome = md5($_SESSION['fotoIdoso']['name']) . $extensao;
        $diretorio = "../upload/";
        
        move_uploaded_file($_SESSION['fotoIdoso']['tmp_name'], $diretorio.$novoNome);
        
        $codIdoso = "SELECT MAX(codIdoso) codIdoso FROM tbIdoso";
                
                $resultado = $conexao->query($codIdoso);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $codIdoso = $linharesultado['codIdoso'];
        }
        
        $sqlCode = "INSERT INTO foto(nomeFoto, dataFoto, codIdoso) VALUES('".$novoNome."', NOW(), ".$codIdoso.")";
        if($conexao->query($sqlCode)) {
            $msg = "Arquivo enviado com sucesso!";
            echo($sqlCode);
            //header("Location: ../View/homeGerente.php");
        }
        else {
            echo($sqlCode);
            $msg = "Falha ao enviar o arquivo";
        }
    }
            
            if($resultadoInsert1 > 0  && $funfou == true){
                //echo($codQuestionamento);
                
                echo("<br> Cadastro realizado com sucesso.");
                $_SESSION['cadastrou'] = 'Cadastro realizado com sucesso.';
                
				    header("Location: ../View/homeGerente.php");
                    
				
                $conexao->close();
            } else if($resultadoInsert1 > 0 && $funfou == false) {

                
                echo("<br> Cadastro não concluiu com sucesso, tente novamente.");
                $_SESSION['cadastrando1'] = 'Cadastro não concluiu com sucesso.';
            
				 //header("Location: ../View/cadastroIdoso.php"); 
            
                $conexao->close();
            } else if($resultadoInsert1 > 0 && $funfou == true || $numresultado1 == 1) {

                
                echo($queryInsert1);
                echo($queryInsert2);
                
                echo("<br> Cadastro não concluiu com sucesso, tente novamente.");
                $_SESSION['cadastrando2'] = 'Cadastro não concluiu com sucesso. Cpf já registrado.';
            
				 //header("Location: ../View/cadastroIdoso.php"); 
            
                $conexao->close();
            }
            else {
                
                echo($queryInsert1);
                echo($queryInsert2);
                
                echo("<br> Cadastro não concluiu com sucesso, tente novamente.");
                //$_SESSION['cadastrando2'] = ;
            
				//header("Location: ../View/cadastroIdoso.php"); 
            
                $conexao->close();
            }
                
			}
			public function atualizarIdoso($idoso) {
                $conexao = abrirconexao();
            
                
                
                    $novosDados = "UPDATE tbIdoso INNER JOIN tbResponsavel ON tbIdoso.codResponsavel = tbResponsavel.codResponsavel SET tbIdoso.nomeIdoso = '".$idoso->getNome()."', tbIdoso.cpfIdoso = '".$idoso->getCpf()."', tbIdoso.sexoIdoso = '".$idoso->getSexo()."', tbIdoso.nascIdoso = '".$idoso->getNascimento()."' WHERE tbIdoso.cpfIdoso = '".$idoso->getCpf()."' ";
                
                    $resultado = $conexao->query($novosDados);
                
                    if($resultado > 0) {
                        echo($novosDados);
                        echo($consulta2);
                    
                        echo("<br> Update realizado com sucesso.");
                        $_SESSION['cadastrou'] = 'Informação do idoso alterada com sucesso.';
				        header("Location: ../View/homeGerente.php");    
                        $conexao->close();
                    }
                
                else {
                
                    $_SESSION['cadastrou'] = 'Update não realizado com sucesso.';
				    //header("Location: ../index.php");    
				    $conexao->close();
                }
            }
        }
		
?>