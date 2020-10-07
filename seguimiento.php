<?php
header("Content-type:application/json");
include("includes/functions.php");
include("includes/_vars.php");
if(
	isset($_POST['input_seguimiento_fecha']) && 
	isset($_POST['input_seguimiento_viacontacto']) && 
	isset($_POST['input_seguimiento_situacion']) && 
	isset($_POST['input_seguimiento_observaciones'])){	
	
	$res =  seguimiento($_POST);
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