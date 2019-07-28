<?php 
session_start();
if(isset($_SESSION['usuario'])){
	require_once "../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();
	$usuario=$_SESSION['usuario'];

	$sql="SELECT 	desp.id_venta,
	CASE
when desp.estado='A' THEN
'Activo'
when desp.estado='C'THEN
   'Cancelado'
  when desp.estado='E'THEN
  'Entregado' 
  end estado
	,desp.fecha_asignado,ciu.nombre_ciudad,sec.nombre_sector
,usuario,vent.CEDULA,concat(cli.NOMBRe,' ', cli.apellido) cliente , 
concat(vent.CALLE_PRINCIPAL,' ',vent.NUMERO_CASA,' ',vent.CALLE_SECUNDARIA) direccion,desp.fecha_entregado
from despacho_ventas as desp
inner join repartidores as rep
on desp.id_ciudad=rep.id_ciudad
and desp.id_sector=rep.id_sector
inner join usuario as  usu
on rep.id_usuario=usu.id_usuario
and (usuario='$usuario' or '$usuario'='admin')
inner join sector as sec
on sec.id_ciudad=desp.id_ciudad
and sec.id_sector=desp.ID_SECTOR
inner join ciudad  as ciu
on ciu.id_ciudad=desp.id_ciudad
INNER JOIN venta as vent 
on vent.id_venta=desp.ID_VENTA
and vent.id_ciudad=desp.id_ciudad
and vent.id_sector=desp.id_sector
INNER JOIN cliente as cli
on cli.cedula=vent.CEDULA
ORDER BY fecha_asignado asc";
	$result=mysqli_query($conexion,$sql);
 ?>



	<!DOCTYPE html>
	<html>
	<head>
		<title>Estado de Entregas</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Estado de Entregas</h1>
			
					<div class="table-responsive">
	
	 <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		 	<tr >
	 		<td>Venta</td>
	 		<td>Estado</td>
	 		<td>Fecha_Asignado</td>
	 		<td>Fecha_Entregado</td>
	 		<td>Cliente</td>
	 		<td>C.I.Cliente</td>
	 		<td>Ciudad</td>
	 		<td>Sector</td>
	 		<td>Dirección</td>
	 		
	 	</tr>

	<?php
	while ($ver=mysqli_fetch_row($result)):
	 ?>
	 		 
	 	<tr <?php  if ($ver[1]=="Activo"){?> bgcolor="yellow" <?php }
	 	elseif  ($ver[1]=="Entregado"){?> bgcolor="green" <?php }
	 		elseif  ($ver[1]=="Cancelado"){?> bgcolor="red" <?php }?>>
	 		<td><?php echo $ver[0]; ?> </td>
	 		<td> <?php echo $ver[1]; ?>	</td>
	 		<td><?php echo $ver[2]; ?></td>
	 		<td><?php echo $ver[9]; ?></td>
	 		<td><?php echo $ver[7]; ?></td>
	 		<td><?php echo $ver[6]; ?></td>
	 		<td><?php echo $ver[3]; ?></td>
	 		<td><?php echo $ver[4]; ?></td>
	 		<td><?php echo $ver[8]; ?></td>

	 					
	 	</tr>
	 <?php endwhile ?>
	 </table>
	 <p></p>
	
</div>
			
		</div>

	
	</body>
	</html>

	

	
	<?php 
}else{
	header("location:../index.php");
}
?>