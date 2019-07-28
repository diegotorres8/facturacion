<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Repartidor.php";

	$obj= new repartidor();


	$datos=array(
		    $_POST['iD_USUARIOU'],
			$_POST['ciudadSelectU'],		
			$_POST['estadoU'],
			$_POST['sectorSelectU']	);

	echo $obj->actualizaRepartidor($datos);

	
	
 ?>