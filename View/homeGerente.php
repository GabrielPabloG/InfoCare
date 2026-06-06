<?php 
session_start();
require_once 'verificacao.php'; // Protege a página
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// LÓGICA DE BUSCA DA FOTO DE PERFIL (Usando a nova estrutura Polimórfica)
$imgPerfil = 'user.png';
try {
    $stmtFoto = $conn->prepare("SELECT nomeFoto FROM foto WHERE entidade_tipo = 'gerente' AND entidade_id = ? ORDER BY dataFoto DESC LIMIT 1");
    $stmtFoto->execute([$_SESSION['user_id']]);
    if ($fotoDb = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {
        $imgPerfil = $fotoDb['nomeFoto'];
    }
} catch (PDOException $e) {
    // Falha silenciosa para a foto
}

// A SUPER QUERY DE BUSCA DOS PACIENTES E PRONTUÁRIOS (Atualizada para o novo Banco e com LEFT JOIN)
$sqlIdosos = "
    SELECT 
        i.id, i.nome, i.sexo, i.cpf, i.nascimento,
        r.nome AS nomeResponsavel,
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
    ORDER BY i.nome ASC
";
$stmtIdosos = $conn->query($sqlIdosos);
$resultado_idoso = $stmtIdosos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>InfoCare - Painel do Gerente</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="../css/default.css" rel="stylesheet">
        <link href="../css/component.css" rel="stylesheet">
        <link href="../cssModal/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/Ger.css">
        <link rel="icon" type="image/png" href="../img/infocare-logo.png"/>

        <script src="../js/modernizr.custom.js"></script>
    </head>
    
    <body>
        <div class="cabecalho">
           <a href="../View/homeGerente.php"> <h1 class="logo"></h1></a>
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
                
                <h1><?php echo isset($_SESSION['user_nome']) ? $_SESSION['user_nome'] : 'Gerente'; ?></h1>
                <div class="indicador"><p>Gerente</p></div>
                <ul>
                    <br>
                    <hr style="height:2px; border:none; width: 220px; background-color:#fff; margin: 0;"/>
                    <li><a href="atualizarGerente.php"><i class="fas fa-user" aria-hidden="true"></i>Perfil</a></li>
                    <br> <br>
                </ul>
            </div>
            
            <?php
            // Exibe mensagens de sucesso/erro vindas dos controladores
            if(isset($_GET['excluido'])) echo "<p class='text-danger text-center'><strong>Registro excluído com sucesso.</strong></p>";
            if(isset($_GET['atualizado'])) echo "<p class='text-success text-center'><strong>Registro atualizado com sucesso.</strong></p>";
            ?>    
        </div>
        
        <div id="containerM" role="main">
            <div class="page-header" style="margin-top: -5%;">
                <h1>Pacientes Cadastrados</h1>
                <form action="cadastroIdosoTab.php">
                    <button type="submit" class="btn btn-success" style="font-family:comfortaa; font-size: 17px;">+ Adicionar Idoso</button>  
                </form>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome do Paciente</th>
                                <th>CPF do Paciente</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultado_idoso as $rows_idoso): ?>
                                <tr>
                                    <td><?php echo $rows_idoso['id']; ?></td>
                                    <td><?php echo $rows_idoso['nome']; ?></td>
                                    <td><?php echo $rows_idoso['cpf']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-primaryM" data-toggle="modal" data-target="#myModal<?php echo $rows_idoso['id']; ?>">Visualizar</button>
                                        
                                        <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $rows_idoso['id']; ?>" data-nome="<?php echo $rows_idoso['nome']; ?>" data-sexo="<?php echo $rows_idoso['sexo']; ?>">Editar</button>
                                        
                                        <form action="../Controller/apagarIdoso.php" method="GET" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo $rows_idoso['id']; ?>">
                                            <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja apagar este paciente?')">Apagar</button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <div class="modal fade" id="myModal<?php echo $rows_idoso['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title text-center" id="myModalLabel"><?php echo $rows_idoso['nome']; ?></h4>
                                            </div>
                                            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                                <p><b>Código:</b> <?php echo $rows_idoso['id']; ?></p>
                                                <p><b>Nome:</b> <?php echo $rows_idoso['nome']; ?></p>
                                                <p><b>Sexo:</b> <?php echo $rows_idoso['sexo']; ?></p>
                                                <p><b>Nascimento:</b> <?php echo date('d/m/Y', strtotime($rows_idoso['nascimento'])); ?></p>
                                                <p><b>Responsável:</b> <?php echo $rows_idoso['nomeResponsavel'] ? $rows_idoso['nomeResponsavel'] : 'Não vinculado'; ?></p>
                                                <hr>
                                                
                                                <p><b>ANTECEDÊNCIA</b></p>
                                                <p>Declínio Cognitivo: <?php echo $rows_idoso['declinioCongnitivo']; ?></p>
                                                <p>Dificuldade Fala: <?php echo $rows_idoso['dificuldadeFala']; ?></p>
                                                <p>Hipertensão Arterial: <?php echo $rows_idoso['hipertensaoArterial']; ?></p>
                                                <p><small><i>Abra o prontuário completo para visualizar todos os dados clínicos detalhados.</i></small></p>
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
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Editar Paciente</h4>
              </div>
              <div class="modal-body">
                <form method="POST" action="../Controller/atualizarIdoso.php">
                  <div class="form-group">
                    <label class="control-label">Nome:</label>
                    <input name="nome" type="text" class="form-control" id="modal-nome">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Sexo:</label>
                    <select name="sexo" class="form-control" id="modal-sexo">
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                  </div>
                  <input name="id" type="hidden" id="modal-id" value="">
                  
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
              </div>
            </div>
          </div>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../cssModal/js/bootstrap.min.js"></script>
    <script src="../js/jquery.dlmenu.js"></script>
    
    <script type="text/javascript">
        // Preenche o Modal de Edição com os dados da tabela
        $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id = button.data('id');
          var nome = button.data('nome');
          var sexo = button.data('sexo');
          
          var modal = $(this);
          modal.find('.modal-title').text('Editar Paciente ID ' + id);
          modal.find('#modal-id').val(id);
          modal.find('#modal-nome').val(nome);
          modal.find('#modal-sexo').val(sexo);
        });

        // Script do Menu Lateral
        $(function() {
            $( '#dl-menu' ).dlmenu({
                animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
            });
        });
    </script>           
    </body>
</html>