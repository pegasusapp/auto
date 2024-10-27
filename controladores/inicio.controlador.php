<?php

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	 public function checkbrute($niu) 
	 {

	    // Obtiene el timestamp del tiempo actual.
	    $now = new DateTime();
	    $now->modify('-2 hours');
	    $tiempo= $now->format('Y-m-d H:i:s');
	    // Todos los intentos de inicio de sesión se cuentan desde las 2 horas anteriores.
	    //$valid_attempts = $now - (2 * 60 * 60);
        $respuesta_fecha = ModeloLogin_attempts::mdlMostrarLoginAttempsFecha($niu,$tiempo);

	        // Si ha habido más de 5 intentos de inicio de sesión fallidos.
	        if ($respuesta_fecha > 5) {
	            return true;
	        } else {
	            return false;
	        }
	    }



	 public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"]))
				 {
		 		     $tabla = "Usuario";
		 				 $item = "niu";
						 $valor = $_POST["ingUsuario"];
		 				 $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
						 $niu=$respuesta["niu"];

						 $password = hash('sha512', $_POST["ingPassword"].$respuesta["salt"]);
					 	 if ($this->checkbrute($niu) == true)
					 		{
								// La cuenta está bloqueada.
								$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
								try {
										//Server settings
										//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
										$mail->isSMTP();                                      // Set mailer to use SMTP
										$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
										$mail->SMTPAuth = true;                               // Enable SMTP authentication
										$mail->Username = 'notificaciones.energia.ruitoque@gmail.com';                 // SMTP username
										$mail->Password = 'PerroFlauta2022.';                           // SMTP password
										$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
										$mail->Port = 587;                                    // TCP port to connect to
										$mail->setFrom('PerroFlauta2022.', 'Ruitoque SA ESP');
										$mail->addAddress($email, 'Usuario :');     // Add a recipient
										$mail->isHTML(true);                                  // Set email format to HTML
										$mail->Subject = 'Bloqueo de usuario';
										$mail->Body    = 'Cordial saludo. El usuario con niu  '.$niu.', ha sido bloqueado, ha estado intentanto ingresar mas de 5 veces a la plataforma, por favor contactar con el administrador, para ser desbloqueado.';
										$mail->send();
										echo "enviado";
								} catch (Exception $e) {
										echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
								}
  							// actualizamos el estado del usuarios

								$cambioEstado = ModeloUsuarios::mdlActualizarUsuario($tabla, 'estado', '0', 'niu', $niu);


								if ($cambioEstado=="ok") {
											echo "actualizado";
											return false;

									} else {
											echo "Error al actualizar el estado - el usuario debe ser bloqueado:  <br>" .$cambioEstado;
									}
					   }
					 else
				 		{
											if ($respuesta["password"] == $password)
												{
													 // ¡La contraseña es correcta!
													 // Obtén el agente de usuario del usuario.
													 $user_browser = $_SERVER['HTTP_USER_AGENT'];
													 //  Protección XSS ya que podríamos imprimir este valor.
													 $niu = preg_replace("/[^0-9]+/", "", $respuesta["niu"]);
													 $_SESSION['niu'] = $niu;
													 $_SESSION['login_string'] = hash('sha512',$password.$user_browser);
													 $_SESSION["iniciarSesion"] = "ok";

													 date_default_timezone_set('America/Bogota');
													 $fecha = date('Y-m-d');
													 $hora = date('H:i:s');
													 $fechaActual = $fecha.' '.$hora;
													 $item1 = "ultimo_login";
													 $valor1 = $fechaActual;
													 $item2 = "niu";
													 $valor2 = $niu;
													$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
													if($ultimoLogin == "ok")
															{
																echo '<script>
																window.location = "inicio";
																</script>';
															}

									 	}
									 else
									 {
											 // La contraseña no es correcta.
											 // Se graba este intento en la base de datos.
											 $now = time();
											 $datos_login_fallido = array("fecha" => $now,"niu" => $niu);
											 $intentoLogin = ModeloLogin_attempts::mdlIngresarLoginAttemps('login_attempts', $niu);
									 }

  					}
			}
			else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

		}

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	 public function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $_POST["nuevoNombre"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "perfil" => $_POST["nuevoPerfil"],
					           "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuarios";

						}

					});


					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuarios";

						}

					});


				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	 public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	 public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									  }).then((result) => {
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $passwordActual;

				}

				$datos = array("nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	 public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}

		}

	}


}
