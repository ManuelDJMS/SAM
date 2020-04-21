var counter = 1;
var articulos=[];
$(document).ready(function(){
    obtener_contactos();


    //  ============================= OBTENER ARTICULOS =====================================================
    $('html').on('click', '#ObtenerArticulos', function(){
        obtener_articulos();
    });
    // ======================== EVENTO DE EDITAR EN LA TABLA DE CONTACTOS ===================================
    $('html').on('click', '.btnContacto', function(){
        var id = $(this).attr('id').split('_')[1];
        $('.btnCotizacion').attr('id',$(this).attr('id'));
        obtener_contacto(id);
    });
    // ====================== EVENTO PARA PASAR A SEGUNDA VENTANA CON CONTACTO ==============================
    $('html').on('click', '.btnCotizacion', function(){
      var cont=$('.Nombre').attr('id').split('_')[1]
      if ( cont === "No" ){
        alerta_error("Oops...","No ha seleccionado ningún cliente");
      }
      else{
        $("#tab-1").show();
        $("#tab-1").get(0).click();
        obtener_lugarServicio();
        obtener_tiempoEntrega();
        obtener_terminosPago();
        obtener_modalidad();
        obtener_precios();
        var id = $(this).attr('id').split('_')[1];
        obtener_contactoPlus(id);
      }
    });
    //=======================================================================================================
    // ======================== EVENTO PARA SELECCIONAR ARTICULOS ===========================================
    $('html').on('click', '.btnArticulos', function(){
        // ================ SE ASIGNA ID A EDITAR ===============================================
        var id = $(this).attr('id').split('_')[1];
        // alert(articulos.length);
        if (articulos.length==0){
          alert("entro");
          articulos.push(id);
        }
        // for( var i=0; i<(articulos.length); i++ )
        // {
        //   alert(id);
        //   alert(articulos[i]);
        //   if(articulos[i]!=id)
        //   {
        //     articulos.push(id);
        //     obtener_articulosCot(id);
        //     break;
        //   }
        // }
    });
    $('html').on('click', '.btnGuardar', function(){
      var obj = new Object();
      obj.accion = $(this).attr("id").split('_')[1];
      obj.ClaveEmpresa = $(this).attr("id").split('_')[2];
      // alert("hola");
      // alert(obj.accion);

        // ================ SE ASIGNA ID A EDITAR ===============================================
        guardar_detalle(obj);
    });
    //=======================================================================================================
    // var table = $('#hola').DataTable({
    //     columnDefs: [{
    //         orderable: false,
    //         targets: [1,2,3]
    //     }]
    // });
   
   
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
      var table = $('#articulosCot').DataTable();
      //======================= EVENTO PARA SELECCIONAR Y ELIMINAR UN ROW ===================================
      
      $('#articulosCot tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
          }
          else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
          }
      } );
      //=====================================================================================================
      //========================= ELIMINAR UN ROW DE LA TABLA DE COTIZACION =================================
      $('html').on('click', '.btnEliminar', function () {
          table.row('.selected').remove().draw( false );
      } );
      //=====================================================================================================
      //========================= ELIMINAR UN ROW DE LA TABLA DE COTIZACION =================================
      $('html').on('click', '.btnCancelar', function () {
        location.reload();
      } );
      //=====================================================================================================
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
  // ============================== METODO PÁRA OBTENER UN CONTACTO PARA EDITAR =============================
  function obtener_contacto(id){
    var opc = "obtener_contacto";
    $('.preloader').show();
    $.post("dist/fw/cotizacion.php",{'opc':opc, 'id':id},function(data){
        if(data){
          // limpia_formulario()
          $('.Nombre').text(data.Nombre + " " + data.Apellidos);
          $('.Nombre').attr('id', 'NombreContacto_' + data.Nombre);
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
  // ============================== METODO PÁRA OBTENER UN CONTACTO +++++++++++ =============================
  function obtener_contactoPlus(id){
    var opc = "obtener_contactoPlus";
    $('.preloader').show();
    $.post("dist/fw/cotizacion.php",{'opc':opc, 'id':id},function(data){
        if(data){
          $('#InformacionContacto').html("");
          var html = "";
          html += '<p class="text-muted" id="ContactoCot">';
          html += '<b class="text-dark">Contacto:</b>';
          html += data.Nombre + " " + data.Apellidos;
          html += '</p>';
          html += '<p class="text-muted" id="DomicilioCot">';
          html += '<b class="text-dark">Domicilio:</b>';
          html += data.Domicilio;
          html += '</p>';
          html += '<p class="text-muted" id="CPCot">';
          html += '<b class="text-dark">Código Postal:</b>';
          html += data.CP;
          html += '</p>';
          html += '<p class="text-muted" id="CiudadCot"><b class="text-dark">Ciudad:</b>';
          html += data.Ciudad;
          html += '</p>';
          html += '<p class="text-muted" id="TelefonoCot"><b class="text-dark">Teléfono:</b>';
          html += data.Tel;
          html += '</p>';
          html += '<p class="text-muted" id="EmailCot"><b class="text-dark">Email:</b>';
          html += data.Email;
          html += '</p>';
          $('#InformacionContacto').html(html);
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
      $.post("dist/fw/cotizacion.php",{opc:opc, 'id':id},function(data){
          if(data){
              var t = $('#articulosCot').DataTable();
              t.row.add( [
                // counter,
                data.ItemNumber,
                data.EquipmentName,
                data.Mfr,
                data.Model,
                '<input type="text" id="row-15-age" name="row-15-age" style="border: 0; background-color:transparent;" size=2>',
                '<input type="text" id="row-15-age" name="row-15-age" style="border: 0; background-color:transparent;" size=20>',
                '<input type="text" id="row-15-age" name="row-15-age" style="border: 0; background-color:transparent;" size=15>',
                '<input type="text" id="row-15-age" name="row-15-age" style="border: 0; background-color:transparent;" size=15>',
                '<input type="text" id="row-15-age" name="row-15-age" style="border: 0; background-color:transparent;" size=20>',
                '<button class="btnEliminar font-icon-wrapper pe-7s-trash" id="edit_'+data.EquipId+'"></button>'
            ] ).draw( true );
            counter++;
          }
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
      html += '<table style="width: 100%;" id="table_contactos" class="table table-hover table-bordered table-striped dataTable">';
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
  // ============================== CODIGO PARA REGENERAR LA TABLA DE ARTICULOS ==========================================================================
  function regenerar_tabla_articulos(){
      $('#div_articulos').html("");
      var html = "";
      html += '<table style="width: 100%;" id="table_articulos" class="table table-hover table-bordered table-striped dataTable">';
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


  function guardar_detalle(obj){
    var opc = "guardar_cot";
    
    for (var i = 0; i < 2; i++) {
      $.post("dist/fw/cotizacion.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
        if(data){
            alerta("¡Guardado!", "La empresa se guardó correctamente, ¿desea seguir en 'Empresas'", "success");
        }else{
            alerta_error("¡Error!","Error al guardar los datos o la empresa ya esta registrada");
        }
    },'json');
   }
    
  }