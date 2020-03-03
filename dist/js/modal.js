$(document).ready(function(){

	if(localStorage['Siceel_Perfil']=='VENTANILLA') getTareas();
	else {
        getTareasFirma();
        getUltimasActividades();
    }
	if(localStorage['Siceel_Nombre']!='' && localStorage['Siceel_Nombre'] != null || localStorage['Siceel_Nombre'] != 'undefined'){
		$('.p_nombre').html(localStorage['Siceel_Nombre']);
		$('.foto-empleado').prop('src',localStorage['Siceel_Foto']);
	}
	$('html').on('click', '.cierraBoxMensaje', function(){
        $("#boxMensaje").hide();
    });

	$('html').on('click','#btn-buscar-ser',function(){
		if($('#txt-bascar-ser').val()!='') buscar_servicio($('#txt-bascar-ser').val());
	});

	$('html').on('click','#btn-buscar-reg',function(){
		if($('#txt-buscar-reg').val()!='') buscar_registro($('#txt-buscar-reg').val());
	});

	$("#txt-buscar-reg").keypress(function(e) {
       if(e.which == 13) {
          if($('#txt-buscar-reg').val()!='') buscar_registro($('#txt-buscar-reg').val());
       }
    });

    $("#txt-buscar-ser").keypress(function(e) {
       if(e.which == 13) {
		if($('#txt-bascar-ser').val()!='') buscar_servicio($('#txt-bascar-ser').val());
       }
    });

    
});
    
function alertModal(mensaje,tipo){
	if(tipo=='mensaje'){
		$('#boxMensaje').removeClass();
		$('#boxMensaje').addClass('modal');
		$('#boxMensaje').addClass('modal-primary');
		$('.modal-title').html('Información');
	}else if(tipo=='success'){
		$('#boxMensaje').removeClass();
		$('#boxMensaje').addClass('modal');
		$('#boxMensaje').addClass('modal-success');	
		$('.modal-title').html('Exito');
	}else if(tipo=='warning'){
		$('#boxMensaje').removeClass();
		$('#boxMensaje').addClass('modal');
		$('#boxMensaje').addClass('modal-warning');	
		$('.modal-title').html('Precaución');
	}else if(tipo=='danger'){
		$('#boxMensaje').removeClass();
		$('#boxMensaje').addClass('modal');
		$('#boxMensaje').addClass('modal-danger');	
		$('.modal-title').html('Error');
	}

    $("#boxMensajeBody").html("<p>"+mensaje+"</p>");
    $("#boxMensaje").show();
}

function getTareas(){
	var user = "admin";
    var opc = "get_pendientes";
    var Empleado = localStorage['Siceel_Empleado'];
    var Usuario = localStorage['Siceel_Usuario'];
    $.post("dist/fw/pendiente_envio.php",{user:user, opc:opc,Empleado:Empleado,Usuario:Usuario},function(data){
        if(data){
            $('#ul_tareas').html('');
            var html = '';
            $('#NoTareas').html(data.length);
            for (var i = 0; i < data.length; i++){
                html += '<li>';
                html += '<a href="pendiente_envio.php">';
                html += '<i class="fa fa-location-arrow text-aqua"></i> Enviar: ' + $.trim(data[i].vchNoServicio) +' - ' + $.trim(data[i].vchNoRegistro) + '</td>';
                html += '</a>';
                html += '</li>';
            }
            $('#ul_tareas').html(html);
            $('#a_tareas').attr('href',"pendiente_envio.php");
        }
    },'json');          
}

function getTareasFirma(){
	var user = "admin";
    var opc = "get_tareas_firma";
    var Empleado = localStorage['Siceel_Empleado'];
    $.post("dist/fw/tareas_firma.php",{user:user, opc:opc,Empleado:Empleado},function(data){
        if(data){
            $('#ul_tareas').html('');
            var html = '';
            $('#NoTareas').html(data.length);
            for (var i = 0; i < data.length; i++){
                html += '<li>';
                html += '<a href="tareas_firma.php">';
                html += '<i class="fa fa-location-arrow text-aqua"></i> Pendiente Firma: ' + $.trim(data[i].vchNoServicio) +' - ' + $.trim(data[i].vchNoRegistro) + '</td>';
                html += '</a>';
                html += '</li>';
            }
            $('#ul_tareas').html(html);
            $('#a_tareas').attr('href',"tareas_firma.php");
        }
    },'json');
}

function getUltimasActividades(NoServicio){
    var user = "admin";
    var opc = "get_ultimas_firmas";
    var Empleado = localStorage['Siceel_Empleado'];
    $.post("dist/fw/tareas_firma.php",{user:user, opc:opc},function(data){
        if(data){
            var text = '';
            for (var i = 0; i < data.length; i++){
            	text  +='<li>';
    			  text  +='<a href="javascript::;">';
    			    text  +='<i class="menu-icon fa fa-pencil bg-red"></i>';
    			    text  +='<div class="menu-info">';
    			      text  +='<h4 class="control-sidebar-subheading">Se aprobó el certificado/ informe  No. '+data[i].vchFolio+'</h4>';
    			    text  +='</div>';
    			  text  +='</a>';
    			text  +='</li>';
            }
       }
        $('#ul_actividades_recientes').html(text);
    },'json');
}

function buscar_servicio(NoServicio){
	var user = "admin";
    var opc = "bitacoras_libres_servicio";
    $('.loading').show();
    localStorage.removeItem('bitacora_detalle');
    $.post("dist/fw/bitacora.php",{user:user, opc:opc,NoServicio:NoServicio},function(data){
        if(data.length > 0){
            localStorage['bitacora_detalle'] = JSON.stringify(data[0]);
            location.href="detalle_servicio.php";
        }else alertModal("No se encontraron resutados para el numero de servicio: "+NoServicio,"warning");
        $('.loading').hide();
    },'json');
}
function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    alert(out);
}
function buscar_registro(NoRegistro){
	var user = "admin";
    var opc = "bitacoras_libres_registro";
    $('.loading').show();
    localStorage.removeItem('bitacora_laboratorio');
    $.post("dist/fw/bitacora.php",{user:user, opc:opc,NoRegistro:NoRegistro},function(data){
        if(data.length > 0){
            localStorage['bitacora_laboratorio'] = JSON.stringify(data[0]);
            location.href="detalle_laboratorio.php";
        }else alertModal("No se encontraron resutados para el numero de registro: "+NoRegistro,"warning");
        $('.loading').hide();
    },'json');
}

function enviar_correo(cliente,NoRegistro,NoServicio,Subnivel,tipo){
	var user = "admin";
    var opc = "enviar_archivo";
    $.post("dist/fw/envio_correo.php",{user:user, cliente:cliente,NoRegistro:NoRegistro,NoServicio:NoServicio,Subnivel:Subnivel,tipo:tipo},function(data){
        if(data!='error'){
            alertModal("El correo se envio satisfactoriamente","success");
        }else alertModal("No se encontraron resutados para el numero de registro: "+NoRegistro,"warning");
      
    },'json');
}