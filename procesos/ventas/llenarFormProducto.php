<?php 
	
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$obj= new ventas();
	$idproducto=$_POST['idproducto'];
	$categoria=$_REQUEST['categoria'];


	echo json_encode($obj->obtenDatosProducto($idproducto,$categoria))

 ?>