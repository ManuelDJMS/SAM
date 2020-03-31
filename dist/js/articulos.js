$(document).ready(function(){
    // $('.btnEditarG').hide();
    // $('#Empresa').hide();
    // limpia_formulario();
    obtener_laboratorio();
    // obtener_articulos();
    // obtener_registros();
    // obtener_equipamiento();
    $('html').on('click','#check3',function(){
        if($(this).val() == 1){
          $(this).val(0);
        }
        else{
          $(this).val(1);
        }
      });
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
       obj.PesoAproximado = $.trim($('#DiasAproximado').val());
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
       alert(obj.CActivo);
       obj.accion = $(this).attr("id").split('_')[1];
       obj.idArticulo = $(this).attr("id").split('_')[2];
       // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
       if(obj.itemNumber != '')
       {
            registrar_articulo(obj);
          }
        else
          {
            alerta_error("INFORMACIÓN FALTANTE","Debe seleccionar un contacto");
          }
    });
  // =======================================================================
});

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

// =========== FUNCIONES DE OBTENER ARTICULO================================
function registrar_articulo(obj){
  var opc = "registrar_articulo";
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