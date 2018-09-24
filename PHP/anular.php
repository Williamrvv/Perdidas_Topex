<?php 
	session_start();

include("conn.php");
@$observation=$_POST['observation'];
$docu=$_SESSION['buscar'];
$usuario=$_SESSION['usuar'];
 
	$consulta = "SELECT COUNT(`documento`) FROM `anuladas` WHERE `documento`='$docu'";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	        if ($fila[0]=='1') {
	        	?>
	        	<script type="text/javascript">swal("Atención!", "La pérdida ya ha sido anulada anteriormente!", "error");</script>
	        	<?php	        	
	        }else{
				$query = "UPDATE `documentos` SET `cantidad` = '0' WHERE `documentos`.`documento` = '$docu';";
					mysqli_query($con, $query);

				$query = "INSERT INTO `anuladas`(`documento`, `usuario`, `fecha`, `hora`, `comentario`) VALUES ($docu,'$usuario','$fecha','$hora','$observation')";
					mysqli_query($con, $query);
				?>
				 <script type="text/javascript">
				 	document.getElementById("anulobs").style.color="red";
				 	document.getElementById("anulobs").disabled = true;
				 </script>
				<?php
	        }
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}



 ?>



