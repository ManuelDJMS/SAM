$(document).ready(function(){
    $('.btnEditarG').hide();
    limpia_formulario();
    obtener_registros();
    // obtener_usuarios();
    // =======================================================================
    // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
      $('html').on('click', '.btnGuardar', function(){
       //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
        var obj = new Object();
        obj.UnidadNegocio = $.trim($('#UnidadNegocio').val());
          obj.Laboratorio = $.trim($('#Laboratorio').val());
          obj.idUsuario = $.trim($('#idUsuario').val());
          obj.accion = $(this).attr("id").split('_')[1];
          obj.idUnidadNegocio = $(this).attr("id").split('_')[2];
          // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
          if(obj.UnidadNegocio != '' && obj.UnidadNegocio != ''){
              guardar_unidad(obj);
          }
          else{
            alerta_error("Oops...","Faltan llenar algunos campos");
        }
      });
    // =======================================================================
    // =========== EVENTO DE EDITAR EN LA TABLA DE UNIDAD DE NEGOCIO ==============================
    $('html').on('click', '.btnEditar', function(){
        //SE SIMULA EL CLICK DEL TAB 
        $("#tab-0").get(0).click();
        //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
        $('.btnEditarG').show();
        $('.btnGuardar').hide();
        //=======================================================================================
        // ================ SE ASIGNA ID A EDITAR ===============================================
        var id = $(this).attr('id').split('_')[1];
        $('.btnEditarG').attr('id',$(this).attr('id'));
        obtener_unidad(id);
    });

    // =======================================================================
    // =========== EVENTO DE EDITAR EN LA TABLA SIGNATARIOS ==============================
    $('html').on('click', '.btnEditar1', function(){
        //SE SIMULA EL CLICK DEL TAB 
        $("#tab-0").get(0).click();
        // ================ SE ASIGNA ID A EDITAR ===============================================
        var id1 = $(this).attr('id').split('_')[1];
        obtener_usuario(id1);
    });
    //========================================================================
    //============== EVENTO DEL BOTON DE EDITAR Y GUARDAR =====================
     $('html').on('click', '.btnEditarG', function(){
      //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
      var obj = new Object();
      obj.UnidadNegocio = $.trim($('#UnidadNegocio').val());
      obj.Laboratorio = $.trim($('#Laboratorio').val());
      obj.accion = $(this).attr("id").split('_')[0];
      obj.idUnidadNegocio = $(this).attr("id").split('_')[1];
        if(obj.UnidadNegocio != '' && obj.UnidadNegocio != ''){
          guardar_unidad(obj);
        }
        else{
          alerta_error("Oops...","Faltan llenar algunos campos");
      }
     });
     //=======================================================================
  });
  // =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
  function guardar_unidad(obj){
      var opc = "guardar_unidad";
      $.post("dist/fw/UnidadNegocio.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
          if(data){
              alerta("¡Guardado!", "La Unidad de Negocio se guardo correctamente, ¿desea seguir en 'Unidad de Negocio'", "success");
              obtener_unidades();
          }else{
              alerta_error("¡Error!","Error al guardar los datos");
          }
      },'json');
  }
  // ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
  function obtener_unidad(id){
    var opc = "obtener_unidad";
    $('.line-scale-pulse-out').show();
    $.post("dist/fw/UnidadNegocio.php",{'opc':opc, 'id':id},function(data){
        if(data){
          limpia_formulario()
          $('#UnidadNegocio').val(data.UnidadNegocio);
          $('#Laboratorio').val(data.Laboratorio);
        }
        else
        {
          alerta_error("Error", "Error al recibir los datos");
        }
        $('.line-scale-pulse-out').hide();
    },'json');
  }
  // ============================================================================================
  function obtener_registros(){
      var opc = "obtener_registros";
      $('.line-scale-pulse-out').show();
      regenerar_tabla();
      $.post("dist/fw/UnidadNegocio.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                html += '<tr class="edita_error" id="error_' + $.trim(data[i].idUnidadNegocio) + '">';
                html += '<td>' + $.trim(data[i].idUnidadNegocio) + '</td>';
                html += '<td>' + $.trim(data[i].UnidadNegocio) + '</td>';
                html += '<td>' + $.trim(data[i].Laboratorio) + '</td>';
                html += '<td class="btnEditar" id="edit_'+data[i].idUnidadNegocio+'"><></span></td>';
                html += '</tr>';                   
              }
              $('#example4 tbody').html(html);
              $('#example4').DataTable({
                  "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "autoWidth": true
              });
          }
          $('.line-scale-pulse-out').hide();
      },'json');
  }
   
  function regenerar_tabla(){
    $('#div_registros').html("");
    var html = "";
    html += '<table id="example4" class="table table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Id Unidad</th>';
    html += '<th>Unidad de Negocio</th>';
    html += '<th>Laboratorio</th>';
    html += '<th>Editar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_registros').html(html);
  }

  function limpia_formulario(){
    $("#UnidadNegocio").val("");
    $("#Laboratorio").val("");   
  }
      function alerta(titulo, mensaje, icono){
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })
        
        swalWithBootstrapButtons.fire({
          title: titulo,
          text: mensaje,
          icon: icono,
          showCancelButton: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Salir',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            location.reload();
          } else if (
            result.dismiss === Swal.DismissReason.cancel
          ) {
            window.location="http://localhost:8080/dashboard/SAM/index.php";
          }
        })
    }
    
    function alerta_error(titulo, texto){
      Swal.fire({
        icon: 'error',
        title: titulo,
        text: texto
        // footer: '<a href>Why do I have this issue?</a>'
      })
    }
  