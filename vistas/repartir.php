<?php 
session_start();
if(isset($_SESSION['usuario'])){
	require_once "../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();
	$usuario=$_SESSION['usuario'];

	$sql="SELECT 	desp.id_venta,CASE
when desp.estado='A' THEN
'Activo'
when desp.estado='C'THEN
   'Cancelado'
  when desp.estado='E'THEN
  'Entregado' 
  end estado
	,desp.fecha_asignado,ciu.nombre_ciudad,sec.nombre_sector
,usuario,vent.CEDULA,concat(cli.NOMBRe,' ', cli.apellido) cliente , 
concat(vent.CALLE_PRINCIPAL,' ',vent.NUMERO_CASA,' ',vent.CALLE_SECUNDARIA) direccion
from despacho_ventas as desp
inner join repartidores as rep
on desp.id_ciudad=rep.id_ciudad
and desp.id_sector=rep.id_sector
and desp.estado='A'
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
ORDER BY desp.id_venta DESC";
	$result=mysqli_query($conexion,$sql);
 ?>



	<!DOCTYPE html>
	<html>
	<head>
		<title>Despachos Ventas</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Despachos Ventas</h1>
	<div class="table-responsive">
	
	 <table class="table table-hover table-condensed table-bordered" style="text-align: center;" id="table">
	 	<caption><label>Despachos Ventass</label></caption>
	 	<tr>
	 		<td>Venta</td>
	 		<td>Estado</td>
	 		<td>Fecha_Asignado</td>
	 		<td>Cliente</td>
	 		<td>C.I.Cliente</td>
	 		<td>Ciudad</td>
	 		<td>Sector</td>
	 		<td>Dirección</td>
	 		<td>Entregado</td>
	 		<td>Cancelado</td>
	 		
	 	</tr>

	<?php
	while ($ver=mysqli_fetch_row($result)):
	 ?>
	 		 
	 	<tr>
	 		<td><?php echo $ver[0]; ?></td>
	 		<td><?php echo $ver[1]; ?></td>
	 		<td><?php echo $ver[2]; ?></td>
	 		<td><?php echo $ver[7]; ?></td>
	 		<td><?php echo $ver[6]; ?></td>
	 		<td><?php echo $ver[3]; ?></td>
	 		<td><?php echo $ver[4]; ?></td>
	 		<td><?php echo $ver[8]; ?></td>
	 		<td>
	 			
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalRepartirUpdate" onclick="entrega('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
	 			
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalRepartirUpdate" onclick="cancela('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>

	 					
	 	</tr>
	 <?php endwhile ?>
	 </table>
	
</div>
			
		</div>
 
	
	</body>
	</html>
		

<script>
		function entrega(idventa){			
			$.ajax({
					type:"POST",
					data:{venta:idventa,estado:"E"},
					url:"../procesos/ventas/actualizaRepartir.php",
					success:function(r){
                     //alert(r);
						if(r==1){
							window.location.reload();
							alertify.success("Repartidor actualizado con exito");
							
						}else{
							alertify.error("No se pudo actualizar repartidor");
						}
					}
				});					
		}
		function cancela(idventa){			
			$.ajax({
					type:"POST",
					data:{venta:idventa,estado:"C"},
					url:"../procesos/ventas/actualizaRepartir.php",
					success:function(r){
                     //alert(r);
						if(r==1){
							window.location.reload();
							alertify.success("Repartidor actualizado con exito");
							
						}else{
							alertify.error("No se pudo actualizar repartidor");
						}
					}
				});					
		}
</script> 
<script type="text/javascript">

					
			$('#btnActualizaRepar').click(function(){
				datos=$('#frmRepartir').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/ventas/actualizaRepartir.php",
					success:function(r){
                     //alert(r);
						if(r==1){
							window.location.reload();
							alertify.success("Repartidor actualizado con exito");
							
						}else{
							alertify.error("No se pudo actualizar repartidor");
						}
					}
				});
			})
	</script>
	
	<?php 
}else{
	header("location:../index.php");
}
?>