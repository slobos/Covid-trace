<?php
function getConnection() {
    $dbh = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8", DBUSER, DBPASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function cleanup($varAlimpiar){
  $varAlimpiar = str_replace(","," ",$varAlimpiar);
  $varAlimpiar = str_replace("<","&lt;",$varAlimpiar);
  $varAlimpiar = str_replace(">","&gt;",$varAlimpiar);
  $varAlimpiar = str_replace("\'","&#39;",$varAlimpiar);
  $varAlimpiar = str_replace('\"',"&quot;",$varAlimpiar);
  $varAlimpiar = str_replace("\\\\","&#92",$varAlimpiar);
  $varAlimpiar = str_replace(array("'", "\"", "&quot;"), "", htmlspecialchars($varAlimpiar) );
  if($varAlimpiar == ""){
    $varAlimpiar = "NULL";
  }
  return $varAlimpiar;
}



function alta($arData){

  $transactionid = generateRandomString();
  $situacion_transactionid = generateRandomString();


  $nombreapellido = cleanup($arData['input_nombreapellido']);
  $edad = cleanup($arData['input_edad']);
  $telefono = cleanup($arData['input_telefono']);
  $celular = cleanup($arData['input_celular']);
  $calle = cleanup($arData['input_calle']);
  $numeracion = cleanup($arData['input_numeracion']);
  $barrio = cleanup($arData['input_barrio']);
  $tipo = cleanup($arData['input_covidtipo']);
  $fecha = cleanup($arData['input_fecharesultado']);
  $lugar = cleanup($arData['input_lugaranalisis']);
  $patologiasprevias = cleanup($arData['input_patologiasprevias']);
  $observaciones = cleanup($arData['input_observaciones']);
  $latitud = cleanup($arData['input_latitud']);
  $longitud = cleanup($arData['input_longitud']);
  $situacion = cleanup($arData['input_situacion']);

  try {

    $db = getConnection();

    $sql = "INSERT INTO pacientes (transactionid, nombreapellido, edad, telefono, celular, calle, numeracion, barrio, tipo, fecha, lugar, patologiasprevias, date, lat, lon) 
                        VALUES (:transactionid, :nombreapellido, :edad, :telefono, :celular, :calle, :numeracion, :barrio, :tipo, :fecha, :lugar, :patologiasprevias, now(), :latitud, :longitud)";

    $stmt = $db->prepare($sql); 

    $stmt->bindParam("transactionid" , $transactionid);
    $stmt->bindParam("nombreapellido" , $nombreapellido);
    $stmt->bindParam("edad" , $edad);
    $stmt->bindParam("telefono" , $telefono);
    $stmt->bindParam("celular" , $celular);
    $stmt->bindParam("calle" , $calle);
    $stmt->bindParam("numeracion" , $numeracion);
    $stmt->bindParam("barrio" , $barrio);
    $stmt->bindParam("tipo" , $tipo);
    $stmt->bindParam("fecha" , $fecha);
    $stmt->bindParam("lugar" , $lugar);
    $stmt->bindParam("patologiasprevias" , $patologiasprevias);
    $stmt->bindParam("latitud" , $latitud);
    $stmt->bindParam("longitud" , $longitud);

    $stmt->execute();
    $count = $stmt->rowCount();



    $sql1 = "INSERT INTO seguimientos (transactionid, paciente, tipo, situacion, fecha, observaciones) VALUES
    (:situacion_transactionid, :transactionid, :tipo, :situacion, now(), :observaciones)";
    $stmt1 = $db->prepare($sql1);
    $stmt1->bindParam("situacion_transactionid",$situacion_transactionid);
    $stmt1->bindParam("transactionid",$transactionid);
    $stmt1->bindParam("tipo",$tipo);
    $stmt1->bindParam("observaciones" , $observaciones);    
    $stmt1->bindParam("situacion",$situacion);
    $stmt1->execute();


  } catch(PDOException $e) {

    echo '{"error":{"text":'. $e->getMessage() .'}}';

  }
 return $count;
}



function seguimiento($arData){

  $transactionid = generateRandomString();
  $paciente = cleanup($arData['input_transactionid_seguimiento']);
  $tipo = cleanup($arData['input_seguimiento_tipo']);
  $viacontacto = cleanup($arData['input_seguimiento_viacontacto']);
  $situacion = cleanup($arData['input_seguimiento_situacion']);
  $observaciones = cleanup($arData['input_seguimiento_observaciones']);
  $profesional = cleanup($arData['input_seguimiento_profesional']);

  try {

    $db = getConnection();

    $sql = "INSERT INTO seguimientos (transactionid, paciente, tipo, viacontacto, situacion, fecha, observaciones, profesional) VALUES
    (:transactionid, :paciente, :tipo, :viacontacto, :situacion, now(), :observaciones, :profesional)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam("transactionid",$transactionid);
    $stmt->bindParam("paciente",$paciente);
    $stmt->bindParam("tipo",$tipo);
    $stmt->bindParam("viacontacto",$viacontacto);
    $stmt->bindParam("situacion",$situacion);
    $stmt->bindParam("observaciones" , $observaciones);    
    $stmt->bindParam("profesional",$profesional);
    $stmt->execute();
    $count = $stmt->rowCount();


  } catch(PDOException $e) {

    echo '{"error":{"text":'. $e->getMessage() .'}}';

  }
 return $count;
}






function getRegistros(){

  try {

    $db = getConnection();

    $sql = "SELECT p.transactionid, p.nombreapellido, date_format(s.fecha, '%d/%m/%Y') as fecha, s.tipo, s.situacion, p.lat, p.lon
FROM
  pacientes as p,
  seguimientos AS s,
  (SELECT id, paciente, max(fecha) AS fecha FROM seguimientos GROUP BY paciente) as seg
WHERE
  DATEDIFF( CURDATE(), p.fecha ) < 15 AND
  s.paciente=p.transactionid AND
  seg.paciente=s.paciente AND
  seg.fecha=s.fecha";
    $stmt = $db->prepare($sql); 
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  } catch(PDOException $e) {

    echo '{"error":{"text":'. $e->getMessage() .'}}';

  }
  $arData['data'] = $results;
 return $arData;
}

function getMarkers(){

  try {

    $db = getConnection();

    $sql = "SELECT p.transactionid, p.nombreapellido, date_format(s.fecha, '%d/%m/%Y') as fecha, s.tipo, s.situacion, p.lat, p.lon
FROM
  pacientes as p,
  seguimientos AS s,
  (SELECT id, paciente, max(fecha) AS fecha FROM seguimientos GROUP BY paciente) as seg
WHERE
  DATEDIFF( CURDATE(), p.fecha ) < 15 AND
  s.paciente=p.transactionid AND
  seg.paciente=s.paciente AND
  seg.fecha=s.fecha";

    $stmt = $db->prepare($sql); 
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  } catch(PDOException $e) {

    echo '{"error":{"text":'. $e->getMessage() .'}}';

  }
  $arData['data'] = $results;
 return $arData;
}


function getDetalles($id){

  try {

    $db = getConnection();

    $sql = "SELECT date_format(s.fecha, '%d/%m/%Y') as fecha, s.tipo, s.situacion, s.viacontacto, s.observaciones FROM seguimientos as s WHERE s.paciente = :id  order by s.fecha desc";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam("id",$id);    
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  } catch(PDOException $e) {

    echo '{"error":{"text":'. $e->getMessage() .'}}';

  }
  $arData['data'] = $results;
 return $arData;
}



function grantHanddler($action,$grantcode,$client=''){

  if($action == "query" and $client == ""){

    try {

      $db = getConnection();

      $sql = "SELECT * FROM grants WHERE code = :grantcode";
      $stmt = $db->prepare($sql); 
      $stmt->bindParam("grantcode",$grantcode);
      $stmt->execute();
      $results = $stmt->fetchAll();
      $tResult = $stmt->rowCount();

        if($tResult == 0){
          $result = 98;
        } elseif ($results[0]['client'] != "" and $results[0]['date'] != ""){
          $result = 99;
        } else {
          $result = $tResult;
        }

    } catch(PDOException $e) {

      echo '{"error":{"text":'. $e->getMessage() .'}}';

    }

  } elseif($action == "burn" and $client != ""){

    try {

      $db = getConnection();

      $sql = "UPDATE grants SET date = now(), client = :client WHERE code = :code";

      $stmt = $db->prepare($sql); 

      $stmt->bindParam("client",$client);
      $stmt->bindParam("code",$grantcode);
      $stmt->execute();
      $result = $stmt->rowCount();

    } catch(PDOException $e) {

      echo '{"error":{"text":'. $e->getMessage() .'}}';

    }

  }

  $db = null;
  $stmt = null;
  $sql = null;

  return $result;
}



function getClientData($transactionid){


    try {

      $db = getConnection();
      $sql = "select c.name, c.lastname, c.email, c.phone, c.city, c.zipcode, c.state, c.country, c.profession, c.professionalid, c.speciality, c.workplace, t.value, g.code, g.laboratory FROM tickettypes as t, clients as c LEFT JOIN grants as g ON c.transactionid = g.client where c.transactionid = :transactionid and t.lang = 'es' and t.key = c.tickettype  order by c.id asc";
      $stmt = $db->prepare($sql); 

      $stmt->bindParam("transactionid",$transactionid);

      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

      echo '{"error":{"text":'. $e->getMessage() .'}}';

    }



  $db = null;
  $stmt = null;
  $sql = null;

  return $results;
}


function getClients(){


    try {

      $db = getConnection();
      //$sql = "select c.id, c.name, c.lastname, c.email, c.phone, c.city, c.zipcode, c.state, c.country, c.profession, c.professionalid, c.speciality, c.workplace, t.value, g.code, g.laboratory FROM tickettypes as t, clients as c LEFT JOIN grants as g ON c.transactionid = g.client where t.lang = 'es' and t.key = c.tickettype";
      $sql = "select c.name, c.lastname, c.email, c.phone, c.city, c.zipcode, c.state, c.country, c.profession, c.professionalid, c.speciality, c.workplace, t.value, g.code, g.laboratory FROM tickettypes as t, clients as c LEFT JOIN grants as g ON c.transactionid = g.client where t.lang = 'es' and t.key = c.tickettype  order by c.id asc";
      $stmt = $db->prepare($sql); 
      $stmt->execute();
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

      echo '{"error":{"text":'. $e->getMessage() .'}}';

    }



  $db = null;
  $stmt = null;
  $sql = null;

  return $results;
}

function cleanData(&$str){
  $str = preg_replace("/\t/", "\\t", $str);
  $str = preg_replace("/\r?\n/", "\\n", utf8_decode($str));
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}




function registerLogin($client,$clientIP){

  $regTransactionid = generateRandomString();
  try {

    $db = getConnection();

    $sql = "INSERT INTO logins (transactionid, user, datetime, ip) VALUES (:transactionid, :client,now(),:ip)";

    $stmt = $db->prepare($sql); 

    $stmt->bindParam("transactionid",$regTransactionid);
    $stmt->bindParam("client",$client);
    $stmt->bindParam("ip",$clientIP);

    $stmt->execute();

  } catch(PDOException $e) {

    echo '{"error":{"text":'. $e->getMessage() .'}}';

  }

    $db = null;
    $stmt = null;
    $sql = null;

    return $regTransactionid;
}


function registraLogin($usuario){

  $ipcliente = IP;

  try {

    $db = getConnection();

    $sql = "INSERT INTO logueos (usuario, fecha, hora, ip) VALUES (:usuario,now(),now(),:ip)";

    $stmt = $db->prepare($sql); 

    $stmt->bindParam("usuario",$usuario);
    $stmt->bindParam("ip",$ipcliente);

    $stmt->execute();

  } catch(PDOException $e) {

    echo '{"error":{"text":'. $e->getMessage() .'}}';

  }

    $db = null;
    $stmt = null;
    $sql = null;

}




function deslogueo(){
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }
  session_destroy();
  header("Location: /");
}


function login($arData){

    $ipuser = get_client_ip();
    $sql = "select * FROM users WHERE user = :user and password = :pass";

    try {

        $db = getConnection();
        $user = $arData['user'];
        $password = $arData['password'];
        $stmt = $db->prepare($sql); 
        $stmt->bindParam("user",$user);
        $stmt->bindParam("pass",$password);
        $stmt->execute();

        $tResults = $stmt->rowCount();

            if($tResults == 1){

                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $sql1 = "select nombre, apellido, email FROM profesionales WHERE transactionid = :transactionid";
                $stmt1 = $db->prepare($sql1); 
                $stmt1->bindParam("transactionid",$res[0]['transactionid']);
                $stmt1->execute();
                $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);

              
                  $_SESSION['nombre'] = $results[0]['nombre'];
                  $_SESSION['apellido'] = $results[0]['apellido'];
                  $_SESSION['error_login'] = false;
                  

                registerLogin($res[0]['transactionid'],$ipuser);    
                $status['login'] = "ok";
                
                echo "<script type='text/javascript'> document.location = '/app.php'; </script>";


            } else {

                $_SESSION['error_login'] = true;
                $status['login'] = "ko";

            }


        } catch(PDOException $e) {

            echo '{"error":{"text":'. $e->getMessage() .'}}';

        }

        $db = null;
        $stmt = null;
        $sql = null;

        return $status;

}


function resetContrasena($arData,$apiUrl,$urlStructure){  
 
    $urlAlt = $arData['dninro']."/".$arData['email'];

    $finalUrl = $apiUrl.$urlAlt;

    // echo $finalUrl;

    $ch = curl_init($finalUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);

    $result = json_decode($result,true);

    return $result;

}



class Post2Api {

    public $apiUrl;
    public $arData;

    public function postSetter(){
        $data_string = json_encode($this->arData);
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length:'.strlen($data_string)));
        $result = curl_exec($ch);

        return $result;

    }   


}



function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>