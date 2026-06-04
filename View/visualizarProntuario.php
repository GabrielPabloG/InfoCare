<html>

<head>
    <meta charset="UTF-8">
    <title>InfoCare</title>
    <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../css/cssGerente.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="prototype.js"></script>
</head>

<body>
    <?php 
            include_once ("verificacao.php");
            include_once '../Dao/conexao.php';
            include_once '../Model/Idoso.php';
    
            $conexao = abrirConexao();
            
            echo'
                <header class="cabecalho">
                    <a href="../View/homeResponsavel.php"> <h1 class="logo"></h1></a>
                <div class="menu">
                    <nav>
                        <ul>
                            <li><a href="homeResponsavel.php" id="registerUser">Voltar</a></li>
                            <li><a href="logout.php" id="registerUser">Sair</a></li>
                        </ul>
                    </nav>
                </div>
                </header>
            ';
                
            $prontuario = "SELECT tbIdoso.codIdoso, tbIdoso.nomeIdoso, tbIdoso.sexoIdoso, tbIdoso.cpfIdoso, tbIdoso.nascIdoso, 
            tbProntuarioDiario.descProntuario, tbProntuarioDiario.dataProntuario
            FROM tbProntuarioDiario
            INNER JOIN tbIdoso
            ON tbProntuarioDiario.codIdoso = tbIdoso.codIdoso
            INNER JOIN tbResponsavel
            ON tbResponsavel.codResponsavel = tbIdoso.codResponsavel
            WHERE tbResponsavel.codResponsavel = ".$_SESSION['codUsuario']."
            ORDER BY codProntuario DESC";
            //echo($prontuario);
            
            $resultado = $conexao->query($prontuario);
            $i = 0;
            while($linharesultado = mysqli_fetch_array($resultado)){
                    $cod = $linharesultado['codIdoso'];
                    $nome = $linharesultado['nomeIdoso'];
                    $cpf = $linharesultado['cpfIdoso'];
                    $sexo = $linharesultado['sexoIdoso'];
                    $nasc = $linharesultado['nascIdoso'];
                    $desc = $linharesultado['descProntuario'];
                    $data = date_create($linharesultado['dataProntuario']);
                
                $consulta = "SELECT nomeFoto FROM foto WHERE codIdoso = ".$cod;
    
                $resultado = $conexao->query($consulta);
                
                $numresultado = mysqli_num_rows($resultado);
                if($numresultado > 0) {
                    while($linharesultado = mysqli_fetch_array($resultado)){
                        $img = $linharesultado['nomeFoto'];
                    }
                }
                
                if($desc != "") {
                    echo'<br> <br> <br> <br>
                <img src="../upload/'.$img.'" class="avatar"> 
                <h1>Nome: '.$nome.'</h1> <h2>CPF: '.$cpf.'</h2> <h4>Género: '.$sexo.'</h4> <h4>Nascimento: '.$nasc.'</h4> 
                <h6>Observações: '.$desc.'</h6> <h6>Data do prontuario: '.date_format($data, 'd-m-Y').'</h6>
            ';
                }
                $i++;
                }
                
            
        ?>

</body>

</html>
