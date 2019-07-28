<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new usuarios;
	$fecha=date('Y-m-d h:m:s');

	$datos=array(
			$_POST['idUsuario'],  
		    $_POST['nombreU'] , 
		    $_POST['apellidoU'],  
		    $_POST['usuarioU'],  
		    $_POST['perfilSelectU'],
		    $_POST['estadoU'],
		    $_POST['passwordU']
				);  
	echo $obj->actualizaUsuario($datos);


 ?>