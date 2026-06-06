<?php
session_start();

require_once '../Model/Antecedencia.php';
require_once '../Model/Questionamento.php';
require_once '../Model/Pele.php';
require_once '../Model/Pulmonar.php';
require_once '../Model/Alimentacao.php';
require_once '../Model/Locomocao.php';
require_once '../Model/Relacionamento.php';
require_once '../Model/Exame.php';
require_once '../Model/Eliminacao.php';
require_once '../Model/ProntuarioFixo.php';

require_once '../Dao/DaoAntecedencia.php';
require_once '../Dao/DaoQuestionamento.php';
require_once '../Dao/DaoPele.php';
require_once '../Dao/DaoPulmonar.php';
require_once '../Dao/DaoAlimentacao.php';
require_once '../Dao/DaoLocomocao.php';
require_once '../Dao/DaoRelacionamento.php';
require_once '../Dao/DaoExame.php';
require_once '../Dao/DaoEliminacao.php';
require_once '../Dao/DaoProntuarioFixo.php';

function postValue($key, $default = null) {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../View/homeFuncionario.php');
    exit;
}

try {
    $antecedencia = new Antecedencia();
    $antecedencia->setDeclinioCognitivo(postValue('declinioCongnitivo'));
    $antecedencia->setDificuldadeFala(postValue('dificuldadeFala'));
    $antecedencia->setAudicao(postValue('audicao'));
    $antecedencia->setAve(postValue('acidenteVascularEncefalico'));
    $antecedencia->setTce(postValue('traumatismoCranioEncefalico'));
    $antecedencia->setHipertensao(postValue('hipertensaoArterial'));
    $antecedencia->setHipotireoidismo(postValue('hipotireoidismo'));
    $antecedencia->setDiabetesTipo(postValue('tipoDiabetes'));
    $antecedencia->setCancerTipo(postValue('tipoCancer'));
    $antecedencia->setLocalFratura(postValue('localFratura'));
    $antecedencia->setCirugiaTipo(postValue('tipoCirurgia'));
    $antecedencia->setOutrasPatologias(postValue('outrasPatologias'));
    $antecedencia->setUsaMedicamento(postValue('usoMedicamento'));
    $antecedencia->setTratamentoRealizado(postValue('tratamentoRealizado'));

    $questionamento = new Questionamento();
    $questionamento->setPeso(postValue('peso'));
    $questionamento->setAltura(postValue('altura'));
    $questionamento->setPressaoArterial(postValue('pressaoArterial'));
    $questionamento->setPulsacao(postValue('pulsacao'));
    $questionamento->setRespiracao(postValue('respiracao'));
    $questionamento->setTemperatura(postValue('temperatura'));
    $questionamento->setDextro(postValue('dextro'));
    $questionamento->setSpo2(postValue('spo2'));
    $questionamento->setUsaOculos(postValue('utilizacaoOculos'));
    $questionamento->setProteseAuditiva(postValue('proteseAuditiva'));
    $questionamento->setCarteiraVacinacao(postValue('carteiraVacinacao'));
    $questionamento->setTabagista(postValue('tabagista'));
    $questionamento->setEtilista(postValue('etilista'));
    $questionamento->setDependenciaEtilismo(postValue('dependenciaEtilismo'));
    $questionamento->setTipoSanguineo(postValue('tipoSanguineo'));
    $questionamento->setUsaProteseDentaria(postValue('usoProteseDentaria'));
    $questionamento->setMarcaProtese(postValue('marcaProteseDentaria'));
    $questionamento->setModeloProtese(postValue('modeloProtoseDentaria'));
    $questionamento->setUsaMedicamentoContinuo(postValue('usoMedicamentoContinuo'));
    $questionamento->setUsaSubstanciaPsicoativa(postValue('usoSubstanciaPsicoativa'));
    $questionamento->setAlergiaMedicamento(postValue('alergiaMedicamento'));
    $questionamento->setConvenio(postValue('convenio'));
    $questionamento->setEncaminhamentoHospitalar(postValue('encaminhamentoUnidadeHospitalar'));
    $questionamento->setAtividadeManual(postValue('atividadeManual'));

    $pele = new Pele();
    $pele->setIntegridade(postValue('integridadePele'));
    $pele->setHidratacao(postValue('hidratacaoPele'));
    $pele->setDermatite(postValue('dermatite'));
    $pele->setPrurido(postValue('prurido'));
    $pele->setMicoseUnha(postValue('micoseUnha'));
    $pele->setEscamacao(postValue('escamacaoPele'));
    $pele->setIctericia(postValue('ictericiaPele'));
    $pele->setFerida(postValue('feridaPele'));
    $pele->setPetequia(postValue('petequiaPele'));
    $pele->setHematoma(postValue('hematomaPele'));
    $pele->setUlcera(postValue('ulceraPele'));
    $pele->setGrauUlcera(postValue('grauUlcera'));
    $pele->setOutraEspecificacao(postValue('outraEspecificacao'));

    $pulmonar = new Pulmonar();
    $pulmonar->setTipoTosse(postValue('tipoTosse'));
    $pulmonar->setAuscultacao(postValue('ascultacao'));
    $pulmonar->setTipoDispneia(postValue('tipoDispineia'));

    $alimentacao = new Alimentacao();
    $alimentacao->setAlimentacaoSozinho(postValue('alimentacaoSolo'));
    $alimentacao->setDificuldadeDegluticao(postValue('dificuldadeDegluticao'));
    $alimentacao->setUsoSonda(postValue('usoSonda'));
    $alimentacao->setRestricaoAlimentar(postValue('restricaoAlimento'));
    $alimentacao->setPreferenciaAlimentar(postValue('preferenciaAlimento'));

    $locomocao = new Locomocao();
    $locomocao->setLocomocaoSozinho(postValue('locomocaoSolo'));
    $locomocao->setCadeirante(postValue('cadeirante'));
    $locomocao->setTempoCadeirante(postValue('tempoCadeirante'));
    $locomocao->setAcamado(postValue('acamacao'));
    $locomocao->setTempoAcamado(postValue('tempoAcamacao'));
    $locomocao->setApoioFisico(postValue('apoioFisico'));
    $locomocao->setEsporteTerapia(postValue('esporteTerapia'));

    $relacionamento = new Relacionamento();
    $relacionamento->setStatusComunicacao(postValue('statusComunicacao'));
    $relacionamento->setAgressividade(postValue('agressividade'));
    $relacionamento->setTemperamento(postValue('temperamento'));
    $relacionamento->setAnterioridadeCasaRepouso(postValue('anterioridadeCasaRepouso'));
    $relacionamento->setIrritabilidade(postValue('irritabilidade'));

    $exame = new Exame();
    $exame->setHemogramaConclusao(postValue('conclusaoHemograma'));
    $exame->setUrinaTipo(postValue('tipoUrina'));
    $exame->setParasitologicoFezes(postValue('parasitologicoFezes'));
    $exame->setGlicemiaJejum(postValue('glicemiaJejum'));
    $exame->setColesterol(postValue('colesterol'));
    $exame->setHepatiteTipo(postValue('tipoHepatite'));
    $exame->setHiv(postValue('hiv'));
    $exame->setVdrl(postValue('vdrl'));
    $exame->setAtestadoNeurologico(postValue('atestadoNeurologico'));
    $exame->setRaioxPulmao(postValue('raioxPulmao'));
    $exame->setReceituarioMedico(postValue('receituarioMedico'));

    $eliminacao = new Eliminacao();
    $eliminacao->setFrequenciaEvacuacao(postValue('frequenciaEvacuacao'));
    $eliminacao->setAspectoFezes(postValue('aspecto'));
    $eliminacao->setColoracaoUrina(postValue('coloracaoUrina'));
    $eliminacao->setOdorUrina(postValue('odorUrina'));
    $eliminacao->setFrequenciaUrina(postValue('frequenciaUrina'));
    $eliminacao->setQueixaGases(postValue('queixaGases'));
    $eliminacao->setUsaFralda(postValue('usoFraldaGeriatrica'));
    $eliminacao->setMarcaFralda(postValue('marcaFraldaGeriatrica'));

    $daoAntecedencia = new DaoAntecedencia();
    $daoQuestionamento = new DaoQuestionamento();
    $daoPele = new DaoPele();
    $daoPulmonar = new DaoPulmonar();
    $daoAlimentacao = new DaoAlimentacao();
    $daoLocomocao = new DaoLocomocao();
    $daoRelacionamento = new DaoRelacionamento();
    $daoExame = new DaoExame();
    $daoEliminacao = new DaoEliminacao();

    $idAntecedencia = $daoAntecedencia->insert($antecedencia);
    $idQuestionamento = $daoQuestionamento->insert($questionamento);
    $idPele = $daoPele->insert($pele);
    $idPulmonar = $daoPulmonar->insert($pulmonar);
    $idAlimentacao = $daoAlimentacao->insert($alimentacao);
    $idLocomocao = $daoLocomocao->insert($locomocao);
    $idRelacionamento = $daoRelacionamento->insert($relacionamento);
    $idExame = $daoExame->insert($exame);
    $idEliminacao = $daoEliminacao->insert($eliminacao);

    $prontuarioFixo = new ProntuarioFixo();
    $prontuarioFixo->setDataEmissao(date('d-m-Y'));
    $prontuarioFixo->setAntecedenciaId($idAntecedencia);
    $prontuarioFixo->setQuestionamentoId($idQuestionamento);
    $prontuarioFixo->setPeleId($idPele);
    $prontuarioFixo->setPulmonarId($idPulmonar);
    $prontuarioFixo->setAlimentacaoId($idAlimentacao);
    $prontuarioFixo->setLocomocaoId($idLocomocao);
    $prontuarioFixo->setRelacionamentoId($idRelacionamento);
    $prontuarioFixo->setExameId($idExame);
    $prontuarioFixo->setEliminacaoId($idEliminacao);

    $daoProntuario = new DaoProntuarioFixo();
    $idProntuarioFixo = $daoProntuario->insert($prontuarioFixo);

    // Associa o prontuário fixo criado ao idoso
    if (!empty($_POST['idoso_id'])) {
        $daoIdoso = new DaoIdoso();
        $idoso = $daoIdoso->getById($_POST['idoso_id']);
        $idoso->setProntuarioFixoId($idProntuarioFixo);
        $daoIdoso->update($idoso);
    }

    if ($idProntuarioFixo) {
        $_SESSION['msg'] = 'Prontuário cadastrado com sucesso.';
        header('Location: ../View/homeFuncionario.php');
        exit;
    }

    $_SESSION['msg'] = 'Não foi possível cadastrar o prontuário.';
    header('Location: ../View/cadastroProntuario.php');
    exit;
} catch (Exception $e) {
    $_SESSION['msg'] = 'Erro ao cadastrar prontuário: ' . $e->getMessage();
    header('Location: ../View/cadastroProntuario.php');
    exit;
}
?>