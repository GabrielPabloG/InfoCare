<?php

class ProntuarioFixo {
    private $id;
    private $dataEmissao;

    private $antecedenciaId;
    private $questionamentoId;
    private $peleId;
    private $pulmonarId;
    private $alimentacaoId;
    private $locomocaoId;
    private $relacionamentoId;
    private $exameId;
    private $eliminacaoId;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getDataEmissao() { return $this->dataEmissao; }
    public function setDataEmissao($dataEmissao) { $this->dataEmissao = $dataEmissao; }

    public function getAntecedenciaId() { return $this->antecedenciaId; }
    public function setAntecedenciaId($antecedenciaId) { $this->antecedenciaId = $antecedenciaId; }

    public function getQuestionamentoId() { return $this->questionamentoId; }
    public function setQuestionamentoId($questionamentoId) { $this->questionamentoId = $questionamentoId; }

    public function getPeleId() { return $this->peleId; }
    public function setPeleId($peleId) { $this->peleId = $peleId; }

    public function getPulmonarId() { return $this->pulmonarId; }
    public function setPulmonarId($pulmonarId) { $this->pulmonarId = $pulmonarId; }

    public function getAlimentacaoId() { return $this->alimentacaoId; }
    public function setAlimentacaoId($alimentacaoId) { $this->alimentacaoId = $alimentacaoId; }

    public function getLocomocaoId() { return $this->locomocaoId; }
    public function setLocomocaoId($locomocaoId) { $this->locomocaoId = $locomocaoId; }

    public function getRelacionamentoId() { return $this->relacionamentoId; }
    public function setRelacionamentoId($relacionamentoId) { $this->relacionamentoId = $relacionamentoId; }

    public function getExameId() { return $this->exameId; }
    public function setExameId($exameId) { $this->exameId = $exameId; }

    public function getEliminacaoId() { return $this->eliminacaoId; }
    public function setEliminacaoId($eliminacaoId) { $this->eliminacaoId = $eliminacaoId; }
}