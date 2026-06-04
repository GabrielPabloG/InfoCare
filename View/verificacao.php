<?php
	
	if(!isset($_SESSION)){session_start();}
	
if (!$_SESSION['emailSessao'] || !$_SESSION['senhaSessao']) {
	header("Location: ../index.php");
}
 

  
?>