<?php
@session_start();

if(isset($_SESSION) and $_SESSION['nombre'] != "" and $_SESSION['level'] != "0" and $_SERVER['HTTP_REFERER'] == ""){
  header("Location: /logout.php");
}else{
  $logged = true;
}
include('includes/securiza.php');
header("Content-type:application/json");
include("includes/functions.php");
include("includes/_vars.php");
$result = deleteRegistros($_GET['p']);
header("Location: /app.php");
?>