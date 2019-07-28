<?php 
	class usuarios{
		public function registroUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$fecha=date('Y-m-d h:m:s');
            $id_usuario=self::traeIDUsuario($datos);
           		$sql="INSERT into `usuario` 
							(`ID_USUARIO`, 
							`ID_PERFIL`,
							 `USUARIO`,
							 `CLAVE`, 
							 `NOMBRE`,
							 `APELLIDO`, 
							 `FECHA_CREA`,				
								`USUARIO_CREA`
								)
						values ('$id_usuario',
								'$datos[4]',
								'$datos[2]',
								'$datos[3]',
								'$datos[0]',
								'$datos[1]',
								'$fecha',
								'$datos[2]'
								)";
			
			return mysqli_query($conexion,$sql);
		}
		public function loginUser($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			$password=sha1($datos[1]);
             
			$_SESSION['usuario']=$datos[0];
			$_SESSION['iduser']=self::traeID($datos);

			$sql="SELECT * 
					from usuario 
				where usuario='$datos[0]'
				and clave='$password'";
				//echo $sql;
				$result=mysqli_query($conexion,$sql);
			if(mysqli_num_rows($result) > 0){
				return 1;
			}else{
				return 0;
			}
		}

		public function loginCli($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			$password=sha1($datos[1]);
             
			$_SESSION['usuario']=$datos[0];
			$_SESSION['iduser']=self::traeID($datos);

			$sql="SELECT * 
					from cliente 
				where cedula='$datos[0]'
				and clave='$password'";
				//echo $sql;
				$result=mysqli_query($conexion,$sql);
			if(mysqli_num_rows($result) > 0){
				return 1;
			}else{
				return 0;
			}
		}

		public function traeIDUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$password=sha1($datos[3]);

			$sql="SELECT ifnull(max(ID_USUARIO),0)+1
					from usuario"; 
			$result=mysqli_query($conexion,$sql);
			return mysqli_fetch_row($result)[0];
		}
		public function traeID($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			$password=sha1($datos[1]);
			$sql="SELECT id_usuario 
					from usuario
					where usuario='$datos[0]'
					and clave='$password'";
			$result=mysqli_query($conexion,$sql);
			return mysqli_fetch_row($result)[0];
		}

		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_usuario,
			                    id_perfil,
			                    usuario,
			                    clave,
			                    nombre,
								apellido,
								estado
					from usuario 
					where id_usuario='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_usuario' => $ver[0],
							'id_perfil' => $ver[1],
							'usuario' => $ver[2],
							'clave' => $ver[3],
							'nombre' => $ver[4],
							'apellido' => $ver[5],
							'estado' => $ver[6]
						);

			return $datos;
		}

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();
			$password=sha1($datos[6]);

			$sql="UPDATE usuario set nombre='$datos[1]',
									apellido='$datos[2]',
									usuario='$datos[3]',
									id_perfil='$datos[4]',
									estado='$datos[5]',
									clave='$password'
						where id_usuario='$datos[0]'";
						
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaUsuario($idusuario){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from usuarios 
					where id_usuario='$idusuario'";
			return mysqli_query($conexion,$sql);
		}
	}

 ?>