<?php
require_once("conn.php");
@$sku1= $_POST['valorCaja1'];
@$sku2= $_POST['valorCaja2']; 

$consulta = "SELECT count(*) FROM `lentes` WHERE `codigo`='$sku1' or `codigo`='$sku2'";
if ($resultado = $con->query($consulta)) {
    $sku = $resultado->fetch_row();
         //echo "$cli[0]";
         if ($sku[0]==0) {
         	echo "<p style='color:red;'>SKU no encontrado <p>";
         }
    }
 ?>
