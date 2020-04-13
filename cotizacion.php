<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<!-- <link rel="stylesheet" href="dist/css/base.css">
<link rel="stylesheet" href="dist/css/base1.css"> -->
<script src="plugins/datatables/jquery.dataTablesN.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script> 
<script src="dist/js/cotizacion.js"></script>
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
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
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
                                                    <h5 class="menu-header-title" id="NombreContacto">
                                                        <!-- Manuel de Jesús Morales Sánchez -->
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
                                                                <!-- 12 -->
                                                            </b> 
                                                        </span>
                                                    </h5>
                                                    <h5 class="widget-heading opacity-4" id="EmailContacto">
                                                        <!-- correo -->
                                                    </h5>
                                                    <h5 class="widget-heading opacity-4" id="TelefonoContacto">
                                                        <!-- telefono -->
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
                                <table id="table_contactos" class="table table-hover table-bordered table-striped dataTable">
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
                        <table id="table_articulos" class="table table-hover table-bordered table-striped dataTable">
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
                <!--  -->
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
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                                <div class="widget-subheading opacity-10">
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            Contacto:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                </div>
                                                 <!-- <div class="divider"></div> -->
                                                <div class="widget-subheading opacity-10">
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            RFC:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                </div>
                                                <div class="divider"></div>

                                                <div class="widget-subheading opacity-10">
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            Domicilio:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="widget-subheading opacity-10">
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            Código Postal:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            Código Postal33:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="widget-subheading opacity-10">
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            Domicilio:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="widget-subheading opacity-10">
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            Domicilio:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="widget-subheading opacity-10">
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            Domicilio:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="widget-subheading opacity-10">
                                                    <span class="pr-2">
                                                        <b class="text-dark">
                                                            Domicilio:
                                                        </b> 
                                                        Manuel de Jesus morales Sanchez
                                                    </span>
                                                </div>
                                                <div class="divider"></div>

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
                                <table id="table_contactos" class="table table-hover table-bordered table-striped dataTable">
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
                        <table id="table_articulos" class="table table-hover table-bordered table-striped dataTable">
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