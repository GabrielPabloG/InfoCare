<?php
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// Apenas funcionários acessam esta página
if ($_SESSION['user_tipo'] !== 'funcionario') {
    switch ($_SESSION['user_tipo']) {
        case 'admin':
            header('Location: homeAdm.php');
            break;
        case 'gerente':
            header('Location: homeGerente.php');
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

// Foto de perfil via sessão (definida no verificacao.php)
$fotoSessao = $_SESSION['foto_perfil'] ?? 'user.png';

if (strpos($fotoSessao, '../upload/') === false) {
    // Se a sessão veio só com o nome do arquivo, a gente adiciona a pasta
    $imgPerfil = '../upload/' . $fotoSessao;
} else {
    // Se já veio com o caminho completo do login, usa direto
    $imgPerfil = $fotoSessao;
}

// Lista de idosos para o funcionário
$sqlIdosos = "
    SELECT i.id, i.nome, i.sexo, i.cpf, i.nascimento, r.nome AS nomeResponsavel
    FROM idoso i
    LEFT JOIN responsavel r ON i.responsavel_id = r.id
    ORDER BY i.nome ASC
";
$stmtIdosos = $conn->query($sqlIdosos);
$resultado_idoso = $stmtIdosos->fetchAll(PDO::FETCH_ASSOC);

// KPIs
$totalIdosos = count($resultado_idoso);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Painel do Cuidador</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/adm.css">
    <link rel="stylesheet" href="../cssModal/css/bootstrap.min.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
</head>
<body>

<!-- ════════════════════════════════
     SIDEBAR
     ════════════════════════════════ -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="../img/infocare branco.png" alt="InfoCare">
    </div>

    <div class="sidebar-profile">
        <img src="<?= $imgPerfil ?>" alt="Foto de perfil" class="sidebar-avatar">
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">
                <?= htmlspecialchars($_SESSION['user_nome'] ?? 'Funcionário') ?>
            </div>
            <div class="sidebar-profile-role">Funcionário(a)</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <span class="sidebar-section-label">Gestão</span>
        <a href="homeFuncionario.php" class="sidebar-link active">
            <i class="icon">⊞</i> Idosos
        </a>

        <span class="sidebar-section-label">Conta</span>

        <!-- Link para editar os dados da conta -->
        <a href="atualizarFuncionario.php" class="sidebar-link">
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

<!-- ════════════════════════════════
     CONTEÚDO PRINCIPAL
     ════════════════════════════════ -->
<div class="main-wrapper">
    <header class="topbar">
        <div class="d-flex align-center gap-2">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Menu">☰</button>
            <span class="topbar-title">Painel do Funcionário</span>
        </div>
    </header>

    <main class="page-content">
        <!-- KPIs -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Idosos</div>
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

        <!-- Tabela -->
        <div class="card">
            <div class="card-header">
                <span class="card-header-title">Idosos Cadastrados</span>
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
                                Nenhum idoso cadastrado.
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
                                    <!-- Visualizar -->
                                    <button class="btn-ver" data-toggle="modal" data-target="#modalVer<?= $idoso['id'] ?>">👁 Ver</button>

                                    <!-- Editar -->
                                    <button class="btn-edit" data-toggle="modal" data-target="#modalEditar"
                                        data-id="<?= $idoso['id'] ?>"
                                        data-nome="<?= htmlspecialchars($idoso['nome']) ?>"
                                        data-sexo="<?= htmlspecialchars($idoso['sexo']) ?>">✏ Editar</button>

                                    <!-- Apagar (modal) -->
                                    <button class="btn-del" onclick="confirmarExclusao(<?= $idoso['id'] ?>, '<?= htmlspecialchars($idoso['nome'], ENT_QUOTES) ?>')">🗑 Apagar</button>

                                    <!-- Prontuário -->
                                    <form action="criarProntuario.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="cpfIdoso" value="<?= htmlspecialchars($idoso['cpf']) ?>">
                                        <button class="btn btn-primary btn-sm" type="submit" style="margin-left:4px;">+ Prontuário</button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Visualizar -->
                        <div class="modal fade" id="modalVer<?= $idoso['id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= htmlspecialchars($idoso['nome']) ?></h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Código:</strong> <?= $idoso['id'] ?></p>
                                        <p><strong>Nome:</strong> <?= htmlspecialchars($idoso['nome']) ?></p>
                                        <p><strong>Sexo:</strong> <?= htmlspecialchars($idoso['sexo']) ?></p>
                                        <p><strong>Nascimento:</strong> <?= date('d/m/Y', strtotime($idoso['nascimento'])) ?></p>
                                        <p><strong>Responsável:</strong> <?= $idoso['nomeResponsavel'] ? htmlspecialchars($idoso['nomeResponsavel']) : 'Não cadastrado' ?></p>
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

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Paciente</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../Controller/atualizarIdoso.php">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="form-group">
                        <label class="form-label">Nome</label>
                        <input name="nome" type="text" class="form-control" id="edit-nome" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sexo</label>
                        <select name="sexo" class="form-control" id="edit-sexo" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>
                    <div class="modal-footer" style="padding:0; margin-top:16px; border:none;">
                        <button type="button" class="btn btn-ghost" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmar Exclusão -->
<div class="confirm-overlay" id="modalDeletar">
    <div class="confirm-box">
        <div class="confirm-hdr">
            <span class="confirm-hdr-title">Apagar Paciente</span>
            <button class="confirm-close" onclick="fecharDeletar()">✕</button>
        </div>
        <div class="confirm-body">
            Tem certeza que deseja apagar <strong id="del-nome"></strong>?
            <span class="confirm-note">Esta ação não pode ser desfeita.</span>
        </div>
        <div class="confirm-ftr">
            <button class="btn-confirm-cancel" onclick="fecharDeletar()">Cancelar</button>
            <form id="del-form" action="../Controller/apagarIdoso.php" method="GET" style="display:inline">
                <input type="hidden" name="id" id="del-id">
                <button type="submit" class="btn-confirm-del">Sim, apagar</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Erro Foto -->
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
// Modal de edição
$('#modalEditar').on('show.bs.modal', function(e) {
    const btn = $(e.relatedTarget);
    $('#edit-id').val(btn.data('id'));
    $('#edit-nome').val(btn.data('nome'));
    $('#edit-sexo').val(btn.data('sexo'));
});

// Modal de exclusão
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
var toggle  = document.getElementById('sidebarToggle');
toggle.addEventListener('click', function() {
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
    const tamanho = this.files[0].size / 1024 / 1024;
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