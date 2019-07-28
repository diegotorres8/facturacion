
<?php require_once "dependencias.php" ?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

  <!-- Begin Navbar -->
  <div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="../img/logo_.jpg" alt="" width="100px" height="100px"></a> -->
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </li>            
          </li>
         <?php
        if($_SESSION['perfil']=="ADM"):
         ?>        
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Administrador <span class="caret"></span></a>
            <ul class="dropdown-menu">
               <li><a href="usuarios.php">Usuarios</a></li>
               <li><a href="repartidor.php">Repartidores</a></li>
            </ul>
          </li>     
        <?php 
       endif;
          ?>
         <?php
        if($_SESSION['perfil']=="ADM" or $_SESSION['perfil']=="BOD"):
         ?>     
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Administrar Articulos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="categorias.php">Categorias</a></li>
              <li><a href="articulos.php">Articulos</a></li>
            </ul>
          </li> 
           <?php 
       endif;
          ?>
         <?php
        if($_SESSION['perfil']=="ADM" or $_SESSION['perfil']=="VEN"):
         ?>           
        <li><a href="clientes.php"><span class="glyphicon glyphicon-user"></span> Clientes</a>
          </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Ventas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="ventas.php">Vender producto</a></li>
              <li><a href="ventasyReportes.php">Ventas Hechas</a></li>
            </ul>
         
          </li>
           <?php 
       endif;
          ?>
          <?php
        if($_SESSION['perfil']=="ADM" or $_SESSION['perfil']=="REP"):
         ?>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Despachar/Entregrados <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="repartir.php">Repartir</a></li>
              <li><a href="entregados.php">Entregados</a></li>
            </ul>
          </li> 

          
             <?php 
       endif;
          ?>
          <li class="dropdown" >
            <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['usuario']; echo  '<br>';?> Perfil: <?php echo$_SESSION['perfil'] ?>  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li> <a style="color: red" href="../procesos/salir.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
              
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.contatiner -->
  </div>
</div>
 
</body>
</html>

<script type="text/javascript">
  $(window).scroll(function() {
    if ($(document).scrollTop() > 150) {
      $('.logo').height(200);

    }
    else {
      $('.logo').height(100);
    }
  }
  );
</script>