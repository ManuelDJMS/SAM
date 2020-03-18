$(document).ready(function(){
  $('.btnEditarG').hide();
  limpia_formulario();
  obtener_registros();
  // =================== EVENTOS DE SELECCION DE CHECKBOX ===================
  $('html').on('click','#exampleCustomCheckbox1',function(){
    if($(this).val()== 1){
      $(this).val(0);
    }
    else{
      $(this).val(1);
    }
  });
  // =======================================================================
  // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
	$('html').on('click', '.btnGuardar', function(){
     //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
      var obj = new Object();
      obj.Nombre = $.trim($('#Nombre').val());
      obj.Activo = $.trim($('#exampleCustomSelect').val());
      obj.Apellidos = $.trim($('#Apellidos').val());
      obj.Cargo = $.trim($('#Cargo').val());
      obj.Celular = $.trim($('#Celular').val());
      obj.Telefono = $.trim($('#Telefono').val());
      obj.Ext = $.trim($('#Ext').val());
      obj.Fax = $.trim($('#Fax').val());
      obj.Email = $.trim($('#Email').val());
      obj.Condiciones = $.trim($('#Condiciones').val());
      obj.accion = $(this).attr("id").split('_')[1];
      obj.ClaveContacto = $(this).attr("id").split('_')[2];
      // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
      if(obj.RazonSocial != '' && obj.RazonSocial != ''){
        guardar_empresa(obj);
      }
      else{
        alerta_error("Oops...","Faltan llenar algunos campos");
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
      obtener_registro(id);
  });
  //========================================================================
  //============== EVENTO DEL BOTON DE EDITAR Y GUARDAR =====================
   $('html').on('click', '.btnEditarG', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
    var obj = new Object();
    obj.RazonSocial = $.trim($('#RazonSocial').val());
    obj.Tipo = $.trim($('#exampleCustomSelect').val());
    obj.RFC = $.trim($('#RFC').val());
    obj.Credito = $.trim($('#Credito').val());
    obj.Observaciones = $.trim($('#Observaciones').val());
    obj.CVentas = $.trim($('#exampleCustomCheckbox1').val());
    obj.CCursos = $.trim($('#exampleCustomCheckbox2').val());
    obj.CGestoria = $.trim($('#exampleCustomCheckbox3').val());
    obj.accion = $(this).attr("id").split('_')[0];
    obj.ClaveEmpresa = $(this).attr("id").split('_')[1];
    if(obj.RazonSocial != '' && obj.RazonSocial != ''){
      guardar_contacto(obj);
    }
    else{
      alerta_error("Oops...","Faltan llenar algunos campos");
    }
   });
   //=======================================================================
});
// =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
function guardar_contacto(obj){
  var opc = "guardar_contacto";
  $.post("dist/fw/contactos.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
      if(data){
          alerta("¡Guardado!", "El contacto de guardo correctamente, ¿desea seguir en 'Contactos'", "success");
          obtener_registros();
      }else{
          alerta_error("¡Error!","Error al guardar los datos");
      }
  },'json');
}
// ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
function obtener_registro(id){
  var opc = "obtener_registro";
  $('.line-scale-pulse-out').show();
  $.post("dist/fw/empresas.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formulario()
        $('#RazonSocial').val(data.RazonSocial.split(',')[0]);
         if(data.RazonSocial.split(',').length > 1 ){
          $("#exampleCustomSelect option[value='"+ (data.RazonSocial.split(',')[1]).trim()+"']").attr("selected", true);
        }
        $('#RFC').val(data.RFC);
        $('#Observaciones').val(data.ObservacionesEmpresa);
        $("#Credito option[value='"+ data.Credito +"']").attr("selected", true);
        if(data.Ventas==1){
          $('#exampleCustomCheckbox1').val(1);
          $("#exampleCustomCheckbox1").attr('checked',true);
        }
        if(data.Cursos==1){
          $('#exampleCustomCheckbox2').val(1);
          $("#exampleCustomCheckbox2").attr('checked',true);
        }
        if(data.Gestoria==1){
          $('#exampleCustomCheckbox3').val(1);
          $("#exampleCustomCheckbox3").attr('checked',true);
        }
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
            $('#table_registros tbody').html(html);
            $('#table_registros').DataTable({
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
    html += '<table id="table_registros" class="table table-bordered table-striped dataTable">';
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
  
  function alerta_error(titulo, texto){
    Swal.fire({
      icon: 'error',
      title: titulo,
      text: texto
      // footer: '<a href>Why do I have this issue?</a>'
    })
  }
