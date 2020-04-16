var html = '';
$(document).ready(function(){
    obtener_contactos();
    //  =====================================================================================================
    $('html').on('click', '#ObtenerArticulos', function(){
        obtener_articulos();
    });
    // ======================== EVENTO DE EDITAR EN LA TABLA DE EMPRESAS ====================================
    $('html').on('click', '.btnContacto', function(){
        var id = $(this).attr('id').split('_')[1];
        $('.btnCotizacion').attr('id',$(this).attr('id'));
        obtener_contacto(id);
    });
    $('html').on('click', '.btnCotizacion', function(){
      $("#tab-1").show();
      $("#tab-1").get(0).click();
      obtener_lugarServicio();
      obtener_tiempoEntrega();
      obtener_terminosPago();
      obtener_modalidad();
      obtener_precios();
    });
    //=======================================================================================================
    // ======================== EVENTO PARA SELECCIONAR ARTICULOS ===========================================
    $('html').on('click', '.btnArticulos', function(){
        // ================ SE ASIGNA ID A EDITAR ===============================================
        var id = $(this).attr('id').split('_')[1];
    });
    var table = $('#hola').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [1,2,3]
        }]
    });
   
      // $('#button').click( function() {
      //     var data = table.$('input, select').serialize();
      //     alert(
      //         "The following data would have been submitted to the server: \n\n"+
      //         data.substr( 0, 120 )+'...'
      //     );
      //     return false;
      // } );

      // var t = $('#hola').DataTable();
      // var counter = 1;
   
    $('#addRow').on( 'click', function () {
      // html += '<tr>';
      // html += '<td>' + $.trim('data[i].Nombre') + '</td>';
      // html += '</tr>';
      // $('#hola tbody').html(html);
      obtener_articulosCot(150);
    } );
  });
  // ============================== METODO PÁRA OBTENER LUGAR CONDICION =====================================
  function obtener_lugarServicio(){
      var opc = 'obtener_lugarServicio';
      $.post("dist/fw/cotizacion.php",{opc:opc}, function(data){
          if(data){
              var mySelect = $('#LugarServicio');
              
              for (var i = 0; i < data.length; i++){
                  mySelect.append(
                      $('<option></option>').val(data[i].idLugarServicio).html(data[i].Descripcion)
                  );                       
              }
              mySelect.append(
                $('<option></option>').val("1").html("")
            );  
          }
      }, 'json');
  }
  // ========================================================================================================
  // ============================== METODO PÁRA OBTENER TIEMPO D ENTREGA ====================================
  function obtener_tiempoEntrega(){
      var opc = 'obtener_tiempoEntrega';
      $.post("dist/fw/cotizacion.php",{opc:opc}, function(data){
          if(data){
              var mySelect = $('#TiempoEntrega');
              for (var i = 0; i < data.length; i++){
                  mySelect.append(
                      $('<option></option>').val(data[i].idTiempoEntrega).html(data[i].Descripcion)
                  );                       
              }
              mySelect.append(
                $('<option></option>').val("2").html("")
            );  
          }
      }, 'json');
  }
  // ========================================================================================================
  // ============================== METODO PÁRA OBTENER TERMINOS DE PAGO ====================================
  function obtener_terminosPago(){
      var opc = 'obtener_terminosPago';
      $.post("dist/fw/cotizacion.php",{opc:opc}, function(data){
          if(data){
              var mySelect = $('#TerminosPago');
              for (var i = 0; i < data.length; i++){
                  mySelect.append(
                      $('<option></option>').val(data[i].idTerminoPago).html(data[i].Descripcion)
                  );                       
              }
              mySelect.append(
                $('<option></option>').val("1").html("")
            );  
          }
      }, 'json');
  }
  // ========================================================================================================
  // ============================== METODO PÁRA OBTENER TERMINOS DE PAGO ====================================
  function obtener_modalidad(){
      var opc = 'obtener_modalidad';
      $.post("dist/fw/cotizacion.php",{opc:opc}, function(data){
          if(data){
              var mySelect = $('#Modalidad');
              for (var i = 0; i < data.length; i++){
                  mySelect.append(
                      $('<option></option>').val(data[i].idModalidad).html(data[i].Descripcion)
                  );                       
              }
              mySelect.append(
                $('<option></option>').val("1").html("")
            );  
          }
      }, 'json');
  }
  // ========================================================================================================
  // ============================== METODO PÁRA OBTENER TERMINOS DE PAGO ====================================
  function obtener_precios(){
      var opc = 'obtener_precios';
      $.post("dist/fw/cotizacion.php",{opc:opc}, function(data){
          if(data){
              var mySelect = $('#Precios');
              for (var i = 0; i < data.length; i++){
                  mySelect.append(
                      $('<option></option>').val(data[i].idPrecio).html(data[i].Descripcion)
                  );                       
              }
              mySelect.append(
                $('<option></option>').val("1").html("")
            );  
          }
      }, 'json');
  }
  // ========================================================================================================
  // ============================== METODO PÁRA OBTENER UN REGISTRO PARA EDITAR =============================
  function obtener_contacto(id){
    var opc = "obtener_contacto";
    $('.preloader').show();
    $.post("dist/fw/cotizacion.php",{'opc':opc, 'id':id},function(data){
        if(data){
          // limpia_formulario()
          $('#NombreContacto').text(data.Nombre + " " + data.Apellidos);
          $('#EmpresaContacto').text(data.RazonSocial);
          $('#EmailContacto').text(data.Email);
          $('#TelefonoContacto').text(data.Tel);
        }
        else
        {
          alerta_error("Error", "Error al recibir los datos");
        }
        $('.preloader').hide();
    },'json');
  }
  // ========================================================================================================
  // =============================== CODIGO PARA OBTENER LOS CONTACTOS A COTIZAR ============================
  function obtener_contactos(){
      var opc = "obtener_contactos";
      $('.preloader').show();
      regenerar_contactos();
      $.post("dist/fw/cotizacion.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                  html += '<tr>';
                  html += '<td>' + $.trim(data[i].Nombre) + '</td>';
                  html += '<td>' + $.trim(data[i].Apellidos) + '</td>';
                  html += '<td>' + $.trim(data[i].RazonSocial) + '</td>';
                  html += '<td>' + $.trim(data[i].RFC) + '</td>';
                  html += '<td>' + $.trim(data[i].Email) + '</td>';
                  html += '<td>' + $.trim(data[i].Tel) + '</td>';
                  html += '<td class="btnContacto" id="edit_'+data[i].ClaveContacto+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
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
          $('.preloader').hide();
      },'json');
  }
  // ================================== CODIGO PARA MANDAR LOS ARTICULOS A COTIZAR ==========================
  function obtener_articulosCot(id){
      var opc = "obtener_articulosCot";
      // $('.preloader').show();
      regenerar_articulosCot();
      $.post("dist/fw/cotizacion.php",{opc:opc, 'id':id},function(data){
          if(data){
              // var html = '';
              for (var i = 0; i < data.length; i++){
                  html += '<tr>';
                  html += '<td>' + $.trim(data[i].ItemNumber) + '</td>';
                  html += '<td>' + $.trim(data[i].EquipmentName) + '</td>';
                  html += '<td>' + $.trim(data[i].Mfr) + '</td>';
                  html += '<td>' + $.trim(data[i].Model) + '</td>';
                  html += '<td>' + $.trim(data[i].ServiceDescription) + '</td>';
                  html += '<td class="btnEliminar" id="edit_'+data[i].EquipId+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
                  html += '</tr>';                        
              }
              $('#hola tbody').html(html);
              // $('#table_contactos').DataTable({
              //     "paging": true,
              //     "lengthChange": true,
              //     "searching": true,
              //     "ordering": true,
              //     "info": true,
              //     "autoWidth": true
              // });
          }
          // $('.preloader').hide();
      },'json');
  }
  // ==================== CODIGO PARA OBTENER LOS ARTICULOS A COTIZAR DE LA EMPRESA SELECCIONADA=====================
  function obtener_articulos(){
      var opc = "obtener_articulos";
      $('.preloader').show();
      regenerar_tabla_articulos();
      $.post("dist/fw/cotizacion.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                  html += '<tr>';
                  html += '<td>' + $.trim(data[i].ItemNumber) + '</td>';
                  html += '<td>' + $.trim(data[i].EquipmentName) + '</td>';
                  html += '<td>' + $.trim(data[i].Mfr) + '</td>';
                  html += '<td>' + $.trim(data[i].Model) + '</td>';
                  html += '<td>' + $.trim(data[i].ServiceDescription) + '</td>';
                  html += '<td class="btnArticulos" id="edit_'+data[i].EquipId+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
                  html += '</tr>';                        
              }
              $('#table_articulos tbody').html(html);
              $('#table_articulos').DataTable({
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
  // ============================== CODIGO PARA REGENERAR LA TABLA DE CONTACTOS ==========================================================================
  function regenerar_contactos(){
      $('#div_contactos').html("");
      var html = "";
      html += '<table id="table_contactos" class="table table-hover table-bordered table-striped dataTable">';
      html += '<thead>';
      html += '<tr>';
      html += '<th>Nombre</th>';
      html += '<th>Apellidos</th>';
      html += '<th>Razón Social</th>';
      html += '<th>RFC</th>';
      html += '<th>Email</th>';
      html += '<th>Teléfono</th>';
      html += '<th>Elegir</th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';
      html += '</tbody>';
      html += '</table>';
      $('#div_contactos').html(html);
  }
  // ============================== CODIGO PARA REGENERAR LA TABLA DE CONTACTOS ==========================================================================
  function regenerar_articulosCot(){
      $('#div_articulosCot').html("");
      var html = "";
      html += '<table id="hola" class="table table-hover table-bordered table-striped display">';
      html += '<thead>';
      html += '<tr>';
      html += '<th>SKU</th>';
      html += '<th>Descripcion</th>';
      html += '<th>Marca</th>';
      html += '<th>Modelo</th>';
      html += '<th>Descripción del Servicio</th>';
      html += '<th></th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';
      html += '</tbody>';
      html += '</table>';
      $('#div_articulosCot').html(html);
  }
  // ============================== CODIGO PARA REGENERAR LA TABLA DE ARTICULOS ==========================================================================
  function regenerar_tabla_articulos(){
      $('#div_articulos').html("");
      var html = "";
      html += '<table id="table_articulos" class="table table-hover table-bordered table-striped dataTable">';
      html += '<thead>';
      html += '<tr>';
      html += '<th>N° de Artículo</th>';
      html += '<th>Descripcion</th>';
      html += '<th>Marca</th>';
      html += '<th>Modelo</th>';
      html += '<th>Descripción del Servicio</th>';
      html += '<th>Elegir</th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';
      html += '</tbody>';
      html += '</table>';
      $('#div_articulos').html(html);
  }
  
  function limpia_formulario_contactos(){
      $("#NombreContacto").text("");
      $("#EmpresaContacto").text("");
      $("#EmailContacto").text("");
      $("#TelefonoContacto").text("");
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
  function alerta_borrar(titulo, mensaje, icono){
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
  function alerta_success(titulo, texto){
    Swal.fire({
      icon: 'success',
      title: titulo,
      text: texto
      // footer: '<a href>Why do I have this issue?</a>'
    })
  }