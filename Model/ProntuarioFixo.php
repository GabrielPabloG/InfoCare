<?php
    class ProntuarioFixo {
        private $codProntuarioFixo;
        private $dataEmissaoProntuarioFixo;
        
        private $declinioCongnitivo;
        private $dificuldadeFala;
        private $audicao;
        private $acidenteVascularEncefalico;
        private $traumatismoCranioEncefalico;
        private $hipertensaoArterial;
        private $hipotireoidismo;
        private $tipoDiabetes;
        private $tipoCancer;
        private $localFratura;
        private $tipoCirugia;
        private $outrasPatologias;
        private $usoMedicamento;
        private $tratamentoRealizado;
        
        private $peso;
        private $altura;
        private $pressaoArterial;
        private $pulsacao;
        private $respiracao;
        private $temperatura;
        private $dextro;
        private $spo2;
        private $utilizacaoOculos;
        private $proteseAuditiva;
        private $carteiraVacinacao;
        private $tabagista;
        private $etilista;
        private $depenciaEtilismo;
        private $tipoSanguineo;
        private $usoProteseDentaria;
        private $marcaProteseDentaria;
        private $modeloProteseDentaria;
        private $usoMedicamentoContinuo;
        private $usoSubstanciaPsicoativa;
        private $alergiaMedicamento;
        private $convenio;
        private $encaminhamentoUnidadeHospitalar;
        private $atividadeManual;
        
        private $integridadePele;
        private $hidratacaoPele;
        private $dermatite;
        private $prurido;
        private $micoseUnha;
        private $escamacaoPele;
        private $ictericiaPele;
        private $feridaPele;
        private $petequiaPele;
        private $hematomaPele;
        private $ulceraPele;
        private $grauUlcera;
        private $outraEspecificacao;
        
        private $tipoTosse;
        private $ascultacao;
        private $tipoDispineia;
        
        private $alimentacaoSolo;
        private $dificuldadeDegluticao;
        private $usoSonda;
        private $restricaoAlimento;
        private $preferenciaAlimento;
        
        private $locomocaoSolo;
        private $cadeirante;
        private $tempoCadeirante;
        private $acamacao;
        private $tempoAcamacao;
        private $apoioFisico;
        private $esporteTerapia;
        
        private $statusComunicacao;
        private $agressividade;
        private $temperamento;
        private $anterioridadeCasaRepouso;
        private $irritabilidade;
        
        private $conclusaoHemograma;
        private $tipoUrina;
        private $parasitologicoFezes;
        private $glicemiaJejum;
        private $colesterol;
        private $tipoHepatite;
        private $hiv;
        private $vdrl;
        private $atestadoNeurologico;
        private $raioXPulmao;
        private $receituarioMedico;
        
        private $frequenciaEvacuacao;
        private $aspectoFezes;
        private $coloracaoUrina;
        private $odorUrina;
        private $frequenciaUrina;
        private $queixaGases;
        private $usoFraldaGeriatrica;
        private $marcaFraldaGeriatrica;
        
       
        		public function getCodProntuarioFixo(){
		return $this->codProntuarioFixo;
	}

	public function setCodProntuarioFixo($codProntuarioFixo){
		$this->codProntuarioFixo = $codProntuarioFixo;
	}

	public function getDataEmissaoProntuarioFixo(){
		return $this->dataEmissaoProntuarioFixo;
	}

	public function setDataEmissaoProntuarioFixo($dataEmissaoProntuarioFixo){
		$this->dataEmissaoProntuarioFixo = $dataEmissaoProntuarioFixo;
	}

	public function getDeclinioCongnitivo(){
		return $this->declinioCongnitivo;
	}

	public function setDeclinioCongnitivo($declinioCongnitivo){
		$this->declinioCongnitivo = $declinioCongnitivo;
	}

	public function getDificuldadeFala(){
		return $this->dificuldadeFala;
	}

	public function setDificuldadeFala($dificuldadeFala){
		$this->dificuldadeFala = $dificuldadeFala;
	}

	public function getAudicao(){
		return $this->audicao;
	}

	public function setAudicao($audicao){
		$this->audicao = $audicao;
	}

	public function getAcidenteVascularEncefalico(){
		return $this->acidenteVascularEncefalico;
	}

	public function setAcidenteVascularEncefalico($acidenteVascularEncefalico){
		$this->acidenteVascularEncefalico = $acidenteVascularEncefalico;
	}

	public function getTraumatismoCranioEncefalico(){
		return $this->traumatismoCranioEncefalico;
	}

	public function setTraumatismoCranioEncefalico($traumatismoCranioEncefalico){
		$this->traumatismoCranioEncefalico = $traumatismoCranioEncefalico;
	}

	public function getHipertensaoArterial(){
		return $this->hipertensaoArterial;
	}

	public function setHipertensaoArterial($hipertensaoArterial){
		$this->hipertensaoArterial = $hipertensaoArterial;
	}

	public function getHipotireoidismo(){
		return $this->hipotireoidismo;
	}

	public function setHipotireoidismo($hipotireoidismo){
		$this->hipotireoidismo = $hipotireoidismo;
	}

	public function getTipoDiabetes(){
		return $this->tipoDiabetes;
	}

	public function setTipoDiabetes($tipoDiabetes){
		$this->tipoDiabetes = $tipoDiabetes;
	}

	public function getTipoCancer(){
		return $this->tipoCancer;
	}

	public function setTipoCancer($tipoCancer){
		$this->tipoCancer = $tipoCancer;
	}

	public function getLocalFratura(){
		return $this->localFratura;
	}

	public function setLocalFratura($localFratura){
		$this->localFratura = $localFratura;
	}

	public function getTipoCirugia(){
		return $this->tipoCirugia;
	}

	public function setTipoCirugia($tipoCirugia){
		$this->tipoCirugia = $tipoCirugia;
	}

	public function getOutrasPatologias(){
		return $this->outrasPatologias;
	}

	public function setOutrasPatologias($outrasPatologias){
		$this->outrasPatologias = $outrasPatologias;
	}

	public function getUsoMedicamento(){
		return $this->usoMedicamento;
	}

	public function setUsoMedicamento($usoMedicamento){
		$this->usoMedicamento = $usoMedicamento;
	}

	public function getTratamentoRealizado(){
		return $this->tratamentoRealizado;
	}

	public function setTratamentoRealizado($tratamentoRealizado){
		$this->tratamentoRealizado = $tratamentoRealizado;
	}

	public function getPeso(){
		return $this->peso;
	}

	public function setPeso($peso){
		$this->peso = $peso;
	}

	public function getAltura(){
		return $this->altura;
	}

	public function setAltura($altura){
		$this->altura = $altura;
	}

	public function getPressaoArterial(){
		return $this->pressaoArterial;
	}

	public function setPressaoArterial($pressaoArterial){
		$this->pressaoArterial = $pressaoArterial;
	}

	public function getPulsacao(){
		return $this->pulsacao;
	}

	public function setPulsacao($pulsacao){
		$this->pulsacao = $pulsacao;
	}

	public function getRespiracao(){
		return $this->respiracao;
	}

	public function setRespiracao($respiracao){
		$this->respiracao = $respiracao;
	}

	public function getTemperatura(){
		return $this->temperatura;
	}

	public function setTemperatura($temperatura){
		$this->temperatura = $temperatura;
	}

	public function getDextro(){
		return $this->dextro;
	}

	public function setDextro($dextro){
		$this->dextro = $dextro;
	}

	public function getSpo2(){
		return $this->spo2;
	}

	public function setSpo2($spo2){
		$this->spo2 = $spo2;
	}

	public function getUtilizacaoOculos(){
		return $this->utilizacaoOculos;
	}

	public function setUtilizacaoOculos($utilizacaoOculos){
		$this->utilizacaoOculos = $utilizacaoOculos;
	}

	public function getProteseAuditiva(){
		return $this->proteseAuditiva;
	}

	public function setProteseAuditiva($proteseAuditiva){
		$this->proteseAuditiva = $proteseAuditiva;
	}

	public function getCarteiraVacinacao(){
		return $this->carteiraVacinacao;
	}

	public function setCarteiraVacinacao($carteiraVacinacao){
		$this->carteiraVacinacao = $carteiraVacinacao;
	}

	public function getTabagista(){
		return $this->tabagista;
	}

	public function setTabagista($tabagista){
		$this->tabagista = $tabagista;
	}

	public function getEtilista(){
		return $this->etilista;
	}

	public function setEtilista($etilista){
		$this->etilista = $etilista;
	}

	public function getDepenciaEtilismo(){
		return $this->depenciaEtilismo;
	}

	public function setDepenciaEtilismo($depenciaEtilismo){
		$this->depenciaEtilismo = $depenciaEtilismo;
	}

	public function getTipoSanguineo(){
		return $this->tipoSanguineo;
	}

	public function setTipoSanguineo($tipoSanguineo){
		$this->tipoSanguineo = $tipoSanguineo;
	}

	public function getUsoProteseDentaria(){
		return $this->usoProteseDentaria;
	}

	public function setUsoProteseDentaria($usoProteseDentaria){
		$this->usoProteseDentaria = $usoProteseDentaria;
	}

	public function getMarcaProteseDentaria(){
		return $this->marcaProteseDentaria;
	}

	public function setMarcaProteseDentaria($marcaProteseDentaria){
		$this->marcaProteseDentaria = $marcaProteseDentaria;
	}

	public function getModeloProteseDentaria(){
		return $this->modeloProteseDentaria;
	}

	public function setModeloProteseDentaria($modeloProteseDentaria){
		$this->modeloProteseDentaria = $modeloProteseDentaria;
	}

	public function getUsoMedicamentoContinuo(){
		return $this->usoMedicamentoContinuo;
	}

	public function setUsoMedicamentoContinuo($usoMedicamentoContinuo){
		$this->usoMedicamentoContinuo = $usoMedicamentoContinuo;
	}

	public function getUsoSubstanciaPsicoativa(){
		return $this->usoSubstanciaPsicoativa;
	}

	public function setUsoSubstanciaPsicoativa($usoSubstanciaPsicoativa){
		$this->usoSubstanciaPsicoativa = $usoSubstanciaPsicoativa;
	}

	public function getAlergiaMedicamento(){
		return $this->alergiaMedicamento;
	}

	public function setAlergiaMedicamento($alergiaMedicamento){
		$this->alergiaMedicamento = $alergiaMedicamento;
	}

	public function getConvenio(){
		return $this->convenio;
	}

	public function setConvenio($convenio){
		$this->convenio = $convenio;
	}

	public function getEncaminhamentoUnidadeHospitalar(){
		return $this->encaminhamentoUnidadeHospitalar;
	}

	public function setEncaminhamentoUnidadeHospitalar($encaminhamentoUnidadeHospitalar){
		$this->encaminhamentoUnidadeHospitalar = $encaminhamentoUnidadeHospitalar;
	}

	public function getAtividadeManual(){
		return $this->atividadeManual;
	}

	public function setAtividadeManual($atividadeManual){
		$this->atividadeManual = $atividadeManual;
	}

	public function getIntegridadePele(){
		return $this->integridadePele;
	}

	public function setIntegridadePele($integridadePele){
		$this->integridadePele = $integridadePele;
	}

	public function getHidratacaoPele(){
		return $this->hidratacaoPele;
	}

	public function setHidratacaoPele($hidratacaoPele){
		$this->hidratacaoPele = $hidratacaoPele;
	}

	public function getDermatite(){
		return $this->dermatite;
	}

	public function setDermatite($dermatite){
		$this->dermatite = $dermatite;
	}

	public function getPrurido(){
		return $this->prurido;
	}

	public function setPrurido($prurido){
		$this->prurido = $prurido;
	}

	public function getMicoseUnha(){
		return $this->micoseUnha;
	}

	public function setMicoseUnha($micoseUnha){
		$this->micoseUnha = $micoseUnha;
	}

	public function getEscamacaoPele(){
		return $this->escamacaoPele;
	}

	public function setEscamacaoPele($escamacaoPele){
		$this->escamacaoPele = $escamacaoPele;
	}

	public function getIctericiaPele(){
		return $this->ictericiaPele;
	}

	public function setIctericiaPele($ictericiaPele){
		$this->ictericiaPele = $ictericiaPele;
	}

	public function getFeridaPele(){
		return $this->feridaPele;
	}

	public function setFeridaPele($feridaPele){
		$this->feridaPele = $feridaPele;
	}

	public function getPetequiaPele(){
		return $this->petequiaPele;
	}

	public function setPetequiaPele($petequiaPele){
		$this->petequiaPele = $petequiaPele;
	}

	public function getHematomaPele(){
		return $this->hematomaPele;
	}

	public function setHematomaPele($hematomaPele){
		$this->hematomaPele = $hematomaPele;
	}

	public function getUlceraPele(){
		return $this->ulceraPele;
	}

	public function setUlceraPele($ulceraPele){
		$this->ulceraPele = $ulceraPele;
	}

	public function getGrauUlcera(){
		return $this->grauUlcera;
	}

	public function setGrauUlcera($grauUlcera){
		$this->grauUlcera = $grauUlcera;
	}

	public function getOutraEspecificacao(){
		return $this->outraEspecificacao;
	}

	public function setOutraEspecificacao($outraEspecificacao){
		$this->outraEspecificacao = $outraEspecificacao;
	}

	public function getTipoTosse(){
		return $this->tipoTosse;
	}

	public function setTipoTosse($tipoTosse){
		$this->tipoTosse = $tipoTosse;
	}

	public function getAscultacao(){
		return $this->ascultacao;
	}

	public function setAscultacao($ascultacao){
		$this->ascultacao = $ascultacao;
	}

	public function getTipoDispineia(){
		return $this->tipoDispineia;
	}

	public function setTipoDispineia($tipoDispineia){
		$this->tipoDispineia = $tipoDispineia;
	}

	public function getAlimentacaoSolo(){
		return $this->alimentacaoSolo;
	}

	public function setAlimentacaoSolo($alimentacaoSolo){
		$this->alimentacaoSolo = $alimentacaoSolo;
	}

	public function getDificuldadeDegluticao(){
		return $this->dificuldadeDegluticao;
	}

	public function setDificuldadeDegluticao($dificuldadeDegluticao){
		$this->dificuldadeDegluticao = $dificuldadeDegluticao;
	}

	public function getUsoSonda(){
		return $this->usoSonda;
	}

	public function setUsoSonda($usoSonda){
		$this->usoSonda = $usoSonda;
	}

	public function getRestricaoAlimento(){
		return $this->restricaoAlimento;
	}

	public function setRestricaoAlimento($restricaoAlimento){
		$this->restricaoAlimento = $restricaoAlimento;
	}

	public function getPreferenciaAlimento(){
		return $this->preferenciaAlimento;
	}

	public function setPreferenciaAlimento($preferenciaAlimento){
		$this->preferenciaAlimento = $preferenciaAlimento;
	}

	public function getLocomocaoSolo(){
		return $this->locomocaoSolo;
	}

	public function setLocomocaoSolo($locomocaoSolo){
		$this->locomocaoSolo = $locomocaoSolo;
	}

	public function getCadeirante(){
		return $this->cadeirante;
	}

	public function setCadeirante($cadeirante){
		$this->cadeirante = $cadeirante;
	}

	public function getTempoCadeirante(){
		return $this->tempoCadeirante;
	}

	public function setTempoCadeirante($tempoCadeirante){
		$this->tempoCadeirante = $tempoCadeirante;
	}

	public function getAcamacao(){
		return $this->acamacao;
	}

	public function setAcamacao($acamacao){
		$this->acamacao = $acamacao;
	}

	public function getTempoAcamacao(){
		return $this->tempoAcamacao;
	}

	public function setTempoAcamacao($tempoAcamacao){
		$this->tempoAcamacao = $tempoAcamacao;
	}

	public function getApoioFisico(){
		return $this->apoioFisico;
	}

	public function setApoioFisico($apoioFisico){
		$this->apoioFisico = $apoioFisico;
	}

	public function getEsporteTerapia(){
		return $this->esporteTerapia;
	}

	public function setEsporteTerapia($esporteTerapia){
		$this->esporteTerapia = $esporteTerapia;
	}

	public function getStatusComunicacao(){
		return $this->statusComunicacao;
	}

	public function setStatusComunicacao($statusComunicacao){
		$this->statusComunicacao = $statusComunicacao;
	}

	public function getAgressividade(){
		return $this->agressividade;
	}

	public function setAgressividade($agressividade){
		$this->agressividade = $agressividade;
	}

	public function getTemperamento(){
		return $this->temperamento;
	}

	public function setTemperamento($temperamento){
		$this->temperamento = $temperamento;
	}

	public function getAnterioridadeCasaRepouso(){
		return $this->anterioridadeCasaRepouso;
	}

	public function setAnterioridadeCasaRepouso($anterioridadeCasaRepouso){
		$this->anterioridadeCasaRepouso = $anterioridadeCasaRepouso;
	}

	public function getIrritabilidade(){
		return $this->irritabilidade;
	}

	public function setIrritabilidade($irritabilidade){
		$this->irritabilidade = $irritabilidade;
	}

	public function getConclusaoHemograma(){
		return $this->conclusaoHemograma;
	}

	public function setConclusaoHemograma($conclusaoHemograma){
		$this->conclusaoHemograma = $conclusaoHemograma;
	}

	public function getTipoUrina(){
		return $this->tipoUrina;
	}

	public function setTipoUrina($tipoUrina){
		$this->tipoUrina = $tipoUrina;
	}

	public function getParasitologicoFezes(){
		return $this->parasitologicoFezes;
	}

	public function setParasitologicoFezes($parasitologicoFezes){
		$this->parasitologicoFezes = $parasitologicoFezes;
	}

	public function getGlicemiaJejum(){
		return $this->glicemiaJejum;
	}

	public function setGlicemiaJejum($glicemiaJejum){
		$this->glicemiaJejum = $glicemiaJejum;
	}

	public function getColesterol(){
		return $this->colesterol;
	}

	public function setColesterol($colesterol){
		$this->colesterol = $colesterol;
	}

	public function getTipoHepatite(){
		return $this->tipoHepatite;
	}

	public function setTipoHepatite($tipoHepatite){
		$this->tipoHepatite = $tipoHepatite;
	}

	public function getHiv(){
		return $this->hiv;
	}

	public function setHiv($hiv){
		$this->hiv = $hiv;
	}

	public function getVdrl(){
		return $this->vdrl;
	}

	public function setVdrl($vdrl){
		$this->vdrl = $vdrl;
	}

	public function getAtestadoNeurologico(){
		return $this->atestadoNeurologico;
	}

	public function setAtestadoNeurologico($atestadoNeurologico){
		$this->atestadoNeurologico = $atestadoNeurologico;
	}

	public function getRaioXPulmao(){
		return $this->raioXPulmao;
	}

	public function setRaioXPulmao($raioXPulmao){
		$this->raioXPulmao = $raioXPulmao;
	}

	public function getReceituarioMedico(){
		return $this->receituarioMedico;
	}

	public function setReceituarioMedico($receituarioMedico){
		$this->receituarioMedico = $receituarioMedico;
	}

	public function getFrequenciaEvacuacao(){
		return $this->frequenciaEvacuacao;
	}

	public function setFrequenciaEvacuacao($frequenciaEvacuacao){
		$this->frequenciaEvacuacao = $frequenciaEvacuacao;
	}

	public function getAspectoFezes(){
		return $this->aspectoFezes;
	}

	public function setAspectoFezes($aspectoFezes){
		$this->aspectoFezes = $aspectoFezes;
	}

	public function getColoracaoUrina(){
		return $this->coloracaoUrina;
	}

	public function setColoracaoUrina($coloracaoUrina){
		$this->coloracaoUrina = $coloracaoUrina;
	}

	public function getOdorUrina(){
		return $this->odorUrina;
	}

	public function setOdorUrina($odorUrina){
		$this->odorUrina = $odorUrina;
	}

	public function getFrequenciaUrina(){
		return $this->frequenciaUrina;
	}

	public function setFrequenciaUrina($frequenciaUrina){
		$this->frequenciaUrina = $frequenciaUrina;
	}

	public function getQueixaGases(){
		return $this->queixaGases;
	}

	public function setQueixaGases($queixaGases){
		$this->queixaGases = $queixaGases;
	}

	public function getUsoFraldaGeriatrica(){
		return $this->usoFraldaGeriatrica;
	}

	public function setUsoFraldaGeriatrica($usoFraldaGeriatrica){
		$this->usoFraldaGeriatrica = $usoFraldaGeriatrica;
	}

	public function getMarcaFraldaGeriatrica(){
		return $this->marcaFraldaGeriatrica;
	}

	public function setMarcaFraldaGeriatrica($marcaFraldaGeriatrica){
		$this->marcaFraldaGeriatrica = $marcaFraldaGeriatrica;
	}
        
}
?>