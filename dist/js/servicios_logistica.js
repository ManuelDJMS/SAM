$(document).ready(function(){
    $('.btnEditarG').hide();
    limpia_formulario();
    obtener_registros();
    // =======================================================================
    // ============= EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================
      $('html').on('click', '.btnGuardar', function(){
       //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
        var obj = new Object();
        obj.NoCatalogo = $.trim($('#NoCatalogo').val());
        obj.Descripcion = $.trim($('#Descripcion').val());
        obj.Referencia = $.trim($('#Referencia').val());
        obj.Observaciones = $.trim($('#Observaciones').val());
        obj.Unidad = $.trim($('#Unidad').val());
        obj.Precio = $.trim($('#Precio').val());
        obj.accion = $(this).attr("id").split('_')[1];
        obj.idCatLog = $(this).attr("id").split('_')[2];
        // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
        if(obj.NoCatalogo != ''  || obj.Descripcion != ''){
          guardar_servicioLog(obj);
        }
        else{
          alerta_error("Oops...","Faltan llenar algunos campos1");
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
      obj.NoCatalogo = $.trim($('#NoCatalogo').val());
      obj.Descripcion = $.trim($('#Descripcion').val());
      obj.Referencia = $.trim($('#Referencia').val());
      obj.Observaciones = $.trim($('#Observaciones').val());
      obj.Unidad = $.trim($('#Unidad').val());
      obj.Precio = $.trim($('#Precio').val());
      obj.accion = $(this).attr("id").split('_')[0];
      obj.idCatLog = $(this).attr("id").split('_')[1];
      // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
      if(obj.NoCatalogo != '' || obj.Descripcion != ''){
        guardar_servicioLog(obj);
      }
      else{
        alerta_error("Oops...","Error al intentar guardar los datos");
      }
    });
     //=======================================================================
  });
  // =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
  function guardar_servicioLog(obj){
    var opc = "guardar_servicioLog";
    $.post("dist/fw/servicios_logistica.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
        if(data){
            alerta("¡Guardado!", "El servicio de logística se guardo correctamente, ¿desea seguir en 'Servicios de Logística'", "success");
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
    $.post("dist/fw/servicios_logistica.php",{'opc':opc, 'id':id},function(data){
        if(data){
          limpia_formulario()
          $('#NoCatalogo').val(data.NoCatalogo);
          $('#Descripcion').val(data.DescripcionServicio);
          $('#Referencia').val(data.Referencia);
          $('#Unidad').val(data.Unidad);
          $('#Precio').val(data.PrecioBase);
          $('#Observaciones').val(data.Observaciones);
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
      $.post("dist/fw/servicios_logistica.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                  html += '<tr class="edita_error" id="error_' + $.trim(data[i].idCatLog) + '">';
                  html += '<td>' + $.trim(data[i].NoCatalogo) + '</td>';
                  html += '<td>' + $.trim(data[i].DescripcionServicio) + '</td>';
                  html += '<td>' + $.trim(data[i].Referencia) + '</td>';
                  html += '<td>' + $.trim(data[i].Unidad) + '</td>';
                  html += '<td>' + $.trim(data[i].PrecioBase) + '</td>';
                  html += '<td>' + $.trim(data[i].Observaciones) + '</td>';
                  html += '<td class="btnEditar" id="edit_'+data[i].idCatLog+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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
      html += '<th>N° Catalogo</th>';
      html += '<th>Descripción del Servicio</th>';
      html += '<th>Referencia</th>';
      html += '<th>Unidad</th>';
      html += '<th>Precio Base</th>';
      html += '<th>Observaciones</th>';
      html += '<th>Editar</th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';
      html += '</tbody>';
      html += '</table>';
      $('#div_registros').html(html);
  }
  
  function limpia_formulario(){
      $("#NoCatalogo").val("");
      $("#Descripcion").val("");
      $("#Referencia").val("");
      $("#Observaciones").val("");
      $("#Unidad").val("");
      $("#Precio").val("");
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
  