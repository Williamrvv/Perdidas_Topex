
<?php 
include("conn.php");

	$dia1=$_POST['dia1'];
	$dia2=$_POST['dia2'];
	$hora1=$_POST['hora1'];
	$hora2=$_POST['hora2'];

	// $dia1='2017-10-16';
	// $dia2='2017-10-25';
	// $hora1='07:00';
	// $hora2='20:0';

if ($dia1!=""&&$dia2!=""&&$hora1!=""&&$hora2!="") {

	if ($resultado = $con->query("SELECT SUM(documentos.cantidad) FROM documentos WHERE ((documentos.fecha >= '$dia1') AND (documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1') AND (documentos.hora <= '$hora2'))")) {
	    $tdatper = $resultado->fetch_row();
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}

	if ($tdatper[0]!=0) {
 ?>

<body>

	  <h2><u>Datos Generales</u></h2>
	  <div class="row">
	  <div class="col-md-6">
		  <div id="chart">
			  <ul id="numbers">
			    <li><span>100%</span></li>
			    <li><span>90%</span></li>
			    <li><span>80%</span></li>
			    <li><span>70%</span></li>
			    <li><span>60%</span></li>
			    <li><span>50%</span></li>
			    <li><span>40%</span></li>
			    <li><span>30%</span></li>
			    <li><span>20%</span></li>
			    <li><span>10%</span></li>
			    <li><span>0%</span></li>
			  </ul>
		  
			  <ul id="bars">

				<?php 
					$consulta = "
					SELECT 
					COUNT(*),
				    (SELECT COUNT(documentos.documento) FROM documentos, datospersonas WHERE datospersonas.documento=documentos.documento AND ((documentos.fecha>='$dia1' and documentos.fecha<='$dia2')AND(documentos.hora>='$hora1')AND(documentos.hora<='$hora2')) AND (documentos.cantidad>0) AND (documentos.tipo!='garantia') ) AS personas,
					(SELECT COUNT(documentos.documento) FROM documentos, datosmaquina WHERE datosmaquina.documento=documentos.documento AND ((documentos.fecha>='$dia1' and documentos.fecha <='$dia2')AND(documentos.hora>='$hora1')AND(documentos.hora<='$hora2')) AND (documentos.cantidad>0) ) AS maquinas,
				    (SELECT COUNT(documentos.documento) FROM documentos, datosmaterial WHERE datosmaterial.documento=documentos.documento AND ((documentos.fecha>='$dia1' and documentos.fecha<='$dia2')AND(documentos.hora>='$hora1')AND(documentos.hora<='$hora2')) AND (documentos.cantidad>0) ) AS materiales,
					(SELECT COUNT(documentos.documento) FROM documentos, datossoftware WHERE datossoftware.documento=documentos.documento AND ((documentos.fecha>='$dia1' and documentos.fecha<='$dia2')AND(documentos.hora>='$hora1')AND(documentos.hora<='$hora2')) AND (documentos.cantidad>0) ) AS software,
					(SELECT SUM(documentos.`cantidad`) FROM documentos WHERE ((documentos.fecha>='$dia1' and documentos.fecha<='$dia2')AND(documentos.hora>='$hora1')AND(documentos.hora<='$hora2')) AND (documentos.cantidad>0) AND (documentos.tipo='garantia') ) AS garantias
				FROM 
					documentos
				WHERE
					((documentos.fecha>='$dia1' and documentos.fecha<='$dia2')AND(documentos.hora>='$hora1')AND(documentos.hora<='$hora2'))
					";
					if ($resultado = $con->query($consulta)) {
					    while ($fila = $resultado->fetch_row()) {
					    	$porcpers=(($fila[1]*100)/$tdatper[0]);
					    	$porcmaq=(($fila[2]*100)/$tdatper[0]);
					    	$porcmat=(($fila[3]*100)/$tdatper[0]);
					    	$porcsof=(($fila[4]*100)/$tdatper[0]);
					    	$porcgar=(($fila[5]*100)/$tdatper[0]);
					         echo "<li><div  data-percentage='".substr($porcpers, 0, 5)."' class='bar' style='background:hsl(14, ".$porcpers."%, 50%);' id='detal'></div><span>Personal<br>$fila[1] </span></li>";
					         echo "<li><div  data-percentage='".substr($porcmaq, 0, 5)."' class='bar' style='background:hsl(14, ".$porcmaq."%, 50%);' id='detal'></div><span>Maquinas<br>$fila[2] </span></li>";
					         echo "<li><div  data-percentage='".substr($porcmat, 0, 5)."' class='bar' style='background:hsl(14, ".$porcmat."%, 50%);' id='detal'></div><span>Materiales<br>$fila[3] </span></li>";
					         echo "<li><div  data-percentage='".substr($porcsof, 0, 5)."' class='bar' style='background:hsl(14, ".$porcsof."%, 50%);' id='detal'></div><span>Software<br>$fila[4] </span></li>";
					         echo "<li><div  data-percentage='".substr($porcgar, 0, 5)."' class='bar' style='background:hsl(14, ".$porcgar."%, 50%);' id='detal'></div><span>Garantías<br>$fila[5] </span></li>";
					    }
						/* liberar el conjunto de resultados */
					    $resultado->close();
					}
				 ?>

			  </ul>
			</div>
		</div><br><br>
		  <div class="col-md-6">
			<ul>
				<li>El total de pérdidas hechas en el rango seleccionado es de <strong style="color:red"><?php echo "$tdatper[0]"; ?></strong></li>
				<?php 
					$consulta = "SELECT COUNT(`documento`) FROM `documentos` WHERE (`fecha`>='$dia1' AND `fecha`<='$dia2') AND (`hora`>='$hora1' AND `hora`<='$hora2') AND (cantidad>0)";
						if ($resultado = $con->query($consulta)) {
						    while ($fila = $resultado->fetch_row()) {
						    	$porcgar=($fila[0]*100)/$tdatper[0];
						         echo "<li>El total de bandejas involucradas en las perdidas es de <strong style='color:red'>$fila[0]</strong> en el rango seleccionado</li>";
						    }
						    /* liberar el conjunto de resultados */
						    $resultado->close();
					}
				/*------------Contador de garantías-----------*/
						$consulta = "SELECT SUM(documentos.`cantidad`) FROM documentos WHERE ((documentos.fecha>='$dia1' and documentos.fecha<='$dia2')AND(documentos.hora>='$hora1')AND(documentos.hora<='$hora2')) AND (documentos.cantidad>0) AND (documentos.tipo='garantia') ";
						if ($resultado = $con->query($consulta)) {
						    while ($fila = $resultado->fetch_row()) {
						    	$porcgar=($fila[0]*100)/$tdatper[0];
						         echo "<li>El total en garantías es de: <strong class='text-danger'>$fila[0]</strong>, esto representa un <strong class='text-danger'>".substr($porcgar, 0, 5)."%</strong> de las perdidas en el rango seleccionado</li>";
						    }
						    /* liberar el conjunto de resultados */
						    $resultado->close();
						}
					?>
			</ul>
		  </div>
		  </div>
<br><br>


 <!-- modal ---------------------------------->
<div class="modal fade bs-example-modal-lgee" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lgee" role="document">
    <div class="modal-content">
    	muestra: <br>
    	<div id="detalles"></div>
    </div>
  </div>
</div>

<br><br>

<div><h2><u>Tabla de datos</u></h2> <label>Buscar en esta tabla: </label><input type="search" class="form-control"  placeholder="¿Qué buscas?" id="buscar"></div>
<div class="table-responsive" id="Exportar_a_Excel">
	<meta charset="utf-8">
  <table class="table table-bordered dvDatos" id="tabla-general">
  	<thead style="resize: horizontal;">
  	<tr>
	 	<th>Tipo</th> 
		<th>Queja</th> 
		<th>Documento</th> 
		<th>Registró</th> 
		<th>Persona</th> 
		<th>Maquina</th> 
		<th>Material</th> 
		<th>Software</th> 
		<th>Operación</th>
		<th>Proceso</th>
		<th>Tipo Lente</th>
		<th>Diseño</th> 
		<th>Tipo Montaje</th> 
		<th>Posición Lente</th> 
		<th>Posición Cabezal</th> 
		<th>Def. Óptico</th> 
		<th>Def. Estético</th> 
		<th>Def. Aro</th> 
		<th>Def. AR</th> 
		<th>N° Orden</th> 
		<th>Fecha</th> 
		<th>Hora</th> 
		<th>Cod Lente</th>
		<th>Nombre de Lente</th>
  		<th>Observación</th> 
  	</tr>
  </thead>
  	<tbody class="busqueda">
 <?php 
		$consulta = "SELECT 
	documentos.tipo,quejas.queja, documentos.documento,usuarios.nombre, personas.persona, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora,codlente,lentes.nombre, observacion
					FROM 
						datospersonas
                        LEFT JOIN lentes ON datospersonas.codlente=lentes.codigo
						LEFT JOIN operaciones ON datospersonas.idoperacion=operaciones.id
						LEFT JOIN disenos ON datospersonas.iddisenos=disenos.id
                        LEFT JOIN quejas ON datospersonas.idqueja=quejas.id
					    LEFT JOIN personas ON datospersonas.idpersona = personas.id
					    LEFT JOIN procesos ON datospersonas.idproceso=procesos.id 
                        LEFT JOIN tlentes ON datospersonas.idtlente=tlentes.id
					    LEFT JOIN montajes ON datospersonas.idmontaje=montajes.id 
					    LEFT JOIN plente ON datospersonas.idplente=plente.id 
					    LEFT JOIN pcabezal ON datospersonas.idpcabezal=pcabezal.id
					    LEFT JOIN defoptico ON datospersonas.iddefoptico = defoptico.id
					    LEFT JOIN defestetico ON datospersonas.iddefestetico = defestetico.id
					    LEFT JOIN aros ON datospersonas.idaro = aros.id
					    LEFT JOIN antireflejo ON datospersonas.idantireflejo = antireflejo.id,
					    documentos
                        INNER JOIN usuarios ON documentos.usuario=usuarios.codigo
					where 
						(datospersonas.documento=documentos.documento) AND (datospersonas.documento=documentos.documento) AND ((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2')) AND (documentos.cantidad>0)
					ORDER BY documentos.cont ASC";
		if ($resultado = $con->query($consulta)) {
		    while ($fila = $resultado->fetch_row()) {
				echo "
				<tr>
					<td>$fila[0]</td><!-- <th>Tipo</th> -->
					<td>$fila[1]</td><!-- <th>Queja</th> -->
					<td>$fila[2]</td><!-- <th>Documento</th> -->
					<td>$fila[3]</td><!-- <th>Registró</th> -->
					<td>$fila[4]</td><!-- <th>Persona</th> -->
					<td></td><!-- <th>Maquina</th> -->
					<td></td><!-- <th>Material</th> -->
					<td></td><!-- <th>Software</th> -->
					<td>$fila[5]</td><!-- <th>operaciones</th> -->
					<td>$fila[6]</td><!-- <th>Proceso</th> -->
					<td>$fila[7]</td><!-- <th>tlentes</th> -->
					<td>$fila[8]</td><!-- <th>Diseños</th> -->
					<td>$fila[9]</td><!-- <th>Tipo Montaje</th> -->
					<td>$fila[10]</td><!-- <th>Posición Lente</th> -->
					<td>$fila[11]</td><!-- <th>Posición Cabezal</th> -->
					<td>$fila[12]</td><!-- <th>Def. Óptico</th> -->
					<td>$fila[13]</td><!-- <th>Def. Estético</th> -->
					<td>$fila[14]</td><!-- <th>Def. Aro</th> -->
					<td>$fila[15]</td><!-- <th>Def. AR</th> -->
					<td>$fila[16]</td><!-- <th>N° Orden</th> -->
					<td>$fila[17]</td><!-- <th>Fecha</th> -->
					<td>$fila[18]</td><!-- <th>Hora</th> -->
					<td>&nbsp;$fila[19]</td><!-- <th>cod lente</th> -->
					<td>$fila[20]</td><!-- <th>Nombre de Lente</th> -->
					<td>$fila[21]</td><!-- <th>Observación</th> -->
				</tr>";
		    }
			/* liberar el conjunto de resultados */
		    $resultado->close();
		}
	 ?>
	 <?php 
		$consulta = "SELECT 
	documentos.tipo,quejas.queja, documentos.documento,usuarios.nombre, maquinas.maquina, personas.persona, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora,codlente,lentes.nombre, observacion
					FROM 
						datosmaquina
						LEFT JOIN lentes ON datosmaquina.codlente=lentes.codigo
						LEFT JOIN operaciones ON datosmaquina.idoperacion=operaciones.id
						LEFT JOIN disenos ON datosmaquina.iddisenos = disenos.id
						LEFT JOIN quejas ON datosmaquina.idqueja = quejas.id
					    LEFT JOIN maquinas ON datosmaquina.idmaquina = maquinas.id
					    LEFT JOIN personas ON datosmaquina.idpersona = personas.id
					    LEFT JOIN procesos ON datosmaquina.idproceso=procesos.id 
                        LEFT JOIN tlentes ON datosmaquina.idtlente=tlentes.id
					    LEFT JOIN montajes ON datosmaquina.idmontaje=montajes.id 
					    LEFT JOIN plente ON datosmaquina.idplente=plente.id 
					    LEFT JOIN pcabezal ON datosmaquina.idpcabezal=pcabezal.id
					    LEFT JOIN defoptico ON datosmaquina.iddefoptico = defoptico.id
					    LEFT JOIN defestetico ON datosmaquina.iddefestetico = defestetico.id
					    LEFT JOIN aros ON datosmaquina.idaro = aros.id
					    LEFT JOIN antireflejo ON datosmaquina.idantireflejo = antireflejo.id,
					    documentos
                        INNER JOIN usuarios ON documentos.usuario=usuarios.codigo
					where 
						(datosmaquina.documento=documentos.documento) AND (datosmaquina.documento=documentos.documento) AND ((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2'))  AND (documentos.cantidad>0)
					ORDER BY documentos.cont ASC";
		if ($resultado = $con->query($consulta)) {
		    while ($fila = $resultado->fetch_row()) {
				echo "
				<tr>
					<td>$fila[0]</td> <!-- <th>Tipo</th> -->
					<td>$fila[1]</td> <!-- <th>Queja</th> -->
					<td>$fila[2]</td> <!-- <th>Documento</th> -->
					<td>$fila[3]</td> <!-- <th>Registró</th> -->
					<td>$fila[5]</td> <!-- <th>Persona</th> -->
					<td>$fila[4]</td> <!-- <th>Maquina</th> -->
					<td></td> <!-- <th>Material</th> -->
					<td></td> <!-- <th>Software</th> -->
					<td>$fila[6]</td> <!-- <th>operacion</th> -->
					<td>$fila[7]</td> <!-- <th>Proceso</th> -->
					<td>$fila[8]</td> <!-- <th>tipo lentes</th> -->
					<td>$fila[9]</td> <!-- <th>diseños</th> -->
					<td>$fila[10]</td> <!-- <th>Tipo Montaje</th> -->
					<td>$fila[11]</td> <!-- <th>Posición Lente</th> -->
					<td>$fila[12]</td> <!-- <th>Posición Cabezal</th> -->
					<td>$fila[13]</td> <!-- <th>Def. Óptico</th> -->
					<td>$fila[14]</td> <!-- <th>Def. Estético</th> -->
					<td>$fila[15]</td> <!-- <th>Def. Aro</th> -->
					<td>$fila[16]</td> <!-- <th>Def. AR</th> -->
					<td>$fila[17]</td> <!-- <th>N° Orden</th> -->
					<td>$fila[18]</td> <!-- <th>Fecha</th> -->
					<td>$fila[19]</td> <!-- <th>Hora</th> -->
					<td>&nbsp;$fila[20]</td><!-- <th>cod lente</th> -->
					<td>$fila[21]</td><!-- <th>Nombre de Lente</th> -->
					<td>$fila[22]</td> 	<!-- <th>Observación</th> -->
				</tr>";
		    }
			/* liberar el conjunto de resultados */
		    $resultado->close();
		}
	 ?>
<?php 
$consulta = "SELECT 
	documentos.tipo,quejas.queja, documentos.documento,  usuarios.nombre, materiales.material, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, codlente,lentes.nombre,observacion
			FROM 
				datosmaterial
				LEFT JOIN lentes ON datosmaterial.codlente=lentes.codigo
				LEFT JOIN operaciones ON datosmaterial.idoperacion=operaciones.id
				LEFT join disenos ON datosmaterial.iddisenos =disenos.id
				LEFT join quejas ON datosmaterial.idqueja =quejas.id
			    LEFT JOIN materiales ON datosmaterial.idmaterial = materiales.id
			    LEFT JOIN procesos ON datosmaterial.idproceso=procesos.id 
                LEFT JOIN tlentes ON datosmaterial.idtlente=tlentes.id
			    LEFT JOIN montajes ON datosmaterial.idmontaje=montajes.id 
			    LEFT JOIN plente ON datosmaterial.idplente=plente.id 
			    LEFT JOIN pcabezal ON datosmaterial.idpcabezal=pcabezal.id
			    LEFT JOIN defoptico ON datosmaterial.iddefoptico = defoptico.id
			    LEFT JOIN defestetico ON datosmaterial.iddefestetico = defestetico.id
			    LEFT JOIN aros ON datosmaterial.idaro = aros.id
			    LEFT JOIN antireflejo ON datosmaterial.idantireflejo = antireflejo.id,
			    documentos
                INNER JOIN usuarios ON documentos.usuario=usuarios.codigo
			where 
				(datosmaterial.documento=documentos.documento) AND (datosmaterial.documento=documentos.documento) AND ((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2'))  AND (documentos.cantidad>0)
			ORDER BY documentos.cont ASC";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
		echo "
		<tr>
			<td>$fila[0]</td> <!-- <th>Tipo</th> -->
			<td>$fila[1]</td> <!-- <th>Queja</th> -->
			<td>$fila[2]</td> <!-- <th>Documento</th> -->
			<td>$fila[3]</td> <!-- <th>Registró</th> -->
			<td></td> <!-- <th>Persona</th> -->
			<td></td> <!-- <th>Maquina</th> -->
			<td>$fila[4]</td> <!-- <th>Material</th> -->
			<td></td> <!-- <th>Software</th> -->
			<td>$fila[5]</td> <!-- <th>Operaciones</th> -->
			<td>$fila[6]</td> <!-- <th>Proceso</th> -->
			<td>$fila[7]</td> <!-- <th>tipo lentes</th> -->
			<td>$fila[8]</td> <!-- <th>disenos</th> -->
			<td>$fila[9]</td> <!-- <th>Tipo Montaje</th> -->
			<td>$fila[10]</td> <!-- <th>Posición Lente</th> -->
			<td>$fila[11]</td> <!-- <th>Posición Cabezal</th> -->
			<td>$fila[12]</td> <!-- <th>Def. Óptico</th> -->
			<td>$fila[13]</td> <!-- <th>Def. Estético</th> -->
			<td>$fila[14]</td> <!-- <th>Def. Aro</th> -->
			<td>$fila[15]</td> <!-- <th>Def. AR</th> -->
			<td>$fila[16]</td> <!-- <th>N° Orden</th> -->
			<td>$fila[17]</td> <!-- <th>Fecha</th> -->
			<td>$fila[18]</td> <!-- <th>Hora</th> -->
			<td>&nbsp;$fila[19]</td><!-- <th>cod lente</th> -->
			<td>$fila[20]</td><!-- <th>Nombre de Lente</th> -->
			<td>$fila[21]</td> 	<!-- <th>Observación</th> -->
		</tr>";
    }
	/* liberar el conjunto de resultados */
    $resultado->close();
}
?>
<?php 
	$consulta = "SELECT 
		documentos.tipo, quejas.queja, documentos.documento,usuarios.nombre, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto, defestetico.defecto,aros.aro, antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora,codlente,lentes.nombre, Observacion
				FROM 
					datossoftware
					LEFT JOIN lentes ON datossoftware.codlente=lentes.codigo
					LEFT JOIN operaciones ON datossoftware.idoperacion=operaciones.id
					LEFT JOIN quejas ON datossoftware.idqueja=quejas.id
					LEFT JOIN disenos ON datossoftware.iddisenos=disenos.id
				    LEFT JOIN procesos ON datossoftware.idproceso=procesos.id 
                    LEFT JOIN tlentes ON datossoftware.idtlente=tlentes.id
				    LEFT JOIN montajes ON datossoftware.idmontaje=montajes.id 
				    LEFT JOIN plente ON datossoftware.idplente=plente.id 
				    LEFT JOIN pcabezal ON datossoftware.idpcabezal=pcabezal.id
				    LEFT JOIN defoptico ON datossoftware.iddefoptico = defoptico.id
				    LEFT JOIN defestetico ON datossoftware.iddefestetico = defestetico.id
				    LEFT JOIN aros ON datossoftware.idaro = aros.id
				    LEFT JOIN antireflejo ON datossoftware.idantireflejo = antireflejo.id,
				    documentos
                    INNER JOIN usuarios ON documentos.usuario=usuarios.codigo
				where 
					(datossoftware.documento=documentos.documento) AND (datossoftware.documento=documentos.documento) AND ((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2'))  AND (documentos.cantidad>0)
				ORDER BY documentos.cont ASC";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
			echo "
			<tr>
				<td>$fila[0]</td> <!-- <th>Tipo</th> -->
				<td>$fila[1]</td> <!-- <th>Queja</th> -->
				<td>$fila[2]</td> <!-- <th>Documento</th> -->
				<td>$fila[3]</td> <!-- <th>Registró</th> -->
				<td></td> <!-- <th>Persona</th> -->
				<td></td> <!-- <th>Maquina</th> -->
				<td></td> <!-- <th>Material</th> -->
				<td>Software</td> <!-- <th>Software</th> -->
				<td>$fila[4]</td> <!-- <th>operaciones</th> -->
				<td>$fila[5]</td> <!-- <th>Proceso</th> -->
				<td>$fila[6]</td> <!-- <th>tipo lentes</th> -->
				<td>$fila[7]</td> <!-- <th>Diseños</th> -->
				<td>$fila[8]</td> <!-- <th>Tipo Montaje</th> -->
				<td>$fila[9]</td> <!-- <th>Posición Lente</th> -->
				<td>$fila[10]</td> <!-- <th>Posición Cabezal</th> -->
				<td>$fila[11]</td> <!-- <th>Def. Óptico</th> -->
				<td>$fila[12]</td> <!-- <th>Def. Estético</th> -->
				<td>$fila[13]</td> <!-- <th>Def. Aro</th> -->
				<td>$fila[14]</td> <!-- <th>Def. AR</th> -->
				<td>$fila[15]</td> <!-- <th>N° Orden</th> -->
				<td>$fila[16]</td> <!-- <th>Fecha</th> -->
				<td>$fila[17]</td> <!-- <th>Hora</th> -->
				<td>&nbsp;$fila[18]</td><!-- <th>cod lente</th> -->
				<td>$fila[19]</td><!-- <th>Nombre de Lente</th> -->
				<td>$fila[20]</td> 	<!-- <th>Observación</th> -->
			</tr>";
	    }
		/* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
  </tbody>
  </table>
</div>

	<form action="php/ficheroexcel.php" method="post" target="_blank" id="FormularioExportacion">
		<button type="button" class="btn btn-success" id="botonExcel"><i class="far fa-file-excel" style="font-size: 30px;"></i><p> Exportar a Excel</p> </button>
		<input type="hidden" id="datos_generales" name="datos_generales" />
	</form>
 
    <script>
		$(document).ready(function() {
			$("#botonExcel").click(function(event) {
				$("#datos_generales").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
				$("#FormularioExportacion").submit();
			});
		});
    </script>


    <script  src="js/index.js"></script>
</body>
<script type="text/javascript" src="js/tablas.js"></script>
<?php 
	}else{		echo "<br><br><br> <div class='alert alert-warning' role='alert'>No hay resultados para mostrar, intenta otro rango de fechas u horas</div>
						<br><div class='alert alert-info' role='alert'>¡¡Verifica que el &quot;<u>Día Desde</u>&quot; no sea mayor al &quot;<u>Hasta</u>&quot; y lo mismo con el rango de horas!!</div>";}
}else{
	echo "<br><br><br> <div class='alert alert-danger' role='alert'>Por favor asegurese de ingresar todos los valores en el rango de días y horas para ver los datos</div>";
}

 ?>