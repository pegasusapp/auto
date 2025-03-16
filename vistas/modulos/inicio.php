<div id="loader" style="display:none;"></div>
<form id="myForm" enctype="multipart/form-data"  role="form" data-toggle="validator" method="post" accept-charset="utf-8" action="inicio">

<input type="hidden" name="dispo_potencia" id="dispo_potencia" value="" />
<input type="hidden" name="dispo_energia" id="dispo_energia" value="" />

<div id="smartwizard" >
    <ul>
        <li><a href="#step-1">Paso 1<br /><small>Disponibilidad red Eléctrica</small></a></li>
        <li><a href="#step-2">Paso 2<br /><small>Información del usuario</small></a></li>
        <li><a href="#step-3">Paso 3<br /><small>Datos de generación</small></a></li>
        <li><a href="#step-4">Paso 4<br /><small>Datos tecnológicos</small></a></li>
        <li><a href="#step-5">Paso 5<br /><small>Datos adicionales</small></a></li>
        <li><a href="#step-6">Paso 6<br /><small>Observaciones</small></a></li>
        <li><img src="vistas/img/Logo_Ruitoque.png" width="130px" height="65px" style="margin-left:50px;"></li>
    </ul>
<div>
       <div id="step-1">
          <div id="form-step-0" role="form" data-toggle="validator">
          	
	            
				<div style="justify-content:center" >
				    <div class="col-md-12" >
				        <div  role="group" style="text-align: center;">
					      <button class="btn btn-warning" data-target=".con-imp-bd-example-modal-lg" data-toggle="modal" id="importante_button">IMPORTANTE</button>
                <button class="btn btn-warning" data-target=".con-imp-bd-example-modal-lgsb" data-toggle="modal" id="solar_button">OFERTA SOLAR</button>
		<button class="btn btn-warning" id="pqr_button" onClick="window.open('https://pgd.ruitoqueesp.com/public/solicitud/')" target="_blank">PQR</button>

						</div>		   
					</div>
				</div>
				<br>
				<div class="row">
	                <div class="col-md-12">
	                            <h5 class="card-header info-color py-2" style="text-align:justify; margin-bottom:15px">
	                                <strong>En cumplimiento de la resolución CREG 174 de 2021, por la cual se regulan las actividades de Autogeneradores a Pequeña Escala (AGPE),  Autogeneradores a Gran Escala (AGGE) y
                                          Generadores Distribuidos (GD), RUITOQUE S.A E.S.P pone a disposición del público en general
                                          el procedimiento de conexión, el mecanismo para consulta de disponibilidad de red,  el
                                          acceso para los trámites de conexión de nuevos autogeneradores  y seguimiento a la
                                          operación de los existentes por medio del sistema de trámite en línea, los lineamientos
                                          establecidos por RUITOQUE S.A E.S.P, los acuerdos vigentes y la documentación requerida.
                                  </strong>
	                            </h5>
	                </div>
	
	             </div>
<?php	include_once('Videos.php'); ?>
	            <div class="row" style="margin-top:15px;">
	                <div class="col-md-3">
	                            <input type="text" id="codUsuario" class="form-control" placeholder="Digite su código de usuario" autofocus  >
	                            <button id="loading-control-btn" data-usu class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Buscar por código de usuario</button>
	                </div>
	                <div class="col-md-4">            
	                            <input type="text" id="codTransformador" class="form-control" placeholder="Digite su código de transformador">
	                            <button data-trans class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Buscar por código de transformador</button>
	                  </div>
	                 <div class="col-md-5">
	                            <input type="text" id="nro_solicitud_buscar" class="form-control" placeholder="Digite el número de la solicitud para ver su estado" autofocus  >
	                            <button data-sol class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Buscar solictud</button>
	                
	                  </div> 
	            </div>

	     	    <div class="row">
	                <div class="col-md-12">
	                    <div class="form-group">		
 							<input type="text" class="form-control" id="validador" style="display:none" name="validador" value="" required />
 						</div>
 	                </div>  	
	            </div>       
	            <div class="row">
	               <div class="col-md-12">		
	                 <div class="table-responsive"  id="response-container" style="overflow-y: auto;"></div>
	               </div>  	
	            </div>
	         
           </div>
        </div>
       <div id="step-2">
              <div id="form-step-1" role="form" data-toggle="validator">
                  <div class="row">
                      <div class="col-md-12">
                          <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                              <strong>IMPORTANTE - INFORMACIÓN DEL MEDIDOR DE ENERGÍA</strong>
                          </h5>
                      </div>
                  </div>
                  <div class="row">
                      <div class="modal-body">
                          Si desea que Ruitoque ESP le proporcione el medidor de energía, puede marcar la
                          opción SI,para eso es importante que diligencie la siguiente carta (la puede descargar <a href="CartaMedidorEnergia.pdf" target="_blank">aquí</a>)
                          y adjuntarla al final con los otros documentos requeridos.
                          <fieldset>
                              <div>
                                  <input type="radio" id="proporcionaMedidorSi" name="proporcionaMedidor" value="SI" checked />
                                  <label for="proporcionaMedidorSi">SI</label>
                              </div>

                              <div>
                                  <input type="radio" id="proporcionaMedidorNo" name="proporcionaMedidor" value="NO" />
                                  <label for="proporcionaMedidorNo">NO</label>
                              </div>
                          </fieldset>

                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                              <strong>DATOS DEL USUARIO</strong>
                          </h5>
                      </div>
                  </div>
                  <div class="row">
                          <div class="col-md-4">
                                  <label>Niu</label>
                                  <div class="input-group">
                                    <div class="form-group">
                                          <input type="text" class="form-control" name="idClienteEnergia" id="idClienteEnergia"  placeholder="Ingresar código de usuario" >
                                        <label for="regimen_comun" class="error" style="display:none;"></label>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                      <div class="input-group-btn">
                                          <button data-usu-consulta-codigo type="button" class="btn btn-success" id="btnSearchCliente" ><i class="fa fa-search"></i></button>
                                      </div>

                                 </div>
                          </div>
                          <div class="col-md-4">
                              <label>Nombre/Raz&oacuten social</label>
                              <div class="form-group">
                                  <input type="text" id="nombre_razon_social" name="nombre_razon_social" required  class="form-control" placeholder="Nombre o razon social" >
                                   <label for="nombre_razon_social" class="error" style="display:none;"></label>
                                   <div class="help-block with-errors"></div>
                              </div>

                          </div>
                          <div class="col-md-4">
                              <label>Nit/C&eacute;dula</label>
                               <div class="form-group">
                                    <input type="text" id="nit_cedula" name="nit_cedula" required  class="form-control" placeholder="NIT o Cédula" >
                               </div>
                              <label for="regimen_comun" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>
                          </div>
                  </div>
                  <div class="row">
                         <div class="col-md-4">
                                <label>Dirección servicio</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" name="direccion_frontera" required  id="direccion_frontera" placeholder="Dirección frontera" >
                                 </div>
                              <label for="regimen_comun" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>

                          </div>
                           <div class="col-md-4">

                                <label> C&oacute;digo transformador</label>
                                 <div class="form-group">
                                   <input type="text" class="form-control" name="codigo_transformador" id="codigo_transformador" required readonly="true"  placeholder="Código Transformador" >
                                 </div>
                                <label for="regimen_comun" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>

                          </div>
                          <div class="col-md-4">

                                 <label> Serie</label>
                                 <div class="form-group">
                                   <input type="text" class="form-control" name="serie" id="serie" required readonly="true" placeholder="Serie" >
                                 </div>
                                <label for="serie" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>


                          </div>
                  </div>
                  <div class="row">
                          <div class="col-md-4">
                              <label>Municipio</label>
                              <div class="form-group">
                                <input type="text" id="municipio" name="municipio" class="form-control" required  placeholder="Municipio" >
                              </div>
                              <label for="regimen_comun" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>
                          </div>
                          <div class="col-md-4">

                              <label>email</label>
                              <div class="form-group">
                                <input type="text" id="email" name="email" class="form-control" onblur="validateEmail(this.value)" required  placeholder="email" >
                              </div>
                              <label for="regimen_comun" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>

                          </div>
                          <div class="col-md-4">

                                <label>Teléfono</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="telefono_correspondencia" onblur="validatePhone(this.value)"  required  id="telefono_correspondencia" placeholder="Teléfono Correspondencia" >
                                 </div>
                                <label for="regimen_comun" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>

                           </div>
                   </div>
                  <div class="row">
                          <div class="col-md-6">

                             <label> Estrato</label>
                              <select id="estrato" name="estrato" class="form-control" required  >
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="ESTRA">ESTRA</option>
                               </select>
                               <label for="estrato" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>

                          </div>
                          <div class="col-md-6">

                                <label>Tipo Cliente</label>
                                <select id="tipo" name="tipo" class="form-control" required   >
                                <option value="ASOCIADO">ASOCIADO</option>
                                <option value="FRONTERA COMERCIAL">FRONTERA COMERCIAL</option>
                                <option value="INDUSTRIAL">INDUSTRIAL</option>
                                <option value="OFICIAL">OFICIAL</option>
                               </select>
                                <label for="regimen_simplificado" class="error" style="display:none;"></label>
                                <div class="help-block with-errors"></div>

                      </div>
                 </div>
                  <div class="row">
                      <div class="col-md-12">
                          <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                              <strong>DATOS DEL PROMOTOR</strong>
                          </h5>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-4">
                          <label>Nombre</label>
                          <div class="form-group">
                              <input type="text" id="nombrePromotor" name="nombrePromotor" required  class="form-control" placeholder="Nombre promotor" >
                              <label for="regimen_comun" class="error" style="display:none;"></label>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <label>email</label>
                          <div class="form-group">
                              <input type="text" id="emailPromotor" name="emailPromotor" class="form-control" onblur="validateEmail(this.value)" required  placeholder="email promotor" >
                          </div>
                          <label for="regimen_comun" class="error" style="display:none;"></label>
                          <div class="help-block with-errors"></div>
                      </div>
                      <div class="col-md-4">
                          <label>Teléfono</label>
                          <div class="form-group">
                              <input type="number" class="form-control" name="telefonoPromotor" onblur="validatePhone(this.value)"  required  id="telefonoPromotor" placeholder="Teléfono Promotor" >
                          </div>
                          <label for="regimen_comun" class="error" style="display:none;"></label>
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
              </div>
       </div>
       <div id="step-3">
          <div id="form-step-2" role="form" data-toggle="validator">
           
           <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px">
                                <strong>TIPO DE GENERACIÓN A INSTALAR</strong>
                            </h5>
                </div>
             </div>	
             
             <div class="row">
          	 <div class="col-md-3">
                        <label>Tipo</label>
                        <div class="form-group">
	                        <select id="tipo_generacion_instalar" name="tipo_generacion_instalar" class="form-control" required  onchange="changeOption(this.value)">
	                        	<option value="" selected>Seleccione...</option>
	                            <option value="Generador distribuido-GD">Generador distribuido-GD</option>
	                            <option value="Autogenerador-AGPE">Autogenerador-AGPE</option>
                              <option value="Autogenerador-AGGE">Autogenerador-AGGE</option>
	                        </select> 
	                        <div class="help-block with-errors"></div>
                        </div>
                        
              </div>
          	   <div class="col-md-3"  style="display:none;" id="tipo_generacion_auto">
                        <label >Entrega excedentes a la red:</label>
                        <div class="form-group">
	                        <select id="entrega_excedentes_red" name="entrega_excedentes_red" class="form-control" required  >
	                        	<option value="" selected >Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select>
	                        <div class="help-block with-errors"></div>
                        </div> 
                       
              </div>
              <div class="col-md-3"  style="display:none;" id="fecha_generacion_auto">
                        <label >Fecha conexión del proyecto:</label>
                      	 	  <div class='input-group date' id='datetimepicker3'>
                      	 	  	<div class="form-group">
			                    	<input type='text' class="form-control" id="fecha_generacion_autogeneracion" name="fecha_generacion_autogeneracion" value="" required />
			                    	 <label for="fecha_generacion_autogeneracion" class="error" style="display:none;"></label>
                        			 <div class="help-block with-errors"></div>
			                    </div>	
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-time"></span>
			                    </span>
              				  </div>
                       
                        <script type="text/javascript">
								  
											    $( "#datetimepicker3" ).datepicker({
																	    format: 'mm/dd/yyyy'
																	});
											  
						</script>
              </div>
               <div class="col-md-4"  style="display:none;" id="fecha_generacion_distri">
                      <label>Fecha entrada en operación comercial:</label>
                      <div class='input-group date' id='datetimepicker2'>
                        <div class="form-group">
			                        <input type='text' class="form-control" id="fecha_generacion_distribucion" name="fecha_generacion_distribucion" value=""  required />
			                        <label for="fecha_generacion_distribucion" class="error" style="display:none;"></label>
                        	  <div class="help-block with-errors"></div>
			                  </div>
                          <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                          </span>
              				</div>
                      <script type="text/javascript">
								  
	 									    $( "#datetimepicker2" ).datepicker({
																	    format: 'mm/dd/yyyy'
																	});
											  
					            </script>
              </div>
          	</div>
          	
          	<div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>TIPO DE TECNOLOGÍA UTILIZADA</strong>
                            </h5>
                </div>
             </div>
            <div class="row">
          		<div class="col-md-4">
          			    <div class="form-group">
                                <select id="tipo_tecnologia_utilizada" name="tipo_tecnologia_utilizada" class="form-control" required onchange="changeOption2(this.value)" >
                                    <option value="" selected>Seleccione...</option>
                                    <option value="Solar F">Solar F</option>
                                    <option value="Hidraulica">Hidráulica</option>
                                    <option value="Biomasa">Biomasa</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Cogeneracion">Cogeneración</option>
                                    <option value="Eolica">Eólica</option>
                                </select>
                                <div class="help-block with-errors"></div>
                        </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <select id="recurso_energetico" name="recurso_energetico" class="form-control" required onchange="changeOptionEnergy(this.value)">
                          <option value="" selected="">Seleccione...</option>

                      </select>
                      <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <select id="tipo_tecnologia" name="tipo_tecnologia" class="form-control" required >
                          <option value="" selected="">Seleccione...</option>

                      </select>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
				    <label >Cuenta con almacenamiento de energia:</label>
				       <div class="form-group">
	                   <select id="almacen_energia" name="almacen_energia" class="form-control" required onchange="changeOption3(this.value)">
	                        	<option value="" selected >Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select>
	                        <div class="help-block with-errors"></div>
                        </div> 
                  </div>
                  
                  <div class="row" id="almacen_energia_cap" style="display: none;" >
                    <div class="col-md-11">
                    <div class="form-group">
                     		  <label>Capacidad(kW)</label>
                     		  <input type="text" class="form-control" name="energia_cap" id="energia_cap" placeholder="Escriba capacidad" >
                          <div class="help-block with-errors"></div>
                     </div>
                     </div>
         	     </div>
         	     <div class="row" id="almacen_energia_ene" style="display: none;" >
                    <div class="col-md-11">
                    <div class="form-group">
                     		  <label>Energia(kWh)</label>
                     		  <input type="text" class="form-control" name="energia_ene" id="energia_ene" placeholder="Escriba energia" >
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div> 
         	     </div>
         	     </div> 
         	     
              	<div class="row">
                <div class="col-md-4"  id="basado_inversores_auto">
                        <label >Sistema basado en inversores:</label>
                        <div class="form-group">
	                        <select id="basado_inversores" name="basado_inversores" class="form-control" required  >
	                        	<option value="" selected >Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select>
	                        <div class="help-block with-errors"></div>
                        </div>     
                  </div>
		          <div class="col-md-4"  id="basado_maq_sin_auto">
                        <label >Sistema basado en máquinas sincrónicas:</label>
                        <div class="form-group">
	                        <select id="basado_maq_sin" name="basado_maq_sin" class="form-control" required  >
	                        	<option value="" selected >Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select>
	                        <div class="help-block with-errors"></div>
                        </div>
                  </div>
                  <div class="col-md-4"  id="basado_maq_asi_auto">
                        <label >Sistema basado en máquinas asincrónicas:</label>
                        <div class="form-group">
	                        <select id="basado_maq_asi" name="basado_maq_asi" class="form-control" required  >
	                        	<option value="" selected >Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select>
	                        <div class="help-block with-errors"></div>
                        </div>  
                  </div>	   
			  
			      <div class="col-md-12">
				  <div class="form-group">
               		       <label>Otro, cual?</label>
               		       <textarea class="form-control" name="otro_tipo" id="otro_tipo" placeholder="Descripcion" ></textarea> 
               		       <div class="help-block with-errors"></div>
                   </div>
				   </div>
              </div>
           
               <HR width="100%" align="center"></HR>
           <div class="row" id="div_info_solar_fv" style="display: none;" >
          		<div class="col-md-4">
                	<label>Potencia por panel(W):</label>
	                	<div class="form-group">
	                      <input type="text" id="potencia_panel" name="potencia_panel" class="form-control" required>
	                    </div>  
                      <label for="potencia_panel" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>
              	</div>
                <div class="col-md-4">
                        <label >Fecha de instalación:</label>
                      	 	  <div class='input-group date' id='datetimepicker5'>
                      	 	  	<div class="form-group">
			                    	<input type='text' class="form-control" id="fecha_instalacion_solar_fv" name="fecha_instalacion_solar_fv" value="" required />
			                    	 <label for="fecha_instalacion_solar_fv" class="error" style="display:none;"></label>
                        			 <div class="help-block with-errors"></div>
			                    </div>	
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-time"></span>
			                    </span>
              				  </div>
                       
                        <script type="text/javascript">
								  
											    $( "#datetimepicker5" ).datepicker({
																	    format: 'mm/dd/yyyy'
																	});
											  
						</script>
                </div>	
          	   
          	    <div class="col-md-4">
                    <label>Número de paneles: </label>
                    <div class="form-group">
                    	<input type="text"  name="nro_paneles" id="nro_paneles" class="form-control" required >
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div> 	
          
          
          <div class="row" id="div_info_solar_fv_2"  style="display: none;">
          		<div class="col-md-4">
                	<label>Posee relé de flujo inverso:</label>
	                	<div class="form-group">
	                     <select id="rele_flujo_inverso" name="rele_flujo_inverso" class="form-control" required  >
                        	<option value="" selected>Seleccione...</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select> 
	                    </div>  
                      <label for="rele_flujo_inverso" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>
              	</div>
          	   <div class="col-md-4">
                    <label>Capacidad en DC (kW DC): </label>
                      <div class="form-group">
                      	<input type="text" id="capacidad_dc" name="capacidad_dc" class="form-control" required>
                      </div>	
                      <label for="capacidad_dc" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>
          	    </div>
          	    <div class="col-md-4">
                    <label>Potencia total en AC (kW AC): </label>
                    <div class="form-group">
                    	<input type="text"  name="potencia_total" id="potencia_total" class="form-control" required >
                    </div>
                      <label for="potencia_total" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>
                </div>
             </div>
             <div class="row" id="div_info_solar_fv_3" style="display: none;">
              	 <div class="col-md-4">
                    <label>Voltaje salida del inversor (V): </label>
                    <div class="form-group">
                    	<input type="text"  name="voltaje_salida" id="voltaje_salida" class="form-control" required >
                    </div>
                      <label for="voltaje_salida" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>                
                </div>
                 <div class="col-md-4">
                    <label>Número de fases: </label>
                    <div class="form-group">
                    	<input type="text"  name="numero_fases" id="numero_fases" class="form-control" required >
                    </div>
                      <label for="numero_fases" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>                
                 </div>
				 
				 <div class="col-md-4">
                    <label>Voltaje entrada del inversor (V): </label>
                    <div class="form-group">
                    	<input type="text"  name="voltaje_entrada" id="voltaje_entrada" class="form-control" required >
                    </div>
                      <label for="voltaje_entrada" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>                
                 </div>
				 <div class="col-md-4">
                    <label>Numero de inversores: </label>
                    <div class="form-group">
                    	<input type="text"  name="numero_inversores" id="numero_inversores" class="form-control" required >
                    </div>
                      <label for="numero_inversores" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>                
                 </div>
                 
				 <div class="col-md-4">
                    <label>Fabricantes de los inversores: </label>
                    <div class="form-group">
                    	<input type="text"  name="fabricante_inversores" id="fabricante_inversores" class="form-control" required >
                    </div>
                      <label for="fabricante_inversores" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>                
                 </div>
				 <div class="col-md-4">
                    <label>Modelo de los inversores: </label>
                    <div class="form-group">
                    	<input type="text"  name="modelo_inversores" id="modelo_inversores" class="form-control" required >
                    </div>
                      <label for="modelo_inversores" class="error" style="display:none;"></label>
                      <div class="help-block with-errors"></div>                
                 </div>
				 
            <div class="row">
         	  	 <div class="col-md-8">
				   <div class="form-group">
				       <label>Cumple estándar UL 1741-2010 o superior:</label>
         		         <select id="estandar_ul" name="estandar_ul" class="form-control" required  onchange="changeOption4(this.value)">
                        	<option value="" selected>Seleccione...</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select> 
                        <div class="help-block with-errors"></div>
                    </div>
         	      </div>
				  <div class="col-md-3" id="ver_ul_si"  style="display: none;" >
				        <label >Version(Año):</label>
                      	 	  <div class='input-group date' id='datetimepicker6'>
                      	 	  	<div class="form-group">
			                    	<input type='text' class="form-control" id="ver_ul" name="ver_ul" value="" required />
			                    	 <label for="ver_ul" class="error" ></label>
                        			 <div class="help-block with-errors"></div>
			                    </div>	
			                    <span 	class="input-group-addon">
			                        <span class="glyphicon glyphicon-time"></span>
			                    </span>
              				  </div>
                       
                        <script type="text/javascript">
								  
											    $( "#datetimepicker6" ).datepicker({
																	    format: 'mm/dd/yyyy'
																	});
											  
						</script>
              </div>
              
				  <div class="col-md-8">
				      <div class="form-group">
         		         <label>Cumple estándar IEC 61727-2004 o superior:</label>
         		         <select id="estandar_iec" name="estandar_iec" class="form-control" required onchange="changeOption5(this.value)" >
                        	<option value="" selected>Seleccione...</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select> 
                        <div class="help-block with-errors"></div>
                    </div>
         	      </div> 
         	      
         	      <div class="col-md-3" id="ver_iec_si"  style="display: none;">
                        <label >Version(Año):</label>
                      	 	  <div class='input-group date' id='datetimepicker7'>
                      	 	  	<div class="form-group">
			                    	<input type='text' class="form-control" id="ver_iec" name="ver_iec" value="" required />
			                    	 <label for="ver_ul" class="error" ></label>
                        			 <div class="help-block with-errors"></div>
			                    </div>	
			                    <span 	class="input-group-addon">
			                        <span class="glyphicon glyphicon-time"></span>
			                    </span>
              				  </div>
                       
                        <script type="text/javascript">
								  
											    $( "#datetimepicker7" ).datepicker({
																	    format: 'mm/dd/yyyy'
																	});
											  
						</script>
            </div>
            </div>
		   
		   <div class="row">
                <div class="col-md-12">
                            <h4 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>Nota: Tener en cuenta que los inversores deben cumplir el estándar UL 1741-2010(o superior), o el estándar IEC 61727-2004(o superior). Si no se cumple con alguno de estos dos estándares, la solicitud de conexión será rechazada. Para su información, los dos estándares referenciados estan alineados con el estándar IEEE 1547 de 2003.</strong>
                            </h4>
                </div>
           </div>
          	 
          	 <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>TRANSFORMADOR</strong>
								<BR>
                                (aplica cuando el punto de conexión con el Operador de Red-OR del AGPE o GD sea en el nivel de tensión N2 o N3)
                            </h5>
                </div>
           </div>
              <div class="row">
         	     
         	     <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Potencia nominal (kVA)</label>
                     		  <input type="text" class="form-control" name="potencia" id="potencia" placeholder="Escriba la potencia"  />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
         	     <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Impedancia de C.C (%)</label>
                     		  <input type="text" class="form-control" name="impedancia" id="impedancia" placeholder="Escriba la impedancia"  />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
         	     <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Grupo de conexi&oacute;n</label>
                     		  <input type="text" class="form-control" name="grupo" id="grupo" placeholder="Escriba el grupo"  />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
            </div>
          
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
              		       <label>En caso que sea un AGPE y no entregue excedentes, indicar los elementos de protecci&oacute;n,control y maniobra(por ejemplo I)Relé de potencia inversa; II)Regulación automática del inversor vs carga y; III)Protécciones internas inherentes al inversor):</label>
               		       <textarea class="form-control" name="descripcion_elementos_proteccion_trafo"  id="descripcion_elementos_proteccion_trafo" placeholder="Descripcion"  ></textarea>
                         <div class="help-block with-errors"></div>
                   </div>
              </div>
           </div>
          
          
        </div>
       </div>
          </div>
       <div id="step-4">
          <div id="form-step-3" role="form" data-toggle="validator">
	   
	   
           <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>GENERADOR</strong>
                            </h5>
                </div>
           </div>
           <div class="row">
              <div class="col-md-4">
                    <div class="form-group">
                   		  <label>Fabricante del generador</label>
                   		  <input type="text" class="form-control" name="fabricante_generador" id="fabricante_generador" placeholder="Nombre fabricante" required />
                        <div class="help-block with-errors"></div>
                   </div>
              </div>
             <div class="col-md-4">
                    <div class="form-group">
                   		  <label>Modelo del generador</label>
                   		  <input type="text" class="form-control" name="modelo_generador" id="modelo_generador" placeholder="Escriba el modelo" required />
                        <div class="help-block with-errors"></div>
                   </div>
              </div>
			  <div class="col-md-4">
                    <div class="form-group">
                   		  <label>Voltaje del generador(V)</label>
                   		  <input type="text" class="form-control" name="voltaje_generador" id="voltaje_generador" placeholder="Escriba el voltaje" required />
                        <div class="help-block with-errors"></div>
                   </div>
              </div>
            </div>
            <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Potencia nominal (kVA)</label>
                          <input type="text" class="form-control" name="potencia_nominal" id="potencia_nominal" placeholder="Escriba la potencia" required >
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Factor de potencia</label>
                          <input type="text" class="form-control" name="factor_potencia" id="factor_potencia" placeholder="Escriba el factor" required >
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>N&uacute;mero de fases</label>
                          <input type="text" class="form-control" name="numero_fases_generador" id="numero_fases_generador" placeholder="Escriba el # fases" required >
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Reactancia subtransitoria xd"(p.u)</label>
                          <input type="text" class="form-control" name="reactancia_subtransitoria" id="reactancia_subtransitoria" placeholder="Escriba la reactancia" required >
                          <div class="help-block with-errors"></div>
                      </div>
                  </div>
                </div>
           <HR width="100%" align="center"></HR>
           <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>TRANSFORMADOR</strong>
								<BR>
                                (aplica cuando el punto de conexión con el Operador de Red-OR del AGPE o GD sea en el nivel de tensión N2 o N3)
                            </h5>
                </div>
           </div>
              <div class="row">
         	      <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Potencia nominal (kVA)</label>
                     		  <input type="text" class="form-control" name="potencia_nominal_trafo" id="potencia_nominal_trafo" placeholder="Escriba la potencia"  />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
         	     <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Impedancia de C.C (%)</label>
                     		  <input type="text" class="form-control" name="impedancia_cc" id="impedancia_cc" placeholder="Escriba la impedancia"  />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
         	     <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Grupo de conexi&oacute;n</label>
                     		  <input type="text" class="form-control" name="grupo_conexion" id="grupo_conexion" placeholder="Escriba el grupo"  />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
              		       <label>Indicar los elementos de protecci&oacute;n,control y maniobra(por ejemplo I)Relé de potencia inversa; II)Regulación automática del inversor vs carga y; III)Protécciones internas inherentes al inversor):</label>
               		       <textarea class="form-control" name="descripcion_elementos_proteccion_trafo"  id="descripcion_elementos_proteccion_trafo" placeholder="Descripcion"  ></textarea>
                         <div class="help-block with-errors"></div>
                   </div>
              </div>
           </div>
           <div class="row">
          	 <div class="col-md-6">
                  <div class="form-group">
              		       <label>Cumple est&aacute;ndar IEEE 1547-2003</label>
	         		             <select id="estandar_ieee_ni" name="estandar_ieee_ni" class="form-control" Ochange="changeOption6(this.value)" >
	                        	<option value="" selected>Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select>
                        <div class="help-block with-errors"></div>
                   </div>
              </div>
              
              <div class="col-md-3"  id="ver_ieee_si" style="display: none;">
                      <label >Version(Año):</label>
                      	 	  <div class='input-group date' id='datetimepicker8'>
                      	 	  	<div class="form-group">
			                    	<input type='text' class="form-control" id="ver_ieee" name="ver_ieee" value="" />
			                    	 <label for="ver_ieee" class="error" ></label>
                        			 <div class="help-block with-errors"></div>
			                    </div>	
			                    <span 	class="input-group-addon">
			                        <span class="glyphicon glyphicon-time"></span>
			                    </span>
              				  </div>
                       
                        <script type="text/javascript">
								  
											    $( "#datetimepicker8" ).datepicker({
																	    format: 'mm/dd/yyyy'
																	});
											  
						</script>
              </div>
           </div>
             
			<div class="row">
			  <div class="col-md-12">
          <h5 class="card-header info-color py-2" style=" margin-bottom:15px; margin-top:15px">
                    Nota:Tener en cuenta que si no se cumple este estándar, la solicitud será rechazada.
			    </h5>
        </div>
			</div>
			 
          </div>
        </div>
       <div id="step-5" class="">
        <div id="form-step-4" role="form" data-toggle="validator">
        	 <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>DATOS DEL PUNTO DE CONEXIÓN</strong>
                            </h5>
                </div>
            </div>
			
			<div class="row">
         	      <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Potencia nominal del sistema(kW)</label>
                     		  <input type="text" class="form-control" name="potencia_nominal_trafo" id="potencia_nominal_trafo" placeholder="Escriba la potencia" required />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
				 
         	      <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Potencia máxima declarada (kW):</label>
                     		  <input type="text" class="form-control" name="potencia_entrega_red" id="potencia_entrega_red" placeholder="Escriba la potencia" required />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>            
			
         	      <div class="col-md-4">
                    <div class="form-group">
                     		  <label>Nivel de tensíon (kW)</label>
                     		  <input type="text" class="form-control" name="nivel_tension" id="nivel_tension" placeholder="Escriba el nivel" required />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
		    </div>
			
			<div class="row">
         	      <div class="col-md-10">
                    <div class="form-group">
                     		  <label>Si entrega excedentes o es un cliente nuevo, código de la subestación, transformador o circuito al cual se realizará la conexión:</label>
                     		  <input type="text" class="form-control" name="codigo_subestacion" id="codigo_subestacion" placeholder="Escriba el codigo"  />
                          <div class="help-block with-errors"></div>
                     </div>
         	     </div>
		    </div>

           <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>PROTECCION ANTI-ISLA</strong>
								<BR>
                            (Describa la caracteristica de la proteccion a instalar)
							</h5>
                </div>
           </div>
		   
		   <div class="row">
          	 <div class="col-md-12">
                  <div class="form-group" required onchange="changeOption5(this.value)">
              		       <label>Para sistemas de generación basados en inversores, la función de protección está en dichos inversores?</label>
	         		         <select id="proteccion_inversores" name="proteccion_inversores" class="form-control" required onchange="changeOption7(this.value)"   >
	                        	<option value="" selected>Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select> 
                        <div class="help-block with-errors"></div>
                   </div>
              </div>
           </div>
		   <div class="row" id="descripcion_proteccion"  style="display: none;">
              <div class="col-md-12">
                  <div class="form-group">
              		       <label>Si la respuesta anterior es NO, describir brevemente como se garantiza la función Anti-isla(arreglo de protecciones).Es importante mencionar que este requerimiento es esencial para garantizar la calidad y seguridad de la prestación del servicio de energía eléctrica. En el caso que esta protección no sea instalada la solicitud será rechazada.</label>
               		       <textarea class="form-control" name="descripcion_elementos_proteccion_trafo"  id="descripcion_elementos_proteccion_trafo" placeholder="Descripcion"  ></textarea> 
                         <div class="help-block with-errors"></div>
                   </div>
              </div>
           </div>

                          <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>DOCUMENTOS QUE DEBE APORTAR EL SOLICITANTE PARA LA APROBACION DE LA CONEXIÓN DEL PROYECTO</strong>
                            </h5>
                </div>
           </div>
                
            	 <div class="row">
                	<div class="col-md-12">
		                <div class="form-group">
		                	<label style="color:red";>(Por favor no adjuntar el nombre del archivo con caracteres especiales tales como : tíldes, ñ, espacios en blanco)</label>
		                	<input type="file"  name="proyecto_final[]" id="proyecto_final" value="" required />
		                	<div class="help-block with-errors"></div>
		                </div>
		            </div>    	
                </div>
          <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>CONDICIONES A TENER EN CUENTA POR EL SOLICITANTE PARA LA APROBACION DE LA CONEXIÓN DEL PROYECTO</strong>
                            </h5>
                </div>
           </div>
		   
		   <div class="row">
                <div class="col-md-12">
                	<ul>
                		<li>Para dispositivos o elementos que no estén cobijados por el RETIE, se requiere el Certificado de conformidad de producto bajo norma internacional o norma reconocida (estándares UL 1741 o IEC 61727, como se presenta en el numeral 5).</li>
                    <li>Cumplir con los requerimientos de protecciones definidos por el CNO en su Acuerdo 1071 de 2018 o aquel que lo modifique o sustituya, disponible en el siguiente vínculo <a href="https://www.cno.org.co/content/acuerdo-1071-por-el-cual-se-aprueba-el-documento-requisitos-de-protecciones-para-la-conexion" target=_blank>https://www.cno.org.co/content/acuerdo-1071-por-el-cual-se-aprueba-el-documento-requisitos-de-protecciones-para-la-conexion</a>.</li>
                  </ul>
                </div>
           </div>
           <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>INFORMACIÓN DEL SISTEMA DE MEDICIÓN</strong>
                            </h5>
                </div>
           </div>
          <div class="row">
        		<div class="col-md-12">
                   	<div class="form-group">
                   	Los medidores deben cumplir con los índices de clase y clase de exactitud establecidos en la Res. CREG 038 de 2014 o aquella que la modifique, complemente y/o sustituya.
                	</div>
                </div>
          </div>
          <div class="row">
                <div class="col-md-4">
                	<div class="form-group">
                	<label>¿El cliente suministra el medidor?</label>
	         		         <select id="cln_suministra_medidor" name="cln_suministra_medidor" class="form-control" required  >
	                        	<option value="" selected>Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select> 
                        <div class="help-block with-errors"></div>
                	</div>
                </div>
                <div class="col-md-4">
                	<div class="form-group">
                	 <label>¿El medidor es bidireccional?</label>
	         		         <select id="medidor_bidireccional" name="medidor_bidireccional" class="form-control" required  >
	                        	<option value="" selected>Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select> 
                        <div class="help-block with-errors"></div>
                	</div>
                </div>
                 <div class="col-md-4">
                	<div class="form-group">
                	<label>¿El medidor tiene perfil horario?</label>
	         		         <select id="medidor_perfil_horario" name="medidor_perfil_horario" class="form-control" required  >
	                        	<option value="" selected>Seleccione...</option>
	                            <option value="Si">Si</option>
	                            <option value="No">No</option>
	                        </select> 
                        <div class="help-block with-errors"></div>
                	</div>
                </div>					
          </div>
		  <div class="row">
        		<div class="col-md-12">
                   	<div class="form-group">
                   	Debe anexarse al presente formulario el certificado de calibración emitido por un organismo acreditadopor el ONAC.
                	</div>
                </div>
          </div>
          <div class="row">
                <div class="col-md-12">
                	<div class="form-group">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>PROYECCIÓN DE ENERGÍA GENERADA Y CONSUMIDA (kWh-mes).</strong>
                            </h5>
                    </div>        
                </div>
           </div>
           <div class="row">     
                <div class="col-md-12">
                	Proyección de la energía generada por el sistema a entregar a la red del OR por mes (kWh-mes)
                	<div class="table-responsive">
						    <table class="table table-bordered table-striped table-highlight">
						      <thead>
						        <th>Mes 1</th>
						        <th>Mes 2</th>
						        <th>Mes 3</th>
						        <th>Mes 4</th>
						        <th>Mes 5</th>
						        <th>Mes 6</th>
						        <th>Mes 7</th>
						        <th>Mes 8</th>
						        <th>Mes 9</th>
						        <th>Mes 10</th>
						        <th>Mes 11</th>
						        <th>Mes 12</th>
						      </thead>
						      <tbody>
						        <tr>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m1" id="proy_ener_gen_or_m1" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m2" id="proy_ener_gen_or_m2" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m3" id="proy_ener_gen_or_m3" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m4" id="proy_ener_gen_or_m4" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m5" id="proy_ener_gen_or_m5" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m6" id="proy_ener_gen_or_m6" required onblur="validateEnergy(this.id,this.value)"  class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m7" id="proy_ener_gen_or_m7" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m8" id="proy_ener_gen_or_m8" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m9" id="proy_ener_gen_or_m9" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m10" id="proy_ener_gen_or_m10" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m11" id="proy_ener_gen_or_m11" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						          <td><input type="text" data-proy-ene name="proy_ener_gen_or_m12" id="proy_ener_gen_or_m12" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0"  /></td>
						        </tr>
						      </tbody>
						    </table>
					</div>
                </div>
           </div>
           <div class="row">     
                <div class="col-md-12">
                	Proyección de la energía generada por el sistema para consumo interno por mes (kWh-mes)
                	<div class="table-responsive">
						    <table class="table table-bordered table-striped table-highlight">
						      <thead>
						        <th>Mes 1</th>
						        <th>Mes 2</th>
						        <th>Mes 3</th>
						        <th>Mes 4</th>
						        <th>Mes 5</th>
						        <th>Mes 6</th>
						        <th>Mes 7</th>
						        <th>Mes 8</th>
						        <th>Mes 9</th>
						        <th>Mes 10</th>
						        <th>Mes 11</th>
						        <th>Mes 12</th>
						      </thead>
						      <tbody>
						        <tr>
						          <td><input type="text" name="proy_ener_gen_ci_m1" id="proy_ener_gen_ci_m1" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m2" id="proy_ener_gen_ci_m2" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m3" id="proy_ener_gen_ci_m3" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m4" id="proy_ener_gen_ci_m4" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m5" id="proy_ener_gen_ci_m5" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m6" id="proy_ener_gen_ci_m6" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m7" id="proy_ener_gen_ci_m7" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m8" id="proy_ener_gen_ci_m8" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m9" id="proy_ener_gen_ci_m9" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m10" id="proy_ener_gen_ci_m10" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m11" id="proy_ener_gen_ci_m11" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						          <td><input type="text" name="proy_ener_gen_ci_m12" id="proy_ener_gen_ci_m12" required onblur="validateEnergy(this.id,this.value)" class="form-control" value="0" /></td>
						        </tr>
						      </tbody>
						    </table>
					</div>
                </div>
           </div>
       </div>
       </div>    
       <div id="step-6" class="">
            <div id="form-step-5" role="form" data-toggle="validator">
                

        	    <div class="row">
		           	<div class="col-md-12">
		                <div class="form-group">	
		              			  <label>Observaciones</label>
		              				<textarea id="descripcion_gral_proyecto" class="form-control" name="descripcion_gral_proyecto" placeholder="Aclaraciones que desee realizar sobre el proyecto" rows="7" required ></textarea>
		      
		                            <div class="help-block with-errors">Escriba la observación del proyecto</div>
		                </div>
		        	</div>
                </div>
              <div class="row">
                <div class="col-md-4">
                        <label>Fecha de puesta en operación:</label>
                        <div class='input-group date' id='datetimepicker_po'>
                          <div class="form-group">
                                <input type='text' class="form-control" id="fecha_puesta_operacion" name="fecha_puesta_operacion" value=""  required />
                                <label for="fecha_puesta_operacion" class="error" style="display:none;"></label>
                              <div class="help-block with-errors"></div>
                          </div>
                            <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                        <script type="text/javascript">
                    
                          $( "#datetimepicker_po" ).datepicker({
                                        format: 'mm/dd/yyyy'
                                    });
                          
                        </script>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                            <h5 class="card-header info-color py-2" style="text-align:center; margin-bottom:15px; margin-top:15px">
                                <strong>NOTA 1:</strong> Remitir formulario en formato Excel y PDF (firmado)  y el anexo correspondiente del proyecto al correo electrónico escribanos@ruitoqueesp.com con el siguiente asunto, y cargar la información al aplicativo de la página web del OR (hasta que la ventanilla única de la UPME esté habilitada): Asunto: FORMULARIO SIMPLIFICADO PARA SOLICITUD DE CONEXIÓN DE  GD, AGPE y AGGE  CON POTENCIA MAXIMA DECLARADA MENOR A 5 MW.
                                <br>
                                <strong>NOTA 2:</strong> Para proyectos que se conecten en el Nivel de tensión 1, adjuntar el archivo de la consulta de disponibilidad de punto de conexión de la página web del OR con los datos del punto solicitado
                                <br>
                                <strong>NOTA 3:</strong> Las solicitudes que no lleguen con la información indicada o el formulario incompleto no serán consideradas en el trámite de conexión.
                            </h5>
                            Con el envío de mis datos personales, de manera previa, expresa e inequívoca autorizo a Ruitoque S.A. E.S.P. el Tratamiento de los mismos (o el Tratamiento de los datos personales del menor, mayor de edad o persona en condición de discapacidad que represento) aquí consignados, para que sean almacenados, usados y puestos en circulación o suprimidos, conforme a la Política de Tratamiento de la Información que la organización ha adoptado y que se encuentra publicada en la página web www.ruitoqueesp.com,  que declaro conocer y estar informado de las finalidades de dicho Tratamiento, por estar allí consignadas. También declaro que he sido informado que, para el ejercicio de mis derechos, podré dirigirme ante la organización por medio de los siguientes canales de atención: en la Carrera 25 No 29-57 Centro Comercial Cañaveral, La Cava, local 2 (oficina de servicio al cliente), línea telefónica +57 (7) 6185871, por medio de nuestra página web www.ruitoqueesp.com o a los correos electrónicos escribanos@ruitoqueesp.com y ruitoque-esp@ruitoqueesp.com.
                </div>
           </div>
               
            </div>
        </div> 
<!---------------------------------------------------------------------------------------------------------------------------------------------->
      <?php
          $crearSolicitud = new ControladorSolicitud();
          $crearSolicitud -> ctrCrearSolicitud();
      ?>
  
<!-- aqui va el mapa -->
             
              
  </div>

</div>  
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"> 
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Definiciones</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
    <div class="modal-body">        
        <b>Autogeneración:</b> Aquella actividad realizada por personas naturales o jurídicas que producen energía eléctrica principalmente, para atender sus propias necesidades.</br>																	
        <b>Autogenerador:</b> Usuario que realiza la actividad de autogeneración. El usuario puede ser o no ser propietario de los activos de autogeneración.</br>																	
        <b>Autogenerador a pequeña escala, AGPE:</b> Autogenerador con potencia instalada igual o inferior al límite definido en el artículo primero de la Resolución UPME 281 de 2015 o aquella que la modifique o sustituya.</br>																	
        <b>Capacidad instalada:</b> Es la carga instalada o capacidad nominal que puede soportar el componente limitante de una instalación o sistema eléctrico.</br>																	
        <b>Crédito de energía:</b> Cantidad de energía exportada a la red por un AGPE con FNCER que se permuta contra la importación de energía que éste realice durante un periodo de facturación.</br>																	
        <b>Excedentes:</b> Toda exportación de energía eléctrica realizada por un autogenerador.</br>																	
        <b>Exportación de energía:</b> Cantidad de energía entregada a la red por un autogenerador o un generador distribuido.</br>																	
        <b>FNCER:</b> Son las fuentes no convencionales de energía renovables tales como la biomasa, los pequeños aprovechamientos hidroeléctricos, la eólica, la geotérmica, la solar y los mares.</br>																	
        <b>Generador distribuido, GD:</b> Persona jurídica que genera energía eléctrica cerca de los centros de consumo, y está conectado al Sistema de Distribución Local y con potencia instalada menor o igual a 0,1 MW.</br>																	
        <b>Importación de energía:</b> Cantidad de energía eléctrica consumida de la red por un autogenerador.</br>																	
        <b>Potencia instalada de generación:</b> Valor declarado al Centro Nacional de Despacho, CND, por el generador distribuido en el momento del registro de la frontera de generación expresado en MW, con una precisión de cuatro decimales. Este valor será la máxima capacidad que se puede entregar a la red en la frontera de generación. Para los AGPE este valor corresponde al nominal del sistema de autogeneración declarado al OR durante el proceso de conexión.																	
    </div>    
    </div>
  </div>
</div>  
<div class="modal fade con-bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel_con" aria-hidden="true"> 
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">CONDICIÓN PARA CONECTARSE COMO AGPE Ó GD. </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
    <div class="modal-body">        
       <ul>
       <li>Cualquier usuario que se encuentre conectado a la red y que quiera convertirse en un AGPE lo podrá hacer una vez cumpla con los requisitos establecidos en la presente resolución y se verifique la disponibilidad técnica del sistema al cual se va a conectar según los estándares definidos en el artículo 6. También aplica para nuevos usuarios y generadores distribuidos.</li>																	
	   <li>Todos los AGPE y GD existentes al momento de expedición de esta resolución tienen la obligación de entregar la información que corresponda al OR que se conecten, de acuerdo con su capacidad nominal, dentro de los dos meses siguientes al de la fecha de disponibilidad del formato que defina el OR para tal fin.</li> 																	
	   <li>Cualquier usuario que se encuentre conectado a la red y que quiera convertirse en un AGPE lo podrá hacer una vez cumpla con los requisitos establecidos en la presente resolución y se verifique la disponibilidad técnica del sistema al cual se va a conectar según los estándares definidos en el artículo 6. También aplica para nuevos usuarios y generadores distribuidos.</li>																	
		</ul>															
    </div>    
    </div>
  </div>
</div> 
<div class="modal fade pro-bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel_pro" aria-hidden="true"> 
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Procedimiento simplificado de conexión al STR o SDL del AGPE con potencia instalada menor o igual a 0,1 MW y GD. </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
    <div class="modal-body">        
           <ul>
               <li>Diligenciamiento de la información del formulario de solicitud de conexión simplificada en la página web del OR.</li>																	
               <li>Respuesta del OR a la solicitud. El OR tendrá cinco (5) días hábiles contados a partir del día siguiente al de recibo de la solicitud en la página web para emitir concepto sobre la viabilidad técnica de la conexión.</li>																	
               <li>Posterior a la aprobación de la conexión, el OR dispondrá de dos (2) días hábiles anteriores a la fecha prevista para la entrada en operación informada por el usuario, para verificar los parámetros declarados y efectuar las pruebas requeridas.</li>																	
               <li>Luego de la verificación de parámetros y efectuadas las pruebas pertinentes, el OR dispondrá de dos (2) días hábiles para efectuar la conexión.</li>																	
               <li>El OR podrá verificar las condiciones de conexión en cualquier momento con posterioridad a la fecha de su entrada en operación. En caso de que al momento de la visita no se cumpla alguna de las características contenidas en la solicitud de conexión o que se incumpla la regulación de calidad de la potencia expedida por la Comisión, el OR procederá a deshabilitar la conexión del AGPE o GD hasta que sea subsanada la anomalía encontrada.</li>																	
        	</ul>															
    </div>    
    </div>
  </div>
</div>
<div class="modal fade con-me-bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel_con-me" aria-hidden="true"> 
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">CONDICIONES PARA LA MEDICIÓN. </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
    <div class="modal-body">        
           <ul>
              <li>AGPE que entrega excedentes: debe cumplir con los requisitos establecidos para las fronteras de generación en el Código de Medida, a excepción de las siguientes obligaciones: i) contar con el medidor de respaldo de que trata el artículo 13 de la Resolución CREG 038 de 2014, ii) la verificación inicial por parte de la firma de verificación de que trata el artículo 23 de la Resolución CREG 038 de 2014 y iii) el reporte de las lecturas de la frontera comercial al Administrador del Sistema de Intercambios Comerciales, ASIC, cuando se vende la energía al comercializador integrado con el OR al cual se conecta. En el caso de los consumos de energía, el sistema de medición debe cumplir los requisitos mínimos definidos en la Resolución CREG 038 de 2014 o aquella que la modifique o sustituya de acuerdo con su condición de usuario regulado o no regulado. En los casos que el AGPE sea atendido por el comercializador integrado con el OR, este comercializador tiene la obligación de reportar las medidas de los AGPE al ASIC dentro de las 48 horas del mes siguiente al de la entrega de energía.</li>																	
              <li>GD: Los generadores distribuidos deben cumplir con los requisitos establecidos para las fronteras de generación en el Código de Medida, incluidas la obligación de contar con el medidor de respaldo de que trata el artículo 13 y la de la verificación inicial por parte de la firma de verificación de que trata el artículo 23 de la Resolución CREG 038 de 2014 o aquella que la modifique o sustituya.</li>																	
			</ul>															
    </div>    
    </div>
  </div>
</div>
<div class="modal fade info-fac-bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel_info-fac" aria-hidden="true"> 
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Información Factura</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
    <div class="modal-body">        
          <img src="vistas/img/factura.png">															
    </div>    
    </div>
  </div>
</div>
<div class="modal fade con-imp-bd-example-modal-lg" tabindex="-1" role="dialog" id="importante_button" aria-labelledby="myLargeModalLabel_con-imp" aria-hidden="true"> 
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">IMPORTANTE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
    <div class="modal-body">        
           <ul>
              <li>Todo proyecto de conexión que se presente debe contener lo indicado en el Instructivo para el procedimiento de conexión de Autogeneradores a Pequeña Escala (hasta 1MW), Autogeneradores a Gran Escala (hasta 5MW) y Generadores Distribuidos
(hasta 1MW), descárguelo <a href="https://creg.ruitoqueesp.com/Estudio%20de%20Conexion%20Simplificado%20RTQD.pdf" target="_blank">aquí</a></li>																
			</ul>
			 <ul>
			   <li>Descargue aquí el formato para su solicitud de conexión <a href="https://creg.ruitoqueesp.com/EN-FO-10%20Formato%20Solicitud%20de%20conexion%20AGPE%20y%20GD.xlsx" target="_blank">aqui</a></li> 
			 </ul>
       <ul>
         <li><a href="Acuerdo.pdf" target=_blank>Acuerdo 1545 de CNO</a></li>
         <li><a href="anexo_1_acuerdo_1545.pdf" target=_blank>Anexo 1</a></li>
         <li><a href="anexo_2_acuerdo_1545.pdf" target=_blank>Anexo 2</a></li>
       </ul>    
        

    </div>    
    </div>
  </div>
</div>
<div class="modal fade con-imp-bd-example-modal-lgsb" tabindex="-1" role="dialog" id="solar_button" aria-labelledby="myLargeModalLabel_con-imp" aria-hidden="true"> 
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">OFERTA SOLAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
    <div class="modal-body">        
           <ul>
              <li>La solicitud de conexión e instalación se puede realizar por cualquier interesado, cumpliendo con lo establecido en la resolución CREG 174 de 2021.
                  Así mismo puede contratar los servicios de instalación con un tercero.
                  Para conocer la oferta dispuesta por el OR ingrese <a href="PLEGABLE-VIVE-TU-HOGAR-CRECE-TU-EMPRESA.pdf" target="_blank">aquí</a></li>																
		    	</ul>
		</div>    
    </div>
  </div>
</div>
<div id="ex5" class="modal" style="display: none;">
  <p>If you do this, be sure to provide the user with an alternate method of <a href="#" rel="modal:close">closing the window.</a></p>
</div>

<script>

function hidePage()
{
  document.getElementById("loader").style.display = "block";
  //document.getElementById("step-1").style.display = "none";
 
  $( "#smartwizard" ).fadeTo( "fast" , 0.2, function() {
    // Animation complete.
  });

}

function showPage() 
{
  document.getElementById("loader").style.display = "none";
    $( "#smartwizard" ).fadeTo( "fast" , 1, function() {
  });
}

$(document).ready(function() {

//$('#importante_button').trigger('click');


});

//document.getElementById("importante_button").click();

</script>
     
 <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div id="target_aviso" style="display:none;"><h1  >Ubicación geográfica</h1></div>
          <div id="map"  style="width:100%;height:400px;" >
              
              
          </div> <br><br>
              <script>
                      var map;
                      function initMap(lati,lngi)
                         {
                         
                            var myLatLng = {lat: parseFloat(lati), lng: parseFloat(lngi)};
                            var map = new google.maps.Map(document.getElementById('map'),{zoom: 18, center: myLatLng, mapTypeId: 'satellite' });
                            var contentString = '<div id="content">'+
                                    '<div id="siteNotice">'+
                                    '</div>'+
                                    '<h2 id="firstHeading" class="firstHeading">'+codigo_transformador_global +'</h2>'+
                                    '<div id="bodyContent">'+
                                    '<p><b>Disponibilidad potencia</b>:'+dispo_potencia_global+'</p>'+
                                    '<p><b>Disponibilidad energia</b>:'+dispo_energia_global+'</p>'+
                                    '</div>'+
                                    '</div>';
                
                            var infowindow = new google.maps.InfoWindow({content: contentString});
                            var marker = new google.maps.Marker({position: myLatLng,map: map,title: codigo_transformador_global});
                                marker.addListener('click', function() {infowindow.open(map, marker);});
                         }
                

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAMxaH4x4TM1anbhqQHoa-H_2YhIP_CU8"
    async defer></script>

        </div>
      </div>
    </div>
   
   
</form>



