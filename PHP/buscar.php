<?php 
session_start();
$buscardor=$_POST['docord'];

include("conn.php");
 ?>

 <div class="table-responsive" id="dvData">
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
  		<th>Observación</th> 
  	</tr>
  </thead>
  	<tbody class="busqueda">
 <?php 
		$consulta = "SELECT 
	documentos.tipo,quejas.queja, documentos.documento,usuarios.nombre, personas.persona, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, observacion
					FROM 
						datospersonas
                        LEFT JOIN operaciones ON datospersonas.idoperacion=operaciones.id
                        LEFT JOIN quejas ON datospersonas.idqueja=quejas.id
                        LEFT JOIN disenos ON datospersonas.iddisenos=disenos.id
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
						(datospersonas.documento=documentos.documento) AND (datospersonas.documento=documentos.documento) AND (documentos.documento='$buscardor' OR documentos.orden='$buscardor')
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
					<td>$fila[8]</td><!-- <th>diseños</th> -->
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
					<td>$fila[19]</td><!-- <th>Observación</th> -->
				</tr>";
				echo "<script>var obse='".$fila[19]."'</script>";
		    }
			/* liberar el conjunto de resultados */
		    $resultado->close();
		}
	 ?>
	 <?php 
		$consulta = "SELECT 
	documentos.tipo,quejas.queja, documentos.documento,usuarios.nombre, maquinas.maquina, personas.persona, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, observacion
					FROM 
						datosmaquina
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
						(datosmaquina.documento=documentos.documento) AND (documentos.documento='$buscardor' OR documentos.orden='$buscardor')
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
					<td>$fila[6]</td><!-- <th>operaciones</th> -->
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
					<td class='osb'>$fila[20]</td> 	<!-- <th>Observación</th> -->
				</tr>";
		    }
			/* liberar el conjunto de resultados */
		    $resultado->close();
		}
	 ?>
<?php 
$consulta = "SELECT 
	documentos.tipo,quejas.queja, documentos.documento,  usuarios.nombre, materiales.material, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, observacion
			FROM 
				datosmaterial
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
				(datosmaterial.documento=documentos.documento) AND (documentos.documento='$buscardor' OR documentos.orden='$buscardor')
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
			<td>$fila[5]</td><!-- <th>operaciones</th> -->
			<td>$fila[6]</td> <!-- <th>Proceso</th> -->
			<td>$fila[7]</td> <!-- <th>tipo lentes</th> -->
			<td>$fila[8]</td> <!-- <th>diseños</th> -->
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
			<td class='osb'>$fila[19]</td> 	<!-- <th>Observación</th> -->
		</tr>";
    }
	/* liberar el conjunto de resultados */
    $resultado->close();
}
?>
<?php 
	$consulta = "SELECT 
		documentos.tipo, quejas.queja, documentos.documento,usuarios.nombre, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto, defestetico.defecto,aros.aro, antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, Observacion
				FROM 
					datossoftware
                    LEFT JOIN operaciones ON datossoftware.idoperacion=operaciones.id
					LEFT JOIN disenos ON datossoftware.iddisenos=disenos.id
					LEFT JOIN quejas ON datossoftware.idqueja=quejas.id
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
					(datossoftware.documento=documentos.documento) AND (documentos.documento='$buscardor' OR documentos.orden='$buscardor')
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
				<td>$fila[4]</td><!-- <th>operaciones</th> -->
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
				<td>$fila[18]</td> 	<!-- <th>Observación</th> -->
			</tr>";
	    }
		/* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
  </tbody>
  </table>
  <?php 
$consulta = "SELECT usuarios.nombre,`fecha`,`hora`,`comentario` FROM `anuladas`,usuarios WHERE anuladas.usuario=usuarios.codigo AND documento=$buscardor";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
         echo '<p class="bg-info" style="padding:10px;">Anulada por <b>'.$fila[0].'</b> el día '.$fila[1].' a las '.$fila[2].' por motivo de: <b style="color:red">'.$fila[3].'</b></p>';
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}
 ?>
  
</div>
<?php 
	$consulta = "SELECT count(`documento`) FROM `documentos` WHERE `documento` = '$buscardor'  limit 1";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
			if ($fila[0]=='1') {
				$_SESSION['buscar']=$buscardor;
				?><a href="php/imprimir.php" target="_blank" onclick="window.open(this.href, this.target, 'width=300,height=400'); return false;"><input class="btn btn-default" type="button" value="Reimprimir"></a><?php 
				?>
<!------------------------------ modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg1">Anular</button>

				<div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <h3 style="color:red;">Anular Perdida <?php echo"$buscardor"; ?></h3>
				      	<button class="btn btn-primary" id="veer">Anular</button>
				      <div id="veeer"></div>
				      <form id="perr">
				      	<label>Motivo de anulación:</label><br>
				      	<textarea name="observation" id="anulobs" style="min-width: 500px;"></textarea>
				      </form>
				    </div>
				  </div>
				</div>
			<?php }}} ?>