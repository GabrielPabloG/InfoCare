<?php
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// Apenas usuários logados acessam
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$idosoId = $_GET['id'] ?? 0;

// Busca os dados completos do idoso + prontuário
$sql = "
    SELECT
        i.id AS idoso_id, i.nome, i.sexo, i.cpf, i.nascimento,
        r.nome AS responsavel,
        (SELECT nome_arquivo FROM foto 
         WHERE entidade_tipo = 'idoso' AND entidade_id = i.id 
         ORDER BY data_foto DESC LIMIT 1) AS foto,
        ant.*, q.*, pel.*, pul.*, ali.*, loc.*, rel.*, exa.*, eli.*
    FROM idoso i
    LEFT JOIN responsavel r ON i.responsavel_id = r.id
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
    WHERE i.id = ?
";
$stmt = $conn->prepare($sql);
$stmt->execute([$idosoId]);
$dados = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dados) {
    die('Idoso não encontrado.');
}

$imgPerfil = $_SESSION['foto_perfil'] ?? '../upload/user.png';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Prontuário de <?= htmlspecialchars($dados['nome']) ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/adm.css">
    <style>
        @media print {
            .sidebar, .topbar, .btn { display: none; }
            .main-wrapper { margin-left: 0; }
        }
        .prontuario-section { margin-bottom: 2rem; }
        .prontuario-section h5 { border-bottom: 1px solid var(--primary-lt); padding-bottom: 6px; }
        .prontuario-field { margin-bottom: 6px; }
        .prontuario-field strong { display: inline-block; min-width: 180px; }
    </style>
</head>
<body>
<!-- Sidebar (igual às outras) -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo"><img src="../img/infocare branco.png" alt="InfoCare"></div>
    <div class="sidebar-profile">
        <img src="<?= $imgPerfil ?>" alt="Foto" class="sidebar-avatar">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name"><?= htmlspecialchars($_SESSION['user_nome']) ?></div>
            <div class="sidebar-profile-role"><?= ucfirst($_SESSION['user_tipo']) ?></div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <span class="sidebar-section-label">Ações</span>
        <a href="#" onclick="window.print()" class="sidebar-link"><i class="icon">🖨</i> Imprimir / PDF</a>
        <a href="javascript:history.back()" class="sidebar-link"><i class="icon">↩</i> Voltar</a>
    </nav>
</aside>
<div class="sidebar-overlay" id="overlay"></div>

<div class="main-wrapper">
    <header class="topbar">
        <button class="sidebar-toggle" id="sidebarToggle">☰</button>
        <span class="topbar-title">Prontuário de <?= htmlspecialchars($dados['nome']) ?></span>
    </header>
    <main class="page-content">
        <div class="card">
            <div class="card-header"><span class="card-header-title">Dados Pessoais</span></div>
            <div class="card-body">
                <?php 
                $fotoIdoso = !empty($dados['foto']) ? '../upload/' . htmlspecialchars($dados['foto']) : '../upload/user.png';
                ?>
                <div class="text-center mb-3">
                    <img src="<?= $fotoIdoso ?>" alt="Foto do idoso" style="max-width: 200px; border-radius: 12px;">
                </div>
                <div class="prontuario-field"><strong>Nome:</strong> <?= htmlspecialchars($dados['nome']) ?></div>
                <div class="prontuario-field"><strong>Sexo:</strong> <?= htmlspecialchars($dados['sexo']) ?></div>
                <div class="prontuario-field"><strong>CPF:</strong> <?= htmlspecialchars($dados['cpf']) ?></div>
                <div class="prontuario-field"><strong>Nascimento:</strong> <?= date('d/m/Y', strtotime($dados['nascimento'])) ?></div>
                <div class="prontuario-field"><strong>Responsável:</strong> <?= htmlspecialchars($dados['responsavel'] ?? 'Não vinculado') ?></div>
            </div>
        </div>

        <!-- Seções clínicas -->
        <?php
        $secoes = [
            'Antecedência' => ['declinio_cognitivo','dificuldade_fala','audicao','ave','tce','hipertensao','hipotireoidismo','diabetes_tipo','cancer_tipo','cirurgia_tipo','usa_medicamento','tratamento_realizado'],
            'Questionamento' => ['usa_oculos','protese_auditiva','carteira_vacinacao','tabagista','etilista','dependencia_etilismo','tipo_sanguineo','usa_protese_dentaria','usa_medicamento_continuo','usa_substancia_psicoativa','alergia_medicamento','convenio','encaminhamento_hospitalar','atividade_manual'],
            'Pele' => ['integridade','hidratacao','dermatite','prurido','micose_unha','escamacao','ictericia','ferida','petequia','hematoma','ulcera','grau_ulcera','outra_especificacao'],
            'Pulmonar' => ['tipo_tosse','auscultacao','tipo_dispneia'],
            'Alimentação' => ['alimentacao_sozinho','dificuldade_degluticao','uso_sonda','restricao_alimentar','preferencia_alimentar'],
            'Locomoção' => ['locomocao_sozinho','cadeirante','tempo_cadeirante','acamado','tempo_acamado','apoio_fisico','esporte_terapia'],
            'Relacionamento' => ['status_comunicacao','agressividade','temperamento','anterioridade_casa_repouso','irritabilidade'],
            'Exames' => ['hemograma_conclusao','urina_tipo','parasitologico_fezes','glicemia_jejum','colesterol','hepatite_tipo','hiv','vdrl','atestado_neurologico','raiox_pulmao','receituario_medico'],
            'Eliminação' => ['frequencia_evacuacao','aspecto_fezes','coloracao_urina','odor_urina','frequencia_urina','queixa_gases','usa_fralda','marca_fralda']
        ];
        foreach ($secoes as $titulo => $campos): ?>
            <div class="card mt-4">
                <div class="card-header"><span class="card-header-title"><?= $titulo ?></span></div>
                <div class="card-body">
                    <?php foreach ($campos as $campo): ?>
                        <div class="prontuario-field">
                            <strong><?= ucfirst(str_replace('_', ' ', $campo)) ?>:</strong>
                            <?= htmlspecialchars($dados[$campo] ?? '—') ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script>
document.getElementById('sidebarToggle').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('visible');
});
</script>
</body>
</html>