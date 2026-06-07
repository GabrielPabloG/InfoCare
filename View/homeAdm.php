<?php 
session_start();
require_once 'verificacao.php'; // Protege a página para que só o ADM entre
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// Busca da foto de perfil do ADM
$imgPerfil = 'user.png';
try {
    $stmtFoto = $conn->prepare("SELECT nome_arquivo FROM foto WHERE entidade_tipo = 'admin' AND entidade_id = ? ORDER BY data_foto DESC LIMIT 1");
    $stmtFoto->execute([$_SESSION['user_id']]);
    if ($fotoDb = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {
        $imgPerfil = $fotoDb['nome_arquivo'];
    }
} catch (PDOException $e) {
    // Falha silenciosa
}

// Busca todos os gerentes
try {
    $sqlGerentes = "SELECT id, nome, cpf, sexo, nascimento, email, salario, rua, bairro, cep, numero_casa 
                    FROM gerente 
                    ORDER BY nome ASC";
    $stmtGerentes = $conn->query($sqlGerentes);
    $resultado_gerentes = $stmtGerentes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar gerentes: " . $e->getMessage();
    $resultado_gerentes = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>InfoCare - Painel do Administrador</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    
    <link href="../css/default.css" rel="stylesheet">
    <link href="../css/component.css" rel="stylesheet">
    <!-- Bootstrap 4 CSS local (versão 4.1.0) -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/adm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="cabecalho">
        <a href="../View/homeAdm.php"><div class="logo"></div></a>

        <div class="header-right">
            <!-- Menu para desktop (links normais) -->
            <div class="menu-desktop">
                <ul>
                    <li><a href="#">Gerentes</a></li>
                    <li><a href="../View/logout.php">Sair</a></li>
                </ul>
            </div>

            <!-- Menu para mobile (hamburguer) -->
            <div class="menu-mobile">
                <button class="hamburger" id="hamburgerBtn">
                    <span></span><span></span><span></span>
                </button>
                <ul class="mobile-nav" id="mobileNav">
                    <li><a href="#">Gerentes</a></li>
                    <li><a href="../View/logout.php">Sair</a></li>
                </ul>
            </div>

            <!-- Perfil do administrador -->
            <div class="perfil-header">
                <form action="../Controller/atualizarFoto.php" method="post" enctype="multipart/form-data" id="formFoto">
                        <img src="../upload/<?php echo $imgPerfil; ?>" class="avatar-pequeno" id="avatarImg" style="cursor: pointer;">
                        <input type="file" name="foto" id="inputFoto" style="display: none;" accept="image/*">
                    </form>
                <div class="info-nome">
                    <?php echo isset($_SESSION['user_nome']) ? $_SESSION['user_nome'] : 'Administrador'; ?>
                    <div class="info-tipo">Administrador(a)</div>
                </div>
            </div>
        </div>
    </header>

    <div id="containerM" role="main">
        <!-- Mensagens de feedback -->
        <?php if(isset($_GET['excluido'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Gerente excluído com sucesso.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if(isset($_GET['atualizado'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Gerente atualizado com sucesso.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="page-header">
            <h1>Gerentes Cadastrados</h1>
            <form action="cadastroGerente.php">
                <button type="submit" class="btn btn-success">+ Adicionar Gerente</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome do Gerente</th>
                        <th>CPF do Gerente</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultado_gerentes as $rows_gerente): ?>
                    <tr>
                        <td><?php echo $rows_gerente['id']; ?></td>
                        <td><?php echo $rows_gerente['nome']; ?></td>
                        <td><?php echo $rows_gerente['cpf']; ?></td>
                        <td>
                            <!-- Botão Visualizar -->
                            <button type="button" class="btn btn-primaryM btn-sm" data-toggle="modal" data-target="#myModal<?php echo $rows_gerente['id']; ?>">
                                <i class="fas fa-file-alt"></i> Visualizar
                            </button>
                            
                            <!-- Botão Editar -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" 
                                data-id="<?php echo $rows_gerente['id']; ?>" 
                                data-nome="<?php echo addslashes($rows_gerente['nome']); ?>" 
                                data-sexo="<?php echo $rows_gerente['sexo']; ?>" 
                                data-cpf="<?php echo $rows_gerente['cpf']; ?>"
                                data-nasc="<?php echo $rows_gerente['nascimento']; ?>" 
                                data-email="<?php echo $rows_gerente['email']; ?>"
                                data-salario="<?php echo $rows_gerente['salario']; ?>"
                                data-rua="<?php echo addslashes($rows_gerente['rua']); ?>"
                                data-bairro="<?php echo addslashes($rows_gerente['bairro']); ?>"
                                data-cep="<?php echo $rows_gerente['cep']; ?>"
                                data-numero_casa="<?php echo $rows_gerente['numero_casa']; ?>">
                                <i class="fas fa-pencil-alt"></i> Editar
                            </button>
                            
                            <!-- Botão Apagar -->
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmarExclusao(<?php echo $rows_gerente['id']; ?>)">
                                <i class="fas fa-trash-alt"></i> Apagar
                            </button>
                        </td>
                    </tr>

                    <!-- Modal de Visualização -->
                    <div class="modal fade" id="myModal<?php echo $rows_gerente['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_<?php echo $rows_gerente['id']; ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel_<?php echo $rows_gerente['id']; ?>"><?php echo $rows_gerente['nome']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Código:</b> <?php echo $rows_gerente['id']; ?></p>
                                    <p><b>Nome:</b> <?php echo $rows_gerente['nome']; ?></p>
                                    <p><b>Sexo:</b> <?php echo $rows_gerente['sexo']; ?></p>
                                    <p><b>CPF:</b> <?php echo $rows_gerente['cpf']; ?></p>
                                    <p><b>Nascimento:</b> <?php echo date('d/m/Y', strtotime($rows_gerente['nascimento'])); ?></p>
                                    <p><b>E-mail:</b> <?php echo $rows_gerente['email']; ?></p>
                                    <p><b>Salário:</b> R$ <?php echo number_format($rows_gerente['salario'], 2, ',', '.'); ?></p>
                                    <p><b>Endereço:</b> <?php echo $rows_gerente['rua'] . ', ' . $rows_gerente['numero_casa'] . ' - ' . $rows_gerente['bairro']; ?></p>
                                    <p><b>CEP:</b> <?php echo $rows_gerente['cep']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Edição (único) -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Gerente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../Controller/rotinasAtualizarGerente.php">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input name="nome" type="text" class="form-control" id="recipient-name" required>
                        </div>
                        <div class="form-group">
                            <label>Sexo:</label>
                            <select name="sexo" class="form-control" id="recipient-sexo" required>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>CPF:</label>
                            <input name="cpf" type="text" class="form-control" id="recipient-cpf" required>
                        </div>                            
                        <div class="form-group">
                            <label>Data de Nascimento:</label>
                            <input name="nascimento" type="date" class="form-control" id="recipient-nasc" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input name="email" type="email" class="form-control" id="recipient-email" required>
                        </div>
                        <div class="form-group">
                            <label>Salário (R$):</label>
                            <input name="salario" type="number" step="0.01" class="form-control" id="recipient-salario" required>
                        </div>
                        <div class="form-group">
                            <label>Rua:</label>
                            <input name="rua" type="text" class="form-control" id="recipient-rua" required>
                        </div>
                        <div class="form-group">
                            <label>Bairro:</label>
                            <input name="bairro" type="text" class="form-control" id="recipient-bairro" required>
                        </div>
                        <div class="form-group">
                            <label>CEP:</label>
                            <input name="cep" type="text" class="form-control" id="recipient-cep" required>
                        </div>
                        <div class="form-group">
                            <label>Número da Casa:</label>
                            <input name="numero_casa" type="text" class="form-control" id="recipient-numero_casa" required>
                        </div>
                        <div class="form-group">
                            <label>Nova Senha (deixe em branco para manter a atual):</label>
                            <input name="senha" type="password" class="form-control" id="recipient-senha" placeholder="Digite apenas se for alterar">
                        </div>
                        <input name="id" type="hidden" id="id-gerente" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDeleteLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalConfirmDeleteLabel">
                        <i class="fas fa-exclamation-triangle"></i> Confirmar exclusão
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este gerente?<br>
                    <strong>Esta ação não pode ser desfeita!</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts (ordem correta) -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script>
        document.getElementById('avatarImg').addEventListener('click', function() {
            document.getElementById('inputFoto').click();
        });
        document.getElementById('inputFoto').addEventListener('change', function() {
            if (this.files.length > 0) {
                document.getElementById('formFoto').submit();
            }
        });
    </script>

    <script>

        var idParaExcluir = null;

            function confirmarExclusao(id) {
                idParaExcluir = id;
                $('#modalConfirmDelete').modal('show');
            }

            $('#confirmDeleteBtn').on('click', function() {
                if (idParaExcluir) {
                    window.location.href = '../Controller/apagarGerente.php?id=' + idParaExcluir;
                }
            });

        // Função de validação de CPF
        function TestaCPF(strCPF) {
            var Soma, Resto;
            Soma = 0;
            var cpf = strCPF.replace(/\D/g, '');
            if (cpf == "00000000000"){ document.getElementById("recipient-cpf").setCustomValidity('Inválido'); return false; }
            for (i=1; i<=9; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(cpf.substring(9, 10))){ document.getElementById("recipient-cpf").setCustomValidity('Inválido'); return false; }
            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;
            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(cpf.substring(10, 11))){ document.getElementById("recipient-cpf").setCustomValidity('Inválido'); return false; }
            document.getElementById("recipient-cpf").setCustomValidity('');
            return true;
        }

        $(document).ready(function() {
            // Máscaras
            $("#recipient-cpf").mask("000.000.000-00");
            $("#recipient-cep").mask("00000-000");

            // Preenchimento automático do modal de edição
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#id-gerente').val(button.data('id'));
                modal.find('#recipient-name').val(button.data('nome'));
                modal.find('#recipient-sexo').val(button.data('sexo'));
                modal.find('#recipient-cpf').val(button.data('cpf'));
                modal.find('#recipient-nasc').val(button.data('nasc'));
                modal.find('#recipient-email').val(button.data('email'));
                modal.find('#recipient-salario').val(button.data('salario'));
                modal.find('#recipient-rua').val(button.data('rua'));
                modal.find('#recipient-bairro').val(button.data('bairro'));
                modal.find('#recipient-cep').val(button.data('cep'));
                modal.find('#recipient-numero_casa').val(button.data('numero_casa'));
                modal.find('#recipient-senha').val('');
            });
            

            // Menu mobile hamburguer
            $('#hamburgerBtn').on('click', function() {
                $('#mobileNav').toggleClass('show');
            });
            // Fechar ao clicar em um link
            $('#mobileNav a').on('click', function() {
                $('#mobileNav').removeClass('show');
            });
        });
    </script>
</body>
</html>