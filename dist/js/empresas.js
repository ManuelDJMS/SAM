$(document).ready(function(){
  // limpia_formulario();
  obtener_registros();
  obtener_paqueterias();
  // ======================= EVENTO AL CHECK NACIONAL FISCAL===============================================
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
  // ======================================================================================================
  // ======================= EVENTO AL CHECK NACIONAL CONSIGNACION=========================================
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
  // ======================================================================================================
  // ======================= EVENTO AL CHECK NACIONAL ENVIO================================================
  $('html').on('click','#check3',function(){
    if($(this).val()== 1){
      $(this).val(0);
      $('#EstadoEnvioOM').show();
      $('#PaisEnvioOM').show();
      $('#EstadoSelectEnvio').hide();
      $('#EstadoEnvio').val("");
      $('#PaisEnvio').val("");
    }
    else{
      $(this).val(1);
      $('#EstadoEnvioOM').hide();
      $('#PaisEnvioOM').hide();
      $('#EstadoSelectEnvio').show();
      $('#PaisEnvio').val("México");
    }
  });
  // ======================================================================================================
  // ========================== EVENTO AL CHECK FACTURACION================================================
  $('html').on('click','#checkFiscalEditar',function(){
    if($(this).val()== 1){
      $(this).val(0);
    }
    else{
      $(this).val(1);
    }
  });
  // ======================================================================================================
  // ========================== EVENTO AL CHECK CONSIGNACUI================================================
  $('html').on('click','#checkConsigEditar',function(){
    if($(this).val()== 1){
      $(this).val(0);
    }
    else{
      $(this).val(1);
    }
  });
  // ======================================================================================================
  // ================================ EVENTO AL CHECK ENVIO================================================
  $('html').on('click','#checkEnvioEditar',function(){
    if($(this).val()== 1){
      $(this).val(0);
    }
    else{
      $(this).val(1);
    }
  });
  // ======================================================================================================
  // ======================= EVENTO AL CHECK NACIONAL EDITAR===============================================
  $('html').on('click','#checkEditar',function(){
    if($(this).val()== 1){
      $(this).val(0);
      $('#EstadosEditar').show();
      $('#EstadoSelectEditar').hide();
      $('#EstadoEditar').val("");
      $('#PaisEditar').val("");
    }
    else{
      $(this).val(1);
      $('#EstadosEditar').hide();
      $('#EstadoSelectEditar').show();
      $('#PaisEditar').val("México");
    }
  });
  // ======================================================================================================
  // ======================= EVENTO AL CHECK Consignacion en fiscal========================================
  $('html').on('click','#checkconsig',function(){
    
    if($(this).val() == "0"){
      if ($('#check').val() == "1"){
        $("#EstadoListConsig option[value='"+ $('#EstadoListFiscal').val() +"']").attr("selected", true);
        $('#CompaniaConsig').val($('#CompaniaFiscal').val());
        $('#DireccionConsig').val($('#DireccionFiscal').val());
        $('#CPConsig').val($('#CPFiscal').val());
        $('#CiudadConsig').val($('#CiudadFiscal').val());
        $('#ReferenciasConsig').val($('#ReferenciasFiscal').val());
      }
      else{
        $("#check2").get(0).click();
        $('#CompaniaConsig').val($('#CompaniaFiscal').val());
        $('#DireccionConsig').val($('#DireccionFiscal').val());
        $('#CPConsig').val($('#CPFiscal').val());
        $('#CiudadConsig').val($('#CiudadFiscal').val());
        $('#EstadoConsig').val($('#EstadoFiscal').val());
        $('#PaisConsig').val($('#PaisFiscal').val());
        $('#ReferenciasConsig').val($('#ReferenciasFiscal').val());
      }
      $(this).val(1);
    }
    else{
      $(this).val(0);
      if ($('#check').val() == "1"){
        $("#EstadoListConsig option[value='Aguascalientes']").attr("selected", true);
        $('#CompaniaConsig').val("");
        $('#DireccionConsig').val("");
        $('#CPConsig').val("");
        $('#CiudadConsig').val("");
        $('#ReferenciasConsig').val("");
      }
      else{
        $("#check2").get(0).click();
        $('#CompaniaConsig').val("");
        $('#DireccionConsig').val("");
        $('#CPConsig').val("");
        $('#CiudadConsig').val("");
        $('#EstadoConsig').val("");
        $('#PaisConsig').val("México");
        $('#ReferenciasConsig').val("");
      }
    }
  });
  // ======================================================================================================
  // ======================= EVENTO AL CHECK de envio en fiscal============================================
  $('html').on('click','#checkenvio',function(){
    
    if($(this).val() == "0"){
      if ($('#check').val() == "1"){
        
        $("#EstadoListEnvio option[value='"+ $('#EstadoListFiscal').val() +"']").attr("selected", true);
        $('#CompaniaEnvio').val($('#CompaniaFiscal').val());
        $('#DireccionEnvio').val($('#DireccionFiscal').val());
        $('#CPEnvio').val($('#CPFiscal').val());
        $('#CiudadEnvio').val($('#CiudadFiscal').val());      
        $('#ReferenciasEnvio').val($('#ReferenciasFiscal').val());      
      }
      else{
        $("#check3").get(0).click();
        $('#CompaniaEnvio').val($('#CompaniaFiscal').val());
        $('#DireccionEnvio').val($('#DireccionFiscal').val());
        $('#CPEnvio').val($('#CPFiscal').val());
        $('#CiudadEnvio').val($('#CiudadFiscal').val());
        $('#EstadoEnvio').val($('#EstadoFiscal').val());
        $('#PaisEnvio').val($('#PaisFiscal').val());
        $('#ReferenciasEnvio').val($('#ReferenciasFiscal').val());
      }
      $(this).val(1);
    }
    else{
      $(this).val(0);
      if ($('#check').val() == "1"){
        $("#EstadoListEnvio option[value='Aguascalientes']").attr("selected", true);
        $('#CompaniaEnvio').val("");
        $('#DireccionEnvio').val("");
        $('#CPEnvio').val("");
        $('#CiudadEnvio').val("");
        $('#ReferenciasEnvio').val("");
      }
      else{
        $("#check3").get(0).click();
        $('#CompaniaEnvio').val("");
        $('#DireccionEnvio').val("");
        $('#CPEnvio').val("");
        $('#CiudadEnvio').val("");
        $('#EstadoEnvio').val("");
        $('#PaisEnvio').val("México");
        $('#ReferenciasEnvio').val("");
      }
    }
  });
  // ======================================================================================================
  // ======================= EVENTO AL CHECK de envio en consig============================================
  $('html').on('click','#checkenvioC',function(){
    
    if($(this).val() == "0"){
      if ($('#check2').val() == "1"){
        $("#EstadoListEnvio option[value='"+ $('#EstadoListConsig').val() +"']").attr("selected", true);
        $('#CompaniaEnvio').val($('#CompaniaConsig').val());
        $('#DireccionEnvio').val($('#DireccionConsig').val());
        $('#CPEnvio').val($('#CPConsig').val());
        $('#CiudadEnvio').val($('#CiudadConsig').val());
        $('#ReferenciasEnvio').val($('#ReferenciasConsig').val());
      }
      else{
        $("#check3").get(0).click();
        $('#CompaniaEnvio').val($('#CompaniaConsig').val());
        $('#DireccionEnvio').val($('#DireccionConsig').val());
        $('#CPEnvio').val($('#CPConsig').val());
        $('#CiudadEnvio').val($('#CiudadConsig').val());
        $('#EstadoEnvio').val($('#EstadoConsig').val());
        $('#PaisEnvio').val($('#PaisConsig').val());
        $('#ReferenciasEnvio').val($('#ReferenciasConsig').val());
      }
      $(this).val(1);
    }
    else{
      $(this).val(0);
      if ($('#check2').val() == "1"){
        $('#CompaniaEnvio').val("");
        $('#DireccionEnvio').val("");
        $('#CPEnvio').val("");
        $('#CiudadEnvio').val("");
        $('#ReferenciasEnvio').val("");
        $("#EstadoListEnvio option[value='Aguascalientes']").attr("selected", true);
      }
      else{
        $("#check3").get(0).click();
        $('#CompaniaEnvio').val("");
        $('#DireccionEnvio').val("");
        $('#CPEnvio').val("");
        $('#CiudadEnvio').val("");
        $('#EstadoEnvio').val("");
        $('#ReferenciasEnvio').val("");
        $('#PaisEnvio').val("México");
      }
    }
  });
  // ======================= CAMBIO EN SELECT PARA TEXT ===================================================
  $('html').on('change', '#EstadoListFiscal', function(){
    $('#EstadoFiscal').val($(this).val());
  });
  $('html').on('change', '#EstadoListConsig', function(){
    $('#EstadoConsig').val($(this).val());
  });
  $('html').on('change', '#EstadoListEnvio', function(){
    $('#EstadoEnvio').val($(this).val());
  });
  $('html').on('change', '#EstadoListEditar', function(){
    $('#EstadoEditar').val($(this).val());
  });
  //  =====================================================================================================
  // ============================ EVENTO DE EL BOTON GUARDAR (MANDAR POST)=================================
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
      // Access en caso de realizar el codigo para recuperar empresas de access
      if ($('#Access').val()==''){
        obj.Access = 0;
      }
      else{
        obj.Access = $.trim($('#Access').val());
      }
      // ================== VALORES DE LAS DIRECCIONES ================================
      if ($('#DireccionFiscal').val()!="" && ($('#DireccionFiscal').val()!= $('#DireccionEnvio').val()) && ($('#DireccionFiscal').val()!= $('#DireccionConsig').val()))
      {
        obj.CompaniaFiscal = $.trim($('#CompaniaFiscal').val());
        obj.DireccionFiscal = $.trim($('#DireccionFiscal').val());
        obj.CPFiscal = $.trim($('#CPFiscal').val());
        obj.CiudadFiscal=$.trim($('#CiudadFiscal').val());
        // obj.EstadoListFiscal = $.trim($('#EstadoListFiscal').val());
        obj.ReferenciasFiscal = $.trim($('#ReferenciasFiscal').val());
        obj.EstadoFiscal = $.trim($('#EstadoFiscal').val());
        obj.PaisFiscal = $.trim($('#PaisFiscal').val());
        obj.Facturacion = 1;
        // alert(obj.EstadoFiscal);
      }
      if ($('#DireccionConsig').val()!="" && ($('#DireccionConsig').val()!= $('#DireccionFiscal').val()) && ($('#DireccionConsig').val()!= $('#DireccionEnvio').val()))
      {
        obj.CompaniaConsig = $.trim($('#CompaniaConsig').val());
        obj.DireccionConsig = $.trim($('#DireccionConsig').val());
        obj.CPConsig = $.trim($('#CPConsig').val());
        obj.CiudadConsig=$.trim($('#CiudadConsig').val());
        // obj.EstadoListConsig = $.trim($('#EstadoListConsig').val());
        obj.EstadoConsig = $.trim($('#EstadoConsig').val());
        obj.ReferenciasConsig = $.trim($('#ReferenciasConsig').val());
        obj.PaisConsig = $.trim($('#PaisConsig').val());
        obj.Consignacion = 1;
        // alert("solo la segunta");
      }
      if ($('#DireccionEnvio').val()!="" && ($('#DireccionEnvio').val()!= $('#DireccionFiscal').val()) && ($('#DireccionEnvio').val()!= $('#DireccionConsig').val()))
      {
        obj.CompaniaEnvio = $.trim($('#CompaniaEnvio').val());
        obj.DireccionEnvio = $.trim($('#DireccionEnvio').val());
        obj.CPEnvio = $.trim($('#CPEnvio').val());
        obj.CiudadEnvio=$.trim($('#CiudadEnvio').val());
        // obj.EstadoListEnvio = $.trim($('#EstadoListEnvio').val());
        obj.EstadoEnvio = $.trim($('#EstadoEnvio').val());
        obj.ReferenciasEnvio = $.trim($('#ReferenciasEnvio').val());
        obj.PaisEnvio = $.trim($('#PaisEnvio').val());
        obj.Envio = 1;
        // alert("solo la tercera");
      }
      // ==================================== SI SE REPITE LAS DIRECCIONES ======================================================
   
        if (($('#DireccionFiscal').val() == $('#DireccionConsig').val()))
        {
          if (($('#DireccionFiscal').val() != "") && ($('#DireccionConsig').val() != "")){
          obj.CompaniaCombi = $.trim($('#CompaniaFiscal').val());
          obj.DireccionCombi = $.trim($('#DireccionFiscal').val());
          obj.CPCombi = $.trim($('#CPFiscal').val());
          obj.CiudadCombi=$.trim($('#CiudadFiscal').val());
          obj.ReferenciasCombi = $.trim($('#ReferenciasFiscal').val());
          obj.EstadoCombi = $.trim($('#EstadoFiscal').val());
          obj.PaisCombi = $.trim($('#PaisFiscal').val());
          obj.Facturacion = 1;
          obj.Consignacion = 1;
          }
        }
        else if($('#DireccionFiscal').val() == $('#DireccionEnvio').val()){
          if (($('#DireccionFiscal').val() != "") && ($('#DireccionEnvio').val() != "")){
          obj.CompaniaCombi = $.trim($('#CompaniaFiscal').val());
          obj.DireccionCombi = $.trim($('#DireccionFiscal').val());
          obj.CPCombi = $.trim($('#CPFiscal').val());
          obj.CiudadCombi=$.trim($('#CiudadFiscal').val());
          obj.ReferenciasCombi = $.trim($('#ReferenciasFiscal').val());
          obj.EstadoCombi = $.trim($('#EstadoFiscal').val());
          obj.PaisCombi = $.trim($('#PaisFiscal').val());
          obj.Facturacion = 1;
          obj.Envio = 1;
          }
          else{
            obj.Envio = 0;
          obj.Facturacion= 0;
          }
        }
        else if ($('#DireccionConsig').val() == $('#DireccionEnvio').val()){
          if (($('#DireccionConsig').val() != "") && ($('#DireccionEnvio').val()!="")){
            obj.CompaniaCombi = $.trim($('#CompaniaConsig').val());
            obj.DireccionCombi = $.trim($('#DireccionConsig').val());
            obj.CPCombi = $.trim($('#CPConsig').val());
            obj.CiudadCombi=$.trim($('#CiudadConsig').val());
            obj.ReferenciasCombi = $.trim($('#ReferenciasConsig').val());
            obj.EstadoCombi = $.trim($('#EstadoConsig').val());
            obj.PaisCombi = $.trim($('#PaisConsig').val());
            obj.Envio = 1;
            obj.Consignacion = 1;
          }
          else{
            obj.Envio = 0;
          obj.Consignacion = 0;
          }
        
        }
      // ==================================== TERMINA EL CODIGO SI SE REPITE LAS DIRECCIONES ======================================================
      obj.accion = $(this).attr("id").split('_')[1];
      obj.ClaveEmpresa = $(this).attr("id").split('_')[2];
      // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
      if(obj.RazonSocial != ''){
        guardar_empresa(obj);
      }
      else{
        $(".btnValidar").get(0).click();
        alerta_error("Oops...","Faltan llenar algunos campos");
      }
    });
  // ======================================================================================================
  // ============================ EVENTO DE EL BOTON GUARDAR (MANDAR dir)==================================
	$('html').on('click', '.btnGuardarD', function(){
     //============= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO ==============
     var obj = new Object();
     obj.Compania=$.trim($('#CompaniaEditar').val());
     obj.Tipo=$.trim($('#ListEmpresas').val());
     obj.Direccion=$.trim($('#DireccionEditar').val());
     obj.CP=$.trim($('#CPEditar').val());
     obj.Ciudad=$.trim($('#CiudadEditar').val());
     obj.Referencias=$.trim($('#ReferenciasEditar').val());
     obj.Estado=$.trim($('#EstadoEditar').val());
     obj.Pais=$.trim($('#PaisEditar').val());
     obj.Facturacion=$.trim($('#checkFiscalEditar').val());
     obj.Consig=$.trim($('#checkConsigEditar').val());
     obj.Envio=$.trim($('#checkEnvioEditar').val());
     obj.ClaveEmpresa=$.trim($('#ClaveEmpresa').val());
     obj.accion = $(this).attr("id").split('_')[1];
     alert(obj.accion);
     obj.idDireccion = $(this).attr("id").split('_')[2];
     // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
     if(obj.Compania != '' && obj.Direccion != ''){
       guardar_direccion(obj);
     }
     else{
       alerta_error("Oops...","Faltan llenar algunos campos");
     }
    });
  // ======================================================================================================
  // ======================== EVENTO DE EDITAR EN LA TABLA DE EMPRESAS ====================================
  $('html').on('click', '.btnEditar', function(){
      //SE SIMULA EL CLICK DEL TAB 
      $("#tab-0").get(0).click();
      //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
      $('.btnEditarG').show();
      $('.btnGuardar').hide();
      $('#accordion').hide();
      $('#EditarDirecciones').show();
      //=======================================================================================
      // ================ SE ASIGNA ID A EDITAR ===============================================
      var id = $(this).attr('id').split('_')[1];
      $('.btnEditarG').attr('id',$(this).attr('id'));
      obtener_registro(id);
      obtener_direcciones(id);
      
  });
  //=======================================================================================================
  // ======================== EVENTO DE EDITAR EN LA TABLA DE DIRECCIONES =================================
  $('html').on('click', '.btnEditarDir', function(){
      //==================== SE MUESTRAN Y OCULTAN CIERTOS BOTONES =============================
      $('.btnGuardarGD').show();
      alert("sd");
      $('.btnGuardarD').hide();
      //=======================================================================================
      // ================ SE ASIGNA ID A EDITAR ===============================================
      var id = $(this).attr('id').split('_')[1];
      $('.btnGuardarGD').attr('id',$(this).attr('id'));
      obtener_direccion(id);
  });
  //=======================================================================================================
  //=============================== EVENTO DEL BOTON DE EDITAR Y GUARDAR ==================================
   $('html').on('click', '.btnEditarG', function(){
      //======= EN ESTE METODO SE CREA UN OBJETO CON TODOS LOS DATOS DEL FORMULARIO ========= 
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
  //=======================================================================================================
  //========================== EVENTO DEL BOTON DE EDITAR Y GUARDAR DIRECCION =============================
  $('html').on('click', '.btnGuardarGD', function(){
    var obj=new Object();
    obj.Compania=$.trim($('#CompaniaEditar').val());
    obj.Tipo=$.trim($('#ListEmpresas').val());
    obj.Direccion=$.trim($('#DireccionEditar').val());
    obj.CP=$.trim($('#CPEditar').val());
    obj.Ciudad=$.trim($('#CiudadEditar').val());
    obj.Referencias=$.trim($('#ReferenciasEditar').val());
    obj.Estado=$.trim($('#EstadoEditar').val());
    obj.Pais=$.trim($('#PaisEditar').val());
    obj.Facturacion=$.trim($('#checkFiscalEditar').val());
    obj.Consig=$.trim($('#checkConsigEditar').val());
    obj.Envio=$.trim($('#checkEnvioEditar').val());
    obj.accion = $(this).attr("id").split('_')[0];
      obj.idDireccion = $(this).attr("id").split('_')[1];
      // ============= SE VALIDA SI CIERTOS CAMPOS ESTAN LLENOS =======================
      if(obj.Direccion != '' || obj.Compania !=''){
        guardar_direccion(obj);
      }
      else{
        alerta_error("Oops...","Faltan llenar algunos campos");
      }
  });
  //=======================================================================================================
});
// =========================== METODO PARA EDITAR Y GUARDAR LAS EMPRESAS ==================================
function guardar_empresa(obj){
  var opc = "guardar_empresa";
  $.post("dist/fw/empresas.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
      if(data){
          alerta("¡Guardado!", "La empresa se guardó correctamente, ¿desea seguir en 'Empresas'", "success");
          obtener_registros();
      }else{
          alerta_error("¡Error!","Error al guardar los datos o la empresa ya esta registrada");
      }
  },'json');
}
//=========================================================================================================
// =========================== METODO PARA EDITAR Y GUARDAR LAS DIRECCIONES ==================================
function guardar_direccion(obj){
  var opc = "guardar_direccion";
  $.post("dist/fw/empresas.php",{'opc':opc, 'obj':JSON.stringify(obj)},function(data){
      if(data){
          limpia_direcciones();
          alerta_success("¡Guardado!", "La dirección se guardó correctamente");
          obtener_direcciones($('#ClaveEmpresa').val());
      }else{
          alerta_error("¡Error!","Error al guardar los datos o la dirección ya esta registrada");
      }
  },'json');
}
//=========================================================================================================
// ============================== METODO PÁRA OBTENER lAS PAQUETERIAS =====================================
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
// ========================================================================================================
// ============================== METODO PÁRA OBTENER UN REGISTRO PARA EDITAR =============================
function obtener_registro(id){
  var opc = "obtener_registro";
  $('.preloader').show();
  $.post("dist/fw/empresas.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_formulario()
        $('#RazonSocial').val(data.RazonSocial.split(',')[0]);
         if(data.RazonSocial.split(',').length > 1 ){
          $('#exampleCustomSelect').val((data.RazonSocial.split(',')[1]).trim());
        }
        $('#RFC').val(data.RFC);
        $('#CuentaMensajeria').val(data.CuentaMensajeria);
        $('#Descuento').val(data.Descuento);
        $('#NoProveedor').val(data.NumProvMetas);
        $('#AdminPaq').val(data.AdminPaq);
        $('#Observaciones').val(data.ObservacionesEmpresa);
        $('#Credito').val(data.Credito);
        $('#Paqueteria').val(data.idPaqueteria);
        $('#ClaveEmpresa').val(data.ClaveEmpresa);

      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
      $('.preloader').hide();
  },'json');
}
// ========================================================================================================
// ========================== METODO PÁRA OBTENER UNA DIRECCIONES PARA EDITAR =============================
function obtener_direccion(id){
  var opc = "obtener_direccion";
  $.post("dist/fw/empresas.php",{'opc':opc, 'id':id},function(data){
      if(data){
        limpia_direcciones();
        $('#CompaniaEditar').val(data.Compania.split(',')[0]);
         if(data.Compania.split(',').length > 1 ){
          $('#ListEmpresas').val((data.Compania.split(',')[1]).trim());
        }
        $('#DireccionEditar').val(data.Domicilio);
        $('#CPEditar').val(data.CP);
        $('#CiudadEditar').val(data.Ciudad);
        if(data.Pais === 'México'){
          $('#EstadosEditar').hide();
          $('#EstadoSelectEditar').show();
          $("#EstadoListEditar").val(data.Estado);
        }
        else{
          $('#EstadosEditar').show();
          $('#EstadoSelectEditar').hide();
          $('#EstadoEditar').val(data.Estado);
          $('#PaisEditar').val(data.Pais);
        }
        $('#ReferenciasEditar').val(data.Referencias);
        if(data.Facturacion==1){
          $('#checkFiscalEditar').val(1);
          $("#checkFiscalEditar").attr('checked',true);
        }
        if(data.Consignacion==1){
          $('#checkConsigEditar').val(1);
          $("#checkConsigEditar").attr('checked',true);
        }
        if(data.Envio==1){
          $('#checkEnvioEditar').val(1);
          $("#checkEnvioEditar").attr('checked',true);
        }
      }
      else
      {
        alerta_error("Error", "Error al recibir los datos");
      }
      $('.line-scale-pulse-out').hide();
  },'json');
}
// ========================================================================================================
function obtener_registros(){
    var opc = "obtener_registros";
    $('.preloader').show();
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
        $('.preloader').hide();
    },'json');
}
// ==================== CODIGO PARA OBTENER LAS DIRECCIONES DE LA EMPRESA SELECCIONADA=====================
function obtener_direcciones(id){
    var opc = "obtener_direcciones";
    $('.preloader').show();
    regenerar_tabla_direcciones();
    $.post("dist/fw/empresas.php",{opc:opc,'id':id},function(data){
        if(data){
            var html = '';
            for (var i = 0; i < data.length; i++){
                html += '<tr>';
                html += '<td>' + $.trim(data[i].Compania) + '</td>';
                html += '<td>' + $.trim(data[i].Domicilio) + '</td>';
                html += '<td>' + $.trim(data[i].Ciudad) + '</td>';
                html += '<td>' + $.trim(data[i].Estado) + '</td>';
                html += '<td class="btnEditarDir" id="edit_'+data[i].idDireccion+'"><span class="font-icon-wrapper lnr-pencil" ></span></td>';
                html += '</tr>';                        
            }
            $('#table_direcciones tbody').html(html);
            $('#table_direcciones').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        }
        $('.preloader').hide();
    },'json');
}
// ========================================================================================================
function regenerar_tabla(){
    $('#div_registros').html("");
    var html = "";
    html += '<table id="table_registros" class="table table-hover table-bordered table-striped dataTable" style="width: 100%;">';
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
function regenerar_tabla_direcciones(){
    $('#div_registros_direcciones').html("");
    var html = "";
    html += '<table id="table_direcciones" class="table table-hover table-bordered table-striped dataTable " style="width: 100%;">';
    html += '<thead>';
    html += '<tr>';
    html += '<th>Compañia</th>';
    html += '<th>Domicilio</th>';
    html += '<th>Ciudad</th>';
    html += '<th>Estado</th>';
    html += '<th>Editar</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    html += '</tbody>';
    html += '</table>';
    $('#div_registros_direcciones').html(html);
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
  $("#Observaciones").val("");
  // =================  DIRECCIONES ========================
  $("#CompaniaFiscal").val("");
  $("#DireccionFiscal").val("");
  $("#CPFiscal").val("");
  $("#CiudadFiscal").val("");
  $("#ReferenciasFiscal").val("");
  $("#PaisFiscal").val("México");
  $("#EstadoFiscal").val("Aguascalientes");

  $("#CompaniaConsig").val("");
  $("#DireccionConsig").val("");
  $("#CPConsig").val("");
  $("#CiudadConsig").val("");
  $("#ReferenciasConsig").val("");
  $("#PaisConsig").val("México");
  $("#EstadoConsig").val("Aguascalientes");

  $("#CompaniaEnvio").val("");
  $("#DireccionEnvio").val("");
  $("#CPEnvio").val("");
  $("#CiudadEnvio").val("");
  $("#ReferenciasEnvio").val("");
  $("#PaisEnvio").val("México");
  $("#EstadoEnvio").val("Aguascalientes");
}

function limpia_direcciones(){
  $("#CompaniaEditar").val("");
  $("#DireccionEditar").val("");
  $("#CPEditar").val("");
  $("#CiudadEditar").val("");
  $("#ReferenciasEditar").val("");
  $("#PaisEditar").val("México");
  $("#EstadoEditar").val("Aguascalientes");
  $("#EstadoListEditar").val("");
  $("#ListEmpresas").val("");
  $('#checkFiscalEditar').val(0);
  $("#checkFiscalEditar").removeAttr('checked');
  $('#checkConsigEditar').val(0);
  $("#checkConsigEditar").removeAttr('checked');
  $('#checkEnvioEditar').val(0);
  $("#checkEnvioEditar").removeAttr('checked');
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
    })
  }
  function alerta_success(titulo, texto){
    Swal.fire({
      icon: 'success',
      title: titulo,
      text: texto
    })
  }
