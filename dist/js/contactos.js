
$(document).ready(function(){
  $('.btnEditarG').hide();
	// obtener_numeros_empleado();
	// obtener_usuarios();
	limpia_formulario();
	obtener_registros();

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
     obj.Apellidos  = $.trim($('#Apellidos').val());
     obj.Cargo = $.trim($('#Cargo').val());
     obj.Celular = $.trim($('#Celular').val());
     obj.Tel = $.trim($('#Observaciones').val());
     obj.Ext = $.trim($('#Ext').val());
     obj.Fax = $.trim($('#Fax').val());
     obj.Email = $.trim($('#Email').val());
     obj.Condiciones = $.trim($('#Condiciones').val());
     obj.Activo = $.trim($('#exampleCustomCheckbox1').val());
     obj.accion = $(this).attr("id").split('_')[1];
     obj.ClaveContacto = $(this).attr("id").split('_')[2];
     // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
     if(obj.Nombre != '' && obj.Nombre != ''){
       guardar_contacto(obj);
     }
     else{
       alerta_error("Oops...","Faltan llenar algunos campos");
     }
   });
 // =======================================================================
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
// =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
function guardar_contactos(obj){
  var opc = "guardar_contactos";
  $.post("dist/fw/contactos.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
      if(data){
          alerta("¡Guardado!", "El contacto se guardo correctamente, ¿desea seguir en 'Contactos'", "success");
          obtener_contactos();
      }else{
          alerta_error("¡Error!","Error al guardar los datos");
      }
  },'json');
}
// ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
function obtener_registro(id){
  /* var opc = "obtener_registro";
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
  },'json'); */
}
// ============================================================================================
function obtener_registros(){
    var opc = "obtener_registros";
      $('.line-scale-pulse-out').show();
    $.post("dist/fw/contactos.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
                html += '<tr class="edita_error" id="error_' + $.trim(data[i].ClaveContacto) + '">';
                html += '<td>' + $.trim(data[i].ClaveContacto) + '</td>';
                html += '<td>' + $.trim(data[i].Nombre) + '</td>';
                html += '<td>' + $.trim(data[i].Apellidos) + '</td>';
                html += '<td>' + $.trim(data[i].Cargo) + '</td>';
                html += '<td>' + $.trim(data[i].Celular) + '</td>';
                html += '<td>' + $.trim(data[i].Tel) + '</td>';
                html += '<td>' + $.trim(data[i].Fax) + '</td>';
                html += '<td>' + $.trim(data[i].Ext) + '</td>';
                html += '<td>' + $.trim(data[i].Email) + '</td>';
                // html += '<td class="btnEditar" id="edit_'+data[i].ClaveContacto+'"><span class="glyphicon glyphicon-pencil" ></span></td>';
                // html += '<td class="btnBorrar" id="del_'+data[i].ClaveContacto+'"><span class="glyphicon glyphicon-trash" ></span></td>';
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
  $('.line-scale-pulse-out').show();
      $('#div_registros').html("");
        var html = "";
        html += '<table id="example1" class="table table-bordered table-striped dataTable">';
        html += '<thead>';
        html += '<tr>';
        html += '<th>Clave Contacto</th>';
        html += '<th>Nombre</th>';
        html += '<th>Apellidos</th>';
        html += '<th>Cargo</th>';
        html += '<th>Celular</th>';
        html += '<th>Tel</th>';
        html += '<th>Fax</th>';
        html += '<th>Ext</th>';
        html += '<th>Email</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';
        html += '</tbody>';
        html += '</table>';
        $('#div_registros').html(html);
      $('.line-scale-pulse-out').hide();
}

function registrar_C(Nombre,Apellidos,Cargo,Celular,Tel,Ext,Fax,Email,Descuento,Condiciones,Activo){
	var opc = 'registrar_contacto';
	$.post("dist/fw/contacto.php",{opc:opc,Nombre:Nombre,Apellidos:Apellidos,Cargo:Cargo,Celular:Celular,Tel:Tel,Fax:Fax,Ext:Ext,Email:Email,Descuento:Descuento,Condiciones:Condiciones,Activo:Activo}, function(data){
		if(data){
			alerta();
			limpia_formulario();
		}
	}, 'json');
}

function limpia_formulario(){
    $("#Nombre").val("");
    $("#Apellidos").val("");
    $("#Cargo").val("");
    $("#Celular").val("");
    $("#Tel").val("");
    $("#Fax").val("");
    $("#Ext").val("");
    $("#Email").val("");
/*     $("#Descuento").val("");
    $("#Condiciones").val("");
    $("#Email").val("");
    $("#Activo").removeAttr("checked");	 */
	
}
	function alerta(){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: '¡Guardado!',
        text: "La empresa se guardó correctamente, ¿desea seguir en 'Empresas'?",
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'Si!',
        cancelButtonText: 'No, salir!',
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
