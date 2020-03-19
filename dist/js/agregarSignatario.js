$(document).ready(function(){
    $('.btnEditarG').hide();
    obtener_registros();

     // =========== EVENTO DE EDITAR EN LA TABLA DE UNIDAD DE NEGOCIO ==============================
        $('html').on('click', '.btnEditar', function(){
            //SE SIMULA EL CLICK DEL TAB 
            $("#tab-0").get(0).click();
            // ================ SE ASIGNA ID A EDITAR ===============================================
            var id = $(this).attr('id').split('_')[1];

            obtener_unidad(id);
        });
  });

  function obtener_registros(){
      var opc = "obtener_registros";
      $('.line-scale-pulse-out').show();
      regenerar_tabla();
      $.post("dist/fw/UnidadNegocio.php",{opc:opc},function(data){
          if(data){
              var html = '';
              for (var i = 0; i < data.length; i++){
                html += '<tr class="edita_error" id="error_' + $.trim(data[i].idUnidadNegocio) + '">';
                html += '<td>' + $.trim(data[i].idUnidadNegocio) + '</td>';
                html += '<td>' + $.trim(data[i].UnidadNegocio) + '</td>';
                html += '<td>' + $.trim(data[i].Laboratorio) + '</td>';
                html += '<td class="btnEditar" id="edit_'+data[i].idUnidadNegocio+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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

  // ========================= METODO PÁRA OBTENER UN REGISTRO PARA EDITAR ======================
  function obtener_unidad(id){
    var opc = "obtener_unidad";
    // $('.line-scale-pulse-out').show();
    regenerar_tablaUsuarios();
    $.post("dist/fw/agregarSignatarios.php",{'opc':opc, 'id':id},function(data){
        if(data){
            var html = '';
            alert("antes al for");
              for (var i = 0; i < data.length; i++){
                  
                html += '<tr class="edita_error" id="error_' + $.trim(data[i].idUsuario) + '">';
                html += '<td>' + $.trim(data[i].idUsuario) + '</td>';
                html += '<td>' + $.trim(data[i].Nombre) +  '</td>';
                html += '<td>' + $.trim(data[i].Depto) + '</td>';
                html += '<td>' + $.trim(data[i].Email) + '</td>';
                html += '<td class="btnEditar" id="edit_'+data[i].idUsuario+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
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

              $('#Nombre').val(data.idUsuario +' '+ data.Nombre);
        }
        else
        {
          alerta_error("Error", "Error al recibir los datos");
        }
        // $('.line-scale-pulse-out').hide();
    },'json');
  }
   
  function regenerar_tabla(){
    $('#div_registros').html("");
    var html = "";
    html += '<table id="example1" class="table table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Id Unidad</th>';
    html += '<th>Unidad de Negocio</th>';
    html += '<th>Laboratorio</th>';
    html += '<th>Seleccionar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_registros').html(html);
  }

  function regenerar_tablaUsuarios(){
    $('#div_usuarios').html("");
    var html = "";
    html += '<table id="example2" class="table table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>idUsuario</th>';
    html += '<th>Nombre</th>';
    html += '<th>Depto</th>';
    html += '<th>Email</th>';
    html += '<th>Seleccionar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_usuarios').html(html);
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
  