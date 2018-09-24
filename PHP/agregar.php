<?php 
include("conn.php");
@$diseno=$_POST["diseno"];
@$tlente=$_POST["tlente"];
@$operacion=$_POST["operacion"];
@$persona=$_POST["persona"];
@$maquina=$_POST["maquina"];
@$material=$_POST["material"];
@$proceso=$_POST["proceso"];
@$montaje=$_POST["montaje"];
@$defoptico=$_POST["defoptico"];
@$defestetico=$_POST["defestetico"];
@$aro=$_POST["aro"];
@$ar=$_POST["ar"];
@$cliente=$_POST['cliente'];

if ($cliente!='') {
	$query = "INSERT INTO `clientes`(`Cliente`) VALUES ('$cliente')";
	mysqli_query($con, $query);
	echo "<script>alert('Cliente ingresado con exito!!');location.href ='../';</script>";
}
if ($diseno!='') {
	$query = "INSERT INTO `disenos`(`id`, `diseno`) VALUES (NULL,'$diseno')";
	mysqli_query($con, $query);
	echo "<script>alert('Diseño ingresado con exito!!');location.href ='../';</script>";
}
if ($operacion!='') {
	$query = "INSERT INTO `operaciones`(`operacion`) VALUES ('$operacion')";
	mysqli_query($con, $query);
	echo "<script>alert('operacion ingresada con exito!!');location.href ='../';</script>";
}
if ($persona!='') {
	$query = "INSERT INTO `personas`(`id`, `persona`) VALUES (NULL,'$persona')";
	mysqli_query($con, $query);
	echo "<script>alert('Persona ingresada con exito!!');location.href ='../';</script>";
}
if ($maquina!='') {
	$query = "INSERT INTO `maquinas`(`maquina`) VALUES ('$maquina')";
	$con->query($query);
	echo "<script>alert('Maquina ingresada con exito!!');location.href ='../';</script>";
}
if ($material!="") {
	$query = "INSERT INTO `materiales`(`material`) VALUES ('$material')";
	$con->query($query);
	echo "<script>alert('Material ingresado con exito!!');location.href ='../';</script>";
}
if ($proceso!="") {
	$query = "INSERT INTO `procesos`(`proceso`) VALUES ('$proceso')";
	$con->query($query);
	echo "<script>alert('Tipo de proceso Ingresado con exito!!');location.href ='../';</script>";
}
if ($tlente!="") {
	$query = "INSERT INTO `tlentes`(`id`, `tlente`) VALUES (NULL,'$tlente')";
	$con->query($query);
	echo "<script>alert('Tipo de lente Ingresado con exito!!');location.href ='../';</script>";
}
if ($defoptico!="") {
	$query = "INSERT INTO `defoptico`(`defecto`) VALUES ('$defoptico')";
	$con->query($query);
	echo "<script>alert('Defecto óptico ingresado con exito!!');location.href ='../';</script>";
}
if ($montaje!="") {
	$query = "INSERT INTO `montajes`(`montaje`) VALUES ('$montaje')";
	$con->query($query);
	echo "<script>alert('Tipo de montaje ingresado con exito!!')</script>";
}
if ($defestetico!="") {
	$query = "INSERT INTO `defestetico`(`defecto`) VALUES ('$defestetico')";
	$con->query($query);
	echo "<script>alert('Defecto estético ingresado con exito!!');location.href ='../';</script>";
}
if ($aro!="") {
	$query = "INSERT INTO `aros`(`aro`) VALUES ('$aro')";
	$con->query($query);
	echo "<script>alert('Defecto en aro ingresado con exito!!');location.href ='../';</script>";
}
if ($ar!="") {
	$query = "INSERT INTO `antireflejo`(`defecto`) VALUES ('$ar')";
	$con->query($query);
	echo "<script>alert('Defecto en Anti Reflejo ingresado con exito!!');location.href ='../';</script>";
}else{
	echo "<script>alert('*****No se ha realizado nunguna acción*****');location.href ='../';</script>";
}
 ?>