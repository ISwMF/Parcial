<?php
session_start();
if(empty($_SESSION['nombre'])){
  header("Location: /Parcial/Entrar/");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="/Parcial/js/ajax.js"></script>
    <title></title>
  </head>
  <body>
    <button type="button" name="button" onclick="verProveedorparaEliminar()">Click para ver todos los Proveedores</button>
    <div id="demo">
    </div>
  </body>
</html>
