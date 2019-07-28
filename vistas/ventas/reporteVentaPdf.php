<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$objv= new ventas();


	$c=new conectar();
	$conexion= $c->conexion();	
	$idventa=$_GET['idventa'];

 $sql="SELECT ve.id_venta,
				ve.fecha_Crea,
				ve.cedula           
			from venta  as ve 
		    inner join detalle_venta as det
		    on ve.id_venta=det.ID_VENTA
		    and ve.id_ciudad=det.ID_CIUDAD
		    and ve.id_sector=det.id_sector
			inner join articulos as art
			on det.id_producto=art.id_producto
		    and det.id_categoria=art.ID_CATEGORIA
			and det.id_venta='$idventa'";

$result=mysqli_query($conexion,$sql);
	$ver=mysqli_fetch_row($result);

	$venta=$ver[0];
	$fecha=$ver[1];
	$idcliente=$ver[2];

 ?>	

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Reporte de venta</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
 </head>
 <body>
 		<img src="../../img/logo.jpg" width="200" height="200">
 		<br>
 		<table class="table">
 			<tr>
 				<td>Fecha: <?php echo $fecha; ?></td>
 			</tr>
 			<tr>
 				<td>Venta: <?php echo $venta; ?></td>
 			</tr>
 			<tr>
 				<td>Cliente: <?php echo $objv->nombreCliente($idcliente); ?></td>
 			</tr>
 		</table>


 		<table class="table">
 			<tr>
 				<td>Nombre producto</td>
 				<td>Descripcion</td>
 				<td>Precio</td>
 				<td>Cantidad</td>
 				<td>SubTotal</td> 				
 			</tr>
 			<?php 
 			$sql="SELECT 
				art.nombre,
				 art.descripcion,
		        art.precio,		       
                det.cantidad ,
                 (art.precio*det.cantidad) Total             
			from venta  as ve 
		    inner join detalle_venta as det
		    on ve.id_venta=det.ID_VENTA
		    and ve.id_ciudad=det.ID_CIUDAD
		    and ve.id_sector=det.id_sector
			inner join articulos as art
			on det.id_producto=art.id_producto
		    and det.id_categoria=art.ID_CATEGORIA
			and det.id_venta='$idventa'";

			$result=mysqli_query($conexion,$sql);

			$total=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

 			<tr>
 				<td><?php echo $mostrar[0]; ?></td>
 				<td><?php echo $mostrar[1]; ?></td>
 				<td><?php echo $mostrar[2]; ?></td>
 				<td><?php echo $mostrar[3]; ?></td>
 				<td><?php echo $mostrar[4]; ?></td>
 			</tr>
 			<?php 
 				$total=$total + $mostrar[4];
 			endwhile;
 			 ?>
 			 <tr>
 			 	<td>Total:</td>
 			 	<td></td>
 			 	<td></td>
 			 	<td></td>
 			 	<td><?php echo "$".$total ?></td>
 			 	 </tr>
 		</table>
 </body>
 </html>