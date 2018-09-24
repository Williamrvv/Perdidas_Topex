 <script>
 	function imprimir() {
      window.open('imprimir.php' , 'ventana1' , 'width=300,height=400,scrollbars=NO');
      location.href ='../';
  	}
	
 </script>
<?php 
session_start();
include("conn.php");
@$documento=$_POST['documento'];
@$tipo=$_POST['tipo'];
@$orden=$_POST['orden'];
@$origen=$_POST['origen'];
@$material=$_POST['material'];
@$maquina=$_POST['maquina'];
@$persona=$_POST['persona'];
@$maquinas=$_POST['maquinas'];
@$material=$_POST['material'];
@$Proceso=$_POST['Proceso'];
@$montaje=$_POST['montaje'];
@$plente=$_POST['plente'];
@$pcabezal=$_POST['pcabezal'];
@$defoptico=$_POST['defoptico'];
@$defestetico=$_POST['defestetico'];
@$aro=$_POST['aro'];
@$ar=$_POST['ar'];
@$obs=$_POST['observacion'];
@$usrs=$_SESSION['usuar'];
@$queja=$_POST['quejas'];
@$diseno=$_POST['diseno'];
@$tlente=$_POST['tlente'];
@$operacion=$_POST['operacion'];
@$lizquierdo=$_POST['lizquierdo'];
@$lderecho=$_POST['lderecho'];
@$cliente=$_POST['cliente'];

//***********************Comprobar existencia de cliente
$consulta = "SELECT COUNT(`Cliente`),`id` FROM `clientes` WHERE `Cliente`='$cliente' AND `status`=1 GROUP BY `id`";
if ($resultado = $con->query($consulta)) {
    $cli = $resultado->fetch_row();
         //echo "$cli[0]";
         if ($cli[0]==0) {
         	echo "<script>alert('*****EL CLIENTE NO EXISTE EN LA BASE DE DATOS*****');//location.href ='../';</script>";
			die();
         }else{$cliente=$cli[1];}
    }

//Receta
@$material1=$_POST['material1'];
@$ojo1=$_POST['ojo1'];
@$base1=$_POST['base1'];
@$esf1=$_POST['esf1'];
@$cly1=$_POST['cly1'];
@$addic1=$_POST['add1'];

@$material2=$_POST['material2'];
@$ojo2=$_POST['ojo2'];
@$base2=$_POST['base2'];
@$esf2=$_POST['esf2'];
@$cly2=$_POST['cly2'];
@$addic2=$_POST['add2'];

if ($queja=='') {
	$queja='NULL';
}
if ($base1=='') {
	$base1='NULL';
}
if ($base2=='') {
	$base2='NULL';
}
if ($esf1=='') {
	$esf1='NULL';
}
if ($esf2=='') {
	$esf2='NULL';
}
if ($cly1=='') {
	$cly1='NULL';
}
if ($cly2=='') {
	$cly2='NULL';
}
if ($addic1=='') {
	$addic1='NULL';
}
if ($addic2=='') {
	$addic2='NULL';
}

if ($tipo=='garantia') {
	$origen='Persona';
	$persona='43';
	$operacion='0';
}else{
	$consulta = "SELECT COUNT(`codigo`) FROM `lentes` WHERE `codigo`= '$lizquierdo' OR `codigo`= '$lderecho'";
	if ($resultado = $con->query($consulta)) {
	    while ($fila = $resultado->fetch_row()) {
			if ($fila[0]<=0) {
				echo "<script>alert('*****El SKU DEL LENTE NO EXISTE*****');location.href ='../';</script>";
				die();
			}         
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
}


$consulta = "SELECT  count(`documento`) FROM `documentos` WHERE `documento`=$documento";
if ($resultado = $con->query($consulta)) {
    $fila = $resultado->fetch_row();
    	if ($fila[0]!=0) {
    		$documento=$fila[0]+1;
	// liberar el conjunto de resultados 
    $resultado->close();
}elseif(isset($orden)) {
	$query = "INSERT INTO `documentos`( `documento`,`usuario`, `orden`, `tipo`, `fecha`, `hora`,`cantidad`) VALUES ('$documento','$usrs','$orden','$tipo','$fecha','$hora',1)";
	mysqli_query($con, $query);

//echo "$fecha";
//echo "$hora";
/*-----------------insertar receta----------------------*/
		$query ="INSERT INTO `receta`(`documento`, `Material`, `ojo`, `base`, `esf`, `cly`, `addic`) VALUES ('$documento','$material1','$ojo1',$base1,$esf1,$cly1,$addic1)";
			mysqli_query($con, $query);

		$query = "INSERT INTO `receta`(`documento`, `Material`, `ojo`, `base`, `esf`, `cly`, `addic`) VALUES ('$documento','$material2','$ojo2',$base2,$esf2,$cly2,$addic2)";
			mysqli_query($con, $query);


	switch ($origen) {
		case 'Persona':
			$query = "INSERT INTO `datospersonas`(`id`,`documento`, `idpersona`, `idproceso`, `idmontaje`, `idplente`, `idpcabezal`, `iddefoptico`, `iddefestetico`, `idaro`, `idantireflejo`, `observacion`,`idqueja`,`iddisenos`,`idtlente`,`idoperacion`,`codlente`, `idcliente`) VALUES (NULL,'$documento',$persona,$Proceso,$montaje,$plente,$pcabezal,$defoptico,$defestetico,$aro,$ar,'$obs',$queja,$diseno,$tlente,$operacion,'$lizquierdo', '$cliente')";

			mysqli_query($con, $query);

			echo "<script>alert('DATOS DE PERSONAL INGRESADOS CON ÉXITO!!');imprimir();location.href ='../';</script>";
			break;
			
		case 'Maquina':
		$query = "INSERT INTO `datosmaquina`(`id`,`documento`, `idmaquina`, `idpersona`, `idproceso`, `idmontaje`, `idplente`, `idpcabezal`, `iddefoptico`, `iddefestetico`, `idaro`, `idantireflejo`, `observacion`,`idqueja`,`iddisenos`,`idtlente`,`idoperacion`,`codlente`, `idcliente`) VALUES (NULL,$documento,$maquina,$persona,$Proceso,$montaje,$plente,$pcabezal,$defoptico,$defestetico,$aro,$ar,'$obs',$queja,$diseno,$tlente,$operacion,'$lizquierdo', '$cliente')";
			mysqli_query($con, $query);
			echo "<script>alert('DATOS DE MÁQUINA INGRESADOS CON ÉXITO!!');imprimir();location.href ='./mailer.php?id=$documento';</script>";
			break;
			
		case 'Material':
			$query = "INSERT INTO `datosmaterial`(`id`, `documento`, `idmaterial`, `idproceso`, `idmontaje`, `idplente`, `idpcabezal`, `iddefoptico`, `iddefestetico`, `idaro`, `idantireflejo`, `observacion`,`idqueja`,`iddisenos`,`idtlente`,`idoperacion`,`codlente`, `idcliente`) VALUES (NULL,$documento,$material,$Proceso,$montaje,$plente,$pcabezal,$defoptico,$defestetico,$aro,$ar,'$obs',$queja,$diseno,$tlente,$operacion,'$lizquierdo', '$cliente')";
			mysqli_query($con, $query);
			echo "<script>alert('DATOS DE MATERIAL INGRESADOS CON ÉXITO !!');imprimir();location.href ='../';</script>";
			break;
			
		case 'Software':
			$query = "INSERT INTO `datossoftware`(`id`, `documento`, `idproceso`, `idmontaje`, `idplente`, `idpcabezal`, `iddefoptico`, `iddefestetico`, `idaro`, `idantireflejo`, `observacion`,`idqueja`,`iddisenos`,`idtlente`,`idoperacion`,`codlente`, `idcliente`) VALUES (NULL,$documento,$Proceso,$montaje,$plente,$pcabezal,$defoptico,$defestetico,$aro,$ar,'$obs',$queja,$diseno,$tlente,$operacion,'$lizquierdo', '$cliente')";
			mysqli_query($con, $query);
			echo "<script>alert('DATOS DE SOFTWARE INGRESADOS CON ÉXITO!!');imprimir();location.href ='../';</script>";
			break;
		
		default:
		echo "<script>alert('¡¡UPS... Algo salió mal, Contacta con T.I!!');location.href ='../';</script>";
			break;
	}
}}


if ($plente==3) {
	$query = "UPDATE `documentos` SET `cantidad` = '2' WHERE `documentos`.`documento` = '$documento';";
	mysqli_query($con, $query);
	switch ($origen) {
		case 'Persona':
			$query = "INSERT INTO `datospersonas`(`id`,`documento`, `idpersona`, `idproceso`, `idmontaje`, `idplente`, `idpcabezal`, `iddefoptico`, `iddefestetico`, `idaro`, `idantireflejo`, `observacion`,`idqueja`,`iddisenos`,`idtlente`,`idoperacion`,`codlente`, `idcliente`) VALUES (NULL,'$documento',$persona,$Proceso,$montaje,$plente,$pcabezal,$defoptico,$defestetico,$aro,$ar,'$obs',$queja,$diseno,$tlente,$operacion,'$lderecho', '$cliente')";
			mysqli_query($con, $query);

			echo "<script>alert('DATOS DE PERSONA INGRESADOS CON ÉXITO!!');imprimir();imprimir();location.href ='../';</script>";
			break;
			
		case 'Maquina':
		$query = "INSERT INTO `datosmaquina`(`id`,`documento`, `idmaquina`, `idpersona`, `idproceso`, `idmontaje`, `idplente`, `idpcabezal`, `iddefoptico`, `iddefestetico`, `idaro`, `idantireflejo`, `observacion`,`idqueja`,`iddisenos`,`idtlente`,`idoperacion`,`codlente`, `idcliente`) VALUES (NULL,$documento,$maquina,$persona,$Proceso,$montaje,$plente,$pcabezal,$defoptico,$defestetico,$aro,$ar,'$obs',$queja,$diseno,$tlente,$operacion,'$lderecho', '$cliente')";
			mysqli_query($con, $query);
			echo "<script>alert('DATOS DE MÁQUINA INGRESADOS CON ÉXITO!!');imprimir();location.href ='./mailer.php?id=$documento';</script>";
			break;
			
		case 'Material':
			$query = "INSERT INTO `datosmaterial`(`id`, `documento`, `idmaterial`, `idproceso`, `idmontaje`, `idplente`, `idpcabezal`, `iddefoptico`, `iddefestetico`, `idaro`, `idantireflejo`, `observacion`,`idqueja`,`iddisenos`,`idtlente`,`idoperacion`,`codlente`, `idcliente`) VALUES (NULL,$documento,$material,$Proceso,$montaje,$plente,$pcabezal,$defoptico,$defestetico,$aro,$ar,'$obs',$queja,$diseno,$tlente,$operacion,'$lderecho', '$cliente')";
			mysqli_query($con, $query);
			echo "<script>alert('DATOS DE MATERIAL INGRESADOS CON ÉXITO !!');imprimir();location.href ='../';</script>";
			break;
			
		case 'Software':
			$query = "INSERT INTO `datossoftware`(`id`, `documento`, `idproceso`, `idmontaje`, `idplente`, `idpcabezal`, `iddefoptico`, `iddefestetico`, `idaro`, `idantireflejo`, `observacion`,`idqueja`,`iddisenos`,`idtlente`,`idoperacion`,`codlente`, `idcliente`) VALUES (NULL,$documento,$Proceso,$montaje,$plente,$pcabezal,$defoptico,$defestetico,$aro,$ar,'$obs',$queja,$diseno,$tlente,$operacion,'$lderecho', '$cliente')";
			mysqli_query($con, $query);
			echo "<script>alert('DATOS DE SOFTWARE INGRESADOS CON ÉXITO!!');imprimir();location.href ='../';</script>";
			break;
		
		default:
		echo "<script>alert('¡¡UPS... Algo salió mal, Contacta con T.I!!');location.href ='../';</script>";
			break;
		}
	}

$_SESSION['buscar']=$documento;
//header('location: imprimir.php');
 ?> 

