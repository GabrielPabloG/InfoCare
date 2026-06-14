<?php
session_start();
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// Foto de perfil do admin
$imgPerfil = '../upload/user.png';
try {
    $stmtFoto = $conn->prepare(
        "SELECT nome_arquivo FROM foto WHERE entidade_tipo = 'admin' AND entidade_id = ? ORDER BY data_foto DESC LIMIT 1"
    );
    $stmtFoto->execute([$_SESSION['user_id']]);
    if ($fotoDb = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {
        $imgPerfil = '../upload/' . htmlspecialchars($fotoDb['nome_arquivo']);
    }
} catch (PDOException $e) {}

// Lista de gerentes
try {
    $sqlGerentes = "
        SELECT g.id, g.nome, g.cpf, g.sexo, g.nascimento, g.email, g.salario, 
               g.rua, g.bairro, g.cep, g.numero_casa,
               t.numero AS telefone
        FROM gerente g
        LEFT JOIN telefone t ON t.entidade_id = g.id AND t.entidade_tipo = 'GERENTE'
        ORDER BY g.nome ASC
    ";
    
    $resultado_gerentes = $conn->query($sqlGerentes)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $resultado_gerentes = [];
}

$totalGerentes = count($resultado_gerentes);

// Total de idosos e funcionários para os KPIs
try {
    $totalIdosos = $conn->query("SELECT COUNT(*) FROM idoso")->fetchColumn();
    $totalFuncionarios = $conn->query("SELECT COUNT(*) FROM funcionario")->fetchColumn();
} catch (PDOException $e) {
    $totalIdosos = $totalFuncionarios = '—';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Painel do Administrador</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS do projeto -->
    <link rel="stylesheet" href="../css/adm.css">
    <!-- Bootstrap 4 para modais (mantém compatibilidade) -->
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
        <!-- Troque por <span class="sidebar-logo-text">InfoCare</span> se preferir -->
    </div>

    <div class="sidebar-profile">
        <img
            src="<?= $imgPerfil ?>"
            alt="Foto de perfil"
            class="sidebar-avatar"
        >
        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">
                <?= htmlspecialchars($_SESSION['user_nome'] ?? 'Administrador') ?>
            </div>
            <div class="sidebar-profile-role">Administrador</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <span class="sidebar-section-label">Gestão</span>

        <a href="homeAdm.php" class="sidebar-link active">
            <i class="icon">⊞</i> Gerentes
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

<!-- Overlay mobile -->
<div class="sidebar-overlay" id="overlay"></div>

<!-- ════════════════════════════════
     CONTEÚDO PRINCIPAL
     ════════════════════════════════ -->
<div class="main-wrapper">

    <!-- Topbar -->
    <header class="topbar">
        <div class="d-flex align-center gap-2">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Menu">
                ☰
            </button>
            <span class="topbar-title">Painel Administrativo</span>
        </div>
        <div class="topbar-actions">
            <a href="../View/logout.php" class="btn btn-ghost btn-sm">Sair</a>
        </div>
    </header>

    <!-- Conteúdo -->
    <main class="page-content">

        <!-- KPIs -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Gerentes</div>
                <div class="stat-value"><?= $totalGerentes ?></div>
            </div>
            <div class="stat-card accent">
                <div class="stat-label">Idosos</div>
                <div class="stat-value"><?= $totalIdosos ?></div>
            </div>
            <div class="stat-card success">
                <div class="stat-label">Funcionários</div>
                <div class="stat-value"><?= $totalFuncionarios ?></div>
            </div>
        </div>

        <!-- Alertas de URL -->
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success">Operação realizada com sucesso.</div>
        <?php endif; ?>
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger">Ocorreu um erro. Tente novamente.</div>
        <?php endif; ?>

        <!-- Tabela de gerentes -->
        <div class="card">
            <div class="card-header">
                <span class="card-header-title">Gerentes Cadastrados</span>
                <a href="cadastroGerente.php" class="btn btn-primary btn-sm">
                    + Novo Gerente
                </a>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($resultado_gerentes)): ?>
                        <tr>
                            <td colspan="5" style="text-align:center; color:var(--text-muted); padding:40px;">
                                Nenhum gerente cadastrado ainda.
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($resultado_gerentes as $g): ?>
                        <tr>
                            <td class="text-muted"><?= $g['id'] ?></td>
                            <td><strong><?= htmlspecialchars($g['nome']) ?></strong></td>
                            <td><?= htmlspecialchars($g['cpf']) ?></td>
                            <td><?= htmlspecialchars($g['email']) ?></td>
                            <td>
                                <div class="actions">
                                    <!-- 👁 Visualizar -->
                                    <button
                                        class="btn-ver"
                                        data-toggle="modal"
                                        data-target="#modalVer<?= $g['id'] ?>"
                                    >👁 Ver</button>

                                    <!-- ✏ Editar -->
                                    <button
                                        class="btn-edit"
                                        data-toggle="modal"
                                        data-target="#modalEditar"
                                        data-id="<?= $g['id'] ?>"
                                        data-nome="<?= htmlspecialchars($g['nome']) ?>"
                                        data-sexo="<?= htmlspecialchars($g['sexo']) ?>"
                                        data-cpf="<?= htmlspecialchars($g['cpf']) ?>"
                                        data-nasc="<?= $g['nascimento'] ?>"
                                        data-email="<?= htmlspecialchars($g['email']) ?>"
                                        data-telefone="<?= htmlspecialchars($g['telefone']) ?>"
                                        data-rua="<?= htmlspecialchars($g['rua']) ?>"
                                        data-bairro="<?= htmlspecialchars($g['bairro']) ?>"
                                        data-cep="<?= htmlspecialchars($g['cep']) ?>"
                                        data-numero_casa="<?= htmlspecialchars($g['numero_casa']) ?>"
                                        data-salario="<?= $g['salario'] ?>"
                                    >✏ Editar</button>

                                    <!-- 🗑 Apagar — abre modal de confirmação -->
                                    <button
                                        class="btn-del"
                                        onclick="confirmarExclusao(<?= $g['id'] ?>, '<?= htmlspecialchars($g['nome'], ENT_QUOTES) ?>')"
                                    >🗑 Apagar</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal: visualizar -->
                        <div class="modal fade" id="modalVer<?= $g['id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= htmlspecialchars($g['nome']) ?></h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>ID:</strong> <?= $g['id'] ?></p>
                                        <p><strong>Nome:</strong> <?= htmlspecialchars($g['nome']) ?></p>
                                        <p><strong>Sexo:</strong> <?= htmlspecialchars($g['sexo']) ?></p>
                                        <p><strong>CPF:</strong> <?= htmlspecialchars($g['cpf']) ?></p>
                                        <p><strong>Nascimento:</strong> <?= date('d/m/Y', strtotime($g['nascimento'])) ?></p>
                                        <p><strong>E-mail:</strong> <?= htmlspecialchars($g['email']) ?></p>
                                        <p><strong>Telefone:</strong> <?= htmlspecialchars($g['telefone']) ?></p>
                                        <p><strong>CEP:</strong> <?= htmlspecialchars($g['cep']) ?></p>
                                        <p><strong>Endereço:</strong> <?= htmlspecialchars($g['rua']) ?>, <?= htmlspecialchars($g['numero_casa']) ?> - <?= htmlspecialchars($g['bairro']) ?></p>
                                        <p><strong>Salário:</strong> R$ <?= number_format($g['salario'], 2, ',', '.') ?></p>
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
        <!-- /card -->

    </main>
</div>

<!-- ════════════════════════════════
     MODAL EDITAR GERENTE
     ════════════════════════════════ -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Gerente</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../Controller/rotinasAtualizarGerente.php">

                    <div class="form-group">
                        <label class="form-label">Nome</label>
                        <input name="nome" type="text" class="form-control" id="edit-nome" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sexo</label>
                        <select name="sexo" class="form-control" id="edit-sexo" required>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">CPF</label>
                        <input name="cpf" type="text" class="form-control" id="edit-cpf" required>
                        <script>$("#edit-cpf").mask("000.000.000-00");</script>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Data de Nascimento</label>
                        <input name="nascimento" type="date" class="form-control" id="edit-nasc" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">E-mail</label>
                        <input name="email" type="email" class="form-control" id="edit-email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Telefone</label>
                        <input name="telefone" type="text" class="form-control" id="edit-telefone" required>
                        <script>$("#edit-telefone").mask("(00) 00000-0000");</script>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Rua</label>
                        <input name="rua" type="text" class="form-control" id="edit-rua" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bairro</label>
                        <input name="bairro" type="text" class="form-control" id="edit-bairro" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">CEP</label>
                        <input name="cep" type="text" class="form-control" id="edit-cep" required>
                        <script>$("#edit-cep").mask("00000-000");</script>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Número da Casa</label>
                        <input name="numero_casa" type="text" class="form-control" id="edit-numero_casa" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Salário</label>
                        <input name="salario" type="number" step="0.01" class="form-control" id="edit-salario" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nova Senha <span class="text-muted">(deixe em branco para manter)</span></label>
                        <input name="senha" type="password" class="form-control" placeholder="">
                    </div>

                    <input name="id" type="hidden" id="edit-id">

                    <div class="modal-footer" style="padding:0; margin-top:16px; border:none;">
                        <button type="button" class="btn btn-ghost" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ════════════════════════════════
     MODAL CONFIRMAR EXCLUSÃO
     (nativo, sem Bootstrap — mais confiável)
     ════════════════════════════════ -->
<div class="confirm-overlay" id="modalDeletar">
    <div class="confirm-box">
        <div class="confirm-hdr">
            <span class="confirm-hdr-title">Apagar Gerente</span>
            <button class="confirm-close" onclick="fecharDeletar()">✕</button>
        </div>
        <div class="confirm-body">
            Tem certeza que deseja apagar o gerente <strong id="del-nome"></strong>?
            <span class="confirm-note">Esta ação não pode ser desfeita.</span>
        </div>
        <div class="confirm-ftr">
            <button class="btn-confirm-cancel" onclick="fecharDeletar()">Cancelar</button>
            <form id="del-form" action="../Controller/apagarGerente.php" method="GET" style="display:inline">
                <input type="hidden" name="id" id="del-id">
                <button type="submit" class="btn-confirm-del">Sim, apagar</button>
            </form>
        </div>
    </div>
</div>

<div class="confirm-overlay" id="modalErroFoto">
    <div class="confirm-box">
        <div class="confirm-hdr">
            <span class="confirm-hdr-title" style="color: var(--warning);">Ops! Arquivo muito pesado</span>
            <button class="confirm-close" onclick="fecharErroFoto()">✕</button>
        </div>
        <div class="confirm-body">
            A imagem escolhida tem <strong id="tamanho-arquivo"></strong>MB.<br>
            <span class="confirm-note">Por favor, escolha uma imagem com no máximo <strong>10MB</strong>.</span>
        </div>
        <div class="confirm-ftr">
            <button class="btn-confirm-cancel" onclick="fecharErroFoto()">Entendi</button>
        </div>
    </div>
</div>

<!-- Scripts Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<script>
// Preenche modal de edição
$('#modalEditar').on('show.bs.modal', function(e) {
    const btn = $(e.relatedTarget);
    
    $('#edit-id').val(btn.data('id'));
    $('#edit-nome').val(btn.data('nome'));
    $('#edit-sexo').val(btn.data('sexo'));   // já é 'M' ou 'F'
    $('#edit-cpf').val(btn.data('cpf'));
    $('#edit-nasc').val(btn.data('nasc'));
    $('#edit-email').val(btn.data('email'));
    $('#edit-telefone').val(btn.data('telefone'));
    $('#edit-rua').val(btn.data('rua'));
    $('#edit-bairro').val(btn.data('bairro'));
    $('#edit-cep').val(btn.data('cep'));
    $('#edit-numero_casa').val(btn.data('numero_casa'));
    $('#edit-salario').val(btn.data('salario'));
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
var toggle  = document.getElementById('sidebarToggle');

toggle.addEventListener('click', function() {
    sidebar.classList.toggle('open');
    overlay.classList.toggle('visible');
});
overlay.addEventListener('click', function() {
    sidebar.classList.remove('open');
    overlay.classList.remove('visible');
});

document.getElementById('inputFoto').addEventListener('change', function() {
    // Se o usuário abriu a janela de foto mas cancelou sem escolher nada, o código para aqui.
    if (!this.files || this.files.length === 0) return;

    // Pega o tamanho do arquivo em Megabytes
    const tamanho = this.files[0].size / 1024 / 1024;
    
    if (tamanho > 2) { // Limite aumentado para 2MB
        // Mostra o tamanho real da foto que o usuário tentou subir (arredondado para 1 casa decimal)
        document.getElementById('tamanho-arquivo').textContent = tamanho.toFixed(1);
        
        // Abre o modal bonitão no lugar do alert()
        document.getElementById('modalErroFoto').classList.add('open');
        
        // Limpa o input para ele não tentar enviar a foto pesada
        this.value = ''; 
    } else {
        // Se a foto tiver menos de 10MB, envia o formulário!
        document.getElementById('formFoto').submit(); 
    }
});

// Função para fechar o modal novo
function fecharErroFoto() {
    document.getElementById('modalErroFoto').classList.remove('open');
}
</script>

</body>
</html>
