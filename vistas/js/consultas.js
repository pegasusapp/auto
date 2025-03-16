

              // getdeails será nuestra función para enviar la solicitud ajax
              var getdetails = function(codigo_transformador)
                  {
                      return $.getJSON("modelos/consulta.php", 
                            {
                              "codigo_transformador": codigo_transformador
                             });

                  }
              var getdetails_user = function(codigo_usuario) 
                  {
                      return $.getJSON("modelos/consulta.php", 
                            {
                              "codigo_usuario": codigo_usuario
                              });

                  }

              var getdetails_user_data = function( vlr_usuario_detalle)
                  {
                      return $.getJSON("modelos/consulta.php", 
                            {
                              "codigo_usuario_detalle": vlr_usuario_detalle
                            });
                  }
//**--------------------------------------------------------------------------------------------//-------------------------------------**//

      $('[data-trans]').click(function(e)
          {
              e.preventDefault();
           
              $("#response-container").html("<p>Buscando...</p>");
              vlr_transformador=document.getElementById('codTransformador').value;
              getdetails(vlr_transformador)
              .done(function(response)
                {
                  if (response.success)
                     {
                        var output="";
                        $.each(response.data.transformador, function(key, value)
                         {
                                 // recorremos los valores de cada usuario
                                  //alert("ss");
                                  output += '<table class="table">';
                                  output += '    <thead class="thead-dark">';
                                  output += '      <tr>';
                                  output += '        <th scope="col">xxxxCODIGO DE CONEXIÓN</th>';
                                  output += '        <th scope="col">CAPACIDAD NOMINALE(KVA)</th>';
                                  output += '        <th scope="col">LONGITUD</th>';
                                  output += '        <th scope="col">LATITUD</th>';
                                  output += '        <th scope="col">ALTITUD</th>';
                                  output += '        <th scope="col">VOLTAJE NOMINAL</th>';
                                  output += '        <th scope="col">DISP POTENCIA (%)</th>';
                                  output += '        <th scope="col">DISP ENERGIA (%)</th>';
                                  output += '      </tr>';
                                  output += '    </thead>';
                                  output += '<tbody><tr class="table-light">';
                                
                                   $.each(value, function(userkey, uservalue)
                                     {  
											
                                          if(userkey=="total")
                                          {
                                                  if (parseFloat(uservalue) >= 0 && parseFloat(uservalue)<=9 )
                                                      {
                                                          
                                                          $("#dispo_potencia").val(uservalue);
                                                          output +=  "<td class='bg-success'>"+uservalue+ '</td>';
                                                          

                                                      }
                                                   else if(parseFloat(uservalue) >9 && parseFloat(uservalue)<=12 )
                                                      {
                                                          
                                                          $("#dispo_potencia").val(uservalue);
                                                          output +=  "<td class='bg-warning'>"+uservalue+ '</td>';

                                                      } 
                                                   else if(parseFloat(uservalue) >12 && parseFloat(uservalue)<=15 )
                                                      {
                                                          
                                                          $("#dispo_potencia").val(uservalue);
                                                          output +=  "<td class='bg-low_danger'>"+uservalue+ '</td>';

                                                      }       
                                                  else
                                                      {
                                                          $("#dispo_potencia").val(uservalue);
                                                          output +=  "<td class='bg-danger'>"+uservalue+ '</td>';
                                                      }    
                                          }
                                          else if(userkey=="dispo_energia")
                                              {
                                                    if (parseFloat(uservalue) >= 0 && parseFloat(uservalue)<=30 )
                                                        {
                                                            
                                                            $("#dispo_energia").val(uservalue);
                                                            output +=  "<td class='bg-success'>"+uservalue+ '</td>';

                                                        }
                                                            else if(parseFloat(uservalue) >30 && parseFloat(uservalue)<=40 )
                                                                {
                                                                    
                                                                    $("#dispo_energia").val(uservalue);
                                                                    output +=  "<td class='bg-warning'>"+uservalue+ '</td>';

                                                                } 
                                                             else if(parseFloat(uservalue) >40 && parseFloat(uservalue)<=50 )
                                                                {
                                                                    
                                                                    $("#dispo_energia").val(uservalue);
                                                                    output +=  "<td class='bg-low_danger'>"+uservalue+ '</td>';
                                                                } 
                                                    else
                                                     {
                                                       $("#dispo_energia").val(uservalue);
                                                         output +=  "<td class='bg-danger'>"+uservalue+ '</td>';
                                                     }             

                                              }            
                                          else
                                          {
                                             output +=  "<td class='bg-info'>"+uservalue+ '</td>';
                                          }
                                          
                                          
                                      }
                                          );

                            output += '</tr></<tbody>';
                            output+='  </table>';
                         }      
                              );
                        $("#response-container").html(output);
                        $("#validador").val("Búsqueda exitosa");
                       }
                       else
                        {
                            //response.success no es true
                            $("#response-container").html('No se han encontrado resultados: ' + response.data.message);
                             $("#validador").val("");
                        }

                      })
                      .fail(function(jqXHR, textStatus, errorThrown)
                          {
                              $("#response-container").html("Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 341: " + textStatus);
                              $("#validador").val("");
                          });
          });
 
//**--------------------------------------------------------------------------------------------//-------------------------------------**//
          $('[data-usu]').click(function(e) // data usu  
                {
                    e.preventDefault();
                  
                    $("#response-container").html("<p>Buscando...</p>");
                    vlr_usuario=document.getElementById('codUsuario').value;
                    getdetails_user( vlr_usuario )
                    .done(function(response) // donde 1
                      {
                        if (response.success)
                          {
                              var output="";
                              $.each(response.data.transformador, function(key, value) // each 1
                               {
                               	 
                                      output += '<table class="table">';
                                      output += '    <thead class="thead-dark">';
                                      output += '      <tr>';
                                      output += '        <th>xxxCODIGO DE CONEXIÓN</th>';
                                      output += '        <th>CAPACIDAD NOMINALE(KVA)</th>';
                                      output += '        <th>LONGITUD</th>';
                                      output += '        <th>LATITUD</th>';
                                      output += '        <th>ALTITUD</th>';
                                      output += '        <th>VOLTAJE NOMINAL</th>';
                                      output += '        <th>DISP POTENCIA (%)</th>';
                                      output += '        <th>DISP ENERGIA (%)</th>';
                                      output += '      </tr>';
                                      output += '    </thead>';
                                      output += '<tbody><tr class="table-light">';
                                      $.each(value, function(userkey, uservalue) // each 2
                                        {
                                           
                                                if(userkey=="codigo_transformador")
                                                 {
                                                  $("#codTransformador").val(uservalue);
                                                 }

                                                if(userkey=="dispo_potencia")
                                                 {
                                                       if (parseFloat(uservalue) >= 0 && parseFloat(uservalue)<=9 )
                                                        {
                                                          $("#dispo_potencia").val(uservalue);
                                                          output +=  "<td class='bg-success'>"+uservalue+ '</td>';
                                                        }
                                                           else if(parseFloat(uservalue) >9 && parseFloat(uservalue)<=12 )
                                                            {
                                                              $("#dispo_potencia").val(uservalue);
                                                              output +=  "<td class='bg-warning'>"+uservalue+ '</td>';
                                                            } 
                                                          else if(parseFloat(uservalue) >12 && parseFloat(uservalue)<=15 )
                                                            {
                                                              $("#dispo_potencia").val(uservalue);
                                                              output +=  "<td class='bg-low_danger'>"+uservalue+ '</td>';
                                                            }       
                                                      else
                                                       {
                                                          $("#dispo_potencia").val(uservalue);
                                                          output +=  "<td class='bg-danger'>"+uservalue+ '</td>';
                                                        }    
                                                  }
                                                else if(userkey=="dispo_energia")
                                                  {
                                                      if (parseFloat(uservalue) >= 0 && parseFloat(uservalue)<=30 )
                                                          {
                                                              $("#dispo_energia").val(uservalue);
                                                              output +=  "<td class='bg-success'>"+uservalue+ '</td>';
                                                          }
                                                            else if(parseFloat(uservalue) >30 && parseFloat(uservalue)<=40 )
                                                                {
                                                                   $("#dispo_energia").val(uservalue);
                                                                    output +=  "<td class='bg-warning'>"+uservalue+ '</td>';
                                                                } 
                                                            else if(parseFloat(uservalue) >40 && parseFloat(uservalue)<=50 )
                                                                {
                                                                    $("#dispo_energia").val(uservalue);
                                                                    output +=  "<td class='bg-low_danger'>"+uservalue+ '</td>';
                                                                }     
                                                      else
                                                          {
                                                             $("#dispo_energia").val(uservalue);
                                                              output +=  "<td class='bg-danger'>"+uservalue+ '</td>';
                                                          }    
                                                  }
                                                  else
                                                  {
                                                     output +=  "<td class='bg-info'>"+uservalue+ '</td>';
                                                  }
                                    
                                        }
                                             ); // fin each 2
                                      output += '</tr></<tbody>';
                                      output+='  </table>';
                                }          
                                           ); // fin each 1

                              $("#response-container").html(output);
                              $("#validador").val("Búsqueda exitosa");

                        }
                        else
                        {
                            $("#response-container").html('No se han encontrado resultados: ' + response.data.message);
                             $("#validador").val("");
                        }

                      }) // fin done 2
                      .fail(function(jqXHR, textStatus, errorThrown)
                          {
                              $("#response-container").html("Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 341: " + textStatus);
                              $("#validador").val("");
                          });
                });
             

//**--------------------------------------------------------------------------------------------//-------------------------------------**//
                $('[data-usu-consulta]').click(function(e)
                      {
                        vlr_usuario_detalle=document.getElementById('idClienteEnergia').value;
                        getdetails_user_data( vlr_usuario_detalle )
                        .done(function(response)
                            {
                              if (response.success)
                                {
                                  var output="";
                                  $.each(response.data.transformador, function(key, value)
                                   {
                                       // alert(key+"--"+value);
                                    
                                        $.each(value, function(userkey, uservalue)
                                          {

                                             

                                          });   
                                    }); 
                                  }
                            })
                      .fail(function(jqXHR, textStatus, errorThrown)
                          {
                              //$("#response-container").html("Algo ha fallado, comuniquese con nuestra linea, 6185871 ext 341: " + textStatus);
                              //$("#validador").val("");
                          });  

                      });

//**--------------------------------------------------------------------------------------------//-------------------------------------**//


