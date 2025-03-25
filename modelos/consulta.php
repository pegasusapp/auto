<?php

header('Content-Type: text/html; charset=UTF-8');
header('Content-type: application/json; charset=utf-8');
require_once('settings.config.php');          // Define db configuration arrays here
require_once('DBConnection.php');  
include __DIR__.'/../plugins/phpmailer/class.phpmailer.php';
include __DIR__.'/../plugins/phpmailer/PHPMailerAutoload.php'; 


 $database = new DBConnection($configdb);
 //$database_data = new DBConnection($configdb_data); 

if( isset($_GET['codigo_transformador']) )
  {
     $jsondata = array();

	     if ( $result = $database->getQuery( "SELECT  a.codigo_transformador as trafo , a.capacidad_nominal, a.longitud, a.laltitud, a.altitud, a.voltaje_nominal, if (b.total is null,0,b.total) as total
												FROM	
													(   
													   SELECT codigo_transformador , capacidad_nominal, longitud, laltitud, altitud, voltaje_nominal  
														   FROM Usuario usu 
														   LEFT JOIN transformador tran on usu.transformador_codigo_transformador=tran.codigo_transformador 
														   LEFT JOIN solicitudes sol on usu.niu = sol.Usuario_niu 
														   WHERE tran.codigo_transformador = '".$_GET['codigo_transformador']."' 
														   GROUP BY codigo_transformador , capacidad_nominal, longitud, laltitud, altitud, voltaje_nominal
													) as a 
												LEFT JOIN 
													  (
													   SELECT b.NODO_TRANSFERENCIA as trafo,c.capacidad_nominal,c.longitud, c.laltitud, c.altitud,c.voltaje_nominal,SUM(CAST(((potencia_panel*nro_paneles)/1000) AS DECIMAL(10,2))) as total
														   FROM solicitudes a LEFT JOIN datosCliente b ON a.Usuario_niu=b.ID_INTERNO
														   LEFT JOIN transformador c ON b.NODO_TRANSFERENCIA = c.codigo_transformador 
														   WHERE  a.estado_solicitud_idestado_solicitud in (1,2,3) AND b.NODO_TRANSFERENCIA='".$_GET['codigo_transformador']."'
														   GROUP BY b.NODO_TRANSFERENCIA,c.capacidad_nominal,c.capacidad_nominal,c.longitud, c.laltitud, c.altitud,c.voltaje_nominal
													) as b 
												ON a.codigo_transformador = b.trafo" ) ) 
              {
                
                                
                if($result->rowCount() > 0) 
                  { 
                      $jsondata["success"] = true;
                      $jsondata["data"]["transformador"] = array();
                          foreach($result as $row)
                            {
                               $jsondata["data"]["transformador"][] = $row;
                            } 
                  } 
                else 
                  {
                       $jsondata["success"] = false;
                       $jsondata["data"] = array('message' => 'No se encontró ningún resultado.');
                  }

              } 
         else 
              {

                  $jsondata["success"] = false;
                  $jsondata["data"] = array(
                    'message' => $database->error
                  );

              }
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
  }
else if( isset($_GET['codigo_usuario']) )
 {
    $jsondata = array();
    if ( $result = $database->getQuery("SELECT  a.codigo_transformador as trafo , a.capacidad_nominal, a.longitud, a.laltitud, a.altitud, a.voltaje_nominal, if (b.total is null,0,b.total) as total
                                          FROM	
                                             (   
                                                SELECT codigo_transformador , capacidad_nominal, longitud, laltitud, altitud, voltaje_nominal  
													FROM Usuario usu 
													LEFT JOIN transformador tran on usu.transformador_codigo_transformador=tran.codigo_transformador 
													LEFT JOIN solicitudes sol on usu.niu = sol.Usuario_niu 
													WHERE tran.codigo_transformador = (Select NODO_TRANSFERENCIA FROM datosCliente WHERE ID_INTERNO='" . $_GET['codigo_usuario']."')  
													GROUP BY codigo_transformador , capacidad_nominal, longitud, laltitud, altitud, voltaje_nominal
                                             ) as a 
                                          LEFT JOIN 
                                                (
                                                SELECT b.NODO_TRANSFERENCIA as trafo,c.capacidad_nominal,c.longitud, c.laltitud, c.altitud,c.voltaje_nominal,SUM(CAST(((potencia_panel*nro_paneles)/1000) AS DECIMAL(10,2))) as total  
													FROM solicitudes a LEFT JOIN datosCliente b ON a.Usuario_niu=b.ID_INTERNO
													LEFT JOIN transformador c ON b.NODO_TRANSFERENCIA = c.codigo_transformador 
													WHERE  a.estado_solicitud_idestado_solicitud in (1,2,3) AND b.NODO_TRANSFERENCIA= (Select NODO_TRANSFERENCIA FROM datosCliente WHERE ID_INTERNO='" . $_GET['codigo_usuario']."')
													GROUP BY b.NODO_TRANSFERENCIA,c.capacidad_nominal,c.capacidad_nominal,c.longitud, c.laltitud, c.altitud,c.voltaje_nominal
												 ) as b 
                                          ON a.codigo_transformador = b.trafo" ))  
      {
      
        
        $cantidad=$result->rowCount();
       
        if($result->rowCount() > 0 )
         {

          $jsondata["success"] = true;
          $jsondata["data"]["transformador"] = array();
           foreach($result as $row)
                            {
                               $jsondata["data"]["transformador"][] = $row;
                            } 
          }
        else
         {
            $jsondata["success"] = false;
            $jsondata["data"] = array('message' => 'No se encontrós ningún resultado.');

          }

 
      } 
      else 
      {
        $jsondata["success"] = false;
        $jsondata["data"] = array('message' => $database->error);

  }

  echo json_encode($jsondata, JSON_FORCE_OBJECT);

  //$database->close();
 }
 else if( isset($_GET['codigo_usuario_data']) )
 {
   $jsondata = array();

  if ( $result = $database->getQuery( "SELECT * from datosCliente  where ID_INTERNO='" . $_GET['codigo_usuario_data']."'" ) ) 
    {

        if( $result->rowCount() > 0 ) 
          {
                $jsondata["success"] = true;
                $jsondata["data"]["transformador"] = array();
                foreach($result as $row)
                            {
                               $jsondata["data"]["transformador"][] = $row;
                            } 
          }
        else 
          {
               $jsondata["success"] = false;
               $jsondata["data"] = array('message' => 'No se encontró ningún resultado.');

          }
    } 
    else
       {
        $jsondata["success"] = false;
        $jsondata["data"] = array('message' => $database->error);

       }

    echo json_encode($jsondata, JSON_FORCE_OBJECT);
 }
  else if( isset($_GET['codigo_usuario_estado']) )
 {
   $jsondata = array();

      if ( $result_estado = $database->getQuery( "SELECT if(GROUP_CONCAT(estado_solicitud_idestado_solicitud) is null,0,GROUP_CONCAT(estado_solicitud_idestado_solicitud)) as estado_solicitud_idestado_solicitud from solicitudes where Usuario_niu='" . $_GET['codigo_usuario_estado']."'" ) ) 
         {
    
            
            
            if( $result_estado->rowCount() > 0 ) 
              {
                    $jsondata["success"] = true;
                    $jsondata["data"]["solicitud"] = array();
                    foreach($result_estado as $row)
                                {
                                 
                                   $jsondata["data"]["solicitud"][] = $row;
                                } 
              }
            else 
              {
                   $jsondata["success"] = false;
                   $jsondata["data"] = array('message' => 'No se encontró ningún resultado.');
    
              }
        } 
    else
       {
        $jsondata["success"] = false;
        $jsondata["data"] = array('message' => $database->error);

       }
    echo json_encode($jsondata, JSON_FORCE_OBJECT);
 }
 else if( isset($_GET['codigo_solicitud']) )
 {
   $jsondata = array();

      if ( $result_estado = $database->getQuery( "SELECT  nro_solicitud, es.nombre as estado_solicitud, estado_solicitud_idestado_solicitud as idestadoSol, observaciones_empresa as observaciones,  idsolicitudes as idsol, Usuario_niu as niu FROM solicitudes sol LEFT JOIN estado_solicitud es ON sol.estado_solicitud_idestado_solicitud=es.idestado_solicitud  WHERE nro_solicitud='" . $_GET['codigo_solicitud']."'" ) )
         {

            if( $result_estado->rowCount() > 0 ) 
              {
                    $jsondata["success"] = true;
                    $jsondata["data"]["solicitud"] = array();
                     
                    foreach($result_estado as $row)
                                {
                                  
                                   $utfEncodedArray = array_map("utf8_encode", mb_convert_encoding($row, 'UTF-8', 'ISO-8859-1'));
                                  
                                   $jsondata["data"]["solicitud"][] = $utfEncodedArray;
                                   
                                } 
                               
              }
            else 
              {
                   $jsondata["success"] = false;
                   $jsondata["data"] = array('message' => 'No se encontró  ningún resultado.');
    
              }
        } 
    else
       {
          
        $jsondata["success"] = false;
        $jsondata["data"] = array('message' => $database->error);

       }
    echo json_encode($jsondata, JSON_UNESCAPED_UNICODE);
 }
 else if( isset($_GET['vlr_trafo']) )
 {
   $jsondata = array();

      if ( $result_estado = $database->getQuery( "Select vlrEnergiaxTransformador from vlrAnualEnergia where transformador_codigo_transformador='" . $_GET['vlr_trafo']."' AND YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))" ) ) 
         {
    
            
          
            if( $result_estado->rowCount() > 0 ) 
              {
                    $jsondata["success"] = true;
                    $jsondata["data"]["valor"] = array();
                     
                    foreach($result_estado as $row)
                                {
                                  
                                   $utfEncodedArray = array_map("utf8_encode", $row );
                                  
                                   $jsondata["data"]["valor"][] = $utfEncodedArray;
                                   
                                } 
                               
              }
            else 
              {
                   $jsondata["success"] = false;
                   $jsondata["data"] = array('message' => 'No se encontró ningún resultado.');
    
              }
        } 
    else
       {
          
        $jsondata["success"] = false;
        $jsondata["data"] = array('message' => $database->error);

       }
    echo json_encode($jsondata, JSON_UNESCAPED_UNICODE);
 }
 else if( isset($_GET['code_user']) )
 {
     $jsondata = array();

     if ( $result_estado = $database->getQuery( "SELECT nombrePromotor, emailPromotor, telefonoPromotor, ID_INTERNO as niu,DIRECCION_FRONTERA as direccion, MUNICIPIO as municipio, DEPT as dpto 
                                                                FROM solicitudes as a LEFT JOIN datosCliente as b ON a.Usuario_niu = b.ID_INTERNO 
                                                                WHERE a.nro_solicitud = '".$_GET['code_user']."'"))
     {


         if( $result_estado->rowCount() > 0 )
         {
             $jsondata["success"] = true;
             $jsondata["data"]["usuario"] = array();
             foreach($result_estado as $row)
             {

                 $jsondata["data"]["usuario"][] = $row;
             }
         }
         else
         {
             $jsondata["success"] = false;
             $jsondata["data"] = array('message' => 'No se encontró ningún resultado.');

         }
     }
     else
     {
         $jsondata["success"] = false;
         $jsondata["data"] = array('message' => $database->error);

     }
     echo json_encode($jsondata, JSON_UNESCAPED_UNICODE);
 }
else 
 {
    die("Solicitud no válida.");
 }

exit();
