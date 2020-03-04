<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<!-- <script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>  -->

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="lnr-apartment icon-gradient bg-sunny-morning">
                        </i>
                    </div>
                    <div>Empresas
                        <div class="page-title-subheading">Crea y modifica las empresas relacionadas con Metas SA. de CV.
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
                    <div class="card-body"><h5 class="card-title">Informacion General de la Empresa</h5>
                        <form id="signupForm">
                            <div class="form-row">
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Razón Social</label>
                                        <input type="text" class="form-control" id="RazonSocial" name="RazonSocial" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">Tipo</label>
                                        <select type="select" id="exampleCustomSelect" name="TipoEmpresa" class="custom-select">
                                            <option></option>
                                            <option>A.C.</option>
                                            <option>S.A.B.</option>
                                            <option>S.A.B. de C.V.</option>
                                            <option>S.A.S.</option>
                                            <option>S.A.</option>
                                            <option>SA. de CV.</option>
                                            <option>S.A.P.I.</option>
                                            <option>S.A.P.I. de C.V.</option>
                                            <option>S.A.P.I.B.</option>
                                            <option>S. de P.R. de R.L.</option>
                                            <option>S. de R.L.</option>
                                            <option>S. de R.L. de C.V.</option>
                                            <option>S. en N.C</option>
                                            <option>S. Coop.</option>
                                            <option>S.C.</option>
                                            <option>S.S.S.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">RFC</label>
                                        <input name="RFC" id="RFC" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleText" class="">Observaciones de la empresa</label>
                                <textarea name="Observaciones" id="Observaciones" class="form-control"></textarea>
                            </div>
                            <div class="form-row">              
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Crédito</label>
                                    <select name="Credito" id="Credito" class="form-control">
                                        <option>CON CRÉDITO</option>
                                        <option>SIN CRÉDITO</option>
                                        <option>CRÉDITO SUSPENDIDO</option>
                                        <option>SUSPENDIDO</option>
                                        <option>LISTA NEGRA</option>
                                    </select>  
                                </div>        
                            </div> 
                            <div class="position-relative form-group"> 
                            <label for="exampleText" class="">Empresa en </label>
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" id="exampleCustomCheckbox1" class="custom-control-input" name="CVentas" value="1">
                                    <label class="custom-control-label" for="exampleCustomCheckbox1">Ventas</label>
                                </div>
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" id="exampleCustomCheckbox2" class="custom-control-input" name="CCursos" value="1">
                                        <label class="custom-control-label" for="exampleCustomCheckbox2">Cursos</label>
                                </div>
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" id="exampleCustomCheckbox3" class="custom-control-input" name="CGestoria" value="1">
                                    <label class="custom-control-label" for="exampleCustomCheckbox3">Gestoría</label>
                                </div>
                            </div>
                            <button type="button" class="mt-2 btn btn-primary btnGuardar" id="btn_nuevo_0">Guardar</button> 
                            <!-- <input type="submit" class="mt-2 btn btn-primary" value="Guardar" name=""></button> -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div  class="main-card mb-3 card">
                <div id="div_registros" class="box-body">
                  <!-- <table id="example" class="table table-bordered table-striped"> -->
                  <table id="example" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>Clave Empresa</th>
                        <th>Razón Social</th>
                        <th>RFC</th>
                        <th>Crédito</th>
                        <th>Observaciones de la empresa</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div><!-- /.box-body -->
            </div>  
        </div><!-- AQUI TERMINA EL DIV DEL TAB -->
    </div>
    <script src="dist/js/empresas.js"></script>
    <?php include_once("footer.php");?>