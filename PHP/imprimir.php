<?php 
session_start();
	$buscador= $_SESSION['buscar'];
	include("conn.php");
 ?>
<HTML> 
<HEAD> 
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../jquery-barcode.js"></script>  
<html lang="es">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<SCRIPT language="javascript"> 
function imprimir() 
{ if ((navigator.appName == "Netscape")) { window.print() ; 
} 
else 
{ var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>'; 
document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, -1); WebBrowser1.outerHTML = ""; 
} 
} 

</SCRIPT> 
</HEAD> 
<style type="text/css">
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{padding: 2px !important;}
	hr{color: #0056b2;}
	table{font-size: 10px;}
	img{float: left;width: 150px;}
	.bg-info{margin-top: -10px !important}
	#divmaterial{margin-top: -30px;margin-bottom: 40px;}
	#divsoftware{margin-top:-40px;margin-bottom: 60px;}
	footer{    bottom: 5px;position: absolute;width: 100%;}
</style>

<BODY onload="imprimir();redirect();" style="margin: 10px;"> 
<div><img src="../logo.png"></div>
<center>Formulario <br><div id="bcobjetivo"></div></center>
<script type="text/javascript">	 </script>
<hr/><center><b>Información del lente</b></center>
	<?php 
if (isset($personaw[0])) {
	
}
		$consulta = "SELECT 
		documentos.tipo,quejas.queja, documentos.documento,usuarios.nombre, personas.persona, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, observacion, clientes.Cliente
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
		    LEFT JOIN antireflejo ON datospersonas.idantireflejo = antireflejo.id
            LEFT JOIN clientes ON datospersonas.idcliente = clientes.id,
		    documentos
            INNER JOIN usuarios ON documentos.usuario=usuarios.codigo
		where 
			(datospersonas.documento=documentos.documento) AND (datospersonas.documento=documentos.documento) AND (documentos.documento='$buscador')
		ORDER BY documentos.cont ASC
        LIMIT 1";
			if ($resultado = $con->query($consulta)) {
			    while ($fila = $resultado->fetch_row()) {
			    	$firmapersona=$fila[2];
			    ?> 
				<table class="table table-condensed tblpersona">
					<meta charset="utf-8">
					<div style="float:right;">Fecha: <?php echo "$fila[17]"; ?> <br>Hora: <?php echo "$fila[18]"; ?> </div>
					<div style="float: left;">Registrado por: <?php echo "$fila[3]"; ?></div>
					<tr>
						<th>Tipo de proceso:</th>
						<td> <?php echo "$fila[6]"; ?></td>
					</tr>
					<tr>
						<th>Tipo de lente:</th>
						<td> <?php echo "$fila[7]"; ?></td>
					</tr>
					<tr>
						<th>Tipo de diseño:</th>
						<td> <?php echo "$fila[8]"; ?></td>
					</tr>
					<tr>
						<th>Tipo de montaje:</th>
						<td><?php echo "$fila[9]"; ?></td>
					</tr>
					<tr>
						<th>Posición de lente:</th>
						<td><?php echo "$fila[10]"; ?></td>
					</tr>
					<tr>
						<th>Posición de cabezal:</th>
						<td><?php echo "$fila[11]"; ?></td>
					</tr>
					<tr>
						<th>Defecto óptico:</th>
						<td><?php echo "$fila[12]"; ?></td>
					</tr>
					<tr>
						<th>Defecto estético:</th>
						<td><?php echo "$fila[13]"; ?></td>
					</tr>
					<tr>
						<th>Defecto en aro:</th>
						<td><?php echo "$fila[14]"; ?></td>
					</tr>
					<tr>
						<th>Defecto en antireflejo:</th>
						<td><?php echo "$fila[15]"; ?></td>
					</tr>
					<tr>
				</table>
<hr/><center><b>Abastecimiento</b></center>
<table class="table table-condensed tblpersona">
					<tr>
						<th>Orden de lab / Cliente:</th>
						<td> <?php echo "$fila[16] / $fila[20]"; ?></td>
					</tr>
					<tr>
						<th>Tipo de perdida:</th>
						<td> <?php echo "$fila[0]"; echo " / $fila[1]"; ?></td>
					</tr>
					<tr>
						<th>Origen:</th>
						<td>Persona<?php echo " -> $fila[4]"; ?></td>
					</tr>
					<tr>
						<th>Operación:</th>
						<td> <?php echo "$fila[5]"; ?></td>
					</tr>
					<tr>
						<th>Defecto óptico:</th>
						<td><?php echo "$fila[12]"; ?></td>
					</tr>
					<tr>
						<th>Defecto estético:</th>
						<td><?php echo "$fila[13]"; ?></td>
					</tr>
					<tr>
						<th>Observación:</th>
						<td><?php echo "$fila[19]"; ?></td>
					</tr>
			    <?php 
			    }
			}
			$consulta = "SELECT datospersonas.codlente,lentes.nombre, 
						CASE
							wHEN idplente = 1 THEN 'Lente Izquierdo'
							WHEN idplente = 2 THEN 'Lente Derecho'
							WHEN idplente = 3 THEN 'Ambos Lentes'
						END plente
						FROM datospersonas, lentes WHERE datospersonas.codlente = lentes.codigo AND `documento`= '$buscador'";
						$i=0;
				if ($resultado = $con->query($consulta)) {
				    while ($fila = $resultado->fetch_row()) {
				    	$i++;
				         echo "	<tr>
									<th>$fila[2]</th>
									<td>$fila[1] <br> <div id='cod$i'></div>  </td>
								</tr>
								<script>$('#cod$i').barcode('$fila[0]', 'code128',{barWidth:2, barHeight:20});</script>";
				    }
				    /* liberar el conjunto de resultados */
				    $resultado->close();
				}
		 ?>

	</table>

<?php 
		$consulta = "SELECT 
	documentos.tipo,quejas.queja, documentos.documento,usuarios.nombre, maquinas.maquina, personas.persona, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, observacion, clientes.Cliente
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
					    LEFT JOIN antireflejo ON datosmaquina.idantireflejo = antireflejo.id
					    LEFT JOIN clientes ON datosmaquina.idcliente = clientes.id,
					    documentos
                        INNER JOIN usuarios ON documentos.usuario=usuarios.codigo
					where 
						(datosmaquina.documento=documentos.documento) AND (documentos.documento='$buscador')
					ORDER BY documentos.cont ASC
                    LIMIT 1";
		if ($resultado = $con->query($consulta)) {
		    while ($fila = $resultado->fetch_row()) {
		    	$firmamaquina=$fila[2];
		    ?> 
			<table class="table table-condensed">
			<meta charset="utf-8">
				<div style="float:right;">Fecha: <?php echo "$fila[18]"; ?> <br>Hora: <?php echo "$fila[19]"; ?> </div>
				<div style="float: left;">Registrado por: <?php echo "$fila[3]"; ?></div>
				<tr>
					<th>Tipo de proceso:</th>
					<td> <?php echo "$fila[7]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de lente:</th>
					<td> <?php echo "$fila[8]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de diseño:</th>
					<td> <?php echo "$fila[9]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de montaje:</th>
					<td><?php echo "$fila[10]"; ?></td>
				</tr>
				<tr>
					<th>Posición de lente:</th>
					<td><?php echo "$fila[11]"; ?></td>
				</tr>
				<tr>
					<th>Posición de cabezal:</th>
					<td><?php echo "$fila[12]"; ?></td>
				</tr>
				<tr>
					<th>Defecto óptico:</th>
					<td><?php echo "$fila[13]"; ?></td>
				</tr>
				<tr>
					<th>Defecto estético:</th>
					<td><?php echo "$fila[14]"; ?></td>
				</tr>
				<tr>
					<th>Defecto en aro:</th>
					<td><?php echo "$fila[15]"; ?></td>
				</tr>
				<tr>
					<th>Defecto en antireflejo:</th>
					<td><?php echo "$fila[16]"; ?></td>
				</tr>
			</table>	
	<hr/><center><b>Abastecimiento</b></center>
	<table class="table table-condensed">
<!-- 				<tr>
					<th>Documento:</th>
					<td> <?php //echo "$fila[2]"; ?></td>
				</tr> -->
				<tr>
					<th>Orden de lab / Cliente:</th>
					<td> <?php echo "$fila[17] / $fila[21]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de perdida:</th>
					<td> <?php echo "$fila[0]"; echo " / $fila[1]"; ?></td>
				</tr>
				<tr>
					<th>Origen:</th>
					<td>Máquina<?php echo " -> $fila[4]"; echo " / $fila[5]"; ?></td>
				</tr>
				<tr>
					<th>Operación:</th>
					<td> <?php echo "$fila[6]"; ?></td>
				</tr>
				<tr>
					<th>Defecto óptico:</th>
					<td><?php echo "$fila[13]"; ?></td>
				</tr>
				<tr>
					<th>Defecto estético:</th>
					<td><?php echo "$fila[14]"; ?></td>
				</tr>				
				<tr>
					<th>Observación:</th>
					<td><?php echo "$fila[20]"; ?></td>
				</tr>


		    <?php 
		    }
		}
		$consulta = "SELECT datosmaquina.codlente,lentes.nombre, 
					CASE
						wHEN idplente = 1 THEN 'Lente Izquierdo'
						WHEN idplente = 2 THEN 'Lente Derecho'
						WHEN idplente = 3 THEN 'Ambos Lentes'
					END plente
					FROM datosmaquina, lentes WHERE datosmaquina.codlente = lentes.codigo AND `documento`= '$buscador'";
					$i=0;
			if ($resultado = $con->query($consulta)) {
			    while ($fila = $resultado->fetch_row()) {
			    	$i++;
			         echo "	<tr>
								<th>$fila[2]</th>
								<td>$fila[1] <br> <div id='cod$i'></div>  </td>
							</tr>
							<script>$('#cod$i').barcode('$fila[0]', 'code128',{barWidth:2, barHeight:20});</script>";
			    }
			    /* liberar el conjunto de resultados */
			    $resultado->close();
			}
	 ?>

	</table>
<br>

<?php 
		$consulta = "SELECT 
	documentos.tipo,quejas.queja, documentos.documento,  usuarios.nombre, materiales.material, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, observacion, clientes.Cliente
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
			    LEFT JOIN antireflejo ON datosmaterial.idantireflejo = antireflejo.id
			    LEFT JOIN clientes ON datosmaterial.idcliente = clientes.id,
			    documentos
                INNER JOIN usuarios ON documentos.usuario=usuarios.codigo
			where 
				(datosmaterial.documento=documentos.documento) AND (documentos.documento='$buscador')
			ORDER BY documentos.cont ASC
                    LIMIT 1";
		if ($resultado = $con->query($consulta)) {
		    while ($fila = $resultado->fetch_row()) {
		    ?> 
<div id="divmaterial">
			<table class="table table-condensed tablmaterial">
				<div style="float:right;">Fecha: <?php echo "$fila[17]"; ?> <br>Hora: <?php echo "$fila[18]"; ?> </div>
				<div style="float: left;">Registrado por: <?php echo "$fila[3]"; ?></div>
				<tr>
					<th>Tipo de proceso:</th>
					<td> <?php echo "$fila[6]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de lente:</th>
					<td> <?php echo "$fila[7]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de diseño:</th>
					<td> <?php echo "$fila[8]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de montaje:</th>
					<td><?php echo "$fila[9]"; ?></td>
				</tr>
				<tr>
					<th>Posición de lente:</th>
					<td><?php echo "$fila[10]"; ?></td>
				</tr>
				<tr>
					<th>Posición de cabezal:</th>
					<td><?php echo "$fila[11]"; ?></td>
				</tr>
				<tr>
					<th>Defecto óptico:</th>
					<td><?php echo "$fila[12]"; ?></td>
				</tr>
				<tr>
					<th>Defecto estético:</th>
					<td><?php echo "$fila[13]"; ?></td>
				</tr>
				<tr>
					<th>Defecto en aro:</th>
					<td><?php echo "$fila[14]"; ?></td>
				</tr>
				<tr>
					<th>Defecto en antireflejo:</th>
					<td><?php echo "$fila[15]"; ?></td>
				</tr>
			</table>	
	<hr/><center><b>Abastecimiento</b></center>
	<table class="table table-condensed tablmaterial">
<!-- 				<tr>
					<th>Documento:</th>
					<td> <?php //echo "$fila[2]"; ?></td>
				</tr> -->
				<tr>
					<th>Orden de lab / Cliente:</th>
					<td> <?php echo "$fila[16] / $fila[20]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de perdida:</th>
					<td> <?php echo "$fila[0]"; echo " / $fila[1]"; ?></td>
				</tr>
				<tr>
					<th>Origen:</th>
					<td>Material<?php echo " -> $fila[4]"; ?></td>
				</tr>
				<tr>
					<th>Operación:</th>
					<td> <?php echo "$fila[5]"; ?></td>
				</tr>
				<tr>
					<th>Defecto óptico:</th>
					<td><?php echo "$fila[12]"; ?></td>
				</tr>
				<tr>
					<th>Defecto estético:</th>
					<td><?php echo "$fila[13]"; ?></td>
				</tr>
				<tr>
					<th>Observación:</th>
					<td><?php echo "$fila[19]"; ?></td>
				</tr>


		    <?php 
		    }
		}
		$consulta = "SELECT datosmaterial.codlente,lentes.nombre, 
					CASE
						wHEN idplente = 1 THEN 'Lente Izquierdo'
						WHEN idplente = 2 THEN 'Lente Derecho'
						WHEN idplente = 3 THEN 'Ambos Lentes'
					END plente
					FROM datosmaterial, lentes WHERE datosmaterial.codlente = lentes.codigo AND `documento`= '$buscador'";
					$i=0;
			if ($resultado = $con->query($consulta)) {
			    while ($fila = $resultado->fetch_row()) {
			    	$i++;
			         echo "	<tr>
								<th>$fila[2]</th>
								<td>$fila[1] <br> <div id='cod$i'></div>  </td>
							</tr>
							<script>$('#cod$i').barcode('$fila[0]', 'code128',{barWidth:2, barHeight:20});</script>";
			    }
			    /* liberar el conjunto de resultados */
			    $resultado->close();
			}
	 ?>
	</table>
</div>
<br>
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
					(datossoftware.documento=documentos.documento) AND (documentos.documento='$buscador')
				ORDER BY documentos.cont ASC
                    LIMIT 1";
		if ($resultado = $con->query($consulta)) {
		    while ($fila = $resultado->fetch_row()) {
		    ?>
	<div id="divsoftware">
			<table class="table table-condensed">
			<meta charset="utf-8">
				<div style="float:right;">Fecha: <?php echo "$fila[16]"; ?> <br>Hora: <?php echo "$fila[17]"; ?> </div>
				<div style="float: left;">Registrado por: <?php echo "$fila[3]"; ?></div>
				<tr>
					<th>Tipo de proceso:</th>
					<td> <?php echo "$fila[5]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de lente:</th>
					<td> <?php echo "$fila[6]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de diseño:</th>
					<td> <?php echo "$fila[7]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de montaje:</th>
					<td><?php echo "$fila[8]"; ?></td>
				</tr>
				<tr>
					<th>Posición de lente:</th>
					<td><?php echo "$fila[9]"; ?></td>
				</tr>
				<tr>
					<th>Posición de cabezal:</th>
					<td><?php echo "$fila[10]"; ?></td>
				</tr>
				<tr>
					<th>Defecto óptico:</th>
					<td><?php echo "$fila[11]"; ?></td>
				</tr>
				<tr>
					<th>Defecto estético:</th>
					<td><?php echo "$fila[12]"; ?></td>
				</tr>
				<tr>
					<th>Defecto en aro:</th>
					<td><?php echo "$fila[13]"; ?></td>
				</tr>
				<tr>
					<th>Defecto en antireflejo:</th>
					<td><?php echo "$fila[14]"; ?></td>
				</tr>
			</table>	
	<hr/><center><b>Abastecimiento</b></center>
	<table class="table table-condensed">
				<!-- <tr>
					<th>Documento:</th>
					<td> <?php //echo "$fila[2]"; ?></td>
				</tr> -->
				<tr>
					<th>Orden:</th>
					<td> <?php echo "$fila[15]"; ?></td>
				</tr>
				<tr>
					<th>Tipo de perdida:</th>
					<td> <?php echo "$fila[0]"; echo " / $fila[1]"; ?></td>
				</tr>
				<tr>
					<th>Origen:</th>
					<td>Software</td>
				</tr>
				<tr>
					<th>Operación:</th>
					<td> <?php echo "$fila[4]"; ?></td>
				</tr>
				<tr>
					<th>Defecto óptico:</th>
					<td><?php echo "$fila[11]"; ?></td>
				</tr>
				<tr>
					<th>Defecto estético:</th>
					<td><?php echo "$fila[12]"; ?></td>
				</tr>
				<tr>
					<th>Observación:</th>
					<td><?php echo "$fila[18]"; ?></td>
				</tr>
<br>

		    <?php 
		    }
		}
		$consulta = "SELECT datossoftware.codlente,lentes.nombre, 
					CASE
						wHEN idplente = 1 THEN 'Lente Izquierdo'
						WHEN idplente = 2 THEN 'Lente Derecho'
						WHEN idplente = 3 THEN 'Ambos Lentes'
					END plente
					FROM datossoftware, lentes WHERE datossoftware.codlente = lentes.codigo AND `documento`= '$buscador'";
					$i=0;
			if ($resultado = $con->query($consulta)) {
			    while ($fila = $resultado->fetch_row()) {
			    	$i++;
			         echo "	<tr>
								<th>$fila[2]</th>
								<td>$fila[1] <br> <div id='cod$i'></div>  </td>
							</tr>
							<script>$('#cod$i').barcode('$fila[0]', 'code128',{barWidth:2, barHeight:20});</script>";
			    }
			    /* liberar el conjunto de resultados */
			    $resultado->close();
			}
echo "</table></div><br>";
/*--------------------------------receta***************************************************/

	$consulta = "SELECT 
CASE `ojo`
	WHEN 'i' THEN 'OI'
    WHEN 'd' THEN 'OD'
END Ojo,
`Material`, `base`, `esf`, `cly`, `addic` FROM `receta` WHERE `documento`='$buscador'";
	if ($resultado = $con->query($consulta)) {
	echo "
	<table  class='table table-bordered' style='margin-top:-70px;'>
		<tr>
			<th>Ojo</th>	<th>Material</th>	<th>Base</th>	<th>Esfera</th>	<th>Cilindro</th>	<th>Adición</th>
		</tr>
	";
	    while ($fila = $resultado->fetch_row()) {
	         echo "
	         	<tr>
	         		<th>$fila[0]</th>
	         		<td>$fila[1]</td>
	         		<td>$fila[2]</td>
	         		<td>$fila[3]</td>
	         		<td>$fila[4]</td>
	         		<td>$fila[5]</td>
	         	</tr>
	         ";
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	echo "</table><br>";
	}
/*---------------------------------Anulado*************************************************/
	  $consulta = "SELECT usuarios.nombre,`fecha`,`hora`,`comentario` FROM `anuladas`,usuarios WHERE anuladas.usuario=usuarios.codigo AND documento=$buscador";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
         echo '<p class="bg-info" style="padding:10px;">Anulada por <b>'.$fila[0].'</b> el día '.$fila[1].' a las '.$fila[2].' por motivo de: <b style="color:red">'.$fila[3].'</b></p>';
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
} ?>

	<br>
<footer>
	<table style="width: 100%">
		<tr>
			<td><div style="float: left;border-top: 2px solid black"><i>&nbsp;Supervisor Encargado&nbsp;</i></div></td>
			<td>
				<?php if (isset($firmapersona)) {
					echo '<div style="float: left;border-top: 2px solid black"><i>&nbsp;Persona Responsable&nbsp;</i></div>';
				} ?>
				<?php if (isset($firmamaquina)) {
					echo '<div style="float: left;border-top: 2px solid black"><i>&nbsp;Encargado Mantenimiento&nbsp;</i></div>';
				} 
				?>
			</td>
			<td><div style="float: left;border-top: 2px solid black"><i>&nbsp;&nbsp;&nbsp;SAP/Digitado por&nbsp;&nbsp;&nbsp;</i></div></td>
		</tr>
	</table>
</footer>


</BODY>
<script language="javascript">
	function redirect(){
    	//window.location.href = "../";
		window.close();
	}
	$("#bcobjetivo").barcode("<?php echo($buscador); ?>", "code128",{barWidth:2, barHeight:20});
</script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

</HTML>