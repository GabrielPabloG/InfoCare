<?php 
    include_once 'conexao.php';
    $conexao = abrirConexao();

    $msg = false;

    if(isset($_FILES['foto'])) {
        $extensao = strrchr($_FILES['foto']['name'], '.');
        $novoNome = md5($_FILES['foto']['name']) . $extensao;
        $diretorio = "../upload/";
        
        move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novoNome);
        
        $codIdoso = "SELECT MAX(codIdoso) codIdoso FROM tbIdoso";
                
                $resultado = $conexao->query($codIdoso);

        while($linharesultado = mysqli_fetch_array($resultado)){
            $codIdoso = $linharesultado['codIdoso'];
        }
        
        $sqlCode = "INSERT INTO foto(nomeFoto, dataFoto, codIdoso) VALUES('".$novoNome."', NOW(), ".$codIdoso.")";
        if($conexao->query($sqlCode)) {
            $msg = "Arquivo enviado com sucesso!";
            echo($sqlCode);
            header("Location: ../View/homeGerente.php");
        }
        else {
            echo($sqlCode);
            $msg = "Falha ao enviar o arquivo";
        }
    }
?>