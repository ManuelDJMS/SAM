$(document).ready(function(){
	// obtener_numeros_empleado();
	// obtener_usuarios();
	limpia_formulario();
	obtener_registros();

	$('html').on('click', '#btnAgregarContacto', function(){
        // var noEmpleado = $("#inputNoEmpleado option:selected").val();
        var Nombre = $("#Nombre").val();
        var Direccion = "1";
        var Apellidos = $("#Apellidos").val();
        var Cargo = $("#Cargo").val();
        var Celular = $("#Celular").val();
        var Tel = $("#Tel").val();
        var Ext = $("#Ext").val();
        var Fax = $("#Fax").val();
        var Email = $("#Email").val();
        var Descuento = $("#Descuento").val();
        var Condiciones = $("#Condiciones").val();
        var Activo = $("#Activo").val();
        var fechaCreacion = getdate();
        var creado = "TI";
        var FechaModificacion = getdate();
        var Modificado = "TI";
		
        // var perfil = $("#inputPerfil option:selected").text();
		if(Nombre == "")
		 {

		 }
		 else
		 {
			registrar_C(Direccion,Nombre,Apellidos,Cargo,Celular,Tel,Ext,Fax, Email,Descuento, Condiciones,Activo,fechaCreacion,creado,FechaModificacion,Modificado);
		 }
       
    });

});

function obtener_registros(){
    var opc = "obtener_registros";
    regenerar_tabla();
    $.post("dist/fw/contactos.php",{opc:opc},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
                html += '<tr class="edita_error" id="error_' + $.trim(data[i].ClaveContacto) + '">';
                html += '<td>' + $.trim(data[i].ClaveContacto) + '</td>';
                html += '<td>' + $.trim(data[i].Nombre) + '</td>';
                html += '<td>' + $.trim(data[i].Apellidos) + '</td>';
                html += '<td>' + $.trim(data[i].Cargo) + '</td>';
                html += '<td>' + $.trim(data[i].Celular) + '</td>';
                html += '<td>' + $.trim(data[i].Tel) + '</td>';
                html += '<td>' + $.trim(data[i].Fax) + '</td>';
                html += '<td>' + $.trim(data[i].Ext) + '</td>';
                html += '<td>' + $.trim(data[i].Email) + '</td>';
                // html += '<td class="btnEditar" id="edit_'+data[i].ClaveContacto+'"><span class="glyphicon glyphicon-pencil" ></span></td>';
                // html += '<td class="btnBorrar" id="del_'+data[i].ClaveContacto+'"><span class="glyphicon glyphicon-trash" ></span></td>';
                html += '</tr>';                        
            }
            $('#example tbody').html(html);
            $('#example').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        }
    },'json');
}
    
function regenerar_tabla(){
    $('#div_registros').html("");
    var html = "";
    html += '<table id="example" class="table table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Clave Contacto</th>';
    html += '<th>Nombre</th>';
    html += '<th>Apellidos</th>';
	html += '<th>Cargo</th>';
	html += '<th>Celular</th>';
	html += '<th>Tel</th>';
    html += '<th>Fax</th>';
    html += '<th>Ext</th>';
    html += '<th>Email</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_registros').html(html);
}

function registrar_C(Nombre,Apellidos,Cargo,Celular,Tel,Ext,Fax,Email,Descuento,Condiciones,Activo){
	var opc = 'registrar_contacto';
	$.post("dist/fw/contacto.php",{opc:opc,Nombre:Nombre,Apellidos:Apellidos,Cargo:Cargo,Celular:Celular,Tel:Tel,Fax:Fax,Ext:Ext,Email:Email,Descuento:Descuento,Condiciones:Condiciones,Activo:Activo}, function(data){
		if(data){
			alerta();
			limpia_formulario();
		}
	}, 'json');
}

function limpia_formulario(){
    $("#Nombre").val("");
    $("#Apellidos").val("");
    $("#Cargo").val("");
    $("#Celular").val("");
    $("#Tel").val("");
    $("#Fax").val("");
    $("#Ext").val("");
    $("#Email").val("");
/*     $("#Descuento").val("");
    $("#Condiciones").val("");
    $("#Email").val("");
    $("#Activo").removeAttr("checked");	 */
	
}
	function alerta(){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: '¡Guardado!',
        text: "La empresa se guardó correctamente, ¿desea seguir en 'Empresas'?",
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'Si!',
        cancelButtonText: 'No, salir!',
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
