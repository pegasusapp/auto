<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../modelos/DBConnection.php'; // Ajusta la ruta según tu estructura
require_once __DIR__ . '/../modelos/settings.config.php'; // Ajusta la ruta según tu estructura

global $configdb;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $niuRegister = $_POST["niuRegisterIn"] ?? "";
    $nombrePromotor = $_POST["nombrePromotorIn"] ?? "";
    $tipoDocumento = $_POST["tipoDocumento"] ?? "";
    $numeroDocumento = $_POST["numeroDocumento"] ?? "";
    $celular = $_POST["celularPromotor"] ?? "";
    $telefono = $_POST["telefonoPromotorIn"] ?? "";
    $correo = $_POST["correoPromotorIn"] ?? "";
    $archivoId= $_POST["archivoId"] ?? "";
    $solicitudId= $_POST["id_solicitud_in_session"] ?? "";
    $solicitudNro= $_POST["solicitudNro"] ?? "";
    // Prepara la consulta SQL

    $database = new DBConnection($configdb);
    $stmt = $database->runQuery("INSERT INTO entradaOperacion (nroSolicitud,iddocumentosExtra,fechaInOperation) 
                VALUES ($solicitudNro,$archivoId,NOW())");
    if ($stmt > 0) {
        $stmt_sol = $database->runQuery("UPDATE solicitudes SET estado_solicitud_idestado_solicitud = 6,
                                                                    fecha_actualizacion = NOW(), 
                                                                    observaciones_empresa = 'Registro de la solicitud para la entrada en operacion del proyecto',
                                                                    nombrePromotor = '".$nombrePromotor."',
                                                                    emailPromotor = '".$correo."',
                                                                    telefonoPromotor = '".$telefono."'
                                                                    WHERE idsolicitudes = ".$solicitudId);
        if ($stmt_sol > 0){
            $stmt_obs = $database->runQuery("INSERT INTO observaciones (observacion, fecha, solicitudes_idsolicitudes, estado_solicitud)
                VALUES ('Registro de la solicitud para la entrada en operacion del proyecto',NOW(),$solicitudId,6)");
            if ($stmt_obs > 0){
                /*enviamos email*/
                        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                        try {
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;
                            $mail->Username = 'notificaciones.energia.ruitoque@gmail.com';                 // SMTP username
                            $mail->Password = 'deplaoawwkpfwcgs';                           // SMTP password
                            $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;
                            //$mail->SMTPDebug = false;
                            $mail->Priority = 1;                                    // TCP port to connect to
                            /*$mail->setFrom('notificaciones.energia.ruitoque@gmail.com', 'Ruitoque SA ESP');
                            $mail->addAddress('rbadillo@ruitoqueesp.com', 'Usuario :');     // Add a recipient
                            $mail->addAddress('gestiontecnicaenergia1@ruitoqueesp.com', 'Usuario :');     // Add a recipient
                            $mail->addAddress('gestiontecnicaenergia3@ruitoqueesp.com', 'Usuario :');     // Add a recipient
                            $mail->addAddress('atencioncliente3@ruitoqueesp.com', 'Usuario :');     // Add a recipient
                            $mail->addAddress('gestionfronterascomerciales1@ruitoqueesp.com', 'Usuario :');*/
                            $mail->addAddress('oscar.2001601@gmail.com', 'Usuario :');
                            $mail->isHTML(true);               // Set email format to HTML
                            $mail->CharSet = 'UTF-8';
                            $mail->Subject = 'Solicitud para entrada en operación';
                            $mail->Body    = 'Cordial saludo. El usuario con niu  '.$_POST["niuRegisterIn"].', ha registrado una solicitud para entrada en operación, el número de la solicitud es '.$solicitudNro.'. Gracias';
                            $mail->send();
                            echo json_encode(["success" => true]);

                        }
                        catch (Exception $e)
                        {
                            echo json_encode(["error" => false, "message" => "Message could not be sent. Mailer Error: ".$mail->ErrorInfo]);
                        }
            } else {
                echo json_encode(["error" => false, "message" => "Error al guardar al actualización de las observaciones."]);
            }
        } else {
            echo json_encode(["error" => false, "message" => "Error al guardar al actualización de la solicitudes."]);
        }

    } else {
        echo json_encode(["error" => false, "message" => "Error al guardar en la base de datos."]);
    }
}
