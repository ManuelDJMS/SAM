$(document).ready(function(){
  $('.btnEditarG').hide();
  $('#NombreE').hide();
    obtener_signatarios();
    obtener_personal();
    obtener_laboratorio();

    // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
	$('html').on('click', '.btnGuardar', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
     var obj = new Object();
      obj.Nombre = $.trim($('#Nombre').val());
       obj.Laboratorio = $.trim($('#Lab').val());
       obj.accion = $(this).attr("id").split('_')[1];
       obj.idUsuario = $(this).attr("id").split('_')[2];
       // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
       if(obj.Nombre != '')
       {
          if(Lab != '')
              {
                registrar_signatario(obj);
              }
       
              else
              {
                alerta_error("INFORMACIÓN FALTANTE","Debe seleccionar un laboratorio");
              }
          }
          else
          {
            alerta_error("INFORMACIÓN FALTANTE","Debe seleccionar un usuario");
          }
    });
  // =======================================================================
    // =========== EVENTO DE EDITAR EN LA TABLA ==============================
    $('html').on('click', '.btnEditar', function(){
      //SE SIMULA EL CLICK DEL TAB 
      $("#tab-0").get(0).click();
      //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
      $('.btnEditarG').show();
      $('.btnGuardar').hide();
      $('#Nombre').hide();
      $('#NombreE').show();
    
      //=======================================================================================
      // ================ SE ASIGNA ID A EDITAR ===============================================
      var id = $(this).attr('id').split('_')[1];
      $('.btnEditarG').attr('id',$(this).attr('id'));
      obtener_signatario(id);
  });
  //========================================================================
  //============== EVENTO DEL BOTON DE EDITAR Y GUARDAR =====================
  $('html').on('click', '.btnEditarG', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
    var obj = new Object();
    obj.Nombre = $.trim($('#NombreE').val());
    obj.Laboratorio = $.trim($('#Lab').val());
    obj.accion = $(this).attr("id").split('_')[0];
    obj.idUsuario = $.trim($('#id').text());
       if(Lab != '')
           {

             registrar_signatario(obj);
           }
    
           else
           {
             alerta_error("INFORMACIÓN FALTANTE","Debe seleccionar un laboratorio");
           }
  });
});
//----------CARGAR Y LIMPIAR LA TABLA DE USUARIO/SIGNATARIOS------------------
    function obtener_signatarios(){
    var opc = "obtener_signatarios";
    $('.line-scale-pulse-out').show();
    regenerar_tablaSignatarios();
    $.post("dist/fw/signatarios.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].idUsuario) + '">';
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
  html += '<th>Nombre</th>';
  html += '<th>Email</th>';
  html += '<th>Unidad Negocio</th>';
  html += '<th>Laboratorio</th>';
  html += '<th>Editar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros1').html(html);
}
//---------------------------------------------------------

// CARGAR COMBO DE NOMBRE DE USUARIOS-----------------------
function obtener_personal(){
  var opc = "obtener_personal";
  $('#idUsuario').html('');
  $.post("dist/fw/signatarios.php",{'opc':opc},function(data){
      if(data){
         $('#Nombre').html(data);
      }
  },'json');
}

//---------------------------------------------------------
// CARGAR COMBO DE LABORATORIO-----------------------
function obtener_laboratorio(){
  var opc = "obtener_laboratorio";
  $('#idUnidadNegocio').html('');
  $.post("dist/fw/signatarios.php",{'opc':opc},function(data){
      if(data){
         $('#Lab').html(data);
      }
  },'json');
}
//---------------------------------------------------------


// CARGAR COMBO DE LABORATORIO-----------------------
function registrar_signatario(obj){
  var opc = "registrar_signatario";
  $.post("dist/fw/signatarios.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
		if(data){
      alerta("¡Guardado!", "Signatario registrado, ¿desea seguir en agregando signatarios", "success");
      obtener_signatarios();
    }else{
      alerta_error("¡Error!","Error al guardar los datos");
  }
  }, 'json');
}

//---------------------------------------------------------


function obtener_signatario(id){

    var opc = "obtener_signatario";
    $.post("dist/fw/signatarios.php",{'opc':opc, 'id':id},function(data){
        if(data){
          $('#NombreE').val(data.Nombre);
          $('#Lab').val(data.idUnidadNegocio);
          $('#id').text(data.idUsuario);
        }
        else
        {
          alerta_error("Error", "Error al recibir los datos");
        }
    },'json');
}

function limpia_formulario(){
  $("#Nombre").val("");
  $("#Lab").val("");
  $("#id").text("");
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
  