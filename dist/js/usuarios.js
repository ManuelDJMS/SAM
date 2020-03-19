$(document).ready(function(){
  $('.btnEditarG').hide();
  limpia_formulario();
  obtener_registros();
  // =================== EVENTOS DE SELECCION DE CHECKBOX ===================
  $('html').on('click','#Responsable',function(){
    if($(this).val()== 1){
      $(this).val(1);
    }
    else{
      $(this).val(0);
    }
 
  });
  $('html').on('click','#Metrologo',function(){
    if($(this).val()== 1){
      $(this).val(1);
    }
    else{
      $(this).val(0);
    }
  });
  $('html').on('click','#Auxiliar',function(){
    if($(this).val()== 1){
      $(this).val(1);
    }
    else{
      $(this).val(0);
    }
  });
  // =======================================================================
  // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
	$('html').on('click', '.btnGuardar', function(){
     //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
      var obj = new Object();
      obj.Nombre = $.trim($('#Nombre').val());
        obj.Apellidos = $.trim($('#Apellidos').val());
        obj.Email = $.trim($('#Email').val());
        obj.Depto = $.trim($('#Depto').val());
        obj.Ext = $.trim($('#Ext').val());
        obj.password = $.trim($('#password').val());
        obj.Firma = $.trim($('#Firma').val());
        obj.Responsable = $.trim($('#Responsable').val());
        obj.Metrologo = $.trim($('#Metrologo').val());
        obj.Auxiliar = $.trim($('#Auxiliar').val());
        obj.accion = $(this).attr("id").split('_')[1];
        obj.idUsuario = $(this).attr("id").split('_')[2];
        // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
        if(obj.Nombre != '' && obj.Nombre != ''){
            guardar_usuario(obj);
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
      obtener_usuario(id);
  });
  //========================================================================
  //============== EVENTO DEL BOTON DE EDITAR Y GUARDAR =====================
   $('html').on('click', '.btnEditarG', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
    var obj = new Object();
    obj.Nombre = $.trim($('#Nombre').val());
        obj.Apellidos = $.trim($('#Apellidos').val());
        obj.Email = $.trim($('#Email').val());
        obj.Depto = $.trim($('#Depto').val());
        obj.Ext = $.trim($('#Ext').val());
        obj.password = $.trim($('#password').val());
        obj.Firma = $.trim($('#Firma').val());
        obj.Responsable = $.trim($('#Responsable').val());
        obj.Metrologo = $.trim($('#Metrologo').val());
        obj.Auxiliar = $.trim($('#Auxiliar').val());
        obj.accion = $(this).attr("id").split('_')[0];
        obj.idUsuario = $(this).attr("id").split('_')[1];
      if(obj.Nombre != '' && obj.Nombre != ''){
        alerta_error(obj.accion);
        guardar_usuario(obj);
      }
      else{
        alerta_error("Oops...","Faltan llenar algunos campos");
    }
   });
   //=======================================================================
});
// =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
function guardar_usuario(obj){
    var opc = "guardar_usuario";
    $.post("dist/fw/usuarios.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
        if(data){
            alerta("¡Guardado!", "El usuario se guardo correctamente, ¿desea seguir en 'Usuarios'", "success");
            obtener_usuarios();
        }else{
            alerta_error("¡Error!","Error al guardar los datos");
        }
    },'json');
}
// ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
function obtener_usuario(id){
  var opc = "obtener_usuario";
  $('.line-scale-pulse-out').show();
  $.post("dist/fw/usuarios.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formulario()
        $('#Nombre').val(data.Nombre);
        $('#Apellidos').val(data.Apellidos);
        $('#Email').val(data.Email);
        $("#Depto option[value='"+ data.Depto +"']").attr("selected", true);
        $('#Ext').val(data.Ext);
        $('#password').val(data.password);
        $('#clave').val(data.clave);
        if(data.Responsable==1){
          $('#Responsable').val(1);
          $("#Respónsable").attr('checked',true);
        }
        if(data.Metrologo==1){
          $('#Metrologo').val(1);
          $("#Metrologo").attr('checked',true);
        }
        if(data.Auxiliar==1){
          $('#Auxiliar').val(1);
          $("#Auxiliar").attr('checked',true);
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
    $.post("dist/fw/usuarios.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].idUsuario) + '">';
              html += '<td>' + $.trim(data[i].idUsuario) + '</td>';
              html += '<td>' + $.trim(data[i].Nombre) + '</td>';
              html += '<td>' + $.trim(data[i].Apellidos) + '</td>';
              html += '<td>' + $.trim(data[i].Depto) + '</td>';
              html += '<td>' + $.trim(data[i].Email) + '</td>';
              html += '<td class="btnEditar" id="edit_'+data[i].idUsuario+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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
  html += '<th>Clave</th>';
  html += '<th>Nombre</th>';
  html += '<th>Apellidos</th>';
  html += '<th>Depto</th>';
  html += '<th>Email</th>';
  html += '<th>Editar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_registros').html(html);
}

function obtener_cve(){
  var opc = "obtener_cve";
  $.post("dist/fw/usuarios.php",{'opc':opc},function(data){
      if(data){
        $('#clave').text(data);
      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
  },'json');
}
function limpia_formulario(){
  $("#Nombre").val("");
  $("#Apellidos").val("");
  $("#Email").val("");
  $("#Depto").val("");
  $("#Ext").val("");
  $("#password").val("");
  $("#Firma").val("");
  $("#Responsable").removeAttr("checked");
  $("#Metrologo").removeAttr("checked");
  $("#Auxiliar").removeAttr("checked");
	
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
