<?php
require 'DAO.php';
if (isset($_GET['getin'])) {
  $DAOS = new DAO();
  $result = $DAOS->verificarUsuario($_GET['getin']);
  if (!empty($result)) {
    session_start();
    $_SESSION['ID'] = $result[0];
    $_SESSION['dni'] = $result[1];
    $_SESSION['nombre'] = $result[2];
    $_SESSION['cargo'] = $result[3];
    header("Location: /Parcial/Inicio");
  }else{
    echo "El dni no existe";
  }
}
if (isset($_GET['verInventario'])) {
  session_start();
  $DAOS = new DAO();
  $result = $DAOS->mostrarInventario($_SESSION['ID']);
  if (!empty($result)) {
    echo "
    <link href=\"http://localhost/parcial/Estilo/estilo.css\" rel=\"stylesheet\" type=\"text/css\">
    <table id=\"tablabusqueda\" name=\"tablabusqueda\">
    <tr>
    <th id=\"fila\" name=\"fila\">id_inventario</th>
    <th id=\"fila\" name=\"fila\">codigo_unico</th>
    <th id=\"fila\" name=\"fila\">tipo</th>
    <th id=\"fila\" name=\"fila\">descripcion</th>
    <th id=\"fila\" name=\"fila\">ubicacion</th>
    <th id=\"fila\" name=\"fila\">fecha_de_ingreso</th>
    </tr>";
    for ($i=0; $i <count($result) ; $i=$i+6) {
      echo "<tr>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i]."</td>"; //ID inventario
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+1]."</td>"; //código
      $result2 = $DAOS->verBienes($result[$i+2]);
      echo "<td id=\"fila\" name=\"fila\"> ".$result2[count($result2)-2]."</td>"; //tipo
      echo "<td id=\"fila\" name=\"fila\"> ".$result2[count($result2)-1]."</td>";//descripcion
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+3]."</td>"; //ubicacion
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+4]."</td>"; //fecha
      echo "</tr>";
    }
    echo "</table>";

  }else{
    echo "<h1>No tiene ningún inventario a su nombre :(</h1>";
  }

}
if (isset($_GET['nro_orden'])) {
  $DAOS = new DAO();
  $fecha_orden = str_replace("T", " ", $_GET['fecha_orden']);
  $fecha_orden = $fecha_orden.":00";
  $DAOS->agregarProveedor($_GET['nro_orden'], $_GET['ruc'],$_GET['razon_social'],$fecha_orden, $_GET['monto_total'],$_GET['fecha_entrega']);
  header("Location: /Parcial/Inicio/");
}
if (isset($_GET['bienesver'])) {
  $DAOS = new DAO();
  $result = $DAOS->obtenerTodoslosBienes();
    echo "
    <link href=\"http://localhost/parcial/Estilo/estilo.css\" rel=\"stylesheet\" type=\"text/css\">
    <table id=\"tablabusqueda\" name=\"tablabusqueda\">
    <tr>
    <th id=\"fila\" name=\"fila\">Descripción</th>
    <th id=\"fila\" name=\"fila\">Tipo</th>
    <th id=\"fila\" name=\"fila\">Acción</th>";
    for ($i=0; $i <count($result) ; $i=$i+3) {
      echo "<tr>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+1]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+2]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> <a href=http://localhost/Parcial/Servidor/Controller.php?bien=".$result[$i].">Editar</a></td>";
      echo "</tr>";
    }
    echo "</table>";
}
if (isset($_GET['bien'])) {
  $DAOS = new DAO();
  $result = $DAOS->verBienes($_GET['bien']);
  echo "
  <form action=\"http://localhost/Parcial/Servidor/Controller.php?\">
  Descripción: <input type=\"text\" name =\"moddescbien\" value=\"".$result[1]."\"><br>
  Tipo: <input type=\"text\" name=\"modtypebien\"value=\"".$result[2]."\"><br>
  ID:<input type=\"text\" name=\"modidbien\"value=\"".$result[0]."\"><br>
  <input type=\"submit\">
  </form>";
}
if (isset($_GET['modtypebien'])) {
  $DAOS = new DAO();
  $DAOS->modificarBien($_GET['modidbien'], $_GET['moddescbien'], $_GET['modtypebien']);
  header("Location: /Parcial/Inicio");
}
if (isset($_GET['inventariover'])) {
  $DAOS = new DAO();
  $result = $DAOS->obtenerTodoelInventario();
    echo "
    <link href=\"http://localhost/parcial/Estilo/estilo.css\" rel=\"stylesheet\" type=\"text/css\">
    <table id=\"tablabusqueda\" name=\"tablabusqueda\">
    <tr>
    <th id=\"fila\" name=\"fila\">codigo_unico</th>
    <th id=\"fila\" name=\"fila\">ubicacion</th>
    <th id=\"fila\" name=\"fila\">fecha_de_ingreso</th>
    <th id=\"fila\" name=\"fila\">accion</th>";
    for ($i=0; $i <count($result) ; $i=$i+6) {
      echo "<tr>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+1]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+3]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+4]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> <a href=http://localhost/Parcial/Servidor/Controller.php?inventario=".$result[$i].">Editar</a></td>";
      echo "</tr>";
    }
    echo "</table>";
}
if (isset($_GET['inventario'])) {
  $DAOS = new DAO();
  $result = $DAOS->verInventario($_GET['inventario']);
  $bienes = $DAOS->obtenerTodoslosBienes();
  $responsables = $DAOS->obtenerTodoslosResponsables();
  echo "
  <form action=\"http://localhost/Parcial/Servidor/Controller.php?\" id=\"forminventario\">
  codigo_unico: <input type=\"text\" name =\"modcuinv\" value=\"".$result[1]."\"><br>
  ubicacion: <input type=\"text\" name=\"modubiinv\"value=\"".$result[3]."\"><br>
  fecha_de_ingreso: <input type=\"text\" name =\"modfeinginv\" value=\"".$result[4]."\"><br>
  ID: <input type=\"text\" name=\"modidinv\"value=\"".$result[0]."\"><br>
  <input type=\"submit\">
  </form>";
  echo "
  id_bienes: <select name=\"selectbienes\" form=\"forminventario\">";
  for ($i=0; $i <count($bienes) ; $i=$i+3) {
    if ($bienes[$i] == $result[2]) {
      echo "<option value=\"".$bienes[$i]."\" selected>".$bienes[$i+2]."</option>";
    }else{
      echo "<option value=\"".$bienes[$i]."\">".$bienes[$i+2]."</option>";
    }
  }
  echo "</select><br>";
  echo "
  id_responsable: <select name=\"selectresponsable\" form=\"forminventario\">";
  for ($i=0; $i <count($responsables) ; $i=$i+4) {
    if ($responsables[$i]==$result[5]) {
      echo "<option value=\"".$responsables[$i]."\" selected>".$responsables[$i+1]." - ".$responsables[$i+2]."</option>";
    }else{
      echo "<option value=\"".$responsables[$i]."\">".$responsables[$i+1]." - ".$responsables[$i+2]."</option>";
    }
  }
  echo "</select>";

}
if (isset($_GET['modcuinv'])) {
  $DAOS = new DAO();
  $DAOS->modificarInventario($_GET['modidinv'], $_GET['modcuinv'], $_GET['selectbienes'], $_GET['modubiinv'], $_GET['modfeinginv'], $_GET['selectresponsable']);
  header("Location: /Parcial/Inicio");
}
if (isset($_GET['proveedoresver'])) {
  $DAOS = new DAO();
  $result = $DAOS->obtenerTodoslosProveedores();
    echo "
    <link href=\"http://localhost/parcial/Estilo/estilo.css\" rel=\"stylesheet\" type=\"text/css\">
    <table id=\"tablabusqueda\" name=\"tablabusqueda\">
    <tr>
    <th id=\"fila\" name=\"fila\">nro_orden</th>
    <th id=\"fila\" name=\"fila\">ruc</th>
    <th id=\"fila\" name=\"fila\">razon_social</th>
    <th id=\"fila\" name=\"fila\">fecha_orden</th>
    <th id=\"fila\" name=\"fila\">monto_total</th>
    <th id=\"fila\" name=\"fila\">fecha_entrega</th>
    <th id=\"fila\" name=\"fila\">accion</th>";
    for ($i=0; $i <count($result) ; $i=$i+7) {
      echo "<tr>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+1]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+2]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+3]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+4]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+5]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+6]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> <a href=http://localhost/Parcial/Servidor/Controller.php?proveedor=".$result[$i].">Editar</a></td>";
      echo "</tr>";
    }
    echo "</table>";
}
if (isset($_GET['proveedor'])) {
  $DAOS = new DAO();
  $result = $DAOS->verProveedor($_GET['proveedor']);
  $result[4] = str_replace(" ", "T", $result[4]);
  $result[4] = substr($result[4], 0, -3);
  echo "
  <form action=\"http://localhost/Parcial/Servidor/Controller.php?\">
    nro_orden: <input type=\"text\" name =\"modnroord\" value=\"".$result[1]."\"><br>
    ruc: <input type=\"text\" name=\"modruc\"value=\"".$result[2]."\"><br>
    razon_social: <input type=\"text\" name =\"modrazo\" value=\"".$result[3]."\"><br>
    fecha_orden: <input type=\"datetime-local\" name=\"modfeor\"value=\"".$result[4]."\"><br>
    monto_total: <input type=\"text\" name=\"modmontot\"value=\"".$result[5]."\"><br>
    fecha_entrega: <input type=\"date\" name=\"modfeen\"value=\"".$result[6]."\"><br>
    id_proveedor: <input type=\"text\" name=\"modidpro\"value=\"".$result[0]."\"><br>
  <input type=\"submit\">
  </form>";
}
if (isset($_GET['modnroord'])) {
  $DAOS = new DAO();
  $fechaorden= str_replace("T"," ", $_GET['modfeor']);
  $fechaorden= $fechaorden.":00";
  $DAOS->modificarProveedor($_GET['modidpro'], $_GET['modnroord'], $_GET['modruc'], $_GET['modrazo'], $fechaorden, $_GET['modmontot'], $_GET['modfeen']);
  header("Location: /Parcial/Inicio");
}
if (isset($_GET['adddesc'])) {
  $DAOS = new DAO();
  $DAOS->agregarBien($_GET['adddesc'], $_GET['addtype']);
  header("Location: /Parcial/Inicio");
}
if (isset($_GET['delbienver'])) {
  $DAOS = new DAO();
  $result = $DAOS->obtenerTodoslosBienes();
  echo"
  <link href=\"http://localhost/parcial/Estilo/estilo.css\" rel=\"stylesheet\" type=\"text/css\">
  <table id=\"tablabusqueda\" name=\"tablabusqueda\">
  <tr>
  <th id=\"fila\" name=\"fila\">descripcion</th>
  <th id=\"fila\" name=\"fila\">tipo</th>";
  for ($i=0; $i <count($result) ; $i=$i+3) {
    echo "<tr>";
    echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+1]."</td>";
    echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+2]."</td>";
    echo "<td id=\"fila\" name=\"fila\"> <a href=http://localhost/Parcial/Servidor/Controller.php?delbien=".$result[$i].">Borrar</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}
if (isset($_GET['delbien'])) {
  $DAOS = new DAO();
  $DAOS->eliminarBien($_GET['delbien']);
  header("Location: /Parcial/Inicio");
}
if (isset($_GET['delprovver'])) {
  $DAOS = new DAO();
  $result = $DAOS->obtenerTodoslosProveedores();
    echo "
    <link href=\"http://localhost/parcial/Estilo/estilo.css\" rel=\"stylesheet\" type=\"text/css\">
    <table id=\"tablabusqueda\" name=\"tablabusqueda\">
    <tr>
    <th id=\"fila\" name=\"fila\">nro_orden</th>
    <th id=\"fila\" name=\"fila\">ruc</th>
    <th id=\"fila\" name=\"fila\">razon_social</th>
    <th id=\"fila\" name=\"fila\">fecha_orden</th>
    <th id=\"fila\" name=\"fila\">monto_total</th>
    <th id=\"fila\" name=\"fila\">fecha_entrega</th>
    <th id=\"fila\" name=\"fila\">accion</th>";
    for ($i=0; $i <count($result) ; $i=$i+7) {
      echo "<tr>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+1]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+2]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+3]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+4]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+5]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+6]."</td>";
      echo "<td id=\"fila\" name=\"fila\"> <a href=http://localhost/Parcial/Servidor/Controller.php?delproveedor=".$result[$i].">Borrar</a></td>";
      echo "</tr>";
    }
    echo "</table>";
}
if (isset($_GET['delproveedor'])) {
  $DAOS  = new DAO();
  $DAOS->eliminarProveedor($_GET['delproveedor']);
  header("Location: /Parcial/Inicio");
}
if (isset($_GET['delinvver'])) {
  $DAOS = new DAO();
  $result = $DAOS->obtenerTodoelInventario();
  echo "
  <link href=\"http://localhost/parcial/Estilo/estilo.css\" rel=\"stylesheet\" type=\"text/css\">
  <table id=\"tablabusqueda\" name=\"tablabusqueda\">
  <tr>
  <th id=\"fila\" name=\"fila\">id_inventario</th>
  <th id=\"fila\" name=\"fila\">codigo_unico</th>
  <th id=\"fila\" name=\"fila\">tipo</th>
  <th id=\"fila\" name=\"fila\">descripcion</th>
  <th id=\"fila\" name=\"fila\">ubicacion</th>
  <th id=\"fila\" name=\"fila\">fecha_de_ingreso</th>
  <th id=\"fila\" name=\"fila\">eliminar</th>";
  for ($i=0; $i <count($result) ; $i=$i+6) {
    echo "<tr>";
    echo "<td id=\"fila\" name=\"fila\"> ".$result[$i]."</td>"; //ID inventario
    echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+1]."</td>"; //código
    $result2 = $DAOS->verBienes($result[$i+2]);
    echo "<td id=\"fila\" name=\"fila\"> ".$result2[count($result2)-2]."</td>"; //tipo
    echo "<td id=\"fila\" name=\"fila\"> ".$result2[count($result2)-1]."</td>";//descripcion
    echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+3]."</td>"; //ubicacion
    echo "<td id=\"fila\" name=\"fila\"> ".$result[$i+4]."</td>"; //fecha
    echo "<td id=\"fila\" name=\"fila\"> <a href=http://localhost/Parcial/Servidor/Controller.php?delinventario=".$result[$i].">Borrar</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}
if (isset($_GET['delinventario'])) {
  $DAOS  = new DAO();
  $DAOS->eliminarInventario($_GET['delinventario']);
  header("Location: /Parcial/Inicio");
}
if (isset($_GET['salir'])) {
  session_destroy();
  header("Location: /Parcial/Entrar/");
}

?>
