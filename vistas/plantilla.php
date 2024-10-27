<!DOCTYPE html>
<html lang="ESP" >

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Autogeneracion pequena escala - Ruitoque SA ESP</title>
  <meta name="description" content="Sistema de abastecimiento"/>
  <meta name="author" content="SoftFocus Corporation"/>
  <meta name="copyright" content="SoftFocus, inc. Copyright (c) 2018"/>
  <meta name="keywords" content="Sistema Pegaso,ruitoque,aseo,agua,energia,alcantarillado" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Include Bootstrap CSS 
  <link rel="stylesheet" href="vistas/css/bootstrap.css"  type="text/css" /> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-datepicker/css/bootstrap-datepicker.css">

  <!-- Include SmartWizard CSS -->
  <link href="vistas/css/smart_wizard.css" rel="stylesheet" type="text/css" />

  <!-- Optional SmartWizard theme -->
  <link href="vistas/css/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css" />
  <link href="vistas/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
  <link href="vistas/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="vistas/js/alert/dist/sweetalert.css">
  <link rel="stylesheet" href="vistas/css/jquery.alerts.css">
  <link rel="stylesheet" href="vistas/css/loading.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- js -->
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="vistas/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="vistas/js/alert/dist/sweetalert.min.js"></script>
    <script src="vistas/js/myscript.js"></script>
    <script src="vistas/js/loading.js"></script>
    <script src="vistas/js/validations.js"></script>

    <!--<script src="vistas/js/consultas.js"></script>
     Include jQuery Validator plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.js"></script>
    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="vistas/js/jquery.smartWizard.js"></script>
    <script src="vistas/js/jquery.blockUI.js" type="text/javascript"></script>
    <script type="text/javascript">
        var lati_global="";
        var lngi_global="";
        var codigo_transformador_global="";
        var dispo_potencia_global="";
        var dispo_energia_global="";
    </script> 
        <style>
              /* Always set the map height explicitly to define the size of the div
               * element that contains the map. */
              #map {
               position: relative;
              }
              /* Optional: Makes the sample page fill the window. */
              html, body {
                height: 100%;
                margin: 0;
                padding: 0;
              }
              
              
            </style>



</head>

<body>
    <div class="container">
        <br />
<?php

  if(isset($_GET["ruta"])){

    if($_GET["ruta"] == "inicio"){

      include "modulos/".$_GET["ruta"].".php";

    }else{

      include "modulos/404.php";

    }

  }else{

    include "modulos/inicio.php";

  }
  ?>
</div>



</body>
</html>