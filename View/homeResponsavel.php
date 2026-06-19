<?php
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// Apenas responsáveis acessam esta página
if ($_SESSION['user_tipo'] !== 'responsavel') {
    switch ($_SESSION['user_tipo']) {
        case 'admin':
            header('Location: homeAdm.php');
            break;
        case 'gerente':
            header('Location: homeGerente.php');
            break;
        case 'funcionario':
            header('Location: homeFuncionario.php');
            break;
        default:
            session_destroy();
            header('Location: ../index.php');
    }
    exit;
}

// Foto de perfil via sessão (definida no verificacao.php)
$imgPerfil = $_SESSION['foto_perfil'] ?? '../upload/user.png';

// Busca os idosos vinculados a este responsável, com dados completos do prontuário para o modal
$sqlIdosos = "
    SELECT
        i.id,
        i.nome,
        i.sexo,
        i.cpf,
        i.nascimento,
        -- Responsável (já é o logado, mas podemos exibir o nome)
        r.nome AS nomeResponsavel,
        -- Antecedência
        ant.declinio_cognitivo,
        ant.dificuldade_fala,
        ant.audicao,
        ant.ave,
        ant.tce,
        ant.hipertensao,
        ant.hipotireoidismo,
        ant.diabetes_tipo,
        ant.cancer_tipo,
        ant.local_fratura,
        ant.cirurgia_tipo,
        ant.outras_patologias,
        ant.usa_medicamento,
        ant.tratamento_realizado,
        -- Questionamento
        q.peso,
        q.altura,
        q.pressao_arterial,
        q.pulsacao,
        q.respiracao,
        q.temperatura,
        q.dextro,
        q.spo2,
        q.usa_oculos,
        q.protese_auditiva,
        q.carteira_vacinacao,
        q.tabagista,
        q.etilista,
        q.dependencia_etilismo,
        q.tipo_sanguineo,
        q.usa_protese_dentaria,
        q.marca_protese,
        q.modelo_protese,
        q.usa_medicamento_continuo,
        q.usa_substancia_psicoativa,
        q.alergia_medicamento,
        q.convenio,
        q.encaminhamento_hospitalar,
        q.atividade_manual,
        -- Pele
        pel.integridade,
        pel.hidratacao,
        pel.dermatite,
        pel.prurido,
        pel.micose_unha,
        pel.escamacao,
        pel.ictericia,
        pel.ferida,
        pel.petequia,
        pel.hematoma,
        pel.ulcera,
        pel.grau_ulcera,
        pel.outra_especificacao,
        -- Pulmonar
        pul.tipo_tosse,
        pul.auscultacao,
        pul.tipo_dispneia,
        -- Alimentação
        ali.alimentacao_sozinho,
        ali.dificuldade_degluticao,
        ali.uso_sonda,
        ali.restricao_alimentar,
        ali.preferencia_alimentar,
        -- Locomoção
        loc.locomocao_sozinho,
        loc.cadeirante,
        loc.tempo_cadeirante,
        loc.acamado,
        loc.tempo_acamado,
        loc.apoio_fisico,
        loc.esporte_terapia,
        -- Relacionamento
        rel.status_comunicacao,
        rel.agressividade,
        rel.temperamento,
        rel.anterioridade_casa_repouso,
        rel.irritabilidade,
        -- Exame
        exa.hemograma_conclusao,
        exa.urina_tipo,
        exa.parasitologico_fezes,
        exa.glicemia_jejum,
        exa.colesterol,
        exa.hepatite_tipo,
        exa.hiv,
        exa.vdrl,
        exa.atestado_neurologico,
        exa.raiox_pulmao,
        exa.receituario_medico,
        -- Eliminação
        eli.frequencia_evacuacao,
        eli.aspecto_fezes,
        eli.coloracao_urina,
        eli.odor_urina,
        eli.frequencia_urina,
        eli.queixa_gases,
        eli.usa_fralda,
        eli.marca_fralda
    FROM idoso i
    INNER JOIN responsavel r ON i.responsavel_id = r.id
    LEFT JOIN prontuario_fixo pf ON i.prontuario_fixo_id = pf.id
    LEFT JOIN antecedencia ant ON pf.antecedencia_id = ant.id
    LEFT JOIN questionamento q ON pf.questionamento_id = q.id
    LEFT JOIN pele pel ON pf.pele_id = pel.id
    LEFT JOIN pulmonar pul ON pf.pulmonar_id = pul.id
    LEFT JOIN alimentacao ali ON pf.alimentacao_id = ali.id
    LEFT JOIN locomocao loc ON pf.locomocao_id = loc.id
    LEFT JOIN relacionamento rel ON pf.relacionamento_id = rel.id
    LEFT JOIN exame exa ON pf.exame_id = exa.id
    LEFT JOIN eliminacao eli ON pf.eliminacao_id = eli.id
    WHERE i.responsavel_id = ?
    ORDER BY i.nome ASC
";
$stmt = $conn->prepare($sqlIdosos);
$stmt->execute([$_SESSION['user_id']]);
$resultado_idoso = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalIdosos = count($resultado_idoso);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Meus Familiares</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/adm.css">
    <link rel="stylesheet" href="../cssModal/css/bootstrap.min.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
</head>
<body>

<!-- ════════════ SIDEBAR ════════════ -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="../img/infocare branco.png" alt="InfoCare">
    </div>

    <div class="sidebar-profile">
        <img src="<?= $imgPerfil ?>" alt="Foto" class="sidebar-avatar">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">
                <?= htmlspecialchars($_SESSION['user_nome'] ?? 'Responsável') ?>
            </div>
            <div class="sidebar-profile-role">Familiar</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <span class="sidebar-section-label">Meus Familiares</span>
        <a href="homeResponsavel.php" class="sidebar-link active">
            <i class="icon">⊞</i> Pacientes
        </a>

        <span class="sidebar-section-label">Conta</span>
        <a href="atualizarResponsavel.php" class="sidebar-link">
            <i class="icon">👤</i> Meus dados
        </a>
        <form action="../Controller/atualizarFoto.php" method="post" enctype="multipart/form-data" id="formFoto">
            <input type="file" name="foto" id="inputFoto" style="display: none;" accept="image/*">
            <label for="inputFoto" class="sidebar-link" style="cursor: pointer; margin-bottom: 0;">
                <i class="icon">◎</i> Atualizar foto
            </label>
        </form>
    </nav>

    <div class="sidebar-footer">
        <a href="../View/logout.php" class="sidebar-link">
            <i class="icon">↩</i> Sair
        </a>
    </div>
</aside>

<div class="sidebar-overlay" id="overlay"></div>

<!-- ════════════ CONTEÚDO PRINCIPAL ════════════ -->
<div class="main-wrapper">
    <header class="topbar">
        <div class="d-flex align-center gap-2">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Menu">☰</button>
            <span class="topbar-title">Painel do Responsável</span>
        </div>
    </header>

    <main class="page-content">
        <!-- KPIs -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Familiares na Clínica</div>
                <div class="stat-value"><?= $totalIdosos ?></div>
            </div>
        </div>

        <!-- Alertas -->
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success">Operação realizada com sucesso.</div>
        <?php endif; ?>
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger">Ocorreu um erro. Tente novamente.</div>
        <?php endif; ?>

        <!-- Tabela de pacientes -->
        <div class="card">
            <div class="card-header">
                <span class="card-header-title">Meus Familiares</span>
                <!-- Responsável não cadastra idoso, então sem botão de adicionar -->
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($resultado_idoso)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center; color:var(--text-muted); padding:40px;">
                                Nenhum familiar vinculado à sua conta.
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($resultado_idoso as $idoso): ?>
                        <tr>
                            <td class="text-muted"><?= $idoso['id'] ?></td>
                            <td><strong><?= htmlspecialchars($idoso['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($idoso['cpf']) ?></td>
                            <td>
                                <div class="actions">
                                    <button class="btn-ver" data-toggle="modal" data-target="#modalVer<?= $idoso['id'] ?>">👁 Ver</button>
                                    <a href="visualizarProntuario.php?id=<?= $idoso['id'] ?>" class="btn btn-primary btn-sm">📋 Prontuário</a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal com dados completos do prontuário -->
                        <div class="modal fade" id="modalVer<?= $idoso['id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= htmlspecialchars($idoso['nome']) ?></h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                        <p><strong>Código:</strong> <?= $idoso['id'] ?></p>
                                        <p><strong>Nome:</strong> <?= htmlspecialchars($idoso['nome']) ?></p>
                                        <p><strong>Sexo:</strong> <?= htmlspecialchars($idoso['sexo']) ?></p>
                                        <p><strong>Nascimento:</strong> <?= date('d/m/Y', strtotime($idoso['nascimento'])) ?></p>
                                        <p><strong>Responsável:</strong> <?= htmlspecialchars($idoso['nomeResponsavel']) ?></p>
                                        <hr>
                                        <h6>Antecedência</h6>
                                        <p>Declínio Cognitivo: <?= htmlspecialchars($idoso['declinio_cognitivo']) ?>; Dificuldade Fala: <?= htmlspecialchars($idoso['dificuldade_fala']) ?>; Audição: <?= htmlspecialchars($idoso['audicao']) ?>; AVE: <?= htmlspecialchars($idoso['ave']) ?>; TCE: <?= htmlspecialchars($idoso['tce']) ?>; Hipertensão: <?= htmlspecialchars($idoso['hipertensao']) ?>; Hipotireoidismo: <?= htmlspecialchars($idoso['hipotireoidismo']) ?>; Diabetes: <?= htmlspecialchars($idoso['diabetes_tipo']) ?>; Câncer: <?= htmlspecialchars($idoso['cancer_tipo']) ?>; Fratura: <?= htmlspecialchars($idoso['local_fratura']) ?>; Cirurgia: <?= htmlspecialchars($idoso['cirurgia_tipo']) ?>; Outras patologias: <?= htmlspecialchars($idoso['outras_patologias']) ?>; Medicamento: <?= htmlspecialchars($idoso['usa_medicamento']) ?>; Tratamento: <?= htmlspecialchars($idoso['tratamento_realizado']) ?></p>
                                        <h6>Questionamento</h6>
                                        <p>Peso: <?= $idoso['peso'] ?> kg; Altura: <?= $idoso['altura'] ?> m; PA: <?= htmlspecialchars($idoso['pressao_arterial']) ?>; Pulsação: <?= $idoso['pulsacao'] ?> bpm; Respiração: <?= $idoso['respiracao'] ?> irpm; Temperatura: <?= $idoso['temperatura'] ?> °C; Dextro: <?= $idoso['dextro'] ?> mg/dL; SpO2: <?= $idoso['spo2'] ?>%; Óculos: <?= htmlspecialchars($idoso['usa_oculos']) ?>; Prótese Auditiva: <?= htmlspecialchars($idoso['protese_auditiva']) ?>; Vacinação: <?= htmlspecialchars($idoso['carteira_vacinacao']) ?>; Tabagista: <?= htmlspecialchars($idoso['tabagista']) ?>; Etilista: <?= htmlspecialchars($idoso['etilista']) ?>; Dependência: <?= htmlspecialchars($idoso['dependencia_etilismo']) ?>; Tipo Sanguíneo: <?= htmlspecialchars($idoso['tipo_sanguineo']) ?>; Prótese Dentária: <?= htmlspecialchars($idoso['usa_protese_dentaria']) ?>; Marca/Modelo: <?= htmlspecialchars($idoso['marca_protese'] . ' / ' . $idoso['modelo_protese']) ?>; Medicamento Contínuo: <?= htmlspecialchars($idoso['usa_medicamento_continuo']) ?>; Substância Psicoativa: <?= htmlspecialchars($idoso['usa_substancia_psicoativa']) ?>; Alergia: <?= htmlspecialchars($idoso['alergia_medicamento']) ?>; Convênio: <?= htmlspecialchars($idoso['convenio']) ?>; Encaminhamento: <?= htmlspecialchars($idoso['encaminhamento_hospitalar']) ?>; Atividade Manual: <?= htmlspecialchars($idoso['atividade_manual']) ?></p>
                                        <h6>Pele</h6>
                                        <p>Integridade: <?= htmlspecialchars($idoso['integridade']) ?>; Hidratação: <?= htmlspecialchars($idoso['hidratacao']) ?>; Dermatite: <?= htmlspecialchars($idoso['dermatite']) ?>; Prurido: <?= htmlspecialchars($idoso['prurido']) ?>; Micose Unha: <?= htmlspecialchars($idoso['micose_unha']) ?>; Escamação: <?= htmlspecialchars($idoso['escamacao']) ?>; Icterícia: <?= htmlspecialchars($idoso['ictericia']) ?>; Ferida: <?= htmlspecialchars($idoso['ferida']) ?>; Petéquia: <?= htmlspecialchars($idoso['petequia']) ?>; Hematoma: <?= htmlspecialchars($idoso['hematoma']) ?>; Úlcera: <?= htmlspecialchars($idoso['ulcera']) ?> (Grau: <?= htmlspecialchars($idoso['grau_ulcera']) ?>); Especificação: <?= htmlspecialchars($idoso['outra_especificacao']) ?></p>
                                        <h6>Pulmonar</h6>
                                        <p>Tosse: <?= htmlspecialchars($idoso['tipo_tosse']) ?>; Auscultação: <?= htmlspecialchars($idoso['auscultacao']) ?>; Dispneia: <?= htmlspecialchars($idoso['tipo_dispneia']) ?></p>
                                        <h6>Alimentação</h6>
                                        <p>Sozinho: <?= htmlspecialchars($idoso['alimentacao_sozinho']) ?>; Deglutição: <?= htmlspecialchars($idoso['dificuldade_degluticao']) ?>; Sonda: <?= htmlspecialchars($idoso['uso_sonda']) ?>; Restrição: <?= htmlspecialchars($idoso['restricao_alimentar']) ?>; Preferência: <?= htmlspecialchars($idoso['preferencia_alimentar']) ?></p>
                                        <h6>Locomoção</h6>
                                        <p>Sozinho: <?= htmlspecialchars($idoso['locomocao_sozinho']) ?>; Cadeirante: <?= htmlspecialchars($idoso['cadeirante']) ?> (Tempo: <?= htmlspecialchars($idoso['tempo_cadeirante']) ?>); Acamado: <?= htmlspecialchars($idoso['acamado']) ?> (Tempo: <?= htmlspecialchars($idoso['tempo_acamado']) ?>); Apoio Físico: <?= htmlspecialchars($idoso['apoio_fisico']) ?>; Esporte/Terapia: <?= htmlspecialchars($idoso['esporte_terapia']) ?></p>
                                        <h6>Relacionamento</h6>
                                        <p>Comunicação: <?= htmlspecialchars($idoso['status_comunicacao']) ?>; Agressividade: <?= htmlspecialchars($idoso['agressividade']) ?>; Temperamento: <?= htmlspecialchars($idoso['temperamento']) ?>; Casa Repouso Anterior: <?= htmlspecialchars($idoso['anterioridade_casa_repouso']) ?>; Irritabilidade: <?= htmlspecialchars($idoso['irritabilidade']) ?></p>
                                        <h6>Exames</h6>
                                        <p>Hemograma: <?= htmlspecialchars($idoso['hemograma_conclusao']) ?>; Urina: <?= htmlspecialchars($idoso['urina_tipo']) ?>; Parasitológico: <?= htmlspecialchars($idoso['parasitologico_fezes']) ?>; Glicemia Jejum: <?= $idoso['glicemia_jejum'] ?> mg/dL; Colesterol: <?= $idoso['colesterol'] ?> mg/dL; Hepatite: <?= htmlspecialchars($idoso['hepatite_tipo']) ?>; HIV: <?= htmlspecialchars($idoso['hiv']) ?>; VDRL: <?= htmlspecialchars($idoso['vdrl']) ?>; Atestado Neurológico: <?= htmlspecialchars($idoso['atestado_neurologico']) ?>; Raio-X Pulmão: <?= htmlspecialchars($idoso['raiox_pulmao']) ?>; Receituário: <?= htmlspecialchars($idoso['receituario_medico']) ?></p>
                                        <h6>Eliminação</h6>
                                        <p>Frequência Evacuação: <?= htmlspecialchars($idoso['frequencia_evacuacao']) ?>; Aspecto Fezes: <?= htmlspecialchars($idoso['aspecto_fezes']) ?>; Coloração Urina: <?= htmlspecialchars($idoso['coloracao_urina']) ?>; Odor Urina: <?= htmlspecialchars($idoso['odor_urina']) ?>; Frequência Urina: <?= htmlspecialchars($idoso['frequencia_urina']) ?>; Gases: <?= htmlspecialchars($idoso['queixa_gases']) ?>; Fralda: <?= htmlspecialchars($idoso['usa_fralda']) ?>; Marca: <?= htmlspecialchars($idoso['marca_fralda']) ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-ghost" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Modal erro foto (mesmo padrão) -->
<div class="confirm-overlay" id="modalErroFoto">
    <div class="confirm-box">
        <div class="confirm-hdr">
            <span class="confirm-hdr-title" style="color: var(--warning);">Arquivo muito pesado</span>
            <button class="confirm-close" onclick="fecharErroFoto()">✕</button>
        </div>
        <div class="confirm-body">
            A imagem escolhida tem <strong id="tamanho-arquivo"></strong>MB.<br>
            <span class="confirm-note">Escolha uma imagem com no máximo <strong>2MB</strong>.</span>
        </div>
        <div class="confirm-ftr">
            <button class="btn-confirm-cancel" onclick="fecharErroFoto()">Entendi</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script>
// Sidebar mobile
var sidebar = document.getElementById('sidebar');
var overlay = document.getElementById('overlay');
document.getElementById('sidebarToggle').addEventListener('click', function() {
    sidebar.classList.toggle('open');
    overlay.classList.toggle('visible');
});
overlay.addEventListener('click', function() {
    sidebar.classList.remove('open');
    overlay.classList.remove('visible');
});

// Upload foto
document.getElementById('inputFoto').addEventListener('change', function() {
    if (!this.files || this.files.length === 0) return;
    var tamanho = this.files[0].size / 1024 / 1024;
    if (tamanho > 10) {
        document.getElementById('tamanho-arquivo').textContent = tamanho.toFixed(1);
        document.getElementById('modalErroFoto').classList.add('open');
        this.value = '';
    } else {
        document.getElementById('formFoto').submit();
    }
});
function fecharErroFoto() {
    document.getElementById('modalErroFoto').classList.remove('open');
}
</script>
    </body>
</html>