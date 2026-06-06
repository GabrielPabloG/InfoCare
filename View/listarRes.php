<?php 
session_start();
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// LÓGICA DE BUSCA DA FOTO DO GERENTE (Quem está visualizando a tela)
$imgPerfil = 'user.png';
try {
    $stmtFoto = $conn->prepare("SELECT nomeFoto FROM foto WHERE entidade_tipo = 'gerente' AND entidade_id = ? ORDER BY dataFoto DESC LIMIT 1");
    $stmtFoto->execute([$_SESSION['user_id']]);
    if ($fotoDb = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {
        $imgPerfil = $fotoDb['nomeFoto'];
    }
} catch (PDOException $e) {}

// QUERY PARA BUSCAR TODOS OS RESPONSÁVEIS
try {
    // Não precisa mais de INNER JOIN com endereço, está tudo na mesma tabela!
    $sqlRes = "SELECT id, nome, cpf, sexo, nascimento, email, rua, bairro, cep, numero_casa FROM responsavel ORDER BY nome ASC";
    $stmtRes = $conn->query($sqlRes);
    $resultado_res = $stmtRes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar responsáveis: " . $e->getMessage();
    $resultado_res = [];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>InfoCare - Responsáveis</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="../css/default.css" rel="stylesheet">
        <link href="../css/component.css" rel="stylesheet">
        <link href="../cssModal/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/Ger.css">
        <link rel="icon" type="image/png" href="../img/infocare-logo.png"/>

        <script src="../js/modernizr.custom.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.mask.min.js"></script>
    </head>
    
    <body>
        <div class="cabecalho">
           <a href="../View/homeGerente.php"><h1 class="logo"></h1></a>
             <div class="novomenu">
               <div id="dl-menu" class="dl-menuwrapper">
                  <br><br>
                    <button class="dl-trigger" style="background-color: transparent"></button>
                    <ul class="dl-menu" style="background-color: rgba(52,103,125,0.8);">
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
                
                <h1><?php echo isset($_SESSION['user_nome']) ? $_SESSION['user_nome'] : 'Gerente'; ?></h1>
                <div class="indicador"><p>Gerente</p></div>
                <ul>
                    <br>
                    <hr style="height:2px; border:none; width: 220px; background-color:#fff; margin: 0;"/>
                    <li><a href="atualizarGerente.php"><i class="fas fa-user" aria-hidden="true"></i>Perfil</a></li>
                    <br><br>
                </ul>
            </div>
            
            <?php
            // Mensagens dinâmicas
            if(isset($_GET['excluido'])) echo "<p class='text-danger text-center'><strong>Responsável excluído com sucesso.</strong></p>";
            if(isset($_GET['atualizado'])) echo "<p class='text-success text-center'><strong>Responsável atualizado com sucesso.</strong></p>";
            ?>
        </div>
        
        <div id="containerM" role="main">
            <div class="page-header" style="margin-top: -5%;">
                <h1>Responsáveis Cadastrados</h1>
                <form action="cadastroResponsavel.php">
                    <button type="submit" class="btn btn-success" style="font-family:comfortaa; font-size: 17px;">+ Adicionar Responsável</button>  
                </form>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome do Responsável</th>
                                <th>CPF</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultado_res as $r): ?>
                                <tr>
                                    <td><?php echo $r['id']; ?></td>
                                    <td><?php echo $r['nome']; ?></td>
                                    <td><?php echo $r['cpf']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-primaryM" data-toggle="modal" data-target="#modalVis<?php echo $r['id']; ?>">Visualizar</button>
                                        
                                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEditar" 
                                            data-id="<?php echo $r['id']; ?>" 
                                            data-nome="<?php echo $r['nome']; ?>" 
                                            data-sexo="<?php echo $r['sexo']; ?>" 
                                            data-cpf="<?php echo $r['cpf']; ?>" 
                                            data-nasc="<?php echo $r['nascimento']; ?>" 
                                            data-email="<?php echo $r['email']; ?>"
                                            data-rua="<?php echo $r['rua']; ?>"
                                            data-bairro="<?php echo $r['bairro']; ?>"
                                            data-cep="<?php echo $r['cep']; ?>"
                                            data-num="<?php echo $r['numero_casa']; ?>">Editar</button>
                                        
                                        <form action="../Controller/apagarRes.php" method="GET" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                            <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja apagar este responsável?')">Apagar</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <div class="modal fade" id="modalVis<?php echo $r['id']; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title text-center"><?php echo $r['nome']; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <p><b>Código:</b> <?php echo $r['id']; ?></p>
                                                <p><b>Sexo:</b> <?php echo $r['sexo']; ?></p>
                                                <p><b>CPF:</b> <?php echo $r['cpf']; ?></p>
                                                <p><b>Data Nascimento:</b> <?php echo date('d/m/Y', strtotime($r['nascimento'])); ?></p>
                                                <p><b>E-mail:</b> <?php echo $r['email']; ?></p>
                                                <hr>
                                                <p><b>Rua:</b> <?php echo $r['rua']; ?></p>
                                                <p><b>Bairro:</b> <?php echo $r['bairro']; ?></p>
                                                <p><b>CEP:</b> <?php echo $r['cep']; ?></p>
                                                <p><b>N° Casa:</b> <?php echo $r['numero_casa']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                        </tbody>
                     </table>
                </div>
            </div>      
        </div>
        
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Responsável</h4>
              </div>
              <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <form method="POST" action="../Controller/atualizarResponsavel.php">
                  <input name="id" type="hidden" id="modal-id">
                  
                  <div class="form-group">
                    <label>Nome:</label>
                    <input name="nome" type="text" class="form-control" id="modal-nome" required>
                  </div>
                  <div class="form-group">
                    <label>Sexo:</label>
                    <select name="sexo" class="form-control" id="modal-sexo">
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>CPF:</label>
                    <input name="cpf" type="text" class="form-control" id="modal-cpf" required>
                  </div>
                  <div class="form-group">
                    <label>Data Nascimento:</label>
                    <input name="nascimento" type="date" class="form-control" id="modal-nasc" required>
                  </div>
                  <div class="form-group">
                    <label>E-mail:</label>
                    <input name="email" type="email" class="form-control" id="modal-email" required>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label>CEP:</label>
                    <input name="cep" type="text" class="form-control" id="modal-cep" required>
                  </div>
                  <div class="form-group">
                    <label>Rua:</label>
                    <input name="rua" type="text" class="form-control" id="modal-rua" required>
                  </div>
                  <div class="form-group">
                    <label>Bairro:</label>
                    <input name="bairro" type="text" class="form-control" id="modal-bairro" required>
                  </div>
                  <div class="form-group">
                    <label>Nº Casa:</label>
                    <input name="numero_casa" type="text" class="form-control" id="modal-num" required>
                  </div>
                  
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
              </div>
            </div>
          </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="../cssModal/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
        // Preenche o Modal de Edição com os dados
        $('#modalEditar').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var modal = $(this);
          
          modal.find('.modal-title').text('Editar: ' + button.data('nome'));
          modal.find('#modal-id').val(button.data('id'));
          modal.find('#modal-nome').val(button.data('nome'));
          modal.find('#modal-sexo').val(button.data('sexo'));
          modal.find('#modal-cpf').val(button.data('cpf'));
          modal.find('#modal-nasc').val(button.data('nasc'));
          modal.find('#modal-email').val(button.data('email'));
          modal.find('#modal-rua').val(button.data('rua'));
          modal.find('#modal-bairro').val(button.data('bairro'));
          modal.find('#modal-cep').val(button.data('cep'));
          modal.find('#modal-num').val(button.data('num'));
        });
        
        // Máscaras
        $("#modal-cpf").mask("000.000.000-00");
        $("#modal-cep").mask("00000-000");

        $(function() {
            $( '#dl-menu' ).dlmenu({
                animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
            });
        });
    </script>
    </body>
</html>