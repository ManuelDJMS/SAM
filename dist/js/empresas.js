$(document).ready(function(){
  $('.btnEditarG').hide();
  
  limpia_formulario();
	obtener_registros();
  // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
	$('html').on('click', '.btnGuardar', function(){
      var obj = new Object();
      obj.RazonSocial = $.trim($('#RazonSocial').val());
      obj.Tipo = $.trim($('#exampleCustomSelect').val());
      obj.RFC = $.trim($('#RFC').val());
      obj.Credito = $.trim($('#Credito').val());
      obj.Observaciones = $.trim($('#Observaciones').val());
      obj.CVentas = $.trim($('#exampleCustomCheckbox1').val());
      obj.CCursos = $.trim($('#exampleCustomCheckbox2').val());
      obj.CGestoria = $.trim($('#exampleCustomCheckbox3').val());
      obj.accion = $(this).attr("id").split('_')[1];
      obj.ClaveEmpresa = $(this).attr("id").split('_')[2];
      if(obj.RazonSocial != '' && obj.RazonSocial != ''){
        guardar_empresa(obj);
    }
    else{
      alerta_error();
    }
    });
  // =======================================================================
  // =========== EVENTO DE EDITAR EN LA TABLA ==============================
  $('html').on('click', '.btnEditar', function(){
      var id = $(this).attr('id').split('_')[1];
      obtener_registro(id);
      $('.btnEditarG').show();
      $('.btnGuardar').hide();
  });
  //========================================================================
  //============== EVENTO DEL BOTON DE EDITAR Y GUARDAR =====================
  //  $('html').on('click', '.btnEditarG', function(){
  //   $(this).attr('id', 'btn_nuevo_0');
  //  });
   //=======================================================================
   //========================= EVENTO PARA MOVERSE EN TABS =================
  //  $('html').on('click', '#tab-0',function(){
  //   window.location="#tab-content-0";
  //  });
   //=======================================================================
});
// =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
function guardar_empresa(obj){
  var opc = "guardar_empresa";
  $.post("dist/fw/empresas.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
      if(data){
          alerta("¡Guardado!", "La empresa de guardo correctamente, ¿desea seguir en 'Empresas'", "success");
          obtener_registros();
      }else{
          alerta("¡Error!","Error al guardar registros", "danger");
      }
  },'json');
}
// ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
function obtener_registro(id){
  var opc = "obtener_registro";
  $.post("dist/fw/empresas.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formulario()
        $('#RazonSocial').val(data.RazonSocial.split(',')[0]);
         if(data.RazonSocial.split(',').length > 1 )
        {
          $("#exampleCustomSelect option[value='"+ (data.RazonSocial.split(',')[1]).trim()+"']").attr("selected", true);
        }
        $('#RFC').val(data.RFC);
        $('#Observaciones').val(data.ObservacionesEmpresa);
        $("#Credito option[value='"+ data.Credito +"']").attr("selected", true);
      }
      else
      {
        alerta_error();
      }
  },'json');
}
// ============================================================================================
function obtener_registros(){
    var opc = "obtener_registros";
    regenerar_tabla();
    $.post("dist/fw/empresas.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
                html += '<tr class="edita_error" id="error_' + $.trim(data[i].ClaveEmpresa) + '">';
                html += '<td>' + $.trim(data[i].ClaveEmpresa) + '</td>';
                html += '<td>' + $.trim(data[i].RazonSocial) + '</td>';
                html += '<td>' + $.trim(data[i].RFC) + '</td>';
                html += '<td>' + $.trim(data[i].Credito) + '</td>';
                html += '<td>' + $.trim(data[i].ObservacionesEmpresa) + '</td>';
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
    },'json');
}
    
function regenerar_tabla(){
    $('#div_registros').html("");
    var html = "";
    html += '<table id="example1" class="table table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Clave Empresa</th>';
    html += '<th>Razón Social</th>';
    html += '<th>RFC</th>';
    html += '<th>Crédito</th>';
    html += '<th>Observaciones de la empresa</th>';
    html += '<th>Editar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_registros').html(html);
}

function limpia_formulario(){
    $("#RazonSocial").val("");
	$("#RFC").val("");
	$("#Tipo").val("");
	$("#Credito").val("");
	$("#exampleCustomSelect").val("");
    $("#Observaciones").val("");
	$("#exampleCustomCheckbox1").removeAttr("checked");
	$("#exampleCustomCheckbox2").removeAttr("checked");
	$("#exampleCustomCheckbox3").removeAttr("checked");
	
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
  
  function alerta_error(){
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Faltan llenar algunos campos!'
      // footer: '<a href>Why do I have this issue?</a>'
    })
  }
