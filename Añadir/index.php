<?php
session_start();
if(empty($_SESSION['nombre'])){
  header("Location: /Parcial/Entrar/");
}
?>
<html lang="es">
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/Parcial/js/javascript.js"></script>
    <link href="http://localhost/Parcial/Estilo/estilo.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="añadirproveedor">
      <form action="http://localhost/Parcial/Servidor/Controller.php?">
        Número de orden: <input type="text" name="nro_orden" value=""><br>
        RUC: <input type="text" name="ruc" value=""><br>
        Razón social: <input type="text" name="razon_social" value=""><br>
        Fecha orden: <input type="datetime-local" name="fecha_orden" value=""><br>
        Monto total: <input type="text" name="monto_total" value=""><br>
        Fecha entrega: <input type="date" name="fecha_entrega" value=""><br>
        <input type="submit" value="agregar">
      </form>
    </div>
    <button id="addprov">Añadir proveedor</button>
    <div id="añadirBien">
      <form action="http://localhost/Parcial/Servidor/Controller.php?" >
        Descripción: <input type="text" name="adddesc" value=""><br>
        Tipo: <input type="text" name="addtype" value=""><br>
        <input type="submit" value="agregar">
      </form>
    </div >
    <button id="addown">Añadir bien</button>

  </body>
</html>
