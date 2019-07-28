
<?php 
	require_once "../../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();

	$sql="SELECT  cedula,
	            id_perfil, 
				nombre,
				apellido,
				calle_principal,
				numero_de_casa,
				calle_secundaria,
				email,
				telefono,
				fecha_crea,
				usuario_crea,
				clave
		from cliente";
	$result=mysqli_query($conexion,$sql);
 ?>

<div class="table-responsive">
	 <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	  	<tr>
	 		<td>Cedula</td>
	 		<td>Nombre</td>
	 		<td>Apellido</td>
	 		<td>Calle Principal</td>
	 		<td>Número Casa</td>
	 		<td>Calle Secundaria</td>
	 		<td>Email</td>
	 		<td>Teléfono</td>
	 		<td>Editar</td>
	 	</tr>

	<?php
	while ($ver=mysqli_fetch_row($result)):
	 ?>
	 		 
	 	<tr>
	 		<td><?php echo $ver[0]; ?></td>
	 		<td><?php echo $ver[2]; ?></td>
	 		<td><?php echo $ver[3]; ?></td>
	 		<td><?php echo $ver[4]; ?></td>
	 		<td><?php echo $ver[5]; ?></td>
	 		<td><?php echo $ver[6]; ?></td>
	 		<td><?php echo $ver[7]; ?></td>
	 		<td><?php echo $ver[8]; ?></td>
	 		<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalClientesUpdate" onclick="agregaDatosCliente('<?php echo $ver[0]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			
	 	</tr>
	 <?php endwhile ?>
	 </table>
</div>