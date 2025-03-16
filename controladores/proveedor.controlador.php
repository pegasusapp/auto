<?php

header('Content-type: text/html; charset=utf-8');
require_once('settings.config.php');          // Define db configuration arrays here
require_once('DBConnection.php');  
include __DIR__.'/../plugins/phpmailer/class.phpmailer.php';
include __DIR__.'/../plugins/phpmailer/PHPMailerAutoload.php';
class ControladorProveedores
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	 static public function consultaNit($item,$tabla,$valor) 
      {
           global $configdb;
           $database = new DBConnection($configdb); 
           $respuesta_consulta = $database->getQuery("SELECT count(*) as cantidad FROM proveedores WHERE cc_nit = '".$valor."' LIMIT 1");
            foreach($respuesta_consulta as $row)
             {
                 return $row["cantidad"];
              } 

       }



   static public function ctrCrearProveedor()
    {

       //antes de insertar verificamos que ya se insertó es enit para evitar duplicados
      if(isset($_POST["cc_nit"]))
      {
        $consulta_nit_antes = ControladorProveedores::consultaNit('cc_nit','proveedores',$_POST["cc_nit"]);
         if($consulta_nit_antes == 0)
           {  
          //subiendo los archivos 
           $rutaCarpeta = './proveedores/'.$_POST['cc_nit'];
           $i=0;
            if(mkdir($rutaCarpeta, 0777, true))
             {

                if($_POST["razon_social"])
                  {
                     global $configdb;
                     $database = new DBConnection($configdb); 
                     //parametros para la creación del usuario del sistema
                        $cadena = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
                        $longitudCadena=strlen($cadena);
                        $pass = '';
                        $longitudPass=7;
                        for($i=1 ; $i<=$longitudPass ; $i++)
                            {
                              $pos=rand(0,$longitudCadena-1);
                              $pass .= substr($cadena,$pos,1);
                            }
                        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
                        $password = hash('sha512', $pass . $random_salt);
                     //fin parametros   
                        $sqlInsert='INSERT INTO proveedores(razon_social, cc_nit, direccion, web_page, representante_legal, cc_representante_legal, anos_experiencia, representante_comercial, tlf_proveedor, fax_proveedor, email_proveedor, responsable_directo, tlf_responsable_directo, email_responsable_directo, garantia, tiempo_garantia_meses, forma_pago, stma_gestion_calidad, declara_renta, gran_respon_iva, gran_contribuyente, autoretenedor, regimen_comun, regimen_simplificado, descripcion_gral, idempresa) VALUES("'.$_POST["razon_social"].'","'.$_POST["cc_nit"].'",
                              "'.$_POST["direccion"].'","'.$_POST["web_page"].'","'.$_POST["representante_legal"].'","'.$_POST["cc_representante_legal"].'",'.$_POST["anos_experiencia"].',"'.$_POST["representante_comercial"].'","'.$_POST["tlf_proveedor"].'","'.$_POST["fax_proveedor"].'","'.$_POST["email_proveedor"].'","'.$_POST["responsable_directo"].'","'.$_POST["tlf_responsable_directo"].'","'.$_POST["email_responsable_directo"].'",'.$_POST["garantia"].','.$_POST["tiempo_garantia_meses"].',"'.$_POST["forma_pago"].'","'.$_POST["stma_gestion_calidad"].'",'.$_POST["declara_renta"].','.$_POST["gran_respon_iva"].','.$_POST["gran_contribuyente"].','.$_POST["autoretenedor"].','.$_POST["regimen_comun"].','.$_POST["regimen_simplificado"].',"'.$_POST["descripcion_gral"].'",'.$_POST["idempresa"].')';
                        $respuesta_consulta = $database->getLastIDQuery($sqlInsert);
                        $last_id = $respuesta_consulta;
                        // creación del usuario
                        $sql2 = "INSERT INTO usuarios_sistema(username,password,salt,idproveedores) VALUES('".$_POST['cc_nit']."','".$password."','".$random_salt."',".$last_id.")";
                         if ($database->runQuery($sql2) === 1)
                                     {
                                       $mensage="Registros creados";
                                     }
                                      $gh="Nuevo";
                                      $respuesta_idestado_proveedores = $database->getQuery("SELECT idestado_proveedores FROM estadosp WHERE estado = '".$gh."' LIMIT 1");
                                      foreach($respuesta_idestado_proveedores as $row)
                                       {
                                         $estadopr = $row["idestado_proveedores"];
                                       }

                                       //subir los archivos

                                       //RUTA
                                       if(!empty($_FILES['rut']['name']))
                                         {

                                              foreach ($_FILES["rut"]["error"] as $key => $error)
                                               {
                                                    

                                                    if ($error == UPLOAD_ERR_OK) 
                                                    {
                                                        
                                                        $tmp_name = $_FILES["rut"]["tmp_name"][$key];
                                                        $name = basename($_FILES["rut"]["name"][$key]);
                                                        move_uploaded_file($tmp_name, './proveedores/'.$_POST['cc_nit'].'/'.$name);
                                                        $rutaFile_rut='/proveedores/'.$_POST['cc_nit'].'/'.$name;
                                                    }
                                                }
                                                $nameArchivo="RUT";  
                                                $insercion_file_rut="INSERT INTO archivos (nombre,descripcion,idproveedores) VALUES ('".$rutaFile_rut."','".$nameArchivo."',".$last_id.")";
                                                if ($database->runQuery($insercion_file_rut) === 1)
                                                               {
                                                                 $mensage="Registros creados";
                                                               }
                                          }

                                          //CAMARA
                                           if(!empty($_FILES['ccomercio']['name']))
                                           {

                                              foreach ($_FILES["ccomercio"]["error"] as $key => $error)
                                               {
                                                    if ($error == UPLOAD_ERR_OK) 
                                                    {
                                                        
                                                        $tmp_name = $_FILES["ccomercio"]["tmp_name"][$key];
                                                        $name = basename($_FILES["ccomercio"]["name"][$key]);
                                                        move_uploaded_file($tmp_name, './proveedores/'.$_POST['cc_nit'].'/'.$name);
                                                        $rutaFile_ccomercio='/proveedores/'.$_POST['cc_nit'].'/'.$name;
                                                    }
                                                }
                                                $nameArchivo="CAMARA DE COMERCIO";  
                                                $insercion_file_ccomercio="INSERT INTO archivos (nombre,descripcion,idproveedores) VALUES ('".$rutaFile_ccomercio."','".$nameArchivo."',".$last_id.")";
                                                if ($database->runQuery($insercion_file_ccomercio) === 1)
                                                               {
                                                                 $mensage="Registros creados";
                                                               }
                                            }
                                          //CC RELEGAL
                                           if(!empty($_FILES['ccrelegal']['name']))
                                           {

                                              foreach ($_FILES["ccrelegal"]["error"] as $key => $error)
                                               {
                                                    if ($error == UPLOAD_ERR_OK) 
                                                    {
                                                        
                                                        $tmp_name = $_FILES["ccrelegal"]["tmp_name"][$key];
                                                        $name = basename($_FILES["ccrelegal"]["name"][$key]);
                                                        move_uploaded_file($tmp_name, './proveedores/'.$_POST['cc_nit'].'/'.$name);
                                                        $rutaFile_ccrelegal='/proveedores/'.$_POST['cc_nit'].'/'.$name;
                                                    }
                                                }
                                                $nameArchivo="CEDULA R. LEGAL";  
                                                $insercion_file_ccrelegal="INSERT INTO archivos (nombre,descripcion,idproveedores) VALUES ('".$rutaFile_ccrelegal."','".$nameArchivo."',".$last_id.")";
                                                if ($database->runQuery($insercion_file_ccrelegal) === 1)
                                                               {
                                                                 $mensage="Registros creados";
                                                               }
                                            }
                                          //CC RELEGAL
                                           if(!empty($_FILES['cbancaria']['name']))
                                           {

                                              foreach ($_FILES["cbancaria"]["error"] as $key => $error)
                                               {
                                                    if ($error == UPLOAD_ERR_OK) 
                                                    {
                                     
                                                        $tmp_name = $_FILES["cbancaria"]["tmp_name"][$key];
                                                        $name = basename($_FILES["cbancaria"]["name"][$key]);
                                                        move_uploaded_file($tmp_name, './proveedores/'.$_POST['cc_nit'].'/'.$name);
                                                        $rutaFile_cbancaria='/proveedores/'.$_POST['cc_nit'].'/'.$name;
                                                    }
                                                }
                                                $nameArchivo="CERTIFICACION BANCARIA";  
                                                $insercion_file_cbancaria="INSERT INTO archivos (nombre,descripcion,idproveedores) VALUES ('".$rutaFile_cbancaria."','".$nameArchivo."',".$last_id.")";
                                                if ($database->runQuery($insercion_file_cbancaria) === 1)
                                                               {
                                                                 $mensage="Registros creados";
                                                               }
                                            }

                                          //CALIDAD
                                           if(!empty($_FILES['ccalidad']['name']))
                                           {

                                              foreach ($_FILES["ccalidad"]["error"] as $key => $error)
                                               {
                                                    if ($error == UPLOAD_ERR_OK) 
                                                    {
                                                        $tmp_name = $_FILES["ccalidad"]["tmp_name"][$key];
                                                        $name = basename($_FILES["ccalidad"]["name"][$key]);
                                                        move_uploaded_file($tmp_name, './proveedores/'.$_POST['cc_nit'].'/'.$name);
                                                        $rutaFile_scalidad='/proveedores/'.$_POST['cc_nit'].'/'.$name;
                                                    }
                                                }
                                                $nameArchivo="SISTEMA CALIDAD";  
                                                $insercion_file_scalidad="INSERT INTO archivos (nombre,descripcion,idproveedores) VALUES ('".$rutaFile_scalidad."','".$nameArchivo."',".$last_id.")";
                                                 if ($database->runQuery($insercion_file_scalidad) === 1)
                                                               {
                                                                 $mensage="Registros creados";
                                                               }
                                            }

                                       //informacion de empresas
                                            for ($i = 1; $i <=3; $i++) 
                                                  {
                                                    $razon_social="razon_social".$i;
                                                    $nombre_contacto="nombre_contacto".$i;
                                                    $telefono_contacto="telefono_contacto".$i;
                                                    $descripcion_trabajo="descripcion_trabajo".$i;
                                                    $tiempo_meses="tiempo_meses".$i;
                                                    $observaciones="observaciones".$i;
                                                    $constancia="constancia".$i;
                                                    $dpersonales="dpersonales".$i;

                                                    foreach ($_FILES[$constancia]["error"] as $key => $error)
                                                           {
                                                                if ($error == UPLOAD_ERR_OK) 
                                                                {
                                                                    
                                                                    $tmp_name = $_FILES[$constancia]["tmp_name"][$key];
                                                                    $name = basename($_FILES[$constancia]["name"][$key]);
                                                                    move_uploaded_file($tmp_name, './proveedores/'.$_POST['cc_nit'].'/'.$name);
                                                                    $rutaFile='/proveedores/'.$_POST['cc_nit'].'/'.$name;
                                                                }
                                                            }
                                                        foreach ($_FILES[$dpersonales]["error"] as $key => $error)
                                                           {
                                                                if ($error == UPLOAD_ERR_OK) 
                                                                {
                                                
                                                                    $tmp_name = $_FILES[$dpersonales]["tmp_name"][$key];
                                                                    $name = basename($_FILES[$dpersonales]["name"][$key]);
                                                                    move_uploaded_file($tmp_name, './proveedores/'.$_POST['cc_nit'].'/'.$name);
                                                                    $dpersonalesruta='/proveedores/'.$_POST['cc_nit'].'/'.$name;
                                                                }
                                                            }     

                                                              $sql_empresa="INSERT INTO empresa_proveedores (razon_social,nombre_contacto,telefono_contacto,descripcion_trabajo,tiempo_meses,observaciones,constancia,idproveedores,dpersonales) VALUES ('".$_POST[$razon_social]."','".$_POST[$nombre_contacto]."','".$_POST[$telefono_contacto]."','".$_POST[$descripcion_trabajo]."','".$_POST[$tiempo_meses]."','".$_POST[$observaciones]."','".$rutaFile."',".$last_id.",'".$dpersonalesruta."')";
                                                               if ($database->runQuery($sql_empresa) === 1)
                                                               {
                                                                 $mensage="Registros creados";
                                                               }


                                                  }  
                                       //     


                                       
                                       // fin subir archivos
                                      $respuesta="";
                                      $sql3 = "INSERT INTO historial_estadosp(observacion,fecha,idestado_proveedores,idproveedores) VALUES ('Usuario nuevo registrado',DATE_FORMAT(NOW(),'%Y-%m-%d %T'),".$estadopr.",".$last_id.")";
                                      if ($database->runQuery($sql3) == 1)
                                          {
                                            $respuesta = "ok";

                                            //enviamos el correo
                                              $correo_lider="dreyes@ruitoqueesp.com";
                                              $head="";
                                              $body="";
                                              $footer="";
                                              $correo = new PHPMailer();
                                              $correo->IsSMTP();
                                              $correo->SMTPAuth = true;
                                              $correo->SMTPSecure = 'tls';
                                              $correo->Host = "smtp.gmail.com";
                                              $correo->Port = 587;
                                              $correo->Username   = "sistemas@ruitoqueesp.com";
                                              $correo->Password   = "od2001601";
                                              $correo->SetFrom("sistemas@ruitoqueesp.com", "Nuevo registro de proveedor");
                                              $correo->AddReplyTo("sistemas@ruitoqueesp.com","Sistema automatico");
                                              $correo->AddAddress($correo_lider, "Lider de abastecimiento");
                                              $correo->Subject = "Registro de proveedor";
                                              $head.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
                                              $head.='<html xmlns="http://www.w3.org/1999/xhtml">';
                                              $head.='<head>';
                                              $head.='  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                                              $head.='  <title>Sistema de abastecimiento</title>';
                                              $head.='  <style type="text/css">';
                                              $head.='  body {margin: 0; padding: 0; min-width: 100%!important;}';
                                              $head.='  img {height: auto;}';
                                              $head.='  .content {width: 100%; max-width: 600px;}';
                                              $head.='  .header {padding: 40px 30px 20px 30px;}';
                                              $head.='  .innerpadding {padding: 30px 30px 30px 30px;}';
                                              $head.='  .borderbottom {border-bottom: 1px solid #f2eeed;}';
                                              $head.='  .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;}';
                                              $head.='  .h1, .h2, .bodycopy {color: #153643; font-family: sans-serif;}';
                                              $head.='  .h1 {font-size: 33px; line-height: 38px; font-weight: bold;}';
                                              $head.='  .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;}';
                                              $head.='  .bodycopy {font-size: 16px; line-height: 22px;}';
                                              $head.=' .button {text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;}';
                                              $head.='.button a {color: #ffffff; text-decoration: none;}';
                                              $head.='  .footer {padding: 20px 30px 15px 30px;}';
                                              $head.='  .footercopy {font-family: sans-serif; }';
                                              $head.='  .footercopy a {color: #ffffff; text-decoration: underline;}';
                                              $head.='  @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {';
                                              $head.='  body[yahoo] .hide {display: none!important;}';
                                              $head.='  body[yahoo] .buttonwrapper {background-color: transparent!important;}';
                                              $head.='body[yahoo] .button {padding: 0px!important;}';
                                              $head.='  body[yahoo] .button a {background-color: #e05443; padding: 15px 15px 13px!important;}';
                                              $head.='  body[yahoo] .unsubscribe {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}';
                                              $head.='  }';
                                              $head.='  /*@media only screen and (min-device-width: 601px) {';
                                              $head.='    .content {width: 600px !important;}';
                                              $head.='    .col425 {width: 425px!important;}';
                                              $head.='    .col380 {width: 380px!important;}';
                                              $head.='    }*/';
                                              $head.='  </style>';
                                              $head.='</head>';
                                              $head.='<body yahoo bgcolor="#f6f8f1">';
                                              $head.='<table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">';
                                              $head.='<tr>';
                                              $head.='  <td>';
                                              $head.='    <!--[if (gte mso 9)|(IE)]>';
                                              $head.='      <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">';
                                              $head.='        <tr>';
                                              $head.='          <td>';
                                              $head.='    <![endif]-->'; 
                                              $head.='    <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">';
                                              $head.='      <tr>';
                                              $head.='        <td class="header" style="background-image:url(img/header_outer_cabecera.png)">';
                                              $head.='         <table width="100" align="left" border="0" cellpadding="0" cellspacing="0">';  
                                              $head.='            <tr>';
                                              $head.='              <td height="100" style="padding: 0 20px 20px 0;">';
                                              $head.='                <img class="fix" src="img/logo_Creciendojuntos_355.png" width="185" height="100" border="0" alt="" />';
                                              $head.='              </td>';
                                              $head.='            </tr>';
                                              $head.='          </table>';
                                              $head.='          <!--[if (gte mso 9)|(IE)]>';
                                              $head.='            <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">';
                                              $head.='              <tr>';
                                              $head.='                <td>';
                                              $head.='          <![endif]-->';
                                              $head.='          <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 880px;">';  
                                              $head.='            <tr>';
                                              $head.='              <td height="70">';
                                              $head.='                <table width="100%" border="0" cellspacing="0" cellpadding="0">';
                                              $head.='                  <tr>';
                                              $head.='                    <td class="subhead" style="padding: 0 0 0 3px;">';
                                              $head.='                      <b>SISTEMA DE ABASTECIMIENTO</b>';
                                              $head.='                    </td>';
                                              $body.='                  </tr>';
                                              $body.='                  <tr>';
                                              $body.='                    <td class="h1" style="padding: 0 0 0 3px;">';
                                              $body.='                      <b>Ruitoque SA ESP</b>';
                                              $body.='                    </td>';
                                              $body.='                  </tr>';
                                              $body.='                </table>';
                                              $body.='              </td>';
                                              $body.='            </tr>';
                                              $body.='          </table>';
                                              $body.='          <!--[if (gte mso 9)|(IE)]>';
                                              $body.='                </td>';
                                              $body.='              </tr>';
                                              $body.='          </table>';
                                              $body.='          <![endif]-->';
                                              $body.='        </td>';
                                              $body.='      </tr>';
                                              $body.='      <tr>';
                                              $body.='        <td class="innerpadding borderbottom">';
                                              $body.='          <table width="100%" border="0" cellspacing="0" cellpadding="0">';
                                              $body.='            <tr>';
                                              $body.='              <td class="h2">';
                                              $body.='               Un nuevo proveedor se ha registrado en el sistema!';
                                              $body.='              </td>';
                                              $body.='            </tr>';
                                              $body.='           <tr>';
                                              $body.='              <td class="bodycopy" >';
                                              $body.='                El proveedor <b>'.$_POST["razon_social"].'</b> con nit <b>'.$_POST["cc_nit"].'</b>, se ha registrado, por favor ingrese a la gesti&oacute;n del sistema de abastecimiento, revise la documentaci&oacute;n aportada y habilite o inhabilite al proveedor..';
                                              $body.='              </td>';
                                              $body.='            </tr>';
                                              $body.='          </table>';
                                              $body.='        </td>';
                                              $body.='      </tr>';
                                              $body.='      <tr>';
                                              $body.='        <td class="innerpadding borderbottom">';
                                              $body.='          <!--[if (gte mso 9)|(IE)]>';
                                              $body.='            <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">';
                                              $body.='              <tr>';
                                              $body.='<td>';
                                              $body.='          <![endif]-->';
                                              $body.='          <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 880px;">';  
                                              $body.='            <tr>';
                                              $body.='              <td>';
                                              $body.='                <table width="100%" border="0" cellspacing="0" cellpadding="0">';
                                              $body.='                  <tr>';
                                              $body.='                    <td class="bodycopy">';
                                              $body.='                      Gracias.';
                                              $body.='                    </td>';
                                              $body.='                  </tr>';
                                              $body.='                </table>';
                                              $body.='              </td>';
                                              $body.='            </tr>';
                                              $body.='          </table>';
                                              $body.='          <!--[if (gte mso 9)|(IE)]>';
                                              $body.='                </td>';
                                              $body.='              </tr>';
                                              $body.='          </table>';
                                              $body.='          <![endif]-->';
                                              $body.='        </td>';
                                              $body.='      </tr>';
                                              $body.='      <tr>';
                                              $body.='        <td class="innerpadding bodycopy" height="100">';
                                              $body.='        </td>';
                                              $body.='      </tr>';
                                              $body.='      <tr>';
                                              $body.='        <td class="footer" bgcolor="#0099d8">';
                                              $body.='          <table width="100%" border="0" cellspacing="0" cellpadding="0">';
                                              $body.='            <tr>';
                                              $body.='              <td align="center" class="footercopy" style="text-align: justify; font-size: 9px; color: #ffffff;">';
                                              $body.='                AVISO LEGAL: Este mensaje y sus anexos pueden contener informaci&oacute;n confidencial o legalmente protegida y no puede ser utilizada ni divulgada por personas diferentes a su destinatario. Si por error, recibe este mensaje, por favor avise inmediatamente a su remitente y destruya toda copia que tenga del mismo. Cualquier uso, divulgaci&oacute;n, copia, distribuci&oacute;n, impresi&oacute;n o acto derivado del conocimiento total o parcial de este mensaje sin autorizaci&oacute;n de Ruitoque S.A. E.S.P ser&aacute; sancionado de acuerdo con las  normas legales vigentes. De otra parte, al destinatario se le considera custodio de la informaci&oacute;n contenida y debe velar por su confidencialidad, integridad y privacidad. Las opiniones contenidas en este mensaje electr&oacte;nico no relacionadas con la actividad de la compa&ntilde;&iacute;a, no necesariamente representan la opini&oacute;n de &reg;Ruitoque S.A.  E.S.P<br/>';
                                              $body.='              </td>';
                                              $body.='            </tr>';
                                              $body.='            <tr>';
                                              $footer.='              <td align="center" style="padding: 20px 0 0 0;">';
                                              $footer.='                <table border="0" cellspacing="0" cellpadding="0">';
                                              $footer.='                  <tr>';
                                              $footer.='                    <td width="37" style="text-align: center; padding: 0 10px 0 10px;">';
                                              $footer.='                      <a href="https://www.facebook.com/ESP.Ruitoque">';
                                              $footer.='                        <img src="img/facebook.png" width="37" height="37" alt="Facebook" border="0" />';
                                              $footer.='                      </a>';
                                              $footer.='                    </td>';
                                              $footer.='                    <td width="37" style="text-align: center; padding: 0 10px 0 10px;">';
                                              $footer.='                      <a href="https://twitter.com/RuitoqueESP">';
                                              $footer.='                        <img src="img/twitter.png" width="37" height="37" alt="Twitter" border="0" />';
                                              $footer.='                      </a>';
                                              $footer.='                    </td>';
                                              $footer.='                  </tr>';
                                              $footer.='                </table>';
                                              $footer.='              </td>';
                                              $footer.='            </tr>';
                                              $footer.='          </table>';
                                              $footer.='        </td>';
                                              $footer.='      </tr>';
                                              $footer.='    </table>';
                                              $footer.='    <!--[if (gte mso 9)|(IE)]>';
                                              $footer.='         </td>';
                                              $footer.='        </tr>';
                                              $footer.='    </table>';
                                              $footer.='    <![endif]-->';
                                              $footer.='    </td>';
                                              $footer.='  </tr>';
                                              $footer.='</table>';
                                              $footer.='</body>';
                                              $footer.='</html>';
                                              $correo->MsgHTML($head.$body.$footer);
                                              $correo->AddAttachment("images/phpmailer.gif");
                                              if(!$correo->Send())
                                                { 
                                                  $respuesta= "Hubo un error: " . $correo->ErrorInfo;
                                                } 
                                              else {
                                                  $respuesta= "ok";
                                                }
                                              //fin envio de correo             
                                              if($key['error']!='')
                                                {
                                                  $respuesta .= 'Problemas al subir el archivo'.$NombreOriginal.'Debido al siguiente error' .$key['error'];
                                                }
                                          }

                                       
                                         
                                      if($respuesta == "ok")
                                           {
                                                        echo'<script>
                                                        swal({
                                                            type: "success",
                                                            title: "El proveedor ha sido registrado correctamente. Por favor este pendiente de su bandeja de correo para la confirmación de su registro.",
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
                                       else
                                            {
                                                         echo'<script>
                                                              swal({
                                                                  type: "error",
                                                                  title: "Error en procedimiento'.$respuesta.'",
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
                    }  // llave razon social
                                          

                   
                  } // llave creacion de carpeta
                else
                   {

                                                  echo'<script>
                                                        swal({
                                                            type: "error",
                                                            title: "NO se pudo crear la carpeta para el NIT '.$_POST["cc_nit"].'  se cancela el proceso",
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


             } // llave consulta nit antes
              else
                {
                                                echo'<script>
                                                  swal({
                                                      type: "error",
                                                      title: "El proveedor con NIT '.$_POST["cc_nit"].'  ya se encuentra inscrito",
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

