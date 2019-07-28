<?php 
session_start();
if(isset($_SESSION['usuario']) and $_SESSION['usuario']=='admin'){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>usuarios</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; 
		$c= new conectar();
		$conexion=$c->conexion();
		$sql="SELECT id_perfil,descripcion
		from perfil_usuario
		where id_perfil<>'CLI'";
		$result=mysqli_query($conexion,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Administrar usuarios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmRegistro">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" name="nombre" id="nombre">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" name="apellido" id="apellido">
						<label>Usuario</label>
						<input type="text" class="form-control input-sm" name="usuario" id="usuario">
						<label>Password</label>
						<input type="password" class="form-control input-sm" name="password" id="password" placeholder="Enter your Password">
						<input type="checkbox" onclick="myFunction(1)">
						<br>
						<label>Perfil</label>
						<select class="form-control input-sm" id="perfilSelect" name="perfilSelect">
							<option value="A">Selecciona Perfil</option>
							<?php while($ver=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<p></p>
						<span class="btn btn-primary" id="registro">Registrar</span>

					</form>
				</div>
				<div class="col-sm-7">
					<div id="tablaUsuariosLoad"></div>
				</div>
			</div>
		</div>


		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
							<label>Password</label>
						<input type="password" class="form-control input-sm" name="passwordU" id="passwordU" placeholder="Enter your Password">
						<input type="checkbox" onclick="myFunction(2)">
						<br>
							<label>Perfil</label>
						<select class="form-control input-sm" id="perfilSelectU" name="perfilSelectU">
								<option value="">Selecciona Perfil</option>
								<?php 
								$sql="SELECT id_perfil,descripcion
								from perfil_usuario
								where id_perfil<>4";
								$result=mysqli_query($conexion,$sql);
								?>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
								<?php endwhile; ?>
							</select>							
						     <label>Estado</label>
						      <select class="form-control input-sm" id="estadoU" name="estadoU">
								<option value="A">Activo</option>
								<option value="I">Inactivo</option>
								</select>                           
                         <p></p>
                            
                            </form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Usuario</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosUsuario(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_usuario']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#usuarioU').val(dato['usuario']);
					$('#perfilSelectU').val(dato['id_perfil']);
					$('#estadoU').val(dato['estado']);
				}
			});
		}

	function myFunction(tipo) {
		if (tipo==1)
		 {
          var x = document.getElementById("password");
		  if (x.type === "password") 
		  {
		    x.type = "text";
		  } 
		  else 
		  {
		    x.type = "password";
		  }
       }
       else
       {
       	var x = document.getElementById("passwordU");
		  if (x.type === "password") 
		  {
		    x.type = "text";
		  } 
		  else 
		  {
		    x.type = "password";
		  }

       }
}

	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaUsuario').click(function(){

				datos=$('#frmRegistroU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuario.php",
					success:function(r){

						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Actualizado con exito");
						}else{
							alertify.error("No se pudo actualizar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');

			$('#registro').click(function(){

				vacios=validarFormVacio('frmRegistro');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/regLogin/registrarUsuario.php",
					success:function(r){
						if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Agregado con exito");
						}else{
							alertify.error("Fallo al agregar");
						}
					}
				});
			});
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>