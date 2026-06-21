<?php
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

// Apenas admin e gerente podem cadastrar responsáveis
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

$imgPerfil = $_SESSION['foto_perfil'] ?? '../upload/user.png';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Cadastrar Responsável</title>
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
            <span class="topbar-title">Cadastrar Responsável</span>
        </div>
    </header>

    <main class="page-content">
        <!-- Alertas -->
        <?php if (isset($_SESSION['cadastrando1'])): ?>
            <div class="alert alert-info"><?= htmlspecialchars($_SESSION['cadastrando1']) ?></div>
            <?php unset($_SESSION['cadastrando1']); ?>
        <?php endif; ?>

        <div class="card" style="max-width: 900px; margin: 0 auto;">
            <div class="card-header">
                <span class="card-header-title">Novo Responsável</span>
                <a href="listarRes.php" class="btn btn-ghost btn-sm">← Voltar</a>
            </div>
            <div class="card-body">
                <form id="formResponsavel" method="POST" action="../Controller/processaRes.php">
                    <h5>Dados do Responsável</h5>
                    <p class="text-muted small">* Preencha todos os campos obrigatórios</p>
                    <hr>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Nome completo *</label>
                            <input type="text" name="nome" id="nome" class="form-control" required placeholder="Nome completo">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">E-mail *</label>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="E-mail">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Senha *</label>
                            <input type="password" name="senha" id="senha" class="form-control" required placeholder="Senha">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">CPF *</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" required placeholder="000.000.000-00" onblur="TestaCPF(this.value);">
                            <script>$("#cpf").mask("000.000.000-00");</script>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Sexo *</label>
                            <select name="sexo" id="sexo" class="form-control" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Data de Nascimento *</label>
                            <input type="date" name="nascimento" id="nascimento" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">CEP *</label>
                            <input type="text" name="cep" id="cep" class="form-control" required placeholder="00000-000" onblur="pesquisacep(this.value);">
                            <script>$("#cep").mask("00000-000");</script>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Rua *</label>
                            <input type="text" name="rua" id="rua" class="form-control" required placeholder="Rua">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Bairro *</label>
                            <input type="text" name="bairro" id="bairro" class="form-control" required placeholder="Bairro">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="form-label">Nº *</label>
                            <input type="text" name="numero_casa" id="numero_casa" class="form-control" required placeholder="Nº">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Telefone(s) *</label>
                            <div id="divTelefones">
                                <input type="tel" name="telefone[]" id="telefone1" class="form-control" required placeholder="Telefone principal">
                            </div>
                            <script>$("#telefone1").mask("(00) 00000-0000");</script>
                            <button type="button" class="btn btn-sm btn-ghost mt-2" id="adicionarTelefone">+ Adicionar outro telefone</button>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="listarRes.php" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
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

<!-- Modal de feedback (validação) -->
<div class="feedback-overlay" id="feedbackModal">
    <div class="feedback-box">
        <div class="icon">⚠️</div>
        <h5 id="feedbackTitle">Atenção</h5>
        <p id="feedbackMsg"></p>
        <button class="btn btn-primary" id="feedbackClose">Entendi</button>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<script src="../js/validacoes.js?v=1.0.0"></script>

<script>
// Revalida CPF enquanto o usuário digita
document.getElementById("cpf").addEventListener('input', function() {
    TestaCPF(this.value);
});

// Fechar modal de feedback
document.getElementById('feedbackClose').addEventListener('click', function() {
    document.getElementById('feedbackModal').classList.remove('open');
});
document.getElementById('feedbackModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
});

// Validação no envio do formulário
document.getElementById("formResponsavel").addEventListener('submit', function(e) {
    var cpfOk = TestaCPF(document.getElementById("cpf").value);
    var cepOk = validaCEP(document.getElementById("cep").value);
    var dataOk = validaDataNascimento(document.getElementById("nascimento").value);
    var telOk = validaTelefone(document.getElementById("telefone1").value);

    if (!cpfOk) {
        e.preventDefault();
        abrirFeedback('CPF inválido', 'O CPF informado não é válido. Corrija antes de cadastrar.', 'cpf');
        return;
    }
    if (!cepOk) {
        e.preventDefault();
        abrirFeedback('CEP inválido', 'O CEP deve ter 8 dígitos.', 'cep');
        return;
    }
    if (!dataOk) {
        e.preventDefault();
        abrirFeedback('Data inválida', 'A data de nascimento não pode ser futura.', 'nascimento');
        return;
    }
    if (!telOk) {
        e.preventDefault();
        abrirFeedback('Telefone inválido', 'O telefone principal deve ter pelo menos 10 dígitos.', 'telefone1');
        return;
    }
    // Se tudo OK, envia
});

// Busca CEP (com feedback modal)
function limpa_formulario_cep() {
    document.getElementById('rua').value = "";
    document.getElementById('bairro').value = "";
}
function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        document.getElementById('rua').value = conteudo.logradouro;
        document.getElementById('bairro').value = conteudo.bairro;
    } else {
        limpa_formulario_cep();
        abrirFeedback('CEP não encontrado', 'O CEP informado não foi encontrado.', 'cep');
    }
}
function pesquisacep(valor) {
    var cep = valor.replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            var script = document.createElement('script');
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';
            document.body.appendChild(script);
        } else {
            limpa_formulario_cep();
            abrirFeedback('Formato de CEP inválido', 'Digite um CEP com 8 dígitos.', 'cep');
        }
    } else {
        limpa_formulario_cep();
    }
}

// Adicionar telefone dinâmico
let i = 2;
document.getElementById("adicionarTelefone").addEventListener("click", function() {
    let campo = document.createElement("input");
    campo.type = "tel";
    campo.className = "form-control mt-2";
    campo.id = "telefone" + i;
    campo.name = "telefone[]";
    campo.placeholder = "Outro telefone";
    document.getElementById("divTelefones").appendChild(campo);
    $("#telefone" + i).mask("(00) 00000-0000");
    i++;
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
    if (tamanho > 2) {
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