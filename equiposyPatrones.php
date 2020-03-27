<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
    <link rel="stylesheet" href="dist/css/base.css">
    <script src="plugins/datatables/jquery.dataTablesN.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap4.min.js"></script> 
  
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="lnr-screen icon-gradient bg-sunny-morning">
                            </i>
                        </div>
                        <div>Equipos y Patrones
                            <div class="page-title-subheading">Administra todos los equipos patrones de MetAs SA. de CV.
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
                                <h5 class="card-title">Informacion General</h5>
                                <!-- ============================== EMPIEZA EL PRIMER RENGLON ===================================== -->
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Descripción</label>
                                            <input type="text" class="form-control" id="Descripcion" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">Status</label>
                                        <select type="select" id="Status" name="Status" class="custom-select">
                                            <option></option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="EN CALIBRACIÓN">EN CALIBRACIÓN</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="exampleEmail11" class="">Ultima Calibración</label>
                                        <input id="UltimaCalibracion" name="UltimaCalibracion" type="text" class="form-control" data-toggle="datepicker" readonly="readonly"/>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="exampleEmail11" class="">Proxima Calibración</label>
                                        <input id="ProximaCalibracion" name="ProximaCalibracion" type="text" class="form-control" data-toggle="datepicker" readonly="readonly"/>
                                    </div>
                                </div>
                                <!-- ============================== TERMINA EL 1ER RENGLON ===================================== -->
                                <!-- ============================== EMPIEZA EL SEGUNDO RENGLON ===================================== -->
                                <div class="form-row">   
                                    <div class="col-md-3">           
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="Referencia" class="custom-control-input" name="Referencia" value="0">
                                            <label class="custom-control-label" for="Referencia">REFERENCIA</label>
                                        </div>
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="Trabajo" class="custom-control-input" name="Trabajo" value="0">
                                            <label class="custom-control-label" for="Trabajo">TRABAJO</label>
                                        </div>
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="EquipoAuxiliar" class="custom-control-input" name="EquipoAuxiliar" value="0">
                                            <label class="custom-control-label" for="EquipoAuxiliar">AUXILIAR</label>
                                        </div>              
                                    </div>  
                                </div> 
                            <!-- ============================== TERMINA EL SEGUNDO RENGLON ===================================== -->
                                <div id="exampleAccordion" data-children=".item">
                                    <div data-parent="#exampleAccordion" id="collapseExample" class="collapse">                                           <div class="main-card mb-3 card">
                                        <div id="div_empresas" class="box-body">
                                            <table id="example2" class="table table-bordered table-striped dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Descripcion</th>
                                                        <th>Status</th>
                                                        <th>Ultima Calibración</th>
                                                        <th>Proxima Calibración</th>
                                                        <th>Editar</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                    </tbody>
                                            </table>
                                        </div><!-- /.box-body -->  
                                    </div> 
                               </div><!-- ========= TERMINA EL DIV DEL ACORDEON ================ -->
                            </div>
                                <button type="button" class="mt-2 btn btn-primary  btnGuardar" id="btn_nuevo_0">Guardar</button> 
                                <button type="button" class="mt-2 btn btn-primary btnEditarG " >Editar</button> 
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
        
        <script src="dist/js/equiposyPatrones.js"></script>
        <!-- <div class="spinner-border-sm" style="display:flex;">Cargando</div> -->
        <?php include_once("footer.php");?>