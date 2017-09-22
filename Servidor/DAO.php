<?php
require "DBOperator.php";
class DAO {
  private $DBO;
  private $Consulta;
  public function __construct(){
    $this->DBO = new DBOperator('localhost', 'root', 'h2k', '', 'utf8');
  }
  public function verificarUsuario($dni){
    $this->Consulta="SELECT * FROM `responsable` WHERE dni LIKE '".$dni."'";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function mostrarInventario($ID){
    $this->Consulta="SELECT * FROM `inventario` WHERE id_responsable LIKE '".$ID."'";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function verInventario($id_inventario){
    $this->Consulta="SELECT * FROM `inventario` WHERE id_inventario LIKE '".$id_inventario."'";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function verBienes($id_bienes){
    $this->Consulta="SELECT * FROM `bienes` WHERE id_bienes LIKE '".$id_bienes."'";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function agregarProveedor($nro_orden, $ruc, $razon_social, $fecha_orden,$monto_total,$fecha_entrega){
    $this->Consulta="INSERT INTO `proveedor` (`id_proveedor`, `nro_orden`, `ruc`, `razon_social`, `fecha_orden`, `monto_total`, `fecha_entrega`) VALUES (NULL,'".$nro_orden."', '".$ruc."', '".$razon_social."', '".$fecha_orden."', '".$monto_total."', '".$fecha_entrega."')";
    $this->DBO->consult($this->Consulta, "no");
  }
  public function agregarBien($descripcion, $tipo){
    $this->Consulta="INSERT INTO `bienes` (`id_bienes`, `descripcion`, `tipo`) VALUES (NULL, '".$descripcion."', '".$tipo."')";

    $this->DBO->consult($this->Consulta, "no");
  }
  public function obtenerTodoslosBienes(){
    $this->Consulta="SELECT * FROM `bienes`";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function modificarBien($id, $desc, $tipo){
    $this->Consulta="UPDATE `bienes` SET `descripcion`= '".$desc."', `tipo` = '".$tipo."' WHERE `bienes`.`id_bienes` = ".$id;
    $this->DBO->consult($this->Consulta, "no");
  }
  public function obtenerTodoelInventario(){
    $this->Consulta="SELECT * FROM `inventario`";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function obtenerTodoslosResponsables(){
    $this->Consulta="SELECT * FROM `responsable`";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function modificarInventario($id_inventario, $codigo_unico, $id_bienes, $ubicacion, $fecha_de_ingreso, $id_responsable){
    $this->Consulta="UPDATE `inventario` SET `codigo_unico` = '".$codigo_unico."', `id_bienes`='".$id_bienes."', `ubicacion` ='".$ubicacion."', `fecha_ingreso` ='".$fecha_de_ingreso."', `id_responsable`= '".$id_responsable."' WHERE `inventario`.`id_inventario` = ".$id_inventario;
    $this->DBO->consult($this->Consulta, "no");
  }
  public function obtenerTodoslosProveedores(){
    $this->Consulta="SELECT * FROM `proveedor`";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function verProveedor($id_proveedor){
    $this->Consulta="SELECT * FROM `proveedor` WHERE id_proveedor LIKE '".$id_proveedor."'";
    $result = $this->DBO->consult($this->Consulta, "yes");
    return $result;
  }
  public function modificarProveedor($id_proveedor, $nro_orden, $ruc, $razon_social, $fecha_orden, $monto_total, $fecha_entrega){
    $this->Consulta="UPDATE `proveedor` SET `nro_orden` = '".$nro_orden."', `ruc`='".$ruc."', `razon_social` ='".$razon_social."', `fecha_orden` ='".$fecha_orden."', `monto_total`= '".$monto_total."', `fecha_entrega` ='".$fecha_entrega."' WHERE `proveedor`.`id_proveedor` = ".$id_proveedor;
    $this->DBO->consult($this->Consulta, "no");
  }
  public function eliminarProveedor($id_proveedor){
    $this->Consulta="DELETE FROM proveedor WHERE id_proveedor LIKE '".$id_proveedor."'";
    $this->DBO->consult($this->Consulta, "no");
  }
  public function eliminarBien($id_bienes){
    $this->Consulta="DELETE FROM bienes WHERE id_bienes LIKE '".$id_bienes."'";
    $this->DBO->consult($this->Consulta, "no");
  }
  public function eliminarInventario($id_inventario){
    $this->Consulta="DELETE FROM inventario WHERE id_inventario LIKE '".$id_inventario."'";
    $this->DBO->consult($this->Consulta, "no");
  }
  public function eliminarResponsable($id_responsable){
      $this->Consulta="DELETE FROM responsable WHERE id_responsable LIKE '".$id_responsable."'";
      $this->DBO->consult($this->Consulta, "no");
  }
}
?>
