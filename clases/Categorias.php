


<?php 

	class categorias{

		public function agregaCategoria($datos){
			$c= new conectar();
			$conexion=$c->conexion();
             $id_categoria=self::traeIDCategoria();
             $fecha=date('Y-m-d h:m:s');
             $idusuario=$_SESSION['usuario'];
			$sql="INSERT into categoria(id_categoria,
										nombre,
										fecha_crea,
										usuario_crea
										)
						values ('$id_categoria',
								'$datos[1]',
								'$fecha',
								' $idusuario'
							)";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaCategoria($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE categoria set nombre='$datos[1]',estado='$datos[2]'
								where id_categoria='$datos[0]'";
			echo mysqli_query($conexion,$sql);
		}

		public function traeIDCategoria(){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ifnull(max(id_categoria),0)+1
					from categoria"; 
					
			$result=mysqli_query($conexion,$sql);
			return mysqli_fetch_row($result)[0];
		}

	}

 ?>