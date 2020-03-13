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
                            <i class="lnr-user icon-gradient bg-sunny-morning">
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
                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Informacion Personal</h5>

                            <form class="" id="signupForm" action="contactos.php" method="post">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Nombre</label>
                                            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Apellido</label>
                                            <input name="Apellidos" id="Apellidos" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Cargo</label>
                                            <input name="Cargo" id="Cargo" class="form-control">
                                        </div>
                                    </div>                             
                                </div>
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                                <label for="examplePassword11" class="">Celular</label>
                                                <input name="Celular" id="Celular" class="form-control">
                                            </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                                <label for="examplePassword11" class="">Telèfono</label>
                                                <input name="Tel" id="Tel" class="form-control">
                                            </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="position-relative form-group">
                                                <label for="examplePassword11" class="">Extensiòn</label>
                                                <input name="Ext" id="Ext" class="form-control">
                                            </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="position-relative form-group">
                                                <label for="examplePassword11" class="">Fax</label>
                                                <input name="Fax" id="Fax" class="form-control">
                                            </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                                <label for="examplePassword11" class="">Email</label>
                                                <input name="Email" id="Email" class="form-control">
                                            </div>
                                    </div>
                                    <div class="dropdown d-inline-block">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-primary">Agregar empresa</button>
                                            <div tabindex="-1"  aria-hidden="true" class="dropdown-menu-xl dropdown-menu">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-happy-itmeo">
                                                        <div class="menu-header-image" style="background-image: url('assets/images/dropdown-header/city2.jpg');"></div>
                                                            <div class="menu-header-content text-dark"><h5 class="menu-header-title">Empresas</h5><h6 class="menu-header-subtitle">Seleccione la empresa a la que pertece este contacto</h6></div>
                                                        </div>
                                                    </div>
                                                <div id="div_empresas" class="box-body">
                                                    <table id="example2" class="table table-bordered table-striped dataTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Clave</th>
                                                                <th>Razon Social</th>
                                                                <th>RFC</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div><!-- /.box-body -->
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-divider nav-item"></li>
                                                        <li class="nav-item-btn text-center nav-item">
                                                        <button class="btn-shadow btn btn-primary btn-sm">Submit</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                </div>
                                <div class="form-row">
                                    <div class="position-relative form-group">
                                        <label for="exampleText" class="">Condiciones del cliente</label>
                                        <textarea name="Condiciones" id="Condiciones" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="exampleText" class=""></label>
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" id="exampleCustomCheckbox1" class="custom-control-input" name="CActivo" value="1">
                                                <label class="custom-control-label" for="exampleCustomCheckbox1">Activo</label>
                                            </div>
                                    </div>              
                                </div>                  
                               
                            </form>
                            <button type="button" class="mt-2 btn btn-primary btnGuardar" id="btn_nuevo_0">Guardar</button> 
                                <button type="button" class="mt-2 btn btn-primary btnEditarG" >Editar</button> 
                        </div>
                    </div>
                </div>
                
                <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
                <!-- <div class="spinner-border-sm" style="display:flex;">Cargando</div> -->
                    <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                        <div  class="main-card mb-3 card">
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
                        </div>  
                    </div>
                <!-- </div> -->
            </div>
        <script src="dist/js/contactos.js"></script>
        <!-- <div class="spinner-border-sm" style="display:flex;">Cargando</div> -->
        <?php include_once("footer.php");?>