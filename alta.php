<?php
header("Content-type:application/json");
include("includes/functions.php");
include("includes/_vars.php");
if(isset($_POST['input_nombreapellido']) && isset($_POST['input_celular']) && isset($_POST['input_calle']) && isset($_POST['input_numeracion']) && isset($_POST['input_barrio']) && isset($_POST['input_covidtipo'])){
	$res = altav2($_POST);
	if($res == 1){
		$arData['status'] = "ok";
		$arData['message'] = "Paciente correctamente registrado";
	} else {
		$arData['status'] = "ko";
		$arData['message'] = "Hubo un error en la carga del paciente";
	}
} else {
	$arData['status'] = "ko";
	$arData['message'] = "Método no aceptado o información insuficiente";
}
$jsonData = json_encode($arData);
echo  $jsonData;
?>