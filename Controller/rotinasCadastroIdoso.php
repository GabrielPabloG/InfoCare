<?php
    session_start();
	require_once '../Model/Idoso.php';
    require_once '../Model/Pessoa.php';
    require_once '../Model/ProntuarioFixo.php';
	require_once '../Dao/DaoIdoso.php';
	require_once '../Model/Medicamento.php';
	require_once '../Dao/DaoMedicamento.php';
	
	$medicamento = new Medicamento();
	$idoso = new Idoso();
    $pessoa = new Pessoa();
    $fixo = new ProntuarioFixo();
	$daoIdoso = new DaoIdoso();
    $daoMedicamento = new DaoMedicamento();
	
	$idoso->setNomeIdoso($_POST['nomeIdoso']);
    $idoso->setCpfIdoso($_POST['cpfIdoso']);
    $idoso->setSexoIdoso($_POST['sexoIdoso']);
    $idoso->setNascIdoso($_POST['nascIdoso']);
    $_SESSION['fotoIdoso'] = $_FILES['foto'];

    $fixo->setDeclinioCongnitivo($_POST['declinioCongnitivo']);
    $fixo->setDificuldadeFala($_POST['dificuldadeFala']);
    $fixo->setAudicao($_POST['audicao']);
    $fixo->setAcidenteVascularEncefalico($_POST['acidenteVascularEncefalico']);
    $fixo->setTraumatismoCranioEncefalico($_POST['traumatismoCranioEncefalico']);
    $fixo->setHipertensaoArterial($_POST['hipertensaoArterial']);
    $fixo->setHipotireoidismo($_POST['hipotireoidismo']);
    $fixo->setTipoDiabetes($_POST['tipoDiabetes']);
    $fixo->setTipoCancer($_POST['tipoCancer']);
    $fixo->setLocalFratura($_POST['localFratura']);
    $fixo->setTipoCirugia($_POST['tipoCirurgia']);
    $fixo->setOutrasPatologias($_POST['outrasPatologias']);
    $fixo->setUsoMedicamento($_POST['usoMedicamento']);
    $fixo->setTratamentoRealizado($_POST['tratamentoRealizado']);

    $fixo->setPeso($_POST['peso']);
    $fixo->setAltura($_POST['altura']);
    $fixo->setPressaoArterial($_POST['pressaoArterial']);
    $fixo->setPulsacao($_POST['pulsacao']);
    $fixo->setRespiracao($_POST['respiracao']);
    $fixo->setTemperatura($_POST['temperatura']);
    $fixo->setDextro($_POST['dextro']);
    $fixo->setSpo2($_POST['spo2']);
    $fixo->setUtilizacaoOculos($_POST['utilizacaoOculos']);
    $fixo->setProteseAuditiva($_POST['proteseAuditiva']);
    $fixo->setCarteiraVacinacao($_POST['carteiraVacinacao']);
    $fixo->setTabagista($_POST['tabagista']);
    $fixo->setEtilista($_POST['etilista']);
    $fixo->setDepenciaEtilismo($_POST['dependenciaEtilismo']);
    $fixo->setTipoSanguineo($_POST['tipoSanguineo']);
    $fixo->setUsoProteseDentaria($_POST['usoProteseDentaria']);
    $fixo->setMarcaProteseDentaria($_POST['marcaProteseDentaria']);
    $fixo->setModeloProteseDentaria($_POST['modeloProtoseDentaria']);
    $fixo->setUsoMedicamentoContinuo($_POST['usoMedicamentoContinuo']);
    $fixo->setUsoSubstanciaPsicoativa($_POST['usoSubstanciaPsicoativa']);
    $fixo->setAlergiaMedicamento($_POST['alergiaMedicamento']);
    $fixo->setConvenio($_POST['convenio']);
    $fixo->setEncaminhamentoUnidadeHospitalar($_POST['encaminhamentoUnidadeHospitalar']);
    $fixo->setAtividadeManual($_POST['atividadeManual']);

    $fixo->setIntegridadePele($_POST['integridadePele']);
    $fixo->setHidratacaoPele($_POST['hidratacaoPele']);
    $fixo->setDermatite($_POST['dermatite']);
    $fixo->setPrurido($_POST['prurido']);
    $fixo->setMicoseUnha($_POST['micoseUnha']);
    $fixo->setEscamacaoPele($_POST['escamacaoPele']);
    $fixo->setIctericiaPele($_POST['ictericiaPele']);
    $fixo->setFeridaPele($_POST['feridaPele']);
    $fixo->setPetequiaPele($_POST['petequiaPele']);
    $fixo->setHematomaPele($_POST['hematomaPele']);
    $fixo->setUlceraPele($_POST['ulceraPele']);
    $fixo->setGrauUlcera($_POST['grauUlcera']);
    $fixo->setOutraEspecificacao($_POST['outraEspecificacao']);

    $fixo->setTipoTosse($_POST['tipoTosse']);
    $fixo->setAscultacao($_POST['ascultacao']);
    $fixo->setTipoDispineia($_POST['tipoDispineia']);

    $fixo->setAlimentacaoSolo($_POST['alimentacaoSolo']);
    $fixo->setDificuldadeDegluticao($_POST['dificuldadeDegluticao']);
    $fixo->setUsoSonda($_POST['usoSonda']);
    $fixo->setRestricaoAlimento($_POST['restricaoAlimento']);
    $fixo->setPreferenciaAlimento($_POST['preferenciaAlimento']);

    $fixo->setLocomocaoSolo($_POST['locomocaoSolo']);
    $fixo->setCadeirante($_POST['cadeirante']);
    $fixo->setTempoCadeirante($_POST['tempoCadeirante']);
    $fixo->setAcamacao($_POST['acamacao']);
    $fixo->setTempoAcamacao($_POST['tempoAcamacao']);
    $fixo->setApoioFisico($_POST['apoioFisico']);
    $fixo->setEsporteTerapia($_POST['esporteTerapia']);

    $fixo->setStatusComunicacao($_POST['statusComunicacao']);
    $fixo->setAgressividade($_POST['agressividade']);
    $fixo->setTemperamento($_POST['temperamento']);
    $fixo->setAnterioridadeCasaRepouso($_POST['anterioridadeCasaRepouso']);
    $fixo->setIrritabilidade($_POST['irritabilidade']);

    $fixo->setConclusaoHemograma($_POST['conclusaoHemograma']);
    $fixo->setTipoUrina($_POST['tipoUrina']);
    $fixo->setParasitologicoFezes($_POST['parasitologicoFezes']);
    $fixo->setGlicemiaJejum($_POST['glicemiaJejum']);
    $fixo->setColesterol($_POST['colesterol']);
    $fixo->setTipoHepatite($_POST['tipoHepatite']);
    $fixo->setHiv($_POST['hiv']);
    $fixo->setVdrl($_POST['vdrl']);
    $fixo->setAtestadoNeurologico($_POST['atestadoNeurologico']);
    $fixo->setRaioXPulmao($_POST['raioxPulmao']);
    $fixo->setReceituarioMedico($_POST['receituarioMedico']);

    $fixo->setFrequenciaEvacuacao($_POST['frequenciaEvacuacao']);
    $fixo->setAspectoFezes($_POST['aspecto']);
    $fixo->setColoracaoUrina($_POST['coloracaoUrina']);
    $fixo->setOdorUrina($_POST['odorUrina']);
    $fixo->setFrequenciaUrina($_POST['frequenciaUrina']);
    $fixo->setQueixaGases($_POST['queixaGases']);
    $fixo->setUsoFraldaGeriatrica($_POST['usoFraldaGeriatrica']);
    $fixo->setMarcaFraldaGeriatrica($_POST['marcaFraldaGeriatrica']);

    $medicamento->setNomeMedicamento($_POST['nomeMedicamento']);
    $medicamento->setDosagemMedicamento($_POST['dosagemMedicamento']);
    $medicamento->setHorarioMedicamento($_POST['horarioMedicamento']);
    $medicamento->setPosologia($_POST['posologia']);
    $medicamento->setComposicaoMedicamento($_POST['composicaoMedicamento']);

	echo($daoIdoso->cadastrarIdoso($idoso, $fixo));
    echo($daoMedicamento->cadastrarMedicamento($medicamento));
	
?>
