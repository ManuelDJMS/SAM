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
                        <i class="pe-7s-box1 icon-gradient bg-love-kiss">
                        </i>
                    </div>
                    <div>Artículos
                        <div class="page-title-subheading">Administra la Información de los artículos a calibrar.
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
                                <div class="col-md-12"><h5 class="card-title">Información general del artículo</h5>
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail11" class="">Num. de Artículo</label>
                                                    <input type="text" class="form-control" id="itemNumber" name="itemNumber" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail11" class="">Nombre/Descripción</label>
                                                    <input type="text" class="form-control" id="Nombre" name="Nombre" required/>
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
                                                <label for="exampleEmail11" class="">No. Serie</label>
                                                    <input type="text" class="form-control" id="Serie" name="Serie" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                  
                        </form>
                    </div>
                </div>        
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="main-card mb-8 card">
                            <div class="card-body"><h5 class="card-title">Información de Equipamiento</h5>  
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Exactitud</label>
                                            <textarea name="Exactitud" id="Exactitud" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Rango</label>
                                            <textarea name="Rango" id="Rango" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Dias de calibración</label>
                                                <input type="text" class="form-control" id="DiasCalibracion" name="DiasCalibracion" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Peso Aproximado</label>
                                                <input type="text" class="form-control" id="PesoAproximado" name="PesoAproximado" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">----------Intervalo de </label>
                                                <input type="text" class="form-control" id="Intervalo" name="Intervalo" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Calibración-----------</label>
                                               
                                                <select name="Ciclo" id="Ciclo" class="form-control">
                                                    <option value="DIAS">DIA(S)</option>
                                                    <option value="SEMANAS">SEMANA(S)</option>
                                                    <option value="MESES">MES(ES)</option>
                                                    <option value="AÑO">AÑO(S)</option>
                                                </select>  
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Laboratorio</label>
                                                <select type="select" id="Lab" name="Lab" class="custom-select"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Descripción de Servicio</label>
                                            <textarea name="Descripcion" id="Descripcion" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Metodo de Calibración</label>
                                            <textarea name="Metodo" id="Metodo" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Estandarización</label>
                                                <input type="text" class="form-control" id="Estandarizacion" name="Estadarizacion" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Acreditación</label>
                                                <input type="text" class="form-control" id="Acreditacion" name="Acreditacion" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Artículo relacionado</label>
                                            <input type="text" class="form-control" id="Relacion" name="Relacion" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Especificaciones Adicionales</label>
                                            <textarea name="Especificaciones" id="Especificaciones" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail11" class="">Notas</label>
                                            <textarea name="Notas" id="Notas" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <div class="custom-checkbox custom-control">                            
                                            <input type="checkbox" id="check3" value="1"  class="custom-control-input" checked/>
                                            <label class="custom-control-label" for="check3">Activo</label>
                                        </div>   
                                    </div>   
                                </div>       
                                <button type="button" class="mt-2 btn btn-primary btnGuardar" id="btn_nuevo_0">Guardar</button>
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
                            
                           
                        </div>    
                    </div><!-- /.box-body -->
                </div>    
            </div>
        </div>    
    </div>
</div>

<script src="dist/js/articulos.js"></script>
        <?php include_once("footer.php");?>