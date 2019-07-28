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
//echo $sql;
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
 	<style type="text/css">
		
@page {
            margin-top: 0.3em;
            margin-left: 0.6em;
        }
    body{
    	font-size: xx-small;
    }
	</style>

 </head>
 <body>
 		<p>Factura</p>
 		<p>
 			Fecha: <?php echo $fecha; ?>
 		</p>
 		<p>
 			Venta: <?php echo $venta ?>
 		</p>
 		<p>
 			Cliente: <?php echo $objv->nombreCliente($idcliente); ?>
 		</p>
 		
 		<table style="border-collapse: collapse;" border="1">
 			<tr>
 				<td>Nombre</td>
 				<td>Precio</td>
 				<td>Cantidad</td>
 				<td>SubTotal</td>
 			</tr>
 			<?php 
 				$sql="SELECT ve.id_venta,
				ve.fecha_Crea,
				ve.cedula,
				art.nombre,
		        art.precio,
		        art.descripcion,
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
				while($mostrar=mysqli_fetch_row($result)){
 			 ?>
 			<tr>
 				<td><?php echo $mostrar[3]; ?></td>
 				<td><?php echo $mostrar[4] ?></td>
 				<td><?php echo $mostrar[6] ?></td>
 				<td><?php echo $mostrar[7] ?></td>
 			</tr>
 			<?php
 				$total=$total + $mostrar[7];
 				} 
 			 ?>
 			 <tr>
 			 	<td>Total:</td>
 			 	<td></td>
 			 	<td></td>
 			 	<td><?php echo "$".$total ?></td>
 			 	 </tr>
 		</table>

 		
 </body>
 </html>
 