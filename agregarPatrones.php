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
                        <i class="lnr-screen icon-gradient bg-love-kiss">
                        </i>
                    </div>
                    <div>Patrones por laboratorio
                        <div class="page-title-subheading">Administra los patrones asignados a cada laboratorio y unidad de negocio.
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
         </ul>
          <!-- ===================================AQUI EMPIEZA EL CODIGO PARA AGREGAR SIGNATARIO====================================================================== -->
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="signupForm">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body"><h5 class="card-title">LISTA DE PATRONES</h5>
                                            <div id="div_registros1" class="box-body">
                                                <table id="example3" class="table table-bordered table-striped dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Patrón</th>
                                                            <th>Status</th>
                                                            <th>Unidad Negocio</th>
                                                            <th>ProximaCalibracion</th>
                                                            <th>Editar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.box-body -->
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body"><h5 class="card-title" >AGREGAR NUEVO PATRON</h5>  
                                            <label for="Patron" class="col-sm-4 control-label">Patrón</label>
                                            <label for="Patron" id="id" class="col-sm-4 control-label" >Patron</label>
                                                <div class="col-sm-8">
                                                    <select type="select" id="Patron" name="Patron" class="custom-select"></select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="position-relative form-group">
                                                        <input type="text" class="form-control" id="PatronE" name="PatonE" placeholder="" readonly="readonly"/>
                                                    </div>
                                                </div>    
                                            <label for="Lab" class="col-sm-4 control-label">Laboratorio</label>
                                                <div class="col-sm-6">
                                                    <select type="select" id="Lab" name="Lab" class="custom-select"></select>
                                                </div>
                                        </div>  
                                    </div>
                                    <button type="button" class="mt-2 btn btn-primary float-right btnGuardar" id="btn_nuevo_0">Guardar</button>
                                    <button type="button" class="mt-2 btn btn-primary float-right btnEditarG">Editar</button>   
                                </div>
                            </div>        
                        </form>
                    </div>
                </div>
            </div>
        <script src="dist/js/agregarPatrones.js"></script>
        <?php include_once("footer.php");?>
    </div>
</div>    