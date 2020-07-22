//#region "VARIABLES GLOBALES QUE USA LA COTIZACION TRANSFER <-->"
var anio=0;

//#endregion
//#region "CODIGO QUE SE EJECUTA AL ABRIR EL DOCUMENTO HTML O FUNCIONALIDADES DE LOS ITEMS DEL DOCUMENTO"
$(document).ready(function(){
    obtener_contactos();
    //=============================== EVENTO AL CAMBIAR EL TAMAÑO DEL NAVEGADOR =============================
    // $(window).resize(function() {
    //   if(this.resizeTO) clearTimeout(this.resizeTO);
    //   this.resizeTO = setTimeout(function() {
    //      $(this).trigger('resizeEnd');
    //   }, 500);
    // });
    // $(window).bind("resizeEnd", function() {
    //   var tableSAM = $('#table_SAM').DataTable();
    //       tableSAM.destroy();
    //       $('#table_SAM').DataTable({
    //         "paging": true,
    //         "lengthChange": true,
    //         "searching": true,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": true,
    //         "scrollX":true
    //     }); 
    //   var tableArtCot = $('#articulosCot').DataTable();
    //       tableArtCot.destroy();
    //       $('#articulosCot').DataTable({
    //         "ordering": false,
    //         "scrollX":true
    //     }); 
    // });
    // =============================== CODIGO PARA OBTENER LA CONSULTA DE COTIZACIONES MEDIANTE EL CONTACTO ============================
    $('html').on('click', '.btnContacto', function(){
        var id = $(this).attr('id').split('_')[1];
        if( $('#anio2019').prop('checked') ) {
           obtener_Cots(2019, id);
           alert(id);
        }
        else if ($('#anio2018').prop('checked')){
            anio=2018;
        }
        else{
        anio=2017;
        }
    });
    //==================================================================================================================================
  });
  //#endregion
  //#region "METODOS PARA OBTENER DATOS DE LA BASE DE DATOS Y PONERLOS EN LOS FORMULARIOS"  
  // =============================== CODIGO PARA OBTENER LOS CONTACTOS A COTIZAR ============================
  function obtener_contactos(){
    var opc = 1;
    $('.preloader').show();
    regenerar_contactos();
    $.post("dist/fw/cotizacion_transfer.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
                html += '<tr>';
                html += '<td>' + $.trim(data[i].Clavempresa) + '</td>';
                html += '<td>' + $.trim(data[i].Compania) + '</td>';
                html += '<td>' + $.trim(data[i].RFC) + '</td>';
                html += '<td>' + $.trim(data[i].DomicilioConsig) + '</td>';
                html += '<td>' + $.trim(data[i].Nombre) + '</td>';
                html += '<td>' + $.trim(data[i].Email) + '</td>';
                html += '<td>' + $.trim(data[i].Tel) + '</td>';
                html += '<td class="btnContacto" id="edit_'+data[i].Clavempresa+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
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
// =========================================================================================================
  // =============================== CODIGO PARA OBTENER LOS CONTACTOS A COTIZAR ============================
  function obtener_Cots(anio, id){
    var opc = 2;
    $('.preloader').show();
    regenerar_Cots();
    $.post("dist/fw/cotizacion_transfer.php",{opc:opc, id:id, anio:anio},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
                html += '<tr>';
                html += '<td>' + $.trim(data[i].NumCot) + '</td>';
                html += '<td>' + $.trim(data[i].Cliente) + '</td>';
                html += '<td>' + $.trim(data[i].Fecha) + '</td>';
                html += '<td>' + $.trim(data[i].Marca) + '</td>';
                html += '<td>' + $.trim(data[i].Modelo) + '</td>';
                html += '<td>' + $.trim(data[i].ID) + '</td>';
                html += '<td class="btnNumCot" id="edit_'+data[i].NumCot+'"><span class="font-icon-wrapper lnr-select" ></span></td>';
                html += '</tr>';                        
            }
            $('#table_Cots tbody').html(html);
            $('#table_Cots').DataTable({
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
// =========================================================================================================
  //#endregion
  //#region "METODOS PARA REGENERAR TABLAS O FORMULARIOS" 
  // ============================== CODIGO PARA REGENERAR LA TABLA DE CONTACTOS ==========================================================================
  function regenerar_contactos(){
    $('#div_contactos').html("");
    var html = "";
    html += '<table style="width: 100%;" id="table_contactos" class="table table-hover table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Clavempresa</th>';
    html += '<th>Empresa</th>';
    html += '<th>RFC</th>';
    html += '<th>Dirección</th>';
    html += '<th>Nombre</th>';
    html += '<th>Email</th>';
    html += '<th>Teléfono</th>';
    html += '<th></th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_contactos').html(html);
}
//
  function regenerar_Cots(){
    $('#div_Cots').html("");
    var html = "";
    html += '<table style="width: 100%;" id="table_Cots" class="table table-hover table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>NumCot</th>';
    html += '<th>Empresa</th>';
    html += '<th>Fecha</th>';
    html += '<th>Marca</th>';
    html += '<th>Modelo</th>';
    html += '<th>ID</th>';
    html += '<th></th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_Cots').html(html);
}
//#endregion