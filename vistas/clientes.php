<?php 
session_start();
if(isset($_SESSION['usuario'])){
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Clientes</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-3">
			<form id="frmClientes">
                <label>Cédula</label>
				<input type="text" class="form-control input-sm" id="cedula" name="cedula">
				<label>Nombre</label>
				<input type="text" class="form-control input-sm" id="nombre" name="nombre">
				<label>Apellido</label>
				<input type="text" class="form-control input-sm" id="apellidos" name="apellidos">
				<label>Calle Principal</label>
				<input type="text" class="form-control input-sm" id="calle_principal" name="calle_principal">
				<label>No.Casa</label>
				<input type="text" class="form-control input-sm" id="ncasa" name="ncasa">
				<label>Calle Secundaria</label>
				<input type="text" class="form-control input-sm" id="calle_secundaria" name="calle_secundaria">
				<label>Email</label>
				<input type="text" class="form-control" id="email" name="email" placeholder="
				ejemplo@dominio.com" >
				<label>Telefono</label>
				<input type="number" class="form-control input-sm" id="telefono" name="telefono" placeholder="022293440">
				<label>Password</label>
				<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Enter your Password">
				<input type="checkbox" onclick="myFunction(1)">
				<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
			</form>
				</div>
				<div class="col-sm-9">
					<div id="tablaClientesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="idclienteU" name="idclienteU">
							<label>Cédula</label>
							<input type="text" class="form-control input-sm" id="cedulaU" name="cedulaU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
							<label>Calle Principal</label>
							<input type="text" class="form-control input-sm" id="calle_principalU" name="calle_principalU">
							<label>No Casa</label>
							<input type="text" class="form-control input-sm" id="ncasaU" name="ncasaU">
							<label>Calle Secundaria</label>
							<input type="text" class="form-control input-sm" id="calle_secundariaU" name="calle_secundariaU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>Teléfono</label>
							<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
							<label>Password</label>
							<input type="password" name="passwordU" id="passwordU" class="form-control input-sm" placeholder="Enter your Password"><input type="checkbox" onclick="myFunction(2)">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<script type="text/javascript">
var x = document.getElementById("frmClientes");
x.addEventListener("blur", myBlurFunction, true);

function myBlurFunction() {
	var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
      if ($('#email').val()!='') {

	  if (!regex.test(email.value)  ) {            	
            	alertify.alert("Correo invalido!!");
               document.getElementById("email").value='';
            } 
      } 
}
</script>

	<script type="text/javascript">

		function agregaDatosCliente(cedula){
			$.ajax({
				type:"POST",
				data:"cedula=" + cedula,
				url:"../procesos/clientes/obtenDatosCliente.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					// $('#idclienteU').val(dato['id_cliente']);
					$('#cedulaU').val(dato['cedula']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#calle_principalU').val(dato['calle_principal']);
					$('#ncasaU').val(dato['numero_de_casa']);
					$('#calle_secundariaU').val(dato['calle_secundaria']);
					$('#emailU').val(dato['email']);
					$('#telefonoU').val(dato['telefono']);						
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
           
			$('#tablaClientesLoad').load("clientes/tablaClientes.php");

			$('#btnAgregarCliente').click(function(){

				vacios=validarFormVacio('frmClientes');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

            

          

				

				datos=$('#frmClientes').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/agregaCliente.php",
					success:function(r){
						//alert(r);
                         if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente agregado con exito");
						}else{
							alertify.error("No se pudo agregar cliente");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarClienteU').click(function(){
				datos=$('#frmClientesU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaCliente.php",
					success:function(r){
//alert(r);
						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente actualizado con exito");
						}else{
							alertify.error("No se pudo actualizar cliente");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>