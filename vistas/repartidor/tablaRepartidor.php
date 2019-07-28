
<?php 
	require_once "../../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();


		$sql="SELECT  rep.iD_USUARIO,
	             upper(CONCAT(Nombre, ' ', Apellido)) empl,
						   rep.ID_SECTOR,
						   se.nombre_sector,
						   rep.ID_CIUDAD ,
						   ci.nombre_ciudad,
						   rep.ESTADO,
						   rep.FECHA_CREA,
						   rep.USUARIO_CREA 
		from repartidores as rep 
		join usuario as us
		on rep.iD_USUARIO=us.iD_USUARIO
		join sector as se 
		on rep.id_sector=se.id_sector
		and rep.id_ciudad=se.id_ciudad
		join ciudad ci 
		on se.id_ciudad=ci.id_ciudad";
	$result=mysqli_query($conexion,$sql);
 ?>

<div class="table-responsive">
	 <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	 	<caption><label>Repartidor</label></caption>
	 	<tr>

	 		<td>Repartidor</td>
	 		<td>Ciudad</td>
	 		<td>Sector</td>
	 		<td>Editar</td>
	 	</tr>
	 	<?php while($ver=mysqli_fetch_row($result)): ?>
	 		 
	 	<tr>
	 		<td><?php echo $ver[1]; ?></td>
	 		<td><?php echo $ver[5]; ?></td>
	 		<td><?php echo $ver[3]; ?></td>
	 		

	 		<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalRepartidorUpdate" onclick="agregaDatosRepartidor('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			
	 	</tr>
	 <?php endwhile; ?>
	 </table>
</div>