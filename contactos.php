<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
    <!-- <link rel="stylesheet" href="dist/css/base.css"> -->
    <!-- <link rel="stylesheet" href="dist/css/base.min.css"> -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>   
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
                            <form id="signupForm">
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
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                                <label for="examplePassword11" class="">Extensiòn</label>
                                                <input name="Ext" id="Ext" class="form-control">
                                            </div>
                                    </div>
                                    <div class="col-md-2">
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
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Descuento</label>
                                        <select name="Descuento" id="Descuento" class="form-control">
                                        <option value="0">0</option>
                                        <option value="3">3</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        </select>  
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
                                                <input type="checkbox" id="exampleCustomCheckbox1" class="custom-control-input" name="CActivo" value="0">
                                                <label class="custom-control-label" for="exampleCustomCheckbox1">Activo</label>
                                            </div>
                                    </div>
                                </div> 
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Direcciones</h5>
                                        <div class="collapse" id="collapseExample123">
                                            <div id="div_direcciones" class="box-body">     
                                                <table id="example2" class="table table-bordered table-striped dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Domicilio Fiscal</th>
                                                            <th>Ciudad</th>
                                                            <th>Estado</th>
                                                            <th>Domicilio Consig</th>
                                                            <th>Ciudad</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" data-toggle="collapse" href="#collapseExample123" class="btn btn-primary">Agregar Dirección</button>
                                    </div>
                                </div>   
                                <div class="app-main">
                                    <div class="app-main__outer">
                                        <div class="app-main__inner">   
                                            <div class="col-md-12">              
                                                <div class="card-body">
                                                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>
                                                </div>     
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <button type="button" class="mt-2 btn btn-primary btnGuardar" id="btn_nuevo_0">Guardar</button> 
                                <button type="button" class="mt-2 btn btn-primary btnEditarG" >Editar</button> 
                            </form>
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
                                            <th>Tel</th>
                                            <th>Fax</th>
                                            <th>Ext</th>
                                            <th>Email</th>
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
                        </div>  
                    </div>
                </div>
            </div>
                  <!-- Large modal -->
                  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div> 
    <script src="dist/js/contactos.js"></script>
    <?php include_once("footer.php");?>


     