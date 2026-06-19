<?php
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

// Apenas o próprio responsável pode editar seu perfil
if ($_SESSION['user_tipo'] !== 'responsavel') {
    header('Location: ../View/homeResponsavel.php');
    exit;
}

$conn = Conexao::getConexao();
$idResponsavel = $_SESSION['user_id'];

// Busca dados do responsável
try {
    $sql = "SELECT nome, cpf, sexo, nascimento, email, rua, bairro, cep, numero_casa
            FROM responsavel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idResponsavel]);
    $resp = $stmt->fetch(PDO::FETCH_ASSOC);

    // Telefones existentes
    $sqlTel = "SELECT numero FROM telefone WHERE entidade_tipo = 'responsavel' AND entidade_id = ?";
    $stmtTel = $conn->prepare($sqlTel);
    $stmtTel->execute([$idResponsavel]);
    $telefones = $stmtTel->fetchAll(PDO::FETCH_COLUMN);

    if (!$resp) {
        die("Responsável não encontrado.");
    }
} catch (PDOException $e) {
    die("Erro ao carregar dados: " . $e->getMessage());
}

$imgPerfil = $_SESSION['foto_perfil'] ?? '../upload/user.png';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare — Editar Perfil</title>
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
            <div class="sidebar-profile-role">Responsável</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <span class="sidebar-section-label">Menu</span>
        <a href="homeResponsavel.php" class="sidebar-link active">
            <i class="icon">⊞</i> Idosos
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
            <span class="topbar-title">Editar Perfil</span>
        </div>
    </header>

    <main class="page-content">
        <div class="card" style="max-width: 960px; margin: 0 auto;">
            <div class="card-header">
                <span class="card-header-title">Meus Dados</span>
                <a href="homeResponsavel.php" class="btn btn-ghost btn-sm">← Voltar</a>
            </div>
            <div class="card-body">
                <form method="POST" action="../Controller/rotinasAtualizarResponsavel.php" id="formPerfil">
                    <input type="hidden" name="id" value="<?= $idResponsavel ?>">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Nome completo</label>
                            <input type="text" name="nome" id="nome" class="form-control"
                                   value="<?= htmlspecialchars($resp['nome']) ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control"
                                   value="<?= htmlspecialchars($resp['email']) ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="form-label">Nova senha <small class="text-muted">(deixe em branco para manter)</small></label>
                            <input type="password" name="senha" id="senha" class="form-control" placeholder="Manter atual">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control"
                                   value="<?= htmlspecialchars($resp['cpf']) ?>" required
                                   onblur="TestaCPF(this.value);">
                            <script>$("#cpf").mask("000.000.000-00");</script>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label">Sexo</label>
                            <select name="sexo" id="sexo" class="form-control" required>
                                <option value="M" <?= $resp['sexo'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                                <option value="F" <?= $resp['sexo'] == 'F' ? 'selected' : '' ?>>Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="date" name="nascimento" id="nascimento" class="form-control"
                                   value="<?= htmlspecialchars($resp['nascimento']) ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">CEP</label>
                            <input type="text" name="cep" id="cep" class="form-control"
                                   value="<?= htmlspecialchars($resp['cep']) ?>" required
                                   onblur="pesquisacep(this.value);">
                            <script>$("#cep").mask("00000-000");</script>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">Rua</label>
                            <input type="text" name="rua" id="rua" class="form-control"
                                   value="<?= htmlspecialchars($resp['rua']) ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">Bairro</label>
                            <input type="text" name="bairro" id="bairro" class="form-control"
                                   value="<?= htmlspecialchars($resp['bairro']) ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label class="form-label">Nº</label>
                            <input type="text" name="numero_casa" id="numero_casa" class="form-control"
                                   value="<?= htmlspecialchars($resp['numero_casa']) ?>" required>
                        </div>
                        <div class="form-group col-md-10">
                            <label class="form-label">Telefones</label>
                            <div id="container-telefones">
                                <?php if (!empty($telefones)): ?>
                                    <?php foreach ($telefones as $i => $tel): ?>
                                        <input type="tel" name="telefone[]" class="form-control <?= $i > 0 ? 'mt-2' : '' ?>"
                                               value="<?= htmlspecialchars($tel) ?>" required
                                               data-mask="(00) 00000-0000">
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <input type="tel" name="telefone[]" class="form-control"
                                           placeholder="Telefone principal" required
                                           data-mask="(00) 00000-0000">
                                <?php endif; ?>
                            </div>
                            <button type="button" class="btn btn-sm btn-ghost mt-2" id="addTelefone">+ Adicionar telefone</button>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="homeResponsavel.php" class="btn btn-ghost">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<!-- Modal erro foto -->
<div class="confirm-overlay" id="modalErroFoto">
    <div class="confirm-box">
        <div class="confirm-hdr">
            <span class="confirm-hdr-title" style="color: var(--warning);">Arquivo muito pesado</span>
            <button class="confirm-close" onclick="fecharErroFoto()">✕</button>
        </div>
        <div class="confirm-body">
            A imagem escolhida tem <strong id="tamanho-arquivo"></strong>MB.<br>
            <span class="confirm-note">Escolha uma imagem de até <strong>2MB</strong>.</span>
        </div>
        <div class="confirm-ftr">
            <button class="btn-confirm-cancel" onclick="fecharErroFoto()">Entendi</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script>
// Máscaras automáticas
$(document).ready(function() {
    $('input[name="telefone[]"]').each(function() {
        $(this).mask('(00) 00000-0000');
    });

    $('#addTelefone').click(function() {
        var novo = $('<input type="tel" name="telefone[]" class="form-control mt-2" placeholder="Outro telefone">');
        $('#container-telefones').append(novo);
        novo.mask('(00) 00000-0000');
    });
});

// Busca CEP
function limpa_formulario_cep() {
    document.getElementById('rua').value = '';
    document.getElementById('bairro').value = '';
}
function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        document.getElementById('rua').value = conteudo.logradouro;
        document.getElementById('bairro').value = conteudo.bairro;
    } else {
        limpa_formulario_cep();
        alert("CEP não encontrado.");
    }
}
function pesquisacep(valor) {
    var cep = valor.replace(/\D/g, '');
    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if(validacep.test(cep)) {
            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            var script = document.createElement('script');
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
            document.body.appendChild(script);
        } else {
            limpa_formulario_cep();
            alert("Formato de CEP inválido.");
        }
    } else {
        limpa_formulario_cep();
    }
}

// Validação de CPF
function TestaCPF(strCPF) {
    var Soma, Resto;
    Soma = 0;
    var cpf = strCPF.replace(/\D/g, '');
    if (cpf == "00000000000" || cpf.length !== 11) {
        document.getElementById("cpf").setCustomValidity('Inválido');
        return false;
    }
    for (i=1; i<=9; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(cpf.substring(9, 10))) {
        document.getElementById("cpf").setCustomValidity('Inválido');
        return false;
    }
    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(cpf.substring(10, 11))) {
        document.getElementById("cpf").setCustomValidity('Inválido');
        return false;
    }
    document.getElementById("cpf").setCustomValidity('');
    return true;
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