<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<link rel="stylesheet" href="dist/css/base.css">
<script src="plugins/datatables/jquery.dataTablesN.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script> 

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-map-marker icon-gradient bg-sunny-morning">
                        </i>
                    </div>
                    <div>Servicios de Logística
                        <div class="page-title-subheading">Crea y modifica los servicios de logística ofertados por Metas SA. de CV.
                        </div>
                    </div>
                </div>
            </div>
        </div>            
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Nuevo</span>
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
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Informacion General del Servicio de Logística</h5>
                        <form id="signupForm">
                            <!-- ====================================== PRIMER RENGLON =========================================== -->
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">N° de Catálogo</label>
                                        <input type="text" class="form-control" id="NoCatalogo" required/>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">Descripción del Servicio</label>
                                        <input type="text" class="form-control" id="Descripcion" required/>
                                    </div>
                                </div>
                            </div>
                            <!-- ================================================================================================== -->
                            <!-- ====================================== sEGUNDO RENGLON =========================================== -->
                            <div class="form-row">              
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleText" class="">Referencia</label>
                                        <textarea id="Referencia" class="form-control"></textarea>
                                    </div>
                                </div>      
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleText" class="">Observaciones</label>
                                        <textarea id="Observaciones" class="form-control"></textarea>
                                    </div>
                                </div>      
                            </div> 
                            <!-- ================================================================================================== -->
                            <!-- ====================================== TERCER RENGLON =========================================== -->
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Unidad</label>
                                        <input type="text" class="form-control" id="Unidad" required/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">Precio Base</label>
                                        <input type="text" class="form-control" id="Precio" required/>
                                    </div>
                                </div>
                            </div>
                            <!-- ================================================================================================== -->
                            <button type="button" class="mt-2 btn btn-primary btnGuardar" id="btn_nuevo_0">Guardar</button> 
                            <button type="button" class="mt-2 btn btn-primary btnEditarG" >Editar</button> 
                        </form>
                    </div>
                </div>
            </div>
            <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div  class="main-card mb-3 card">
                    <div id="div_registros" class="card-body">
                        <!-- <table id="example" class="table table-bordered table-striped"> -->
                        <table id="table_registros" class="table table-bordered table-striped dataTable">
                            <thead>
                            <tr>
                                <th>N° Catálogo</th>
                                <th>Descripción del Servicio</th>
                                <th>Referencia</th>
                                <th>Unidad</th>
                                <th>Precio Base</th>
                                <th>Observaciones</th>
                                <th>Editar</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
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
</div>
    <script src="dist/js/servicios_logistica.js"></script>
    <?php include_once("footer.php");?>