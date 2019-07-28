<?php 

class ventas{
	public function obtenDatosProducto($idproducto,$categoria){
		$c=new conectar();
		$conexion=$c->conexion();
//echo $categoria;
		$sql="SELECT art.nombre,
		art.descripcion,
		art.cantidad,
		img.ruta,
		art.precio
		from articulos as art 
		inner join imagenes as img
		on art.ID_CATEGORIA=img.ID_CATEGORIA 
        and art.ID_PRODUCTO=img.ID_PRODUCTO 
		and art.id_producto='$idproducto'
		and art.id_categoria='$categoria'";
		//echo $sql;
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$d=explode('/', $ver[3]);

		$img=$d[1].'/'.$d[2].'/'.$d[3];

		$data=array(
			'nombre' => $ver[0],
			'descripcion' => $ver[1],
			'cantidad' => $ver[2],
			'ruta' => $img,
			'precio' => $ver[4]
		);		
		return $data;
	}

	public function crearVenta(){
		$c= new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d H:i:s');
		$idventa=self::creaFolio();
		$datos=$_SESSION['tablaComprasTemp'];
		$idusuario=$_SESSION['usuario'];

               
				$total=0;

    for ($i=0; $i <count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);
			$total=$total+($d[3]*$d[6]);
			$cedula=$d[5];
			$ID_SECTOR=$d[9];
			$ID_CIUDAD=$d[8];
			$CALLE_PRINCIPAL=$d[10];
			$NUMERO_CASA=$d[11];
			$CALLE_SECUNDARIA=$d[12];
			$latitud=$d[14];
			$longitud=$d[15];

		}

			
       $sql="INSERT into            
			        venta (ID_VENTA,CEDULA,ID_SECTOR,ID_CIUDAD,PRECIO,
                            CALLE_PRINCIPAL,NUMERO_CASA,CALLE_SECUNDARIA,
                                   FECHA_CREA,USUARIO_CREA,LATITUD,LONGITUD)
					values ('$idventa','$cedula','$ID_SECTOR',	'$ID_CIUDAD','$total',
							'$CALLE_PRINCIPAL','$NUMERO_CASA','$CALLE_SECUNDARIA',
									'$fecha','$idusuario','$latitud',$longitud)";
									//echo $sql;
         $result=mysqli_query($conexion,$sql);

         $iddespacho=self::creaFolio1($idventa,2);

          $sql1="INSERT into            
			        despacho_ventas (ID_despacho,id_venta,ID_CIUDAD,ID_SECTOR,
                                   FECHA_Asignado)
					values ('$iddespacho','$idventa','$ID_CIUDAD','$ID_SECTOR','$fecha')";			//echo $sql1;		
         $result1=mysqli_query($conexion,$sql1);
             
       $r=0;
        $iddetventa=self::creaFolio1($idventa,1);
		for ($i=0; $i <count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);

			$sql="INSERT into            
			        detalle_venta (ID_DETVEN,id_producto,
			        id_categoria,id_venta,
			        ID_SECTOR,ID_CIUDAD,PRECIO,cantidad
                           )
					values ('$iddetventa','$d[0]','$d[13]','$idventa',
                           '$d[9]','$d[8]','$d[3]','$d[6]')";
									//echo $sql;
			$result=mysqli_query($conexion,$sql);
   
   $sql2="update articulos
        set cantidad=cantidad-$d[6]
        where id_producto='$d[0]'
        and id_categoria='$d[13]'";
$result2=mysqli_query($conexion,$sql2);
			$r=$r+1;			
			$iddetventa=$iddetventa+1;	
		}

		return $r;
	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_venta from venta group by id_venta desc";

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
	public function creaFolio1($venta,$tipo){
		$c= new conectar();
		$conexion=$c->conexion();
        
        if ($tipo==1){
		$sql="SELECT id_detven from detalle_venta where id_venta='$venta' group by id_venta desc";
	     }
	    elseif ($tipo==2) {
	    	$sql="SELECT id_despacho from despacho_ventas where id_venta='$venta' group by id_venta desc";
	    }

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}




	public function nombreCliente($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT apellido,nombre 
			from cliente
			where cedula='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenerTotal($idventa){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT precio 
				from venta 
				where id_venta='$idventa'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}
}

?>