
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

	if ($resultado = $con->query("SELECT COUNT(documentos.documento) FROM datosmaterial,documentos WHERE (datosmaterial.documento=documentos.documento) AND ((documentos.fecha >= '$dia1') AND (documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1') AND (documentos.hora <= '$hora2') AND (documentos.cantidad>0))")) {
	    $tdatper = $resultado->fetch_row();
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}

	if ($tdatper[0]!=0) {
 ?>
<body>

	  <h2><u>Datos del Material</u></h2>
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
					$consulta = "SELECT DISTINCT(`idmaterial`),material, COUNT(`idmaterial`) as cont  FROM datosmaterial, materiales, documentos where (datosmaterial.idmaterial = materiales.id)AND(datosmaterial.documento=documentos.documento)AND((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2'))AND((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2')AND (documentos.cantidad>0))   GROUP BY idmaterial ORDER BY cont DESC";
					if ($resultado = $con->query($consulta)) {
					    while ($fila = $resultado->fetch_row()) {
					    	$porcentaje=(($fila[2]*100)/$tdatper[0]);
					         echo "<li><div  data-percentage='".substr($porcentaje, 0, 5)."' class='bar' style='background:hsl(177, ".$porcentaje."%, 50%);' id='detal'></div><span>$fila[1]<br>$fila[2] </span></li>";
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
				<li> Los 3 materiales que han tenido más perdidas son: 
		  		<?php 
					$consulta = "SELECT 
						DISTINCT(`idmaterial`),material, COUNT(`idmaterial`) AS conteo FROM datosmaterial, materiales, documentos 
					where 
						(datosmaterial.idmaterial =materiales.id) AND (datosmaterial.documento=documentos.documento) AND ((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2') AND (documentos.cantidad>0) )
					GROUP BY 
						idmaterial 
					ORDER BY 
					conteo DESC LIMIT 0,3";
					if ($resultado = $con->query($consulta)) {
					    while ($fila = $resultado->fetch_row()) {
					    	$porcentaje=(($fila[2]*100)/$tdatper[0]);
					    	echo "<strong>$fila[1] con $fila[2] perdidas, </strong>";
					    	@$suma+=$fila[2];
					    }
					    $porcentmayorind= $suma*100/$tdatper[0];
					    echo "Esto representa un <strong>".substr($porcentmayorind, 0, 5)."%</strong> del total. ";
						/* liberar el conjunto de resultados */
					    $resultado->close();
					}
				?>
				</li>
				<li>El total de pérdidas hechas en materiales y en el rango seleccionado es de <strong style="color:red"><?php echo "$tdatper[0]"; ?></strong></li>
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
<h2><u>Pareto</u></h2>
<table class="table table-bordered">
	<tr>
		<th>Material</th>
		<th>Cantidad</th>
		<th>Porcentaje</th>
		<th>Porcentaje Acumulado</th>
	</tr>
	<?php 
		$consulta = "SELECT 
	DISTINCT(`idmaterial`),material, COUNT(`idmaterial`) as cont, (COUNT(`idmaterial`)*100/$tdatper[0]) 
FROM 
	datosmaterial, materiales, documentos 
where 
	(datosmaterial.idmaterial = materiales.id) AND (datosmaterial.documento=documentos.documento) AND ((documentos.fecha>='$dia1')AND(documentos.fecha<='$dia2')) AND ((documentos.hora >= '$hora1')AND(documentos.hora<='$hora2') AND (documentos.cantidad>0) ) 
GROUP BY idmaterial ORDER BY cont DESC";
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
</table>
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
  		<th>Material</th>
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
  		<th>observación</th>
  	</tr>
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
					<td>$fila[0]</td> <!-- tipo -->
					<td>$fila[1]</td> <!-- queja -->
					<td>$fila[2]</td> <!-- documento -->
					<td>$fila[3]</td> <!-- usuario -->
					<td>$fila[4]</td> <!-- material -->
					<td>$fila[5]</td> <!-- operación -->
					<td>$fila[6]</td> <!-- proceso -->
					<td>$fila[7]</td> <!-- tlente -->
					<td>$fila[8]</td> <!-- tdiseno -->
					<td>$fila[9]</td> <!-- montaje -->
					<td>$fila[10]</td> <!-- plente -->
					<td>$fila[11]</td> <!-- pcabezal -->
					<td>$fila[12]</td> <!-- defoptico -->
					<td>$fila[13]</td> <!-- defestetico -->
					<td>$fila[14]</td> <!-- aro -->
					<td>$fila[15]</td> <!-- ar -->
					<td>$fila[16]</td> <!-- orden -->
					<td>$fila[17]</td> <!-- fecha -->
					<td>$fila[18]</td> <!-- hora -->
					<td>&nbsp;$fila[19]</td> <!-- Cod lente -->
					<td>$fila[20]</td> <!-- Nombre lente -->
					<td>$fila[21]</td> <!-- observacion -->
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
		<input type="hidden" id="datos_material" name="datos_material" />
	</form>
 
    <script>
		$(document).ready(function() {
			$("#botonExcel").click(function(event) {
				$("#datos_material").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
				$("#FormularioExportacion").submit();
			});
		});
    </script>

<script type="text/javascript" src="js/tablas.js"></script>
<script  src="js/index.js"></script>
</body>
<?php 
	}else{		echo "<br><br><br> <div class='alert alert-warning' role='alert'>No hay resultados para mostrar, intenta otro rango de fechas u horas</div>
						<br><div class='alert alert-info' role='alert'>¡¡Verifica que el &quot;<u>Día Desde</u>&quot; no sea mayor al &quot;<u>Hasta</u>&quot; y lo mismo con el rango de horas!!</div>";}
}else{
	echo "<br><br><br> <div class='alert alert-danger' role='alert'>Por favor asegurese de ingresar todos los valores en el rango de días y horas para ver los datos</div>";
}

 ?>