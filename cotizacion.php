<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!--=============================== SCRIPTS DE ACCIONES ================================ -->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.min.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script> 
<script src="dist/js/cotizacion.js"></script>
<!-- =================================================================================== -->
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <button class="mb-2 mr-2 btn-pill btn btn-dashed btn-outline-link float-right start-tour">Tutorial</button>
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-arielle-smile">
                        </i>
                    </div>
                    <div>Cotizaciones
                        <div class="page-title-subheading">Crea y modifica las cotizaciones realizadas en Metas SA. de CV.
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Información General</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1" style="display: none;">
                    <span>Información Específica</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2" data-step="7" data-intro="Si no encuentras ningún artículo en los catálogos de LIMS o SAM pueder ver el historial de cotizaciones de ACCESS" data-scrollTo='tooltip' data-position='left'>
                    <span>Historial General de Cotizaciones</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-3" data-toggle="tab" href="#tab-content-3" style="display: none;">
                    <span>Cotizaciones</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="row" id="EditarDirecciones">
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <!-- ==================== PRIMEROS DARTOS DEL CONTACTO ================================== -->
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon pe-7s-user icon-gradient bg-happy-itmeo"> </i>
                                    Contacto
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-line-primary profile-responsive card-border mb-3 card">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-info">
                                            <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/city2.jpg');"></div>
                                            <div class="menu-header-content">
                                                <div>
                                                    <h5 class="menu-header-title Nombre" id="NombreContacto_No">
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="widget-content">
                                                <div class="text-center">
                                                    <h5>
                                                        <span class="pr-2">
                                                            <b class="text-info" id="EmpresaContacto">
                                                            </b> 
                                                        </span>
                                                    </h5>
                                                    <h5 class="widget-heading opacity-4" id="EmailContacto">
                                                    </h5>
                                                    <h5 class="widget-heading opacity-4" id="TelefonoContacto">
                                                    </h5>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="p-0 list-group-item">
                                            <div class="grid-menu grid-menu-2col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-6">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link"><i class="lnr-license btn-icon-wrapper btn-icon-lg mb-3"> </i>Ver detalles</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" id="CotSAM"><i class="pe-7s-display1 btn-icon-wrapper btn-icon-lg mb-3"> </i>Historial de cotizaciones</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-btn text-center pt-4 pb-3 nav-item">
                                            <button class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-success btnCotizacion" id="btn_nuevo_0" data-step="4" data-intro="Presiona el botón para pasar a los términos de la cotización" data-scrollTo='tooltip' data-position='left'>
                                                Crear Cotización
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- ==================================================================================== -->
                    </div>
                    <!-- ============================ CONSULTA DE CONTACTOS A COTIZAR ========================= -->
                    <div class="col-md-12 col-lg-6 col-xl-8">
                        <div class="mb-3 card" data-step="1" data-intro="Selecciona un cliente!">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon pe-7s-id mr-3 icon-gradient bg-happy-itmeo"> </i>
                                    Contacto a Cotizar
                                </div>
                            </div>
                            <div id="div_contactos" class="card-body">
                                <table style="width: 100%;" id="table_contactos" class="table table-hover table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Compañia</th>
                                            <th>RFC</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Seleccionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                    <!-- ======================================================================================================== -->
                </div>
                <!-- ============================ CONSULTA DE CATALOGOS DE ARTICULOS ========================= -->
                <div class="mb-3 card">
                    <div class="card-header-tab card-header" data-step="2" data-intro="Selecciona la base de datos de la cual se obtendrán los catálogos" data-scrollTo='tooltip' data-position='left'>
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-cart mr-3 icon-gradient bg-happy-itmeo"> </i>
                            Catálogo de Artículos
                        </div>
                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                            <input type="checkbox" checked data-toggle="toggle" data-on="LIMS" data-off="ACCESS" data-onstyle="success" data-offstyle="info" data-size="small" id="Origen_Catalogos" value="1">
                            <button type="button" class="btn-icon btn-icon-only btn btn-link" id="ObtenerArticulos">
                                <i class="pe-7s-timer btn-icon-wrapper"></i>
                            </button>
                        </div>
                    </div>
                    <div id="div_articulos" class="card-body" data-step="3" data-intro="Selecciona los artículos a cotizar" data-scrollTo='tooltip' data-position='left'>
                        <table style="width: 100%;" id="table_articulos" class="table table-hover table-bordered table-striped dataTable" >
                            <thead>
                                <tr>
                                    <th>N° de Artículo (SKU)</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Descripción del Servicio</th>
                                    <th>Elegir</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div>
                <!-- =============================================================================================== -->
            </div><!-- TERMINA EL DIV tab-pane tabs-animation fade show active QUE CONTIENE LOS DOS TABS -->
            <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <!-- ============================= DATOS COMPLETOS DEL CLIENTE A COTIZAR ============================ -->
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-success border-success card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers opacity-5 fsize-1 mb-0 w-100">Empresa</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="EmpresaCot">
                                                <!-- Asociación Mexicana De La Industria Del Concreto Premezclado, A.C. -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-primary border-primary card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers opacity-5 fsize-1 mb-0 w-100">Contacto</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="ContactoCot">
                                                <!-- Manuel de Jesus Miorales Sanchez -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-success border-success card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers opacity-5 fsize-1 mb-0 w-100">Código Postal</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="CpCot">
                                                <!-- <small class="text-success pr-1">+</small> -->
                                                <!-- 34 -->
                                                <!-- <small class="opacity-5 pl-1">Cots</small> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-success border-success card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers opacity-5 fsize-1 mb-0 w-100">Domicilio</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="DomicilioCot">
                                                <!-- Asociación Mexicana De La Industria Del Concreto Premezclado, A.C. -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-primary border-primary card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers opacity-5 fsize-1 mb-0 w-100">Email</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="EmailCot">
                                                <!-- Manuel de Jesus Miorales Sanchez -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-success border-success card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers opacity-5 fsize-1 mb-0 w-100">Teléfono</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="TelefonoCot">
                                                <!-- <small class="text-success pr-1">+</small>
                                                34
                                                <small class="opacity-5 pl-1">Cots</small> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================ DATOS GENERALES DE LA COTIZACION ========================= -->
                <div class="mb-3 card" data-step="5" data-intro="Selecciona las condiciones que llevará la cotización" data-scrollTo='tooltip' data-position='left'>
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-id mr-3 icon-gradient bg-happy-itmeo"> </i>
                            Datos de Cotización
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- ===================================== INICIA EL PRIMER RENGLON =========================================== -->
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Vigencia</label>
                                    <input type="text" class="form-control" name="daterange" id="Vigencia">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">           
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Tiempo de Entrega</label>
                                    <select id="TiempoEntrega" class="form-control">
                                    </select>  
                                </div>   
                            </div>   -->
                            <div class="col-md-4">           
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Modalidad </label>
                                    <select id="Modalidad" class="form-control">
                                    </select>  
                                </div>   
                            </div>  
                            <div class="col-md-5">           
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Lugar de Servicio </label>
                                    <select id="LugarServicio" class="form-control">
                                    </select>  
                                </div>   
                            </div> 
                        </div>
                        <!-- ===================================== TERMINA EL PRIMER RENGLON =========================================== -->
                        <!-- ===================================== INICIA EL SEGUNDO RENGLON =========================================== -->
                        <div class="form-row">
                            <div class="col-md-10">           
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Términos de Pago </label>
                                    <select id="TerminosPago" class="form-control">
                                    </select>  
                                </div>   
                            </div>  
                            <div class="col-md-2">           
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Precios </label>
                                    <select id="Precios" class="form-control">
                                    </select>  
                                </div>   
                            </div>  
                        </div>
                        <!-- ===================================== TERMINA EL SEGUNDO RENGLON =========================================== -->
                        <!-- ===================================== INICIA EL TERCER RENGLON =========================================== -->
                        <div class="form-row">
                            <div class="col-md-5">           
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Referencia </label>
                                    <input id="Referencia" class="form-control">
                                </div>   
                            </div> 
                            <div class="col-md-7">           
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Observaciones </label>
                                    <textarea rows=1 id="ObservacionesCot" class="form-control">*La cotización fué realizada en base a la información recibida. Cualquier diferencia entre su solicitud y esta cotización contactar a Ventas*
                                    </textarea>
                                </div>  
                            </div>  
                        </div>
                        <!-- ===================================== TERMINA EL TERCER RENGLON =========================================== -->
                        <button type="button" class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-success float-right btnGuardar" id="btn_nuevo_0" >Guardar</button> 
                        <button type="button" class="mb-2 mr-2 btn-pill btn-transition btn btn-outline-danger float-right btnCancelar">Cancelar</button> 
                    </div><!-- /.card-body -->
                </div>
                <!-- ======================================================================================================== -->
                <!-- ============================ CONSULTA DE CATALOGOS DE ARTICULOS ========================= -->
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-cart mr-3 icon-gradient bg-happy-itmeo"> </i>
                            Partidas
                        </div>
                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                            <input id="Enter" class="form-control" placeholder="Ingresa SKU, OV, COT" data-step="6" data-intro="Si sabes el SKU de algún artículo puedes ingresarlo y automaticamente se agrega a las partidas de la cotización" data-scrollTo='tooltip' data-position='left'>
                        </div>
                    </div>
                    
                    <div id="div_articulosCot" class="card-body">
                        <table style="width: 100%;" id="articulosCot" class="display table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Cantidad</th>
                                    <th>Observaciones</th>
                                    <th>N° Inventario</th>
                                    <th>N° Serie</th>
                                    <th>Observaciones del Servicio</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                      
                        </table>
                    </div>
                </div>
            </div>  
            <!-- ================================== INICIA LA COTIZACION GENERAL DE ACCES DE LAS COTIZACIONES =================================================== -->
            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header" data-step="8" data-intro="Selecciona un rango de años" data-scrollTo='tooltip' data-position='left'>
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-id mr-3 icon-gradient bg-happy-itmeo"> </i>
                            Seleccionar Años
                        </div>
                        <div class="btn-actions-pane-right">
                            <form class="form-inline">
                                <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                    <label for="exampleEmail22" class="mr-sm-2">De</label>
                                    <select id="De" class="form-control">
                                        <option>2019</option>
                                        <option>2018</option>
                                        <option>2017</option>
                                        <option>2016</option>
                                        <option>2015</option>
                                        <option>2014</option>
                                        <option>2013</option>
                                        <option>2012</option>
                                        <option>2011</option>
                                        <option>2010</option>
                                        <option>2009</option>
                                        <option>2008</option>
                                        <option>2007</option>
                                    </select> 
                                </div>
                                <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                    <label for="examplePassword22" class="mr-sm-2">A</label>
                                    <select id="A" class="form-control">
                                        <option>2019</option>
                                        <option>2018</option>
                                        <option>2017</option>
                                        <option>2016</option>
                                        <option>2015</option>
                                        <option>2014</option>
                                        <option>2013</option>
                                        <option>2012</option>
                                        <option>2011</option>
                                        <option>2010</option>
                                        <option>2009</option>
                                        <option>2008</option>
                                        <option>2007</option>
                                    </select> 
                                </div>
                                <button type="button" class="btn-hover-shine btn btn-shadow btn-success" id="CargarCot">Cargar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="main-card mb-3 card">
                    <div id="div_historialcots" class="card-body" data-step="9" data-intro="Al igual que en la tablas anteriores selecciona los artículos que desees cotizar" data-scrollTo='tooltip' data-position='left'>
                        <table id="table_historialcots" class="table table-hover table-bordered table-striped dataTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NumCot</th>
                                    <th>Clave Empresa</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Ser-Catálogo</th>
                                    <th>Partida</th>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Alcance</th>
                                    <th>Id</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>  
            <!-- ================================== INICIA EL HISTORIAL DE COTIZACIONES SAM =================================================== -->
            <div class="tab-pane tabs-animation fade show" id="tab-content-3" role="tabpanel">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-primary border-primary card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-title opacity-5 text-uppercase">Empresa</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="EmpresaCotH">
                                                <!-- Asociación Mexicana De La Industria Del Concreto Premezclado, A.C. -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-danger border-danger card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-title opacity-5 text-uppercase">Contacto</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="ContactoCotH">
                                                <!-- Manuel de Jesus Miorales Sanchez -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-success border-success card">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content">
                                    <div class="widget-title opacity-5 text-uppercase">Cotizaciones</div>
                                    <div class="widget-numbers mt-2 fsize-1 mb-0 w-100">
                                        <div class="widget-chart-flex align-items-center">
                                            <div id="CotizacionesCotH">
                                                <small class="text-success pr-1">+</small>
                                                <!-- 34 -->
                                                <small class="opacity-5 pl-1">Cots</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ==================================================== TABLA QUE CONTIENE EL HISTORIAL DE COTIZACIONES DE CONTACTOS SAM ?================================================================== -->
                <div class="mb-3 card">
                    <div class="card-header-tab card-header" data-step="2" data-intro="Selecciona la base de datos de la cual se obtendrán los catálogos" data-scrollTo='tooltip' data-position='left'>
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-cart mr-3 icon-gradient bg-happy-itmeo"> </i>
                            Cotizaciones
                        </div>
                    </div>
                    <div id="div_historialSAM" class="card-body">
                        <table style="width: 100%;" id="table_HistorialSAM" class="table table-hover table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th>NumCot</th>
                                    <th>Partida</th>
                                    <th>ItemNumber</th>
                                    <th>Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>ID</th>
                                    <th>Serie</th>
                                    <th>Descripcion del Servicio</th>
                                    <th>Observaciones</th>
                                    <th>Observacion del Servicio</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- =============================================================================================== -->
            </div>  
            <!-- ================================== TERMINA LA COTIZACION GENERAL DE ACCES DE LAS COTIZACIONES =================================================== -->
            <!-- ===================================AQUI TERMINA EL CODIGO DE LAS COSULTAS ====================================================================== -->
        </div><!-- AQUI TERMINA EL DIV DEL TAB -->
    </div>
</div>
<div class="preloader" style="display: none;">
    <span class="loader"></span>
    <div class="loader2">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<?php include_once("footer.php");?>