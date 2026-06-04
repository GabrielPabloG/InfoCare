<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>InfoCare</title>
    <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../css/home.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/cssStyle.css">
    <script type="text/javascript" src="prototype.js"></script>
        
    <script type="text/javascript"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>

    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="imagens/favicon.ico">
</head>

<body class="fundo" id="fundoCadastro">


    <header class="cabecalho">
        <a href="../index.php">
            <h1 class="logo"></h1>
        </a>
        <div class="menu">
            <nav>
                <ul>

                </ul>
            </nav>
        </div>
    </header>
    <h1>Registro de prontuário: </h1>



    <div class="box" style="margin-top: 1em;">

        <!--<form action='criarProntuario.php' method='post'>
            <div class="form-row">
                <div class="form-group col-md-3 col-sm-6 col-15">
                    <input type='text' class="form-control" id='cpfIdoso' name='cpfIdoso' required='' placeholder='CPF do Idoso' value="<?php $cpfIdoso = $_POST['cpfIdoso'];?>">
                </div>

                <script type="text/javascript">$("#cpfIdoso").mask("999.999.999-99");</script>

                <div class="form-group col-md-2 col-sm-5 col-5">
                    <input type='submit' class="btn btn-primary" value='Procurar'>
                </div>
                <div class="enviarM">
                    <div class="enviarM">
                    <a href="homeFuncionario.php" id="registerUser">Voltar</a>
                    
                </div>
                    
                </div>
            </div>
        </form>-->

        <?php 
            include_once ("verificacao.php");
            include_once '../Dao/conexao.php';
            include_once '../Model/Idoso.php';
                
            $cpfIdoso = $_POST['cpfIdoso'];
    
            $conexao = abrirConexao();
            
            $prontuario = "SELECT tbIdoso.codIdoso, tbIdoso.nomeIdoso, tbIdoso.sexoIdoso, tbIdoso.cpfIdoso, tbIdoso.nascIdoso
            FROM tbIdoso
            WHERE tbIdoso.cpfIdoso = '".$cpfIdoso."'";
            //echo($prontuario);
            
            $resultado = $conexao->query($prontuario);
            
            $numresultado = mysqli_num_rows($resultado);
            
            if($numresultado > 0) {
                 while($linharesultado = mysqli_fetch_array($resultado)){
                    $nome = $linharesultado['nomeIdoso'];
                    $cpf = $linharesultado['cpfIdoso'];
                    $sexo = $linharesultado['sexoIdoso'];
                    $nasc = date_create($linharesultado['nascIdoso']);
                    $cod = $linharesultado['codIdoso'];
                }
                
                $consulta = "SELECT nomeFoto FROM foto WHERE codIdoso = ".$cod;
    
                $resultado = $conexao->query($consulta);
                
                $numresultado = mysqli_num_rows($resultado);
                if($numresultado > 0) {
                    while($linharesultado = mysqli_fetch_array($resultado)){
                        $img = $linharesultado['nomeFoto'];
                    }
                }
                
            echo'
                <div>
                <img src="../upload/'.$img.'" class="avatar"> 
                <h1>Nome: '.$nome.'</h1> 
                <h2>CPF: '.$cpf.'</h2> 
                <h4>Género: '.$sexo.'</h4> 
                <h4>Nascimento: '.date_format($nasc, 'd-m-Y').'</h4> 
                </div>
                
                <form action="../Controller/rotinasCadastroProntuario.php" method="post">

            <div class="form-row">
                <div class="form-group col-md-2 col-sm-4">
                    <label>Código: </label><input type="text" class="form-control" id="codIdoso" name="codIdoso" required="" placeholder="código Idoso" value='.$cod.' readonly=“true”>
                </div>
                
                <div class="form-group col-md-2 col-sm-4">
                    <label>Observações: </label><input type="text" class="form-control" id="descProntuario" name="descProntuario" required="" placeholder="Observações do dia">
                </div>
                
                <!--<fieldset class="form-group">
                    <label>Tomou Remedio?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tomouRemedio" id="tomouRemedio" value="Sim">
                        <label class="form-check-label" for="tomouRemedio">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tomouRemedio" id="tomouRemedio" value="Nao">
                        <label class="form-check-label" for="tomouRemedio">
                            Não
                        </label>
                        </div>
              </fieldset>-->
              <div class="enviarM">
                    <a href="homeFuncionario.php" id="registerUser">Voltar</a>
                    <input type="submit" class="btn btn-primary" id="loginUser" name="login" value="Registrar">
                </div>
            </div>
        </form>
            ';
            } 
        ?>

    </div>
    <?php
           include_once ("verificacao.php");
       ?>


</body>

</html>
