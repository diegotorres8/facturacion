<?php 

	class clientes{

		public function agregaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$idusuario=$_SESSION['usuario'];
            $fecha=date('Y-m-d h:m:s');
            $perfil='CLI';
			    

			$sql="INSERT into cliente
			                (cedula,
				            id_perfil, 
							nombre,
							apellido,
							calle_principal,
							numero_de_casa,
							calle_secundaria,
							email,
							telefono,
							fecha_crea,
							usuario_crea,
							clave)
							values ('$datos[0]',
                                     '$perfil',
                                     '$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$datos[4]',
									'$datos[5]',
									'$datos[6]',
									'$datos[7]',
                                    '$fecha',
							        '$idusuario',
							        '$datos[8]'
									)";
									//echo $sql;
			return mysqli_query($conexion,$sql);	
		}

		public function obtenDatosCliente($cedula){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT cedula,
				            id_perfil, 
							nombre,
							apellido,
							calle_principal,
							numero_de_casa,
							calle_secundaria,
							email,
							telefono,
							clave
				from cliente where cedula='$cedula'";
				
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'cedula' => $ver[0], 
					'nombre' => $ver[2],
					'apellido' => $ver[3],
					'calle_principal' => $ver[4],
					'numero_de_casa' => $ver[5],
					'calle_secundaria' => $ver[6],
					'email' => $ver[7],
					'telefono' => $ver[8],
					'clave' => $ver[9]
						);
			return $datos;
		}

		public function actualizaCliente($datos){
			$c= new conectar();
			$conexion=$c->conexion();
            $idusuario=$_SESSION['usuario'];
            $fecha=date('Y-m-d h:m:s');
        
          if ($datos[8] ==''){
           $sql="UPDATE cliente set nombre='$datos[1]',
										apellido='$datos[2]',
										calle_principal='$datos[3]',
										numero_de_casa='$datos[4]',
										calle_secundaria='$datos[5]',
										email='$datos[6]',
										telefono='$datos[7]',
										fecha_mod='$fecha' ,
										usuario_mod='$idusuario'
								where cedula='$datos[0]'";
          }
          else{
           			
			$sql="UPDATE cliente set nombre='$datos[1]',
										apellido='$datos[2]',
										calle_principal='$datos[3]',
										numero_de_casa='$datos[4]',
										calle_secundaria='$datos[5]',
										email='$datos[6]',
										telefono='$datos[7]',
										fecha_mod='$fecha' ,
										usuario_mod='$idusuario',
										clave='$datos[8]'
								where cedula='$datos[0]'";
			}
//echo $sql;
			return mysqli_query($conexion,$sql);
		}

		
	}

 ?>