<?php
if( isset($_GET['codigo_transformador']) )
  {
    get_transformador($_GET['codigo_transformador']);
  }
else if( isset($_GET['codigo_usuario']) )
 {
   get_usuarios($_GET['codigo_usuario']);
 }
else {
    die("Solicitud no válida.");
}

function get_transformador( $id )
 {
   //Cambia por los detalles de tu base datos

  $jsondata = array();
  //Sanitize ipnut y preparar query
  /*if( is_array($id) ) {
    $id = array_map('intval', $id);
    $querywhere = "WHERE codigo_transformador IN (" . implode( ',', $id ) . ")";
  } else {
    $id = intval($id);
    $querywhere = "WHERE codigo_transformador = " . $id;
  }*/
$querywhere = "WHERE codigo_transformador = '" . $id."'";
  if ( $result = $database->query( "SELECT * FROM transformador " . $querywhere ) ) {

  if( $result->num_rows > 0 ) {

    $jsondata["success"] = true;
    //$jsondata["data"]["message"] = sprintf("Se han encontrado %d transformador", $result->num_rows);
    $jsondata["data"]["transformador"] = array();
    while( $row = $result->fetch_object() ) {
       //$jsondata["data"]["users"][] es un array no asociativo. Tendremos que utilizar JSON_FORCE_OBJECT en json_enconde
       //si no queremos recibir un array en lugar de un objeto JSON en la respuesta
       //ver http://www.php.net/manual/es/function.json-encode.php para más info
       $jsondata["data"]["transformador"][] = $row;
     }

   } else {

     $jsondata["success"] = false;
     $jsondata["data"] = array(
       'message' => 'No se encontró ningún resultado.'
     );

   }

   $result->close();

  } else {

    $jsondata["success"] = false;
    $jsondata["data"] = array(
      'message' => $database->error
    );

  }

  header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);

  $database->close();

}

function get_usuarios( $id )
 {
   //Cambia por los detalles de tu base datos
   $dbserver = "localhost";
   $dbuser = "admin_pegaso";
   $password = "ruit#od#2001601";
   $dbname = "autogeneracion";
   $database = new mysqli($dbserver, $dbuser, $password, $dbname);
   if($database->connect_errno) {
     die("No se pudo conectar a la base de datos");
   } 
  $jsondata = array();
  //Sanitize ipnut y preparar query
  /*if( is_array($id) ) {
    $id = array_map('intval', $id);
    $querywhere = "WHERE codigo_transformador IN (" . implode( ',', $id ) . ")";
  } else {
    $id = intval($id);
    $querywhere = "WHERE codigo_transformador = " . $id;
  }*/
//$querywhere = "WHERE codigo_transformador = '" . $id."'";
  if ( $result = $database->query( "SELECT tran.* from Usuario usu left join transformador tran on usu.transformador=tran.codigo_transformador where usu.niu=" . $id ) ) {

  if( $result->num_rows > 0 ) {

    $jsondata["success"] = true;
    //$jsondata["data"]["message"] = sprintf("Se han encontrado %d transformador", $result->num_rows);
    $jsondata["data"]["transformador"] = array();
    while( $row = $result->fetch_object() ) {
       //$jsondata["data"]["users"][] es un array no asociativo. Tendremos que utilizar JSON_FORCE_OBJECT en json_enconde
       //si no queremos recibir un array en lugar de un objeto JSON en la respuesta
       //ver http://www.php.net/manual/es/function.json-encode.php para más info
       $jsondata["data"]["transformador"][] = $row;
     }

   } else {

     $jsondata["success"] = false;
     $jsondata["data"] = array(
       'message' => 'No se encontró ningún resultado.'
     );

   }

   $result->close();

  } else {

    $jsondata["success"] = false;
    $jsondata["data"] = array(
      'message' => $database->error
    );

  }

  header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);

  $database->close();

}
exit();
