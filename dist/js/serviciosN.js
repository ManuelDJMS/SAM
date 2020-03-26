$(document).ready(function(){
  $('.btnEditarG').hide();
  limpia_formulario();
  obtener_registros();
  // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
	$('html').on('click', '.btnGuardar', function(){
     //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
      var obj = new Object();
        obj.NoCatalogo = $.trim($('#NoCatalogo').val());
        obj.Servicio = $.trim($('#Servicio').val());
        obj.ComplementoServicio = $.trim($('#ComplementoServicio').val());
        obj.Observaciones = $.trim($('#Observaciones').val());
        obj.Unidad= $.trim($('#Unidad').val());
        obj.Porcentaje = $.trim($('#Porcentaje').val());
        obj.PrecioBase = $.trim($('#PrecioBase').val());
        obj.Modalidad = $.trim($('#Modalidad').val());
        obj.ComentariosInternos = $.trim($('#ComentariosInternos').val());
        obj.accion = $(this).attr("id").split('_')[1];
        obj.IdServicio = $(this).attr("id").split('_')[2];
        // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =====================
      if(obj.NoCatalogo != '')
       {
          if(obj.Servicio != '')
              {
                guardar_servicio(obj);
              }
       
              else
              {
                alerta_error("INFORMACIÓN FALTANTE","Debe ingresar el servicio");
              }
          }
          else
          {
            alerta_error("INFORMACIÓN FALTANTE","Debe ingresar el No. de Catálogo");
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
      //=======================================================================================
      // ================ SE ASIGNA ID A EDITAR ===============================================
      var id = $(this).attr('id').split('_')[1];
      $('.btnEditarG').attr('id',$(this).attr('id'));
      obtener_servicio(id);
  });
  //========================================================================
  //============== EVENTO DEL BOTON DE EDITAR Y GUARDAR =====================
   $('html').on('click', '.btnEditarG', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
    var obj = new Object();
        obj.NoCatalogo = $.trim($('#NoCatalogo').val());
        obj.Servicio = $.trim($('#Servicio').val());
        obj.ComplementoServicio = $.trim($('#ComplementoServicio').val());
        obj.Observaciones = $.trim($('#Observaciones').val());
        obj.Unidad= $.trim($('#Unidad').val());
        obj.Porcentaje = $.trim($('#Porcentaje').val());
        obj.PrecioBase = $.trim($('#PrecioBase').val());
        obj.Modalidad = $.trim($('#Modalidad').val());
        obj.ComentariosInternos = $.trim($('#ComentariosInternos').val());
        obj.accion = $(this).attr("id").split('_')[0];
        obj.IdServicio = $(this).attr("id").split('_')[1];
        if(obj.NoCatalogo != '')
        {
           if(obj.Servicio != '')
               {
                 guardar_servicio(obj);
               }
        
               else
               {
                 alerta_error("INFORMACIÓN FALTANTE","Debe ingresar el servicio");
               }
           }
           else
           {
             alerta_error("INFORMACIÓN FALTANTE","Debe ingresar el No. de Catálogo");
           }
   });
   //=======================================================================
});
// =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
function guardar_servicio(obj){
    var opc = "guardar_servicio";
    $.post("dist/fw/serviciosN.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
        if(data){
            alerta("¡Guardado!", "El servicio se guardo correctamente, ¿Desea seguir en 'Servicios'", "success");
            obtener_registros();
        }else{
            alerta_error("¡Error!","Error al guardar los datos");
        }
    },'json');
}
// ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
function obtener_servicio(id){
  var opc = "obtener_servicio";
  $('.line-scale-pulse-out').show();
  $.post("dist/fw/serviciosN.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formulario()
        $('#NoCatalogo').val(data.NoCatalogo);
        $('#Servicio').val(data.Servicio);
        $('#ComplementoServicio').val(data.ComplementoServicio);
        $('#Observaciones').val(data.Observaciones);
        $('#Unidad').val(data.Unidad);
        $('#Porcentaje').val(data.Porcentaje);
        $('#PrecioBase').val(data.PrecioBase);
        $('#Modalidad').val(data.Modalidad);
        $('#ComentariosInternos').val(data.ComentariosInternos);
        $('#Modalidad').val(data.Modalidad);
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
    $.post("dist/fw/serviciosN.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].IdServicio) + '">';
              html += '<td>' + $.trim(data[i].NoCatalogo) + '</td>';
              html += '<td>' + $.trim(data[i].Servicio) + '</td>';
              html += '<td>' + $.trim(data[i].ComplementoServicio) + '</td>';
              html += '<td>' + $.trim(data[i].Observaciones) + '</td>';
              html += '<td>' + $.trim(data[i].PrecioBase) + '</td>';
              html += '<td>' + $.trim(data[i].ComentariosInternos) + '</td>';
              html += '<td class="btnEditar" id="edit_'+data[i].IdServicio+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
              html += '</tr>';                   
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
    
function regenerar_tabla(){
  $('#div_registros').html("");
  var html = "";
  html += '<table id="example3" class="table table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>No. Catálogo</th>';
  html += '<th>Servicio</th>';
  html += '<th>Complemento de Servicio</th>';
  html += '<th>Observaciones</th>';
  html += '<th>Precio Base</th>';
  html += '<th>Comentarios</th>';
  html += '<th>Editar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros').html(html);
}

function limpia_formulario(){
  $("#NoCatalogo").val("");
  $("#Servicios").val("");
  $("#ComplementoServicio").val("");
  $("#Observaciones").val("");
  $("#Unidad").val("");
  $("#Porcentaje").val("");
  $("#PrecioBase").val("");
  $("#Modalidad").val("");
  $("#ComentariosInternos").val("");
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
