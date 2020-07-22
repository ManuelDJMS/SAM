<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!--=============================== SCRIPTS DE ACCIONES ================================ -->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.min.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script> 
<script src="dist/js/cotizacion_transfer.js"></script>
<!-- =================================================================================== -->
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <button class="mb-2 mr-2 btn-pill btn btn-dashed btn-outline-link float-right start-tour">Tutorial</button>
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-shuffle icon-gradient bg-arielle-smile">
                        </i>
                    </div>
                    <div>Cotizador Transfer
                        <div class="page-title-subheading">Transfiere las cotizaciones realizadas en Metas SA. de CV. en años anteriores.
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Búsqueda</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1" style="display: none;">
                    <span>Información Específica</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <!-- ============================ CONSULTA DE CONTACTOS A COTIZAR ========================= -->
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
                                    <th>Clave Empresa</th>
                                    <th>Empresa</th>
                                    <th>RFC</th>
                                    <th>Dirección</th>
                                    <th>Contacto</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div>
                <!--  -->
                <div class="row" id="EditarDirecciones">
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <!-- ==================== PRIMEROS DARTOS DEL CONTACTO ================================== -->
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon pe-7s-back-2 icon-gradient bg-happy-itmeo"> </i>
                                    Realizar Por
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="position-relative form-group">
                                    <div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="exampleCustomRadio" name="realizado" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="exampleCustomRadio">Cotizaciones</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="exampleCustomRadio2" name="realizado" class="custom-control-input">
                                            <label class="custom-control-label" for="exampleCustomRadio2">Folio</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="exampleCustomRadio3" name="realizado" class="custom-control-input">
                                            <label class="custom-control-label" for="exampleCustomRadio3">N° Cotización</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ==================================================================================== -->
                    </div>
                    <!-- ============================ CONSULTA DE CONTACTOS A COTIZAR ========================= -->
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="mb-3 card" data-step="1" data-intro="Selecciona un cliente!">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon pe-7s-date mr-3 icon-gradient bg-happy-itmeo"> </i>
                                    Año
                                </div>
                            </div>
                            <div id="div_contactos" class="card-body">
                                <div class="position-relative form-group">
                                    <div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="anio2019" name="anio" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="2019">2019</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="anio2018" name="anio" class="custom-control-input">
                                            <label class="custom-control-label" for="2018">2018</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="anio2017" name="anio" class="custom-control-input">
                                            <label class="custom-control-label" for="2017">2017</label>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                    <!-- ======================================================================================================== -->
                    <!-- ============================ CONSULTA DE CONTACTOS A COTIZAR ========================= -->
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <div class="mb-3 card" data-step="1" data-intro="Selecciona un cliente!">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon pe-7s-albums mr-3 icon-gradient bg-happy-itmeo"> </i>
                                    Anual
                                </div>
                            </div>
                            <div id="div_contactos" class="card-body">
                                <div class="position-relative form-group">
                                    <div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="Cot" name="anual" class="custom-control-input">
                                            <label class="custom-control-label" for="Cot">Cotización</label>
                                        </div>
                                        <div class="custom-radio custom-control custom-control-inline">
                                            <input type="radio" id="folio" name="anual" class="custom-control-input">
                                            <label class="custom-control-label" for="folio">Folio</label>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                    <!-- ======================================================================================================== -->
                </div>
                 <!-- ============================ CONSULTA DE CONTACTOS A COTIZAR ========================= -->
                 <div class="mb-3 card" data-step="1" data-intro="Selecciona un cliente!">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-note2 mr-3 icon-gradient bg-happy-itmeo"> </i>
                            Cotizaciones
                        </div>
                    </div>
                    <div id="div_Cots" class="card-body">
                        <table style="width: 100%;" id="table_Cots" class="table table-hover table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>NumCot</th>
                                    <th>Empresa</th>
                                    <th>Fecha</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>ID</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div>
                <!--  -->
            </div>
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