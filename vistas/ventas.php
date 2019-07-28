<?php 
session_start();
if(isset($_SESSION['usuario'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Ventas</title>
		 <style>     
     
 
    </style>
		<?php require_once "menu.php"; 
 require_once "../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
$sql1="SELECT id_ciudad,NOMBRE_CIUDAD
				FROM ciudad 
				WHERE ID_PAIS=593
				and ESTADO='A'";
		$result1=mysqli_query($conexion,$sql1);
		?>
			
	</head>
	<body>
	 <div class="container">
  	<div id="map" class="z-depth-1-half map-container mb-5" style="height: 200px"></div>
  </div>	
	<div class="container"> 		
	<h1>Vender un productos</h1>	 
<div class="row">  
	<div class="col-sm-7">
		<form id="frmVentasProductos">
	   <div class="col-sm-7">

	   	<label>Cliente</label>
			<select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
				<option value="A">Selecciona Cliente</option>
				<?php
				$sql="SELECT cedula ,nombre,apellido 
				from cliente";
				$result=mysqli_query($conexion,$sql);
				while ($cliente=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2]." ".$cliente[1] ?></option>
				<?php endwhile; ?>
			</select>	
			<label>Categorias</label>
			<select class="form-control input-sm" id="categoriaVenta" name="categoriaVenta">
				<option value="A">Selecciona Categoria</option>
				<?php
				$sql="SELECT id_categoria,nombre
				from categoria
				where estado='A'";
				$result=mysqli_query($conexion,$sql);

				while ($categoria=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $categoria[0] ?>"><?php echo $categoria[1] ?></option>
				<?php endwhile; ?>
			</select>
                  
		<label>Producto</label>
		<div><select class="form-control input-sm" name="productoSelect1" id="productoSelect1"></select></div>			
			<label>Cantidad</label>
			<input  type="text" class="form-control input-sm" id="cantidadV" name="cantidadV">		
			<label>Descripcion</label>
			<textarea readonly="" id="descripcionV" name="descripcionV" class="form-control input-sm"></textarea>
			<label>Stock</label>
			<input readonly="" type="text" class="form-control input-sm" id="stockV" name="stockV">
			<label>Precio</label>
			<input readonly="" type="text" class="form-control input-sm" id="precioV" name="precioV">

			</div>
	  <div class="col-sm-4">		
	  	<h4>Lugar entrega</h4>
	  	<label>Latitud/Longitud</label>
		<input type="text" class="form-control input-sm" id="latitud" name="latitud">
		<input type="text" class="form-control input-sm" id="longitud" name="longitud">
	  	  	<label>Ciudad</label>
				<select class="form-control input-sm" id="ciudadSelect" name="ciudadSelect">
							<option value="A">Selecciona Ciudad</option>
							<?php while($ver1=mysqli_fetch_row($result1)): ?>
								<option value="<?php echo $ver1[0] ?>"><?php  echo $ver1[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Sector</label>
						<div id="sectorSelect"></div>	
		<label>Calle Principal</label>
				<input type="text" class="form-control input-sm" id="calle_principal" name="calle_principal">
				<label>No.Casa</label>
				<input type="text" class="form-control input-sm" id="ncasa" name="ncasa">
				<label>Calle Secundaria</label>
				<input type="text" class="form-control input-sm" id="calle_secundaria" name="calle_secundaria"></div>
				
				<span class="btn btn-primary" id="btnAgregaVenta">Agregar</span>
			<span class="btn btn-danger" id="btnVaciarVentas">Vaciar ventas</span>
	  </form>
  </div>
  <div class="col-sm-3">
  	<div id="tablaVentasTempLoad"></div>
  </div>
  
</div>
	</div>
	</body>
	</html>

<script type="text/javascript">
var x = document.getElementById("frmVentasProductos");
x.addEventListener("blur", myBlurFunction, true);

function myBlurFunction() {
 if (parseFloat($('#cantidadV').val())>$('#stockV').val()){
				document.getElementById("cantidadV").value='';
				alertify.alert("El stock es menor que la cantidad solicitada!!");
   };
}
</script>
	
	<script type="text/javascript">
	$(document).ready(function(){
				$("#categoriaVenta").change(function () {
 
									
					$("#categoriaVenta option:selected").each(function () {
						id_categoria = $(this).val();
						$.post("../procesos/ventas/llenarProducto.php", { id_categoria: id_categoria }, function(data){
							$("#productoSelect1").html(data);
						});            
					});
				})
			});
</script>

<script type="text/javascript">
	$(document).ready(function(){	
		
		$('#ciudadSelect').change(function(){			
			recargarLista();
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
	</script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
		$('#productoSelect1').change(function(){

			dato=$('#productoSelect1').val();	
			idcategoria1=$('#categoriaVenta').val();		
			if (dato>0){
		    
			$.ajax({
				type:"POST",
				data:"idproducto=" + $('#productoSelect1').val(),
				url:"../procesos/ventas/llenarFormProducto.php?categoria="+idcategoria1,
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#descripcionV').val(dato['descripcion']);
					$('#stockV').val(dato['cantidad']);
					$('#precioV').val(dato['precio']);
					
				}

			});
		}
		});  



		$('#btnAgregaVenta').click(function(){
			
			vacios=validarFormVacio('frmVentasProductos');

			if (parseFloat($('#cantidadV').val())>$('#stockV').val()){
				document.getElementById("cantidadV").value='';
				alertify.alert("El stock es menor que la cantidad solicitada!!");
				return false;
			}

			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}

			datos=$('#frmVentasProductos').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/ventas/agregaProductoTemp.php",
				success:function(r){
					//alert(r);
					$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
				}
			});
		});

		$('#btnVaciarVentas').click(function(){

		$.ajax({
			url:"../procesos/ventas/vaciarTemp.php",
			success:function(r){
				$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
			}
		});
	});

	});
</script>

 <script type="text/javascript">
	function quitarP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procesos/ventas/quitarproducto.php",
			success:function(r){
				$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
				alertify.success("Se quito el producto");
			}
		});
	}

	function crearVenta(){
		$.ajax({
			url:"../procesos/ventas/crearVenta.php",
			success:function(r){
				//alert(r);
				if(r > 0){
					$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
					$('#frmVentasProductos')[0].reset();
					alertify.alert("Venta creada con exito, consulte la informacion de esta en ventas hechas");
				}else if(r==0){
					alertify.alert("No hay lista de venta!!");
				}else{
					alertify.error("No se pudo crear la venta");
				}
			}
		});
	}
</script>


<script>
 
 
var marker;          //variable del marcador
var coords = {};    //coordenadas obtenidas con la geolocalización
 
//Funcion principal
initMap = function () 
{
 
    //usamos la API para geolocalizar el usuario
        navigator.geolocation.getCurrentPosition(
          function (position){
            coords =  {
				
              lng: position.coords.longitude,
              lat: position.coords.latitude
            };
            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
            
           
          },function(error){console.log(error);});
    
}
 
 
 
function setMapa (coords)
{   
      //Se crea una nueva instancia del objeto mapa
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 13,
        center:new google.maps.LatLng(coords.lat,coords.lng),
 
      });
 
      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),
 
      });
      //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
      //cuando el usuario a soltado el marcador
      marker.addListener('click', toggleBounce);
      
      marker.addListener( 'dragend', function (event)
      {
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("latitud").value = this.getPosition().lat(); 
        document.getElementById("longitud").value =this.getPosition().lng();
      });
}
 
//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
 
// Carga de la libreria de google maps 
 
    </script>
    <script     async defer 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=initMap">     	
    </script>
   
    <?php 
	}else{
		header("location:../index.php");
	}
 ?>