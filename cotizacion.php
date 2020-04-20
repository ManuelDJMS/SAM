<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!--=============================== SCRIPTS DE ACCIONES ================================ -->
<script src="plugins/datatables/jquery.dataTablesN.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="dist/js/cotizacion.js"></script>
<!-- =================================================================================== -->
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
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
            <!-- <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                    <span>Información Específica</span>
                </a>
            </li> -->
        </ul>
        <!-- <div class="divider"></div> -->
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
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link"><i class="pe-7s-display1 btn-icon-wrapper btn-icon-lg mb-3"> </i>Historial de cotizaciones</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="nav flex-column">
                                        <li class="nav-item-btn text-center pt-4 pb-3 nav-item">
                                            <button class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-success btnCotizacion" id="btn_nuevo_0">
                                                Crear Cotización
                                            </button>
                                            <!-- <button class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-info btnGuardarGD" style="display: none;">
                                                Guardar
                                            </button> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- ==================================================================================== -->
                    </div>
                    <!-- ============================ CONSULTA DE CONTACTOS A COTIZAR ========================= -->
                    <div class="col-md-12 col-lg-6 col-xl-8">
                        <div class="mb-3 card">
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
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-cart mr-3 icon-gradient bg-happy-itmeo"> </i>
                            Catálogo de Artículos
                        </div>
                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                            <button type="button" class="btn-icon btn-icon-only btn btn-link" id="ObtenerArticulos">
                                <i class="pe-7s-timer btn-icon-wrapper"></i>
                            </button>
                        </div>
                    </div>
                    <div id="div_articulos" class="card-body">
                        <table style="width: 100%;" id="table_articulos" class="table table-hover table-bordered table-striped dataTable">
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
                <!-- <div class="main-card mb-3 card">
                    <div id="div_registros" class="card-body">
                        <table id="table_registros" class="table table-hover table-bordered table-striped dataTable">
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
                    </div>
                </div>   -->
                <!-- ============================= DATOS COMPLETOS DEL CLIENTE A COTIZAR ============================ -->
                <div class="row" id="EditarDirecciones">
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon pe-7s-user icon-gradient bg-happy-itmeo"> </i>
                                    Información del Cliente
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-line-primary profile-responsive card-border mb-3 card">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-info">
                                            <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/city2.jpg');"></div>
                                            <div class="menu-header-content">
                                                <div>
                                                    <h5 class="menu-header-title" id="EmpresaContactoCot">
                                                        <!-- Manuel de Jesús Morales Sánchez -->
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" id="InformacionContacto">
                                        <p class="text-muted" id="ContactoCot">
                                            <b class="text-dark" id="ContactoB" value="hola"> 
                                                Contacto:
                                            </b> 
                                            <!-- Manuel de Jesus Morales Sanchez. -->
                                        </p>
                                        <p class="text-muted" id="DomicilioCot">
                                            <b class="text-dark">
                                                Domicilio:
                                            </b> 
                                            <!-- Av. Insurgentes 245 Col. Nogales. -->
                                        </p>
                                        <p class="text-muted" id="CPCot">
                                            <b class="text-dark">
                                                Código Postal:
                                            </b> 
                                            <!-- 49000. -->
                                        </p>
                                        <p class="text-muted" id="CiudadCot">
                                            <b class="text-dark">
                                                Ciudad:
                                            </b> 
                                            <!-- Ciudad Guzman. -->
                                        </p>
                                        <p class="text-muted" id="TelefonoCot">
                                            <b class="text-dark">
                                                Teléfono:
                                            </b> 
                                            <!-- 3411621032. -->
                                        </p>
                                        <p class="text-muted" id="EmailCot">
                                            <b class="text-dark">
                                                Email:
                                            </b> 
                                            <!-- manueldjmsanchez@gmail.com -->
                                        </p>
                                    </div>
                                   
                                    <ul class="nav flex-column">
                                        <li class="nav-item-btn text-center pt-4 pb-3 nav-item">
                                            <!-- <button class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-success btnCotizacion" id="btn_nuevo_0">
                                                Crear Cotización
                                            </button> -->
                                            <button class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-info" id="Prueba">
                                                Guardar
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================ DATOS GENERALES DE LA COTIZACION ========================= -->
                    <div class="col-md-12 col-lg-6 col-xl-8">
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon pe-7s-id mr-3 icon-gradient bg-happy-itmeo"> </i>
                                    Datos de Cotización
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- ===================================== INICIA EL PRIMER RENGLON =========================================== -->
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Vigencia</label>
                                        <input type="text" class="form-control" name="daterange">
                                    </div>
                                </div>
                                <div class="col-md-8">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Tiempo de Entrega</label>
                                        <select id="TiempoEntrega" class="form-control">
                                        </select>  
                                    </div>   
                                </div>  
                            </div>
                            <!-- ===================================== TERMINA EL PRIMER RENGLON =========================================== -->
                            <!-- ===================================== INICIA EL SEGUNDO RENGLON =========================================== -->
                            <div class="form-row">
                                <div class="col-md-12">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Términos de Pago </label>
                                        <select id="TerminosPago" class="form-control">
                                        </select>  
                                    </div>   
                                </div>  
                            </div>
                            <!-- ===================================== TERMINA EL SEGUNDO RENGLON =========================================== -->
                            <!-- ===================================== INICIA EL TERCER RENGLON =========================================== -->
                            <div class="form-row">
                                <div class="col-md-7">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Lugar de Servicio </label>
                                        <select id="LugarServicio" class="form-control">
                                        </select>  
                                    </div>   
                                </div>  
                                <div class="col-md-5">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Modalidad </label>
                                        <select id="Modalidad" class="form-control">
                                        </select>  
                                    </div>   
                                </div>  
                            </div>
                            <!-- ===================================== TERMINA EL TERCER RENGLON =========================================== -->
                            <!-- ===================================== INICIA EL CUARTO RENGLON =========================================== -->
                            <div class="form-row">
                                <div class="col-md-3">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Precios </label>
                                        <select id="Precios" class="form-control">
                                        </select>  
                                    </div>   
                                </div>  
                                <div class="col-md-4">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Referencia </label>
                                        <textarea rows=2 name="Observaciones" id="Referencia" class="form-control"></textarea>
                                    </div>   
                                </div>  
                                <div class="col-md-5">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Observaciones </label>
                                        <textarea rows=2 id="Observaciones" class="form-control">*La cotización fué realizada en base a la información recibida. Cualquier diferencia entre su solicitud y esta cotización contactar a Ventas*
                                        </textarea>
                                    </div>   
                                </div>  
                            </div>
                            <!-- ===================================== TERMINA EL CUARTO RENGLON =========================================== -->
                            <button type="button" class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-success float-right btnGuardar" id="btn_nuevo_0">Guardar</button> 
                            <button type="button" class="mb-2 mr-2 btn-pill btn-transition btn btn-outline-danger float-right btnCancelar">Cancelar</button>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                    <!-- ======================================================================================================== -->
                </div>
                <!-- ================================================================================================ -->
                <!-- ============================ CONSULTA DE CATALOGOS DE ARTICULOS ========================= -->
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-cart mr-3 icon-gradient bg-happy-itmeo"> </i>
                            Catálogo de Artículos
                        </div>
                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                            <button type="button" class="btn-icon btn-icon-only btn btn-link" id="ObtenerArticulos">
                                <i class="pe-7s-timer btn-icon-wrapper"></i>
                            </button>
                        </div>
                    </div>
                    <div id="div_articulosCot" class="card-body">
                        <table style="width: 100%;" id="articulosCot" class="display table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Partida</th>
                                    <th>SKU</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Cantidad</th>
                                    <th>Observaciones</th>
                                    <th>N° Inventario</th>
                                    <th>N° Serie</th>
                                    <th>Observaciones del Servicio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                      
                        </table>
                    </div><!-- /.card-body -->
                </div>
                <!-- =============================================================================================== -->
                <!--  -->
            </div>  
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