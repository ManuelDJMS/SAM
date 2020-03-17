<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<link rel="stylesheet" href="dist/css/base.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- <script src="plugins/jQuery/3.2.10.min" type="text/javascript"></script> -->

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="lnr-user icon-gradient bg-malibu-beach">
                        </i>
                    </div>
                    <div>Contactos
                        <div class="page-title-subheading">Administra la información de usuario sque interactuan con el sistema SIIM
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
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Nombre</label>
                                        <input type="text" class="form-control" id="Nombre" name="Nombre" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Apellidos</label>
                                        <input type="text" class="form-control" id="Apellidos" name="Apellidos" required/>
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Email</label>
                                        <input name="Email" id="Email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">              
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Departamento</label>
                                    <select name="Depto" id="Depto" class="form-control">
                                        <option value="VENTAS">Ventas</option>
                                        <option value="LOGISTICA">Logística</option>
                                        <option value="OPERADORES">Operadores</option>
                                        <option value="MASA">Masa</option>
                                        <option value="PRESION">Presión</option>
                                    </select>  
                                </div>
                                <div class="col-md-1">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Ext</label>
                                        <input name="Ext" id="Ext" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Clave</label>
                                        <label for="examplePassword11" id="Clave" class="">Clave</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Contraseña</label>
                                        <input type="password" name="Pass" id="Pass" class="form-control">
                                        <!-- checkbox que nos permite activar o desactivar la opcion -->   
                                        <input type="checkbox" id="mostrar_contrasena" title="clic para mostrar contraseña"/>
                                        &nbsp;&nbsp;Mostrar Contraseña
                                    </div>
                                </div>      
                            </div> 
                            <div class="position-relative form-group"> 
                            <label for="exampleText" class="">Puesto(En caso de ser de Laboratorio)</label>
                                <div>
                                        <input type="radio" name="gender" id="R" value="1"> Responsable<br>
                                        <input type="radio" name="gender" id="M" value="1"> Metrologo<br>
                                        <input type="radio" name="gender" id="A" value="1"> Auxiliar
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
                  <!-- <table id="example" class="table table-bordered table-striped"> -->
                  <table id="example3" class="table table-bordered table-striped dataTable">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Departamento</th>
                        <th>Email</th>
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
    <script src="dist/js/usuarios.js"></script>
    <?php include_once("footer.php");?>