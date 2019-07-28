<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	$ciudad=$_POST['ciudad'];
	$tipo=$_REQUEST['tipo'];
	

	$sql="SELECT ID_SECTOR,NOMBRE_SECTOR
											FROM sector
											WHERE ID_CIUDAD='$ciudad'
											AND ESTADO='A'";

	$result=mysqli_query($conexion,$sql);
	
	if ($tipo=1) {					
	$cadena="<select class='form-control input-sm'	 id='sectorSelect' name='sectorSelect'>
	         <option value='A'>Selecciona Sector</option>";
	     }
	elseif ($tipo=2) {
		//
		$cadena="<select class='form-control input-sm'	 id='sectorSelectU' name='sectorSelectU'>
	         <option value='A'>Selecciona Sector</option>";
	}

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena."</select>";
	

?>