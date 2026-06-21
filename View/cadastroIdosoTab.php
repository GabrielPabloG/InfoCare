<?php
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

// Apenas admin e gerente podem cadastrar idosos
if ($_SESSION['user_tipo'] !== 'admin' && $_SESSION['user_tipo'] !== 'gerente') {
    switch ($_SESSION['user_tipo']) {
        case 'funcionario':
            header('Location: homeFuncionario.php');
            break;
        case 'responsavel':
            header('Location: homeResponsavel.php');
            break;
        default:
            session_destroy();
            header('Location: ../index.php');
    }
    exit;
}

$imgPerfil = $_SESSION['foto_perfil'] ?? '../upload/user.png';
$conn = Conexao::getConexao();

// Processa a busca de responsável via POST (CPF)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cpfPessoa'])) {
    $_SESSION['cpfResponsavel'] = trim($_POST['cpfPessoa']);
    $_SESSION['direto'] = 0;
    header('Location: cadastroIdosoTab.php');
    exit;
}

// Se veio de outro lugar com o CPF do responsável já na sessão
if (isset($_SESSION['direto']) && $_SESSION['direto'] == 0) {
    $cpfResp = $_SESSION['cpfResponsavel'] ?? '';
} else {
    $cpfResp = '';
}

$responsavelEncontrado = false;
$responsavel = null;

if (!empty($cpfResp)) {
    try {
        $stmt = $conn->prepare("SELECT id, nome, cpf FROM responsavel WHERE cpf = ?");
        $stmt->execute([$cpfResp]);
        $responsavel = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($responsavel) {
            $responsavelEncontrado = true;
        }
    } catch (PDOException $e) {
        // Silencioso
    }
}

// Se não encontrou, carrega lista de responsáveis para sugestão
$listaResponsaveis = [];
if (!$responsavelEncontrado && !empty($cpfResp)) {
    try {
        $stmt = $conn->query("SELECT nome, cpf FROM responsavel ORDER BY nome ASC LIMIT 20");
        $listaResponsaveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoCare — Cadastrar Idoso</title>
    <link rel="stylesheet" href="../css/adm.css">
    <link rel="stylesheet" href="../cssModal/css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
</head>
<body>
<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo"><img src="../img/infocare branco.png" alt="InfoCare"></div>
    <div class="sidebar-profile">
        <img src="<?= $imgPerfil ?>" alt="Foto" class="sidebar-avatar">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name"><?= htmlspecialchars($_SESSION['user_nome'] ?? 'Usuário') ?></div>
            <div class="sidebar-profile-role"><?= $_SESSION['user_tipo'] === 'admin' ? 'Administrador' : 'Gerente' ?></div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <span class="sidebar-section-label">Gestão</span>
        <?php if ($_SESSION['user_tipo'] === 'admin'): ?>
            <a href="homeAdm.php" class="sidebar-link"><i class="icon">⊞</i> Gerentes</a>
        <?php endif; ?>
        <a href="homeGerente.php" class="sidebar-link active"><i class="icon">⊞</i> Idosos</a>
        <a href="listCuidador.php" class="sidebar-link"><i class="icon">⊠</i> Funcionários</a>
        <a href="listarRes.php" class="sidebar-link"><i class="icon">⊟</i> Responsáveis</a>
        <span class="sidebar-section-label">Conta</span>
        <form action="../Controller/atualizarFoto.php" method="post" enctype="multipart/form-data" id="formFoto">
            <input type="file" name="foto" id="inputFoto" style="display:none" accept="image/*">
            <label for="inputFoto" class="sidebar-link" style="cursor:pointer; margin-bottom:0"><i class="icon">◎</i> Atualizar foto</label>
        </form>
    </nav>
    <div class="sidebar-footer"><a href="../View/logout.php" class="sidebar-link"><i class="icon">↩</i> Sair</a></div>
</aside>
<div class="sidebar-overlay" id="overlay"></div>

<!-- MAIN -->
<div class="main-wrapper">
    <header class="topbar">
        <div class="d-flex align-center gap-2">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Menu">☰</button>
            <span class="topbar-title">Cadastrar Idoso</span>
        </div>
    </header>
    <main class="page-content">
        <div class="card" style="max-width:1100px; margin:0 auto">
            <div class="card-header"><span class="card-header-title">Novo Paciente</span></div>
            <div class="card-body">

                <?php if (!$responsavelEncontrado): ?>
                    <!-- Busca de Responsável -->
                    <form method="post" class="mb-4">
                        <h5>Buscar Responsável</h5>
                        <div class="form-row align-items-end">
                            <div class="form-group col-md-6">
                                <label class="form-label">CPF do Responsável</label>
                                <input type="text" name="cpfPessoa" id="cpfPessoa" class="form-control" required placeholder="000.000.000-00" onblur="TestaCPF(this.value)">
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                        <script>$("#cpfPessoa").mask("000.000.000-00");</script>
                    </form>
                    <?php if (!empty($cpfResp) && !$responsavelEncontrado): ?>
                        <div class="alert alert-warning">
                            Responsável com CPF <?= htmlspecialchars($cpfResp) ?> não encontrado.
                            <a href="cadastroResponsavel.php" class="btn btn-sm btn-ghost ml-2">Cadastrar Responsável</a>
                        </div>
                        <?php if (!empty($listaResponsaveis)): ?>
                            <h6>Responsáveis cadastrados:</h6>
                            <table class="table table-sm">
                                <thead><tr><th>Nome</th><th>CPF</th></tr></thead>
                                <tbody>
                                    <?php foreach ($listaResponsaveis as $r): ?>
                                        <tr><td><?= htmlspecialchars($r['nome']) ?></td><td><?= htmlspecialchars($r['cpf']) ?></td></tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Formulário do Idoso com Abas -->
                    <form id="formCadastroIdoso" action="../Controller/rotinasCadastroIdoso.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="codResponsavel" value="<?= $responsavel['id'] ?>">
                        <p class="text-muted">Responsável: <strong><?= htmlspecialchars($responsavel['nome']) ?></strong> (<?= htmlspecialchars($responsavel['cpf']) ?>)</p>
                        <ul class="nav nav-tabs" id="idosoTabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1">Dados Pessoais</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2">Anamnese</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab3">Questionamento</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab4">Pele</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab5">Pulmonar</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab6">Alimentação</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab7">Locomoção</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab8">Relacionamento</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab9">Exame</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab10">Eliminação</a></li>
                        </ul>
                        <div class="tab-content mt-3">
                            <!-- Aba 1: Dados Pessoais -->
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Nome *</label>
                                        <input type="text" name="nomeIdoso" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">CPF *</label>
                                        <input type="text" name="cpfIdoso" id="cpfIdoso" class="form-control" required onblur="TestaCPF(this.value)">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="form-label">Sexo *</label>
                                        <select name="sexoIdoso" class="form-control" required>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label">Nascimento *</label>
                                        <input type="date" name="nascIdoso" class="form-control" required onchange="validardataDeNascimento(this.value)">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-label">Peso</label>
                                        <input type="text" name="peso" class="form-control" placeholder="kg">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="form-label">Altura</label>
                                        <input type="text" name="altura" class="form-control" placeholder="m">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control-file">
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-primary next-tab" href="#">Próximo</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2">
    <h5>Anamnese</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Declínio Cognitivo</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="declinioCongnitivo" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="declinioCongnitivo" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Dificuldade Fala</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dificuldadeFala" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dificuldadeFala" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Audição</label>
            <select name="audicao" class="form-control" required>
                <option value="Sem Aparelho">Sem Aparelho</option>
                <option value="Com Aparelho">Com Aparelho</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Acidente Vascular Encefálico</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="acidenteVascularEncefalico" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="acidenteVascularEncefalico" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Traumatismo Cranioencefálico</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="traumatismoCranioEncefalico" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="traumatismoCranioEncefalico" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Hipertensão Arterial</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hipertensaoArterial" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hipertensaoArterial" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Hipotireoidismo</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hipotireoidismo" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hipotireoidismo" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Tipo Diabetes</label>
            <select name="tipoDiabetes" class="form-control" required>
                <option value="Nenhum">Nenhum</option>
                <option value="Tipo 1">Tipo 1</option>
                <option value="Tipo 2">Tipo 2</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="form-label">Tipo de Câncer</label>
            <select name="tipoCancer" class="form-control" required>
                <option value="Nenhum">Nenhum</option>
                <option value="Ânus">Ânus</option>
                <option value="Bexiga">Bexiga</option>
                <option value="Boca e Orofaringe">Boca e Orofaringe</option>
                <option value="Colorretal">Colorretal</option>
                <option value="Cabeça e Pescoço">Cabeça e Pescoço</option>
                <option value="Cavidade Nasal e Seios Paranasais">Cavidade Nasal e Seios Paranasais</option>
                <option value="Cavidade Oral e Orofaringe">Cavidade Oral e Orofaringe</option>
                <option value="Colo do Útero">Colo do Útero</option>
                <option value="Doença de Castleman">Doença de Castleman</option>
                <option value="Doença Trofoblástica Gestacional">Doença Trofoblástica Gestacional</option>
                <option value="Endométrio">Endométrio</option>
                <option value="Esôfago">Esôfago</option>
                <option value="Estômago">Estômago</option>
                <option value="Fígado">Fígado</option>
                <option value="Garganta">Garganta</option>
                <option value="Gástrico">Gástrico</option>
                <option value="GIST">GIST</option>
                <option value="Glândula Suprarrenal">Glândula Suprarrenal</option>
                <option value="Glândulas Salivares">Glândulas Salivares</option>
                <option value="Intestino Delgado">Intestino Delgado</option>
                <option value="Laringe e Hipofaringe">Laringe e Hipofaringe</option>
                <option value="Leucemia Linfóide Aguda (LLA)">Leucemia Linfóide Aguda (LLA)</option>
                <option value="Leucemia Linfóide Crônica (LLC)">Leucemia Linfóide Crônica (LLC)</option>
                <option value="Leucemia Mieloide Aguda (LMA)">Leucemia Mieloide Aguda (LMA)</option>
                <option value="Leucemia Mieloide Crônica (LMC)">Leucemia Mieloide Crônica (LMC)</option>
                <option value="Leucemia Mielomonocítica Crônica (LMMC)">Leucemia Mielomonocítica Crônica (LMMC)</option>
                <option value="Linfoma de Hodgkin">Linfoma de Hodgkin</option>
                <option value="Linfoma de Pele">Linfoma de Pele</option>
                <option value="Linfoma Não Hodgkin">Linfoma Não Hodgkin</option>
                <option value="Macroglobulinemia Waldenstrom">Macroglobulinemia Waldenstrom</option>
                <option value="Mama">Mama</option>
                <option value="Mama Avançado">Mama Avançado</option>
                <option value="Mama em Homens">Mama em Homens</option>
                <option value="Melanoma">Melanoma</option>
                <option value="Mesotelioma">Mesotelioma</option>
                <option value="Mieloma Múltiplo">Mieloma Múltiplo</option>
                <option value="Nasofaringe">Nasofaringe</option>
                <option value="Neuroblastoma">Neuroblastoma</option>
                <option value="Neuroendócrinos">Neuroendócrinos</option>
                <option value="Olho">Olho</option>
                <option value="Ovário">Ovário</option>
                <option value="Osteossarcoma">Osteossarcoma</option>
                <option value="Pâncreas">Pâncreas</option>
                <option value="Pele Basocelular e Espinocelular">Pele Basocelular e Espinocelular</option>
                <option value="Pele de Células de Merkel">Pele de Células de Merkel</option>
                <option value="Pênis">Pênis</option>
                <option value="Próstata">Próstata</option>
                <option value="Pulmão de Não Pequenas Células">Pulmão de Não Pequenas Células</option>
                <option value="Pulmão de Pequenas Células">Pulmão de Pequenas Células</option>
                <option value="Raros">Raros</option>
                <option value="Rim">Rim</option>
                <option value="Rabdomiossarcoma">Rabdomiossarcoma</option>
                <option value="Retinoblastoma">Retinoblastoma</option>
                <option value="Sarcoma de Kaposi">Sarcoma de Kaposi</option>
                <option value="Sarcoma de Partes Moles">Sarcoma de Partes Moles</option>
                <option value="Sarcoma Uterino">Sarcoma Uterino</option>
                <option value="Síndrome Mielodisplásica">Síndrome Mielodisplásica</option>
                <option value="Sítio Primário Desconhecido">Sítio Primário Desconhecido</option>
                <option value="Testículo">Testículo</option>
                <option value="Timo">Timo</option>
                <option value="Tireoide">Tireoide</option>
                <option value="Tumor Carcinoide de Pulmão">Tumor Carcinoide de Pulmão</option>
                <option value="Tumor Carcinoide Gastrointestinal">Tumor Carcinoide Gastrointestinal</option>
                <option value="Tumor de Ewing">Tumor de Ewing</option>
                <option value="Tumor de Wilms">Tumor de Wilms</option>
                <option value="Tumor Gastro Intestinal">Tumor Gastro Intestinal</option>
                <option value="Tumores Cerebrais/SNC">Tumores Cerebrais/SNC</option>
                <option value="Tumores Neuroendócrinos">Tumores Neuroendócrinos</option>
                <option value="Tumores Ósseos">Tumores Ósseos</option>
                <option value="Tumores Pituitários">Tumores Pituitários</option>
                <option value="Vagina">Vagina</option>
                <option value="Vesícula">Vesícula</option>
                <option value="Via Biliar">Via Biliar</option>
                <option value="Vulva">Vulva</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Tipo Cirurgia</label>
            <select name="tipoCirurgia" class="form-control" required>
                <option value="Nenhuma">Nenhuma</option>
                <option value="Maior">Maior</option>
                <option value="Menor">Menor</option>
                <option value="Eletiva">Eletiva</option>
                <option value="Urgência/Emergência">Urgência/Emergência</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Uso Medicamento</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="usoMedicamento1" name="usoMedicamento" value="Sim" onclick="myFunction()"> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoMedicamento" value="Não" checked onclick="myFunction()"> Não
                </div>
            </div>
        </div>
    </div>
    <div id="cadastroMedicamento" style="display:none;">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="form-label">Nome da medicação</label>
                <input type="text" name="nomeMedicamento" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label class="form-label">Dosagem</label>
                <input type="text" name="dosagemMedicamento" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="form-label">Horário da medicação</label>
                <input type="time" name="horarioMedicamento" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label class="form-label">Posologia</label>
                <input type="text" name="posologia" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label class="form-label">Composição do Medicamento</label>
                <input type="text" name="composicaoMedicamento" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Tratamento Realizado</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="tratamentoRealizado" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="tratamentoRealizado" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <a class="btn btn-primary next-tab" href="#">Próximo</a>
    </div>
</div>

<div class="tab-pane fade" id="tab3">
    <h5>Questionamento</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Utilização de Óculos</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="utilizacaoOculos" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="utilizacaoOculos" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Prótese Auditiva</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="proteseAuditiva" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="proteseAuditiva" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Carteira de Vacinação</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="carteiraVacinacao" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="carteiraVacinacao" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Tabagista</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="tabagista" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="tabagista" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Etilista</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="etilista" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="etilista" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Dependência de Etilismo</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="dependenciaEtilismo" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="dependenciaEtilismo" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Tipo Sanguíneo</label>
            <select name="tipoSanguineo" class="form-control" required>
                <option value="AB+">AB+</option><option value="AB-">AB-</option>
                <option value="O+">O+</option><option value="O-">O-</option>
                <option value="A+">A+</option><option value="A-">A-</option>
                <option value="B+">B+</option><option value="B-">B-</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Uso de Prótese Dentária</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoProteseDentaria" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoProteseDentaria" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Uso de Medicamento Contínuo</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoMedicamentoContinuo" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoMedicamentoContinuo" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Uso de Substância Psicoativa</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoSubstanciaPsicoativa" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoSubstanciaPsicoativa" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Alergia a Medicamento</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="alergiaMedicamento" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="alergiaMedicamento" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Convênio</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="convenio" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="convenio" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Encaminhamento Hospitalar</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="encaminhamentoUnidadeHospitalar" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="encaminhamentoUnidadeHospitalar" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Atividade Manual</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="atividadeManual" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="atividadeManual" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <a class="btn btn-primary next-tab" href="#">Próximo</a>
    </div>
</div>

<div class="tab-pane fade" id="tab4">
    <h5>Pele</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Integridade da Pele</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="integridadePele" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="integridadePele" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Hidratação da Pele</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hidratacaoPele" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hidratacaoPele" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Dermatite</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="dermatite" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="dermatite" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Prurido</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="prurido" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="prurido" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Micose de Unha</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="micoseUnha" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="micoseUnha" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Escamação</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="escamacaoPele" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="escamacaoPele" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Icterícia</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="ictericiaPele" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="ictericiaPele" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Ferida</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="feridaPele" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="feridaPele" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Petéquias</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="petequiaPele" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="petequiaPele" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Hematoma</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hematomaPele" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hematomaPele" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Úlcera</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="ulceraPele" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="ulceraPele" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <a class="btn btn-primary next-tab" href="#">Próximo</a>
    </div>
</div>

<div class="tab-pane fade" id="tab5">
    <h5>Pulmonar</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Tipo de Tosse</label>
            <select name="tipoTosse" class="form-control" required>
                <option value="Nenhuma">Nenhuma</option>
                <option value="Tosse seca">Tosse seca</option>
                <option value="Tosse produtiva">Tosse produtiva</option>
                <option value="Tosse medicamentosa">Tosse medicamentosa</option>
                <option value="Tosse alérgica">Tosse alérgica</option>
                <option value="Tosse espasmódica">Tosse espasmódica</option>
                <option value="Tosse paroxística">Tosse paroxística</option>
                <option value="Tosse aguda e subaguda">Tosse aguda e subaguda</option>
                <option value="Tosse crônica">Tosse crônica</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Auscultação</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="ascultacao" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="ascultacao" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="form-label">Tipo de Dispneia</label>
            <select name="tipoDispineia" class="form-control" required>
                <option value="Nenhum">Nenhum</option>
                <option value="Taquipneia">Taquipneia</option>
                <option value="Bradipneia">Bradipneia</option>
                <option value="Hiperpnéia">Hiperpnéia</option>
                <option value="Hipopnéia">Hipopnéia</option>
                <option value="Apnéia">Apnéia</option>
                <option value="Ortopnéia">Ortopnéia</option>
                <option value="Platipneia">Platipneia</option>
                <option value="Trepopneia">Trepopneia</option>
                <option value="Dispnéia">Dispnéia</option>
                <option value="Resp agônica">Resp agônica</option>
            </select>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <a class="btn btn-primary next-tab" href="#">Próximo</a>
    </div>
</div>

<div class="tab-pane fade" id="tab6">
    <h5>Alimentação</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Alimentação Sozinho</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="alimentacaoSolo" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="alimentacaoSolo" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Dificuldade de Deglutição</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="dificuldadeDegluticao" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="dificuldadeDegluticao" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Uso de Sonda</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoSonda" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoSonda" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Restrição Alimentar</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="restricaoAlimento" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="restricaoAlimento" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Preferência Alimentar</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="preferenciaAlimento" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="preferenciaAlimento" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <a class="btn btn-primary next-tab" href="#">Próximo</a>
    </div>
</div>

<div class="tab-pane fade" id="tab7">
    <h5>Locomoção</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Locomoção Sozinho</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="locomocaoSolo" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="locomocaoSolo" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Cadeirante</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="cadeirante" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="cadeirante" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Acamado</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="acamacao" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="acamacao" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Apoio Físico</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="apoioFisico" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="apoioFisico" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Esporte/Terapia</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="esporteTerapia" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="esporteTerapia" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <a class="btn btn-primary next-tab" href="#">Próximo</a>
    </div>
</div>

<div class="tab-pane fade" id="tab8">
    <h5>Relacionamento</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Status de Comunicação</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="statusComunicacao" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="statusComunicacao" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Agressividade</label>
            <select name="agressividade" class="form-control" required>
                <option value="Nenhuma">Nenhuma</option>
                <option value="Pouca">Pouca</option>
                <option value="Moderada">Moderada</option>
                <option value="Muita">Muita</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Temperamento</label>
            <select name="temperamento" class="form-control" required>
                <option value="Colérico">Colérico</option>
                <option value="Melancólico">Melancólico</option>
                <option value="Sanguíneo">Sanguíneo</option>
                <option value="Fleumático">Fleumático</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Anterioridade em Casa de Repouso</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="anterioridadeCasaRepouso" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="anterioridadeCasaRepouso" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Irritabilidade</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="irritabilidade" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="irritabilidade" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <a class="btn btn-primary next-tab" href="#">Próximo</a>
    </div>
</div>

<div class="tab-pane fade" id="tab9">
    <h5>Exames</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Conclusão do Hemograma</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="conclusaoHemograma" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="conclusaoHemograma" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Tipo de Urina</label>
            <select name="tipoUrina" class="form-control" required>
                <option value="Urina amarelo escuro">Urina amarelo escuro</option>
                <option value="Urina laranja">Urina laranja</option>
                <option value="Urina vermelha ou rosa">Urina vermelha ou rosa</option>
                <option value="Urina roxa">Urina roxa</option>
                <option value="Urina azul">Urina azul</option>
                <option value="Urina verde">Urina verde</option>
                <option value="Urina marrom">Urina marrom</option>
                <option value="Urina esbranquiçada">Urina esbranquiçada</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Parasitológico de Fezes</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="parasitologicoFezes" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="parasitologicoFezes" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Glicemia em Jejum</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="glicemiaJejum" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="glicemiaJejum" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Colesterol</label>
            <select name="colesterol" class="form-control" required>
                <option value="Alto">Alto</option>
                <option value="Baixo">Baixo</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Tipo de Hepatite</label>
            <select name="tipoHepatite" class="form-control" required>
                <option value="Nenhum">Nenhum</option>
                <option value="HEPATITE A">HEPATITE A</option>
                <option value="HEPATITE B">HEPATITE B</option>
                <option value="HEPATITE C">HEPATITE C</option>
                <option value="HEPATITE D">HEPATITE D</option>
                <option value="HEPATITE E">HEPATITE E</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">HIV</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hiv" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hiv" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">VDRL</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="vdrl" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="vdrl" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Atestado Neurológico</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="atestadoNeurologico" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="atestadoNeurologico" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Raio-X do Pulmão</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="raioxPulmao" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="raioxPulmao" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Receituário Médico</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="receituarioMedico" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="receituarioMedico" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <a class="btn btn-primary next-tab" href="#">Próximo</a>
    </div>
</div>

<div class="tab-pane fade" id="tab10">
    <h5>Eliminação</h5>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Frequência de Evacuação</label>
            <select name="frequenciaEvacuacao" class="form-control" required>
                <option value="Pouco">Pouco</option>
                <option value="Moderado">Moderado</option>
                <option value="Muito">Muito</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Aspecto das Fezes</label>
            <select name="aspecto" class="form-control" required>
                <option value="Tipo 1">Tipo 1</option>
                <option value="Tipo 2">Tipo 2</option>
                <option value="Tipo 3">Tipo 3</option>
                <option value="Tipo 4">Tipo 4</option>
                <option value="Tipo 5">Tipo 5</option>
                <option value="Tipo 6">Tipo 6</option>
                <option value="Tipo 7">Tipo 7</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Odor da Urina</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="odorUrina" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="odorUrina" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Frequência Urinária</label>
            <select name="frequenciaUrina" class="form-control" required>
                <option value="Pouco">Pouco</option>
                <option value="Moderado">Moderado</option>
                <option value="Muito">Muito</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-label">Queixa de Gases</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="queixaGases" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="queixaGases" value="Não" checked> Não
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Uso de Fralda Geriátrica</label>
            <div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoFraldaGeriatrica" value="Sim" required> Sim
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="usoFraldaGeriatrica" value="Não" checked> Não
                </div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3">
        <a class="btn btn-secondary prev-tab" href="#">Voltar</a>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </div>
</div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="cadastroIdosoTab.php" class="btn btn-ghost">Outro Responsável</a>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<!-- MODAIS DE ERRO DE FOTO (padrão) -->
<div class="confirm-overlay" id="modalErroFoto">
    <div class="confirm-box"><div class="confirm-hdr"><span class="confirm-hdr-title" style="color:var(--warning)">Arquivo muito pesado</span><button class="confirm-close" onclick="fecharErroFoto()">✕</button></div>
        <div class="confirm-body">A imagem escolhida tem <strong id="tamanho-arquivo"></strong>MB.<br><span class="confirm-note">Máximo 10MB.</span></div>
        <div class="confirm-ftr"><button class="btn-confirm-cancel" onclick="fecharErroFoto()">Entendi</button></div>
    </div>
</div>

<!-- Modal de feedback (validação) -->
<div class="feedback-overlay" id="feedbackModal">
    <div class="feedback-box">
        <div class="icon">⚠️</div>
        <h5 id="feedbackTitle">Atenção</h5>
        <p id="feedbackMsg"></p>
        <button class="btn btn-primary" id="feedbackClose">Entendi</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<script src="../js/validacoes.js?v=1.0.0"></script>

<script>
// Máscaras
$("#cpfIdoso").mask("000.000.000-00");
$("#cpfPessoa").mask("000.000.000-00");

// Revalida CPF do idoso enquanto digita
document.getElementById("cpfIdoso").addEventListener('input', function() {
    TestaCPF(this.value);
});

// Fechar modal de feedback
document.getElementById('feedbackClose').addEventListener('click', function() {
    document.getElementById('feedbackModal').classList.remove('open');
});
document.getElementById('feedbackModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
});

// Validação no envio do formulário principal
document.getElementById("formCadastroIdoso").addEventListener('submit', function(e) {
    var cpfOk = TestaCPF(document.getElementById("cpfIdoso").value);
    var dataOk = validaDataNascimento(document.getElementById("nascIdoso").value);

    if (!cpfOk) {
        e.preventDefault();
        abrirFeedback('CPF inválido', 'O CPF do idoso não é válido. Corrija antes de cadastrar.', 'cpfIdoso');
        return;
    }
    if (!dataOk) {
        e.preventDefault();
        abrirFeedback('Data inválida', 'A data de nascimento não pode ser futura.', 'nascIdoso');
        return;
    }
    // Se tudo OK, envia
});

// Navegação entre abas (botões "Próximo" e "Voltar")
$('.next-tab').click(function(e){
    e.preventDefault();
    var nextTabLink = $('.nav-tabs .active').closest('li').next('li').find('a');
    if (nextTabLink.length) nextTabLink.tab('show');
});
$('.prev-tab').click(function(e){
    e.preventDefault();
    var prevTabLink = $('.nav-tabs .active').closest('li').prev('li').find('a');
    if (prevTabLink.length) prevTabLink.tab('show');
});

// Medicamento condicional
function myFunction() {
    var x = document.getElementById("usoMedicamento1").checked;
    document.getElementById("cadastroMedicamento").style.display = x ? "block" : "none";
}

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

// Upload foto (limite de 10MB)
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