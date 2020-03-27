$(document).ready(function(){
    $('.btnEditarG').hide();
    $('#Empresa').hide();
    limpia_formulario();
    obtener_laboratorio();
    obtener_articulos();
    obtener_registros();
    // =========== EVENTO DE EDITAR EN LA TABLA ==============================

    $('html').on('click', '.btnEditar', function(){
      //SE SIMULA EL CLICK DEL TAB 
      $("#tab-0").get(0).click();
      //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
      //=======================================================================================
      // ================ SE ASIGNA ID A EDITAR ===============================================
      var id = $(this).attr('id').split('_')[1];
      // $('.btnEditarG').attr('id',$(this).attr('id'));
      obtener_empresa(id);
  });
  // =========== EVENTO DE SELECCIONAR ARTICULO ==============================

  $('html').on('click', '.btnSeleccionar', function(){
    //SE SIMULA EL CLICK DEL TAB 
    $("#tab-0").get(0).click();
    //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
    //=======================================================================================
    // ================ SE ASIGNA ID A EDITAR ===============================================
    var id = $(this).attr('id').split('_')[1];
    // $('.btnEditarG').attr('id',$(this).attr('id'));
    obtener_articulo(id);
});
});

function obtener_articulos(){
    var opc = "obtener_articulos";
    $('.line-scale-pulse-out').show();
    regenerar_tablaArticulos();
    $.post("dist/fw/equipamiento.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].idArticulo) + '">';
              html += '<td>' + $.trim(data[i].Descripcion) + '</td>';
              html += '<td>' + $.trim(data[i].Marca) + '</td>';
              html += '<td>' + $.trim(data[i].Modelo) + '</td>';
              html += '<td class="btnSeleccionar" id="edit_'+data[i].idArticulo+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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

function regenerar_tablaArticulos(){
  $('#div_registros1').html("");
  var html = "";
  html += '<table id="example1" class="table table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>Descripcion</th>';
  html += '<th>Marca</th>';
  html += '<th>Modelo</th>';
  html += '<th>Seleccionar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros1').html(html);
}
function obtener_registros(){
  var opc = "obtener_registros";
  $('.line-scale-pulse-out').show();
  regenerar_tabla();
  $.post("dist/fw/equipamiento.php",{opc:opc},function(data){
      if(data){
          var html = '';
          for (var i = 0; i < data.length; i++){
            html += '<tr class="edita_error" id="error_' + $.trim(data[i].ClaveEmpresa) + '">';
            html += '<td>' + $.trim(data[i].RazonSocial) + '</td>';
            html += '<td>' + $.trim(data[i].RFC) + '</td>';
            html += '<td>' + $.trim(data[i].Domicilio) + '</td>';
            html += '<td class="btnEditar" id="edit_'+data[i].ClaveEmpresa+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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
  $('#div_registros1').html("");
  var html = "";
  html += '<table id="example3" class="table table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>Razon</th>';
  html += '<th>RFC</th>';
  html += '<th>Dirección</th>';
  html += '<th>Seleccionar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros1').html(html);
}

function limpia_formulario(){
  $("#UnidadNegocio").val("");
  $("#Laboratorio").val("");   
}

function obtener_empresa(id){
  var opc = "obtener_empresa";
  $('.line-scale-pulse-out').show();
  $.post("dist/fw/equipamiento.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formulario()
        $('#Empresa').show();
        $('#Empresa').text(data.RazonSocial);
        $('#idEmpresa').text(data.ClaveEmpresa);
        obtener_contactos(id);
      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
      $('.line-scale-pulse-out').hide();
  },'json');
}

function obtener_articulo(id){
  var opc = "obtener_articulo";
  $('.line-scale-pulse-out').show();
  $.post("dist/fw/equipamiento.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formularioArticulo()
        $('#Articulo').val(data.Descripcion);
        $('#Marca').val(data.Marca);
        $('#Modelo').val(data.Modelo);
      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
      $('.line-scale-pulse-out').hide();
  },'json');
}

function limpia_formularioArticulo(){
  $("#Articulo").val("");
  $("#Marca").val("");  
  $("#Modelo").val("");     
}

// CARGAR COMBO DE NOMBRE DE CONTACTOS-----------------------
function obtener_contactos(id){
  var opc = "obtener_contactos";
   $('#Nombre').html('');
    $.post("dist/fw/equipamiento.php",{'opc':opc, 'id':id},function(data){
      if(data){
         $('#Nombre').html(data);
      }
      else{
        alert("no devuelve nada :(");
      }
  },'json');
}
//---------------------------------------------------------
// CARGAR COMBO DE LABORATORIO-----------------------
function obtener_laboratorio(){
  var opc = "obtener_laboratorio";
  $('#idUnidadNegocio').html('');
  $.post("dist/fw/equipamiento.php",{'opc':opc},function(data){
      if(data){
         $('#Lab').html(data);
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