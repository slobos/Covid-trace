<?php
date_default_timezone_set('America/Argentina/Cordoba');
// Variables definitions

// MySQL
define("DBHOST", "localhost");
define("DBUSER","root");
define("DBPASS","root");
define("DBNAME","covidlocaltrace");
// General

define("DATE",date("Y-m-d"));
define("TIME",date("H:i:s"));
define("IP",$_SERVER['REMOTE_ADDR']);
define("CLIENT",$_SERVER['HTTP_USER_AGENT']);



?>