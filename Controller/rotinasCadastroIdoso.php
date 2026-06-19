<?php
require_once '../View/verificacao.php';
require_once '../Dao/conexao.php';

// Acesso restrito
if ($_SESSION['user_tipo'] !== 'admin' && $_SESSION['user_tipo'] !== 'gerente') {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$conn = Conexao::getConexao();

try {
    $conn->beginTransaction();

// ==================== 1. PRONTUÁRIO FIXO (vazio) ====================
$conn->prepare("INSERT INTO prontuario_fixo (data_emissao) VALUES (NOW())")->execute();
$prontuarioId = $conn->lastInsertId();

// ==================== 2. IDOSO (já vinculado ao prontuário) ====================
$stmt = $conn->prepare("INSERT INTO idoso (nome, cpf, sexo, nascimento, responsavel_id, prontuario_fixo_id) 
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([
    $_POST['nomeIdoso'],
    $_POST['cpfIdoso'],
    $_POST['sexoIdoso'],
    $_POST['nascIdoso'],
    $_POST['codResponsavel'],
    $prontuarioId
]);
$idosoId = $conn->lastInsertId();

    // ==================== 3. AVALIAÇÕES ====================

    // 3.1 Antecedência
    $conn->prepare("INSERT INTO antecedencia (
                        declinio_cognitivo, dificuldade_fala, audicao, ave, tce,
                        hipertensao, hipotireoidismo, diabetes_tipo, cancer_tipo,
                        cirurgia_tipo, usa_medicamento, tratamento_realizado
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute([
        $_POST['declinioCongnitivo'] ?? 'Não',
        $_POST['dificuldadeFala'] ?? 'Não',
        $_POST['audicao'] ?? 'Sem Aparelho',
        $_POST['acidenteVascularEncefalico'] ?? 'Não',
        $_POST['traumatismoCranioEncefalico'] ?? 'Não',
        $_POST['hipertensaoArterial'] ?? 'Não',
        $_POST['hipotireoidismo'] ?? 'Não',
        $_POST['tipoDiabetes'] ?? 'Nenhum',
        $_POST['tipoCancer'] ?? 'Nenhum',
        $_POST['tipoCirurgia'] ?? 'Nenhuma',
        $_POST['usoMedicamento'] ?? 'Não',
        $_POST['tratamentoRealizado'] ?? 'Não'
    ]);
    $antecedenciaId = $conn->lastInsertId();

    // Medicamento (opcional)
    if (!empty($_POST['usoMedicamento']) && $_POST['usoMedicamento'] === 'Sim') {
        $conn->prepare("INSERT INTO medicamento (antecedencia_id, nome, dosagem, horario, posologia, composicao)
                        VALUES (?, ?, ?, ?, ?, ?)")->execute([
            $antecedenciaId,
            $_POST['nomeMedicamento'] ?? '',
            $_POST['dosagemMedicamento'] ?? '',
            $_POST['horarioMedicamento'] ?? '',
            $_POST['posologia'] ?? '',
            $_POST['composicaoMedicamento'] ?? ''
        ]);
    }

    // 3.2 Questionamento
    $conn->prepare("INSERT INTO questionamento (
                        usa_oculos, protese_auditiva, carteira_vacinacao, tabagista,
                        etilista, dependencia_etilismo, tipo_sanguineo, usa_protese_dentaria,
                        usa_medicamento_continuo, usa_substancia_psicoativa, alergia_medicamento,
                        convenio, encaminhamento_hospitalar, atividade_manual
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute([
        $_POST['utilizacaoOculos'] ?? 'Não',
        $_POST['proteseAuditiva'] ?? 'Não',
        $_POST['carteiraVacinacao'] ?? 'Não',
        $_POST['tabagista'] ?? 'Não',
        $_POST['etilista'] ?? 'Não',
        $_POST['dependenciaEtilismo'] ?? 'Não',
        $_POST['tipoSanguineo'] ?? 'AB+',
        $_POST['usoProteseDentaria'] ?? 'Não',
        $_POST['usoMedicamentoContinuo'] ?? 'Não',
        $_POST['usoSubstanciaPsicoativa'] ?? 'Não',
        $_POST['alergiaMedicamento'] ?? 'Não',
        $_POST['convenio'] ?? 'Não',
        $_POST['encaminhamentoUnidadeHospitalar'] ?? 'Não',
        $_POST['atividadeManual'] ?? 'Não'
    ]);
    $questionamentoId = $conn->lastInsertId();

    // 3.3 Pele
    $conn->prepare("INSERT INTO pele (
                        integridade, hidratacao, dermatite, prurido, micose_unha,
                        escamacao, ictericia, ferida, petequia, hematoma, ulcera
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute([
        $_POST['integridadePele'] ?? 'Não',
        $_POST['hidratacaoPele'] ?? 'Não',
        $_POST['dermatite'] ?? 'Não',
        $_POST['prurido'] ?? 'Não',
        $_POST['micoseUnha'] ?? 'Não',
        $_POST['escamacaoPele'] ?? 'Não',
        $_POST['ictericiaPele'] ?? 'Não',
        $_POST['feridaPele'] ?? 'Não',
        $_POST['petequiaPele'] ?? 'Não',
        $_POST['hematomaPele'] ?? 'Não',
        $_POST['ulceraPele'] ?? 'Não'
    ]);
    $peleId = $conn->lastInsertId();

    // 3.4 Pulmonar
    $conn->prepare("INSERT INTO pulmonar (tipo_tosse, auscultacao, tipo_dispneia)
                    VALUES (?, ?, ?)")->execute([
        $_POST['tipoTosse'] ?? 'Nenhuma',
        $_POST['ascultacao'] ?? 'Não',
        $_POST['tipoDispineia'] ?? 'Nenhum'
    ]);
    $pulmonarId = $conn->lastInsertId();

    // 3.5 Alimentação
    $conn->prepare("INSERT INTO alimentacao (
                        alimentacao_sozinho, dificuldade_degluticao, uso_sonda,
                        restricao_alimentar, preferencia_alimentar
                    ) VALUES (?, ?, ?, ?, ?)")->execute([
        $_POST['alimentacaoSolo'] ?? 'Não',
        $_POST['dificuldadeDegluticao'] ?? 'Não',
        $_POST['usoSonda'] ?? 'Não',
        $_POST['restricaoAlimento'] ?? 'Não',
        $_POST['preferenciaAlimento'] ?? 'Não'
    ]);
    $alimentacaoId = $conn->lastInsertId();

    // 3.6 Locomoção
    $conn->prepare("INSERT INTO locomocao (
                        locomocao_sozinho, cadeirante, acamado, apoio_fisico, esporte_terapia
                    ) VALUES (?, ?, ?, ?, ?)")->execute([
        $_POST['locomocaoSolo'] ?? 'Não',
        $_POST['cadeirante'] ?? 'Não',
        $_POST['acamacao'] ?? 'Não',
        $_POST['apoioFisico'] ?? 'Não',
        $_POST['esporteTerapia'] ?? 'Não'
    ]);
    $locomocaoId = $conn->lastInsertId();

    // 3.7 Relacionamento
    $conn->prepare("INSERT INTO relacionamento (
                        status_comunicacao, agressividade, temperamento,
                        anterioridade_casa_repouso, irritabilidade
                    ) VALUES (?, ?, ?, ?, ?)")->execute([
        $_POST['statusComunicacao'] ?? 'Não',
        $_POST['agressividade'] ?? 'Nenhuma',
        $_POST['temperamento'] ?? 'Colérico',
        $_POST['anterioridadeCasaRepouso'] ?? 'Não',
        $_POST['irritabilidade'] ?? 'Não'
    ]);
    $relacionamentoId = $conn->lastInsertId();

    // 3.8 Exame
    $conn->prepare("INSERT INTO exame (
                        hemograma_conclusao, urina_tipo, parasitologico_fezes,
                        glicemia_jejum, colesterol, hepatite_tipo, hiv, vdrl,
                        atestado_neurologico, raiox_pulmao, receituario_medico
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute([
        $_POST['conclusaoHemograma'] ?? 'Não',
        $_POST['tipoUrina'] ?? 'Urina amarelo escuro',
        $_POST['parasitologicoFezes'] ?? 'Não',
        $_POST['glicemiaJejum'] ?? 'Não',
        $_POST['colesterol'] ?? 'Alto',
        $_POST['tipoHepatite'] ?? 'Nenhum',
        $_POST['hiv'] ?? 'Não',
        $_POST['vdrl'] ?? 'Não',
        $_POST['atestadoNeurologico'] ?? 'Não',
        $_POST['raioxPulmao'] ?? 'Não',
        $_POST['receituarioMedico'] ?? 'Não'
    ]);
    $exameId = $conn->lastInsertId();

    // 3.9 Eliminação
    $conn->prepare("INSERT INTO eliminacao (
                        frequencia_evacuacao, aspecto_fezes, coloracao_urina,
                        odor_urina, frequencia_urina, queixa_gases,
                        usa_fralda, marca_fralda
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")->execute([
        $_POST['frequenciaEvacuacao'] ?? 'Pouco',
        $_POST['aspecto'] ?? 'Tipo 1',
        $_POST['coloracaoUrina'] ?? 'Amarelo escuro',
        $_POST['odorUrina'] ?? 'Não',
        $_POST['frequenciaUrina'] ?? 'Pouco',
        $_POST['queixaGases'] ?? 'Não',
        $_POST['usoFraldaGeriatrica'] ?? 'Não',
        $_POST['marcaFraldaGeriatrica'] ?? ''
    ]);
    $eliminacaoId = $conn->lastInsertId();

    // ==================== 4. VINCULAR TUDO AO PRONTUÁRIO ====================
    $conn->prepare("UPDATE prontuario_fixo SET
                        antecedencia_id = ?, questionamento_id = ?, pele_id = ?,
                        pulmonar_id = ?, alimentacao_id = ?, locomocao_id = ?,
                        relacionamento_id = ?, exame_id = ?, eliminacao_id = ?
                    WHERE id = ?")->execute([
        $antecedenciaId, $questionamentoId, $peleId,
        $pulmonarId, $alimentacaoId, $locomocaoId,
        $relacionamentoId, $exameId, $eliminacaoId,
        $prontuarioId
    ]);

    // ==================== 5. FOTO (OPCIONAL) ====================
    if (!empty($_FILES['foto']['name'])) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $novoNome = md5(uniqid(rand(), true)) . '.' . $ext;
            $diretorio = '../upload/';
            if (!is_dir($diretorio)) mkdir($diretorio, 0755, true);
            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $novoNome);
            $conn->prepare("INSERT INTO foto (entidade_tipo, entidade_id, nome_arquivo, data_foto)
                            VALUES ('idoso', ?, ?, NOW())")->execute([$idosoId, $novoNome]);
        }
    }

    $conn->commit();
    header('Location: ../View/listarRes.php?sucesso=1');
    exit;

} catch (Exception $e) {
    $conn->rollBack();
     //debug: echo $e->getMessage(); exit;
    header('Location: ../View/homeGerente.php?erro=1');
    exit;
}