<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
		
	$idcategoria = $_POST['id_categoria'];
	$sql="SELECT id_producto,nombre
				from articulos
				where id_categoria=$idcategoria";
				$result=mysqli_query($conexion,$sql);
	
	
	$html= "<option value='0'>Seleccionar Producto</option>";
	
	while($row = $result->fetch_assoc())
	{
		$html.= "<option value='".$row['id_producto']."'>".$row['nombre']."</option>";
	}
	
	echo $html;
	

?>