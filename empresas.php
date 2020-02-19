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
                        <?php 
                            extract($_POST, EXTR_PREFIX_ALL, '');
                            if(isset($_RazonSocial))
                            { 
                                $objUsuario='';
                                $conexion=new Conexion();
                                $conexion->conectar();
                                $tipo=$_RazonSocial.', '.$_TipoEmpresa;
                                if (!isset($_CVentas)) 
	                            {
                                    $_CVentas=0;
                                }
                                if (!isset($_CCursos)) 
	                            {
                                    $_CCursos=0;
                                }
                                if (!isset($_CGestoria)) 
	                            {
                                    $_CGestoria=0;
                                }
                                $sql='INSERT INTO EmpresasOrdenadas (RazonSocial,RFC,Credito,ObservacionesEmpresa, Ventas, Cursos, Gestoria) VALUES (?,?,?,?,?,?,?)';
                                $params2 = array(utf8_decode($tipo), $_RFC, utf8_decode($_Credito), utf8_decode($_Observaciones),$_CVentas, $_CCursos, $_CGestoria);
                                $conexion->ejecutaSQLTransac($sql, $params2);
                                // ================== CODIGO DE ALERTA DE GUARDADO =========================
                                echo "<script>";
                                echo "function alerta(){";
                                echo "swal({";
                                    echo "title: '¡Guardado!',";
                                    echo "text: 'Empresa guardada correctamente',";
                                    echo "type: 'success',";
                                    echo "});";
                                echo "}";
                                echo "alerta();";              
                                echo "</script>";
                                // ==========================================================================
                                
                           }
                               
                        ?> 
                        <form class="" id="signupForm" action="empresas.php" method="post">
                            <div class="form-row">

                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Razón Social</label>
                                        <input type="text" class="form-control" id="RazonSocial" name="RazonSocial" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                <div class="position-relative form-group"><label for="exampleCustomSelect" class="">Tipo</label><select type="select" id="exampleCustomSelect" name="TipoEmpresa" class="custom-select">
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
                                                        </select></div></div>
                                <div class="col-md-5">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">RFC</label>
                                        <input name="RFC" id="examplePassword11" class="form-control">
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">RFC</label>
                                        <input name="RFC" id="examplePassword11" class="form-control">
                                    </div>
                                </div> -->
                              
                            </div>
                            <div class="position-relative form-group">
                                <label for="exampleText" class="">Observaciones de la empresa</label>
                                <textarea name="Observaciones" id="exampleText" class="form-control"></textarea>
                            </div>
                            <div class="form-row">              
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Crédito</label>
                                    <select name="Credito" id="exampleSelect" class="form-control">
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
                            <input type="submit" class="mt-2 btn btn-primary" value="Guardar"></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Grid</h5>
                        <form class="">
                            <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10"><input name="email" id="exampleEmail" placeholder="with a placeholder" type="email" class="form-control"></div>
                            </div>
                            <div class="position-relative row form-group"><label for="examplePassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10"><input name="password" id="examplePassword" placeholder="password placeholder" type="password" class="form-control"></div>
                            </div>
                            <div class="position-relative row form-group"><label for="exampleSelect" class="col-sm-2 col-form-label">Select</label>
                                <div class="col-sm-10"><select name="select" id="exampleSelect" class="form-control"></select></div>
                            </div>
                            <div class="position-relative row form-group"><label for="exampleSelectMulti" class="col-sm-2 col-form-label">Select Multiple</label>
                                <div class="col-sm-10"><select multiple="" name="selectMulti" id="exampleSelectMulti" class="form-control"></select></div>
                            </div>
                            <div class="position-relative row form-group"><label for="exampleText" class="col-sm-2 col-form-label">Text Area</label>
                                <div class="col-sm-10"><textarea name="text" id="exampleText" class="form-control"></textarea></div>
                            </div>
                            <div class="position-relative row form-group"><label for="exampleFile" class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10"><input name="file" id="exampleFile" type="file" class="form-control-file">
                                    <small class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                                </div>
                            </div>
                            <fieldset class="position-relative row form-group">
                                <legend class="col-form-label col-sm-2">Radio Buttons</legend>
                                <div class="col-sm-10">
                                    <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Option one is this and that—be sure to include why it's great</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Option two can be something else and selecting it will deselect option
                                        one</label></div>
                                    <div class="position-relative form-check disabled"><label class="form-check-label"><input name="radio2" disabled="" type="radio" class="form-check-input"> Option three is disabled</label></div>
                                </div>
                            </fieldset>
                            <div class="position-relative row form-group"><label for="checkbox2" class="col-sm-2 col-form-label">Checkbox</label>
                                <div class="col-sm-10">
                                    <div class="position-relative form-check"><label class="form-check-label"><input id="checkbox2" type="checkbox" class="form-check-input"> Check me out</label></div>
                                </div>
                            </div>
                            <div class="position-relative row form-check">
                                <div class="col-sm-10 offset-sm-2">
                                    <button class="btn btn-secondary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

     <?php include_once("footer.php");?>