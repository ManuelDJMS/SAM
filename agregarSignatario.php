<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<link rel="stylesheet" href="dist/css/base.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script> 

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="lnr-bold icon-gradient bg-love-kiss">
                        </i>
                    </div>
                    <div>Signatarios de Laboratorio
                        <div class="page-title-subheading">Administra los signtarios asignados a cada laboratorio y unidad de negocio.
                        </div>
                    </div>
                </div>
            </div>
        </div>            
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Agregar</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Consultar</span>
                </a>
            </li>
        </ul>
          <!-- ===================================AQUI EMPIEZA EL CODIGO PARA AGREGAR SIGNATARIO====================================================================== -->
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="signupForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <div id="div_registros" class="box-body">
                                                <table id="example1" class="table table-bordered table-striped dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Id Unidad</th>
                                                            <th>Unidad Negocio</th>
                                                            <th>Laboratorio</th>
                                                            <th>Seleccionar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div><!-- /.box-body -->
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <div class="mb-2 mr-2 badge badge-primary">Unidad de Negocio</div>
                                                <div  id="UnidadNegocio" name="UnidadNegocio">Unidad Negocio</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <div class="mb-2 mr-2 badge badge-secondary">Laboratorio</div>
                                                <div id="Laboratorio" name="Laboratorio">Laboratorio</div>
                                            </div>
                                        </div>   
                                        <div class="col-md-2">
                                            <div class="position-relative form-group">
                                                <input name="idUnidadNegocio" id="idUnidadNegocio" class="form-control">        
                                            </div>
                                        </div>
                                    </div>
                                    <label for="idUsuario" class="col-sm-2 control-label">Empleado</label>
                                        <div class="col-sm-6">
                                        <select type="select" id="idUsuario" name="idUsuario" class="custom-select"></select>
                                        </div>
                                </div>
                            </div>    
                            <button type="button" class="mt-2 btn btn-primary btnGuardar" id="btn_nuevo_0">Guardar</button> 
                            <button type="button" class="mt-2 btn btn-primary btnEditarG" >Editar</button>        
                        </form>
                    </div>
                </div>
            </div>
            <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div  class="main-card mb-3 card">
                    <div id="div_registros1" class="box-body">
                        <table id="example3" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Id Usuario</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Unidad Negocio</th>
                                    <th>Laboratorio</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>  
            </div>
        <script src="dist/js/agregarSignatario.js"></script>
        <?php include_once("footer.php");?>
    </div>
</div>    