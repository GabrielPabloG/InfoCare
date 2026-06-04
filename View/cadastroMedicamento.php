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
        <link href="../css/cssGerente.css" type="text/css" rel="stylesheet">
        
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
        <br>
        <br>
        <br>
        <br>
        <br>
                <h3>Informar Medicamento:</h3>
        <div class="box" style="margin-top: 1em;">
            
        <form action="../Controller/rotinasCadastroMedicamento.php" method="post">
            
            <div class="form-row">
                <div class="form-group col-md-2 col-sm-4">
                    <input type="text" class="form-control" id="nomeMedicamento" name="nomeMedicamento" required="" placeholder="Nome da medicação">
                </div>
                
                <div class="form-group col-md-2 col-sm-4">
                    <input type="text" class="form-control" id="dosagemMedicamento" name="dosagemMedicamento" required="" placeholder="Dosagem">
                </div>
                
                <div class="form-group col-md-2 col-sm-4">
                    <input type="time" class="form-control" id="horarioMedicamento" name="horarioMedicamento" required="" placeholder="Horário da medicação">
                </div>
                


            </div>
            
            <div class="enviarM">
                <a href="homeGerente.php" id="registerUser">Voltar</a>&nbsp;&nbsp;&nbsp;
                <input type="submit" class="btn btn-primary" id="loginUser" name="login" value="Cadastrar">
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
