<?php 
session_start();
require_once 'verificacao.php'; // Protege a página para que só o ADM entre
require_once '../Dao/conexao.php';

$conn = Conexao::getConexao();

// LÓGICA DE BUSCA DA FOTO DE PERFIL DO ADM
$imgPerfil = 'user.png';
try {
    // Usamos entidade_tipo = 'admin' de acordo com a nossa nova arquitetura Polimórfica
    $stmtFoto = $conn->prepare("SELECT nomeFoto FROM foto WHERE entidade_tipo = 'admin' AND entidade_id = ? ORDER BY dataFoto DESC LIMIT 1");
    $stmtFoto->execute([$_SESSION['user_id']]);
    if ($fotoDb = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {
        $imgPerfil = $fotoDb['nomeFoto'];
    }
} catch (PDOException $e) {
    // Falha silenciosa para a foto
}

// QUERY PARA BUSCAR TODOS OS GERENTES USANDO O PDO E O BANCO NOVO
try {
    $sqlGerentes = "SELECT id, nome, cpf, sexo, nascimento, email FROM gerente ORDER BY nome ASC";
    $stmtGerentes = $conn->query($sqlGerentes);
    $resultado_gerentes = $stmtGerentes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar gerentes: " . $e->getMessage();
    $resultado_gerentes = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>InfoCare - Painel do Administrador</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="../css/default.css" rel="stylesheet">
    <link href="../css/component.css" rel="stylesheet">
    <link href="../cssModal/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/adm.css">
    
    <script type="text/javascript" src="prototype.js"></script>
    <script src="../js/modernizr.custom.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    
    <script type="text/javascript" language="javascript">
        // Função única e limpa para validação de CPF
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
    </script>
</head>

<body>
    <header class="cabecalho">
       <a href="../View/homeAdm.php"><h1 class="logo"></h1></a>
        <div class="novomenu">
            <div id="dl-menu" class="dl-menuwrapper">
              <br><br>
                <button class="dl-trigger" style="background-color: transparent"></button>
                <ul class="dl-menu" style="background-color: rgba(52,103,125,0.8);">
                    <li><a href="#containerM">Gerentes</a></li>
                    <li><a href="../View/logout.php">Sair</a></li>
                </ul>
             </div>
        </div>
    </header>

    <div class="lixo">
        <div class="loginbox">
            <form action="../Controller/atualizarFoto.php" method="post" enctype="multipart/form-data">
                <img src="../upload/<?php echo $imgPerfil; ?>" class="avatar"> 
                <input type='file' required name='foto' style='opacity: 0; margin-top: 30%; cursor: pointer;' onchange="this.form.submit()">
            </form>
            
            <h1><?php echo isset($_SESSION['user_nome']) ? $_SESSION['user_nome'] : 'Administrador'; ?></h1>
            <div class="indicador"><p>Administrador(a)</p></div>
            <br>
        </div>
        
        <?php
        // Mensagens de Feedback dinâmicas
        if(isset($_GET['excluido'])) echo "<p class='text-danger text-center' style='position:relative; z-index:9999;'><strong>Gerente excluído com sucesso.</strong></p>";
        if(isset($_GET['atualizado'])) echo "<p class='text-success text-center' style='position:relative; z-index:9999;'><strong>Gerente atualizado com sucesso.</strong></p>";
        ?>
    </div>

    <div id="containerM" role="main">
        <div class="page-header" style="margin-top: -5%;">
            <h1>Gerentes Cadastrados</h1>
            <form action="cadastroGerente.php">
                <button type="submit" class="btn btn-success" style="font-family:comfortaa; font-size: 17px;">+ Adicionar Gerente</button>
            </form>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <table class="table">
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
                                    <button type="button" class="btn btn-xs btn-primaryM" data-toggle="modal" data-target="#myModal<?php echo $rows_gerente['id']; ?>">Visualizar</button>
                                    
                                    <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#exampleModal" 
                                        data-id="<?php echo $rows_gerente['id']; ?>" 
                                        data-nome="<?php echo $rows_gerente['nome']; ?>"
                                        data-sexo="<?php echo $rows_gerente['sexo']; ?>" 
                                        data-cpf="<?php echo $rows_gerente['cpf']; ?>"
                                        data-nasc="<?php echo $rows_gerente['nascimento']; ?>" 
                                        data-email="<?php echo $rows_gerente['email']; ?>">
                                        Editar
                                    </button>
                                    
                                    <form action="../Controller/apagarGerente.php" method="GET" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $rows_gerente['id']; ?>">
                                        <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Tem certeza que deseja apagar este gerente?')">Apagar</button>
                                    </form>
                                </td>
                            </tr>
                            
                            <div class="modal fade" id="myModal<?php echo $rows_gerente['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title text-center" id="myModalLabel"><?php echo $rows_gerente['nome']; ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><b>Código:</b> <?php echo $rows_gerente['id']; ?></p>
                                            <p><b>Nome:</b> <?php echo $rows_gerente['nome']; ?></p>
                                            <p><b>Sexo:</b> <?php echo $rows_gerente['sexo']; ?></p>
                                            <p><b>CPF:</b> <?php echo $rows_gerente['cpf']; ?></p>
                                            <p><b>Nascimento:</b> <?php echo date('d/m/Y', strtotime($rows_gerente['nascimento'])); ?></p>
                                            <p><b>E-mail:</b> <?php echo $rows_gerente['email']; ?></p>
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
            <h4 class="modal-title" id="exampleModalLabel">Editar Gerente</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="../Controller/rotinasAtualizarGerente.php">
              
              <div class="form-group">
                <label class="control-label">Nome:</label>
                <input name="nome" type="text" class="form-control" id="recipient-name" required>
              </div>
              
              <div class="form-group">
                <label class="control-label">Sexo:</label>
                <select name="sexo" class="form-control" id="recipient-sexo">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                </select>
              </div>
              
              <div class="form-group">
                <label class="control-label">CPF:</label>
                <input name="cpf" type="text" class="form-control" id="recipient-cpf" onblur="TestaCPF(this.value);" required>
              </div>
              <script type="text/javascript">$("#recipient-cpf").mask("000.000.000-00");</script>
              
              <div class="form-group">
                <label class="control-label">Data de Nascimento:</label>
                <input name="nascimento" type="date" class="form-control" id="recipient-nasc" required>
              </div>
              
              <div class="form-group">
                <label class="control-label">E-mail:</label>
                <input name="email" type="email" class="form-control" id="recipient-email" required>
              </div>
              
              <input name="id" type="hidden" id="id-gerente" value="">
              
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
    <script src="../js/jquery.dlmenu.js"></script>
    
    <script type="text/javascript">
        // Preenchimento automático do Modal de Edição
        $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          
          var id = button.data('id');
          var nome = button.data('nome');
          var sexo = button.data('sexo');
          var cpf = button.data('cpf');
          var nasc = button.data('nasc');
          var email = button.data('email');
          
          var modal = $(this);
          modal.find('.modal-title').text('Editar Gerente: ' + nome);
          modal.find('#id-gerente').val(id);
          modal.find('#recipient-name').val(nome);
          modal.find('#recipient-sexo').val(sexo);
          modal.find('#recipient-cpf').val(cpf);
          modal.find('#recipient-nasc').val(nasc);
          modal.find('#recipient-email').val(email);
        });

        // Configuração do Menu Lateral Animado
        $(function() {
            $( '#dl-menu' ).dlmenu({
                animationClasses : { classin : 'dl-animate-in-2', classout : 'dl-animate-out-2' }
            });
        });
    </script>
</body>
</html>