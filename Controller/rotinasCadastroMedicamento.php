<?php
	require_once '../Model/Medicamento.php';
	require_once '../Dao/DaoMedicamento.php';
	
	$medicamento = new Medicamento();
	$daoMedicamento = new DaoMedicamento();
	
	$medicamento->setNomeMedicamento($_POST['nomeMedicamento']);
    $medicamento->setDosagemMedicamento($_POST['dosagemMedicamento']);
    $medicamento->setHorarioMedicamento($_POST['horarioMedicamento']);

	echo($daoMedicamento->cadastrarMedicamento($medicamento));
	
?>