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
                        <i class="lnr-user icon-gradient bg-sunny-morning">
                        </i>
                    </div>
                    <div>Contactos
                        <div class="page-title-subheading">Crea y modifica los contactos de cada una de las empresas.
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
                    <div class="card-body"><h5 class="card-title">Informacion Personal</h5>
                        <?php 
                            extract($_POST, EXTR_PREFIX_ALL, '');
                            $conexion=new Conexion();
                            $conexion->conectar();
                            
                            if(isset($_Guardar))
                            { 
                                $objUsuario='';
                                $fecha = date("d-m-Y");
                                if (!isset($_CActivo)) 
	                            {
                                    $_CActivo=0;
                                }
                                $sql='INSERT INTO Contactos (IdDireccion,Nombre,Apellidos,Cargo,Celular,Tel,Fax,Ext,Email,CondicionesClienteAdmon,Descuento,Activo,FechaCreacion,CreadoPor,FechaModificacion,ModificadoPor) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                                $params2 = array(1,$_Nombre, $_Apellido,$_Cargo,$_Celular,$_Telefono,$_Fax,$_Ext,$_Email,$_Condiciones,$_Descuento,$_CActivo,$fecha,'IT',$fecha,'IT');
                                $conexion->ejecutaSQL($sql, $params2);
                                // ================== CODIGO DE ALERTA DE GUARDADO =========================
                                echo "<script>";
                                echo "function alerta(){";
                                echo "swal({";
                                    echo "title: '¡Guardado!',";
                                    echo "text: 'Contacto guardado correctamente',";
                                    echo "type: 'success',";
                                    echo "});";
                                echo "}";
                                echo "alerta();";              
                                echo "</script>";
                                // ==========================================================================
                                
                           }    
                        ?> 
                        <form class="" id="signupForm" action="contactos.php" method="post">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Nombre</label>
                                        <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Apellido</label>
                                        <input name="Apellido" id="Apellido" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                        <label for="examplePassword11" class="">Cargo</label>
                                        <input name="Cargo" id="Cargo" class="form-control">
                                    </div>
                                </div>                             
                            </div>
                            <div class="form-row">
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Celular</label>
                                            <input name="Celular" id="Celular" class="form-control">
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Telèfono</label>
                                            <input name="Telefono" id="Telefono" class="form-control">
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Extensiòn</label>
                                            <input name="Ext" id="Ext" class="form-control">
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Fax</label>
                                            <input name="Fax" id="Fax" class="form-control">
                                        </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="position-relative form-group">
                                            <label for="examplePassword11" class="">Email</label>
                                            <input name="Email" id="Email" class="form-control">
                                        </div>
                                </div>
                                <div class="position-relative form-group"> 
                                    <label for="exampleSelect" class="">Descuento</label>
                                    <select name="Descuento" id="Descuento" class="form-control">
                                        <option>0</option>
                                        <option>3</option>
                                        <option>5</option>
                                        <option>10</option>
                                    </select>  
                                </div>        
                            </div>
                            <div class="form-row">
                                <div class="position-relative form-group">
                                    <label for="exampleText" class="">Condiciones del cliente</label>
                                    <textarea name="Condiciones" id="Condiciones" class="form-control"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label for="exampleText" class=""></label>
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="exampleCustomCheckbox1" class="custom-control-input" name="CActivo" value="1">
                                            <label class="custom-control-label" for="exampleCustomCheckbox1">Activo</label>
                                        </div>
                                </div>              
                            </div> 
                            <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Direcciones</h5>
                                        <div class="collapse" id="collapseExample123"><p>AQUI VAN LOS CAMPOS PO LOS QUE SE VA BUSCAR</p>
                                            <p>AQUI VA EL GRID CON LA CONSULTA. 
                                            EN PROCESO....</p></div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" data-toggle="collapse" href="#collapseExample123" class="btn btn-primary">Agregar Dirección</button>
                                    </div>
                                </div>                     
                            <input type="submit" class="mt-2 btn btn-primary" value="Guardar" name="<?php  if(isset($_Modificar))
                            { echo 'Modificar_Boton';}else {echo'Guardar';}?>"></button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
            <!--  <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div class="main-card mb-3 card">
                   
                        <form class="form-inline">
                            <div class="card-header">
                                <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                    <i class="header-icon pe-7s-search icon-gradient bg-plum-plate"> </i>Buscar por:
                                </div>
                                <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                    <label for="exampleEmail22" class="mr-sm-2">Clave Cliente</label>
                                    <input name="CveEmpresa" id="CveEmpresa" class="form-control">
                                </div>
                                <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                    <label for="examplePassword22" class="mr-sm-2">Nombre</label>
                                    <input name="RazonSocial" id="RazonSocial" class="form-control">
                                </div>
                                <div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                    <label for="examplePassword22" class="mr-sm-2">Correo</label>
                                    <input name="RFC" id="RFC" class="form-control">
                                </div>
                            </div> 
                        </form>
                         <div class="divider"></div> 
                         <div class="card-body" id="datos">
                         </div> <!-- AQUI TERMINA EL DIV "CAR BODY"-->
                </div> <!-- AQUI TERMINA EL DIV DEL MAIN DEL TAB -->
                </div><!-- AQUI TERMINA EL DIV DEL TAB --> -->
        </div>
    </div>
     <?php include_once("footer.php");?>