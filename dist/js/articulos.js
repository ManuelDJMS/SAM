$(document).ready(function(){
    $('.btnEditarG').hide();
    $('.btnAgregar').hide();
    $('.divServicios').hide();
    // $('#Empresa').hide();
    // limpia_formulario();
    obtener_laboratorio();
    // obtener_articulos();
    obtener_registros();
    obtener_servicios();
    // obtener_equipamiento();
    $('html').on('click','#check3',function(){
        if($(this).val() == 1){
          $(this).val(0);
        }
        else{
          $(this).val(1);
        }
      });

      // =========== EVENTO DE EDITAR EN LA TABLA ==============================
    $('html').on('click', '.btnEditar', function(){
      //SE SIMULA EL CLICK DEL TAB 
      
      $("#tab-0").get(0).click();
      //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
      $('.btnEditarG').show();
      $('.btnGuardar').hide();
      $('.divServicios').show();
      //=======================================================================================
      // ================ SE ASIGNA ID A EDITAR ===============================================
      var id = $(this).attr('id').split('_')[1];
      $('.btnEditarG').attr('id',$(this).attr('id'));
      obtener_registro(id);
  });
  //========================================================================
    // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
	  $('html').on('click', '.btnGuardar', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
     var obj = new Object()
     obj.itemNumber = $.trim($('#itemNumber').val());
      obj.Nombre = $.trim($('#Nombre').val());
       obj.Marca = $.trim($('#Marca').val());
       obj.Modelo = $.trim($('#Modelo').val());
       obj.Serie = $.trim($('#Serie').val());
       obj.Exactitud = $.trim($('#Exactitud').val());
       obj.Rango = $.trim($('#Rango').val());
       obj.DiasCalibracion = $.trim($('#DiasCalibracion').val());
       obj.PesoAproximado = $.trim($('#PesoAproximado').val());
       obj.Intervalo = $.trim($('#Intervalo').val());
       obj.Ciclo = $.trim($('#Ciclo').val());
       obj.Lab = $.trim($('#Lab').val());
       obj.Descripcion = $.trim($('#Descripcion').val());
       obj.Metodo = $.trim($('#Metodo').val());
       obj.Estandarizacion = $.trim($('#Estandarizacion').val());
       obj.Acreditacion = $.trim($('#Acreditacion').val());
       obj.Relacion = $.trim($('#Relacion').val());
       obj.Especificaciones = $.trim($('#Especificaciones').val());
       obj.Notas = $.trim($('#Notas').val());      
       obj.CActivo = $.trim($('#check3').val());
       obj.IdServicio = $.trim($('#idServicio').text());
       obj.Precio = $.trim($('#Precio').val());    
       obj.accion = $(this).attr("id").split('_')[1];
       obj.EquipId = $(this).attr("id").split('_')[2];
       // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
          if(obj.itemNumber != '')
          {
                registrar_articulo(obj);
              }
            else
              {
                alerta_error("INFORMACIÓN FALTANTE","Debe Ingresar información de artículo");
              }       
    });
  // =======================================================================
  //============== EVENTO DEL BOTON DE EDITAR Y GUARDAR =====================
  $('html').on('click', '.btnEditarG', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
    var obj = new Object()
    obj.itemNumber = $.trim($('#itemNumber').val());
     obj.Nombre = $.trim($('#Nombre').val());
      obj.Marca = $.trim($('#Marca').val());
      obj.Modelo = $.trim($('#Modelo').val());
      obj.Serie = $.trim($('#Serie').val());
      obj.Exactitud = $.trim($('#Exactitud').val());
      obj.Rango = $.trim($('#Rango').val());
      obj.DiasCalibracion = $.trim($('#DiasCalibracion').val());
      obj.PesoAproximado = $.trim($('#PesoAproximado').val());
      obj.Intervalo = $.trim($('#Intervalo').val());
      obj.Ciclo = $.trim($('#Ciclo').val());
      obj.Lab = $.trim($('#Lab').val());
      obj.Descripcion = $.trim($('#Descripcion').val());
      obj.Metodo = $.trim($('#Metodo').val());
      obj.Estandarizacion = $.trim($('#Estandarizacion').val());
      obj.Acreditacion = $.trim($('#Acreditacion').val());
      obj.Relacion = $.trim($('#Relacion').val());
      obj.Especificaciones = $.trim($('#Especificaciones').val());
      obj.Notas = $.trim($('#Notas').val());      
      obj.CActivo = $.trim($('#check3').val());
      obj.accion = $(this).attr("id").split('_')[0];
      obj.EquipId = $(this).attr("id").split('_')[1];
      // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
      if(obj.itemNumber != '')
      {
           registrar_articulo(obj);
         }
       else
         {
           alerta_error("INFORMACIÓN FALTANTE","Debe Ingresar información de artículo");
         }
   });
   //=======================================================================
 // =========== EVENTO DE Seleccionar servicio ==============================
         $('html').on('click', '.btnSeleccionar', function(){
          //SE SIMULA EL CLICK DEL TAB 
          $("#tab-0").get(0).click();
          // ================ SE ASIGNA ID A EDITAR ===============================================
          var id = $(this).attr('id').split('_')[1];
          agregar_servicio(id);
      });
//========================================================================
});

// =========== FUNCIONES PARA OBTENER TODAS LAS EMPRESAS===================
function obtener_registros(){
  var opc = "obtener_registros";
  $('.line-scale-pulse-out').show();
  regenerar_tabla();
  $.post("dist/fw/articulos.php",{opc:opc},function(data){
      if(data){
          var html = '';
          for (var i = 0; i < data.length; i++){
            html += '<tr class="edita_error" id="error_' + $.trim(data[i].EquipId) + '">';
            html += '<td>' + $.trim(data[i].ItemNumber) + '</td>';
            html += '<td>' + $.trim(data[i].EquipmentName) + '</td>';
            html += '<td>' + $.trim(data[i].Mfr) + '</td>';
            html += '<td>' + $.trim(data[i].Model) + '</td>';
            html += '<td>' + $.trim(data[i].Accuracy) + '</td>';
            html += '<td>' + $.trim(data[i].Uncertainity) + '</td>';
            html += '<td class="btnEditar" id="edit_'+ data[i].EquipId +'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
            html += '</tr>';                   
          }
          $('#tablaArticulos tbody').html(html);
          $('#tablaArticulos').DataTable({
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
  html += '<table id="tablaArticulos" class="table table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>Num. Artículo</th>';
  html += '<th>Descripción</th>';
  html += '<th>Marca</th>';
  html += '<th>Modelo</th>';
  html += '<th>Exactitud</th>';
  html += '<th>Rango</th>';
  html += '<th>Seleccionar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros').html(html);
}
// =========================================================================

// =========== FUNCIONES DE OBTENER ARTICULO================================
function registrar_articulo(obj){
  if (obj.IdServicio != '0'){
    var opc = "registrar_articulo_servicio";
  }else{
    var opc = "registrar_articulo";
  }
  alert(opc);
  $.post("dist/fw/articulos.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
		if(data){
      alerta("¡Guardado!", "Artículo registrado, ¿Desea seguir en agregando artículos", "success");
    }else{
      alerta_error("¡Error!","Error al guardar los datos");
  }
  }, 'json');
}
// =========================================================================
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
// ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
  function obtener_registro(id){
    var opc = "obtener_registro";
    $('.line-scale-pulse-out').show();
    $.post("dist/fw/articulos.php",{'opc':opc, 'id':id},function(data){
        if(data){
          limpia_formulario()
          $('#itemNumber').val(data.ItemNumber);
          $('#Nombre').val(data.EquipmentName);
          $('#Marca').val(data.Mfr);
          $('#Modelo').val(data.Model);
          $('#Serie').val(data.SrlNo);
          $('#Exactitud').val(data.Accuracy);
          $('#Rango').val(data.Uncertainity);
          $('#DiasCalibracion').val(data.CALDue);
          $('#PesoAproximado').val(data.ApproxWeight);
          $('#Intervalo').val(data.CALInterval);
          $('#Ciclo').val(data.CALCycle);
          $('#Lab').val(data.Dept);
          $('#Descripcion').val(data.ServiceDescription);
          $('#Metodo').val(data.CalibrationMethod);
          $('#Estandarizacion').val(data.Standardization);
          $('#Acreditacion').val(data.Accreditation);
          $('#Acreditacion').val(data.RelationItemNo);
          $('#Relacion').val(data.RelationItemNo);
          $('#Especificaciones').val(data.AdditionalSepcification);
          $('#Notas').val(data.ShortNotes);
          if(data.Activo==1){
            $('#check3').val(1);
            $("#check3").attr('checked',true);
          }
        }
        else
        {
          alerta_error("Error", "Error al recibir los datos");
        }
        $('.line-scale-pulse-out').hide();
    },'json');
  }
  function limpia_formulario(){
    $('#itemNumber').val("");
    $('#Nombre').val("");
    $('#Marca').val("");
    $('#Modelo').val("");
    $('#Serie').val("");
    $('#Exactitud').val("");
    $('#Rango').val("");
    $('#DiasCalibracion').val("");
    $('#PesoAproximado').val("");
    $('#Intervalo').val("");
    $('#Ciclo').val("");
    $('#Lab').val("");
    $('#Descripcion').val("");
    $('#Metodo').val("");
    $('#Estandarizacion').val("");
    $('#Acreditacion').val("");
    $('#Acreditacion').val("");
    $('#Relacion').val("");
    $('#Especificaciones').val("");
    $('#Notas').val("");
    $("#exampleCustomCheckbox1").removeAttr("checked");
  }
// ============================================================================================
// =========== FUNCIONES PARA OBTENER TODAS LAS EMPRESAS===================
function obtener_servicios(){
  var opc = "obtener_servicios";
  $('.line-scale-pulse-out').show();
  regenerar_tablaServicios();
  $.post("dist/fw/articulos.php",{opc:opc},function(data){
      if(data){
          var html = '';
          for (var i = 0; i < data.length; i++){
            html += '<tr class="edita_error" id="error_' + $.trim(data[i].IdServicio) + '">';
            html += '<td>' + $.trim(data[i].NoCatalogo) + '</td>';
            html += '<td>' + $.trim(data[i].Servicio) + '</td>';
            html += '<td>' + $.trim(data[i].PrecioBase) + '</td>';
            html += '<td class="btnSeleccionar" id="edit_'+ data[i].IdServicio +'"><span class="font-icon-wrapper ion-android-add-circle" ></span></td>';
            html += '</tr>';                   
          }
          $('#tablaServicios tbody').html(html);
          $('#tablaServicios').DataTable({
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
 
function regenerar_tablaServicios(){
  $('#div_registros2').html("");
  var html = "";
  html += '<table id="tablaServicios" class="table table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>No. Catálogo</th>';
  html += '<th>Servicio</th>';
  html += '<th>Precio</th>';
  html += '<th>Agregar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros2').html(html);
}
// =========================================================================
// ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
function agregar_servicio(id){
  var opc = "agregar_servicio";
  $('.line-scale-pulse-out').show();
  $.post("dist/fw/articulos.php",{'opc':opc, 'id':id},function(data){
      if(data){
        // limpia_formulario()
        $('#NoCatalogo').val(data.NoCatalogo);
        $('#Servicio').val(data.Servicio);
        $('#Unidad').val(data.Unidad);
        $('#Observaciones').val(data.Observaciones);
        $('#Comentarios').val(data.Comentarios);
        $('#PrecioBase').val(data.PrecioBase);
        $('#idServicio').text(data.IdServicio);
        var idSer = data.IdServicio;
      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
      $('.line-scale-pulse-out').hide();
  },'json');
}
// function limpia_formulario(){
//   $('#itemNumber').val("");
//   $('#Nombre').val("");
//   $('#Marca').val("");
//   $('#Modelo').val("");
//   $('#Serie').val("");
//   $('#Exactitud').val("");
//   $('#Rango').val("");
//   $('#DiasCalibracion').val("");
//   $('#PesoAproximado').val("");
//   $('#Intervalo').val("");
//   $('#Ciclo').val("");
//   $('#Lab').val("");
//   $('#Descripcion').val("");
//   $('#Metodo').val("");
//   $('#Estandarizacion').val("");
//   $('#Acreditacion').val("");
//   $('#Acreditacion').val("");
//   $('#Relacion').val("");
//   $('#Especificaciones').val("");
//   $('#Notas').val("");
//   $("#exampleCustomCheckbox1").removeAttr("checked");
// }
// ============================================================================================
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
  // ==================================================