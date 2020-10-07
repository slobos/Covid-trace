<?php
header("Content-type:application/json");
include("includes/functions.php");
include("includes/_vars.php");
if($_GET['UID'] != ""){
	$arData = getDetalles($_GET['UID']);
	$jsonData = json_encode($arData);
} else {
	$jsonData = '{"data": [{"error": true,"mensaje": "Identificador incorrecto"}]}';
}
echo  $jsonData;
?>