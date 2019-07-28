<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Repartidores</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; 
		$c= new conectar();
		$conexion=$c->conexion();
		$sql="SELECT id_usuario,upper(CONCAT(Nombre, ' ', Apellido)) empl
		from usuario
		where id_perfil='REP'
		and estado='A'";
		$result=mysqli_query($conexion,$sql);

		$sql1="SELECT id_ciudad,NOMBRE_CIUDAD
				FROM ciudad 
				WHERE ID_PAIS=593
				and ESTADO='A'";
		$result1=mysqli_query($conexion,$sql1);
		
		?>
	</head>
	<body>
		<div class="container">
			<h1>Repartidores</h1>
			<div class="row">
				<div class="col-sm-4">
			<form id="frmRepartidor">

               	<label>Usuario</label>
						<select class="form-control input-sm" id="usuarioSelect" name="usuarioSelect">
							<option value="A">Selecciona Usuario</option>
							<?php while($ver=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
							<?php endwhile; ?>
						</select>						
						<p></p>
				<label>Ciudad</label>
				<select class="form-control input-sm" id="ciudadSelect" name="ciudadSelect">
							<option value="A">Selecciona Ciudad</option>
							<?php while($ver1=mysqli_fetch_row($result1)): ?>
								<option value="<?php echo $ver1[0] ?>"><?php  echo $ver1[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<p></p>
						<label>Sector</label>
						<div id="sectorSelect"></div>						
						<p></p>
				<span class="btn btn-primary" id="btnAgregarRepartidor">Agregar</span>
			</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaRepartidorLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalRepartidorUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmRepartidorU">
							<input type="text"  hidden=""  id="iD_USUARIOU" name="iD_USUARIOU">
							<label>Ciudad</label>
				      <select class="form-control input-sm" id="ciudadSelectU" name="ciudadSelectU">
							<option value="">Selecciona Ciudad</option>
							<?php 
									$sql1="SELECT id_ciudad,NOMBRE_CIUDAD
									FROM ciudad 
									WHERE ID_PAIS=593
									and ESTADO='A'";
									$result1=mysqli_query($conexion,$sql1);
							while($ver1=mysqli_fetch_row($result1)): ?>
								<option value="<?php echo $ver1[0] ?>"><?php  echo $ver1[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<p></p>
						<label>Sector</label>
						<div id="sectorSelect1"></div>						
						<p></p>		
						<label>Estado</label>
                             <select class="form-control input-sm" id="estadoU" name="estadoU">
								<option value="A">Activo</option>
								<option value="I">Inactivo</option>
								</select> 				
							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarRepartidorU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	


	<script type="text/javascript">

		function agregaDatosRepartidor(iD_USUARIO){
			$.ajax({
				type:"POST",
				data:"iD_USUARIO=" + iD_USUARIO,
				url:"../procesos/repartidor/obtenDatosRepartidor.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#iD_USUARIOU').val(dato['ID_USUARIO']);
					$('#ciudadSelectU').val(dato['ID_CIUDAD']);
					$('#estadoU').val(dato['ESTADO'])

					}
			});
		}

		
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaRepartidorLoad').load("repartidor/tablaRepartidor.php");

			$('#btnAgregarRepartidor').click(function(){

				vacios=validarFormVacio('frmRepartidor');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmRepartidor').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/repartidor/agregaRepartidor.php",
					success:function(r){						
                         if(r==1){
							$('#frmRepartidor')[0].reset();
							$('#tablaRepartidorLoad').load("clientes/tablaRepartidor.php");
							alertify.success("Repartidor agregado con exito");
						}else{
							alertify.error("No se pudo agregar repartidor");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarRepartidorU').click(function(){
				datos=$('#frmRepartidorU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/repartidor/actualizaRepartidor.php",
					success:function(r){
                     //alert(r);
						if(r==1){
							$('#frmRepartidor')[0].reset();
							$('#tablaClientesLoad').load('repartidor/tablaRepartidor.php');
							alertify.success("Repartidor actualizado con exitoo");
							
						}else{
							alertify.error("No se pudo actualizar repartidor");
						}
					}
				});
			})
		})
	</script>

<script type="text/javascript">
	$(document).ready(function(){	
		
		$('#ciudadSelect').change(function(){			
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){	
	
		$('#ciudadSelectU').val();
				recargarListaU();
				
		$('#ciudadSelectU').change(function(){			
			recargarListaU();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		
		$.ajax({
			type:"POST",
			data:"ciudad=" + $('#ciudadSelect').val(),
			url:"../procesos/sector/sector.php?tipo=1",			
			success:function(r){
				
				$('#sectorSelect').html(r);
			}
		});
	}

	function recargarListaU(){
		
		$.ajax({
			type:"POST",
			data:"ciudad=" + $('#ciudadSelectU').val(),
			url:"../procesos/sector/sector.php?tipo=2",			
			success:function(r){
				
				$('#sectorSelect1').html(r);
			}
		});
	}
</script>
	<?php 
}else{
	header("location:../index.php");
}
?>