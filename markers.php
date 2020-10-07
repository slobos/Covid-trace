<?php
header("Content-type:application/json");
include("includes/functions.php");
include("includes/_vars.php");
$arData = getMarkers();
$jsonData = json_encode($arData);
echo  $jsonData;
?>