$(document).ready(function(){
    ALERT("ENTRA")
    $('.btnEditarG').hide();
    limpia_formulario();
    obtener_registros();
    // =================== EVENTOS DE SELECCION DE CHECKBOX ===================
    $('html').on('click','#R',function(){
      if($(this).val()== 1){
        $(this).val(0);
      }
      else{
        $(this).val(1);
      }
    });
    $('html').on('click','#M',function(){
      if($(this).val()== 1){
        $(this).val(0);
      }
      else{
        $(this).val(1);
      }
    });
    $('html').on('click','#A',function(){
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
        obj.Email = $.trim($('#Email').val());
        obj.Depto = $.trim($('#Credito').val());
        obj.Ext = $.trim($('#Ext').val());
        obj.Pass = $.trim($('#Pass').val());
        obj.R = $.trim($('#R').val());
        obj.M = $.trim($('#M').val());
        obj.A = $.trim($('#A').val());
        obj.accion = $(this).attr("id").split('_')[1];
        obj.idUsuarioAdministrador = $(this).attr("id").split('_')[2];
        // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
        if(obj.Nombre != '' && obj.Nombre != ''){
            ALERT("ENTRA A ANTES DE GUARDAR USUARIO")
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
        obtener_registro(id);
        
    });
    //========================================================================
    //============== EVENTO DEL BOTON DE EDITAR Y GUARDAR =====================
     $('html').on('click', '.btnEditarG', function(){
      //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO =======================================  
      var obj = new Object();
      obj.Nombre = $.trim($('#Nombre').val());
        obj.Apellidos = $.trim($('#Apellidos').val());
        obj.Email = $.trim($('#Email').val());
        obj.Depto = $.trim($('#Credito').val());
        obj.Ext = $.trim($('#Ext').val());
        obj.Pass = $.trim($('#Pass').val());
        obj.R = $.trim($('#R').val());
        obj.M = $.trim($('#M').val());
        obj.A = $.trim($('#A').val());
        obj.accion = $(this).attr("id").split('_')[0];
        obj.idUsuarioAdministrador = $(this).attr("id").split('_')[1];
      if(obj.Nombre != '' && obj.Nombre != ''){
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
      ALERT("GUARDAR USUARIO")
    var opc = "guardar_usuario";
    $.post("dist/fw/usuario.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
        if(data){
            alerta("¡Guardado!", "El usuario se guardo correctamente, ¿desea seguir en 'Usuarios'", "success");
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
    $.post("dist/fw/usuarios.php",{'opc':opc, 'id':id},function(data){
        if(data){
          limpia_formulario()
          $('#Nombre').val(data.Nombre.split(',')[0]);
          $('#Apellidos').val(data.Apellidos);
          $('#Email').val(data.Email);
          $('#Depto').val(data.Depto);
          $('#Ext').val(data.Ext);
          $('#Pass').val(data.Pass);
          if(data.R==1){
            $('#R').val(1);
            $("#R").attr('checked',true);
          }
          if(data.M==1){
            $('#M').val(1);
            $("#M").attr('checked',true);
          }
          if(data.A==1){
            $('#A').val(1);
            $("#A").attr('checked',true);
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
      ALERT("ENTRA A OBTENER REGISTROS")
      var opc = "obtener_registros";
      $('.line-scale-pulse-out').show();
      regenerar_tabla();
      $.post("dist/fw/usuarios.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                  html += '<tr class="edita_error" id="error_' + $.trim(data[i].idUsuarioAdministrador) + '">';
                  html += '<td>' + $.trim(data[i].Nombre) + '</td>';
                  html += '<td>' + $.trim(data[i].Apellidos) + '</td>';
                  html += '<td>' + $.trim(data[i].Depto) + '</td>';
                  html += '<td>' + $.trim(data[i].Email) + '</td>';
                  html += '<td class="btnEditar" id="edit_'+data[i].idUsuarioAdministrador+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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
      html += '<th>Nombre</th>';
      html += '<th>Apellidos</th>';
      html += '<th>Departamento</th>';
      html += '<th>Email</th>';
      html += '<th>Editar</th>';
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';
      html += '</tbody>';
      html += '</table>';
      $('#div_registros').html(html);
  }
  
  function limpia_formulario(){
      ALERT("ENTRA A LIMPIAR FORMULARIO")
      $("#Nombre").val("");
      $("#Apellidos").val("");
      $("#Email").val("");
      $("#Depto").val("");
      $("#Ext").val("");
      $("#Clave").val("");
      $("#Pass").val("");
      $("#R").removeAttr("checked");
      $("#M").removeAttr("checked");
      $("#A").removeAttr("checked");
      
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
  