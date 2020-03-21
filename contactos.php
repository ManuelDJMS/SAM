<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
    <link rel="stylesheet" href="dist/css/base.css">
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
  
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
                                <h5 class="card-title">Informacion General del Contacto</h5>
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
                                            <label for="examplePassword11" class="">Apellido(S)</label>
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
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleText" class="">Condiciones</label>
                                            <textarea id="Condiciones" class="form-control"></textarea>
                                        </div>
                                    </div>    
                                    <div class="col-md-2">
                                        <label for="exampleText" class=""></label>
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="exampleCustomCheckbox1" class="custom-control-input" name="CActivo" value="1">
                                            <label class="custom-control-label" for="exampleCustomCheckbox1">Activo</label>
                                        </div>
                                    </div>              
                                </div>                  
                                <!-- ============================== TERMINA EL SEGUNDO RENGLON ===================================== -->
                                <!-- <div class="card-body"><h5 class="card-title">Simple</h5> -->
                                <div id="exampleAccordion" data-children=".item">
                                    <!-- <div class="item"> -->
                                        <button type="button" aria-expanded="true" aria-controls="exampleAccordion1" data-toggle="collapse" href="#collapseExample" class="m-0 p-0 btn btn-link SelectEmpresa" id="btn_cerrado">Seleccionar empresa</button>
                                        <div data-parent="#exampleAccordion" id="collapseExample" class="collapse">
                                            <!-- <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium lorem non vestibulum scelerisque. Proin a
                                            vestibulum sem, eget tristique massa. Aliquam lacinia rhoncus nibh quis ornare.</p> -->
                                            <!--  -->
                                            <div class="main-card mb-3 card">
                                                <div id="div_empresas" class="box-body">
                                                    <table id="example2" class="table table-bordered table-striped dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Clave Empresa</th>
                                                                <th>Razón Social</th>
                                                                <th>RFC</th>
                                                                <th></th>
                                                                <th>RFC</th>
                                                                <th>Editar</th>
                                                                </tr>
                                                            </thead>
                                                        <tbody>
                                                            </tbody>
                                                    </table>
                                                </div><!-- /.box-body -->  
                                            </div> 
                                            <!--  -->
                                        </div><!-- ========= TERMINA EL DIV DEL ACORDEON ================ -->
                                    <!-- </div> -->
                                </div>
                                <button type="button" class="mt-2 btn btn-primary float-right btnGuardar" id="btn_nuevo_0">Guardar</button> 
                                <button type="button" class="mt-2 btn btn-primary btnEditarG float-right" >Editar</button> 
                            </div><!-- DIV CARD BODY -->
                        </div><!-- DIV class="main-card mb-3 card" --> 
                    </form>
                </div><!-- **************************************************** AQUI TERMINA EL TAB 0  *************************************************************************-->
                    
                <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
                <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div id="div_registros" class="box-body">
                            <table id="example1" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Clave Contacto</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Cargo</th>
                                        <th>Celular</th>
                                        <th>Tel</th>
                                        <th>Fax</th>
                                        <th>Ext</th>
                                        <th>Email</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->  
                    </div> 
                    <div class="loader-wrapper d-flex justify-content-center align-items-center">
                        <div class="loader">
                            <div class="line-scale-pulse-out"> 
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>  <!-- ===================== DIV DEL TABL DE LAS CONSIULTAS -->
            </div>
        </div>
    </div>
        
        <script src="dist/js/contactos.js"></script>
        <!-- <div class="spinner-border-sm" style="display:flex;">Cargando</div> -->
        <?php include_once("footer.php");?>