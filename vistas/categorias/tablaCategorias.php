

	<?php 
			require_once "../../clases/Conexion.php";
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_categoria,nombre ,
			CASE estado 
				    WHEN 'A' THEN 'Activo' 
				    WHEN 'I' THEN 'Inactivo'
				  END estado1,estado
					FROM categoria";
			$result=mysqli_query($conexion,$sql);
	 ?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Categorias </label></caption>
	<tr>
		<td>Categoria</td>
		<td>Estado</td>
		<td>Editar</td>
	</tr>

	<?php
	while ($ver=mysqli_fetch_row($result)):
	 ?>

	<tr>
		<td><?php echo $ver[1] ?></td>
		<td><?php echo $ver[2] ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizaCategoria" onclick="agregaDato('<?php echo $ver[0] ?>','<?php echo $ver[1] ?>','<?php echo $ver[3] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		
	</tr>

<?php endwhile; ?>
</table>