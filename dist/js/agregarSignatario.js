$(document).ready(function(){
    $('.btnEditarG').hide();
    obtener_registros();
    obtener_signatarios();
    obtener_personal();
     // =========== EVENTO DE EDITAR EN LA TABLA DE UNIDAD DE NEGOCIO ==============================
        $('html').on('click', '.btnEditar', function(){
            //SE SIMULA EL CLICK DEL TAB 
            $("#tab-0").get(0).click();
            // ================ SE ASIGNA ID A EDITAR ===============================================
            var id = $(this).attr('id').split('_')[1];
            obtener_unidad(id);
        });

        // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
        $('html').on('click', '.btnGuardar', function(){
          //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
          var obj = new Object();
            obj.idUnidadNegocio = $.trim($('#idUnidadNegocio').val());
            obj.idusuario1 = $.trim($('#idUnidadNegocio').val());
            obj.accion = $(this).attr("id").split('_')[1];
            obj.idUsuario = $(this).attr("id").split('_')[2];
            alert(obj.idUsuario1);
            alert(obj.idUnidadNegocio);
            // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
            //  if(obj.idUnidadNegocio != 'idUnidadNegocio' && obj.idUnidadNegocio != 'idUnidadNegocio'){
                guardar_signatario(obj);
          //    }
          //    else{
          //      alerta_error("Oops...","No se a seleccionado una Undiad de Negocio");
          //  }
        });
      // =======================================================================
  });

  function obtener_registros(){
      var opc = "obtener_registros";
      $('.line-scale-pulse-out').show();
      regenerar_tabla();
      $.post("dist/fw/agregarSignatarios.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                html += '<tr class="edita_error" id="error_' + $.trim(data[i].idUnidadNegocio) + '">';
                html += '<td>' + $.trim(data[i].idUnidadNegocio) + '</td>';
                html += '<td>' + $.trim(data[i].UnidadNegocio) + '</td>';
                html += '<td>' + $.trim(data[i].Laboratorio) + '</td>';
                html += '<td class="btnEditar" id="edit_'+data[i].idUnidadNegocio+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
                html += '</tr>';            
              }
              $('#example1 tbody').html(html);
              $('#example1').DataTable({
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

  // =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
function guardar_signatario(obj){
  var opc = "guardar_signatario";
  $.post("dist/fw/agregarSignatarios.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
      if(data){
          alerta("¡Guardado!", "El usuario se asigno correctamente a la unidad de Negocio, ¿desea seguir en 'Usuarios'", "success");
      }else{
          alerta_error("¡Error!","Error al guardar los datos");
      }
  },'json');
}

  function obtener_unidad(id){
    var opc = "obtener_unidad";
    $('.line-scale-pulse-out').show();
    $.post("dist/fw/agregarSignatarios.php",{'opc':opc, 'id':id},function(data){
        if(data){
          limpia_formularioSignatarios()
          $('#UnidadNegocio').text(data.UnidadNegocio);
          $('#Laboratorio').text(data.Laboratorio);
          $('#idUnidadNegocio').val(data.idUnidadNegocio);
        }
        else
        {
          alerta_error("Error", "Error al recibir los datos");
        }
        $('.line-scale-pulse-out').hide();
    },'json');
  }

  function limpia_formularioSignatarios(){
    $("#UnidadNegocio").text("");
    $("#Laboratorio").text("");
    $("#idUnidadNegocio").text("");  
  }

  function regenerar_tabla(){
    $('#div_registros').html("");
    var html = "";
    html += '<table id="example1" class="table table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Id Unidad</th>';
    html += '<th>Unidad Negocio</th>';
    html += '<th>Laboratorio</th>';
    html += '<th>Seleccionar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_registros').html(html);
  }

  function obtener_signatarios(){
    var opc = "obtener_signatarios";
    $('.line-scale-pulse-out').show();
    regenerar_tablaSignatarios();
    $.post("dist/fw/agregarSignatarios.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].idUsuario) + '">';
              html += '<td>' + $.trim(data[i].idUsuario) +  '</td>';
              html += '<td>' + $.trim(data[i].Nombre) +  '</td>';
              html += '<td>' + $.trim(data[i].Email) + '</td>';
              html += '<td>' + $.trim(data[i].UnidadNegocio) + '</td>';
              html += '<td>' + $.trim(data[i].Laboratorio) + '</td>';
              html += '<td class="btnEditar" id="edit_'+data[i].idUsuario+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
              html += '</tr>';          
              $('#NombreUser').text(data.Nombre);                
            }
            $('#example3 tbody').html(html);
            $('#example3').DataTable({
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

function regenerar_tablaSignatarios(){
  $('#div_registros1').html("");
  var html = "";
  html += '<table id="example3" class="table table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>Id Usuario</th>';
  html += '<th>Nombre</th>';
  html += '<th>Email</th>';
  html += '<th>Unidad Negocio</th>';
  html += '<th>Laboratorio</th>';
  html += '<th>Seleccionar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros1').html(html);
}
// CARGAR COMBO DE NOMBRE DE USUARIOS-----------------------
function obtener_personal(){
  var opc = "obtener_personal";
  $('#idUsuario').html('');
  $.post("dist/fw/agregarSignatarios.php",{'opc':opc},function(data){
      if(data){
         $('#idUsuario').html(data);
      }
  },'json');
}
//---------------------------------------------------------
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
  