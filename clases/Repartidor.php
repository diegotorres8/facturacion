<?php 

	class repartidor{

		public function agregaRepartidor($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$idusuario=$_SESSION['usuario'];
            $fecha=date('Y-m-d h:m:s');
            
			    

			$sql="INSERT into repartidores
			                (ID_USUARIO,
			                ID_CIUDAD ,
						   ID_SECTOR,						   
						   FECHA_CREA,
						   USUARIO_CREA)
							values ('$datos[0]',
							'$datos[1]',
							'$datos[2]',
							'$fecha',
							'$idusuario'
									)";
								
			return mysqli_query($conexion,$sql);	
		}

		public function obtenDatosRepartidor($iD_USUARIO){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ID_USUARIO,
			             ID_CIUDAD ,
						   ID_SECTOR,						   
						   ESTADO
				from repartidores where ID_USUARIO='$iD_USUARIO'";
				
				
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'ID_USUARIO' => $ver[0], 
					'ID_CIUDAD' => $ver[1],
					'ID_SECTOR' => $ver[2],					
					'ESTADO' => $ver[3]);
			return $datos;
		}

		public function actualizaRepartidor($datos){
			$c= new conectar();
			$conexion=$c->conexion();
            $idusuario=$_SESSION['usuario'];
            $fecha=date('Y-m-d h:m:s');

           			
			$sql="UPDATE repartidores set 
										ID_CIUDAD='$datos[1]',
										ID_SECTOR='$datos[3]',
										ESTADO='$datos[2]',
										fecha_mod='$fecha' ,
										usuario_mod='$idusuario'
								where ID_USUARIO='$datos[0]'";
					//echo $sql;		
			return mysqli_query($conexion,$sql);
		}

		public function actualizaRepartir($datos){
			$c= new conectar();
			$conexion=$c->conexion();
            $idusuario=$_SESSION['usuario'];
            $fecha=date('Y-m-d h:m:s');
           			
			$sql="UPDATE despacho_ventas set 
										ESTADO='$datos[1]',
										FECHA_entregado='$fecha'
										where id_venta='$datos[0]'";
					//echo $sql;		
			return mysqli_query($conexion,$sql);
		}


		
	}

 ?>