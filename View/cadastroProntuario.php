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
        <link rel="stylesheet" type="text/css" href="../css/cssStyle.css">
        <script type="text/javascript" src="prototype.js"></script>
        <script type="text/javascript" language="javascript">
        </script>
        
         <link href="css/style.css" type="text/css" rel="stylesheet">   
          <link rel="shortcut icon" type="image/x-icon" href="imagens/favicon.ico">
    </head>
    <body class="fundo" id="fundoCadastro">
        
    
       <header class="cabecalho">
           <a href="../index.php"> <h1 class="logo"></h1>
            </a>
            <div class="menu">
               <nav>
                   <ul>
                      
                   </ul>
                </nav>
            </div>
        </header>
                <h1>Informar prontuário</h1>
        
        
        
        <div class="box" style="margin-top: 1em;">
            
        <form action="../Controller/rotinasCadastroProntuario.php" method="post">
            
            <div class="conta" id="cadastro">
                <div id="descProntuario">
                    <input type="text" id="descProntuario" name="descProntuario" required="" placeholder="Descrição prontuário">
                </div>
                
                <div id="dataProntuario">
                    <input type="date" id="dataProntuario" name="dataProntuario" required="" placeholder="Data">
                </div>
                <h2>Diagnóstico Enfermagem:</h2>
            <div class="form-row">
                <div class="form-group  col-md-2 col-sm-4 col-10">
                    <input type="text" class="form-control" id="diagnosticoEnfermagem" name="diagnosticoEnfermagem" required="" placeholder="diagnosticoEnfermagem">
                </div>
            </div>
            <h2>Prescrição Enfermagem:</h2>
            <div class="form-row">
                <div class="form-group  col-md-2 col-sm-4 col-10">
                    <input type="text" class="form-control" id="prescricaoEnfermagem" name="prescricaoEnfermagem" required="" placeholder="prescricaoEnfermagem">
                </div>
                <div class="form-group  col-md-2 col-sm-4 col-10">
                    <input type="text" class="form-control" id="aprazamentoEnfermagem" name="aprazamentoEnfermagem" required="" placeholder="aprazamentoEnfermagem">
                </div>
            </div>
            </div>
            
            <div class="enviar">
                <a href="homeFuncionario.php" id="registerUser">Voltar</a>
                <input type="submit" id="loginUser" name="login" value="Registrar">
            </div>
            
        </form>
        <div class="extras">
           
        </div>
         </div>
            <?php
           // include_once ("verificacao.php");
       ?>
        
        
    </body>
</html>
