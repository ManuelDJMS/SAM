<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<link rel="stylesheet" href="dist/css/base.css">
<script src="plugins/datatables/jquery.dataTablesN.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-folder icon-gradient bg-love-kiss">
                        </i>
                    </div>
                    <div>Equipamiento
                        <div class="page-title-subheading">Administra el equipamiento de cada contacto.
                        </div>
                    </div>
                </div>
            </div>
        </div>            
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Agregar</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Consultar</span>
                </a>
            </li>
        </ul>
        <!-- ========================================================================================================= -->
        <!-- ===================================INICIA PESTAÑA DE AGREGAR============================================ -->
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form id="signupForm">
                            <div class="row">
                                <div class="col-md-8"><h6>INFORMACIÓN DE EMPRESA Y CONTACTO</h6>
                                    <!-- INICIA CODIGO PARA SELECCIONAR EMPRESA Y CONTACTO -->
                                    <div class="main-card mb-3 card">
                                        <div id="exampleAccordion" data-children=".item">
                                            <button type="button" aria-expanded="true" aria-controls="exampleAccordion1" data-toggle="collapse" href="#collapseExample" class="m-0 p-0 btn btn-link SelectEmpresa" id="btn_cerrado">Seleccionar empresa</button>
                                                <div data-parent="#exampleAccordion" id="collapseExample" class="collapse">
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body">
                                                            <div id="div_registros1" class="box-body">
                                                                <table id="example1" class="table table-bordered table-striped dataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Razon</th>
                                                                            <th>RFC</th>
                                                                            <th>Dirección</th>
                                                                            <th>Seleccionar</th>                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> 
                                                        <!--animacion DE CARGANDO-->
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
                                                        <!-------------------------------------->
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <h5 class="card-title" id="Empresa" name="Empresa" >Empresa</h5>
                                                <h5 class="card-title" id="idEmpresa" name="idEmpresa" style="display: none;">Empresa</h5>    
                                                <label for="Nombre" class="col-sm-6 control-label">Contacto</label>
                                                    <div class="col-sm-12">
                                                        <select type="select" id="Nombre" name="Nombre" class="custom-select"></select>
                                                    </div>
                                        </div>  
                                    </div>
                                    <!-- <button type="button" class="mt-2 btn btn-primary float-right btnGuardar" id="btn_nuevo_0">Guardar</button>
                                    <button type="button" class="mt-2 btn btn-primary float-right btnEditarG">Editar</button>    -->
                                </div>
                            </div>        
                        </form>
                    </div>
                </div>        
                <!-- TERMINA CODIGO PARA SELECCIONAR EMPRESA Y CONTACTO -->
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="main-card mb-8 card">
                            <div class="card-body"><h5 class="card-title" >Lista de Artículos</h5> 
                                <div id="div_registros2" class="box-body">
                                    <table id="example2" class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr>
                                                <th>Descripcion</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Seleccionar</th>                                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="main-card mb-8 card">
                            <div class="card-body"><h5 class="card-title" >Información de Equipamiento</h5>  
                                <div class="form-row">
                                    <div class="col-md-8">
                                        <div class="position-relative form-group">
                                        <h5 class="card-title" id="idArt" name="idArt" style="display: none;"></h5> 
                                            <label for="exampleEmail11" class="">Artículo</label>
                                                <input type="text" class="form-control" id="Articulo" name="Articulo" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">MetAs ID</label>
                                                <input type="text" class="form-control" id="metasId" name="metasId" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Marca</label>
                                                <input type="text" class="form-control" id="Marca" name="Marca" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Modelo</label>
                                                <input type="text" class="form-control" id="Modelo" name="Modelo" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Unidad de Negocio</label>
                                            <select type="select" id="Lab" name="Lab" class="custom-select"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">ID</label>
                                                <input type="text" class="form-control" id="id" name="id" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Serie</label>
                                                <input type="text" class="form-control" id="Serie" name="Serie" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <label for="exampleText" class="">Notas</label>
                                            <textarea name="Notas" id="Notas" class="form-control"></textarea>
                                        </div>
                                    </div>    
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group">
                                            <label for="exampleText" class="">Puntos</label>
                                            <textarea name="Puntos" id="Puntos" class="form-control"></textarea>
                                        </div>
                                    </div>    
                                </div>
                                <button type="button" class="mt-2 btn btn-primary float-right btnGuardar" id="btn_nuevo_0">Agregar</button>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
            <!-- ========================================================================================================= -->
            <!-- ===================================INICIA PESTAÑA DE CONSULTAR============================================ -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div  class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title" >Lista de Artículos</h5> 
                        <div id="div_registros3" class="box-body">
                            <table id="example3" class="table table-bordered table-striped dataTable">
                                <thead>
                                <tr>
                                    <th>Razon Social</th>
                                    <th>Contacto</th>
                                    <th>MetasID</th>
                                    <th>Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>ID</th>
                                    <th>Serie</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>    
                    </div><!-- /.box-body -->
                </div>    
            </div>
        </div>    
    </div>
</div>

<script src="dist/js/equipamiento.js"></script>
        <?php include_once("footer.php");?>