<?php 
	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT us.id_usuario,
					us.nombre,
					us.apellido,
					us.usuario,
					per.descripcion,
					 CASE us.estado 
				    WHEN 'A' THEN 'Activo' 
				    WHEN 'I' THEN 'Inactivo'
				  END estado
			from usuario as us
			join perfil_usuario as per
			on us.id_perfil=per.id_perfil";
	$result=mysqli_query($conexion,$sql);

 ?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Usuarios</label></caption>
	<tr>
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Usuario</td>
		<td>Perfil</td>
		<td>Estado</td>
		<td>Editar</td>
		
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td><?php echo $ver[5]; ?></td>
		<td>
			<span data-toggle="modal" data-target="#actualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		
	</tr>
<?php endwhile; ?>
</table>