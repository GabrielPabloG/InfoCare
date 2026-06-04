<?php

session_start();
session_unset();

unset  ($_SESSION['emailSessao']);
unset  ($_SESSION['senhaSessao']);

session_destroy();
header ("Location: ../index.php");

?>