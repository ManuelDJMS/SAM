<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<link rel="stylesheet" href="dist/css/base.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script> 
<script src="dist/js/empresas.js"></script>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="lnr-apartment icon-gradient bg-sunny-morning">
                        </i>
                    </div>
                    <div>Empresas
                        <div class="page-title-subheading">Crea y modifica las empresas relacionadas con Metas SA. de CV.
                        </div>
                    </div>
                </div>
            </div>
        </div>            
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Nueva</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Consultar</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <form id="signupForm">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Informacion General de la Empresa</h5>
                            <!-- ===================================== INICIA EL PRIMER RENGLON =========================================== -->
                            <div class="form-row">
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Razón Social</label>
                                        <input type="text" class="form-control" id="RazonSocial" name="RazonSocial" required/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">Tipo</label>
                                        <select type="select" id="exampleCustomSelect" name="TipoEmpresa" class="custom-select">
                                            <option></option>
                                            <option value="A.C.">A.C.</option>
                                            <option value="S.A.B.">S.A.B.</option>
                                            <option value="S.A.B. de C.V.">S.A.B. de C.V.</option>
                                            <option value="S.A.S.">S.A.S.</option>
                                            <option value="S.A.">S.A.</option>
                                            <option value="S.A. de C.V.">S.A. de C.V.</option>
                                            <option value="S.A.P.I.">S.A.P.I.</option>
                                            <option value="S.A.P.I. de C.V.">S.A.P.I. de C.V.</option>
                                            <option value="S.A.P.I.B.">S.A.P.I.B.</option>
                                            <option value="S. de P.R. de R.L.">S. de P.R. de R.L.</option>
                                            <option value="S. de R.L.">S. de R.L.</option>
                                            <option value="S. de R.L. de C.V.">S. de R.L. de C.V.</option>
                                            <option value="S. en N.C">S. en N.C</option>
                                            <option value="S. Coop.">S. Coop.</option>
                                            <option value="S.C.">S.C.</option>
                                            <option value="S.S.S.">S.S.S.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">RFC</label>
                                        <input name="RFC" id="RFC" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <!-- ===================================== TERMINA EL PRIMER RENGLON =========================================== -->
                            <!-- ===================================== INICIA EL SEGUNDO RENGLON =========================================== -->
                            <div class="form-row">   
                                <div class="col-md-3">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Crédito</label>
                                        <select name="Credito" id="Credito" class="form-control">
                                            <option value="CON CRÉDITO">CON CRÉDITO</option>
                                            <option value="SIN CRÉDITO">SIN CRÉDITO</option>
                                            <option value="CRÉDITO SUSPENDIDO">CRÉDITO SUSPENDIDO</option>
                                            <option value="SUSPENDIDO">SUSPENDIDO</option>
                                            <option value="LISTA NEGRA">LISTA NEGRA</option>
                                        </select>  
                                    </div>   
                                </div>  
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Descuento</label>
                                        <input id="Descuento" class="form-control">
                                    </div>
                                </div>     
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">N° Proveedor</label>
                                        <input id="NoProveedor" class="form-control">
                                    </div>
                                </div>     
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Clave de AdminPaq</label>
                                        <input id="AdminPaq" class="form-control">
                                    </div>
                                </div>     
                            </div> 
                            <!-- ===================================== TERMINA EL SEGUNDO RENGLON =========================================== -->
                            <!-- ===================================== INICIA EL TERCER RENGLON =========================================== -->
                            <div class="form-row">   
                                <div class="col-md-4">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Paquetería</label>
                                        <select id="Paqueteria" class="form-control">
                                        </select>  
                                    </div>   
                                </div>  
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Cuenta Mensajería</label>
                                        <input id="CuentaMensajeria" class="form-control">
                                    </div>
                                </div>     
                                <input type="hidden" id="Access" class="form-control">
                                <div class="col-md-5">           
                                    <div class="position-relative form-group">
                                        <label for="exampleText" class="">Observaciones de la empresa</label>
                                        <textarea rows=1 name="Observaciones" id="Observaciones" class="form-control"></textarea>
                                    </div>  
                                </div>          
                            </div> 
                            <!-- ===================================== TERMINA EL TERCER RENGLON =========================================== -->
                        </div>
                    </div> <!-- TERMINA EL DIV main-card mb-3 card QUE CONTIENE TODO EL FORM DE EMPRESAS  -->
                    <!-- ================================================== AQUI INICIA EL CODIGO DE LAS DIRECCIONES ========================================================== -->
                    <div id="accordion" class="accordion-wrapper mb-3">
                        <div class="card">
                            <div id="headingThree" class="card-header">
                                <button type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                    <h5 class="m-0 p-0">Direcciones</h5>
                                </button>
                            </div>
                            <div data-parent="#accordion" id="collapseOne3" class="collapse">
                                <div class="card-body">
                                    <div class="card-header card-header-tab-animation">
                                        <ul class="nav nav-justified">
                                            <li class="nav-item"><a data-toggle="tab" href="#tab-eg115-0" class="active nav-link">Datos Fiscales</a></li>
                                            <li class="nav-item"><a data-toggle="tab" href="#tab-eg115-1" class="nav-link">Datos de Consignación</a></li>
                                            <li class="nav-item"><a data-toggle="tab" href="#tab-eg115-2" class="nav-link">Datos de Envío</a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-eg115-0" role="tabpanel"><!-- AQUI INICIA EL DIV DEL DATOS FISCALES -->
                                                <!-- ============================== INICIA EL PRIMER RENGLON ====================================================== -->
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Compañía</label>
                                                            <input type="text" class="form-control" id="CompaniaFiscal"/>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Dirección</label>
                                                            <input type="text" class="form-control" id="DireccionFiscal"/>
                                                        </div>
                                                    </div>    
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Código Postal</label>
                                                            <input type="text" class="form-control" id="CPFiscal"/>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Ciudad</label>
                                                            <input type="text" class="form-control" id="CiudadFiscal"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ============================== TERMINA EL PRIMER RENGLON ====================================================== -->
                                                <!-- ============================== INICIA EL SEGUNFO RENGLON ====================================================== -->
                                                <div class="form-row">
                                                    <div class="col-md-2" id="EstadoSelectFiscal">
                                                        <div class="position-relative form-group"> 
                                                            <label for="exampleSelect" class="">Estado</label>  
                                                            <select name="Estado" id="EstadoListFiscal" class="form-control">
                                                                <option value="Aguascalientes">Aguascalientes</option>
                                                                <option value="Baja California">Baja California</option>
                                                                <option value="Baja California Sur">Baja California Sur</option>
                                                                <option value="Campeche">Campeche</option>
                                                                <option value="Chiapas">Chiapas</option>
                                                                <option value="Chihuahua">Chihuahua</option>
                                                                <option value="Ciudad de México">Ciudad de México</option>
                                                                <option value="Coahuila">Coahuila</option>
                                                                <option value="Colima">Colima</option>
                                                                <option value="Durango">Durango</option>
                                                                <option value="Estado de México">Estado de México</option>
                                                                <option value="Guanajuato">Guanajuato</option>
                                                                <option value="Guerrero">Guerrero</option>
                                                                <option value="Hidalgo">Hidalgo</option>
                                                                <option value="Jalisco">Jalisco</option>
                                                                <option value="Michoacán">Michoacán</option>
                                                                <option value="Morelos">Morelos</option>
                                                                <option value="Nayarit">Nayarit</option>
                                                                <option value="Nuevo León">Nuevo León</option>
                                                                <option value="Oaxaca">Oaxaca</option>
                                                                <option value="Puebla">Puebla</option>
                                                                <option value="Querétaro">Querétaro</option>
                                                                <option value="Quintana Roo">Quintana Roo</option>
                                                                <option value="San Luis Potosí">San Luis Potosí</option>
                                                                <option value="Sinaloa">Sinaloa</option>
                                                                <option value="Sonora">Sonora</option>
                                                                <option value="Tabasco">Tabasco</option>
                                                                <option value="Tamaulipas">Tamaulipas</option>
                                                                <option value="Tlaxcala">Tlaxcala</option>
                                                                <option value="Veracruz">Veracruz</option>
                                                                <option value="Yucatán">Yucatán</option>
                                                                <option value="Zacatecas">Zacatecas</option>
                                                            </select> 
                                                        </div> 
                                                    </div>  
                                                    <div class="col-md-2" style="display: none;" id="EstadoFiscalOM">
                                                        <div class="position-relative form-group" >
                                                            <label for="exampleEmail11" class="">Estado</label>
                                                            <input type="text" class="form-control" id="EstadoFiscal"/>
                                                        </div>
                                                    </div>                                                            
                                                
                                                    <div class="col-md-2" style="display: none;" id="PaisFiscalOM">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">País</label>
                                                            <input type="text" class="form-control" id="PaisFiscal" value="México"/>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <div class="custom-checkbox custom-control">                            
                                                                <input type="checkbox" id="check" value="1"  class="custom-control-input" checked/>
                                                                <label class="custom-control-label" for="check">NACIONAL</label>
                                                            </div>   
                                                        </div>   
                                                    </div>                 
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <div class="custom-checkbox custom-control">                            
                                                                <input type="checkbox" id="checkconsig" value="0"  class="custom-control-input"/>
                                                                <label class="custom-control-label" for="checkconsig">Consignación</label>
                                                            </div>   
                                                        </div>   
                                                    </div>                 
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <div class="custom-checkbox custom-control">                            
                                                                <input type="checkbox" id="checkenvio" value="0"  class="custom-control-input"/>
                                                                <label class="custom-control-label" for="checkenvio">Envío</label>
                                                            </div>   
                                                        </div>   
                                                    </div>      
                                                </div>   
                                                <!-- ============================== TERMINA EL SEGUNDO RENGLON ====================================================== -->    
                                            </div><!-- AQUI TERMINA EL DIV DEL DATOS FISCALES -->
                                            <div class="tab-pane" id="tab-eg115-1" role="tabpanel"><!-- AQUI INICIA EL DIV DEL DATOS DE CONSIGNACION -->
                                                <!-- ============================== INICIA EL PRIMER RENGLON ====================================================== -->
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Compañía</label>
                                                            <input type="text" class="form-control" id="CompaniaConsig"/>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Dirección</label>
                                                            <input type="text" class="form-control" id="DireccionConsig"/>
                                                        </div>
                                                    </div>    
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Código Postal</label>
                                                            <input type="text" class="form-control" id="CPConsig"/>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Ciudad</label>
                                                            <input type="text" class="form-control" id="CiudadConsig"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ============================== TERMINA EL PRIMER RENGLON ====================================================== -->
                                                <!-- ============================== INICIA EL SEGUNFO RENGLON ====================================================== -->
                                                <div class="form-row">
                                                    <div class="col-md-2" id="EstadoSelectConsig">
                                                        <div class="position-relative form-group"> 
                                                            <label for="exampleSelect" class="">Estado</label>  
                                                            <select name="Estado" id="EstadoListConsig" class="form-control">
                                                                <option value="Aguascalientes">Aguascalientes</option>
                                                                <option value="Baja California">Baja California</option>
                                                                <option value="Baja California Sur">Baja California Sur</option>
                                                                <option value="Campeche">Campeche</option>
                                                                <option value="Chiapas">Chiapas</option>
                                                                <option value="Chihuahua">Chihuahua</option>
                                                                <option value="Ciudad de México">Ciudad de México</option>
                                                                <option value="Coahuila">Coahuila</option>
                                                                <option value="Colima">Colima</option>
                                                                <option value="Durango">Durango</option>
                                                                <option value="Estado de México">Estado de México</option>
                                                                <option value="Guanajuato">Guanajuato</option>
                                                                <option value="Guerrero">Guerrero</option>
                                                                <option value="Hidalgo">Hidalgo</option>
                                                                <option value="Jalisco">Jalisco</option>
                                                                <option value="Michoacán">Michoacán</option>
                                                                <option value="Morelos">Morelos</option>
                                                                <option value="Nayarit">Nayarit</option>
                                                                <option value="Nuevo León">Nuevo León</option>
                                                                <option value="Oaxaca">Oaxaca</option>
                                                                <option value="Puebla">Puebla</option>
                                                                <option value="Querétaro">Querétaro</option>
                                                                <option value="Quintana Roo">Quintana Roo</option>
                                                                <option value="San Luis Potosí">San Luis Potosí</option>
                                                                <option value="Sinaloa">Sinaloa</option>
                                                                <option value="Sonora">Sonora</option>
                                                                <option value="Tabasco">Tabasco</option>
                                                                <option value="Tamaulipas">Tamaulipas</option>
                                                                <option value="Tlaxcala">Tlaxcala</option>
                                                                <option value="Veracruz">Veracruz</option>
                                                                <option value="Yucatán">Yucatán</option>
                                                                <option value="Zacatecas">Zacatecas</option>
                                                            </select> 
                                                        </div> 
                                                    </div>  
                                                    <div class="col-md-2" style="display: none;" id="EstadoConsigOM">
                                                        <div class="position-relative form-group" >
                                                            <label for="exampleEmail11" class="">Estado</label>
                                                            <input type="text" class="form-control" id="EstadoConsig"/>
                                                        </div>
                                                    </div>                                                            
                                                
                                                    <div class="col-md-2" style="display: none;" id="PaisConsigOM">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">País</label>
                                                            <input type="text" class="form-control" id="PaisConsig" value="México"/>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <div class="custom-checkbox custom-control">                            
                                                                <input type="checkbox" id="check2" value="1"  class="custom-control-input" checked/>
                                                                <label class="custom-control-label" for="check2">NACIONAL</label>
                                                            </div>   
                                                        </div>   
                                                    </div>                 
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <div class="custom-checkbox custom-control">                            
                                                                <input type="checkbox" id="checkenvioC" value="0"  class="custom-control-input"/>
                                                                <label class="custom-control-label" for="checkenvioC">Envío</label>
                                                            </div>   
                                                        </div>   
                                                    </div>      
                                                </div>   
                                                <!-- ============================== TERMINA EL SEGUNDO RENGLON ====================================================== -->  
                                            </div><!-- AQUI TERMINA EL DIV DEL DATOS FISCALES -->
                                            <div class="tab-pane" id="tab-eg115-2" role="tabpanel"><!-- AQUI INICIA EL DIV DEL DATOS DE envio -->
                                                <!-- ============================== INICIA EL PRIMER RENGLON ====================================================== -->
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Compañía</label>
                                                            <input type="text" class="form-control" id="CompaniaEnvio"/>
                                                        </div>
                                                    </div>    
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Dirección</label>
                                                            <input type="text" class="form-control" id="DireccionEnvio"/>
                                                        </div>
                                                    </div>    
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Código Postal</label>
                                                            <input type="text" class="form-control" id="CPEnvio"/>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Ciudad</label>
                                                            <input type="text" class="form-control" id="CiudadEnvio"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ============================== TERMINA EL PRIMER RENGLON ====================================================== -->
                                                <!-- ============================== INICIA EL SEGUNFO RENGLON ====================================================== -->
                                                <div class="form-row">
                                                    <div class="col-md-2" id="EstadoSelectEnvio">
                                                        <div class="position-relative form-group"> 
                                                            <label for="exampleSelect" class="">Estado</label>  
                                                            <select name="Estado" id="EstadoListEnvio" class="form-control">
                                                                <option value="Aguascalientes">Aguascalientes</option>
                                                                <option value="Baja California">Baja California</option>
                                                                <option value="Baja California Sur">Baja California Sur</option>
                                                                <option value="Campeche">Campeche</option>
                                                                <option value="Chiapas">Chiapas</option>
                                                                <option value="Chihuahua">Chihuahua</option>
                                                                <option value="Ciudad de México">Ciudad de México</option>
                                                                <option value="Coahuila">Coahuila</option>
                                                                <option value="Colima">Colima</option>
                                                                <option value="Durango">Durango</option>
                                                                <option value="Estado de México">Estado de México</option>
                                                                <option value="Guanajuato">Guanajuato</option>
                                                                <option value="Guerrero">Guerrero</option>
                                                                <option value="Hidalgo">Hidalgo</option>
                                                                <option value="Jalisco">Jalisco</option>
                                                                <option value="Michoacán">Michoacán</option>
                                                                <option value="Morelos">Morelos</option>
                                                                <option value="Nayarit">Nayarit</option>
                                                                <option value="Nuevo León">Nuevo León</option>
                                                                <option value="Oaxaca">Oaxaca</option>
                                                                <option value="Puebla">Puebla</option>
                                                                <option value="Querétaro">Querétaro</option>
                                                                <option value="Quintana Roo">Quintana Roo</option>
                                                                <option value="San Luis Potosí">San Luis Potosí</option>
                                                                <option value="Sinaloa">Sinaloa</option>
                                                                <option value="Sonora">Sonora</option>
                                                                <option value="Tabasco">Tabasco</option>
                                                                <option value="Tamaulipas">Tamaulipas</option>
                                                                <option value="Tlaxcala">Tlaxcala</option>
                                                                <option value="Veracruz">Veracruz</option>
                                                                <option value="Yucatán">Yucatán</option>
                                                                <option value="Zacatecas">Zacatecas</option>
                                                            </select> 
                                                        </div> 
                                                    </div>  
                                                    <div class="col-md-2" style="display: none;" id="EstadoEnvioOM">
                                                        <div class="position-relative form-group" >
                                                            <label for="exampleEmail11" class="">Estado</label>
                                                            <input type="text" class="form-control" id="EstadoEnvio"/>
                                                        </div>
                                                    </div>                                                            
                                                
                                                    <div class="col-md-2" style="display: none;" id="PaisEnvioOM">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">País</label>
                                                            <input type="text" class="form-control" id="PaisEnvio" value="México"/>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <div class="custom-checkbox custom-control">                            
                                                                <input type="checkbox" id="check3" value="1"  class="custom-control-input" checked/>
                                                                <label class="custom-control-label" for="check3">NACIONAL</label>
                                                            </div>   
                                                        </div>   
                                                    </div>     
                                                </div>   
                                                <!-- ============================== TERMINA EL SEGUNDO RENGLON ====================================================== -->
                                            </div><!-- AQUI TERMINA EL DIV DEL DATOS DE ENVIO -->
                                        </div>
                                    </div>
                                    <button type="button" class="mt-2 btn btn-primary float-right btnGuardar" id="btn_nuevo_0">Guardar</button> 
                                    <button type="button" class="mt-2 btn btn-primary float-right btnEditarG" style="display: none;">Editar</button> 
                                </div>
                            </div>
                        </div>
                    </div>  
                    <!-- ================================================== AQUI TERMINA EL CODIGO DE LAS DIRECCIONES ========================================================== -->     
                </form>
            </div><!-- TERMINA EL DIV tab-pane tabs-animation fade show active QUE CONTIENE LOS DOS TABS -->
            <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div  class="main-card mb-3 card">
                    <div id="div_registros" class="card-body">
                        <!-- <table id="example" class="table table-bordered table-striped"> -->
                        <table id="table_registros" class="table table-bordered table-striped dataTable">
                            <thead>
                            <tr>
                                <th>Clave Empresa</th>
                                <th>Razón Social</th>
                                <th>RFC</th>
                                <th>Crédito</th>
                                <th>N° Proveedor</th>
                                <th>Clave de AdminPaq</th>
                                <th>Observaciones de la empresa</th>
                                <th>Editar</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>  
            </div>  
            <!-- Codigo para la animacion de cargado -->
            <div class="loader-wrapper d-flex justify-content-center align-items-center">
                <div class="loader">
                    <div class="line-scale-pulse-out">
                        <!--cada div es una linea de la animacion-->
                        <div></div>
                        <div></div> 
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div><!-- AQUI TERMINA EL DIV DEL TAB -->
    </div>
</div>
   
    <?php include_once("footer.php");?>