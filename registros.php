<?php
header("Content-type:application/json");
include("includes/functions.php");
include("includes/_vars.php");
$arData = getRegistros();
$jsonData = json_encode($arData);
echo  $jsonData;
?>