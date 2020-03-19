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
                        <i class="lnr-user icon-gradient bg-malibu-beach">
                        </i>
                    </div>
                    <div>Contactos
                        <div class="page-title-subheading">Administra la información de usuarios que interactuan con el sistema SIIM
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
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Nombre</label>
                                        <input type="text" class="form-control" id="Nombre" name="Nombre" required/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Apellidos</label>
                                        <input type="text" class="form-control" id="Apellidos" name="Apellidos" required/>
                                    </div>
                                </div>   
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Email</label>
                                        <input name="Email" id="Email" class="form-control">
                                    </div>
                                </div>
                                <!-- <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="exampleCustomSelect" class="">Tipo</label>
                                        <select type="select" id="exampleCustomSelect" name="tipoEmail" class="custom-select">
                                            <option value="@metas.com.mx">@metas.com.mx</option>
                                            <option value="@metas.mx">@metas.mx</option>
                                        </select>
                                    </div>
                                </div> -->
                            </div>
                            <div class="form-row">              
                                <div class="position-relative form-group"> 
                                <label for="exampleSelect" class="">Departamento</label>
                                    <select name="Depto" id="Depto" class="form-control">
                                        <option value="VENTAS">VENTAS</option>
                                        <option value="LOGISTICA">LOGÍSTICA</option>
                                        <option value="OPERADORES">OPERADORES</option>
                                        <option value="MASA">MASA</option>
                                        <option value="DENSIDAD">DENSIDAD</option>
                                        <option value="VOLUMEN">VOLUMEN</option>
                                        <option value="PRESION">MASA-CAMPO</option>
                                        <option value="PRESION">PRESIÓN</option>
                                        <option value="HUMEDAD">HUMEDAD</option>
                                        <option value="TEMPERATURA DE CONTACTO">TEMPERATURA DE CONTACTO</option>
                                        <option value="RADIANCIA">RADIANCIA</option>
                                        <option value="ELECTRICA">ELÉCTRICA</option>
                                        <option value="VIBRACIONES">VIBRACIONES</option>
                                        <option value="MEDICIONES">MEDICIONES ESPECIALES</option>
                                        <option value="SISTEMAS">SISTEMAS</option>
                                    </select>  
                                </div>
                                <div class="col-md-1">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Ext</label>
                                        <input name="Ext" id="Ext" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                    <label for="examplePassword11" class="">Firma</label>
                                    <input type="file" name="adjunto" id="Firma" accept=".pdf,.jpg,.png" multiple>
                                    </div>
                                </div>           
                            </div> 
                            <div class="position-relative form-group"> 
                                <label for="exampleText" class="">Puesto(En caso de ser de Laboratorio)</label>
                                    <div>
                                            <input type="radio" name="gender" id="Responsable" value="1"> Responsable<br>
                                            <input type="radio" name="gender" id="Metrologo" value="1"> Metrologo<br>
                                            <input type="radio" name="gender" id="Auxiliar" value="1"> Auxiliar
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
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Depto</th>
                        <th>Email</th>
                        <th>Seleccionar</th>
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