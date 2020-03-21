$(document).ready(function(){
    // limpia_formulario();
    obtener_registros();
    obtener_paqueterias();
    // ======================= EVENTO AL CHECK NACIONAL FISCAL================================================
    $('html').on('click','#check',function(){
      if($(this).val()== 1){
        $(this).val(0);
        $('#EstadoFiscalOM').show();
        $('#PaisFiscalOM').show();
        $('#EstadoSelectFiscal').hide();
        $('#EstadoFiscal').val("");
        $('#PaisFiscal').val("");
      }
      else{
        $(this).val(1);
        $('#EstadoFiscalOM').hide();
        $('#PaisFiscalOM').hide();
        $('#EstadoSelectFiscal').show();
        $('#PaisFiscal').val("México");
      }
    });
    // ========================================================================================================
    // ======================= EVENTO AL CHECK NACIONAL CONSIGNACION================================================
    $('html').on('click','#check2',function(){
      if($(this).val()== 1){
        $(this).val(0);
        $('#EstadoConsigOM').show();
        $('#PaisConsigOM').show();
        $('#EstadoSelectConsig').hide();
        $('#EstadoConsig').val("");
        $('#PaisConsig').val("");
      }
      else{
        $(this).val(1);
        $('#EstadoConsigOM').hide();
        $('#PaisConsigOM').hide();
        $('#EstadoSelectConsig').show();
        $('#PaisConsig').val("México");
      }
    });
    // ========================================================================================================
    // ======================= EVENTO AL CHECK NACIONAL ENVIO================================================
    $('html').on('click','#check3',function(){
      if($(this).val()== 1){
        $(this).val(0);
        $('#EstadoEnvioOM').show();
        $('#PaisEnvioOM').show();
        $('#EstadoEnvio').val("");
        $('#PaisEnvio').val("");
      }
      else{
        $(this).val(1);
        $('#EstadoEnvioOM').hide();
        $('#PaisEnvioOM').hide();
        $('#PaisEnvio').val("México");
      }
    });
    // ========================================================================================================
    // ======================= EVENTO AL CHECK Consignacion================================================
    $('html').on('click','#checkconsig',function(){
      
      if($(this).val() == "0"){
        if ($('#check').val() == "1"){
          
          $("#EstadoListConsig option[value='"+ $('#EstadoListFiscal').val() +"']").attr("selected", true);
        }
        else{
          $("#check2").get(0).click();
          $('#DireccionConsig').val($('#DireccionFiscal').val());
          $('#CPConsig').val($('#CPFiscal').val());
          $('#CiudadConsig').val($('#CiudadFiscal').val());
          $('#EstadoConsig').val($('#EstadoFiscal').val());
          $('#PaisConsig').val($('#PaisFiscal').val());
        }
        $(this).val(1);
      }
      else{
        if ($('#check').val() == "1"){
          
          $("#EstadoListConsig option[value='Aguascalientes']").attr("selected", true);
        }
        else{
        $("#check2").get(0).click();
        $(this).val(0);
        $('#DireccionConsig').val("");
        $('#CPConsig').val("");
        $('#CiudadConsig').val("");
        }
      }
    });
    // ========================================================================================================
    // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
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
        if ($('#Access').val()==''){
          obj.Access = 0;
        }
        else{
          obj.Access = $.trim($('#Access').val());
        }
        obj.accion = $(this).attr("id").split('_')[1];
        obj.ClaveEmpresa = $(this).attr("id").split('_')[2];
        // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
        if(obj.RazonSocial != ''){
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
        alert("entra")
        var id = $(this).attr('id').split('_')[1];
        $('.btnEditarG').attr('id',$(this).attr('id'));
        alert(id)
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
     //=======================================================================
  });
  // =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
  function guardar_equipamiento(obj){
    var opc = "guardar_empresa";
    $.post("dist/fw/equipamiento.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
        if(data){
            alerta("¡Guardado!", "La empresa de guardo correctamente, ¿desea seguir en 'Empresas'", "success");
            obtener_registros();
        }else{
            alerta_error("¡Error!","Error al guardar los datos o la empresa ya esta registrada");
        }
    },'json');
  }
  // ========================= METODO PÁRA OBTENER lAS PAQUETERIAS ======================
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
  // ===================================================================================
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
          $('#CuentaMensajeria').val(data.CuentaMensajeria);
          $('#Descuento').val(data.Descuento);
          $('#NoProveedor').val(data.NumProvMetas);
          $('#AdminPaq').val(data.AdminPaq);
          $('#Observaciones').val(data.ObservacionesEmpresa);
          $("#Credito option[value='"+ data.Credito +"']").attr("selected", true);
          $("#Paqueteria option[value='"+ data.idPaqueteria +"']").attr("selected", true);
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
                  html += '<td>' + $.trim(data[i].NumProvMetas) + '</td>';
                  html += '<td>' + $.trim(data[i].AdminPaq) + '</td>';
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
      html += '<th>N° Proveedor</th>';
      html += '<th>Clave de AdminPaq</th>';
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
      $("#Descuento").val("");
      $("#NoProveedor").val("");
      $("#CuentaMensajeria").val("");
      $("#AdminPaq").val("");
      $("#Paqueteria").val("");
      // $("#exampleCustomSelect").val("");
    $("#Observaciones").val("");
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
  