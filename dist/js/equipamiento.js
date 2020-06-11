$(document).ready(function(){
    $('.btnEditarG').hide();
    $('#Empresa').hide();
    limpia_formulario();
    obtener_laboratorio();
    obtener_articulos();
    obtener_registros();
    obtener_equipamiento();
    // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
	  $('html').on('click', '.btnGuardar', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
     var obj = new Object()
     obj.idArticulo = $.trim($('#idArt').text());
      obj.ClaveContacto = $.trim($('#Nombre').val());
       obj.MetasId = $.trim($('#metasId').val());
       obj.Serie = $.trim($('#Serie').val());
       obj.id = $.trim($('#id').val());
       obj.Lab = $.trim($('#Lab').val());
       obj.Notas = $.trim($('#Notas').val());
       obj.Puntos = $.trim($('#Puntos').val());
       obj.accion = $(this).attr("id").split('_')[1];
       obj.idUsuario = $(this).attr("id").split('_')[2];
       // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
       if(obj.ClaveContacto != '')
       {
          if(obj.idArticulo != '')
              {
                registrar_equipamiento(obj);
              }
       
              else
              {
                alerta_error("INFORMACIÓN FALTANTE","Debe seleccionar un artículo");
              }
          }
        else
          {
            alerta_error("INFORMACIÓN FALTANTE","Debe seleccionar un contacto");
          }
    });
  // =======================================================================
    // =========== EVENTO DE SELECCIONAR EMPRESA ===========================
    $('html').on('click', '.btnEditar', function(){
      //SE SIMULA EL CLICK DEL TAB 
      $("#tab-0").get(0).click();

      // ================ SE ASIGNA ID DE EMPRESA ==========================
      var id = $(this).attr('id').split('_')[1];
      obtener_empresa(id);
  });
  // =========== EVENTO DE SELECCIONAR ARTICULO ============================
  $('html').on('click', '.btnSeleccionar', function(){
    //SE SIMULA EL CLICK DEL TAB 
    $("#tab-0").get(0).click();
    // ================ SE ASIGNA ID DE ARTICULO============================
    var id = $(this).attr('id').split('_')[1];
    // $('.btnEditarG').attr('id',$(this).attr('id'));
    obtener_articulo(id);
});
});

// =========== FUNCIONES PARA OBTENER TODOS LOS ARTICULOS===================
function obtener_articulos(){
    var opc = "obtener_articulos";
    $('.line-scale-pulse-out').show();
    regenerar_tablaArticulos();
    $.post("dist/fw/equipamiento.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].EquipId) + '">';
              html += '<td>' + $.trim(data[i].EquipmentName) + '</td>';
              html += '<td>' + $.trim(data[i].Mfr) + '</td>';
              html += '<td>' + $.trim(data[i].Model) + '</td>';
              html += '<td class="btnSeleccionar" id="edit_'+data[i].EquipId+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
              html += '</tr>';                   
            }
            $('#example2 tbody').html(html);
            $('#example2').DataTable({
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
  $('#div_registros2').html("");
  var html = "";
  html += '<table id="example2" class="table table-bordered table-striped dataTable">';
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
  $('#div_registros2').html(html);
}
// =========================================================================

// =========== FUNCIONES PARA OBTENER TODAS LAS EMPRESAS===================
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
            html += '<td>' + $.trim(data[i].DomicilioFiscal) + '</td>';
            html += '<td class="btnEditar" id="edit_'+data[i].ClaveEmpresa+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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
 
function regenerar_tabla(){
  $('#div_registros1').html("");
  var html = "";
  html += '<table id="example1" class="table table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>Razon Social</th>';
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
// =========================================================================

// =========== FUNCIONES SELECCIONAR EMPRESA Y CONTACTO=====================
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
// =========================================================================
// =========== FUNCIONES LIMPIEZA DE FORMULARIO=============================
function limpia_formulario(){
  $("#UnidadNegocio").val("");
  $("#Laboratorio").val("");   
}

function limpia_formularioArticulo(){
  $("#Articulo").val("");
  $("#Marca").val("");  
  $("#Modelo").val("");  
  $("#metasId").val("");
  $("#id").val("");   
  $("#Serie").val("");
  $("#Notas").val("");
  $("#Puntos").val("");
  $("#Lab").val("");               
}
// =========================================================================
// =========== FUNCIONES DE OBTENER ARTICULO================================
function obtener_articulo(id){
  var opc = "obtener_articulo";
  var idArt = id;
  $('.line-scale-pulse-out').show();
  $.post("dist/fw/equipamiento.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formularioArticulo()
        $('#Articulo').val(data.EquipmentName);
        $('#idArt').text(data.EquipId);
        $('#Marca').val(data.Mfr);
        $('#Modelo').val(data.Model);
      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
      $('.line-scale-pulse-out').hide();
  },'json');
}
// =========================================================================
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
// =========== FUNCIONES DE OBTENER ARTICULO================================
function registrar_equipamiento(obj){
  var opc = "registrar_equipamiento";
  $.post("dist/fw/equipamiento.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
		if(data){
      alerta("¡Guardado!", "Equipamiento registrado, ¿Desea seguir en agregando equipamiento", "success");
      // obtener_signatarios();
    }else{
      alerta_error("¡Error!","Error al guardar los datos");
  }
  }, 'json');
}
// =========================================================================
// =========== FUNCIONES PARA OBTENER TODAS EL EQUIPAMIENTO===================
function obtener_equipamiento(){
  var opc = "obtener_equipamiento";
  $('.line-scale-pulse-out').show();
  regenerar_tabla();
  $.post("dist/fw/equipamiento.php",{opc:opc},function(data){
      if(data){
          var html = '';
          for (var i = 0; i < data.length; i++){
            html += '<tr class="edita_error" id="error_' + $.trim(data[i].idEquipamiento) + '">';
            html += '<td>' + $.trim(data[i].RazonSocial) + '</td>';
            html += '<td>' + $.trim(data[i].Nombre) + '</td>';
            html += '<td>' + $.trim(data[i].MetasId) + '</td>';
            html += '<td>' + $.trim(data[i].EquipmentName) + '</td>';
            html += '<td>' + $.trim(data[i].Mfr) + '</td>';
            html += '<td>' + $.trim(data[i].Model) + '</td>';
            html += '<td>' + $.trim(data[i].id) + '</td>';
            html += '<td>' + $.trim(data[i].Serie) + '</td>';      
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
 
function regenerar_tablaEquipamiento(){
  $('#div_registros3').html("");
  var html = "";
  html += '<table id="example3" class="table table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>Razon Social</th>';
  html += '<th>Contacto</th>';
  html += '<th>MetasId</th>';
  html += '<th>Equipo</th>';
  html += '<th>Marca</th>';
  html += '<th>Modelo</th>';
  html += '<th>ID</th>';
  html += '<th>Serie</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros3').html(html);
}
// =========================================================================

// =========== ALERTAS================================
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
          limpia_formularioArticulo();
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
  // ==================================================