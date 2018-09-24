<?php 
	session_start();
if (isset($_SESSION['usuar'])) {
	$tipousr=$_SESSION['tipousr'];
	$usuarioo=$_SESSION['usuar'];

}else{
	header('location: login');
}

include("php/conn.php");
?>

<!DOCTYPE html>
<!-- <meta http-equiv="refresh" content="6; url=http://localhost:88/perdidas2" /> -->
<html lang="es">
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/roboto.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/ripples.min.css">

<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.2.1/jquery.quicksearch.js"></script>

<head>
<title>Listado de pérdidas</title>
</head>
<body>
<center><h1><b>Sistema de control de pérdidas v0.6.6 (BETA)</b></h1></center>

<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
  	<?php 
     if ($tipousr=='root') {
    	echo '
    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Ingreso de pérdida</a></li>
     	<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Datos</a></li>
     	<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Configuración</a></li>
     ';
    }if ($tipousr=='operario') {
    	echo '
    	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Ingreso de pérdida</a></li>
     	<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Datos</a></li>
     ';
    }if ($tipousr=='invitado'){
    	echo '
     	<li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Datos</a></li>';
    } ?>
<!--    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li> -->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  	<?php if ($tipousr!='invitado') {
  		echo '<div role="tabpanel" class="tab-pane fade in active" id="home">';
  	}else{
  		echo '<div role="tabpanel" class="tab-pane fade" id="home">';
  	} ?>
			<form class="form-inline" method="POST" action="php/ingresar.php">
			<div class="table-responsive">
			<table class="table">
			  <div class="form-group">
			  	<tr>
			  		<?php 
						$consulta = "SELECT `nombre` FROM `usuarios` WHERE `codigo`='$usuarioo'";
						if ($resultado = $con->query($consulta)) {
						    while ($fila = $resultado->fetch_row()) {
						         echo '<td><input type="text" class="form-control" value="'.$fila[0].'" disabled></td>';
						    }
						    /* liberar el conjunto de resultados */
						    $resultado->close();
						}

					//verrifica el numero de documento siguiente
						$consulta = "SELECT (MAX(`documento`)+1) FROM `documentos`";
						if ($resultado = $con->query($consulta)) {
						    while ($fila = $resultado->fetch_row()) {
						         echo '<td><input type="text" name="documento" class="form-control" value="'.$fila[0].'" readonly></td>';
						    }
						    /* liberar el conjunto de resultados */
						    $resultado->close();
						}
					//****************************************
						?>
			  		<td><input type="number" class="form-control" id="orden" placeholder="Número de orden" name="orden" required=""></td>
			  	</tr>
			  	<tr><td><label for="exampleInputName2">Cliente:</label></td>
			  		<td>
			  			<!-- ------------------------------------------------buscar comprobar y agregar cliente -->
			  				<input type="text" class="form-control" id="cliente" placeholder="Nombre de la óptica o cliente" name="cliente" onblur="comprobar(this.value)" required="">
			  				<div id="mensaj"></div>
			  		</td>
			  	</tr>
			  	<tr>
			  		<td><label for="exampleInputName2">Tipo de pérdida: </label></td>
			  		<td>
			  			<select class="form-control" required="" name="tipo" id="tipop" onchange="tipoper(this.selectedIndex);">
			  				<option></option>
			  				<option value="interna">Interna</option>
			  				<option value="garantia">Garantía</option>
			  			</select>
			  		</td>
					<td>
			  			<select class="form-control" required="" name="quejas" id="queja">
			  				<option value=""></option>
<?php 
	$consulta = "SELECT `id`, `queja` FROM `quejas` where `status` = '1' ORDER BY `queja` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
			  			</select>
			  		</td>
			  	</tr>
					<tr><td><label for="exampleInputName2">Origen: </label></td>
				    <td><select class="form-control" required="" onchange="pers(this.selectedIndex);" name="origen" id="origen">
			    		  <option></option>
						  <option value="Persona">Persona</option>
						  <option value="Maquina">Máquina</option>
						  <option value="Material">Material</option>
						  <option value="Software">Software</option>
						</select></td>
						<td><select class="form-control" id="maquina" name="maquina" >
						  <option></option>
<?php 
	$consulta = "SELECT `id`, `maquina` FROM `maquinas` where `status` = '1' ORDER BY `maquina` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
						</select></td>
						<td><select class="form-control" id="persona" name="persona">
						<option></option>
<?php 
	$consulta = "SELECT `id`, `persona` FROM `personas` where `status` = '1' ORDER BY `persona` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
						</select></td>
						<td><select class="form-control" id="material" name="material">
						  <option></option>
<?php 
	$consulta = "SELECT `id`, `material` FROM `materiales` ORDER BY `material` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
						</select></td>
				  </div>
				  </tr>

				 			  <tr><div class="form-group">
			    <td><label >Operación: </label></td>
			    	<td><select class="form-control" id="operacion" name="operacion" required="">
						  <option value=""></option>
<?php 
	$consulta = "SELECT `id`, `operacion` FROM `operaciones` ORDER BY `operacion` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  </div></tr>

			  <tr><div class="form-group">
			    <td><label >Tipo de proceso: </label></td>
			    	<td><select class="form-control" id="proceso" name="Proceso" required="" onchange="tipoproceso(this.selectedIndex)">
						  <option value=""></option>
<?php 
	$consulta = "SELECT `id`, `proceso` FROM `procesos` ORDER BY `proceso` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	  $resultado->close();
	}
 ?>
					</select></td>
			  </div></tr>

			  <tr><div class="form-group">
			    <td><label >Tipo de lente: </label></td>
			    	<td><select class="form-control" id="tlente" name="tlente">
						  <option value="NULL"></option>
<?php 
	$consulta = "SELECT `id`, `tlente` FROM `tlentes` WHERE status=1 ORDER BY `tlente` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  </div></tr>

			  			  <tr><div class="form-group">
			    <td><label >Tipo de Diseño: </label></td>
			    	<td><select class="form-control" id="diseno" name="diseno">
						  <option value="NULL"></option>
<?php 
	$consulta = "SELECT `id`, `diseno` FROM `disenos` ORDER BY `diseno` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  </div></tr>

			  	<tr><div class="form-group">
			    <td><label >Tipo de montaje: </label></td>
			    	<td><select class="form-control" id="montaje" name="montaje">
						  <option value="NULL"></option>
<?php 
	$consulta = "SELECT `id`, `montaje` FROM `montajes` ORDER BY `montaje` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  </div></tr>
			  	<tr><div class="form-group">
			    <td><label >Posición de lente: </label></td>
			    	<td><select class="form-control" id="plente" name="plente" onchange="poslente(this.selectedIndex);" required="">
						  <option value=""></option>
<?php 
	$consulta = "SELECT `id`, `posicion` FROM `plente`";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  </div>
			  <td id="tdizquierdo"><input type="text" class="form-control ocultar" id="lizquierdo" onblur="compsku1($('#lizquierdo').val())" placeholder="SKU lente izquierdo" name="lizquierdo" ><br><div id="sku1"></div></td>
			  
			  <td id="tdderecho"><input type="text" class="form-control ocultar" id="lderecho" onblur="compsku2($('#lderecho').val())" placeholder="SKU lente derecho" name="lderecho" ><br><div id="sku2"></div></td>
			</tr>
			  	<tr><div class="form-group">
			    <td><label >Posición de cabezal: </label></td>
			    	<td><select class="form-control" id="pcabezal" name="pcabezal">
						  <option value="NULL"></option>
<?php 
	$consulta = "SELECT `id`, `cabezal` FROM `pcabezal`";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  </div></tr>
				<tr><div class="form-group">
			    <td><label >Defecto óptico: </label></td>
			    	<td><select class="form-control" id="defoptico" name="defoptico">
						  <option value="NULL"></option>
<?php 
	$consulta = "SELECT `id`, `defecto` FROM `defoptico` ORDER BY `defecto` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  	</div></tr>
				<tr><div class="form-group">
			    <td><label >Defecto estético: </label></td>
			    	<td><select class="form-control" id="defestetico" name="defestetico">
						  <option value="NULL"></option>
<?php 
	$consulta = "SELECT `id`, `defecto` FROM `defestetico` ORDER BY `defecto` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  	</div></tr>
				<tr><div class="form-group">
			    <td><label >Defecto en aro: </label></td>
			    	<td><select class="form-control" id="aro" name="aro">
						  <option value="NULL"></option>
<?php 
	$consulta = "SELECT `id`, `aro` FROM `aros` ORDER BY `aro` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  	</div></tr>
			  	<tr><div class="form-group">
			    <td><label >Defecto en Anti Reflejo: </label></td>
			    	<td><select class="form-control" id="ar" name="ar">
						  <option value="NULL"></option>
<?php 
	$consulta = "SELECT `id`, `defecto` FROM `antireflejo` ORDER BY `defecto` ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
	         echo "<option value='$fila[0]'>$fila[1]</option>";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
					</select></td>
			  	</div></tr>
			  	<tr><div class="form-group">
			    <td><label >Observación: </label></td>
			    	<td><textarea class="form-control" rows="5" name="observacion" placeholder="Describe una observación extra" name="Obs"></textarea></td>
			  	</div></tr>
			  	</table>
				</div>
				<div class="table-responsive">
				  <table class="table table-bordered">
				    <tr>
				    	<th>Ojo</th>
				    	<th>&nbsp;&nbsp;&nbsp;Material&nbsp;&nbsp;&nbsp;</th>
				    	<th>Base</th>
				    	<th>Esfera</th>
				    	<th>Cilindro</th>
				    	<th>Adición</th>
				    </tr>
				    <tr>
				    	<td>Derecho<input type="hidden" name="ojo1" value="d"></td>
				    	<td><input class="form-control" type="text" name="material1"></td>
				    	<td><input class="form-control" type="number" name="base1" id="base1" disabled="" step="any"></td>
				    	<td><input class="form-control" type="number" name="esf1" id="esf1" disabled="" step="any"></td>
				    	<td><input class="form-control" type="number" name="cly1" id="cly1" disabled="" step="any"></td>
				    	<td><input class="form-control" type="number" name="add1" id="add1" disabled="" step="any"></td>
				    </tr>
				    <tr>
				    	<td>Izquierdo<input type="hidden" name="ojo2" value="i"></td>
				    	<td><input class="form-control" type="text" name="material2"></td>
				    	<td><input class="form-control" type="number" name="base2" id="base2" disabled="" step="any"></td>
				    	<td><input class="form-control" type="number" name="esf2" id="esf2" disabled="" step="any"></td>
				    	<td><input class="form-control" type="number" name="cly2" id="cly2" disabled="" step="any"></td>
				    	<td><input class="form-control" type="number" name="add2" id="add2" disabled="" step="any"></td>
				    </tr>
				  </table>
				</div>
			    <label>
			      <input type="checkbox" id="desbloq"> Desbloquear todos
			    </label>
			  <center><button type="submit" class="btn btn-primary">Agregar Pérdida</button></center>
			</form>
<form class="form-inline" id="reimprimir">
  <div class="form-group">
    <label for="exampleInputEmail2">Remprimir</label>
    <input type="number" class="form-control" id="exampleInputEmail2" name="documento" placeholder="Número de perdida">
  </div>
  <button class="btn btn-default">Reimprimir</button>
</form>
<div id="reimp"></div>


    </div>

<?php if ($tipousr=='invitado') {
	echo '<div role="tabpanel" class="tab-pane fade in active" id="profile">';
}else{
	echo '<div role="tabpanel" class="tab-pane fade" id="profile">';
} ?>
	<select class="form-control" required="" name="pareto" id="pareto" onchange="paret(this.selectedIndex);">
		<option></option>
		<option value="personas">General</option>
		<option value="maquinas">Personas</option>
		<option value="maquinas">Maquinas</option>
		<option value="material">Material</option>
		<option value="software">Software</option>
	</select>
	<br>
    <form method="post" id="formulario" >
    	<label>Días desde: <i class="glyphicon glyphicon-calendar"></i></label>
    	<?php 
    	echo '
    	<input type="date" name="dia1" required="" autofocus value="'.$fecha.'" /> <label>Hasta: <i class="glyphicon glyphicon-calendar"></i></label>
        <input type="date" name="dia2" required="" value="'.$fecha.'"> <br>
    	';
    	 ?>
        <label>Hora desde: <span class="glyphicon glyphicon-time" aria-hidden="true"></span></label>
		<input type="time" name="hora1" required="" min="00:00" max="23:59" step="600" value="00:00"> <label>Hasta: <span class="glyphicon glyphicon-time" aria-hidden="true"></span></label>
		<input type="time" name="hora2" required="" min="00:00" max="23:59" step="600" value="23:59"> <br>
        <input type="button" class="btn btn-info" id="btn-ingresar" value="Ver Valores" />
    </form> 

    <div id="resp"></div>

    </div>
    <!-- configuración ------------------------------------------------------------------------------>
    <div role="tabpanel" class="tab-pane fade" id="messages">
			<form class="form-inline"  method="POST" id="busqueda" >
			  <div class="form-group">
			    <label>Buscar documento</label>
			    <input type="text" class="form-control" id="buscar" name="docord" placeholder="Número de documento" required="">
			  </div>
			  <input type="button" class="btn btn-default" id="search" value="Buscar" />
			</form>
			<div id="resul"></div>
    	
			<br>
			<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">Opciones del formulario</button>
    </div>
<!--    <div role="tabpanel" class="tab-pane fade" id="settings">...</div> -->
  </div>

</div>
<!-- Inicio modal ---------------------------------------------------------------------->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    	<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#agregar" aria-controls="agregar" role="tab" data-toggle="tab">Agregar</a></li>
    <li role="presentation"><a href="#editar" aria-controls="editar" role="tab" data-toggle="tab">Editar</a></li>
    <li role="presentation"><a href="#ocultar" aria-controls="ocultar" role="tab" data-toggle="tab">ocultar</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  	<!------------agregar opciones-->
    <div role="tabpanel" class="tab-pane fade in active" id="agregar">
    	<h2><strong><center>Agregar Opciones</center></strong></h2>
      <form class="form-horizontal" method="POST" action="php/agregar.php">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="cliente" placeholder="Escribe nombre completo del cliente">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Persona</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="persona" placeholder="Escribe nombre completo de la persona">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Maquina</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="maquina" placeholder="Escribe el nombre de la maquina">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Material</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="material" placeholder="Escribe un material">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Operación</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="operacion" placeholder="Escribe la Operación">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Tipo de Proceso</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="proceso" placeholder="Escribe un tipo de proceso">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Tipo de Montaje</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="montaje" placeholder="Escribe un tipo de montaje">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Tipo de Lente</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="tlente" placeholder="Escribe un tipo de lente">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Tipo de Diseño</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="diseno" placeholder="Escribe un tipo de Diseño">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Defecto Óptico</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="defoptico" placeholder="Escribe un defecto óptico">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Defecto Estético</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="defestetico" placeholder="Escribe un defecto estético">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Aro</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="aro" placeholder="Escribe un defecto de aro">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Anti Reflejo</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputEmail3" name="ar" placeholder="Escribe defecto en anti reflejo">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <center><button type="submit" class="btn btn-primary">Agregar</button></center>
		    </div>
		  </div>
		</form>
    </div>

  	<!------------editar opciones-->
    <div role="tabpanel" class="tab-pane fade" id="editar">editar

    </div>

  	<!------------ocultar opciones-->
    <div role="tabpanel" class="tab-pane fade" id="ocultar">ocultar</div>
  </div>

</div>




    
    </div>
  </div>
</div>
<!--FIN del modal -->
<script type="text/javascript">
var cliente = [

<?php 	$consulta = "SELECT `Cliente` FROM `clientes` where status = 1 ORDER BY `Cliente` ASC";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
         echo "'$fila[0]',";
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
} ?>


];

$(function() {
  $("#cliente").autocomplete({
    source:[cliente]
  }); 
});

</script>

	<a href="php/cerrar_sesion.php"><button type="button" class="btn btn-danger" id="cerrar" >Cerrar Sesión</button></a>
</body>
<!-- autocomplete -->
	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/indicaciones.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</html>