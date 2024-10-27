<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class ControladorSolicitud
{ 

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
  static public function ctrCrearSolicitud()
    {
       
      if(isset($_POST["idClienteEnergia"]))
      {
         //$consulta_solicitud_antes = ModeloSolicitud::mdlConsultaSolicitud($_POST["idClienteEnergia"]);
         /*if($consulta_solicitud_antes == 0)
            {  */
               $rutaCarpeta = './solicitudes/'.$_POST['idClienteEnergia'];
              
                if(!file_exists($rutaCarpeta))
                  {
                      mkdir($rutaCarpeta, 0777, true);
                  }      
                     if(isset($_POST["nombre_razon_social"]))
                       {
                          global $configdb;
                          $anyo=date("Y");
                          $mes=date("m");
                          $dia=date("d");
                          $minutos=date("i");
                          $seg=date("s");
                          $micros=date("u");
                          $todo=$anyo.$mes.$dia.$minutos.$seg.$micros;
                          $database = new DBConnection($configdb); 
                          $sqlInsert='INSERT INTO solicitudes( Usuario_niu, fecha_solicitud, nro_solicitud, email, telefono, tipo_generacion_instalar, entrega_excedentes_red,
                                                               fecha_generacion_autogeneracion, fecha_generacion_distribucion, potencia_instalada_kva, potencia_entregar_red, 
                                                               nivel_tension, codigo_subestacion, tipo_tecnologia_utilizada, almacen_energia, basado_inversores, basado_maq_sin,
                                                               basado_maq_asi, potencia_panel, fecha_instalacion_solar_fv, nro_paneles, rele_flujo_inverso, capacidad_dc, 
                                                               potencia_total, voltaje_salida, numero_fases, voltaje_entrada, numero_inversores, fabricante_inversores, 
                                                               modelo_inversores, descripcion_elementos_proteccion, descripcion_caracteristicas_inversor, estandar_ul, 
                                                               estandar_iec, ver_ieee, ver_ul, ver_iec, potencia, impedancia, grupo, fabricante_generador, modelo_generador, 
                                                               voltaje_generador, potencia_nominal, factor_potencia, numero_fases_generador, reactancia_subtransitoria, 
                                                               potencia_nominal_trafo, impedancia_cc, grupo_conexion, descripcion_elementos_proteccion_trafo, estandar_ieee_ni, 
                                                               proteccion_inversores, anexo_general, cln_suministra_medidor, medidor_bidireccional, medidor_perfil_horario, 
                                                               descripcion_gral_proyecto, estado_solicitud_idestado_solicitud, fecha_actualizacion, observaciones_empresa,energia_cap,
                                                               energia_ene,fecha_puesta_operacion,fecha_inicio_prueba_conexion,fecha_fin_prueba_conexion,recurso_energetico,tipo_tecnologia) 
                                        VALUES("'.$_POST["idClienteEnergia"].'",DATE_FORMAT(NOW(),"%Y-%m-%d %T"),"'.$todo.'","'.$_POST["email"].'","'.$_POST["telefono_correspondencia"].'",
                                               "'.$_POST["tipo_generacion_instalar"].'","'.$_POST["entrega_excedentes_red"].'","'.$_POST["fecha_generacion_autogeneracion"].'",
                                               "'.$_POST["fecha_generacion_distribucion"].'","'.$_POST["potencia_instalada_kva"].'","'.$_POST["potencia_entregar_red"].'",
                                               "'.$_POST["nivel_tension"].'","'.$_POST["codigo_subestacion"].'","'.$_POST["tipo_tecnologia_utilizada"].'","'.$_POST["almacen_energia"].'",
                                               "'.$_POST["basado_inversores"].'","'.$_POST["basado_maq_sin"].'","'.$_POST["basado_maq_asi"].'","'.$_POST["potencia_panel"].'",
                                               "'.$_POST["fecha_instalacion_solar_fv"].'","'.$_POST["nro_paneles"].'","'.$_POST["rele_flujo_inverso"].'","'.$_POST["capacidad_dc"].'",
                                               "'.$_POST["potencia_total"].'","'.$_POST["voltaje_salida"].'","'.$_POST["numero_fases"].'","'.$_POST["voltaje_entrada"].'",
                                               "'.$_POST["numero_inversores"].'","'.$_POST["fabricante_inversores"].'","'.$_POST["modelo_inversores"].'",
                                               "'.$_POST["descripcion_elementos_proteccion"].'","'.$_POST["descripcion_caracteristicas_inversor"].'","'.$_POST["estandar_ul"].'",
                                               "'.$_POST["estandar_iec"].'","'.$_POST["ver_ieee"].'","'.$_POST["ver_ul"].'","'.$_POST["ver_iec"].'","'.$_POST["potencia"].'",
                                               "'.$_POST["impedancia"].'","'.$_POST["grupo"].'","'.$_POST["fabricante_generador"].'","'.$_POST["modelo_generador"].'",
                                               "'.$_POST["voltaje_generador"].'","'.$_POST["potencia_nominal"].'","'.$_POST["factor_potencia"].'","'.$_POST["numero_fases_generador"].'",
                                               "'.$_POST["reactancia_subtransitoria"].'","'.$_POST["potencia_nominal_trafo"].'","'.$_POST["impedancia_cc"].'","'.$_POST["grupo_conexion"].'",
                                               "'.$_POST["descripcion_elementos_proteccion_trafo"].'","'.$_POST["estandar_ieee_ni"].'","'.$_POST["proteccion_inversores"].'",
                                               "'.$_POST["anexo_general"].'","'.$_POST["cln_suministra_medidor"].'","'.$_POST["medidor_bidireccional"].'",
                                               "'.$_POST["medidor_perfil_horario"].'","'.$_POST["descripcion_gral_proyecto"].'",1,DATE_FORMAT(NOW(),"%Y-%m-%d %T"),"'.$_POST["observaciones_empresa"].'",
                                               "'.$_POST["energia_cap"].'","'.$_POST["energia_ene"].'","'.$_POST["fecha_puesta_operacion"].'","","","'.$_POST["recurso_energetico"].'","'.$_POST["tipo_tecnologia"].'")';
                            $respuesta_consulta = $database->getLastIDQuery($sqlInsert);
                            $last_id = $respuesta_consulta;
                            
                            $sql2 = "INSERT INTO proyeccionEnergia(solicitudes_idsolicitudes, proy_ener_gen_or_m1, proy_ener_gen_or_m2, proy_ener_gen_or_m3, proy_ener_gen_or_m4, proy_ener_gen_or_m5, proy_ener_gen_or_m6, proy_ener_gen_or_m7, proy_ener_gen_or_m8, proy_ener_gen_or_m9, proy_ener_gen_or_m10, proy_ener_gen_or_m11, proy_ener_gen_or_m12) VALUES(".$last_id.",".$_POST["proy_ener_gen_or_m1"].",".$_POST["proy_ener_gen_or_m2"].",".$_POST["proy_ener_gen_or_m3"].",".$_POST["proy_ener_gen_or_m4"].",".$_POST["proy_ener_gen_or_m5"].",".$_POST["proy_ener_gen_or_m6"].",".$_POST["proy_ener_gen_or_m7"].",".$_POST["proy_ener_gen_or_m8"].",".$_POST["proy_ener_gen_or_m9"].",".$_POST["proy_ener_gen_or_m10"].",".$_POST["proy_ener_gen_or_m11"].",".$_POST["proy_ener_gen_or_m12"].")";
                            $respuesta_insercion_proyeccion_e=$database->runQuery($sql2);

                            $sql3 = "INSERT INTO proyeccionEnergia_ci(solicitudes_idsolicitudes, proy_ener_gen_ci_m1, proy_ener_gen_ci_m2, proy_ener_gen_ci_m3, proy_ener_gen_ci_m4, proy_ener_gen_ci_m5, proy_ener_gen_ci_m6, proy_ener_gen_ci_m7, proy_ener_gen_ci_m8, proy_ener_gen_ci_m9, proy_ener_gen_ci_m10, proy_ener_gen_ci_m11, proy_ener_gen_ci_m12) VALUES(".$last_id.",".$_POST["proy_ener_gen_ci_m1"].",".$_POST["proy_ener_gen_ci_m2"].",".$_POST["proy_ener_gen_ci_m3"].",".$_POST["proy_ener_gen_ci_m4"].",".$_POST["proy_ener_gen_ci_m5"].",".$_POST["proy_ener_gen_ci_m6"].",".$_POST["proy_ener_gen_ci_m7"].",".$_POST["proy_ener_gen_ci_m8"].",".$_POST["proy_ener_gen_ci_m9"].",".$_POST["proy_ener_gen_ci_m10"].",".$_POST["proy_ener_gen_ci_m11"].",".$_POST["proy_ener_gen_ci_m12"].")";
                            $respuesta_insercion_proyeccion_eci=$database->runQuery($sql3);
                            
                            if(!empty($_FILES['proyecto_final']['name']))
                               {

                                      foreach ($_FILES["proyecto_final"]["error"] as $key => $error)
                                       {
                                           if ($error == UPLOAD_ERR_OK) 
                                            {
                                                $tmp_name = $_FILES["proyecto_final"]["tmp_name"][$key];
                                                $name = basename($_FILES["proyecto_final"]["name"][$key]);
                                                move_uploaded_file($tmp_name, './solicitudes/'.$_POST['idClienteEnergia'].'/'.$name);
                                                $rutaFile_rut='/solicitudes/'.$_POST['idClienteEnergia'].'/'.$name;
                                            }
                                        }
                                        
                                        $insercion_file="INSERT INTO documento (solicitudes_idsolicitudes,nombre_archivo) VALUES (".$last_id.",'".$name."')";
                                        if ($database->runQuery($insercion_file) === 1)
                                                       {

			                                            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
															try {
																	//$mail->isSMTP();                                      // Set mailer to use SMTP
																	$mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
																	$mail->SMTPAuth = true;
																	$mail->Username = 'notificaciones.energia.ruitoque@gmail.com';                 // SMTP username
																	$mail->Password = 'deplaoawwkpfwcgs';                           // SMTP password
																	$mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
																	$mail->Port = 587;
																	//$mail->SMTPDebug = false;
																	$mail->Priority = 1;                                    // TCP port to connect to
																	$mail->setFrom('notificaciones.energia.ruitoque@gmail.com', 'Ruitoque SA ESP');
																	$mail->addAddress('rbadillo@ruitoqueesp.com', 'Usuario :');     // Add a recipient
																	$mail->addAddress('gestiontecnicaenergia1@ruitoqueesp.com', 'Usuario :');     // Add a recipient
																	$mail->addAddress('gestiontecnicaenergia3@ruitoqueesp.com', 'Usuario :');     // Add a recipient
																	$mail->addAddress('atencioncliente3@ruitoqueesp.com', 'Usuario :');     // Add a recipient*/
                                                                    $mail->addAddress('gestionfronterascomerciales1@ruitoqueesp.com', 'Usuario :');
																	$mail->isHTML(true);               // Set email format to HTML
																	$mail->CharSet = 'UTF-8';
																	$mail->AddAttachment('./solicitudes/'.$_POST['idClienteEnergia'].'/'.$name);
																	$mail->Subject = 'Solicitud registrada';
																	$mail->Body    = 'Cordial saludo. El usuario con niu  '.$_POST["idClienteEnergia"].', ha registrado una solicitud, el número es '.$todo.'. Gracias';
																	$mail->send();

																} 
																catch (Exception $e) 
																{
																		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
																}
															
														$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
															try {
																	//$mail->isSMTP();                                      // Set mailer to use SMTP
																	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
																	$mail->SMTPAuth = true;                               // Enable SMTP authentication
																	$mail->Username = 'notificaciones.energia.ruitoque@gmail.com';                 // SMTP username
																	$mail->Password = 'deplaoawwkpfwcgs';                           // SMTP password
																	$mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
																	$mail->Port = 587;
																	//$mail->SMTPDebug = 1;                                    // TCP port to connect to
																	$mail->setFrom('notificaciones.energia.ruitoque@gmail.com', 'Ruitoque SA ESP');
																	$mail->addAddress($_POST["email"], $_POST["nombre_razon_social"]);     // Add a recipient
																	$mail->isHTML(true);               // Set email format to HTML
																	$mail->CharSet = 'UTF-8';
																	$mail->Subject = 'Solicitud registrada';
																	$mail->Body    = 'Cordial saludo. Usted ha registrado una solicitud en Ruitoque SA ESP, el número del radicado es '.$todo.', tengalo presente para futuras consultas, por favor no responder a este correo. Gracias';
																	$mail->send();
																	echo'<script>
	                                                                    swal({
	                                                                        type: "success",
	                                                                        title: "La solicitud ha sido registrada correctamente. Este es el número de su solicitud, '.$todo.' guardelo para futuras consultas.",
	                                                                        showConfirmButton: true,
	                                                                        confirmButtonText: "Cerrar",
	                                                                        closeOnConfirm: false
	                                                                        }).then((result) => {
	                                                                            if (result.value) {
	                                                                            window.location = "index.php"; 
	                                                                            }
	                                                                          })

	                                                                    </script>';
																} 
																catch (Exception $e) 
																{
																		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
																}			


	  						                            }
                                }

                       
                        }
                      else
	                    {
	                      	 echo'<script>
	                                                                swal({
	                                                                    type: "error",
	                                                                    title: "No se tiene el campo la razón social del cliente se cancela el proceso",
	                                                                    showConfirmButton: true,
	                                                                    confirmButtonText: "Cerrar",
	                                                                    closeOnConfirm: false
	                                                                    }).then((result) => {
	                                                                    if (result.value) {
	                                                                    window.location = "inicio";
	                                                                    }
	                                                                  })
	                                                                </script>';
	                    } 
                 
  

	  } 


}


//// fin de la clase
}

