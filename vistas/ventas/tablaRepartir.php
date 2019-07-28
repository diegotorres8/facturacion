
<?php 
session_start();

if(isset($_SESSION['usuario'])){
 $usuario=$_SESSION['usuario'];
 //echo  $usuario;
}
	require_once "../../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();
	/*and usuario='$usuario'*/

	$sql="SELECT 	desp.id_venta,desp.estado,desp.fecha_asignado,ciu.nombre_ciudad,sec.nombre_sector
,usuario,vent.CEDULA,concat(cli.NOMBRe,' ', cli.apellido) cliente , 
concat(vent.CALLE_PRINCIPAL,' ',vent.NUMERO_CASA,' ',vent.CALLE_SECUNDARIA) direccion
from despacho_ventas as desp
inner join repartidores as rep
on desp.id_ciudad=rep.id_ciudad
and desp.id_sector=rep.id_sector
and desp.estado='A'
inner join usuario as  usu
on rep.id_usuario=usu.id_usuario
and usuario='$usuario'
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
on cli.cedula=vent.CEDULA";
	$result=mysqli_query($conexion,$sql);
 ?>

<div class="table-responsive">
	<form id="frmRepartir">
	 <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	 	<caption><label>Despachos Ventas</label></caption>
	 	<tr>
	 		<td>Venta</td>
	 		<td>Estado</td>
	 		<td>Fecha_Asignado</td>
	 		<td>Cliente</td>
	 		<td>C.I.Cliente</td>
	 		<td>Ciudad</td>
	 		<td>Sector</td>
	 		<td>Dirección</td>
	 		
	 	</tr>

	<?php
	while ($ver=mysqli_fetch_row($result)):
	 ?>
	 		 
	 	<tr>
	 		<td><?php echo $ver[0]; ?></td>
	 		<td><input type="text" class="form-control input-sm" id="estado" name="estado" value="<?php echo $ver[1]; ?>"> </td>
	 		<td><?php echo $ver[2]; ?></td>
	 		<td><?php echo $ver[7]; ?></td>
	 		<td><?php echo $ver[6]; ?></td>
	 		<td><?php echo $ver[3]; ?></td>
	 		<td><?php echo $ver[4]; ?></td>
	 		<td><?php echo $ver[8]; ?></td>

	 					
	 	</tr>
	 <?php endwhile ?>
	 </table>
	 <p></p>
	 <button id="btnActualizaRepar" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
				
			</form>
</div>