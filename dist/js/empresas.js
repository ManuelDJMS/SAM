$(document).ready(function(){
	// obtener_numeros_empleado();
	// obtener_usuarios();
	limpia_formulario();
	obtener_registros();

	$('html').on('click', '#btnAgregaEmpresa', function(){
        // var noEmpleado = $("#inputNoEmpleado option:selected").val();
        var RazonSocial = $("#RazonSocial").val();
        var RFC = $("#RFC").val();
        var Credito = $("#Credito").val();
        var Observaciones = $("#Observaciones").val();
        var CVentas = $("#exampleCustomCheckbox1").val();
        var CCursos = $("#exampleCustomCheckbox2").val();
		var CGestoria = $("#exampleCustomCheckbox3").val();
		
        // var perfil = $("#inputPerfil option:selected").text();
		 if(RazonSocial == "")
		 {

		 }
		 else
		 {
			registrar_usuario(RazonSocial,RFC,Credito,Observaciones,CVentas,CCursos,CGestoria);
		 }
       
    });

// 	$('html').on('click', '.cierraBoxEliminaUsuario', function(){
// 		$("#boxEliminaUsuario").hide();
// 		$("#iIdUsuarioElimina").val("");
// 	});

// 	$('html').on('click', '.elimina', function(){
// 		var id_registro = $(this).attr("id").split('_')[1];
// 		$("#iIdUsuarioElimina").val(id_registro);
// 		$("#boxEliminaUsuario").show();
// 	});
	
// 	$('html').on('click', '.aceptarBoxEliminaUsuario', function(){
// 		var id_registro = $("#iIdUsuarioElimina").val();
// 		elimina_usuario(id_registro);
// 	});

// 	$('html').on('click', '.adjuntaFoto', function(){
// 		var id_registro = $(this).attr("id").split('_')[1];
// 		$("#iIdUsuarioFoto").val(id_registro);
// 		$("#boxCargaFoto").show();
// 	});
	
// 	$('html').on('click', '.cierraBoxCargaFoto', function(){
// 		$("#boxCargaFoto").hide();
// 		$("#iIdUsuarioFoto").val("");
// 		Dropzone.forElement("div#cargaFoto").removeAllFiles(true);
// 	});
    
//     $("div#cargaFoto").dropzone({
// 		url: "dist/fw/uploadFoto.php",
// 		success: function(file, data){
// 			actualiza_foto(data);
// 		}
// 	});

// 	$('html').on('click', '.verImagen', function(){
// 		var vchImagen = $(this).attr("vchImagen");
// 		var vchNombre = $(this).attr("vchNombre");

// 		$("#imgImagenUsuario").attr("src","../../archivos/fotos/"+vchImagen);
// 		$("#nombre_usuario").html(vchNombre);
// 	});

});

// function obtener_numeros_empleado(){
// 	var opc = 'obtener_numeros_empleado';
// 	$.post("dist/fw/usuarios.php",{opc:opc}, function(data){
// 		if(data){
// 			var mySelect = $('#inputNoEmpleado');
// 			mySelect.append(
// 		        $('<option></option>').val("0").html("")
// 		    );  
//             for (var i = 0; i < data.length; i++){
// 				mySelect.append(
// 			        $('<option></option>').val(data[i].vchEmpleado).html(data[i].vchNombre)
// 			    );                       
//             }
// 		}
// 	}, 'json');
// }

// function obtener_usuarios(){
// 	var opc = 'obtener_usuarios';
// 	$.post("dist/fw/usuarios.php",{opc:opc}, function(data){
// 		if(data){
// 			var html = '';
//             for (var i = 0; i < data.length; i++){
//                 html += '<tr>';
//                     html += '<td>' + $.trim(data[i].vchEmpleado) + '</td>';
// 	                html += '<td>' + $.trim(data[i].vchNombre) + '</td>';
// 	                html += '<td>' + $.trim(data[i].vchPerfil) + '</td>';
// 	                if(data[i].vchFoto){
// 	                	html += '<td class="centrado"><span id="id_'+$.trim(data[i].id)+'_FotoAgregada" class="conFoto adjuntaFoto glyphicon glyphicon-ok-circle"></span> <span id="id_'+$.trim(data[i].id)+'_VistaImagen" vchImagen="'+$.trim(data[i].vchFoto)+'" vchNombre="'+$.trim(data[i].vchNombre)+'" class="verImagen glyphicon glyphicon-eye-open"></span> </td>';
// 	                }
// 	                else{
// 	                	html += '<td class="centrado"><span id="id_'+$.trim(data[i].id)+'_SinFoto" class="sinFoto adjuntaFoto glyphicon glyphicon-remove-circle"></span></td>';
// 	                }
// 	                html += '<td class="centrado"><span id="id_'+$.trim(data[i].id)+'_eliminaFormato" class="elimina glyphicon glyphicon-remove"></span></td>';
//                 html += '</tr>';                        
//             }
//             $('#table_usuarios tbody').html(html);
// 		}
// 	}, 'json');
// }
function obtener_registros(){
    // var user = "admin";
    var opc = "obtener_registros";
    // $('.nuevo_registro').hide();
    // $('.listado').show();
    // $('.loading').show();
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
                html += '<td>' + $.trim(data[i].ObservacionesEmpresa) + '</td>';
                html += '<td class="btnEditar" id="edit_'+data[i].ClaveEmpresa+'"><span class="glyphicon glyphicon-pencil" ></span></td>';
                html += '<td class="btnBorrar" id="del_'+data[i].ClaveEmpresa+'"><span class="glyphicon glyphicon-trash" ></span></td>';
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
        // $('.loading').hide();
    },'json');
}
    
function regenerar_tabla(){
    $('#div_registros').html("");
    var html = "";
    html += '<table id="example" class="table table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Clave Empresa</th>';
    html += '<th>Razón Social</th>';
    html += '<th>RFC</th>';
	html += '<th>Crédito</th>';
	html += '<th>Observaciones de la empresa</th>';
	html += '<th>Editar</th>';
    html += '<th>Eliminar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_registros').html(html);
}
function registrar_usuario(RazonSocial,RFC,Credito,Observaciones,CVentas,CCursos,CGestoria){
	var opc = 'registrar_empresa';
	$.post("dist/fw/empresas.php",{opc:opc,RazonSocial:RazonSocial,RFC:RFC,Credito:Credito,Observaciones:Observaciones,CVentas:CVentas,CCursos:CCursos,CGestoria:CGestoria}, function(data){
		if(data){
			// alertModal("Usuario registrado de manera correcta.", "success");
			
			// obtener_usuarios();
			alerta();
			limpia_formulario();
			
		}
	}, 'json');
}

function limpia_formulario(){
    $("#RazonSocial").val("");
	$("#RFC").val("");
	$("#Tipo").val("");
	$("#Credito").val("");
    $("#Observaciones").val("");
	$("#exampleCustomCheckbox1").removeAttr("checked");
	$("#exampleCustomCheckbox2").removeAttr("checked");
	$("#exampleCustomCheckbox3").removeAttr("checked");
	
	
	// $("#Limpiar").html("");
}
	// echo "<script>";
	function alerta(){
	// swal({
	// 	title: '¡Guardado!',
	// 	text: 'Empresa guardada correctamente',
	// 	type: 'success',
	// 	});
	
    // Swal({
    //     title: '¡Guardado!',
    //     text: "Empresa guardada correctamente ¿desea seguir en 'Empresas'?",
    //     type: 'success',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Si!'
    //   }).then((result) => {
    //     if (result.value) {

    //     //   Swal.fire(
    //     //     'Deleted!',
    //     //     'Your file has been deleted.',
    //     //     'success'
    //     //   )
    //     location.reload();
    //     }
    //     else
    //     {
    //         window.locationf="http://www.cristalab.com"
    //     }

    //   })
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
          // swalWithBootstrapButtons.fire(
          //   'Deleted!',
          //   'Your file has been deleted.',
          //   'success'
          // )
          location.reload();
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          // swalWithBootstrapButtons.fire(
          //   'Cancelled',
          //   'Your imaginary file is safe :)',
          //   'error'
          // )
          
          window.location="http://localhost:8080/dashboard/SAM/index.php";
        }
      })
			 
	}
           

// function elimina_usuario(id_registro){
// 	var opc = 'elimina_usuario';
// 	$.post("dist/fw/usuarios.php",{opc:opc, id_registro:id_registro}, function(data){
// 		if(data.resultado == 'true'){
// 			$("#boxEliminaUsuario").hide();
// 			alertModal("Usuario eliminado de manera correcta", "success");
// 			obtener_usuarios();
// 			$("#imgImagenUsuario").attr("src","../../archivos/fotos/no_image.jpg");
// 		}
// 		else{
// 			alertModal("No se pudo eliminar el usuario", "danger");
// 		}
// 	}, 'json');
// }

// function actualiza_foto(data) {
// 	var obj = jQuery.parseJSON(data);
// 	if(obj.ok){
// 		var opc = 'actualiza_foto';
// 		var vchFoto = obj.vchFoto;
// 		var id = $("#iIdUsuarioFoto").val();
// 		$.post("dist/fw/usuarios.php",{opc:opc, vchFoto:vchFoto, id:id}, function(data){
// 			obtener_usuarios();
// 			limpia_formulario();
// 		}, 'json');
// 	}
// }

