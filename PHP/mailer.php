<?php
include("conn.php");
require("../phpmailer/class.phpmailer.php");
$idperdida=$_GET['id'];


	$consulta = "SELECT 
 documentos.cantidad,documentos.tipo,quejas.queja, documentos.documento,usuarios.nombre, maquinas.maquina, personas.persona, operaciones.operacion, procesos.proceso,tlentes.tlente, disenos.diseno, montajes.montaje, plente.posicion, pcabezal.cabezal, defoptico.defecto,defestetico.defecto,aros.aro,antireflejo.defecto, documentos.orden, documentos.fecha, documentos.hora, observacion
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
		(datosmaquina.documento=documentos.documento) AND (documentos.documento='$idperdida')
	ORDER BY documentos.cont ASC LIMIT 1";
	if ($resultado = $con->query($consulta)) {
	    $fila = $resultado->fetch_row();	    
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}


$mail = new PHPMailer();

$mail->IsSMTP();                                      // set mailer to use SMTP
$mail->Host = "topex-labs.com";  // specify main and backup server
$mail->SMTPAuth = false;     // turn on SMTP authentication
$mail->Username = "perdidas@topex-labs.com";  // SMTP username
$mail->Password = "Perdidas**"; // SMTP password

$mail->From = "perdidas@topex-labs.com";
$mail->FromName = "Pérdidas Maquina";
$mail->AddAddress("jsolano@topex-labs.com", "José Solano");
//$mail->AddAddress("ellen@example.com");                  // name is optional
//$mail->AddReplyTo("info@example.com", "Information");

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "Nueva pérdida de máquina: $fila[5], cantidad: $fila[0] ";
$mail->Body    = "
<p>Un Saludo don José Solano,</p>
<p>Estos son los datos que se ingresaron en el sistema de pérdidas de una máquina hace un momento:</p>

	<table border=1 cellspacing=0 cellpadding=2 bordercolor='666633'>
  	<thead style='resize: horizontal;'>
	  	<tr>
			 	<th>Tipo</th> 
				<th>Queja</th> 
				<th>Documento</th> 
				<th>Registró</th> 
				<th>Máquina</th> 
				<th>Operario</th>
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
  	<tbody>
	  	<tr>
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
	  		<td>$fila[18]</td>
	  		<td>$fila[19]</td>
	  		<td>$fila[20]</td>
	  	</tr>
  	</tbody>
</table>
<br>
<p>El balance en pérdidas por maquinas hasta ahora se presenta de la siguiente manera.</p>
<table border=1 cellspacing=0 cellpadding=2 bordercolor='666633'>
	<thead>
		<tr>
			<th>Máquina</th>
			<th>Total</th>
			<th>Porcentaje</th>
		</tr>
	</thead>
	<tbody>";
		$consulta = "SELECT DISTINCT(`idmaquina`),maquina, COUNT(`idmaquina`) as cont, (COUNT(`idmaquina`)*100/(
SELECT COUNT(documentos.documento) FROM datosmaquina,documentos WHERE (datosmaquina.documento=documentos.documento) AND ((documentos.fecha >= '$fecha') AND (documentos.fecha<='$fecha')) AND (documentos.cantidad>0))   
) FROM datosmaquina, maquinas, documentos where (datosmaquina.idmaquina = maquinas.id) AND (datosmaquina.documento=documentos.documento) AND ((documentos.fecha>='$fecha')AND(documentos.fecha<='$fecha')) AND (documentos.cantidad>0) GROUP BY idmaquina ORDER BY cont DESC";
	if ($resultado = $con->query($consulta)) {
	  while ($total = $resultado->fetch_row()) {
	    $mail->Body .="<tr><td>$total[1]</td><td>$total[2]</td><td>%$total[3]</td></tr>";
	    }
	  /* liberar el conjunto de resultados */
	  $resultado->close();
	}

$mail->Body .="</tbody>
</table>
<br><br>
<a href='http://192.168.1.9:88/perdidas'><h4><u>Obtenga más detalles de las perdidas pulsando aquí</u><h4></a>
";
$mail->AltBody = "Si no puedes ver el contenido de este correo intenta abrir el mismo en otro dispositivo";
// Activo condificacción utf-8
$mail->CharSet = 'UTF-8';
if(!@$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

?>
<script>location.href ='../';</script>