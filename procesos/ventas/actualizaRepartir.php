<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Repartidor.php";

	$obj= new repartidor();


	$datos=array(
		    $_POST['venta'],
			$_POST['estado']		
				);


	echo $obj->actualizaRepartir($datos);

	
	
 ?>