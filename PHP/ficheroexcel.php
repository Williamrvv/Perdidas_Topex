<?php
include("conn.php");
@$_POST['datos_generales'];
if (isset($_POST['datos_generales'])) {
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=Perdidas_Generales($fecha).xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo $_POST['datos_generales'];
}


@$_POST['datos_maquinas'];
if (isset($_POST['datos_maquinas'])) {
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=Perdidas_Maquinas($fecha).xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo $_POST['datos_maquinas'];
}


@$_POST['datos_material'];
if (isset($_POST['datos_material'])) {
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=Perdidas_Material($fecha).xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo $_POST['datos_material'];
}


@$_POST['datos_personal'];
if (isset($_POST['datos_personal'])) {
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=Perdidas_Personal($fecha).xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo $_POST['datos_personal'];
}


@$_POST['datos_software'];
if (isset($_POST['datos_software'])) {
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=Perdidas_Software($fecha).xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo $_POST['datos_software'];
}
?>