<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Articulos.php";

	$obj= new articulos();

	$datos=array();
	
	$nombreImg=$_FILES['imagen']['name'];
	$rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
	$carpeta='../../archivos/';
	$rutaFinal=$carpeta.$nombreImg;

	

		if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
			        $datos[0]=$_POST['categoriaSelect'];
			        $datos[1]=$_POST['nombre'];
					$datos[2]=$_POST['descripcion'];
					$datos[3]=$_POST['cantidad'];
					$datos[4]=$_POST['precio'];
					$datos[5]=$_POST['iva'];
					$datos[6]=$_POST['cminima'];
					$datos[7]=$_POST['cmaxima'];
					$datos[8]=$iduser;
					
					$idarticulo=$obj->insertaArticulo($datos);
                    //echo$idarticulo;
				if($idarticulo > 0){
					$datosImg=array(
					$idarticulo,	
					$_POST['categoriaSelect'],
					$nombreImg,
					$rutaFinal,
				     $iduser);

					echo $obj->agregaImagen($datosImg);
				}else{
					echo 0;
				}

		}

 ?>