let flagValidationEnergy = 0;   
$(document).ready(function()
{

    var getdetails = function(codigo_transformador) {
        return $.getJSON("modelos/consulta.php", {
            "codigo_transformador": codigo_transformador
        });
    };
    var getdetails_user = function(codigo_usuario) {
        return $.getJSON("modelos/consulta.php", {
            "codigo_usuario": codigo_usuario
        });
    };
   var getdetails_user_estado = function(codigo_usuario) {
        return $.getJSON("modelos/consulta.php", {
            "codigo_usuario_estado": codigo_usuario
        });
   };
   var getdetails_sol_estado = function(codigo_solicitud) {
        return $.getJSON("modelos/consulta.php", {
            "codigo_solicitud": codigo_solicitud
        });
   };
   var getdetails_user_data_in = function(vlrTrafo){
		return $.getJSON("modelos/consulta.php",{
			"vlr_trafo" : vlrTrafo
		});
   };

    $('[data-trans]').click(function(e)
          {
              hidePage();	
              e.preventDefault();
              $("#response-container").html("<p>Buscando...</p>");
              let vlr_transformador = document.getElementById('codTransformador').value;
              getdetails( vlr_transformador)
                  .done(function(response)
                    {
                      if (response.success) {
                          codigo_transformador_global = vlr_transformador;
                          let outputDataTrafo = getStructToTrafo(response);
                            showPage();
                            $("#response-container").html(outputDataTrafo);
                            $("#validador").val("Búsqueda exitosa");
                            document.getElementById("target_aviso").style.display="";
                            initMap(lati_global,lngi_global);
                      } else {
                            showPage();
                            $("#response-container").html(response.data.message);
                            sweetAlert("Oops", response.data.message, "error");
                            $("#validador").val("");
                      }
                    })
                  .fail(function(jqXHR, textStatus)
                    {
                             showPage();
                             $("#response-container").html("Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 341: " + textStatus);
                             sweetAlert("Oops","Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 343 y comunique este error " + textStatus, "error");
                             $("#validador").val("");
                    });
          });
//**--------------------------------------------------------------------------------------------//-------------------------------------**//
    $('[data-usu]').click(function(e)
          {
     	      hidePage();
              e.preventDefault();
              $("#response-container").html("<p>Buscando...</p>");
              let vlr_usuario=document.getElementById('codUsuario').value;
              getdetails_user_estado(vlr_usuario)
                   .done(function(response)
                    {
                         if (response.success) {
                                   $.each(response.data.solicitud, function(key, value)
                                    {
                                        $.each(value, function(userkey, uservalue)
                                          {
                                            if(userkey==="estado_solicitud_idestado_solicitud") {
                                               if(uservalue.indexOf('1')!== -1) {
                                                    showPage();
                                                    sweetAlert("Oops", "Ud tiene en estos momentos una solicitud pendiente de aprobación.", "error");
                                                    $("#validador").val("");
                                                    $("#email").val("");
                                                    $("telefono_correspondencia").val("");
                                                    $("#codTransformador").val("");
                                                    $("#response-container").html("");
                                               } else {
                                                     getdetails_user(vlr_usuario)
                                                      .done(function(response){
                                                              if (response.success) {
                                                                  let outputDataTrafo = getStructToTrafo(response);
                                                                  showPage();
                                                                  $("#response-container").html(outputDataTrafo);
                                                                      $("#validador").val("Búsqueda exitosa");
                                                                      document.getElementById("target_aviso").style.display="";
                                                                      initMap(lati_global,lngi_global);
                                                                } else {
                                                                    showPage();
                                                                    $("#response-container").html(response.data.message);
                                                                    sweetAlert("Oops", response.data.message, "error");
                                                                    $("#validador").val("");
                                                                }
                                                      })
                                                      .fail(function(jqXHR, textStatus){
                                                             showPage();
                                                              $("#response-container").html("Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 341: " + textStatus);
                                                              sweetAlert("Oops","Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 343 y comunique este error " + textStatus, "error");
                                                              $("#validador").val("");
                                                      });
                                               }
                                            }});
                                    });
                         } else {
                             showPage();
                             $("#response-container").html(response.data.message);
                             sweetAlert("Oops", response.data.message, "error");
                             $("#validador").val("");
                         }
                    })
                    .fail(function(jqXHR, textStatus)
                    {
                             showPage();
                              $("#response-container").html("Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 101: " + textStatus);
                              sweetAlert("Oops","Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 101 y comunique este error " + textStatus, "error");    
                              $("#validador").val("");
                    });
                });
//**--------------------------------------------------------------------------------------------//-------------------------------------**//

                $('[data-sol]').click(function(e)
                      {
                        let vlr_solicitud=document.getElementById('nro_solicitud_buscar').value;
                        hidePage();
                        getdetails_sol_estado( vlr_solicitud )
                        .done(function(response)
                            {
                              if (response.success)
                                {
                                  let output="";
                                  $.each(response.data.solicitud, function(key, value)
                                   {
                                              showPage();
                                              output += '<table class="table">';
                                              output += '    <thead class="thead-dark">';
                                              output += '      <tr>';
                                              output += '        <th scope="col">CODIGO DE SOLICITUD</th>';
                                              output += '        <th scope="col">ESTADO</th>';
                                              output += '        <th scope="col">OBSERVACIONES</th>';
                                              output += '      </tr>';
                                              output += '    </thead>';
                                              output += '<tbody><tr class="table-light">';
                                        $.each(value, function(userkey, uservalue)
                                          {
                                             
                                             if(userkey==="nro_solicitud") {
                                                 output +=  "<td class='bg-success'>"+uservalue+ '</td>';
                                             }
                                             if(userkey==="estado_solicitud") {
                                                    if(uservalue==="Registrada") {
                                                          output +=  "<td class='bg-warning'>"+uservalue+ '</td>';
                                                    } else if(uservalue==="Aprobada") {
                                                          output +=  "<td class='bg-success'>"+uservalue+ '</td>';
                                                    } else if(uservalue==="Funcional") {
                                                          output +=  "<td class='bg-success'>"+uservalue+ '</td>';
                                                    } else {
                                                          output +=  "<td class='bg-low_danger'>"+uservalue+ '</td>';
                                                    }
                                             }
                                             if(userkey==="observaciones") {
                                                 output +=  "<td class='bg-success'>"+uservalue+ '</td>';
                                             }
                                          });
                                        output += '</tr></<tbody>';
                                       output+='  </table>';
                                    }); 
                                      $("#response-container").html(output);
                                  } else {
                                    showPage();
                                    $("#response-container").html(response.data.message);
                                    sweetAlert("Oops", response.data.message, "error");
                                    $("#validador").val("");
                                    $("#nro_solicitud_buscar").val("");
                                  }
                            })
                            .fail(function(jqXHR, textStatus)
                              {
                                   showPage();
                                  $("#response-container").html("Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 341: " + textStatus);
                                  $("#validador").val("");
                              });
                      });
//**--------------------------------------------------------------------------------------------//-------------------------------------**//
                          let btnFinish = $('<button></button>').text('Enviar')
                                                           .addClass('btn btn-info')
                                                           .on('click', function(){
                                                                  if( !$(this).hasClass('disabled')){
                                                                      var elmForm = $("#myForm");
                                                                      if(elmForm){
                                                                          elmForm.validator('validate');
                                                                          var elmErr = elmForm.find('.has-error');
                                                                          //alert(elmErr + "y" + elmErr.length);
                                                                          if(elmErr && elmErr.length > 0){
                                                                              //alert('Oops we still have error in the form');
                                                                              sweetAlert("Oops...", "Aún faltan campos por diligenciar!", "error");
                                                                              return false;
                                                                          }else{
                                                                              //alert('Great! we are ready to submit form');
                                                                              hidePage();
                                                                              elmForm.submit();
                                                                              //return false;
                                                                          }
                                                                      }
                                                                  }
                                                              });
                          let btnCancel = $('<button></button>').text('Cancelar')
                                                           .addClass('btn btn-danger')
                                                           .on('click', function(){
                                                                  $('#smartwizard').smartWizard("reset");
                                                                  $('#myForm').find("input, textarea").val("");
                                                              });
                          let btnDef = $('<button></button>').text('Definiciones')
                                                           .addClass('btn btn-success')
                                                           .attr('data-target','.bd-example-modal-lg')
                                                           .attr('data-toggle',"modal")
                                                           .on('click', function(){});
                          let btnCond = $('<button></button>').text('Cond. conexión')
                                                           .addClass('btn btn-success')
                                                           .attr('data-target','.con-bd-example-modal-lg')
                                                           .attr('data-toggle',"modal")
                                                           .on('click', function(){});
                          let btnProc = $('<button></button>').text('Proc. conexión')
                                                           .addClass('btn btn-success')
                                                           .attr('data-target','.pro-bd-example-modal-lg')
                                                           .attr('data-toggle',"modal")
                                                           .on('click', function(){});
                          let btnCone = $('<button></button>').text('Con. medición')
                                                           .addClass('btn btn-success')
                                                           .attr('data-target','.con-me-bd-example-modal-lg')
                                                           .attr('data-toggle',"modal")
                                                           .on('click', function(){});
                          let btninfoFactura = $('<button></button>').text('Info. factura')
                                                           .addClass('btn btn-success')
                                                           .attr('data-target','.info-fac-bd-example-modal-lg')
                                                           .attr('data-toggle',"modal")
                                                           .on('click', function(){});
                                              // Smart
                          $('#smartwizard').smartWizard({
                                                      selected: 0,
                                                      theme: 'dots',
                                                      transitionEffect:'fade',
                                                      toolbarSettings: {toolbarPosition: 'bottom',
                                                                        toolbarExtraButtons: [btninfoFactura,btnCone,btnProc,btnCond,btnDef,btnFinish, btnCancel]
                                                                      },
                                                      anchorSettings: {
                                                                  markDoneStep: true, // add done css
                                                                  markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                                                                  removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                                                                  enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                                                              }
                                                   });

                          $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                                              var elmForm = $("#form-step-" + stepNumber);
                                              // stepDirection === 'forward' :- this condition allows to do the form validation
                                              // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                                              if(stepDirection === 'forward' && elmForm){
                                                  elmForm.validator('validate');
                                                  var elmErr = elmForm.find('.has-error'); // correct
                                                  if(elmErr && elmErr.length > 0){
                                                      // Form validation failed
                                                      return false;
                                                  }
                                              } 
                                              return true;
                                          });

                          $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
                                              // Enable finish button only on last step
                                              if(stepNumber == 3){
                                                  $('.btn-finish').removeClass('disabled');
                                              }else{
                                                  $('.btn-finish').addClass('disabled');
                                              }
                                          });

                          $('input[type=file]').bind("change",function()
                                                  {
                                                     var iden=this.id;
                                                    if(this.files[0].size > 21000000)
                                                      {
                                                        sweetAlert("Oops...", "El tamaño de tu archivo es muy grande, Cambialo. Max 20 Mb!", "error");
                                                        var controlInput = $("#"+iden+"");
                                                        controlInput.replaceWith(controlInput = controlInput.val('').clone(true));
                                                        }
                                                  });

//**--------------------------------------------------------------------------------------------//-------------------------------------**//
                $('[data-proy-ene]').blur(function(e)
                      {
                        
                        
						
						let listValueArray = [];
							for(i=1; i <= 12; i++)
								{
									
									listValueArray.push(document.getElementById("proy_ener_gen_or_m"+i).value);
								}
						console.log(Math.max.apply(Math,listValueArray));
						
						let max_vlr_cliente = Math.max.apply(Math,listValueArray);
						let calculo_max_vlr_cliente = max_vlr_cliente / 720;
						if(document.getElementById('codTransformador').value != "")
						{
						getdetails_user_data_in(document.getElementById('codTransformador').value)
                        .done(function(response)
                            {
                              if (response.success)
                                {
                                  var output="";
                                  $.each(response.data.valor, function(key, value)
                                   {
                                    
                                        $.each(value, function(userkey, uservalue)
                                          {
                      console.log("calculo_max_vlr_cliente"+calculo_max_vlr_cliente);
                      console.log("uservalue"+uservalue);
											let calculoPorcentaje =  (calculo_max_vlr_cliente * 100)/uservalue;
                                              console.log("calculoPorcentaje"+calculoPorcentaje);

                                              if (calculoPorcentaje >50)
											{
												sweetAlert("Oops", "La proyección de la energía generada de " + max_vlr_cliente + " por el sistema a entregar a la red sobrepasa el 50% de lo soportado en energia para este transformador.", "error");
												flagValidationEnergy = 1;
											
											}
											else
											{
												flagValidationEnergy = 0;
											}

                                          });   
                                    }); 
                                  }
                            })
                      .fail(function(jqXHR, textStatus)
                          {
                              //$("#response-container").html("Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 341: " + textStatus);
                              //$("#validador").val("");
                          }); 
						}
						else
						{
							sweetAlert("Oops","Valor del transformador vacio.","error");
							//alert("Valor del transformador vacio");
						}
               

                      });

//**--------------------------------------------------------------------------------------------//-------------------------------------**//



});

function getStructToTrafo(response){

   let output = "";
   $.each(response.data.transformador, function(key, value)
    {
        output += '<table class="table">';
        output += '    <thead class="thead-dark">';
        output += '      <tr>';
        output += '        <th scope="col">CODIGO DE CONEXIÓN</th>';
        output += '        <th scope="col">CAPACIDAD NOMINAL(KVA)</th>';
        output += '        <th scope="col">LONGITUD</th>';
        output += '        <th scope="col">LATITUD</th>';
        output += '        <th scope="col">ALTITUD</th>';
        output += '        <th scope="col">VOLTAJE NOMINAL</th>';
        output += '        <th scope="col">PORCENTAJE OCUPADO (%)</th>';
        output += '      </tr>';
        output += '    </thead>';
        output += '<tbody><tr class="table-light">';
        let vlr_capacidad_nom=0;
        $.each(value, function(userKey, userValue)
        {
            if (userKey === "trafo") {
                $("#codTransformador").val(userValue);
                codigo_transformador_global = userValue;
            }
            if (userKey === "capacidad_nominal") {
                vlr_capacidad_nom = userValue;
            }
            let calculado;
            if (userKey === "total") {
                dispo_potencia_global = userValue;
                calculado = ((userValue * 100) / vlr_capacidad_nom).toFixed(2);

                if (parseFloat(calculado) >= 0 && parseFloat(calculado) <= 30) {
                    output += "<td class='bg-success'>" + calculado + '</td>';
                } else if (parseFloat(calculado) > 30 && parseFloat(calculado) <= 40) {
                    output += "<td class='bg-info'>" + calculado + '</td>';
                } else if (parseFloat(calculado) > 40 && parseFloat(calculado) <= 50) {
                    output += "<td class='bg-warning'>" + calculado + '</td>';
                } else {
                    output += "<td class='bg-danger'>" + calculado + '</td>';
                }
                $("#dispo_potencia").val(calculado);
            } else {
                if (userKey === "longitud") {
                    lngi_global = userValue;
                }
                if (userKey === "laltitud") {
                    lati_global = userValue;
                }
                output += "<td class='bg-info'>" + userValue + '</td>';
            }
        });
        output += '</tr></<tbody>';
        output+='  </table>';
    });
   return output;
}
function searchValueDB()
{
	let listValueArray = [];
	for(i=1; i <= 12; i++)
		{
			listValueArray.push(document.getElementById("proy_ener_gen_or_m"+i).value);
		}
	console.log(Math.max.apply(Math,listValueArray));
}

function changeOption2(valor)
{
 if(valor=="Solar F")
      {
                
      document.getElementById("potencia_panel").required = true;
      document.getElementById("potencia_total").required = true;
      document.getElementById("fecha_instalacion_solar_fv").required = true;
      document.getElementById("rele_flujo_inverso").required = true;
      document.getElementById("capacidad_dc").required = true;
      document.getElementById("voltaje_salida").required = true;
      document.getElementById("numero_fases").required = true;
      
      document.getElementById("voltaje_entrada").required = true;
      document.getElementById("numero_inversores").required = true;
      document.getElementById("fabricante_inversores").required = true;
      document.getElementById("modelo_inversores").required = true;
      document.getElementById("estandar_ul").required = true;
      document.getElementById("estandar_iec").required = true;
      document.getElementById("ver_ul").required = true;
      document.getElementById("ver_ul").required = true;
      document.getElementById("potencia").required = true;
      document.getElementById("impedancia").required = true;
      document.getElementById("grupo").required = true;
        document.getElementById("div_info_solar_fv").style.display="";
        document.getElementById("div_info_solar_fv_2").style.display="";
        document.getElementById("div_info_solar_fv_3").style.display="";

      }
  else
  {

      document.getElementById("potencia_panel").removeAttribute("required");
      document.getElementById("potencia_total").removeAttribute("required");
      document.getElementById("fecha_instalacion_solar_fv").removeAttribute("required");
      document.getElementById("nro_paneles").removeAttribute("required");
      document.getElementById("rele_flujo_inverso").removeAttribute("required");
      document.getElementById("capacidad_dc").removeAttribute("required");
      document.getElementById("voltaje_salida").removeAttribute("required");
      document.getElementById("numero_fases").removeAttribute("required");
      
      document.getElementById("voltaje_entrada").removeAttribute("required");
      document.getElementById("numero_inversores").removeAttribute("required");
      document.getElementById("fabricante_inversores").removeAttribute("required");
      document.getElementById("modelo_inversores").removeAttribute("required");
      document.getElementById("estandar_ul").removeAttribute("required");
      document.getElementById("estandar_iec").removeAttribute("required");
      document.getElementById("ver_ul").removeAttribute("required");
      document.getElementById("ver_iec").removeAttribute("required");
      document.getElementById("potencia").removeAttribute("required");
      document.getElementById("impedancia").removeAttribute("required");
      document.getElementById("grupo").removeAttribute("required");
      
       $("#potencia_panel").val("");
       $("#potencia_total").val("");
       $("#fecha_instalacion_solar_fv").val("");
       $("#nro_paneles").val("");
       $("#rele_flujo_inverso").val("");
       $("#capacidad_dc").val("");
       $("#voltaje_salida").val("");
       $("#numero_fases").val("");
       
       $("#voltaje_entrada").val("");
       $("#numero_inversores").val("");
       $("#fabricante_inversores").val("");
       $("#modelo_inversores").val("");
       $("#estandar_ul").val("");
       $("#estandar_iec").val("");
       $("#ver_ul").val("");
       $("#ver_iec").val("");
       $("#potencia").val("");
       $("#impedancia").val("");
       $("#grupo").val("");

        document.getElementById("div_info_solar_fv").style.display="none";
        document.getElementById("div_info_solar_fv_2").style.display="none";
        document.getElementById("div_info_solar_fv_3").style.display="none";
      
  }

    restoreValuesSelect();
    var select_recurso_ = document.getElementById("recurso_energetico");

    for (i=0; i<RecursoEnergeticoArray.length; i++ ){
        if(RecursoEnergeticoArray[i].id == valor){
            optionValue = document.createElement('option');
            optionValue.setAttribute('value', RecursoEnergeticoArray[i].value);
            optionValue.appendChild(document.createTextNode(RecursoEnergeticoArray[i].text));
            select_recurso_.appendChild(optionValue);
            /// console.log("---->"+RecursoEnergeticoArray[i].value);
        }

    }
}

function restoreValuesSelect(){
    var select_recurso_ = document.getElementById("recurso_energetico");
    select_recurso_.options.length = 0;
    var select_tipo_tecnologia_ = document.getElementById("tipo_tecnologia");
    select_tipo_tecnologia_.options.length = 0;

    optionValueR = document.createElement('option');
    optionValueR.setAttribute('value', "");
    optionValueR.appendChild(document.createTextNode("Seleccione..."));
    select_recurso_.appendChild(optionValueR);

    optionValueT = document.createElement('option');
    optionValueT.setAttribute('value', "");
    optionValueT.appendChild(document.createTextNode("Seleccione..."));
    select_tipo_tecnologia_.appendChild(optionValueT);


}
function changeOptionEnergy(vlrIn){
    var select_tipo_tecnologia_ = document.getElementById("tipo_tecnologia");
    select_tipo_tecnologia_.options.length = 0;
    optionValueT = document.createElement('option');
    optionValueT.setAttribute('value', "");
    optionValueT.appendChild(document.createTextNode("Seleccione..."));
    select_tipo_tecnologia_.appendChild(optionValueT);

    for (i=0; i<TipoTecnologiaArray.length; i++ ){
        if(TipoTecnologiaArray[i].id == vlrIn){
            optionValue = document.createElement('option');
            optionValue.setAttribute('value', TipoTecnologiaArray[i].value);
            optionValue.appendChild(document.createTextNode(TipoTecnologiaArray[i].text));
            select_tipo_tecnologia_.appendChild(optionValue);
        }

    }
}
function changeOption(valor)
  {
      if(valor=="Autogenerador")
      {

        document.getElementById("fecha_generacion_distribucion").removeAttribute("required");
        document.getElementById("fecha_generacion_distribucion").value="";

        document.getElementById("fecha_generacion_autogeneracion").required = true;
        document.getElementById("entrega_excedentes_red").required = true;
        
        document.getElementById("tipo_generacion_auto").style.display="";
        document.getElementById("fecha_generacion_auto").style.display="";
        document.getElementById("fecha_generacion_distri").style.display="none";
   
       

       
      }
      else
      {
        
        
        document.getElementById("fecha_generacion_autogeneracion").removeAttribute("required");
        document.getElementById("entrega_excedentes_red").removeAttribute("required");
        document.getElementById("fecha_generacion_autogeneracion").value="";
        document.getElementById("entrega_excedentes_red").value="";

        document.getElementById("fecha_generacion_distribucion").required = true;
        
        document.getElementById("tipo_generacion_auto").style.display="none";
        document.getElementById("fecha_generacion_auto").style.display="none";
        document.getElementById("fecha_generacion_distri").style.display="";

      }
     
  }
function changeOption3(valor)
{

      if(valor==="Si")
      {
          
        document.getElementById("energia_cap").required = true;
        document.getElementById("energia_ene").required = true;
        
        
        document.getElementById("almacen_energia_cap").style.display="";
        document.getElementById("almacen_energia_ene").style.display="";
       
      }
      else
      {
        
        document.getElementById("energia_cap").removeAttribute("required");
        document.getElementById("energia_ene").removeAttribute("required");
        document.getElementById("energia_cap").value="";
        document.getElementById("energia_ene").value="";
        
        
        
        document.getElementById("almacen_energia_cap").style.display="none";
        document.getElementById("almacen_energia_ene").style.display="none";

      }
     
  }
function changeOption4(valor)
{
   if(valor=="Si")
      {

        document.getElementById("ver_ul").required = true;
        document.getElementById("ver_ul_si").style.display="";
        

      }
      else
      {

        document.getElementById("ver_ul").removeAttribute("required");
        document.getElementById("ver_ul").value="";

        document.getElementById("ver_ul_si").style.display="none";

      }
     
  }
function changeOption5(valor)
{
   if(valor=="Si")
      {

        document.getElementById("ver_iec").required = true;
        document.getElementById("ver_iec_si").style.display="";
        

      }
      else
      {

        document.getElementById("ver_iec").removeAttribute("required");
        document.getElementById("ver_iec").value="";

        document.getElementById("ver_iec_si").style.display="none";

      }
     
  }
function changeOption6(valor)
{
   if(valor=="Si")
      {

        document.getElementById("ver_ieee").required = true;
        document.getElementById("ver_ieee_si").style.display="";
        

      }
      else
      {

        document.getElementById("ver_ieee").removeAttribute("required");
        document.getElementById("ver_ieee").value="";

        document.getElementById("ver_ieee_si").style.display="none";

      }
     
  }
function changeOption7(valor)
{
   if(valor=="No")
      {

        document.getElementById("descripcion_elementos_proteccion_trafo").required = true;
        document.getElementById("descripcion_proteccion").style.display="";
        

      }
      else
      {

        document.getElementById("descripcion_elementos_proteccion_trafo").removeAttribute("required");
        document.getElementById("descripcion_elementos_proteccion_trafo").value="";

        document.getElementById("descripcion_proteccion").style.display="none";

      }
     
  }

var tipoProyecto = [
    {value: "Solar F", text: "Solar F"},
    {value: "Hidraulica", text: "Hidraulica"},
    {value: "Biomasa", text: "Biomasa"},
    {value: "Geotermica", text: "Geotermica"},
    {value: "Termica", text: "Termica"},
    {value: "Eolica", text: "Eolica"},
];

var RecursoEnergeticoArray = [
    { id:"Solar F", value: "Sol", text: "Sol"},
    { id:"Solar F", value: "Otro", text: "Otro"},
    { id:"Eolica", value: "Viento", text: "Viento"},
    { id:"Eolica", value: "Otro", text: "Otro"},
    { id:"Hidraulica", value: "Agua", text: "Agua"},
    { id:"Hidraulica", value: "Otro", text: "Otro"},
    { id:"Biomasa", value: "Cultivo Energetico", text: "Cultivo Energetico"},
    { id:"Biomasa", value: "Residuos Agricolas Cultivo", text: "Residuos Agricolas Cultivo"},
    { id:"Biomasa", value: "Residuos Agricolas Industriales", text: "Residuos Agricolas Industriales"},
    { id:"Biomasa", value: "Residuos Solidos Urbanos", text: "Residuos Solidos Urbanos"},
    { id:"Biomasa", value: "Residuos Pecuarios", text: "Residuos Pecuarios"},
    { id:"Biomasa", value: "Otro", text: "Otro"},
    { id:"Geotermica", value: "Vapor", text: "Vapor"},
    { id:"Geotermica", value: "Otro", text: "Otro"},
    { id:"Termica", value: "Carbon", text: "Carbon"},
    { id:"Termica", value: "Gas", text: "Gas"},
    { id:"Termica", value: "Fuil Oil", text: "Fuil Oil"},
    { id:"Termica", value: "Crudo Pesado", text: "Crudo Pesado"},
    { id:"Termica", value: "Otro", text: "Otro"},
    { id:"Otro", value: "Otro", text: "Otro"}
];

var TipoTecnologiaArray = [
    { id:"Sol", value: "Fotovoltaico", text: "Fotovoltaico"},
    { id:"Sol", value: "Termico", text: "Termico"},
    { id:"Sol", value: "Otro", text: "Otro"},
    { id:"Viento", value: "Aerogenerador", text: "Aerogenerador"},
    { id:"Viento", value: "Otro", text: "Otro"},
    { id:"Agua", value: "Filo de agua", text: "Filo de agua"},
    { id:"Agua", value: "Embalse", text: "Embalse"},
    { id:"Agua", value: "Otro", text: "Otro"},
    { id:"Vapor", value: "Flash Simple", text: "Flash Simple"},
    { id:"Vapor", value: "Flash Doble", text: "Flash Doble"},
    { id:"Vapor", value: "Binaria", text: "Binaria"},
    { id:"Vapor", value: "Otro", text: "Otro"},
    { id:"Carbon", value: "Ciclo Abierto", text: "Ciclo Abierto"},
    { id:"Carbon", value: "Ciclo Combinado", text: "Ciclo Combinado"},
    { id:"Carbon", value: "Otro", text: "Otro"},
    { id:"Gas", value: "Ciclo Abierto", text: "Ciclo Abierto"},
    { id:"Gas", value: "Ciclo Combinado", text: "Ciclo Combinado"},
    { id:"Gas", value: "Otro", text: "Otro"},
    { id:"Fuil Oil", value: "Otro", text: "Otro"},
    { id:"Crudo Pesado", value: "Otro", text: "Otro"},
    { id:"Cultivo Energetico", value: "Otro", text: "Otro"},
    { id:"Residuos Agricolas Cultivo", value: "Otro", text: "Otro"},
    { id:"Residuos Agricolas Industriales", value: "Otro", text: "Otro"},
    { id:"Residuos Solidos Urbanos", value: "Otro", text: "Otro"},
    { id:"Residuos Pecuarios", value: "Otro", text: "Otro"},
    { id:"Otro", value: "Otro", text: "Otro"}
];
