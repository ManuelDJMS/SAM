<?php
    include_once("header.php");
    include_once("validates.php");
    include_once("banner.php");
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.min.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script> 
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-sunny-morning">
                        </i>
                    </div>
                    <div>Contactos
                        <div class="page-title-subheading">Crea y modifica los contactos de cada una de las empresas.
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
            <!-- **************************************************** AQUI EMPIEZA EL TAB 0  *************************************************************************-->
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <form id="signupForm">   
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title EmpresaID" id="0">Informacion General del Contacto</h5>
                            <!-- ============================== EMPIEZA EL PRIMER RENGLON ===================================== -->
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Nombre</label>
                                        <input type="text" class="form-control" id="Nombre" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Apellido(s)</label>
                                        <input type="text" id="Apellidos" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Cargo</label>
                                        <input id="Cargo" class="form-control">
                                    </div>
                                </div>                             
                            </div>
                            <!-- ============================== TERMINA EL PRIMER RENGLON ===================================== -->
                            <!-- ============================== EMPIEZA EL SEGUNDO RENGLON ===================================== -->
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Celular</label>
                                            <input name="Celular" id="Celular" class="form-control">
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Teléfono</label>
                                            <input name="Tel" id="Tel" class="form-control">
                                        </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Ext</label>
                                            <input name="Ext" id="Ext" class="form-control">
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Fax</label>
                                            <input name="Fax" id="Fax" class="form-control">
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Email</label>
                                            <input name="Email" id="Email" class="form-control">
                                        </div>
                                </div>
                            </div>
                            <!-- ============================== TERMINA EL SEGUNDO RENGLON ===================================== -->
                            <!-- ============================== EMPIEZA EL TERCER RENGLON ===================================== -->
                            <div class="form-row">
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="exampleText" class="">Condiciones</label>
                                        <textarea id="Condiciones" class="form-control"></textarea>
                                    </div>
                                </div>              
                            </div>                  
                            <!-- ============================== TERMINA EL SEGUNDO RENGLON ===================================== -->
                            <button type="button" class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-success float-right btnGuardar" id="btn_nuevo_0">Guardar</button> 
                            <button type="button" class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-info float-right btnEditarG" style="display: none;">Guardar Contacto</button> 
                        </div><!-- DIV CARD BODY -->
                    </div><!-- DIV class="main-card mb-3 card" --> 
                </form>
                <div id="accordion" class="accordion-wrapper mb-3">
                    <div class="card">
                        <div id="headingThree" class="card-header">
                            <button id="verEmpresas" type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon lnr-apartment icon-gradient bg-amy-crisp"> </i>
                                    Seleccionar Empresa
                                </div>
                            </button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne3" class="collapse">
                            <div id="div_empresas" class="card-body">
                                <table id="table_empresas" class="table table-hover table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>Clave Empresa</th>
                                            <th>Razón Social</th>
                                            <th>RFC</th>
                                            <th>Crédito</th>
                                            <th>N° Proveedor</th>
                                            <th>Clave de AdminPaq</th>
                                            <th>Observaciones de la empresa</th>
                                            <th>Seleccionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>  
            </div><!-- **************************************************** AQUI TERMINA EL TAB 0  *************************************************************************-->  
            <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div id="div_contactos" class="card-body">
                        <table id="table_contactos" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Clave Contacto</th>
                                    <th>Razón Social</th>
                                    <th>RFC</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Celular</th>
                                    <th>Tel</th>
                                    <th>Ext</th>
                                    <th>Crédito</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->  
                </div> 
            </div>  <!-- ===================== DIV DEL TABL DE LAS CONSIULTAS -->
            <!-- ================================================== AQUI INICIA EL CODIGO DE LAS DIRECCIONES ========================================================== -->

            <!-- ================================================== AQUI TERMINA EL CODIGO DE LAS DIRECCIONES ========================================================== -->  
        </div>
    </div>
</div>
<script src="dist/js/contactos.js"></script>
<!-- <div class="spinner-border-sm" style="display:flex;">Cargando</div> -->
<?php include_once("footer.php");?>