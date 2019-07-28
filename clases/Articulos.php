

<?php 
	class articulos{
		public function agregaImagen($datos){
			$c=new conectar();
			$conexion=$c->conexion();
            $id_imagen=self::traerIdImg($datos[0],$datos[1]);
			$fecha=date('Y-m-d h:m:s');
         
			$sql="INSERT into imagenes (id_imagen,
										id_producto,
			                            id_categoria,
										nombre,
										ruta,
										fecha_crea,
										usuario_crea)
							values ('$id_imagen',
							        '$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$fecha',
									'$datos[4]')";
									//echo $sql;
			return mysqli_query($conexion,$sql);
		}
		public function insertaArticulo($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			 $id_articulo=self::traeIDArticulo($datos[0]);
			$fecha=date('Y-m-d h:m:s');
			$sql="INSERT into articulos (id_producto,
			                            id_categoria,
			                            nombre,
										descripcion,
										cantidad,
										precio,
										iva,
										cantidad_minima,
										cantidad_maximo,	
										fecha_crea	,
										usuario_crea							
										) 
							values ('$id_articulo',
							        '$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$datos[4]',
									'$datos[5]',
									'$datos[6]',
									'$datos[7]',
									'$fecha',
									'$datos[8]'
									 )";
           // echo $sql;
		    $result=mysqli_query($conexion,$sql);
			return $id_articulo;
		}

		public function obtenDatosArticulo($idarticulo,$idCategoria){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_producto, 
						id_categoria, 
						nombre,
						descripcion,
						cantidad,
						precio ,
						iva,
						cantidad_minima,
						cantidad_maximo
				from articulos 
				where id_producto='$idarticulo'
				and id_categoria='$idCategoria'";

				//echo $sql ;
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
					"id_producto" => $ver[0],
					"id_categoria" => $ver[1],
					"nombre" => $ver[2],
					"descripcion" => $ver[3],
					"cantidad" => $ver[4],
					"precio" => $ver[5],
					"iva" => $ver[6],
					"cantidad_minima" => $ver[7],
					"cantidad_maximo" => $ver[8]
						);

			return $datos;
		}

		public function actualizaArticulo($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE articulos set  
										nombre='$datos[2]',
										descripcion='$datos[3]',
										cantidad='$datos[4]',
										precio='$datos[5]',
										iva='$datos[6]',
										cantidad_minima='$datos[7]',
										cantidad_maximo='$datos[8]'
						where id_producto='$datos[0]'
						and id_categoria='$datos[1]'";
//echo $sql;
			return mysqli_query($conexion,$sql);
		}

		
		public function traeIDArticulo($categoria){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ifnull(max(id_producto),0)+1
					from articulos
					where id_categoria='$categoria'"; 
				
			$result=mysqli_query($conexion,$sql);
			return mysqli_fetch_row($result)[0];
		}

		public function traerIdImg($idProducto,$idCategoria){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ifnull(max(id_imagen),0)+1 
					from imagenes";
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenRutaImagen($idImg){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ruta 
					from imagenes 
					where id_imagen='$idImg'";

			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

	}

 ?>