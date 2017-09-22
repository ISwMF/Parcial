<?php
session_start();
if(empty($_SESSION['nombre'])){
  header("Location: /Parcial/Entrar/");
}
?>
<html lang="es">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="http://localhost/parcial/Estilo/estilo.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Bienvenid@ <?php echo $_SESSION['nombre']?></a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="#">Perfil</a></li>
          <li><a href="/Parcial/Servidor/Controller.php?verInventario=t">Ver todo</a></li>
          <?php
          if ($_SESSION['cargo'] > 1 ) {
            echo "<li><a href=\"/Parcial/Añadir/\">Añadir...</a></li>";
          }
          if ($_SESSION['cargo'] > 2) {
            echo "
            <li class=\"dropdown\">
            <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">Modificar<span class=\"caret\"></span></a>
            <ul class=\"dropdown-menu\">
            <li><a href=\"/Parcial/Modificar/Bienes\">Bienes</a></li>
            <li><a href=\"/Parcial/Modificar/Inventario\">Inventario</a></li>
            <li><a href=#>Proveedor</a></li>
            </ul>";
          }
          if ($_SESSION['cargo'] > 3) {
            echo "
            <li class=\"dropdown\">
            <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">Eliminar<span class=\"caret\"></span></a>
            <ul class=\"dropdown-menu\">
            <li><a href=\"/Parcial/Eliminar/Bienes\">Bienes</a></li>
            <li><a href=\"/Parcial/Eliminar/Inventario\">Inventario</a></li>
            <li><a href=\"/Parcial/Eliminar/Proveedor\">Proveedor</a></li>
            <li><a href=#>Responsable</a></li>
            </ul>";
          }
          ?>
          <li><a href="/Parcial/Servidor/Controller.php?salir=true">Salir</a></li>
        </ul>
      </div>
    </nav>
  </body>
</html>
