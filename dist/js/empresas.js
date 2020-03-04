$(document).ready(function(){
	// obtener_numeros_empleado();
	// obtener_usuarios();
	limpia_formulario();
	obtener_registros();

	$('html').on('click', '.btnGuardar', function(){
    // ESTE CODIGO SI FUNCIONA
    //     var RazonSocial = $("#RazonSocial").val();
    //     var RFC = $("#RFC").val();
    //     var Credito = $("#Credito").val();
    //     var Observaciones = $("#Observaciones").val();
    //     var CVentas = $("#exampleCustomCheckbox1").val();
    //     var CCursos = $("#exampleCustomCheckbox2").val();
		//     var CGestoria = $("#exampleCustomCheckbox3").val();
		//  if(RazonSocial == "")
		//  {

		//  }
		//  else
		//  {
		// 	registrar_usuario(RazonSocial,RFC,Credito,Observaciones,CVentas,CCursos,CGestoria);
    //  }
    var obj = new Object();
        obj.RazonSocial = $.trim($('#RazonSocial').val());
        obj.RFC = $.trim($('#RFC').val());
        obj.Credito = $.trim($('#Credito').val());
        obj.Observaciones = $.trim($('#Observaciones').val());
        obj.CVentas = $.trim($('#CVentas').val());
        obj.CCursos = $.trim($('#CCursos').val());
        obj.CGestoria = $.trim($('#CGestoria').val());
        obj.accion = $(this).attr("id").split('_')[1];
        obj.iIdMagnitud = $(this).attr("id").split('_')[2];
        if(RazonSocial != ""){
            guardar_empresa(obj);
        }
        // else{
            
        // }
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
// =================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ============================
function guardar_empresa(obj){
  var opc = "guardar_empresa";
  // $('.loading').show();
  $.post("dist/fw/empresas.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
      if(data){
          alerta("¡Guardado!", "La empresa de guardo correctamente, ¿desea seguir en 'Empresas'", "success");
          obtener_registros();
      }else{
          alerta("¡Error!","Error al guardar registros", "danger");
      }
      $('.loading').hide();
  },'json');
}

function obtener_registros(){
    var opc = "obtener_registros";
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
                html += '<td class="btnEditar" id="edit_'+data[i].ClaveEmpresa+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
                // html += '<td class="btnBorrar" id="del_'+data[i].ClaveEmpresa+'"><span class="glyphicon glyphicon-trash" ></span></td>';
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
    },'json');
}
    
function regenerar_tabla(){
    $('#div_registros').html("");
    var html = "";
    html += '<table id="example1" class="table table-bordered table-striped dataTable">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Clave Empresa</th>';
    html += '<th>Razón Social</th>';
    html += '<th>RFC</th>';
	html += '<th>Crédito</th>';
	html += '<th>Observaciones de la empresa</th>';
	html += '<th>Editar</th>';
    // html += '<th>Eliminar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_registros').html(html);
}
// function registrar_usuario(RazonSocial,RFC,Credito,Observaciones,CVentas,CCursos,CGestoria){
// 	var opc = 'registrar_empresa';
// 	$.post("dist/fw/empresas.php",{opc:opc,RazonSocial:RazonSocial,RFC:RFC,Credito:Credito,Observaciones:Observaciones,CVentas:CVentas,CCursos:CCursos,CGestoria:CGestoria}, function(data){
// 		if(data){
// 			alerta();
// 			limpia_formulario();
			
// 		}
// 	}, 'json');
// }

function limpia_formulario(){
    $("#RazonSocial").val("");
	$("#RFC").val("");
	$("#Tipo").val("");
	$("#Credito").val("");
    $("#Observaciones").val("");
	$("#exampleCustomCheckbox1").removeAttr("checked");
	$("#exampleCustomCheckbox2").removeAttr("checked");
	$("#exampleCustomCheckbox3").removeAttr("checked");
	
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

