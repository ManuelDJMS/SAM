var counter = 1;
var subtotal=0;
var articulos=[];
var cantidades=[];
var observacionearticulos=[];
var ids=[];
var series=[];
var observacionesservicios=[];
var precios=[];
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
    $('#Enter').keypress(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){
          var id = $(this).val();
          var repetido=false;
          if (articulos.length==0){
            articulos.push(id);
            cantidades.push(1);
            observacionearticulos.push("-");
            ids.push("-");
            series.push("-");
            observacionesservicios.push("-");
            obtener_articulosCot(id);
          }
          //  CICLO PARA VER SI HAY REPETIDOS
          for( var i=0; i<(articulos.length); i++ )
          {
          if (articulos[i].split('_')[0]==id)
          {
            repetido=true;
            break;
          }
          }
          //SI NO ESTA EN EL ARREGLO LO AGREGA
          if(repetido!=true)
          {
            articulos.push(id);
            cantidades.push(1);
            observacionearticulos.push("-");
            ids.push("-");
            series.push("-");
            observacionesservicios.push("-");
            obtener_articulosCot(id);
          }
      }
      event.stopPropagation();
    });
    $('html').on('click', '.btnArticulos', function(){
        var id = $(this).attr('id').split('_')[1];
        var idArreglo=String($(this).attr('id').split('_')[1])+"_01_1-_2-_3-_4-_50";
        var repetido=false;
        if (articulos.length==0){
          articulos.push(idArreglo);
          obtener_articulosCot(id);
        }
        //  CICLO PARA VER SI HAY REPETIDOS
        for( var i=0; i<(articulos.length); i++ )
        {
         if (articulos[i].split('_')[0]==id)
         {
           repetido=true;
           break;
         }
        }
        //SI NO ESTA EN EL ARREGLO LO AGREGA
        if(repetido!=true)
        {
          articulos.push(idArreglo);
          obtener_articulosCot(id);
        }
    });
    $('html').on('click', '#Prueba', function(){
      alert(String(articulos[0]));
      articulos[0].split('_')[6]="hola";
      alert(String(articulos[0]));

    });
    $('html').on('click', '.btnGuardar', function(){
      //OBTENER EL Subtotal
      for (var i=0; i< (articulos.length); i++)
      {
        subtotal=parseFloat(subtotal+$('#precio_'+articulos[i]).val());
      }
      var obj=new Object();
      var partidas="";
      // for (var i=0; i< (articulos.length); i++)
      // {
      //   if ((articulos.length) == 1){
      //     partidas="((Select MAX(NumCot) from Cotizaciones),"+articulos[i]+ ","+ String(counter) +","+$('#cantidad_'+articulos[i]).val()+",1,'"+$('#id_'+articulos[i]).val()+
      //     "','"+$('#serie_'+articulos[i]).val()+"','"+$('#observaciones_'+articulos[i]).val()+"','"+$('#observicio_'+articulos[i]).val()+"')";
      //   }
      //   else{
      //     if (i==(articulos.length-1))
      //     {
      //       partidas=partidas+"((Select MAX(NumCot) from Cotizaciones),"+articulos[i]+ ","+ String(counter) +","+$('#cantidad_'+articulos[i]).val()+",1,'"+$('#id_'+articulos[i]).val()+
      //       "','"+$('#serie_'+articulos[i]).val()+"','"+$('#observaciones_'+articulos[i]).val()+"','"+$('#observicio_'+articulos[i]).val()+"');";
  
      //     }
      //     else
      //     {
      //       partidas=partidas+"((Select MAX(NumCot) from Cotizaciones),"+articulos[i]+ ","+ String(counter) +","+$('#cantidad_'+articulos[i]).val()+",1,'"+$('#id_'+articulos[i]).val()+
      //       "','"+$('#serie_'+articulos[i]).val()+"','"+$('#observaciones_'+articulos[i]).val()+"','"+$('#observicio_'+articulos[i]).val()+"'),";
      //     }
      //   }
       
      // }
      //   obj.Partidas="INSERT INTO DetalleCotizaciones (NumCot,EquipId,PartidaNo,Cantidad,CantidadReal, identificadorInventarioCliente, Serie,Observaciones, ObservacionesServicios) VALUES "+partidas;
//////////////////////////////////////////////////////////////////
        // alert(obj.Partidas);
         //::::::::::::Detalle de la cotizacion :::::::::
        // devolver aqui
       
        // obj.Partida=counter;
        // obj.Cantidad=$('#cantidad_'+articulos[i]).val();
        // obj.Observaciones=$('#observaciones_'+articulos[i]).val();
        // obj.Id=$('#id_'+articulos[i]).val();
        // obj.Serie=$('#serie_'+articulos[i]).val();
        // obj.ObServicio=$('#observicio_'+articulos[i]).val();
        // obj.EquipId=articulos[i];
        // obj.accion = $(this).attr("id").split('_')[1];
        obj.idContacto=1;
        obj.idLugarServicio = $("#LugarServicio option:selected").val();
        obj.idModalidad = $("#Modalidad option:selected").val();
        obj.idTiempoEntrega = $("#TiempoEntrega option:selected").val();
        obj.idTerminosPago = $("#TerminosPago option:selected").val();
        obj.idPrecios = $("#Precios option:selected").val();
        obj.Referencia=$("#Referencia").val();
        obj.FechaDesde=$("#Vigencia").val().split('-')[0];
        obj.FechaHasta=$("#Vigencia").val().split('-')[1];
        obj.ObservacionesCot=$("#ObservacionesCot").val();
        obj.Subtotal=subtotal;
        var iva=parseFloat((subtotal*16)/100);
        obj.Iva=iva;
        var total=(iva+subtotal);
        obj.Total=total;
        obj.accion = $(this).attr("id").split('_')[1];
        guardar_detalle(obj, articulos, cantidades, observacionearticulos, ids, series, observacionesservicios, precios);
    });

    //=======================================================================================================
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
              $("#LugarServicio option[value='1']").attr("selected", true);
            // );  
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
              $("#TiempoEntrega option[value='2']").attr("selected", true); 
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
              $("#TerminosPago option[value='2']").attr("selected", true);
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
              $("#Modalidad option[value='1']").attr("selected", true);
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
                      $('<option></option>').val(data[i].idPrecios).html(data[i].Descripcion)
                  );                       
              }
              $("#Precios option[value='1']").attr("selected", true); 
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
                '<input type="text" class="cargar" id="cantidad_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=2 value="1" onblur="arregloCantidad('+data.EquipId+')">',
                '<input type="text" class="cargar" id="observaciones_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservaciones('+data.EquipId+')">',
                '<input type="text" class="cargar" id="id_'+ data.EquipId +'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloIds('+data.EquipId+')">',
                '<input type="text" class="cargar" id="serie_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloSerie('+data.EquipId+')">',
                '<input type="text" class="cargar" id="observicio_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservicio('+data.EquipId+')">',
                '<input type="text" class="cargar" id="precio_'+data.Price+'" style="border: 0; background-color:transparent;" size=7 value="'+data.Price+'" onblur="arregloPrecios('+data.EquipId+')">',
                '<button class="btnEliminar font-icon-wrapper pe-7s-trash" id="edit_'+data.EquipId+'"></button>'
            ] ).draw( true );
            subtotal=subtotal+data.Price;
            // var pos=articulos.indexOf(data.EquipId+"_01_1-_2-_3-_4-_50");
            // articulos[pos]=articulos[pos].substring(0,articulos[pos].indexOf("_5")+2)+data.Price;
            precios.push(data.Price);
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
  function guardar_detalle(obj, articulosg, cantidadesg, observacionesg, idsg, seriesg, observiciog, preciosg){
    var opc = "guardar_cot";
      $.post("dist/fw/cotizacion.php",{'opc':opc, 'obj':JSON.stringify(obj), 'articulos':articulosg, 'cantidades':cantidadesg,'observaciones':observacionesg, 'ids':idsg, 'series':seriesg, 'observicio':observiciog, 'precios':preciosg},function(data){
        if(data){
            alerta("¡Guardado!", "La empresa se guardó correctamente, ¿desea seguir en 'Empresas'", "success");
        }else{
            alerta_error("¡Error!","Error al guardar los datos o la empresa ya esta registrada");
        }
    },'json');
  }
  function arregloCantidad(id) {
    var pos=articulos.indexOf(String(id));
    cantidades[pos]=$('#cantidad_'+id).val();
    
  }
  function arregloObservaciones(id) {
    var pos=articulos.indexOf(String(id));
    observacionearticulos[pos]=$('#observaciones_'+id).val();
    
  }
  function arregloIds(id) {
    var pos=articulos.indexOf(String(id));
    ids[pos]=$('#id_'+id).val();
    
  }
  function arregloSerie(id) {
    var pos=articulos.indexOf(String(id));
    series[pos]=$('#serie_'+id).val();
    
  }
  function arregloObservicio(id) {
    var pos=articulos.indexOf(String(id));
    observacionesservicios[pos]=$('#observicio_'+id).val();
    
  }
  function arregloPrecios(id) {
    var pos=articulos.indexOf(String(id));
    precios[pos]=$('#precio_'+id).val();
    
  }