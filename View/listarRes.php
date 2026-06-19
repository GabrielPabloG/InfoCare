<?php
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// Controle de acesso: apenas admin e gerente podem gerenciar responsáveis
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
            header('Location: index.php');
    }
    exit;
}

// Foto de perfil via sessão
$imgPerfil = $_SESSION['foto_perfil'] ?? '../upload/user.png';

// Lista de responsáveis
try {
    $sqlRes = "SELECT id, nome, cpf, sexo, nascimento, email, rua, bairro, cep, numero_casa 
               FROM responsavel 
               ORDER BY nome ASC";
    $stmtRes = $conn->query($sqlRes);
    $resultado_res = $stmtRes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar responsáveis: " . $e->getMessage());
}

$totalResponsaveis = count($resultado_res);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Responsáveis</title>
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
        <img src="<?= $imgPerfil ?>" alt="Foto de perfil" class="sidebar-avatar">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">
                <?= htmlspecialchars($_SESSION['user_nome'] ?? 'Usuário') ?>
            </div>
            <div class="sidebar-profile-role">
                <?= $_SESSION['user_tipo'] === 'admin' ? 'Administrador' : 'Gerente' ?>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <span class="sidebar-section-label">Gestão</span>
        <?php if ($_SESSION['user_tipo'] === 'admin'): ?>
            <a href="homeAdm.php" class="sidebar-link">
                <i class="icon">⊞</i> Gerentes
            </a>
        <?php endif; ?>
        <a href="homeGerente.php" class="sidebar-link">
            <i class="icon">⊞</i> Idosos
        </a>
        <a href="listCuidador.php" class="sidebar-link">
            <i class="icon">⊠</i> Funcionários
        </a>
        <a href="listarRes.php" class="sidebar-link active">
            <i class="icon">⊟</i> Responsáveis
        </a>

        <span class="sidebar-section-label">Conta</span>
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
            <span class="topbar-title">Responsáveis</span>
        </div>
    </header>

    <main class="page-content">
        <!-- KPIs -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total de Responsáveis</div>
                <div class="stat-value"><?= $totalResponsaveis ?></div>
            </div>
        </div>

        <!-- Alertas de URL -->
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success">Operação realizada com sucesso.</div>
        <?php endif; ?>
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger">Ocorreu um erro. Tente novamente.</div>
        <?php endif; ?>

        <!-- Tabela de responsáveis -->
        <div class="card">
            <div class="card-header">
                <span class="card-header-title">Responsáveis Cadastrados</span>
                <a href="cadastroResponsavel.php" class="btn btn-primary btn-sm">
                    + Novo Responsável
                </a>
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
                        <?php if (empty($resultado_res)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center; color:var(--text-muted); padding:40px;">
                                Nenhum responsável cadastrado ainda.
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($resultado_res as $r): ?>
                        <tr>
                            <td class="text-muted"><?= $r['id'] ?></td>
                            <td><strong><?= htmlspecialchars($r['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($r['cpf']) ?></td>
                            <td>
                                <div class="actions">
                                    <!-- Visualizar -->
                                    <button class="btn-ver" data-toggle="modal" data-target="#modalVer<?= $r['id'] ?>">👁 Ver</button>

                                    <!-- Editar -->
                                    <button class="btn-edit" data-toggle="modal" data-target="#modalEditar"
                                        data-id="<?= $r['id'] ?>"
                                        data-nome="<?= htmlspecialchars($r['nome']) ?>"
                                        data-sexo="<?= htmlspecialchars($r['sexo']) ?>"
                                        data-cpf="<?= htmlspecialchars($r['cpf']) ?>"
                                        data-nasc="<?= $r['nascimento'] ?>"
                                        data-email="<?= htmlspecialchars($r['email']) ?>"
                                        data-rua="<?= htmlspecialchars($r['rua']) ?>"
                                        data-bairro="<?= htmlspecialchars($r['bairro']) ?>"
                                        data-cep="<?= htmlspecialchars($r['cep']) ?>"
                                        data-num="<?= htmlspecialchars($r['numero_casa']) ?>"
                                    >✏ Editar</button>

                                    <!-- Apagar (modal de confirmação) -->
                                    <button class="btn-del" onclick="confirmarExclusao(<?= $r['id'] ?>, '<?= htmlspecialchars($r['nome'], ENT_QUOTES) ?>')">🗑 Apagar</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Visualizar -->
                        <div class="modal fade" id="modalVer<?= $r['id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= htmlspecialchars($r['nome']) ?></h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Código:</strong> <?= $r['id'] ?></p>
                                        <p><strong>Nome:</strong> <?= htmlspecialchars($r['nome']) ?></p>
                                        <p><strong>Sexo:</strong> <?= htmlspecialchars($r['sexo']) ?></p>
                                        <p><strong>CPF:</strong> <?= htmlspecialchars($r['cpf']) ?></p>
                                        <p><strong>Nascimento:</strong> <?= date('d/m/Y', strtotime($r['nascimento'])) ?></p>
                                        <p><strong>E-mail:</strong> <?= htmlspecialchars($r['email']) ?></p>
                                        <hr>
                                        <p><strong>CEP:</strong> <?= htmlspecialchars($r['cep']) ?></p>
                                        <p><strong>Endereço:</strong> <?= htmlspecialchars($r['rua']) ?>, <?= htmlspecialchars($r['numero_casa']) ?> - <?= htmlspecialchars($r['bairro']) ?></p>
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

<!-- ════════════ MODAL EDITAR RESPONSÁVEL ════════════ -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Responsável</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../Controller/atualizarResponsavel.php">
                    <input type="hidden" name="id" id="edit-id">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Nome completo</label>
                            <input name="nome" type="text" class="form-control" id="edit-nome" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Sexo</label>
                            <select name="sexo" class="form-control" id="edit-sexo" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">CPF</label>
                            <input name="cpf" type="text" class="form-control" id="edit-cpf" required>
                            <script>$("#edit-cpf").mask("000.000.000-00");</script>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Data de Nascimento</label>
                            <input name="nascimento" type="date" class="form-control" id="edit-nasc" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">E-mail</label>
                            <input name="email" type="email" class="form-control" id="edit-email" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">CEP</label>
                            <input name="cep" type="text" class="form-control" id="edit-cep" required>
                            <script>$("#edit-cep").mask("00000-000");</script>
                        </div>
                        <div class="form-group col-md-8">
                            <label class="form-label">Rua</label>
                            <input name="rua" type="text" class="form-control" id="edit-rua" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label class="form-label">Bairro</label>
                            <input name="bairro" type="text" class="form-control" id="edit-bairro" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Número</label>
                            <input name="numero_casa" type="text" class="form-control" id="edit-num" required>
                        </div>
                    </div>

                    <div class="modal-footer" style="padding:0; margin-top:16px; border:none;">
                        <button type="button" class="btn btn-ghost" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ════════════ MODAL CONFIRMAR EXCLUSÃO ════════════ -->
<div class="confirm-overlay" id="modalDeletar">
    <div class="confirm-box">
        <div class="confirm-hdr">
            <span class="confirm-hdr-title">Apagar Responsável</span>
            <button class="confirm-close" onclick="fecharDeletar()">✕</button>
        </div>
        <div class="confirm-body">
            Tem certeza que deseja apagar o responsável <strong id="del-nome"></strong>?
            <span class="confirm-note">Esta ação não pode ser desfeita.</span>
        </div>
        <div class="confirm-ftr">
            <button class="btn-confirm-cancel" onclick="fecharDeletar()">Cancelar</button>
            <form id="del-form" action="../Controller/apagarRes.php" method="GET" style="display:inline">
                <input type="hidden" name="id" id="del-id">
                <button type="submit" class="btn-confirm-del">Sim, apagar</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal erro foto (padrão) -->
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

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script>
// Preenche modal de edição
$('#modalEditar').on('show.bs.modal', function(e) {
    const btn = $(e.relatedTarget);
    $('#edit-id').val(btn.data('id'));
    $('#edit-nome').val(btn.data('nome'));
    $('#edit-sexo').val(btn.data('sexo'));
    $('#edit-cpf').val(btn.data('cpf'));
    $('#edit-nasc').val(btn.data('nasc'));
    $('#edit-email').val(btn.data('email'));
    $('#edit-rua').val(btn.data('rua'));
    $('#edit-bairro').val(btn.data('bairro'));
    $('#edit-cep').val(btn.data('cep'));
    $('#edit-num').val(btn.data('num'));
});

// Modal de confirmação de exclusão
function confirmarExclusao(id, nome) {
    document.getElementById('del-id').value = id;
    document.getElementById('del-nome').textContent = nome;
    document.getElementById('modalDeletar').classList.add('open');
}
function fecharDeletar() {
    document.getElementById('modalDeletar').classList.remove('open');
}
document.getElementById('modalDeletar').addEventListener('click', function(e) {
    if (e.target === this) fecharDeletar();
});

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