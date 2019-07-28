<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Repartidor.php";

	$obj= new repartidor();
	

	echo json_encode($obj->obtenDatosRepartidor($_POST['iD_USUARIO']));

 ?>