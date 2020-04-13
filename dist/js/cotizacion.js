$(document).ready(function(){
    obtener_contactos();
    // ======================= CAMBIO EN SELECT PARA TEXT ===================================================
    $('html').on('change', '#EstadoListFiscal', function(){
      $('#EstadoFiscal').val($(this).val());
    });
    $('html').on('change', '#EstadoListConsig', function(){
      $('#EstadoConsig').val($(this).val());
    });
    $('html').on('change', '#EstadoListEnvio', function(){
      $('#EstadoEnvio').val($(this).val());
    });
    $('html').on('change', '#EstadoListEditar', function(){
      $('#EstadoEditar').val($(this).val());
    });
    //  =====================================================================================================
    $('html').on('click', '#ObtenerArticulos', function(){
        obtener_articulos();
    });
    // ============================ EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================================
      $('html').on('click', '.btnGuardar', function(){
       //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
        var obj = new Object();
        obj.RazonSocial = $.trim($('#RazonSocial').val());
        obj.Tipo = $.trim($('#exampleCustomSelect').val());
        obj.RFC = $.trim($('#RFC').val());
        obj.Credito = $.trim($('#Credito').val());
        obj.Descuento = $.trim($('#Descuento').val());
        obj.NoProveedor = $.trim($('#NoProveedor').val());
        obj.AdminPaq = $.trim($('#AdminPaq').val());
        obj.Paqueteria = $("#Paqueteria option:selected").val();
        obj.CuentaMensajeria = $.trim($('#CuentaMensajeria').val());
        obj.Observaciones = $.trim($('#Observaciones').val());
        // Access en caso de realizar el codigo para recuperar empresas de access
        if ($('#Access').val()==''){
          obj.Access = 0;
        }
        else{
          obj.Access = $.trim($('#Access').val());
        }
        // ================== VALORES DE LAS DIRECCIONES ================================
        if ($('#DireccionFiscal').val()!="" && ($('#DireccionFiscal').val()!= $('#DireccionEnvio').val()) && ($('#DireccionFiscal').val()!= $('#DireccionConsig').val()))
        {
          obj.CompaniaFiscal = $.trim($('#CompaniaFiscal').val());
          obj.DireccionFiscal = $.trim($('#DireccionFiscal').val());
          obj.CPFiscal = $.trim($('#CPFiscal').val());
          obj.CiudadFiscal=$.trim($('#CiudadFiscal').val());
          // obj.EstadoListFiscal = $.trim($('#EstadoListFiscal').val());
          obj.ReferenciasFiscal = $.trim($('#ReferenciasFiscal').val());
          obj.EstadoFiscal = $.trim($('#EstadoFiscal').val());
          obj.PaisFiscal = $.trim($('#PaisFiscal').val());
          obj.Facturacion = 1;
          // alert(obj.EstadoFiscal);
        }
        if ($('#DireccionConsig').val()!="" && ($('#DireccionConsig').val()!= $('#DireccionFiscal').val()) && ($('#DireccionConsig').val()!= $('#DireccionEnvio').val()))
        {
          obj.CompaniaConsig = $.trim($('#CompaniaConsig').val());
          obj.DireccionConsig = $.trim($('#DireccionConsig').val());
          obj.CPConsig = $.trim($('#CPConsig').val());
          obj.CiudadConsig=$.trim($('#CiudadConsig').val());
          // obj.EstadoListConsig = $.trim($('#EstadoListConsig').val());
          obj.EstadoConsig = $.trim($('#EstadoConsig').val());
          obj.ReferenciasConsig = $.trim($('#ReferenciasConsig').val());
          obj.PaisConsig = $.trim($('#PaisConsig').val());
          obj.Consignacion = 1;
          // alert("solo la segunta");
        }
        if ($('#DireccionEnvio').val()!="" && ($('#DireccionEnvio').val()!= $('#DireccionFiscal').val()) && ($('#DireccionEnvio').val()!= $('#DireccionConsig').val()))
        {
          obj.CompaniaEnvio = $.trim($('#CompaniaEnvio').val());
          obj.DireccionEnvio = $.trim($('#DireccionEnvio').val());
          obj.CPEnvio = $.trim($('#CPEnvio').val());
          obj.CiudadEnvio=$.trim($('#CiudadEnvio').val());
          // obj.EstadoListEnvio = $.trim($('#EstadoListEnvio').val());
          obj.EstadoEnvio = $.trim($('#EstadoEnvio').val());
          obj.ReferenciasEnvio = $.trim($('#ReferenciasEnvio').val());
          obj.PaisEnvio = $.trim($('#PaisEnvio').val());
          obj.Envio = 1;
          // alert("solo la tercera");
        }
        // ==================================== SI SE REPITE LAS DIRECCIONES ======================================================
     
          if (($('#DireccionFiscal').val() == $('#DireccionConsig').val()))
          {
            if (($('#DireccionFiscal').val() != "") && ($('#DireccionConsig').val() != "")){
            obj.CompaniaCombi = $.trim($('#CompaniaFiscal').val());
            obj.DireccionCombi = $.trim($('#DireccionFiscal').val());
            obj.CPCombi = $.trim($('#CPFiscal').val());
            obj.CiudadCombi=$.trim($('#CiudadFiscal').val());
            obj.ReferenciasCombi = $.trim($('#ReferenciasFiscal').val());
            obj.EstadoCombi = $.trim($('#EstadoFiscal').val());
            obj.PaisCombi = $.trim($('#PaisFiscal').val());
            obj.Facturacion = 1;
            obj.Consignacion = 1;
            }
          }
          else if($('#DireccionFiscal').val() == $('#DireccionEnvio').val()){
            if (($('#DireccionFiscal').val() != "") && ($('#DireccionEnvio').val() != "")){
            obj.CompaniaCombi = $.trim($('#CompaniaFiscal').val());
            obj.DireccionCombi = $.trim($('#DireccionFiscal').val());
            obj.CPCombi = $.trim($('#CPFiscal').val());
            obj.CiudadCombi=$.trim($('#CiudadFiscal').val());
            obj.ReferenciasCombi = $.trim($('#ReferenciasFiscal').val());
            obj.EstadoCombi = $.trim($('#EstadoFiscal').val());
            obj.PaisCombi = $.trim($('#PaisFiscal').val());
            obj.Facturacion = 1;
            obj.Envio = 1;
            }
            else{
              obj.Envio = 0;
            obj.Facturacion= 0;
            }
          }
          else if ($('#DireccionConsig').val() == $('#DireccionEnvio').val()){
            if (($('#DireccionConsig').val() != "") && ($('#DireccionEnvio').val()!="")){
              obj.CompaniaCombi = $.trim($('#CompaniaConsig').val());
              obj.DireccionCombi = $.trim($('#DireccionConsig').val());
              obj.CPCombi = $.trim($('#CPConsig').val());
              obj.CiudadCombi=$.trim($('#CiudadConsig').val());
              obj.ReferenciasCombi = $.trim($('#ReferenciasConsig').val());
              obj.EstadoCombi = $.trim($('#EstadoConsig').val());
              obj.PaisCombi = $.trim($('#PaisConsig').val());
              obj.Envio = 1;
              obj.Consignacion = 1;
            }
            else{
              obj.Envio = 0;
            obj.Consignacion = 0;
            }
          
          }
        // ==================================== TERMINA EL CODIGO SI SE REPITE LAS DIRECCIONES ======================================================
        obj.accion = $(this).attr("id").split('_')[1];
        obj.ClaveEmpresa = $(this).attr("id").split('_')[2];
        // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
        if(obj.RazonSocial != ''){
          guardar_empresa(obj);
        }
        else{
          $(".btnValidar").get(0).click();
          alerta_error("Oops...","Faltan llenar algunos campos");
        }
      });
    // ======================================================================================================
    // ============================ EVENTO DE EL BOTON GUARDAR (MANDAR dir)==================================
      $('html').on('click', '.btnGuardarD', function(){
       //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO ==============
       var obj = new Object();
       obj.Compania=$.trim($('#CompaniaEditar').val());
       obj.Tipo=$.trim($('#ListEmpresas').val());
       obj.Direccion=$.trim($('#DireccionEditar').val());
       obj.CP=$.trim($('#CPEditar').val());
       obj.Ciudad=$.trim($('#CiudadEditar').val());
       obj.Referencias=$.trim($('#ReferenciasEditar').val());
       obj.Estado=$.trim($('#EstadoEditar').val());
       obj.Pais=$.trim($('#PaisEditar').val());
       obj.Facturacion=$.trim($('#checkFiscalEditar').val());
       obj.Consig=$.trim($('#checkConsigEditar').val());
       obj.Envio=$.trim($('#checkEnvioEditar').val());
       obj.ClaveEmpresa=$.trim($('#ClaveEmpresa').val());
       obj.accion = $(this).attr("id").split('_')[1];
       alert(obj.accion);
       obj.idDireccion = $(this).attr("id").split('_')[2];
       // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
       if(obj.Compania != '' && obj.Direccion != ''){
         guardar_direccion(obj);
       }
       else{
         alerta_error("Oops...","Faltan llenar algunos campos");
       }
      });
    // ======================================================================================================
    // ======================== EVENTO DE EDITAR EN LA TABLA DE EMPRESAS ====================================
    $('html').on('click', '.btnContacto', function(){
        //SE SIMULA EL CLICK DEL TAB 
        // $("#tab-0").get(0).click();
        //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
        // $('.btnEditarG').show();
        // $('.btnGuardar').hide();
        // $('#accordion').hide();
        // $('#EditarDirecciones').show();
        //=======================================================================================
        // ================ SE ASIGNA ID A EDITAR ===============================================
        var id = $(this).attr('id').split('_')[1];
        $('.btnCotizacion').attr('id',$(this).attr('id'));
        // obtener_registro(id);
        // obtener_direcciones(id);
        // limpia_formulario_contactos();
        obtener_contacto(id);
    });
    //=======================================================================================================
    // ======================== EVENTO PARA SELECCIONAR ARTICULOS ===========================================
    $('html').on('click', '.btnArticulos', function(){
        // //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
        // $('.btnGuardarGD').show();
        // $('.btnGuardarD').hide();
        //=======================================================================================
        // ================ SE ASIGNA ID A EDITAR ===============================================
        var id = $(this).attr('id').split('_')[1];
        mandar_articulo(id);
    });
    //=======================================================================================================
    //=============================== EVENTO DEL BOTON DE EDITAR Y GUARDAR ==================================
     $('html').on('click', '.btnEditarG', function(){
        //======= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO ========= 
        var obj = new Object();
        obj.RazonSocial = $.trim($('#RazonSocial').val());
        obj.Tipo = $.trim($('#exampleCustomSelect').val());
        obj.RFC = $.trim($('#RFC').val());
        obj.Credito = $.trim($('#Credito').val());
        obj.Descuento = $.trim($('#Descuento').val());
        obj.NoProveedor = $.trim($('#NoProveedor').val());
        obj.AdminPaq = $.trim($('#AdminPaq').val());
        obj.Paqueteria = $("#Paqueteria option:selected").val();
        obj.CuentaMensajeria = $.trim($('#CuentaMensajeria').val());
        obj.Observaciones = $.trim($('#Observaciones').val());
        if ($('#Access').val()==''){
          obj.Access = 0;
        }
        else{
          obj.Access = $.trim($('#Access').val());
        }
        obj.accion = $(this).attr("id").split('_')[0];
        obj.ClaveEmpresa = $(this).attr("id").split('_')[1];
        // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
        if(obj.RazonSocial != ''){
          guardar_empresa(obj);
        }
        else{
          alerta_error("Oops...","Faltan llenar algunos campos");
        }
     });
    //=======================================================================================================
    //========================== EVENTO DEL BOTON DE EDITAR Y GUARDAR DIRECCION =============================
    $('html').on('click', '.btnGuardarGD', function(){
      var obj=new Object();
      obj.Compania=$.trim($('#CompaniaEditar').val());
      obj.Tipo=$.trim($('#ListEmpresas').val());
      obj.Direccion=$.trim($('#DireccionEditar').val());
      obj.CP=$.trim($('#CPEditar').val());
      obj.Ciudad=$.trim($('#CiudadEditar').val());
      obj.Referencias=$.trim($('#ReferenciasEditar').val());
      obj.Estado=$.trim($('#EstadoEditar').val());
      obj.Pais=$.trim($('#PaisEditar').val());
      obj.Facturacion=$.trim($('#checkFiscalEditar').val());
      obj.Consig=$.trim($('#checkConsigEditar').val());
      obj.Envio=$.trim($('#checkEnvioEditar').val());
      obj.accion = $(this).attr("id").split('_')[0];
        obj.idDireccion = $(this).attr("id").split('_')[1];
        // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
        if(obj.Direccion != '' || obj.Compania !=''){
          guardar_direccion(obj);
        }
        else{
          alerta_error("Oops...","Faltan llenar algunos campos");
        }
    });
    //=======================================================================================================
  });
  // =========================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ==================================
  function guardar_empresa(obj){
    var opc = "guardar_empresa";
    $.post("dist/fw/empresas.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
        if(data){
            alerta("¡Guardado!", "La empresa se guardó correctamente, ¿desea seguir en 'Empresas'", "success");
            obtener_registros();
        }else{
            alerta_error("¡Error!","Error al guardar los datos o la empresa ya esta registrada");
        }
    },'json');
  }
  //=========================================================================================================
  // =========================== METODO PARA EDITAR Y GUARDAR LAS DIRECCIONES ==================================
  function guardar_direccion(obj){
    var opc = "guardar_direccion";
    $.post("dist/fw/empresas.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
        if(data){
            limpia_direcciones();
            alerta_success("¡Guardado!", "La dirección se guardó correctamente");
            obtener_direcciones($('#ClaveEmpresa').val());
        }else{
            alerta_error("¡Error!","Error al guardar los datos o la dirección ya esta registrada");
        }
    },'json');
  }
  //=========================================================================================================
  // ============================== METODO PÁRA OBTENER lAS PAQUETERIAS =====================================
  function obtener_paqueterias(){
      var opc = 'obtener_paqueterias';
      $.post("dist/fw/empresas.php",{opc:opc}, function(data){
          if(data){
              var mySelect = $('#Paqueteria');
              mySelect.append(
                  $('<option></option>').val("0").html("")
              );  
              for (var i = 0; i < data.length; i++){
                  mySelect.append(
                      $('<option></option>').val(data[i].idPaqueteria).html(data[i].Descripcion)
                  );                       
              }
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
  // ========================== METODO PÁRA OBTENER UNA DIRECCIONES PARA EDITAR =============================
  function obtener_direccion(id){
    var opc = "obtener_direccion";
    $.post("dist/fw/empresas.php",{'opc':opc, 'id':id},function(data){
        if(data){
          limpia_direcciones();
          $('#CompaniaEditar').val(data.Compania.split(',')[0]);
           if(data.Compania.split(',').length > 1 ){
            $('#ListEmpresas').val((data.Compania.split(',')[1]).trim());
          }
          $('#DireccionEditar').val(data.Domicilio);
          $('#CPEditar').val(data.CP);
          $('#CiudadEditar').val(data.Ciudad);
          if(data.Pais === 'México'){
            $('#EstadosEditar').hide();
            $('#EstadoSelectEditar').show();
            $("#EstadoListEditar").val(data.Estado);
          }
          else{
            $('#EstadosEditar').show();
            $('#EstadoSelectEditar').hide();
            $('#EstadoEditar').val(data.Estado);
            $('#PaisEditar').val(data.Pais);
          }
          $('#ReferenciasEditar').val(data.Referencias);
          if(data.Facturacion==1){
            $('#checkFiscalEditar').val(1);
            $("#checkFiscalEditar").attr('checked',true);
          }
          if(data.Consignacion==1){
            $('#checkConsigEditar').val(1);
            $("#checkConsigEditar").attr('checked',true);
          }
          if(data.Envio==1){
            $('#checkEnvioEditar').val(1);
            $("#checkEnvioEditar").attr('checked',true);
          }
        }
        else
        {
          alerta_error("Error", "Error al recibir los datos");
        }
        $('.line-scale-pulse-out').hide();
    },'json');
  }
  // ================================== CODIGO PARA OBTENER LOS CONTACTOS A COTIZAR ======================================================================
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
  // ==================== CODIGO PARA OBTENER LAS DIRECCIONES DE LA EMPRESA SELECCIONADA=====================
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
  
  function limpia_direcciones(){
    $("#CompaniaEditar").val("");
    $("#DireccionEditar").val("");
    $("#CPEditar").val("");
    $("#CiudadEditar").val("");
    $("#ReferenciasEditar").val("");
    $("#PaisEditar").val("México");
    $("#EstadoEditar").val("Aguascalientes");
    $("#EstadoListEditar").val("");
    $("#ListEmpresas").val("");
    $('#checkFiscalEditar').val(0);
    $("#checkFiscalEditar").removeAttr('checked');
    $('#checkConsigEditar').val(0);
    $("#checkConsigEditar").removeAttr('checked');
    $('#checkEnvioEditar').val(0);
    $("#checkEnvioEditar").removeAttr('checked');
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
    function alerta_success(titulo, texto){
      Swal.fire({
        icon: 'success',
        title: titulo,
        text: texto
        // footer: '<a href>Why do I have this issue?</a>'
      })
    }
  