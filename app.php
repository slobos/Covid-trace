<?php
@session_start();

if(isset($_SESSION) and $_SESSION['nombre'] != "" and $_SERVER['HTTP_REFERER'] == ""){
  header("Location: /logout.php");
}else{
  $logged = true;
}
include('includes/securiza.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

    <script src="https://kit.fontawesome.com/31d77c1012.js" crossorigin="anonymous"></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      label {
        font-family: 'Roboto', sans-serif;
        font-weight:600;
        font-size:0.9em;
        color:#333
      }
      input, select {
        font-family: 'Maven Pro', sans-serif;
      }
    .btn-custom, h4 {
        font-family: 'Roboto', sans-serif;
        font-weight:500;
        font-size:0.9em;
        text-transform:uppercase;
      }

      .text-muted span {
        color:#666 !important;
      }

.inc_map {
    height: 100%;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
    }
.map-container{
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* Ratio 16:9 ( 100%/16*9 = 56.25% ) */
}
.map-container > *{
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    margin: 0;
    padding: 0;
    height: 100%;
    width: 100%;
} 

/* The switch - the box around the slider */
.switch {
  margin-left: 5px;
  margin-right: 8px;
  position: relative;
  display: inline-block;
  width: 30px;
  height: 17px;
  float:right;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 13px;
  width: 13px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input.default:checked + .slider {
  background-color: #444;
}
input.primary:checked + .slider {
  background-color: #2196F3;
}
input.success:checked + .slider {
  background-color: #8bc34a;
}
input.info:checked + .slider {
  background-color: #3de0f5;
}
input.warning:checked + .slider {
  background-color: #FFC107;
}
input.danger:checked + .slider {
  background-color: #f44336;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(13px);
  -ms-transform: translateX(13px);
  transform: translateX(13px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 17px;
}

.slider.round:before {
  border-radius: 50%;
}

    </style>
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>COVID-19</title>
  </head>
  <body>
    

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/app.php"><img src="/images/logo-gestion.png" width="180"></a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-0 mt-lg-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Capas mapa
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <div class="dropdown-item">
            <label class="switch">
                <input type="checkbox" class="primary layer_switch" value="groupejc" id="viewEjc">
                <span class="slider round"></span>
            </label><label for="viewEjc">Municipio</label>
          </div>
          <div class="dropdown-item">
            <label class="switch">
                <input type="checkbox" class="primary layer_switch" value="covidpositivo" id="viewCovidEjc">
                <span class="slider round"></span>
            </label>
            <label for="viewCovidEjc">Covid-19</label>
          </div>
          <div class="dropdown-item">
            <label class="switch">
                <input type="checkbox" class="primary layer_switch" value="heatgarbagemap" id="viewHeatgarbagemap">
                <span class="slider round"></span>
            </label><label for="viewHeatgarbagemap">Impacto</label>
          </div>
        </div>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="#gestion">Gestionar información</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto mt-0 mt-lg-0">
      <li class="nav-item mt-2 mr-2">
        Bienvenid@ <?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];?>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout.php"><i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </div>
</nav>
    <div class="container-fluid mt-0 px-0">

      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="map-container">
            <div class="inc_map" id="map"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-12">
            <div id="message"></div>
        </div>
      </div>

      <a name="gestion"></a>
      <div class="row px-4">
        <div class="col-12 col-lg-6 mt-5">
          <h5>Alta de nuevo COVID-19 / Contacto estrecho</h5>
          <?php
          if(!isset($token)){          
            $token = md5(uniqid(rand(), true));
            $_SESSION['token'] = $token;
          }
          ?>
          <form method="post" id="id_form_alta" enctype="multipart/form-data">
          <input type="hidden" name="token" value="">
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_nombreapellido" id="id_input_nombreapellido">
                  <label for="id_input_nombreapellido" class="text-muted"><span>Nombre/s Apellido/s (*)</span></label>
                </div>
              </div>
              <div class="col-12 col-lg-3">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_dninumero" id="id_input_dninumero">
                  <label for="id_input_dninumero" class="text-muted"><span>DNI Nro. (*)</span></label>
                </div>
              </div>              
              <div class="col-12 col-lg-3">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_edad" id="id_input_edad">
                  <label for="id_input_edad" class="text-muted"><span>Edad</span></label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_telefono" id="id_input_telefono">
                  <label for="id_input_telefono" class="text-muted"><span>Teléfono</span></label>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_celular" id="id_input_celular">
                  <label for="id_input_celular" class="text-muted"><span>Celular (*)</span></label>
                </div>
              </div>
            </div>            
            <div class="row">
              <div class="col-12 col-lg-5">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_calle" id="id_input_calle">
                  <label for="id_input_calle" class="text-muted"><span>Calle (*)</span></label>
                </div>
              </div>
              <div class="col-12 col-lg-3">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_numeracion" id="id_input_numeracion">
                  <label for="id_input_numeracion" class="text-muted"><span>Numeración (*)</span></label>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="form-group">
                  <select name="input_barrio" id="id_input_barrio" class="form-control">
                      <option value=""></option>
                      <option>Almirante Brown</option>
                      <option>Barrio Parque Norte</option>
                      <option>Ciudad de los Niños</option>
                      <option>Ciudad Oculta</option>
                      <option>IPV 24 de Enero</option>
                      <option>Juárez Celman</option>
                      <option>La Pampeana</option>
                      <option>Luján</option>
                      <option>Primero de Agosto</option>
                      <option>Residencial Rural</option>
                      <option>Villa Los Llanos</option>
                      <option>Villa Pastora</option>
                  </select>                    
                  <label for="id_input_barrio" class="text-muted"><span>Barrio (*)</span></label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-5">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_latitud" id="id_input_latitud" readonly>
                  <label for="id_input_latitud" class="text-muted"><span>Latitud (*)</span></label>
                </div>
              </div>
              <div class="col-12 col-lg-5">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_longitud" id="id_input_longitud" readonly>
                  <label for="id_input_longitud" class="text-muted"><span>Longitud (*)</span></label>
                </div>
              </div>
              <div class="col-12 col-lg-1">
                  <button class="btn-outline-success btn" id="btnGetll" type="button" type="button"><i class="fas fa-map-pin"></i></button>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-lg-4">
                <div class="form-group">
                  <select name="input_covidtipo" id="id_input_covidtipo" class="form-control">
                      <option value=""></option>
                      <option>Positivo</option>
                      <option>Contacto estrecho</option>
                  </select>
                  <label for="id_input_covidtipo" class="text-muted"><span>COVID-19 (*)</span></label>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_fecharesultado" id="id_input_fecharesultado">
                  <label for="id_input_fecharesultado" class="text-muted"><span>Fecha de resultado</span></label>
                </div>
              </div> 
              <div class="col-12 col-lg-4">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="id_input_patologiasprevias1" name="input_patologiasprevias" class="custom-control-input" value="Si">
                  <label class="custom-control-label" for="id_input_patologiasprevias1">Si</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="id_input_patologiasprevias2" name="input_patologiasprevias" class="custom-control-input" value="No">
                  <label class="custom-control-label" for="id_input_patologiasprevias2">No</label>
                </div>
                  <label for="id_input_patologiasprevias" class="text-muted mt-3"><span>Patologías previas</span></label>
              </div> 
            </div>             
            <div class="row">
              <div class="col-12 col-lg-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_lugaranalisis" id="id_input_lugaranalisis">
                  <label for="id_input_lugaranalisis" class="text-muted"><span>Lugar de análisis</span></label>
                </div>
              </div>
              <div class="col-12 col-lg-4">                
                  <select name="input_situacion" id="id_input_situacion" class="form-control">
                      <option value=""></option>
                      <option>Hospitalizado</option>
                      <option>Domicilio</option>
                      <!-- <option>Alta</option>
                      <option>Fallecido</option> -->
                  </select> 
                <label for="id_input_situacion" class="text-muted"><span>Situación actual Covid-19</span></label>
              </div>
              <div class="col-12 col-lg-4">
                <div class="form-group">
                  <input type="text" class="form-control" name="input_fechaposiblealta" id="id_input_fechaposiblealta">
                  <label for="id_input_fechaposiblealta" class="text-muted"><span>Fecha posible Alta</span></label>
                </div>
              </div> 

            </div>   
            <div class="row">
              <div class="col-12 col-lg-12">
                <div class="form-group">
                  <textarea name="input_observaciones" id="id_input_observaciones" class="form-control"></textarea>
                  <label for="id_input_observaciones" class="text-muted"><span>Observaciones</span></label>
                </div>
              </div>
            </div>   
            <div class="col-12 col-lg-12">
              <div class="row justify-content-end">
                <div class="col-6">
                  <button class="btn btn-secondary form-control btn-custom" type="reset">Cancelar</button>
                </div>
                <div class="col-6">
                  <button class="btn btn-primary form-control btn-custom" type="submit">Enviar</button>
                </div>
              </div>  
            </div>
          </form>
        </div>
        <div class="col-12 col-lg-6 mt-5">
          <h5>Listado para seguimiento</h5>
            <table id="registros" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Posible Alta</th>
                        <th>Nombre</th>
                        <th>DNI Nro</th>
                        <th>Estado</th>
                        <th>Situación</th>
                        <td></td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Posible Alta</th>
                        <th>Nombre</th>
                        <th>DNI Nro</th>
                        <th>Estado</th>
                        <th>Situación</th>
                        <td></td>
                    </tr>
                </tfoot>
            </table>          
        </div>
      </div>

      <div class="row mt-5">
        <div class="col text-center"><img src="/images/jgeeks-logo.svg" alt="Acción de RSE - J.Geeks Software factory" width="76"><p class="text-muted"><small>Acción de RSE - Servir a la sociedad con productos útiles y en condiciones justas.<br>J.Geeks &reg; | Copyrights 2020</small></p></div>
      </div>
    </div>



<div class="modal fade" id="viewUpdates" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seguimiento de paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-12">
          <p><span id="dir1"></span> <span id="tel1"></span></p>
          <div id="data">
            <table id="detallesUpdates" class="stripe responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Vía de contacto</th>
                        <th>Tipo</th>
                        <th>Seguimiento</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Vía de contacto</th>
                        <th>Tipo</th>
                        <th>Seguimiento</th>
                        <th>Observaciones</th>
                    </tr>
                </tfoot>
            </table>              
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="setUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seguimiento de paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-lg-12">
              <div id="message_seguimiento"></div>
          </div>
        </div>

        <div class="row">
          <div class="col-5 pb-3">
        <p><span id="dir1"></span> <span id="tel1"></span></p>
        <form id="id_form_seguimiento">
          <input type="hidden" class="form-control" name="input_transactionid_seguimiento" id="tId">
          <input type="hidden" class="form-control" name="input_seguimiento_tipo" id="iSt">
          <input type="hidden" class="form-control" name="input_seguimiento_profesional" value="<?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];?>" id="id_input_seguimiento_profesional">

          <div class="row">
            <div class="col-12 col-lg-6">
              <div class="form-group">
                <label for="id_input_seguimiento_fecha" class="text-muted"><span>Fecha de contacto</span></label>
                <input type="text" class="form-control" name="input_seguimiento_fecha" id="id_input_seguimiento_fecha">
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="form-group">
                <label for="id_input_profesional" class="text-muted"><span>Profesional</span></label>
                <input type="text" class="form-control" value="<?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];?>" disabled>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6">
              <div class="form-group">
                <label for="id_input_situacion" class="text-muted"><span>Situación actual Covid-19</span></label>
                  <select name="input_seguimiento_situacion" id="id_input_seguimiento_situacion" class="form-control">
                      <option value=""></option>
                      <option>Hospitalizado</option>
                      <option>Domicilio</option>
                      <option>Alta</option>
                      <option>Fallecido</option>
                  </select>                
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="form-group">
                <label for="id_input_seguimiento_viacontacto" class="text-muted"><span>Vía de contacto</span></label>
                  <select name="input_seguimiento_viacontacto" id="id_input_seguimiento_viacontacto" class="form-control">
                      <option value=""></option>
                      <option>Llamado telefónico</option>
                      <option>Mensajería Whatsapp</option>
                      <option>Visita presencial</option>
                  </select>                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-8">
              <div class="form-group">
                <label for="id_input_seguimiento_posiblealta" class="text-muted"><span>Fecha de posible Alta</span></label>
                <input type="text" class="form-control" name="input_seguimiento_posiblealta" id="id_input_seguimiento_posiblealta">
              </div>
            </div>
          </div>          
          <div class="form-group">
            <label for="id_input_seguimiento_observaciones" class="col-form-label">Observaciones:</label>
            <textarea class="form-control" rows="4" id="id_input_seguimiento_observaciones" name="input_seguimiento_observaciones"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Guardar datos</button>
        </form>
        </div>
        <div class="col-7">
          <div id="data">
            <table id="detalles" class="stripe responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Observaciones</th>
                    </tr>
                </tfoot>
            </table>              
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.js"></script>    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOcZMGig9F6le9fV4YOHIopRES_6wg1w8&libraries=visualization,geometry" type="text/javascript"></script>   
    <script type="text/javascript" src="/js/google-maps-js_radius_from_meters_to_pixels.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>    


    <script>
  $(document).ready(function() {

    var refresh_interval;

    function update_table() {
      $('#registros').DataTable().ajax.reload();
      clearInterval(refresh_interval);
    }

const detalles = 
     $('#detalles').DataTable( {
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            responsive: true,
            "ajax":{
            "url": "/dummy.json",
            "type": "GET"
            },
            "columns": [                
              {"data":"fecha","width":"10%"},
              {"data":"observaciones"},
            ],
            "autoWidth": false,
            "fixedHeader": {
                "header": false,
                "footer": false
            },
            "columnDefs": [
              { "width": "10%", "targets": 0 },
              { "width": "90%", "targets": 1 }
            ],            
             order: [[ 0, 'desc' ]]       
      } );



    $('#setUpdate').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var tId = button.data('transactionid');
      var tipo = button.data('tipo');
      var pName = button.data('paciente');
      var telefonos = button.data('telefonos');
      var direccion = button.data('direccion');
      var pAlta = button.data('posiblealta');
      var modal = $(this)
      modal.find('.modal-title').text('Seguimiento de paciente ' + pName )
      modal.find('.modal-body #tId').val(tId);
      modal.find('.modal-body #tel').text('Tel: '+telefonos);
      modal.find('.modal-body #dir').text('Dirección: '+direccion);
      modal.find('.modal-body #id_input_seguimiento_posiblealta').val(pAlta);


      detalles.ajax.url("/detalles.php?UID="+tId).load();

    })
 
    const detalleTable=$('#detallesUpdates').DataTable( {
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            responsive: true,
            "ajax":{
            "url": '/dummy.json',
            "type": "GET"
            },

            "columns": [                
              {"data":"fecha","width":"10%"},
              {"data":"viacontacto","width":"10%"},
              {"data":"tipo","width":"10%"},
              {"data":"situacion","width":"10%"},
              {"data":"observaciones"},
            ],
            "autoWidth": false,
            "fixedHeader": {
                "header": false,
                "footer": false
            },
            "columnDefs": [
              { "width": "10%", "targets": 0 },
              {"width":"20%","targets":1},
              {"width":"10%","targets":2},
              {"width":"10%","targets":3},
              { "width": "50%", "targets": 4 }
            ],            
             order: [[ 0, 'desc' ]]       
      } );
    $('#viewUpdates').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var tId1 = button.data('transactionid');
      var pName = button.data('paciente');
      var telefonos = button.data('telefonos');
      var direccion = button.data('direccion');
      var modal = $(this)
      modal.find('.modal-title').text('Seguimiento de paciente ' + pName )
      modal.find('.modal-body #tId1').val(tId1);
      modal.find('.modal-body #tel1').text('Tel: '+telefonos);
      modal.find('.modal-body #dir1').text('Dirección: '+direccion);
      
      detalleTable.ajax.url("/detalles.php?UID="+tId1).load();

    });
 

    $("#id_form_alta").validate({
      rules: {        
        input_nombreapellido: {
          required: true,
          minlength: 3
        },
        input_dninumero: {
          required: true,
          minlength: 6
        },
        input_celular: {
          required: true,
          minlength: 3
        },
        input_calle: {
          required: true,
          minlength: 3
        },
        input_numeracion: {
          required: true
        },
        input_barrio: {
          required: true
        },
        input_covidtipo: {
          required: true
        },
        input_latitud: {
          required: true
        },
        input_longitud: {
          required: true
        }
      },
      messages: {
        input_nombreapellido: "Ingrese nombre y apellido",
        input_dninumero: "Definir",
        input_celular: "Ingrese número de celular",
        input_calle: "Ingrese calle",
        input_numeracion: "Numeración",
        input_barrio: "Seleccione Barrio",
        input_covidtipo: "Seleccione",
        input_latitud: "Definir",
        input_longitud: "Definir",
      },
          submitHandler: function(form) {

            url='/alta.php';
            
            let my_form = document.getElementById('id_form_alta');
            let form_data = new FormData(my_form);            

            $.ajax({
              method: 'POST',
              url: url,
              data: form_data,
              processData: false,
              contentType: false,
            }).done(function(res) {
              if(res.status=='ok') {                
              
              show_message('OK');  
              refresh_interval=setInterval(update_table,2500);

              $('#id_form_alta').trigger("reset");

              } else {
                alert("error");
              }
            }); 

            return false;                 
          }
    });



    $("#id_form_seguimiento").validate({
      rules: {
        input_seguimiento_fecha: {
          required: true
        },
        input_seguimiento_viacontacto: {
          required: true
        },
        input_seguimiento_situacion: {
          required: true
        },
        input_seguimiento_observaciones: {
          required: true
        }
      },
      messages: {
        input_seguimiento_fecha: "Definir",
        input_seguimiento_viacontacto: "Seleccionar",
        input_seguimiento_situacion: "Seleccionar",
        input_seguimiento_observaciones: "Completar",
      },
          submitHandler: function(form) {

            url='/seguimiento.php';
            
            let my_form = document.getElementById('id_form_seguimiento');
            let form_data = new FormData(my_form);            

            $.ajax({
              method: 'POST',
              url: url,
              data: form_data,
              processData: false,
              contentType: false,
            }).done(function(res) {
              if(res.status=='ok') {                
              
              show_message_seguimiento('Se registro correctamente el seguimiento del paciente.');  
              
              detalles.ajax.reload();

              $('#id_form_seguimiento').trigger("reset");

              } else {
                alert("error");
              }
            }); 

            return false;                 
          }
    });


  });




    function show_message(msg) {
      $('#message').show();
      $('#message').addClass('alert alert-success');              
      $('#message').html(msg);        
      $('#message').fadeOut(7000);
    }
    function show_message_seguimiento(msg) {
      $('#message_seguimiento').show();
      $('#message_seguimiento').addClass('alert alert-success');              
      $('#message_seguimiento').html(msg);        
      $('#message_seguimiento').fadeOut(7000);
    }

    var rendered_groupzones=false;
    var markers=[];
    var myLayers=new google.maps.MVCObject();

    const map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: new google.maps.LatLng(-31.2663498,-64.1590545),
          zoomControl: true,
          mapTypeControl: false,
          scaleControl: true,
          streetViewControl: false,
          rotateControl: false,
          fullscreenControl: true,
          styles: [{ "featureType": "administrative", "elementType": "geometry", "stylers": [{"visibility": "off"} ]},{ "featureType": "administrative", "elementType": "labels", "stylers": [{"visibility": "on"} ]},{ "featureType": "administrative", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ]},{ "featureType": "administrative.neighborhood", "stylers": [{"visibility": "off"} ]},{ "featureType": "poi", "stylers": [{"visibility": "off"} ]},{ "featureType": "poi", "elementType": "labels.text", "stylers": [{"visibility": "off"} ]},{ "featureType": "road", "elementType": "labels", "stylers": [{"visibility": "off"} ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ]},{ "featureType": "transit", "stylers": [{"visibility": "off"} ]},{ "featureType": "water", "elementType": "labels.text", "stylers": [{"visibility": "off"} ]}]
    });


    myLayers.setValues({groupejc:map,covidpositivo:map,heatgarbagemap:map});



    $(document).ready(function() {

    $('#registros').DataTable( {
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
          },
          "ajax":{
            "url": "/registros.php",
          "type": "GET"
          },
          "columns": [                
            {"data":"fecha"},
            {
            data: 'fechaalta',
            type: 'date',
            render: function (data, type, row) { return data ? moment(data).format('DD/MM/YYYY') : ''; }},
            {"data":"nombreapellido"},
            {"data":"dni"},
            {"data":"tipo"},
            {"data":"situacion"},
          ],
          "columnDefs": [
            {
              "targets":6,
              "orderable":false,
              "render": function ( data, type, row ) {
                if(row.situacion != "Fallecido" && row.situacion != "Alta"){             
                  return '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#setUpdate" data-transactionid="'+row.transactionid+'" data-paciente="'+row.nombreapellido+'" data-tipo="'+row.tipo+'" data-telefonos="'+row.telefonos+'" data-direccion="'+row.direccion+'" data-posiblealta="'+row.fechaalta+'"><i class="far fa-edit"></i></button>';
                } else {
                  return '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewUpdates" data-transactionid="'+row.transactionid+'" data-paciente="'+row.nombreapellido+'"  data-telefonos="'+row.telefonos+'" data-direccion="'+row.direccion+'"><i class="fas fa-eye"></i></button>';
                }
              }

            }
          ],
           order: [[ 0, 'desc' ]]       
    } );


        $('.layer_switch').click(function(){
            if(this.value=='groupejc') {

              render_groupzones('ejc','#537FA3','#006b00');
              rendered_groupzones=true;
            }          
           
            myLayers.set(this.value,(this.checked)?map:null); 
        });

        const geocoder = new google.maps.Geocoder();
        document.getElementById("btnGetll").addEventListener("click", () => {

          var stt = document.getElementById("id_input_calle").value;
          var num = document.getElementById("id_input_numeracion").value;
          var e = document.getElementById("id_input_barrio");
          var nei = e.options[e.selectedIndex].value;

          if(stt == "" || num == "" || nei == ""){            
            alert("Para obtener los puntos de latitud y longitud\nDebe definir los campos Calle, Numeración y Barrio");
            throw new Error("Campos incompletos");
          }

          var add = stt+' '+num+', '+nei+' Estacion juarez celman cordoba argentina';
          geocodeAddress(add);
        });


        function geocodeAddress(address) {
          geocoder.geocode(
            {
              address: address,
            },
            (results, status) => {
              if (status === "OK") {
                document.getElementById("id_input_latitud").value = results[0].geometry.location.lat();
                document.getElementById("id_input_longitud").value = results[0].geometry.location.lng();
              } else {
                alert(
                  "Geocode was not successful for the following reason: " + status
                );
              }
            }
          );
        }
        function render_groupzones(file,fill="#330000",stroke="",hide=false){

            if(stroke == ''){
                stroke = fill;
            }

            $.get("/kml/"+file+".json", function(res){
                res.data.forEach(function (group){

                    var path = new Array();
                        group.location.forEach(function (rendergroup){
                            path.push(new google.maps.LatLng(rendergroup.lat,rendergroup.lon));
                        });
                        var poly = new google.maps.Polygon({
                            path: path,
                            strokeColor: stroke,
                            strokeOpacity: 1,
                            strokeWeight: 1,
                            fillColor: fill,
                            fillOpacity: 0.2
                        });

                       poly.bindTo('map',myLayers,'group'+file);
                       if(hide) {
                            myLayers.set('group'+file,null);    
                       }
                })
            })

        };
        
        
    });


 //contenedores
        function render_markers(type,filter){
            $.get("/markers.php", function(res){              
                res.data.forEach(function (paciente){              

                  if(paciente.tipo == 'Positivo' && paciente.situacion == 'Domicilio'){
                    var markerfile = 'positivo-domicilio';
                  } else if(paciente.tipo == 'Positivo' && paciente.situacion == 'Hospitalizado'){
                    var markerfile = 'positivo-domicilio';                       
                  } else if(paciente.situacion == 'Fallecido'){
                    var markerfile = 'fallecido';                       
                  } else if(paciente.tipo == 'Contacto estrecho'){
                    var markerfile = 'contacto';
                  } else if(paciente.situacion == 'Alta'){
                    var markerfile = 'alta';
                  }
                  

                    url="/images/"+markerfile+".svg";

                    var icon={
                        url:url,
                        scaledSize: new google.maps.Size(16, 16),
                        scale: 1
                    };
                    marker=new google.maps.Marker({
                        position: new google.maps.LatLng(paciente.lat,paciente.lon),
                        map: map,
                        icon: icon
                    });

                    marker.bindTo('map',myLayers,'covid'+type);           
                    myLayers.set('covid'+type,null);    

                    marker.addListener('click', function() {
                        if(paciente.tipo == 'Positivo' && paciente.situacion == 'Domicilio'){
                          var markerfile = 'positivo-domicilio';
                        } else if(paciente.tipo == 'Positivo' && paciente.situacion == 'Hospitalizado'){
                          var markerfile = 'positivo-domicilio';                       
                        } else if(paciente.situacion == 'Fallecido'){
                          var markerfile = 'fallecido';                       
                        } else if(paciente.tipo == 'Contacto estrecho'){
                          var markerfile = 'contacto';
                        } else if(paciente.situacion == 'Alta'){
                          var markerfile = 'alta';
                        }                                       
                        var visible;
                        var information = new google.maps.InfoWindow({
                        content: '<div class="container p-0 m-0" style="font-family:Roboto;font-size:0.9em;">'+
                        '<div class="row my-2 mx-2">'+
                        '   <div class="col-10 text-left">'+
                        '       Paciente: <strong>'+ paciente.nombreapellido+'</strong>'+
                        '   </div>'+
                        '   <div class="col-2 p-0 text-center">'+
                        '       <img src="/images/'+markerfile+'.svg" width="32" height="32">'+
                        '   </div>'+
                        '</div>'    

                        });
                       information.open(map, this);           
                    });
                    return marker;

                });
            })
        }
        render_markers('positivo');



    //heatmap impacto basurales
    var pointarray, heatgarbagemap;
    var TILE_SIZE = 256;

    var dataPoints = new Array();
    $.get("/markers.php", function(res){
        res.data.forEach(function (heatbasural){
            dataPoints.push(new google.maps.LatLng(heatbasural.lat,heatbasural.lon));
        });

          pointArray = new google.maps.MVCArray(dataPoints);

          heatgarbagemap = new google.maps.visualization.HeatmapLayer({
              data: pointArray,
              radius: getNewRadius()
          });
          
          google.maps.event.addListener(map, 'zoom_changed', function () {
              heatgarbagemap.setOptions({radius:getNewRadius()});
          });                

          heatgarbagemap.bindTo('map',myLayers,'heatgarbagemap');
          myLayers.set('heatgarbagemap',null);
        
    })

      //Mercator --BEGIN--
      function bound(value, opt_min, opt_max) {
          if (opt_min !== null) value = Math.max(value, opt_min);
          if (opt_max !== null) value = Math.min(value, opt_max);
          return value;
      }

      function degreesToRadians(deg) {
          return deg * (Math.PI / 180);
      }

      function radiansToDegrees(rad) {
          return rad / (Math.PI / 180);
      }

      function MercatorProjection() {
          this.pixelOrigin_ = new google.maps.Point(TILE_SIZE / 2,
          TILE_SIZE / 2);
          this.pixelsPerLonDegree_ = TILE_SIZE / 360;
          this.pixelsPerLonRadian_ = TILE_SIZE / (2 * Math.PI);
      }

      MercatorProjection.prototype.fromLatLngToPoint = function (latLng,
      opt_point) {
          var me = this;
          var point = opt_point || new google.maps.Point(0, 0);
          var origin = me.pixelOrigin_;

          point.x = origin.x + latLng.lng() * me.pixelsPerLonDegree_;

          // NOTE(appleton): Truncating to 0.9999 effectively limits latitude to
          // 89.189.  This is about a third of a tile past the edge of the world
          // tile.
          var siny = bound(Math.sin(degreesToRadians(latLng.lat())), - 0.9999,
          0.9999);
          point.y = origin.y + 0.5 * Math.log((1 + siny) / (1 - siny)) * -me.pixelsPerLonRadian_;
          return point;
      };

      MercatorProjection.prototype.fromPointToLatLng = function (point) {
          var me = this;
          var origin = me.pixelOrigin_;
          var lng = (point.x - origin.x) / me.pixelsPerLonDegree_;
          var latRadians = (point.y - origin.y) / -me.pixelsPerLonRadian_;
          var lat = radiansToDegrees(2 * Math.atan(Math.exp(latRadians)) - Math.PI / 2);
          return new google.maps.LatLng(lat, lng);
      };

      //Mercator --END--


      var desiredRadiusPerPointInMeters = 100;
      function getNewRadius() {
          
          
          var numTiles = 1 << map.getZoom();
          var center = map.getCenter();
          var moved = google.maps.geometry.spherical.computeOffset(center, 10000, 90); /*1000 meters to the right*/
          var projection = new MercatorProjection();
          var initCoord = projection.fromLatLngToPoint(center);
          var endCoord = projection.fromLatLngToPoint(moved);
          var initPoint = new google.maps.Point(
            initCoord.x * numTiles,
            initCoord.y * numTiles);
           var endPoint = new google.maps.Point(
            endCoord.x * numTiles,
            endCoord.y * numTiles);
        var pixelsPerMeter = (Math.abs(initPoint.x-endPoint.x))/10000.0;
        var totalPixelSize = Math.floor(desiredRadiusPerPointInMeters*pixelsPerMeter);
        //console.log(totalPixelSize);
        return totalPixelSize;
         
      }

          var circles = [];
          function circleTest() {
            //yeah, didn't put much effort into this part >_>
            
             if (circles.length)
            {
                for (i = 0;i < circles.length; ++i)
                    circles[i].setMap(null);
                circles = [];
            }   
             else
             {
                for (i = 0;i < data.length; ++i)
                    circles[i] = new google.maps.Circle({
                        map:map,
                        radius:desiredRadiusPerPointInMeters,
                        fillColor:"#000000",
                        center: data[i]
                    });
             }
          }


$(function() {
  $('input[name="input_fecharesultado"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "customRangeLabel": "Personalizado",
        "weekLabel": "W",
        "daysOfWeek": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    autoApply: true,
    minDate: "07/31/2020",
    maxDate: moment()
  })


  $('input[name="input_fechaposiblealta"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "customRangeLabel": "Personalizado",
        "weekLabel": "W",
        "daysOfWeek": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    autoApply: true
  })

  $('input[name="input_seguimiento_posiblealta"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "customRangeLabel": "Personalizado",
        "weekLabel": "W",
        "daysOfWeek": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    autoApply: false,
    autoUpdateInput: false,
  })

  $('input[name="input_seguimiento_fecha"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "customRangeLabel": "Personalizado",
        "weekLabel": "W",
        "daysOfWeek": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    autoApply: false,
    minDate: "07/31/2020",
    maxDate: moment()
  })  
});
        

    </script>    
  </body>
</html>
