<?php
session_start();
$buscador= '1381282';
include("conn.php");

$para  = 'wvalverde@topexlabs.com' . ', '; // atención a la coma
$para .= 'jsolano@topexlabs.come';
 
// Asunto
$titulo = 'Alerta';
 
// Cuerpo o mensaje
$mensaje = '
	<center><h2 style="color: red;">Mensaje automático de alerta</h2><h3>Sistema de perdidas Topex</h3></center>
';
	$consulta = "SELECT SUM(documentos.cantidad) FROM documentos WHERE ((documentos.fecha >= '2017-12-13') AND (documentos.fecha<='2017-12-13')) AND ((documentos.hora >= '00:00') AND (documentos.hora <= '23:00'))";
						if ($resultado = $con->query($consulta)) {
						    $total = $resultado->fetch_row();
						    /* liberar el conjunto de resultados */
						    $resultado->close();
						}


	$consulta = "SELECT COUNT(documentos.documento) FROM datospersonas,documentos WHERE (datospersonas.documento=documentos.documento) AND ((documentos.fecha >= '2017-12-13')AND (documentos.fecha<='2017-12-13')) AND ((documentos.hora >= '00:00') AND (documentos.hora <= '23:00') AND (documentos.cantidad>0) )";
						if ($resultado = $con->query($consulta)) {
						    $total_personas = $resultado->fetch_row();
						    /* liberar el conjunto de resultados */
						    $resultado->close();
						}
$mensaje .= '<div style="padding:20px"><p>Ya llevamos <strong style="color:red;">'.$total_personas[0].'</strong> perdidas hechas en <u>personal</u> hasta las '.$hora.' del día de hoy.</p>';
$porcentaje= $total_personas[0]*100/$total[0];
$mensaje .= '<p>Esto representa un <strong style="color:red">'.substr($porcentaje, 0, 5).'%</strong> del total. </p>';
$mensaje .= '<br>
	<h2><u>Pareto</u></h2>
	<table border=1 cellspacing=0 cellpadding=5 bordercolor="666633">
		<tr>
			<th>Persona</th>
			<th>Cantidad</th>
			<th>Porcentaje</th>
			<th>Porcentaje Acumulado</th>
		</tr>';
$consulta = "SELECT 
	DISTINCT(`idpersona`),persona, COUNT(`idpersona`) as cont, (COUNT(`idpersona`)*100/$total_personas[0]) 
FROM 
	datospersonas, personas, documentos 
where 
	(datospersonas.idpersona = personas.id) AND (datospersonas.documento=documentos.documento) AND ((documentos.fecha>='$fecha')AND(documentos.fecha<='$fecha')) AND ((documentos.hora >= '$00:00')AND(documentos.hora<='23:59') AND (documentos.cantidad>0) ) 
GROUP BY idpersona ORDER BY cont DESC";
		if ($resultado = $con->query($consulta)) {
			$index=1;
		    while ($fila = $resultado->fetch_row()) {
		    	@$acum+=$fila[3];
		      	$mensaje .= '
		    <tr>
				<td>'.$fila[1].'</td>
				<td>'.$fila[2].'</td>
				<td>'.$fila[3].'%</td>
				<td>'.$acum.'%</td>
			';
		    }
			/* liberar el conjunto de resultados */
		    $resultado->close();
		}
$mensaje .= '</table>';
$mensaje .= '<br><br>
<table border=0>
<tr>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=13.6%></td>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=30.2%></td>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=3.1%></td>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=5.9%></td>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=10.6%></td>
</tr>
<tr>
<td colspan=5 bgcolor=#000000 height=1><img src=singlepixel.gif width=1 height=1></td>
</tr>
<tr>
<td>Spain</td>
<td>France</td>
<td>US</td>
<td>UK</td>
<td>Italy</td>
</tr>
</table>';
$mensaje .= '';
$mensaje .= '';
$mensaje .= '</div>';
// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
 
// Cabeceras adicionales
$cabeceras .= 'From: Alerta <Modulo_de_perdidas>' . "\r\n";
$cabeceras .= 'Cc: archivotarifas@example.com' . "\r\n";
$cabeceras .= 'Bcc: copiaoculta@example.com' . "\r\n";
 
// enviamos el correo!
//mail($para, $titulo, $mensaje, $cabeceras);
?>

<center><h2 style="color: red;">Mensaje automático de alerta</h2><h3>Sistema de perdidas Topex</h3></center>
<?php 
echo '<div style="padding:20px"><p>Ya llevamos <strong style="color:red;">'.$total_personas[0].'</strong> perdidas hechas en <u>personal</u> hasta las '.$hora.' del día de hoy.</p>';
echo '<p>Esto representa un <strong style="color:red">'.substr($porcentaje, 0, 5).'%</strong> del total. </p>';
echo '</div>';
 ?>

 <h2><u>Pareto</u></h2>
<table border=1 cellspacing=0 cellpadding=5 bordercolor="666633">
	<tr>
		<th>Persona</th>
		<th>Cantidad</th>
		<th>Porcentaje</th>
		<th>Porcentaje Acumulado</th>
	</tr>
	<?php 
		$consulta = "SELECT 
	DISTINCT(`idpersona`),persona, COUNT(`idpersona`) as cont, (COUNT(`idpersona`)*100/$total_personas[0]) 
FROM 
	datospersonas, personas, documentos 
where 
	(datospersonas.idpersona = personas.id) AND (datospersonas.documento=documentos.documento) AND ((documentos.fecha>='$fecha')AND(documentos.fecha<='$fecha')) AND ((documentos.hora >= '$00:00')AND(documentos.hora<='$hora') AND (documentos.cantidad>0) ) 
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
			</tr>
			";
		    }
			/* liberar el conjunto de resultados */
		    $resultado->close();
		}
	 ?>
</table>
<br>
<table>
  <tr>
    <td colspan="10" bgcolor="pink"></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="pink"></td>
    <td colspan="5" bgcolor="white"></td>
  </tr>
</table>
 
<table border=0>
<tr>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=13.6%></td>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=30.2%></td>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=3.1%></td>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=5.9%></td>
<td align=bottom><img src=http://www.semgrupo.com/img/cuadroRojo.gif width=20 height=10.6>%</td>
</tr>
<tr>
<td colspan=5 bgcolor=#000000 height=1><img src=singlepixel.gif width=1 height=1></td>
</tr>
<tr>
<td>Spain</td>
<td>France</td>
<td>US</td>
<td>UK</td>
<td>Italy</td>
</tr>
</table>