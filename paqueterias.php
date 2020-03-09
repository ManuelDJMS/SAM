<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- ===================SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO ========================-->
<link rel="stylesheet" href="dist/css/base.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script> 
<!-- =================================================================== -->
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-plugin icon-gradient bg-sunny-morning">
                        </i>
                    </div>
                    <div>Paqueterias
                        <div class="page-title-subheading">Crea y modifica las paqueterías que usan las empresas para sus envíos.
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
                    <div class="card-body"><h5 class="card-title">Informacion General de las paqueterías</h5>
                        <form id="signupForm">
                            <div class="form-row">
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Descripción</label>
                                        <input type="text" class="form-control" id="Descripcion" name="Descripcion" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleText" class="">Notas</label>
                                <textarea name="Notas" id="Notas" class="form-control"></textarea>
                            </div>
                            <div class="position-relative form-group"> 
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" id="exampleCustomCheckbox1" class="custom-control-input" name="CVentas" value="0">
                                    <label class="custom-control-label" for="exampleCustomCheckbox1">Activo</label>
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
                <div id="div_registros" class="box-body">
                    <table id="table_registros" class="table table-bordered table-striped dataTable">
                        <thead>
                        <tr>
                            <th>id Paqueteria</th>
                            <th>Descripción</th>
                            <th>Notas</th>
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
    <script src="dist/js/paqueterias.js"></script>
    <?php include_once("footer.php");?>