<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<!-- <link rel="stylesheet" href="dist/css/base.css"> -->
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
                                                <label for="exampleEmail11" class="" id="EquipId">EquipId</label>
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
                                        <div class="col-md-2">
                                            <div class="position-relative form-group">
                                                <div class="custom-checkbox custom-control">                            
                                                    <input type="checkbox" id="check3" value="1"  class="custom-control-input" checked/>
                                                        <label class="custom-control-label" for="check3">Activo</label>
                                                </div>
                                            </div>            
                                        </div>   
                                    </div>
                                </div>
                            </div>                  
                        </form>
                                        <!-- ===================================INICIA INFORMACION TECNICA============================================ -->     
                        <div id="accordion" class="accordion-wrapper mb-3">
                            <div class="card">
                                <!-- <div id="headingThree" class="card-header"> -->
                                    <button type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                            <i class="header-icon pe-7s-tools icon-gradient bg-amy-crisp"> </i>
                                                    Información Técnica
                                        </div>
                                    </button>
                                <!-- </div> -->
                                <div data-parent="#accordion" id="collapseOne3" class="collapse">
                                    <div class="card-body">
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
                                                    <label for="exampleEmail11" class="">---------Intervalo de </label>
                                                        <input type="text" class="form-control" id="Intervalo" name="Intervalo" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail11" class="">Calibración----------</label>
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
                                    </div>   
                                </div>                                  
                            </div>
                        </div>   
                    </div>
                </div>

        
                <!-- ===================================INICIA AGREGAR SERVICIOS============================================ -->     
                <div id="accordion" class="accordion-wrapper mb-3">
                    <div class="card">
                        <div id="headingThree" class="card-header">
                            <button type="button" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseThree" class="text-left m-0 p-0 btn btn-link btn-block">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon pe-7s-pin icon-gradient bg-amy-crisp"> </i>
                                            Agregar servicios
                                </div>
                            </button>
                        </div>
                        <div data-parent="#accordion" id="collapseOne4" class="collapse">
                            <div class="card-body">
                                <div class="row">  
                                    <div class="col-md-6"> 
                                        <div class="main-card mb-8 card">
                                            <!-- <div class="card-body"> -->
                                                <div id="accordion" class="accordion-wrapper mb-3">
                                                    <div class="card">
                                                        <div id="headingOne" class="card-header">
                                                            <button type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block" id ="serDisponibles">
                                                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                                    <i class="header-icon pe-7s-tools icon-gradient bg-amy-crisp"> </i>
                                                                                Servicios Disponibles
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse show">
                                                            <div class="card-body">
                                                                <div id="div_registros2" class="box-body">
                                                                    <table id="tablaServicios" class="table table-bordered table-striped dataTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No. Catálogo</th>
                                                                                <th>Servicio</th>
                                                                                <th>Precio</th>
                                                                                <th>Agregar</th>                                                            
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card serAgregados">
                                                        <div id="headingTwo" class="b-radius-0 card-header">
                                                            <button type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                                    <i class="header-icon pe-7s-tools icon-gradient bg-amy-crisp"> </i>
                                                                                    Servicios Agregados
                                                                </div>
                                                            </button>
                                                        </div>
                                                        <div data-parent="#accordion" id="collapseOne2" class="collapse">
                                                            <div class="card-body">
                                                                <div id="div_registros3" class="box-body">
                                                                    <table id="tablaServiciosAgregados" class="table table-bordered table-striped dataTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No. Catálogo</th>
                                                                                <th>Servicio</th>
                                                                                <th>Precio</th>                                                                                                                                  
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                    </div> 
                                    <div class="col-md-6"> 
                                        <div class="main-card mb-8 card">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                    <!-- <i class="header-icon pe-7s-note2 icon-gradient bg-happy-itmeo"> </i> -->
                                                    Información de Servicio
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" name="idServicio" id="idServicio" class="">0</label>
                                                            <label for="exampleEmail11" class="">No.Catálogo</label>
                                                            <input type="text" class="form-control" id="NoCatalogo" name="NoCatalogo" readonly="" required/>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Servicio</label>
                                                                <textarea name="Servicio" id="Servicio" class="form-control" readonly=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Unidad</label>
                                                            <textarea name="Unidad" id="Unidad" class="form-control" readonly=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Observaciones</label>
                                                            <textarea name="Observaciones" id="Observaciones" class="form-control" readonly=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Comentarios</label>
                                                                <textarea name="Comentarios" id="Comentarios" class="form-control" readonly=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Precio Base</label>
                                                                <input type="text" class="form-control" id="PrecioBase" name="PrecioBase" readonly="" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="position-relative form-group">
                                                            <label for="exampleEmail11" class="">Precio para Artículo</label>
                                                                <input type="text" class="form-control" id="Precio" name="Precio" required/>
                                                        </div>
                                                    </div>
                                                </div>              
                                                <button type="button" class="mt-2 btn btn-primary float-right btnAgregar" id="btn_nuevo_0">Agregar</button>
                                            </div>
                                        </div>
                                    </div>     
                                </div>     
                            </div>
                        </div>                       
                    </div>
               
                <button type="button" class="mt-2 btn btn-primary btnGuardar float-right"  id="btn_nuevo_0">Guardar</button>
                <button type="button" class="mt-2 btn btn-primary btnEditarG float-right" >Editar</button>    
                </div>
            </div>  
            <!-- ===================================TERMINA AGREGAR SERVICIOS============================================ -->   
            <!-- ===================================INICIA PESTAÑA DE CONSULTAR============================================ -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div  class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Lista de Artículos</h5> 
                        <div id="div_registros" class="box-body">
                            <table id="tablaArticulos" class="table table-bordered table-striped dataTable">
                                <thead>
                                <tr>
                                    <th>Num. Artículo</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Exactitud</th>
                                    <th>Rango</th>
                                    <th>Seleccionar</th>
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

<script src="dist/js/articulos.js"></script>
        <?php include_once("footer.php");?>