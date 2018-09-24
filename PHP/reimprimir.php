<?php 
	session_start();
	include("conn.php");
$documento=$_POST['documento'];
	$consulta = "SELECT COUNT(`documento`) FROM `documentos` WHERE `documento` = $documento";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         if ($fila[0]==1) {
	         	$_SESSION['buscar']=$documento;
	         	?><script type="text/javascript">swal("Perdida encontrada", "Reimprimiendo Perdia", "success"); window.open("php/imprimir.php", "reimprimir", "width=300, height=400")</script><?php 
	         }else{
	         	?><script type="text/javascript">swal("Perdida NO encontrada", "Ingresa otro número de documento.", "error");</script><?php 
	         }
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
