<?php
@session_start();
include("includes/_vars.php");
include("includes/functions.php");
if(isset($_SESSION['token']) && @$_POST['token'] == $_SESSION['token']){

  if(isset($_POST) and $_POST['user'] != "" and $_POST['password'] != ""){
  $data['login'] = "";

  $data = login($_POST);
    
      if($data['login'] == "ok"){

        header("Location: /app.php");

      } else {

        $status['login'] = "ko";
        $_SESSION['error_login'] = true;
        header("Location: /");
      }

  } else {
    header("Location: /");
  }
} else {
  $token = md5(uniqid(rand(), true));
  $_SESSION['token'] = $token;
  ?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>   
<title>J.GEEKS - RSE Campaign 2020 Against COVID-19</title></head>
<body>
    <div class="container pt-5 mt-5">
        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                      <img src="/images/logo-gestion.png" class="img-fluid my-2">
                      <p class="text-muted text-center">Sistema de registro siguimiento de pacientes COVID-19</p>
                        <form method="post" action="/" name="fLogin" id="idfLogin">
                          <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <div class="form-group">
                              <input type="email" name="user" id="iduemail" placeholder="Usuario / Dirección de e-mail" class="form-control" required >
                            </div>
                            <div class="form-group">
                              <input type="password" name="password" id="iduclave" placeholder="Clave" class="form-control" required>            
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm float-right">Ingresar</button>
                        </form>
                    </div>

                </div>

            </div>    
    </div>  
      <div class="row mt-5">
        <div class="col text-center" style="font-size:11px;"><img src="/images/jgeeks-logo.svg" alt="Acción de RSE - J.Geeks Software factory" width="76"><p class="text-muted"><small>Acción de RSE - Servir a la sociedad con productos útiles y en condiciones justas.<br>J.Geeks &reg; | Copyrights 2020</small></p></div>
      </div>    
    </div>
  <?php
 }
?>
</body>
</html>