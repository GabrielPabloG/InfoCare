<?php 
session_start();
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// LÓGICA DE BUSCA DA FOTO (Usando a nova arquitetura de foto polimórfica)
$imgPerfil = 'user.png';
try {
    $stmtFoto = $conn->prepare("SELECT nomeFoto FROM foto WHERE entidade_tipo = 'funcionario' AND entidade_id = ? ORDER BY dataFoto DESC LIMIT 1");
    $stmtFoto->execute([$_SESSION['user_id']]);
    if ($fotoDb = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {
        $imgPerfil = $fotoDb['nomeFoto'];
    }
} catch (PDOException $e) {}

// QUERY PARA BUSCAR TODOS OS CUIDADORES (Usando PDO e nomes limpos)
try {
    $sqlCuidadores = "SELECT id, nome, cpf, sexo, nascimento, email, rua, bairro, numero_casa FROM funcionario ORDER BY nome ASC";
    $stmtCuidadores = $conn->query($sqlCuidadores);
    $resultado_cuidadores = $stmtCuidadores->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar cuidadores: " . $e->getMessage();
    $resultado_cuidadores = [];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>InfoCare - Cuidadores</title>
        <link href="../css/default.css" rel="stylesheet">
        <link href="../css/component.css" rel="stylesheet">
        <link href="../cssModal/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/Ger.css">
        <link rel="icon" type="image/png" href="../img/infocare-logo.png"/>

        <script src="../js/modernizr.custom.js"></script>
        <script src="../js/jquery.min.js"></script>
    </head>
    
    <body>
        <div class="cabecalho">
           <a href="../View/homeGerente.php"><h1 class="logo"></h1></a>
             <div class="novomenu">
                <div id="dl-menu" class="dl-menuwrapper">
                    <br><br>
                    <button class="dl-trigger" style="background-color: transparent"></button>
                    <ul class="dl-menu" style=" background-color: rgba(52,103,125,0.8);">
                        <li><a href="../View/listarRes.php">Responsáveis</a></li>
                        <li><a href="../View/listCuidador.php">Cuidadores</a></li>
                        <li><a href="../View/homeGerente.php">Pacientes</a></li>
                        <li><a href="../View/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <br><br><br><br>
        <div class="lixo">
            <div class="loginbox">
                <form action="../Controller/atualizarFoto.php" method="post" enctype="multipart/form-data">
                    <img src="../upload/<?php echo $imgPerfil; ?>" class="avatar">
                    <input type='file' required name='foto' style='opacity: 0; margin-top: 30%; cursor: pointer;' onchange="this.form.submit()">
                </form>
                <h1><?php echo $_SESSION['user_nome']; ?></h1>
                <div class="indicador"><p>Gerente</p></div>
                <ul><br><hr style="height:2px; border:none; width: 220px; background-color:#fff; margin:0;"/>
                    <li><a href="atualizarGerente.php"><i class="fas fa-user" aria-hidden="true"></i>Perfil</a></li>
                </ul>
            </div>
        </div>

        <div id="containerM" role="main">
            <div class="page-header">
                <h1>Cuidadores Cadastrados</h1>
                <form action="cadastroCuidador.php">
                    <button type="submit" class="btn btn-success">+ Adicionar Cuidador</button>
                </form>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultado_cuidadores as $c): ?>
                        <tr>
                            <td><?php echo $c['id']; ?></td>
                            <td><?php echo $c['nome']; ?></td>
                            <td><?php echo $c['cpf']; ?></td>
                            <td>
                                <button type="button" class="btn btn-xs btn-primaryM" data-toggle="modal" data-target="#modalVisualizar<?php echo $c['id']; ?>">Visualizar</button>
                                
                                <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEditar" 
                                    data-id="<?php echo $c['id']; ?>" 
                                    data-nome="<?php echo $c['nome']; ?>" 
                                    data-sexo="<?php echo $c['sexo']; ?>"
                                    data-cpf="<?php echo $c['cpf']; ?>" 
                                    data-nasc="<?php echo $c['nascimento']; ?>" 
                                    data-email="<?php echo $c['email']; ?>">Editar</button>
                                
                                <form action="../Controller/apagarCuidador.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                                    <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Apagar este cuidador?')">Apagar</button>
                                </form>
                            </td>
                        </tr>
                        
                        <div class="modal fade" id="modalVisualizar<?php echo $c['id']; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $c['nome']; ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><b>E-mail:</b> <?php echo $c['email']; ?></p>
                                        <p><b>Endereço:</b> <?php echo $c['rua'] . ', ' . $c['numero_casa'] . ' - ' . $c['bairro']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
             </table>
        </div>
        
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Cuidador</h4>
              </div>
              <div class="modal-body">
                <form method="POST" action="../Controller/rotinasAtualizarFuncionario.php">
                  <input name="id" type="hidden" id="modal-id">
                  <div class="form-group">
                    <label>Nome:</label>
                    <input name="nome" type="text" class="form-control" id="modal-nome" required>
                  </div>
                  <div class="form-group">
                    <label>CPF:</label>
                    <input name="cpf" type="text" class="form-control" id="modal-cpf">
                  </div>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
              </div>
            </div>
          </div>
        </div>

    <script src="../cssModal/js/bootstrap.min.js"></script>
    <script src="../js/jquery.dlmenu.js"></script>
    <script type="text/javascript">
        $('#modalEditar').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var modal = $(this);
          modal.find('#modal-id').val(button.data('id'));
          modal.find('#modal-nome').val(button.data('nome'));
          modal.find('#modal-cpf').val(button.data('cpf'));
        });
        
        $(function() {
            $( '#dl-menu' ).dlmenu({
                animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
            });
        });
    </script>
    </body>
</html>