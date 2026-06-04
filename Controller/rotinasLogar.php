  <?php   

include_once '../Dao/conexao.php';
include_once '../Dao/ControleAcessoIC.php';

$controleAcesso = new ControleAcessoIC();
 
 $email = $_POST['email'];
$senha = $_POST['senha'];

echo($controleAcesso->logar($email, $senha));

?>