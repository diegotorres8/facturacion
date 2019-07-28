<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "../clases/Conexion.php"; 
	$usuario=$_SESSION['usuario'];
		$c= new conectar();
		$conexion=$c->conexion();
		$sql="SELECT id_perfil
		from usuario
		where usuario='$usuario'";
		
		$ver =mysqli_fetch_row(mysqli_query($conexion,$sql));
		$_SESSION['perfil']=$ver[0];
		?>
	<?php require_once "menu.php"; ?>
	
</head>
<body>


</body>
</html>
<?php 
	}else{
		header("location:../index.php");
	}
 ?>