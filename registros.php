<?php
@session_start();

if(isset($_SESSION) and $_SESSION['nombre'] != "" and $_SERVER['HTTP_REFERER'] == ""){
  header("Location: /logout.php");
}else{
  $logged = true;
}
include('includes/securiza.php');
header("Content-type:application/json");
include("includes/functions.php");
include("includes/_vars.php");
$arData = getRegistros();
$jsonData = json_encode($arData);
echo  $jsonData;
?>