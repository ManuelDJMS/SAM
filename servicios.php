<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.min.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script> 

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="lnr-license icon-gradient bg-malibu-beach">
                        </i>
                    </div>
                    <div>Servicios
                        <div class="page-title-subheading">Administra los servicios que se realizan en Metas SA. de CV.
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
                    <div class="card-body"><h5 class="card-title">Informacion General</h5>
                        <form id="signupForm">
                            <div class="form-row ">
                                <div class="col-md-2">
                                    <div class="position-relative form-group ">
                                    <label for="exampleEmail11" class="" >No. Catálogo</label>
                                        <input type="text" class="form-control" id="NoCatalogo" name="NoCatalogo" required/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Servicio</label>
                                        <input type="text" class="form-control" id="Servicio" name="Servicio" required/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Complemento</label>
                                        <input type="text" class="form-control" id="ComplementoServicio" name="ComplementoServicio" required/>
                                    </div>
                                </div>   
                            </div>
                            <div class="form-row">              
                                <div class="col-md-4">           
                                    <div class="position-relative form-group">
                                        <label for="exampleText" class="">Observaciones</label>
                                        <textarea name="Observaciones" id="Observaciones" class="form-control"></textarea>
                                    </div>  
                                </div>   
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Unidad</label>
                                        <input type="text" class="form-control" id="Unidad" name="Unidad" required/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Modalidad</label>
                                        <input type="text" class="form-control" id="Modalidad" name="Modalidad" required/>
                                    </div>
                                </div>           
                            </div>
                            <div class="form-row">              
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Porcentaje</label>
                                        <input type="text" class="form-control" id="Porcentaje" name="Porcentaje" required/>
                                    </div>
                                </div>      
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Precio Base</label>
                                        <input type="text" class="form-control" id="PrecioBase" name="PrecioBase" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">           
                                    <div class="position-relative form-group">
                                        <label for="exampleText" class="">Comentarios Internos</label>
                                        <textarea name="ComentariosInternos" id="ComentariosInternos" class="form-control"></textarea>
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
                <div id="div_registros" class="card-body">
                  <!-- <table id="example" class="table table-bordered table-striped"> -->
                  <table id="example3" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>No. Catálogo</th>
                        <th>Servicio</th>
                        <th>Complemento de Servicio</th>
                        <th>Observaciones</th>
                        <th>Precio Base</th>
                        <th>Comentarios</th>
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
    <script src="dist/js/serviciosN.js"></script>
    <?php include_once("footer.php");?>