<?php 
session_start();
require_once 'verificacao.php';
require_once '../Dao/conexao.php';

// Proteção: Se não recebeu o CPF do paciente via POST, manda de volta para a Home
if (!isset($_POST['cpfIdoso']) || empty($_POST['cpfIdoso'])) {
    header("Location: homeFuncionario.php");
    exit();
}

$cpfIdoso = $_POST['cpfIdoso'];
$conn = Conexao::getConexao();

try {
    // 1. Buscar os dados do Idoso pelo CPF
    $sql = "SELECT id, nome, cpf, sexo, nascimento FROM idoso WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$cpfIdoso]);
    $idoso = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$idoso) {
        die("<h2>Erro: Paciente não encontrado no sistema.</h2> <a href='homeFuncionario.php'>Voltar</a>");
    }

    // 2. Buscar a foto do Idoso (Polimorfismo)
    $img = 'user.png';
    $sqlFoto = "SELECT nomeFoto FROM foto WHERE entidade_tipo = 'idoso' AND entidade_id = ? ORDER BY dataFoto DESC LIMIT 1";
    $stmtFoto = $conn->prepare($sqlFoto);
    $stmtFoto->execute([$idoso['id']]);
    
    if ($fotoDb = $stmtFoto->fetch(PDO::FETCH_ASSOC)) {
        $img = $fotoDb['nomeFoto'];
    }

} catch (PDOException $e) {
    die("Erro ao buscar dados do paciente: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoCare - Prontuário Diário</title>
    
    <link href="../cssCadastro/css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../css/home.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/cssStyle.css">
    
    <script src="../js/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="imagens/favicon.ico">
    
    <style>
        .perfil-paciente {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .avatar-paciente {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #34677D;
        }
    </style>
</head>

<body class="fundo" id="fundoCadastro">

    <header class="cabecalho">
        <a href="homeFuncionario.php"><h1 class="logo"></h1></a>
        <div class="menu"><nav><ul></ul></nav></div>
    </header>

    <div class="container" style="margin-top: 4em;">
        <h2 style="color: white; text-shadow: 1px 1px 2px black;">Registro de Prontuário Diário</h2>
        <br>
        
        <div class="perfil-paciente">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="../upload/<?php echo $img; ?>" class="avatar-paciente" alt="Foto do Paciente">
                </div>
                <div class="col-md-9" style="padding-top: 15px;">
                    <h3 style="color: #34677D;"><b><?php echo htmlspecialchars($idoso['nome']); ?></b></h3>
                    <p><b>CPF:</b> <?php echo htmlspecialchars($idoso['cpf']); ?> &nbsp; | &nbsp; <b>Gênero:</b> <?php echo htmlspecialchars($idoso['sexo']); ?></p>
                    <p><b>Nascimento:</b> <?php echo date('d/m/Y', strtotime($idoso['nascimento'])); ?></p>
                </div>
            </div>
            
            <hr>
            
            <form action="../Controller/rotinasCadastroProntuarioDiario.php" method="post">
                
                <input type="hidden" name="idoso_id" value="<?php echo $idoso['id']; ?>">
                
                <div class="form-group">
                    <label style="font-size: 18px; color: #34677D;"><b>Observações do dia:</b></label>
                    <textarea class="form-control" id="observacao" name="observacao" rows="5" required placeholder="Escreva como o paciente passou o dia, se tomou as medicações, como foi a alimentação, pressão arterial, etc."></textarea>
                </div>
                
                <div class="text-right mt-4 mb-2">
                    <a href="homeFuncionario.php" class="btn btn-secondary">Voltar</a>
                    <input type="submit" class="btn btn-primary" style="background-color: #34677D; border: none;" value="Registrar Prontuário">
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>