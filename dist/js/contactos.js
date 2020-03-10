
$(document).ready(function(){
  $('.btnEditarG').hide();
  limpia_formulario();
  obtener_direcciones()
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
   obj.Apellidos = $.trim($('#Apellidos').val());
   obj.Cargo = $.trim($('#Cargo').val());
   obj.Celular = $.trim($('#Celular').val());
   obj.Tel = $.trim($('#Tel').val());
   obj.Ext = $.trim($('#Ext').val());
   obj.Fax = $.trim($('#Fax').val());
   obj.Email = $.trim($('#Email').val());
   obj.Descuento = $.trim($('#Descuento').val());
   obj.Condiciones = $.trim($('#Condiciones').val());
   obj.CActivo = $.trim($('#exampleCustomCheckbox1').val());
   obj.accion = $(this).attr("id").split('_')[1];
   obj.ClaveContacto = $(this).attr("id").split('_')[2];
   // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
   if(obj.Nombre != ''){
    guardar_contacto(obj);
     
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
  obj.Nombre = $.trim($('#Nombre').val());
  obj.Apellidos = $.trim($('#Apellidos').val());
  obj.Cargo = $.trim($('#Cargo').val());
  obj.Celular = $.trim($('#Celular').val());
  obj.Tel = $.trim($('#Tel').val());
  obj.Fax = $.trim($('#Fax').val());
  obj.Ext = $.trim($('#Ext').val());
  obj.Email = $.trim($('#Email').val());
  obj.Condiciones = $.trim($('#Condiciones').val());
  obj.Descuento = $.trim($('#Descuento').val());
  obj.CActivo = $.trim($('#exampleCustomCheckbox1').val());
  obj.accion = $(this).attr("id").split('_')[1];
   if(obj.Nombre != '' && obj.Nombre != ''){
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
  $.post("dist/fw/contactos.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formulario()
        $('#Nombre').val(data.Nombre);
        $('#Apellidos').val(data.Apellidos);
        $('#Cargo').val(data.Cargo);
        $('#Tel').val(data.Tel);
        $('#Ext').val(data.Ext);
        $('#Fax').val(data.Fax);
        $('#Email').val(data.Email);
        $("#Descuento option[value='"+ data.Descuento +"']").attr("selected", true);
        $('#Condiciones').val(data.Condiciones);
        if(data.CActivo==1){
          $('#exampleCustomCheckbox1').val(1);
          $("#exampleCustomCheckbox1").attr('checked',true);
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
  $.post("dist/fw/contactos.php",{opc:opc},function(data){
      if(data){
          var html = '';
          for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].ClaveContacto) + '">';
              html += '<td>' + $.trim(data[i].ClaveContacto) + '</td>';
              html += '<td>' + $.trim(data[i].Nombre) + '</td>';
              html += '<td>' + $.trim(data[i].Apellidos) + '</td>';
              html += '<td>' + $.trim(data[i].Cargo) + '</td>';
              html += '<td>' + $.trim(data[i].Tel) + '</td>';
              html += '<td>' + $.trim(data[i].Fax) + '</td>';
              html += '<td>' + $.trim(data[i].Ext) + '</td>';
              html += '<td>' + $.trim(data[i].Email) + '</td>';
              html += '<td class="btnEditar" id="edit_'+data[i].ClaveContacto+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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
      $('#div_registros').html("");
        var html = "";
        html += '<table id="example1" class="table table-bordered table-striped dataTable">';
        html += '<thead>';
        html += '<tr>';
        html += '<th>Clave Contacto</th>';
        html += '<th>Nombre</th>';
        html += '<th>Apellidos</th>';
        html += '<th>Cargo</th>';
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

// CODIGO PARA LA CONSULTA DE DIRECCCIONES
function obtener_direcciones(){
  var opc = "obtener_direcciones";
  $('.line-scale-pulse-out').show();
  regenerar_tabladirecciones();
  $.post("dist/fw/contactos.php",{opc:opc},function(data){
      if(data){
          var html = '';
          for (var i = 0; i < data.length; i++){
              html += '<tr class="edita_error" id="error_' + $.trim(data[i].IdDireccion) + '">';
              html += '<td>' + $.trim(data[i].DomicilioFiscal) + '</td>';
              html += '<td>' + $.trim(data[i].CiudadFiscal) + '</td>';
              html += '<td>' + $.trim(data[i].EdoFiscal) + '</td>';
              html += '<td>' + $.trim(data[i].DomicilioConsig) + '</td>';
              html += '<td>' + $.trim(data[i].CiudadConsig) + '</td>';
              html += '<td>' + $.trim(data[i].EdoConsig) + '</td>';
              html += '<td class="btnEditar" id="edit_'+data[i].IdDireccion+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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

function regenerar_tabladirecciones(){
      $('#div_direcciones').html("");
        var html = "";
        html += '<table id="example2" class="table table-bordered table-striped dataTable">';
        html += '<thead>';
        html += '<tr>';
        html += '<th>Domicilio Fiscal</th>';
        html += '<th>Ciudad</th>';
        html += '<th>Estado</th>';
        html += '<th>Domicilio Consig</th>';
        html += '<th>Ciudad</th>';
        html += '<th>Estado</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';
        html += '</tbody>';
        html += '</table>';
        $('#div_direcciones').html(html);
}
