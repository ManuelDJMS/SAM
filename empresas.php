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
                            <!-- ===================================== INICIA EL PRIMER RENGLON =========================================== -->
                            <div class="form-row">
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Razón Social</label>
                                        <input type="text" class="form-control" id="RazonSocial" name="RazonSocial" required/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">Tipo</label>
                                        <select type="select" id="exampleCustomSelect" name="TipoEmpresa" class="custom-select">
                                            <option></option>
                                            <option value="A.C.">A.C.</option>
                                            <option value="S.A.B.">S.A.B.</option>
                                            <option value="S.A.B. de C.V.">S.A.B. de C.V.</option>
                                            <option value="S.A.S.">S.A.S.</option>
                                            <option value="S.A.">S.A.</option>
                                            <option value="S.A. de C.V.">S.A. de C.V.</option>
                                            <option value="S.A.P.I.">S.A.P.I.</option>
                                            <option value="S.A.P.I. de C.V.">S.A.P.I. de C.V.</option>
                                            <option value="S.A.P.I.B.">S.A.P.I.B.</option>
                                            <option value="S. de P.R. de R.L.">S. de P.R. de R.L.</option>
                                            <option value="S. de R.L.">S. de R.L.</option>
                                            <option value="S. de R.L. de C.V.">S. de R.L. de C.V.</option>
                                            <option value="S. en N.C">S. en N.C</option>
                                            <option value="S. Coop.">S. Coop.</option>
                                            <option value="S.C.">S.C.</option>
                                            <option value="S.S.S.">S.S.S.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">RFC</label>
                                        <input name="RFC" id="RFC" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <!-- ===================================== TERMINA EL PRIMER RENGLON =========================================== -->
                            <!-- ===================================== INICIA EL SEGUNDO RENGLON =========================================== -->
                            <div class="form-row">   
                                <div class="col-md-3">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Crédito</label>
                                        <select name="Credito" id="Credito" class="form-control">
                                            <option value="CON CRÉDITO">CON CRÉDITO</option>
                                            <option value="SIN CRÉDITO">SIN CRÉDITO</option>
                                            <option value="CRÉDITO SUSPENDIDO">CRÉDITO SUSPENDIDO</option>
                                            <option value="SUSPENDIDO">SUSPENDIDO</option>
                                            <option value="LISTA NEGRA">LISTA NEGRA</option>
                                        </select>  
                                    </div>   
                                </div>  
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Descuento</label>
                                        <input id="Descuento" class="form-control">
                                    </div>
                                </div>     
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">N° Proveedor</label>
                                        <input id="NoProveedor" class="form-control">
                                    </div>
                                </div>     
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Clave de AdminPaq</label>
                                        <input id="AdminPaq" class="form-control">
                                    </div>
                                </div>     
                            </div> 
                            <!-- ===================================== TERMINA EL SEGUNDO RENGLON =========================================== -->
                            <!-- ===================================== INICIA EL TERCER RENGLON =========================================== -->
                            <div class="form-row">   
                                <div class="col-md-4">           
                                    <div class="position-relative form-group"> 
                                        <label for="exampleSelect" class="">Paquetería</label>
                                        <select id="Paqueteria" class="form-control">
                                        </select>  
                                    </div>   
                                </div>  
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Cuenta Mensajería</label>
                                        <input id="CuentaMensajeria" class="form-control">
                                    </div>
                                </div>     
                                <input type="hidden" id="Access" class="form-control">
                                      
                            </div> 
                            <!-- ===================================== TERMINA EL TERCER RENGLON =========================================== -->
                            <!-- ===================================== INICIA EL CUARTO RENGLON =========================================== -->
                            <div class="form-row">   
                                <div class="col-md-6">           
                                    <div class="position-relative form-group">
                                        <label for="exampleText" class="">Observaciones de la empresa</label>
                                        <textarea name="Observaciones" id="Observaciones" class="form-control"></textarea>
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
                  <table id="table_registros" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>Clave Empresa</th>
                        <th>Razón Social</th>
                        <th>RFC</th>
                        <th>Crédito</th>
                        <th>N° Proveedor</th>
                        <th>Clave de AdminPaq</th>
                        <th>Observaciones de la empresa</th>
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
</div>
    <script src="dist/js/empresas.js"></script>
    <?php include_once("footer.php");?>