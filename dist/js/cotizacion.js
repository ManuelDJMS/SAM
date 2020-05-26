var counter = 1;
var subtotal=0;
var articulos=[];
var cantidades=[];
var observacionearticulos=[];
var ids=[];
var series=[];
var observacionesservicios=[];
var precios=[];
var origenes=[];
//[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[ CODIGO QUE FUNCIONA AL CARGAR EL DOCUMENTO ]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
$(document).ready(function(){
    obtener_contactos();
    // ======================================================================================================
    //  ============================= OBTENER ARTICULOS =====================================================
    $('html').on('click', '#ObtenerArticulos', function(){
      if( $('#Origen_Catalogos').prop('checked') ) {
        obtener_articulos();
      }
      else{
        obtener_articulosLocales();
      }
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
    // ===================== EVENTO PARA SELECCIONAR ARTICULOS (POR ENTER) ==================================
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
            origenes.push("LIMS");
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
            origenes.push("LIMS");
            obtener_articulosCot(id);
          }
      }
      event.stopPropagation();
    });
    //=======================================================================================================
    // ===================== EVENTO PARA SELECCIONAR ARTICULOS (POR SELECT) =================================
    $('html').on('click', '.btnArticulos', function(){
        var id = $(this).attr('id');
        alert(id);
        var repetido=false;
        if (articulos.length==0){
          articulos.push(id);
          cantidades.push(1);
          observacionearticulos.push("-");
          ids.push("-");
          series.push("-");
          observacionesservicios.push("-");
          origenes.push(id.split('_')[0]);
          if (id.split('_')[0]=="LIMS"){
            obtener_articulosCot(id.split('_')[1]);
          }
          else{
            obtener_articulosCotLocales(id.split('_')[1]);
          }
        }
        //  CICLO PARA VER SI HAY REPETIDOS
        for( var i=0; i<(articulos.length); i++ )
        {
        if (articulos[i]==id)
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
          origenes.push(id.split('_')[0]);
          if (id.split('_')[0]=="LIMS"){
            obtener_articulosCot(id.split('_')[1]);
          }
          else{
            obtener_articulosCotLocales(id.split('_')[1]);
          }
        }
    });
    //=======================================================================================================
    $('html').on('click', '.btnHCot', function(){
      var obj=new Object();
      obj.ItemNumber=("A-"+$(this).attr('id').split('_')[2].substring(0,3)+"-Q"+$(this).attr('id').split('_')[3]).toUpperCase();
      obj.NumCot=$(this).attr('id').split('_')[0];
      obj.Partida=$(this).attr('id').split('_')[1];
      obj.Fecha=$(this).attr('id').split('_')[4];
      guardar_articulosAccess(obj);
      obtener_articulosCotAccess(obj.ItemNumber);
    });
    //=======================================================================================================
    $('html').on('click', '#Prueba', function(){
      alert(String(articulos[0]));
      alert(articulos.length);
    });
    // ======================= EVENTO PARA MANDAR EL POST Y GUARDAR LA COT ==================================
    $('html').on('click', '.btnGuardar', function(){
      //OBTENER EL Subtotal
      for (var i=0; i< (articulos.length); i++)
      {
        subtotal=parseFloat(subtotal+$('#precio_'+articulos[i]).val());
      }
        var obj=new Object();
        obj.idContacto= $('.btnCotizacion').attr('id').split('_')[1];
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
        //ACOMODAR EL ARREGLO DE ARTICULOS
        for(var i=0; i<articulos.length; i++)
        {
          articulos[i]=articulos[i].split('_')[1];
        }
        if (articulos.length==0){
          alerta_error("Error", "No hay ninguna partida en esta cotización")
        }
        else{
          alert(cantidades[0]);
          guardar_detalle(obj, articulos, cantidades, observacionearticulos, ids, series, observacionesservicios, precios, origenes);
        }
    });
    //=======================================================================================================
    //=======================================================================================================
    // var table = $('#articulosCot').DataTable();
    var table = $('#articulosCot').DataTable({
      "ordering": false,
      "scrollX":true,
  });
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
        eliminarItem($(this).attr("id"));
    } );
    //=====================================================================================================
    //========================= CANCELAR LA COTIZACION =================================
    $('html').on('click', '.btnCancelar', function () {
      location.reload();
    } );
    //=====================================================================================================
    //========================= CANCELAR LA COTIZACION =================================
    $('html').on('click', '#CargarCot', function () {
      var de=$("#De").val();
      // alert(de);
     
      var a=$("#A").val();
      // alert(a);
      if (de > a ){
        alerta_error("Error de fechas", "Selecciona de menor a mayor los años");
      }
      else{
        obtener_historialcots(de, a);
      }
      // obtener_historialcots();
    } );
    //=====================================================================================================
    //========================= CANCELAR LA COTIZACION =================================
    $('html').on('click', '#CotSAM', function () {
      $("#tab-3").show();
      $("#tab-3").get(0).click();
      var id = $('.btnCotizacion').attr('id').split('_')[1];
      obtener_articulosCotSAM();
    } );
    //=====================================================================================================
  });
  //[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[ METODOS PARA OBTENER DATOS PARA LOS FORMULARIOS ]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
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
                  "autoWidth": true,
                  "scrollX": true
              });
          }
          $('.preloader').hide();
      },'json');
  }
  // =============================== CODIGO PARA OBTENER EL HISTORIAL DE COTIZACIONES ============================
  function obtener_historialcots(de, a){
      var opc = "obtener_historialcots";
      $('.preloader').show();
      regenerar_historialcots();
      $.post("dist/fw/cotizacion.php",{'opc':opc, 'de':de, 'a':a},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                  html += '<tr>';
                  html += '<td>' + $.trim(data[i].NumCot) + '</td>';
                  html += '<td>' + $.trim(data[i].Cvempresa) + '</td>';
                  html += '<td>' + $.trim(data[i].Cliente) + '</td>';
                  html += '<td>' + $.trim(data[i].Fecha) + '</td>';
                  html += '<td>' + $.trim(data[i].ServCatalogo) + '</td>';
                  html += '<td>' + $.trim(data[i].PartidaNo) + '</td>';
                  html += '<td>' + $.trim(data[i].Tipo) + '</td>';
                  html += '<td>' + $.trim(data[i].Marca) + '</td>';
                  html += '<td>' + $.trim(data[i].Modelo) + '</td>';
                  html += '<td>' + $.trim(data[i].Alacance) + '</td>';
                  html += '<td>' + $.trim(data[i].ID) + '</td>';
                  html += '<td>' + $.trim(data[i].Cant) + '</td>';
                  html += '<td>' + $.trim(data[i].Precio) + '</td>';
                  html += '<td class="btnHCot" id="'+data[i].NumCot+'_'+data[i].PartidaNo+'_'+data[i].Marca+'_'+data[i].Modelo+'_'+data[i].Fecha.substring(0,4)+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
                  html += '</tr>';                        
              }
              $('#table_historialcots tbody').html(html);
              $('#table_historialcots').DataTable({
                  "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "autoWidth": true,
                  "scrollX": true
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
                data.ItemNumber,
                data.EquipmentName,
                data.Mfr,
                data.Model,
                '<input type="text" id="cantidad_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=2 value="1" onblur="arregloCantidad('+data.EquipId+')">',
                '<input type="text" id="observaciones_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservaciones('+data.EquipId+')">',
                '<input type="text" id="id_'+ data.EquipId +'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloIds('+data.EquipId+')">',
                '<input type="text" id="serie_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloSerie('+data.EquipId+')">',
                '<input type="text" id="observicio_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservicio('+data.EquipId+')">',
                '<input type="text" id="precio_'+data.EquipId+'" style="border: 0; background-color:transparent;" size=7 value="'+data.Price+'" onblur="arregloPrecios('+data.EquipId+')">',
                '<button class="btnEliminar font-icon-wrapper pe-7s-trash" id="LIMS_'+data.EquipId+'"></button>'
            ] ).draw( true );
            subtotal=subtotal+data.Price;
            precios.push(data.Price);
          }
      },'json');
  }
  // ================================== CODIGO PARA MANDAR LOS ARTICULOS A COTIZAR LOCALES ==========================
  function obtener_articulosCotLocales(id){
      var opc = "obtener_articulosCotLocales";
      $.post("dist/fw/cotizacion.php",{opc:opc, 'id':id},function(data){
          if(data){
              var t = $('#articulosCot').DataTable();
              t.row.add( [
                data.ItemNumber,
                data.NombreEquipo,
                data.Marca,
                data.Modelo,
                '<input type="text" id="cantidadA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=2 value="1" onblur="arregloCantidadA('+data.idEquipo+')">',
                '<input type="text" id="observacionesA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservacionesA('+data.idEquipo+')">',
                '<input type="text" id="idA_'+ data.idEquipo +'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloIdsA('+data.idEquipo+')">',
                '<input type="text" id="serieA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloSerieA('+data.idEquipo+')">',
                '<input type="text" id="observicioA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservicioA('+data.idEquipo+')">',
                '<input type="text" id="precioA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=7 value="'+data.Precio+'" onblur="arregloPreciosA('+data.idEquipo+')">',
                '<button class="btnEliminar font-icon-wrapper pe-7s-trash" id="ACCESS_'+data.idEquipo+'"></button>'
            ] ).draw( true );
            subtotal=subtotal+data.Precio;
            precios.push(data.Precio);
          }
      },'json');
  }
  // ================================== CODIGO PARA MANDAR LOS ARTICULOS A COTIZAR ACCEESS ==========================
  function obtener_articulosCotAccess(id){
      var opc = "obtener_articulosCotAccess";
      $.post("dist/fw/cotizacion.php",{opc:opc, 'id':id},function(data){
          if(data){
            var id= data.idEquipo;
            var repetido=false;
            if (articulos.length==0){
              articulos.push("ACCESS_"+id);
              cantidades.push(1);
              observacionearticulos.push("-");
              ids.push("-");
              series.push("-");
              observacionesservicios.push("-");
              origenes.push("ACCESS");
              var t = $('#articulosCot').DataTable();
              t.row.add( [
                data.ItemNumber,
                data.NombreEquipo,
                data.Marca,
                data.Modelo,
                '<input type="text" id="cantidadA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=2 value="1" onblur="arregloCantidadA('+data.idEquipo+')">',
                '<input type="text" id="observacionesA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservacionesA('+data.idEquipo+')">',
                '<input type="text" id="idA_'+ data.idEquipo +'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloIdsA('+data.idEquipo+')">',
                '<input type="text" id="serieA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloSerieA('+data.idEquipo+')">',
                '<input type="text" id="observicioA_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservicioA('+data.idEquipo+')">',
                '<input type="text" id="precioA_'+data.Precio+'" style="border: 0; background-color:transparent;" size=7 value="'+data.Precio+'" onblur="arregloPreciosA('+data.idEquipo+')">',
                '<button class="btnEliminar font-icon-wrapper pe-7s-trash" id="ACCESS_'+data.idEquipo+'"></button>'
            ] ).draw( true );
            subtotal=subtotal+data.Precio;
            precios.push(data.Precio);
            }
            //  CICLO PARA VER SI HAY REPETIDOS
            for( var i=0; i<(articulos.length); i++ )
            {
            if (articulos[i]==("ACCESS_"+id))
            {
              repetido=true;
              break;
            }
            }
            //SI NO ESTA EN EL ARREGLO LO AGREGA
            if(repetido!=true)
            {
              articulos.push("ACCESS_"+id);
              cantidades.push(1);
              observacionearticulos.push("-");
              ids.push("-");
              series.push("-");
              observacionesservicios.push("-");
              origenes.push("ACCESS");
              var t = $('#articulosCot').DataTable();
              t.row.add( [
                data.ItemNumber,
                data.NombreEquipo,
                data.Marca,
                data.Modelo,
                '<input type="text" id="cantidad_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=2 value="1" onblur="arregloCantidadA('+data.idEquipo+')">',
                '<input type="text" id="observaciones_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservacionesA('+data.idEquipo+')">',
                '<input type="text" id="id_'+ data.idEquipo +'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloIdsA('+data.idEquipo+')">',
                '<input type="text" id="serie_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=15 value="-" onblur="arregloSerieA('+data.idEquipo+')">',
                '<input type="text" id="observicio_'+data.idEquipo+'" style="border: 0; background-color:transparent;" size=20 value="-" onblur="arregloObservicioA('+data.idEquipo+')">',
                '<input type="text" id="precio_'+data.Precio+'" style="border: 0; background-color:transparent;" size=7 value="'+data.Precio+'" onblur="arregloPreciosA('+data.idEquipo+')">',
                '<button class="btnEliminar font-icon-wrapper pe-7s-trash" id="ACCESS_'+data.idEquipo+'"></button>'
            ] ).draw( true );
            subtotal=subtotal+data.Precio;
            precios.push(data.Precio);
            }
            // 
             
          }
          else
          {
            alert("FALLO");
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
                  html += '<td class="btnArticulos" id="LIMS_'+data[i].EquipId+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
                  html += '</tr>';                        
              }
              $('#table_articulos tbody').html(html);
              $('#table_articulos').DataTable({
                  "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "autoWidth": true,
                  "scrollX": true
              });
          }
          $('.preloader').hide();
      },'json');
  }
  // ============================= CODIGO PARA OBTENER LOS ARTICULOS DE SAM A COTIZAR================================
  function obtener_articulosLocales(){
      var opc = "obtener_articulosLocales";
      $('.preloader').show();
      regenerar_tabla_articulos();
      $.post("dist/fw/cotizacion.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                  html += '<tr>';
                  html += '<td>' + $.trim(data[i].ItemNumber) + '</td>';
                  html += '<td>' + $.trim(data[i].NombreEquipo) + '</td>';
                  html += '<td>' + $.trim(data[i].Marca) + '</td>';
                  html += '<td>' + $.trim(data[i].Modelo) + '</td>';
                  html += '<td>' + $.trim(data[i].Metodo) + '</td>';
                  html += '<td class="btnArticulos" id="ACCESS_'+data[i].idEquipo+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
                  html += '</tr>';                        
              }
              $('#table_articulos tbody').html(html);
              $('#table_articulos').DataTable({
                  "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": false,
                  "info": true,
                  "autoWidth": true,
                  "scrollX": true
              });
          }
          $('.preloader').hide();
      },'json');
  }
  // ============================= CODIGO PARA OBTENER LAS COTIZACIONES DE SAM ================================
  function obtener_articulosCotSAM(){
      var opc = "obtener_articulosCotSAM";
      $('.preloader').show();
      regenerar_historialSAM();
      $.post("dist/fw/cotizacion.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                  html += '<tr>';
                  html += '<td>' + $.trim(data[i].NumCot) + '</td>';
                  html += '<td>' + $.trim(data[i].PartidaNo) + '</td>';
                  html += '<td>' + $.trim(data[i].ItemNumber) + '</td>';
                  html += '<td>' + $.trim(data[i].Equipo) + '</td>';
                  html += '<td>' + $.trim(data[i].Marca) + '</td>';
                  html += '<td>' + $.trim(data[i].Modelo) + '</td>';
                  html += '<td>' + $.trim(data[i].ID) + '</td>';
                  html += '<td>' + $.trim(data[i].Serie) + '</td>';
                  html += '<td>' + $.trim(data[i].MetododeCalibracion) + '</td>';
                  html += '<td>' + $.trim(data[i].Observaciones) + '</td>';
                  html += '<td>' + $.trim(data[i].ObservacionesServicios) + '</td>';
                  html += '<td>' + $.trim(data[i].Cantidad) + '</td>';
                  html += '<td>' + $.trim(data[i].PrecioUnitario) + '</td>';
                  html += '<td class="btnArticulos" id="ACCESS_'+data[i].NumCot+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
                  html += '</tr>';                        
              }
              $('#table_SAM tbody').html(html);
              $('#table_SAM').DataTable({
                  "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "autoWidth": true,
                  "scrollX": true,
                  "responsive": true
              });
          }
          $('.preloader').hide();
      },'json');
  }
  //[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[ CODIGOS PARA REGENERAR TABLAS O FORMULARIOS ]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
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
  // ============================== CODIGO PARA REGENERAR LA TABLA DE  HISTORIAL DE COTIZACIONES ==========================================================================
  function regenerar_historialcots(){
      $('#div_historialcots').html("");
      var html = "";
      html += '<table id="table_historialcots" class="table table-hover table-bordered table-striped dataTable" style="width:100%">';
      html += '<thead>';
      html += '<tr>';
      html += '<th>NumCot</th>';
      html += '<th>Clave Empresa</th>';
      html += '<th>Cliente</th>';
      html += '<th>Fecha</th>';
      html += '<th>Ser-Catálogo</th>';
      html += '<th>Partida</th>';
      html += '<th>Tipo</th>';
      html += '<th>Marca</th>';
      html += '<th>Modelo</th>';
      html += '<th>Alcance</th>';
      html += '<th>Id</th>';
      html += '<th>Cantidad</th>';
      html += '<th>Precio Unitario</th>';
      html += '<th></th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';
      html += '</tbody>';
      html += '</table>';
      $('#div_historialcots').html(html);
  }
  // ============================== CODIGO PARA REGENERAR LA TABLA DE  HISTORIAL DE  HISTORIAL COTIZACIONES SAM==========================================================================
  function regenerar_historialSAM(){
      $('#div_historialSAM').html("");
      var html = "";
      html += '<table id="table_SAM" class="table table-hover table-bordered table-striped display nowrap">';
      html += '<thead>';
      html += '<tr>';
      html += '<th>NumCot</th>';
      html += '<th>Partida</th>';
      html += '<th>ItemNumber</th>';
      html += '<th>Equipo</th>';
      html += '<th>Marca</th>';
      html += '<th>Modelo</th>';
      html += '<th>ID</th>';
      html += '<th>Serie</th>';
      html += '<th>Descripcion del Servicio</th>';
      html += '<th>Observaciones</th>';
      html += '<th>Observacion del Servicio</th>';
      html += '<th>Cantidad</th>';
      html += '<th>Precio Unitario</th>';
      html += '<th></th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';
      html += '</tbody>';
      html += '</table>';
      $('#div_historialSAM').html(html);
  }
  
  function limpia_formulario_contactos(){
      $("#NombreContacto").text("");
      $("#EmpresaContacto").text("");
      $("#EmailContacto").text("");
      $("#TelefonoContacto").text("");
  }
  //[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[ EVENTOS PARA CREAR ALERTAS EN EL SISTEMA ]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
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
  //[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[ CODIGO PARA GUARDAR COTS, PARTIDAS, ETC..... ]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
  // ============================== CODIGO PARA GUARDAR LA COTIZACION Y SUS PARTIDAS ==========================================================================
  function guardar_detalle(obj, articulosg, cantidadesg, observacionesg, idsg, seriesg, observiciog, preciosg, origeng){
    var opc = "guardar_cot";
      $.post("dist/fw/cotizacion.php",{'opc':opc, 'obj':JSON.stringify(obj), 'articulos':articulosg, 'cantidades':cantidadesg,'observaciones':observacionesg, 'ids':idsg, 'series':seriesg, 'observicio':observiciog, 'precios':preciosg, 'origen':origeng},function(data){
        if(data){
            alerta("¡Guardado!", "La empresa se guardó correctamente, ¿desea seguir en 'Empresas'", "success");
        }else{
            alerta_error("¡Error!","Error al guardar los datos o la empresa ya esta registrada");
        }
    },'json');
  }
  // ============================== CODIGO PARA GUARDAR ARTICULOS DE ACCESS A SAM ==========================================================================
  function guardar_articulosAccess(obj){
    var opc = "guardar_articulosAccess";
    $.post("dist/fw/cotizacion.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
      if(data){
        // alert()
          // alerta("¡Guardado!", "La empresa se guardó correctamente, ¿desea seguir en 'Empresas'", "success");
      }else{
          // alerta_error("¡Error!","Error al guardar los datos o la empresa ya esta registrada");
      }
  },'json');
  }
  //[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[ GENERAR LOS ARREGLOS PARA LAS PARTIDAS ]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
  function arregloCantidad(id) {
    var idBuscar="LIMS_"+id;
    var pos=articulos.indexOf(idBuscar);
    cantidades[pos]=$('#cantidad_'+id).val();
  }
  function arregloObservaciones(id) {
    var idBuscar="LIMS_"+id;
    var pos=articulos.indexOf(idBuscar);
    observacionearticulos[pos]=$('#observaciones_'+id).val();
    
  }
  function arregloIds(id) {
    var idBuscar="LIMS_"+id;
    var pos=articulos.indexOf(idBuscar);
    ids[pos]=$('#id_'+id).val();
    
  }
  function arregloSerie(id) {
    var idBuscar="LIMS_"+id;
    var pos=articulos.indexOf(idBuscar);
    series[pos]=$('#serie_'+id).val();
  }
  function arregloObservicio(id) {
    var idBuscar="LIMS_"+id;
    var pos=articulos.indexOf(idBuscar);
    observacionesservicios[pos]=$('#observicio_'+id).val();
  }
  function arregloPrecios(id) {
    var idBuscar="LIMS_"+id;
    var pos=articulos.indexOf(idBuscar);
    precios[pos]=$('#precio_'+id).val();
    
  }
  //METODOS PARA LOS CAMPOS DE ACCCESS
  function arregloCantidadA(id) {
    var idBuscar="ACCESS_"+id;
    var pos=articulos.indexOf(idBuscar);
    cantidades[pos]=$('#cantidadA_'+id).val();
  }
  function arregloObservacionesA(id) {
    var idBuscar="ACCESS_"+id;
    var pos=articulos.indexOf(idBuscar);
    observacionearticulos[pos]=$('#observacionesA_'+id).val();
    
  }
  function arregloIdsA(id) {
    var idBuscar="ACCESS_"+id;
    var pos=articulos.indexOf(idBuscar);
    ids[pos]=$('#idA_'+id).val();
    
  }
  function arregloSerieA(id) {
    var idBuscar="ACCESS_"+id;
    var pos=articulos.indexOf(idBuscar);
    series[pos]=$('#serieA_'+id).val();
  }
  function arregloObservicioA(id) {
    var idBuscar="ACCESS_"+id;
    var pos=articulos.indexOf(idBuscar);
    observacionesservicios[pos]=$('#observicioA_'+id).val();
  }
  function arregloPreciosA(id) {
    var idBuscar="ACCESS_"+id;
    var pos=articulos.indexOf(idBuscar);
    precios[pos]=$('#precioA_'+id).val();
    
  }
  //=================================== CODIGO PARA ELIMINAR ITEM DE LOS ARREGLOS ==========================================
  function eliminarItem (item) {
    var i=articulos.indexOf( item );
    alert(i);
    if ( i !== -1 ) {
        articulos.splice( i, 1 );
        cantidades.splice( i, 1 );
        observacionearticulos.splice( i, 1 );
        ids.splice( i, 1 );
        series.splice( i, 1 );
        observacionesservicios.splice( i, 1 );
        precios.splice( i, 1 );
        origenes .splice( i, 1 );
    }
  }