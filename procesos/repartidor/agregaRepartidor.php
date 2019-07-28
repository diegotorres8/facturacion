<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Repartidor.php";

	$obj= new repartidor();


	$datos=array(
		 $_POST['usuarioSelect'],
		 $_POST['ciudadSelect'],
		 $_POST['sectorSelect']
		);

	
	echo $obj->agregaRepartidor($datos);

	
	
 ?>