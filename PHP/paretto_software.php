
<?php 
include("conn.php");

	$dia1=$_POST['dia1'];
	$dia2=$_POST['dia2'];
	$hora1=$_POST['hora1'];
	$hora2=$_POST['hora2'];

	// $dia1='2017-10-16';
	// $dia2='2017-10-25';
	// $hora1='07:00';
	// $hora2='20:00';

if ($dia1!=""&&$dia2!=""&&$hora1!=""&&$hora2!="") {

	if ($resultado = $con->query("SELECT COUNT(datossoftware.id) FROM datossoftware, documentos where (datossoftware.documento=documentos.documento)AND((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2'))AND((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2') AND (documentos.cantidad>0))")) {
	    $tdatper = $resultado->fetch_row();
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}

	if ($tdatper[0]!=0) {
 ?>
<body>

	  <h2><u>Datos del Software</u></h2>
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
					$consulta = "SELECT COUNT(documento) FROM `documentos` WHERE ((documentos.fecha >= '$dia1') AND (documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1') AND (documentos.hora <= '$hora2') AND (documentos.cantidad>0))";
					if ($resultado = $con->query($consulta)) {
					    while ($fila = $resultado->fetch_row()) {
					    	$porcentaje=(($tdatper[0]*100)/$fila[0]);
					         echo "<li><div  data-percentage='".substr($porcentaje, 0, 5)."' class='bar' style='background:hsl(177, ".$porcentaje."%, 50%);' id='detal'></div><span>Software<br>$tdatper[0] </span></li>";
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
				<li> Las pérdidas hechas en Software en el rango seleccionado representan un  
		  		<?php 
					$consulta = "SELECT SUM(documentos.cantidad) FROM `documentos` WHERE ((documentos.fecha >= '$dia1') AND (documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1') AND (documentos.hora <= '$hora2') AND (documentos.cantidad>0))";
					if ($resultado = $con->query($consulta)) {
					    while ($fila = $resultado->fetch_row()) {
					    	$porcentaje=(($tdatper[0]*100)/$fila[0]);
					    	echo "<strong>".substr($porcentaje,0,5)."%, </strong>";
					    }
					}
				?>
				</li>
				<li>El total de pérdidas hechas en software y en el rango seleccionado es de <strong style="color:red"><?php echo "$tdatper[0]"; ?></strong></li>
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


<!-- 
<br><br>
<h2><u>Pareto</u></h2>
<table class="table table-bordered">
	<tr>
		<th>Persona</th>
		<th>Cantidad</th>
		<th>Porcentaje</th>
		<th>Porcentaje Acumulado</th>
	</tr>
	<?php 
		$consulta = "SELECT 
				DISTINCT(`idpersona`),persona, COUNT(`idpersona`) as cont, (COUNT(`idpersona`)*100/$tdatper[0]) 
			FROM 
				datospersonas, personas, documentos 
			where 
				(datospersonas.idpersona = personas.id) AND (datospersonas.documento=documentos.documento) AND ((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2') AND (documentos.cantidad>0)) 
			GROUP BY idpersona ORDER BY cont DESC";
		if ($resultado = $con->query($consulta)) {
			$index=1;
		    while ($fila = $resultado->fetch_row()) {
		    	@$acum+=$fila[3];
		      echo "
		    <tr>
				<td>$fila[1]</td>
				<td>$fila[2]</td>
				<td>$fila[3]%</td>
				<td>$acum%</td>
			";
		    }
			/* liberar el conjunto de resultados */
		    $resultado->close();
		}
	 ?>
</table> -->
<br><br>

<h2><u>Tabla de datos</u></h2>
<div class="table-responsive" id="Exportar_a_Excel">
	<meta charset="utf-8">
  <table class="table table-bordered dvDatos" >
  	<tr>
  		<th>Tipo</th>
  		<th>Queja</th>
  		<th>Documento</th>
  		<th>Registró</th>
  		<th>Operación</th>
  		<th>Proceso</th>
  		<th>Tipo Lente</th>
  		<th>Tipo de Diseño</th>
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
					<td>$fila[0]</td>
					<td>$fila[1]</td>
					<td>$fila[2]</td>
					<td>$fila[3]</td>
					<td>$fila[4]</td>
					<td>$fila[5]</td>
					<td>$fila[6]</td>
					<td>$fila[7]</td>
					<td>$fila[8]</td>
					<td>$fila[9]</td>
					<td>$fila[10]</td>
					<td>$fila[11]</td>
					<td>$fila[12]</td>
					<td>$fila[13]</td>
					<td>$fila[14]</td>
					<td>$fila[15]</td>
					<td>$fila[16]</td>
					<td>$fila[17]</td>
					<td>&nbsp;$fila[18]</td>
					<td>$fila[19]</td>
					<td>$fila[20]</td>
				</tr>";
		    }
			/* liberar el conjunto de resultados */
		    $resultado->close();
		}
	 ?>
  </table>
</div>

	<form action="php/ficheroexcel.php" method="post" target="_blank" id="FormularioExportacion">
		<button type="button" class="btn btn-success" id="botonExcel"><i class="far fa-file-excel" style="font-size: 30px;"></i><p> Exportar a Excel</p> </button>
		<input type="hidden" id="datos_software" name="datos_software" />
	</form>
 
    <script>
		$(document).ready(function() {
			$("#botonExcel").click(function(event) {
				$("#datos_software").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
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