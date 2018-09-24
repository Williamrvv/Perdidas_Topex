<?php 
	include("conn.php");

	$cliente=$_POST['client'];

	if ($cliente!='') {
		$consulta = "SELECT COUNT(`Cliente`)FROM `clientes` WHERE `Cliente`='$cliente' AND `status`=1";
		if ($resultado = $con->query($consulta)) {
		    while ($fila = $resultado->fetch_row()) {
		         //echo "$fila[0]";
		         if ($fila[0]==0) {
		         	echo "<b style='color:red'>NO SE ENCONTRÓ EL CLIENTE</b>";
		         }
		    }
		    /* liberar el conjunto de resultados */
		    $resultado->close();
		}
	}


 ?>