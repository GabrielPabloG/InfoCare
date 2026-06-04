<?php

	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

    include_once 'Dao/conexao.php';
	$result_idoso = "SELECT codIdoso, nomeIdoso, sexoIdoso, cpfIdoso, nascIdoso, nomeResponsavel, declinioCongnitivo, dificuldadeFala, audicao, acidenteVascularEncefalico, traumatismoCranioEncefalico, hipertensaoArterial, hipotireoidismo, tipoDiabetes, tipoCancer, localFratura, tipoCirurgia, outrasPatologias, usoMedicamento, tratamentoRealizado, peso, altura, pressaoArterial, pulsacao, respiracao, temperatura, dextro, spo2, utilizacaoOculos, proteseAuditiva, carteiraVacinacao, tabagista, etilista, dependenciaEtilismo, tipoSanguineo, usoProteseDentaria, marcaProteseDentaria, modeloProtoseDentaria, usoMedicamentoContinuo, usoSubstanciaPsicoativa, alergiaMedicamento, convenio, encaminhamentoUnidadeHospitalar, atividadeManual, integridadePele, hidratacaoPele, dermatite, prurido, micoseUnha, escamacaoPele, ictericiaPele, feridaPele, petequiaPele, hematomaPele, ulceraPele, ascultacao, tipoTosse, tipoDispineia, grauUlcera, outraEspecificacao, alimentacaoSolo, dificuldadeDegluticao, usoSonda, restricaoAlimento, preferenciaAlimento, locomocaoSolo, cadeirante, tempoCadeirante, acamacao, tempoAcamacao, apoioFisico, esporteTerapia, statusComunicacao, agressividade, temperamento, anterioridadeCasaRepouso, irritabilidade, conclusaoHemograma, tipoUrina, parasitologicoFezes, glicemiaJejum, colesterol, tipoHepatite, hiv, vdrl, atestadoNeurologico, raioxPulmao, receituarioMedico, frequenciaEvacuacao, aspecto, coloracaoUrina, odorUrina, frequenciaUrina, queixaGases, usoFraldaGeriatrica, marcaFraldaGeriatrica, tbProntuarioFixo.codProntuarioFixo From tbIdoso
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
    ON tbProntuarioFixo.codEliminacao = tbEliminacao.codEliminacao
    WHERE codIdoso = ".$_POST['idIdoso'];
	$resultado_idoso = mysqli_query($conn, $result_idoso);
    $conexao = abrirConexao();

    $consulta = "SELECT nomeFoto FROM foto WHERE codIdoso = ".$_POST['idIdoso'];
    $resultado = $conexao->query($consulta);

    while($linharesultado = mysqli_fetch_array($resultado)){
                        $img = $linharesultado['nomeFoto'];
                    }

    $idoso = ' <h1> Dados </h1> <link href="../css/cssIdoso.css" type="text/css" rel="stylesheet">';

    while($rows_idoso = mysqli_fetch_assoc($resultado_idoso)){
        $idoso .= '
        <div>
        <b>Nome:</b> '.$rows_idoso['nomeIdoso'].'
        <br>
        CPF: '.$rows_idoso['cpfIdoso'].'
        <br>
        Sexo: '.$rows_idoso['sexoIdoso'].'
        <br>
        Nascimento: '.$rows_idoso['nascIdoso'].'
        <br>
        Peso: '.$rows_idoso['peso'].'
        <br>
        Altura: '.$rows_idoso['altura'].'
        <br>
        <b>Nome do Responsável:</b> '.$rows_idoso['nomeResponsavel'].'
        <img src="../upload/'.$img.'" class="avatar"> 
        </div>
            <h2>Anamnese</h2>
        <div>
        Declinio Congnitivo: '.$rows_idoso['declinioCongnitivo'].'
        <br>
        Dificuldade Fala: '.$rows_idoso['dificuldadeFala'].'
        <br>
        Audição: '.$rows_idoso['audicao'].'
        <br>
        Acidente Vascular Encefálico: '.$rows_idoso['acidenteVascularEncefalico'].'
        <br>
        Traumatismo Cranio Encefálico: '.$rows_idoso['traumatismoCranioEncefalico'].'
        <br>
        Hipertensão Arterial: '.$rows_idoso['hipertensaoArterial'].'
        <br>
        Hipotireoidismo: '.$rows_idoso['hipotireoidismo'].'
        <br>
        Tipo Diabetes: '.$rows_idoso['tipoDiabetes'].'
        <br>
        Tipo Cancer: '.$rows_idoso['tipoCancer'].'
        <br>
        Tipo Cirurgia: '.$rows_idoso['tipoCirurgia'].'
        <br>
        Uso Medicamento: '.$rows_idoso['usoMedicamento'].'
        <br>
        Tratamento Realizado: '.$rows_idoso['tratamentoRealizado'].'
        </div>
            <h3>Questionamento</h3>
        <div>
        Utilização Óculos: '.$rows_idoso['utilizacaoOculos'].'
        <br>
        Prótese Auditiva: '.$rows_idoso['proteseAuditiva'].'
        <br>
        Carteira de Vacinação: '.$rows_idoso['carteiraVacinacao'].'
        <br>
        Tabagista: '.$rows_idoso['tabagista'].'
        <br>
        Etilista: '.$rows_idoso['etilista'].'
        <br>
        Dependência Etilismo: '.$rows_idoso['dependenciaEtilismo'].'
        <br>
        Tipo Sanguíneo: '.$rows_idoso['tipoSanguineo'].'
        <br>
        Uso Prótese Dentária: '.$rows_idoso['usoProteseDentaria'].'
        <br>
       Uso Medicamento Contínuo: '.$rows_idoso['usoMedicamentoContinuo'].'
        <br>
       Uso Substância Psicoativa: '.$rows_idoso['usoSubstanciaPsicoativa'].'
        <br>
        Alergia Medicamento: '.$rows_idoso['alergiaMedicamento'].'
        <br>
        Convenio: '.$rows_idoso['convenio'].'
        <br>
        Encaminhamento Unidade Hospitalar: '.$rows_idoso['encaminhamentoUnidadeHospitalar'].'
        <br>
        Atividade Manual: '.$rows_idoso['atividadeManual'].'
        </div>
            <h3>Pele</h3>
        <div>
        Integridade Pele: '.$rows_idoso['integridadePele'].'
        <br>
        Hidratação Pele: '.$rows_idoso['hidratacaoPele'].'
        <br>
        Dermatite: '.$rows_idoso['dermatite'].'
        <br>
        Prurido: '.$rows_idoso['prurido'].'
        <br>
        Micose Unha: '.$rows_idoso['micoseUnha'].'
        <br>
        Escamação Pele: '.$rows_idoso['escamacaoPele'].'
        <br>
        Ictericia Pele: '.$rows_idoso['ictericiaPele'].'
        <br>
        Ferida Pele: '.$rows_idoso['feridaPele'].'
        <br>
        Petequia Pele: '.$rows_idoso['petequiaPele'].'
        <br>
        Hematoma Pele: '.$rows_idoso['hematomaPele'].'
        <br>
        Úlcera: '.$rows_idoso['ulceraPele'].'
        </div>
            <h3>Pulmonar</h3>
        <div>
        Ascultação: '.$rows_idoso['ascultacao'].'
        <br>
        Tipo Tosse: '.$rows_idoso['tipoTosse'].'
        <br>
        Tipo Dispineia: '.$rows_idoso['tipoDispineia'].'
        </div>
            <h3>Alimentação</h3>
        <div>
        Alimentação Solo: '.$rows_idoso['alimentacaoSolo'].'
        <br>
        Dificuldade Deglutição: '.$rows_idoso['dificuldadeDegluticao'].'
        <br>
        Uso Sonda: '.$rows_idoso['usoSonda'].'
        <br>
        Restrição Alimento: '.$rows_idoso['restricaoAlimento'].'
        <br>
        Preferência Alimento: '.$rows_idoso['preferenciaAlimento'].'
        </div>
            <h3>Locomoção</h3>
        <div>
        Locomoção Solo: '.$rows_idoso['locomocaoSolo'].'
        <br>
        Cadeirante: '.$rows_idoso['cadeirante'].'
        <br>
        Acamação: '.$rows_idoso['acamacao'].'
        <br>
        Apoio Físico: '.$rows_idoso['apoioFisico'].'
        <br>
        Esporte Terapia: '.$rows_idoso['esporteTerapia'].'
        </div>
            <h3>Relacionamento</h3>
        <div>
        Status Comunicação: '.$rows_idoso['statusComunicacao'].'
        <br>
        Agressividade: '.$rows_idoso['agressividade'].'
        <br>
        Temperamento: '.$rows_idoso['temperamento'].'
        <br>
        Anterioridade Casa Repouso: '.$rows_idoso['anterioridadeCasaRepouso'].'
        <br>
        Irritabilidade: '.$rows_idoso['irritabilidade'].'
        </div>
            <h3>Exame</h3>
        <div>
        Conclusão Hemograma: '.$rows_idoso['conclusaoHemograma'].'
        <br>
        Tipo Urina: '.$rows_idoso['tipoUrina'].'
        <br>
        Parasitologico: '.$rows_idoso['parasitologicoFezes'].'
        <br>
        Glicemia Jejum: '.$rows_idoso['glicemiaJejum'].'
        <br>
        Colesterol: '.$rows_idoso['colesterol'].'
        <br>
        Tipo Hepatite: '.$rows_idoso['tipoHepatite'].'
        <br>
        HIV: '.$rows_idoso['hiv'].'
        <br>
        VDRL: '.$rows_idoso['vdrl'].'
        <br>
        Atestado Neurologico: '.$rows_idoso['atestadoNeurologico'].'
        <br>
        Raio X Pulmão: '.$rows_idoso['raioxPulmao'].'
        <br>
        Receituário Médico: '.$rows_idoso['receituarioMedico'].'
        </div>
            <h3>Eliminação</h3>
        <div>
        Frequência Evacuação: '.$rows_idoso['frequenciaEvacuacao'].'
        <br>
        Aspecto Fezes: '.$rows_idoso['aspecto'].'
        <br>
        Odor Urina: '.$rows_idoso['odorUrina'].'
        <br>
        Frequência Urina: '.$rows_idoso['frequenciaUrina'].'
        <br>
        Queixa Gases: '.$rows_idoso['queixaGases'].'
        <br>
        Uso Fralda Geriátrica: '.$rows_idoso['usoFraldaGeriatrica'].'
        </div>
        <div>
        </div>
        ';
        $codProntuarioFixo = $rows_idoso['codProntuarioFixo'];
        
    }


    $sqlMedicamento = "SELECT tbMedicacao.codMedicacao, nomeMedicacao, dosagemMedicacao, horarioMedicacao, composicaoMedicamento, posologia, tbProntuarioFixo.codProntuarioFixo
    FROM tbMedicacaoProntuario
    INNER JOIN tbMedicacao
    ON tbMedicacao.codMedicacao = tbMedicacaoProntuario.codMedicacao
    INNER JOIN tbProntuarioFixo
    ON tbProntuarioFixo.codProntuarioFixo = tbMedicacaoProntuario.codProntuarioFixo
    WHERE tbProntuarioFixo.codProntuarioFixo = ".$codProntuarioFixo;
    $resultado_medicamento = $conexao->query($sqlMedicamento);

    $medicamento = "<h1> Medicação </h1>";

    while($rows_medicamento = mysqli_fetch_assoc($resultado_medicamento)){
        $medicamento .= '
        <div>
            Nome medicamento: '.$rows_medicamento['nomeMedicacao'].'
            <br>
            Dosagem Medicamento: '.$rows_medicamento['dosagemMedicacao'].'
            <br>
            Horario Medicamento: '.$rows_medicamento['horarioMedicacao'].'
            <br>
            Composição Medicamento: '.$rows_medicamento['composicaoMedicamento'].'
            <br>
            Posologia: '.$rows_medicamento['posologia'].'
        </div>
        ';
    }

	//Criando a Instancia
	$dompdf = new DOMPDF();

	// Carrega seu HTML
	$dompdf->load_html('
			<!DOCTYPE html>
			<html lang="pt-br">
				<head>
					<meta charset="utf-8">
					<title>Celke</title>
					<link href="css/personalizado.css" rel="stylesheet">
				</head>
				<body>
                    '.$idoso.'
                    '.$medicamento.'
                </body>
			</html>
		');

	
	$dompdf->setPaper('A4', 'landscape');
	
	//Renderizar o html
	$dompdf->render();
	

	//Exibibir a página
	$dompdf->stream(
		"relatorio_celke.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>