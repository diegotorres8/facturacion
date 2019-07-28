<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();

   $pass=sha1($_POST['password']);
	$datos=array(
		    $_POST['cedula'],
			$_POST['nombre'],
			$_POST['apellidos'],
			$_POST['calle_principal'],
			$_POST['ncasa'],
			$_POST['calle_secundaria'],
			$_POST['email'],
			$_POST['telefono'],
			$pass
				);
	echo $obj->agregaCliente($datos);

	
	
 ?>