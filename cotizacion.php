<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="lnr-file-empty icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Cotización
                        <div class="page-title-subheading">Registra y consulta cotizaciones.
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
                <form class="" id="signupForm" action="cotizacion.php" method="post">
                    <div class="col-md-6">  
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="form-row">
                                    <label for="exampleEmail11" class="">Cotización Número: </label>
                                    <label for="exampleEmail11" class=""> #</label>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword11" class="">Empresa</label>
                                                <input name="Empresa" id="Empresa" class="form-control">
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword11" class="">Cliente</label>
                                                <input name="Cliente" id="Cliente" class="form-control">
                                                </div>
                                            </div>
                                    </div>                 
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <div class="position-relative form-group">
                                                    <label for="examplePassword11" class="">Referencia</label>
                                                    <input name="Referencia" id="Referencia" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword11" class="">Condición</label>
                                                    <input name="Condiciones" id="Condiciones" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword11" class="">Modo de contabilizar</label>
                                                    <input name="contabilizar" id="Contabilizar" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group">
                                                    <label for="exampleSelect" class="">Servicio En</label>
                                                        <select name="Servicio" id="exampleSelect" class="form-control">
                                                            <option>MetAs-Guzmán</option>
                                                            <option>MetAs-Guadalajara</option>
                                                            <option>MetAs-Queretaro</option>
                                                            <option>Campo</option>
                                                    </select>  
                                                </div>
                                            </div>
                                            <div class="container">
                                                <div class="position-relative form-group">
                                                    <label for="exampleText" class="">Observaciones</label>
                                                    <textarea name="Observaciones" id="exampleText" class="form-control" placeholder="*La cotización fue realizada en base a la información recibida. Cualquier diferencia entre su solicitud y esta cotización contactar a Ventas*"></textarea>
                                                </div>
                                            </div>
                                        </div>                                 
                            </div>                           
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                            <div class="card-body"><h5 class="card-title">Primary Card Shadow</h5>With supporting text below as a natural lead-in to additional content.</div>
                                    </div>
                                <div class="col-md-6">
                                    <div class="main-card mb-3 card">   
                                        <div class="card-body"><h5 class="card-title">Primary Card Border</h5>With supporting text below as a natural lead-in to additional content.</div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <input type="submit" class="mt-2 btn btn-primary" value="Guardar" name="<?php  if(isset($_Modificar))
                                { echo 'Modificar_Boton';}else {echo'Guardar';}?>"></button> 
                </form>
            </div>
        </div>
    </div>

     <?php include_once("footer.php");?>