
<?php
include("../php/conn.php");
$usuario=$_POST['usr'];

	$consulta = "SELECT  count(`codigo`) FROM `usuarios` WHERE `codigo`='$usuario' AND `status`='1'";
	if ($resultado = $con->query($consulta)) {
	    $fila = $resultado->fetch_row();
	    	if ($fila[0]!=0) {
	    	echo "<script>
	    		document.getElementById('saludo').innerHTML = 'Bienvenido';
	    		</script>";
	    		session_start();
	    		$_SESSION['usuar']=$usuario;	  
	    	if ($resultado = $con->query("SELECT `tipo` FROM `usuarios` WHERE `codigo`='$usuario'")) {
	   			$tipousr = $resultado->fetch_row();
	   			$_SESSION['tipousr']=$tipousr[0];
			}  		
	    		sleep(3);
	    	?>
  	    	<script type="text/javascript">
	    		location.href ='../';
	    	</script>
	    	<?php
	    	}else{
	    		echo "<p id='mensaje'>Usuario incorrecto</p>";
	    		sleep(2);
	    		echo '<script>
	    			$("form").fadeIn(500);
	    			$(".wrapper").removeClass("form-success");
	    		</script>';
	    	}

		/* liberar el conjunto de resultados */
	    $resultado->close();
	}

 ?>