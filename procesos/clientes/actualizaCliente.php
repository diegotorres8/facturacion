<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new clientes();
if($_POST['passwordU']!==''){
$pass=sha1($_POST['passwordU']);
}
else{
	$pass=NULL;
}

	$datos=array(
		    $_POST['cedulaU'],
			$_POST['nombreU'],
			$_POST['apellidoU'],
			$_POST['calle_principalU'],
			$_POST['ncasaU'],
			$_POST['calle_secundariaU'],
			$_POST['emailU'],
			$_POST['telefonoU']	,
				$pass	
				);

	echo $obj->actualizaCliente($datos);

	
	
 ?>