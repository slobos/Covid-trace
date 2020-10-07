<?php 
@session_start();
if (empty($_SESSION['nombre'])){
	header("Location: /");
}
?>