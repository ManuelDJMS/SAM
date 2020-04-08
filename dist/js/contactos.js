$(document).ready(function(){
  obtener_contactos();
  // ==================================================================================================
  // ========================= EVENTO DE EL BOTON GUARDAR (MANDAR POST)================================
	$('html').on('click', '.btnGuardar', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =============== 
      var obj = new Object();
      obj.ClaveEmpresa = $('.EmpresaID').attr('id');
      obj.Nombre = $.trim($('#Nombre').val());
      obj.Apellidos = $.trim($('#Apellidos').val());
      obj.Cargo = $.trim($('#Cargo').val());
      obj.Celular = $.trim($('#Celular').val());
      obj.Telefono = $.trim($('#Tel').val());
      obj.Ext = $.trim($('#Ext').val());
      obj.Fax = $.trim($('#Fax').val());
      obj.Email = $.trim($('#Email').val());
      obj.Condiciones = $.trim($('#Condiciones').val());
      obj.accion = $(this).attr("id").split('_')[1];
      obj.ClaveContacto = $(this).attr("id").split('_')[2];
      // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
      if(obj.Nombre != '' && obj.Email != ''){
        if( obj.ClaveEmpresa == 0){
          alerta_error("Oops...","¡No has seleccionado ninguna empresa!");

        }
        else{
          guardar_contacto(obj);


        }
      }
      else{
        alerta_error("Oops...","Faltan llenar algunos campos");
      }
    });
  // ==================================================================================================
  // ============================ EVENTO DE EDITAR EN LA TABLA ========================================
  $('html').on('click', '.btnEditar', function(){
      //SE SIMULA EL CLICK DEL TAB 
      $("#tab-0").get(0).click();
      //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES ============================
      $('.btnEditarG').show();
      $('.btnGuardar').hide();
      //=======================================================================================
      // ================ SE ASIGNA ID A EDITAR ===============================================
      var id = $(this).attr('id').split('_')[1];
      $('.btnEditarG').attr('id',$(this).attr('id'));
      obtener_registro(id);
  });
  //===================================================================================================
  //============================= EVENTO DEL BOTON DE EDITAR Y GUARDAR ================================
   $('html').on('click', '.btnEditarG', function(){
    //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =============== 
    var obj = new Object();
    obj.ClaveEmpresa = $('.EmpresaID').attr('id');
    obj.Nombre = $.trim($('#Nombre').val());
    obj.Apellidos = $.trim($('#Apellidos').val());
    obj.Cargo = $.trim($('#Cargo').val());
    obj.Celular = $.trim($('#Celular').val());
    obj.Telefono = $.trim($('#Tel').val());
    obj.Ext = $.trim($('#Ext').val());
    obj.Fax = $.trim($('#Fax').val());
    obj.Email = $.trim($('#Email').val());
    obj.Condiciones = $.trim($('#Condiciones').val());
    obj.accion = $(this).attr("id").split('_')[1];
    obj.ClaveContacto = $(this).attr("id").split('_')[2];
    alert(obj.accion);
    alert(obj.ClaveContacto);
    // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
    if(obj.Nombre != '' && obj.Email != ''){
      if( obj.ClaveEmpresa == 0){
        alerta_error("Oops...","¡No has seleccionado ninguna empresa!");

      }
      else{
        guardar_contacto(obj);


      }
    }
    else{
      alerta_error("Oops...","Faltan llenar algunos campos");
    }
   });
   //==================================================================================================
   //============================= EVENTO DEL BOTON DE ABRIR LA EMPRESA================================
   $('html').on('click', '#verEmpresas', function(){
    obtener_empresas();
   });
   //========================EVENTO DEL BOTON DE SELECCIONAR LA EMPRESA ===============================
   $('html').on('click', '.btnSeleccionar', function(){
    var id = $(this).attr('id').split('_')[1];
    $('.EmpresaID').attr('id', id);
    // alert($('.EmpresaID').attr('id'))
     obtener_empresa(id);
   });
   //==================================================================================================
});
// =========================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ==============================
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
//=====================================================================================================
// ============================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ==========================
function obtener_registro(id){
  var opc = "obtener_registro";
  $('.preloader').show();
  $.post("dist/fw/contactos.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formulario()
        $('#Nombre').val(data.Nombre.trim());
        $('#Apellidos').val(data.Apellidos.trim());
        $('#Cargo').val(data.Cargo.trim());
        $('#Celular').val(data.Celular.trim());
        $('#Tel').val(data.Tel.trim());
        $('#Ext').val(data.Ext.trim());
        $('#Fax').val(data.Fax.trim());
        $('#Email').val(data.Email.trim());
        $('#Condiciones').val(data.CondicionesClienteAdmon.trim());
        var nombre="Contacto creado para la empresa: " + data.RazonSocial;
        $('.EmpresaID').text(nombre);
        $('.EmpresaID').attr('id', data.ClaveEmpresa);
        $('.btnEditarG').attr('id', 'btn_editar_'+id);
      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
      $('.preloader').hide();
  },'json');
}
//=====================================================================================================
// ============================= METODO PÁRA OBTENER LA EMPRESA PARA AGREGAR ==========================
function obtener_empresa(id){
  var opc = "obtener_empresa";
  $('.line-scale-pulse-out').show();
  $.post("dist/fw/contactos.php",{'opc':opc, 'id':id},function(data){
      if(data){
        $('.EmpresaID').attr('id',data.ClaveEmpresa);
        var nombre="Contacto creado para la empresa: " + data.RazonSocial;
        $('.EmpresaID').text(nombre);
        $("#verEmpresas").get(0).click();
      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
      $('.line-scale-pulse-out').hide();
  },'json');
}
//=====================================================================================================
// ============================= METODO PARA OBTENER LOS CONTACTOS ====================================
function obtener_contactos(){
    var opc = "obtener_contactos";
    $('.line-scale-pulse-out').show();
    regenerar_tabla();
    $.post("dist/fw/contactos.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
                html += '<tr>';
                html += '<td>' + $.trim(data[i].ClaveContacto) + '</td>';
                html += '<td>' + $.trim(data[i].RazonSocial) + '</td>';
                html += '<td>' + $.trim(data[i].RFC) + '</td>';
                html += '<td>' + $.trim(data[i].Nombre) + '</td>';
                html += '<td>' + $.trim(data[i].Apellidos) + '</td>';
                html += '<td>' + $.trim(data[i].Email) + '</td>';
                html += '<td>' + $.trim(data[i].Celular) + '</td>';
                html += '<td>' + $.trim(data[i].Tel) + '</td>';
                html += '<td>' + $.trim(data[i].Ext) + '</td>';
                html += '<td>' + $.trim(data[i].Credito) + '</td>';
                html += '<td class="btnEditar" id="edit_'+data[i].ClaveContacto+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
                html += '</tr>';                        
            }
            $('#table_contactos tbody').html(html);
            $('#table_contactos').DataTable({
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
//=====================================================================================================
// ============================= METODO PÁRA OBTENER LAS EMPRESAS =====================================
function obtener_empresas(){
  var opc = "obtener_empresas";
  $('.preloader').show();
  regenerar_tabla_empresas();
  $.post("dist/fw/contactos.php",{opc:opc},function(data){
      if(data){
          var html = '';
          for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].ClaveEmpresa) + '">';
              html += '<td>' + $.trim(data[i].ClaveEmpresa) + '</td>';
              html += '<td>' + $.trim(data[i].RazonSocial) + '</td>';
              html += '<td>' + $.trim(data[i].RFC) + '</td>';
              html += '<td>' + $.trim(data[i].Credito) + '</td>';
              html += '<td>' + $.trim(data[i].NumProvMetas) + '</td>';
              html += '<td>' + $.trim(data[i].AdminPaq) + '</td>';
              html += '<td>' + $.trim(data[i].ObservacionesEmpresa) + '</td>';
              html += '<td class="btnSeleccionar" id="edit_'+data[i].ClaveEmpresa+'"><span class="font-icon-wrapper pe-7s-back" ></span></td>';
              html += '</tr>';                        
          }
          $('#table_empresas tbody').html(html);
          $('#table_empresas').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": true
          });
      }
      $('.preloader').hide();
  },'json');
}
//=====================================================================================================
// ============================= METODO LIMPIAR LA TABLA DE LOS CONTACTOS =============================
function regenerar_tabla(){
    $('#div_contactos').html("");
    var html = "";
    html += '<table id="table_contactos" class="table table-hover table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Clave Contacto</th>';
    html += '<th>Razón Social</th>';
    html += '<th>RFC</th>';
    html += '<th>Nombre</th>';
    html += '<th>Apellidos</th>';
    html += '<th>Email</th>';
    html += '<th>Celular</th>';
    html += '<th>Tel</th>';
    html += '<th>Ext</th>';
    html += '<th>Crédito</th>';
    html += '<th>Editar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_contactos').html(html);
}
//=====================================================================================================
// ============================ METODO PARA LIMPIAR LA TABLA DE LAS EMPRESAS ==========================
function regenerar_tabla_empresas(){
  $('#div_empresas').html("");
  var html = "";
  html += '<table id="table_empresas" class="table table-hover table-bordered table-striped dataTable">';
  html += '<thead>';
  html += '<tr>';
  html += '<th>Clave Empresa</th>';
  html += '<th>Razón Social</th>';
  html += '<th>RFC</th>';
  html += '<th>Crédito</th>';
  html += '<th>N° Proveedor</th>';
  html += '<th>Clave de AdminPaq</th>';
  html += '<th>Observaciones de la empresa</th>';
  html += '<th>Seleccionar</th>';
  html += '</tr>';
  html += '</thead>';
  html += '<tbody>';
  html += '</tbody>';
  html += '</table>';
  $('#div_empresas').html(html);
}
//=====================================================================================================
// ============================= METODO PARA LIMPIAR EL FORMULARIO ====================================
function limpia_formulario(){
    $("#Nombre").val("");
	$("#Apellidos").val("");
	$("#Cargo").val("");
	$("#Celular").val("");
	$("#Tel").val("");
  $("#Ext").val("");
	$("#Fax").val("");
	$("#Email").val("");
	$("#Condiciones").val("");
}
//=====================================================================================================
// ============================= METODO PÁRA MANDAR ALERTA DE success =================================
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
//=====================================================================================================
// ============================= METODO PÁRA MANDAR ALERTA DE ERROR ===================================
function alerta_error(titulo, texto){
  Swal.fire({
    icon: 'error',
    title: titulo,
    text: texto
    // footer: '<a href>Why do I have this issue?</a>'
  })
}
