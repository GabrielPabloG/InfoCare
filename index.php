<!DOCTYPE html>
<html lang="en">
<head>
    
	<title>InfoCare</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="css/styleLogin.css">
    <link href="../css/home.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="img/infocare-logo.png" />
    
</head>
<body>
       <header class="cabecalho">
           <a href="index.php"> <h1 class="logo"></h1>
            </a>
            <div class="menu">
               <nav>
                   <ul>
                      
                   </ul>
                </nav>
            </div>
       </header>
    <br><br>

                <!--textbox login-->
				<form class="box" action="Controller/rotinasLogar.php" method="post">
                    <br><br><br><br>
                     <h2>O cuidado para quem você ama</h2>
                    <div class="form">
                        <h3>Acesse sua conta</h3>
                        <br>
						<input class="input100" type="email" id="emailUser" name="email" placeholder="E-mail">
						<input class="input100" type="password" id="passwordUser" name="senha" placeholder="Senha">
						<button class="login100-form-btn" type="submit">Entrar</button>
                         </div>
				</form>

            
</body>
</html>