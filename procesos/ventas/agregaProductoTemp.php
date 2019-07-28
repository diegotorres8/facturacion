<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idcliente=$_POST['clienteVenta'];
	$idcategoria=$_POST['categoriaVenta'];
	$idproducto=$_POST['productoSelect1'];
	$descripcion=$_POST['descripcionV'];
	$stock=$_POST['stockV'];
	$precio=$_POST['precioV'];
	$cantidad=$_POST['cantidadV'];
	$ciudad=$_POST['ciudadSelect'];
	$sector=$_POST['sectorSelect'];
	$calleP=$_POST['calle_principal'];
	$nCasa=$_POST['ncasa'];
	$calleS=$_POST['calle_secundaria'];
	$latitud=$_POST['latitud'];
	$longitud=$_POST['longitud'];

	$sql="SELECT nombre,apellido 
			from cliente
			where cedula='$idcliente'";
	$result=mysqli_query($conexion,$sql);

	$c=mysqli_fetch_row($result);

	$ncliente=$c[1]." ".$c[0];

	$sql="SELECT art.nombre,img.ruta
		from articulos as art 
		inner join imagenes as img
		on art.ID_CATEGORIA=img.ID_CATEGORIA 
        and art.ID_PRODUCTO=img.ID_PRODUCTO 
		and art.id_producto='$idproducto'
		and art.id_categoria='$idcategoria'";
	//echo $sql;	
	$result=mysqli_query($conexion,$sql);
	$ver=mysqli_fetch_row($result);
	
	$nombreproducto=$ver[0];
    $ruta=$ver[1];
	$articulo=$idproducto."||".
				$nombreproducto."||".
				$descripcion."||".
				$precio."||".
				$ncliente."||".
				$idcliente."||".
				$cantidad."||".
				$ruta."||".
				$ciudad."||".
				$sector."||".
				$calleP."||".
				$nCasa."||".
				$calleS."||".
				$idcategoria."||".
				$latitud."||".
				$longitud
;

	$_SESSION['tablaComprasTemp'][]=$articulo;

 ?>