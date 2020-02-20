// ************************************* EJECUCION DE METODOS ************************************************************************
$(buscar_datos());
// ************************************* METODO DE BUSCAR EMPRESAS (CLAVEEMPRESA, RAZON SOCIAL Y RFC) *****************************************************************
// =============================== METODO DONDE SE MANDAN LAS VARIABLES POS POST A LA PAGINA PRINCIPAL ================================================================
function buscar_datos(cvempresa,razon, rfc){
	$.ajax({
		url: 'buscar.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {cvempresa:cvempresa, razon: razon, rfc: rfc},
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}
//======================================================================================================================================================================
//================================================= CREACION DE VARIABLES ==============================================================================================
var razon="";
var rfc="";
var cvempresa="";
//======================================================================================================================================================================
// =================== BUSQUEDA CLAVEEMPRESA EN EMPRESAS.PHP =======================================
$(document).on('keyup','#CveEmpresa', function(){
	cvempresa = $(this).val();
   if (rfc == "" && razon =="" && cvempresa =="" ) {
	   buscar_datos();
   }else{
	   buscar_datos(cvempresa,razon,rfc);
   }
});
//=========================================================================================
// =================== BUSQUEDA RAZON SOCIAL EN EMPRESAS.PHP ===============================
$(document).on('keyup','#RazonSocial', function(){
	 razon = $(this).val();
	if (razon == "" && rfc == "" && cvempresa =="") {
		buscar_datos();
	}else{
		buscar_datos(cvempresa, razon, rfc);
	}
});

//=========================================================================================
// =================== BUSQUEDA RFC EN EMPRESAS.PHP =======================================
$(document).on('keyup','#RFC', function(){
	 rfc = $(this).val();
	// var r=$("#RazonSocial").val();
	if (rfc == "" && razon =="" && cvempresa =="") {
		buscar_datos();
		
	}else{
		buscar_datos(cvempresa, razon,rfc);
	}
});
//=========================================================================================