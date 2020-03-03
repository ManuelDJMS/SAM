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
                        <i class="lnr-earth icon-gradient bg-tempting-azure">
                        </i>
                    </div>
                    <div>Direcciones
                        <div class="page-title-subheading">Registra direcciones de las distintas sucursales de cada empresa.
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
                    <div class="card-body">
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
                        //    if(isset($_Modificar))
                        //    {
                           /*  if(isset($_Modificar_Boton))
                            {
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
                                $sql="UPDATE EmpresasOrdenadas SET RazonSocial=(?) WHERE ClaveEmpresa=?";
                                $params2 = array($_RazonSocial, $_nempresa);
                                $conexion->ejecutaSQLTransac($sql, $params2);
                               // ================== CODIGO DE ALERTA DE GUARDADO =========================
                               echo "<script>";
                               echo "function alerta(){";
                               echo "swal({";
                                   echo "title: '¡Actualización!',";
                                   echo "text: 'Empresa actualizada correctamente',";
                                   echo "type: 'success',";
                                   echo "});";
                               echo "}";
                               echo "alerta();";              
                               echo "</script>";
                               // ==========================================================================
                            //    unset($_POST['Modificar']);
                            }
                        //    } */
                               
                        ?> 
                        <form class="" id="signupForm" action="contactos2.php" method="post">
                        <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item"><a data-toggle="tab" href="#tab-eg115-0" class="active nav-link">Datos Fiscales</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#tab-eg115-1" class="nav-link">Datos de Consignación</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#tab-eg115-2" class="nav-link">Datos de Envío</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab-eg115-0" role="tabpanel"><!-- AQUI INICIA EL DIV DEL DATOS FISCALES -->
                                                        <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label for="exampleEmail11" class="">Direccion</label>
                                                                        <input type="text" class="form-control" id="DireccionF" name="DireccionF" placeholder=""/>
                                                                    </div>
                                                                </div>
                                                                    <div id="Pais1" style="display: none;">      
                                                                            <div class="col-md-8">
                                                                                <div class="position-relative form-group">
                                                                                    <label for="exampleEmail11" class="">Pais</label>
                                                                                    <input type="text" class="form-control" id="Pais" name="Pais" placeholder=""/>
                                                                                </div>
                                                                            </div>  
                                                                        </div> 
                                                                    <label for="exampleText" class=""></label>
                                                                        <div class="custom-checkbox custom-control">                            
                                                                            <input type="checkbox" name="check" id="check" value="1"  class="custom-control-input" onchange="javascript:showContent()" checked />
                                                                            <label class="custom-control-label" for="check">NACIONAL</label>
                                                                            </div>                       
                                                            </div>
                                                        <div class="form-row">
                                                            <div class="position-relative form-group"> 
                                                                <label for="exampleSelect" class="">Estado</label>
                                                                    <div id="EstadoNacional" >       
                                                                            <select name="Estado" id="Estado" class="form-control">
                                                                                <option>Aguascalientes</option>
                                                                                <option>Baja California</option>
                                                                                <option>Baja California Sur</option>
                                                                                <option>Campeche</option>
                                                                                <option>Chiapas</option>
                                                                                <option>Chihuahua</option>
                                                                                <option>Ciudad de México</option>
                                                                                <option>Coahuila</option>
                                                                                <option>Colima</option>
                                                                                <option>Durango</option>
                                                                                <option>Estado de México</option>
                                                                                <option>Guanajuato</option>
                                                                                <option>Guerrero</option>
                                                                                <option>Hidalgo</option>
                                                                                <option>Jalisco</option>
                                                                                <option>Michoacán</option>
                                                                                <option>Morelos</option>
                                                                                <option>Nayarit</option>
                                                                                <option>Nuevo León</option>
                                                                                <option>Oaxaca</option>
                                                                                <option>Puebla</option>
                                                                                <option>Querétaro</option>
                                                                                <option>Quintana Roo</option>
                                                                                <option>San Luis Potosí</option>
                                                                                <option>Sinaloa</option>
                                                                                <option>Sonora</option>
                                                                                <option>Tabasco</option>
                                                                                <option>Tamaulipas</option>
                                                                                <option>Tlaxcala</option>
                                                                                <option>Veracruz</option>
                                                                                <option>Yucatán</option>
                                                                                <option>Zacatecas</option>
                                                                            </select> 
                                                                        </div> 
                                                                    <div id="EstadoInternacional" style="display: none;">
                                                                            <div class="position-relative form-group">
                                                                                <input type="text" class="form-control" id="Estado" name="Estado" placeholder=""/>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                              
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                        <label for="exampleEmail11" class="">Ciudad</label>
                                                                        <input type="text" class="form-control" id="Ciudad" name="Ciudad" placeholder=""/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                        <label for="exampleEmail11" class="">Código Postal</label>
                                                                        <input type="text" class="form-control" id="CP" name="CP" placeholder=""/>
                                                                    </div>
                                                                </div>      
                                                            </div>      
                                                        </div><!-- AQUI TERMINA EL DIV DEL DATOS FISCALES -->
                                                <div class="tab-pane" id="tab-eg115-1" role="tabpanel"><!-- AQUI INICIA EL DIV DEL DATOS DE CONSIGNACION -->
                                                    <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                        <label for="exampleEmail11" class="">Direccion</label>
                                                                        <input type="text" class="form-control" id="DireccionC" name="DireccionC" placeholder=""/>
                                                                    </div>
                                                                </div>
                                                                    <div id="Pais2" style="display: none;">      
                                                                            <div class="col-md-8">
                                                                                <div class="position-relative form-group">
                                                                                    <label for="exampleEmail11" class="">Pais</label>
                                                                                    <input type="text" class="form-control" id="PaisFiscal" name="PaisFiscal" placeholder=""/>
                                                                                </div>
                                                                            </div>  
                                                                        </div> 
                                                                    <label for="exampleText" class=""></label>
                                                                        <div class="custom-checkbox custom-control">                            
                                                                            <input type="checkbox" name="check1" id="check1" value="1"  class="custom-control-input" onchange="javascript:showContent()" checked />
                                                                            <label class="custom-control-label" for="check1">NACIONAL</label>
                                                                            </div>          
                                                                     </div>
                                                        <div class="form-row">
                                                            <div class="position-relative form-group"> 
                                                                <label for="exampleSelect" class="">Estado</label>
                                                                    <div id="EstadoNacionalC" >       
                                                                            <select name="EstadoFiscalC" id="EstadoFiscalC" class="form-control">
                                                                                <option>Aguascalientes</option>
                                                                                <option>Baja California</option>
                                                                                <option>Baja California Sur</option>
                                                                                <option>Campeche</option>
                                                                                <option>Chiapas</option>
                                                                                <option>Chihuahua</option>
                                                                                <option>Ciudad de México</option>
                                                                                <option>Coahuila</option>
                                                                                <option>Colima</option>
                                                                                <option>Durango</option>
                                                                                <option>Estado de México</option>
                                                                                <option>Guanajuato</option>
                                                                                <option>Guerrero</option>
                                                                                <option>Hidalgo</option>
                                                                                <option>Jalisco</option>
                                                                                <option>Michoacán</option>
                                                                                <option>Morelos</option>
                                                                                <option>Nayarit</option>
                                                                                <option>Nuevo León</option>
                                                                                <option>Oaxaca</option>
                                                                                <option>Puebla</option>
                                                                                <option>Querétaro</option>
                                                                                <option>Quintana Roo</option>
                                                                                <option>San Luis Potosí</option>
                                                                                <option>Sinaloa</option>
                                                                                <option>Sonora</option>
                                                                                <option>Tabasco</option>
                                                                                <option>Tamaulipas</option>
                                                                                <option>Tlaxcala</option>
                                                                                <option>Veracruz</option>
                                                                                <option>Yucatán</option>
                                                                                <option>Zacatecas</option>
                                                                            </select> 
                                                                        </div> 
                                                                    <div id="EstadoInternacionalC" style="display: none;">
                                                                            <div class="position-relative form-group">
                                                                                <input type="text" class="form-control" id="EstadoC" name="EstadoC" placeholder=""/>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                              
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                        <label for="exampleEmail11" class="">Ciudad</label>
                                                                        <input type="text" class="form-control" id="CiudadC" name="CiudadC" placeholder=""/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                        <label for="exampleEmail11" class="">Código Postal</label>
                                                                        <input type="text" class="form-control" id="CPC" name="CPC" placeholder=""/>
                                                                    </div>
                                                                </div>      
                                                            </div>  
                                                    </div><!-- AQUI TERMINA EL DIV DEL DATOS DE CONSIGNACION -->
                                                <div class="tab-pane" id="tab-eg115-2" role="tabpanel"><!-- AQUI INICIA EL DIV DEL DATOS DE ENVIO -->
                                                    <div class="form-row">
                                                                    <div class="col-md-6">
                                                                        <div class="position-relative form-group">
                                                                            <label for="exampleEmail11" class="">Direccion</label>
                                                                            <input type="text" class="form-control" id="DireccionE" name="DireccionE" placeholder=""/>
                                                                        </div>
                                                                    </div>
                                                                        <div id="Pais3" style="display: none;">      
                                                                                <div class="col-md-8">
                                                                                    <div class="position-relative form-group">
                                                                                        <label for="exampleEmail11" class="">Pais</label>
                                                                                        <input type="text" class="form-control" id="PaisEnvio" name="PaisEnvio" placeholder=""/>
                                                                                    </div>
                                                                                </div>  
                                                                            </div> 
                                                                        <label for="exampleText" class=""></label>
                                                                            <div class="custom-checkbox custom-control">                            
                                                                                <input type="checkbox" name="check2" id="check2" value="1"  class="custom-control-input" onchange="javascript:showContent()" checked />
                                                                                <label class="custom-control-label" for="check2">NACIONAL</label>
                                                                                </div>                       
                                                                </div>
                                                            <div class="form-row">
                                                                <div class="position-relative form-group"> 
                                                                    <label for="exampleSelect" class="">Estado</label>
                                                                        <div id="EstadoNacionalE" >       
                                                                                <select name="EstadoEnvio" id="EstadoEnvio" class="form-control">
                                                                                    <option>Aguascalientes</option>
                                                                                    <option>Baja California</option>
                                                                                    <option>Baja California Sur</option>
                                                                                    <option>Campeche</option>
                                                                                    <option>Chiapas</option>
                                                                                    <option>Chihuahua</option>
                                                                                    <option>Ciudad de México</option>
                                                                                    <option>Coahuila</option>
                                                                                    <option>Colima</option>
                                                                                    <option>Durango</option>
                                                                                    <option>Estado de México</option>
                                                                                    <option>Guanajuato</option>
                                                                                    <option>Guerrero</option>
                                                                                    <option>Hidalgo</option>
                                                                                    <option>Jalisco</option>
                                                                                    <option>Michoacán</option>
                                                                                    <option>Morelos</option>
                                                                                    <option>Nayarit</option>
                                                                                    <option>Nuevo León</option>
                                                                                    <option>Oaxaca</option>
                                                                                    <option>Puebla</option>
                                                                                    <option>Querétaro</option>
                                                                                    <option>Quintana Roo</option>
                                                                                    <option>San Luis Potosí</option>
                                                                                    <option>Sinaloa</option>
                                                                                    <option>Sonora</option>
                                                                                    <option>Tabasco</option>
                                                                                    <option>Tamaulipas</option>
                                                                                    <option>Tlaxcala</option>
                                                                                    <option>Veracruz</option>
                                                                                    <option>Yucatán</option>
                                                                                    <option>Zacatecas</option>
                                                                                </select> 
                                                                            </div> 
                                                                        <div id="EstadoInternacionalE" style="display: none;">
                                                                                <div class="position-relative form-group">
                                                                                    <input type="text" class="form-control" id="EstadoE" name="EstadoE" placeholder=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                              
                                                                    <div class="col-md-4">
                                                                        <div class="position-relative form-group">
                                                                            <label for="exampleEmail11" class="">Ciudad</label>
                                                                            <input type="text" class="form-control" id="CiudadE" name="CiudadE" placeholder=""/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="position-relative form-group">
                                                                            <label for="exampleEmail11" class="">Código Postal</label>
                                                                            <input type="text" class="form-control" id="CPE" name="CPE" placeholder=""/>
                                                                        </div>
                                                                    </div>      
                                                                </div>
                                                            </div>
                                                    </div><!-- AQUI TERMINA EL DIV DEL DATOS DE ENVIO -->
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
                </div><!-- AQUI TERMINA EL DIV DEL TAB --> 
        </div>
    </div>
    <!--  HABILITAR/DESABILITAR CAMPOS -->
        <script>
            function habilitar(value)
                {
                    if(value==true)
                    {
                        // habilitamos
                        document.getElementById("Estado").disabled=false;
                    }else if(value==false){
                        // deshabilitamos
                        document.getElementById("Estado").disabled=true;
                    }
                }
            </script>
      <!--  MOSTRAR/OCULTAR CAMPOS PARA NACIONAL -->
        <script type="text/javascript">
            function showContent() {
                InputEstado = document.getElementById("EstadoInternacional");
                ComboEstado = document.getElementById("EstadoNacional");
                InputEstadoC = document.getElementById("EstadoInternacionalC");
                ComboEstadoC = document.getElementById("EstadoNacionalC");
                InputEstadoE = document.getElementById("EstadoInternacionalE");
                ComboEstadoE = document.getElementById("EstadoNacionalE");
                check = document.getElementById("check");
                check1 = document.getElementById("check1");
                check2 = document.getElementById("check2");
                Pais = document.getElementById("Pais1");
                Pais1 = document.getElementById("Pais2");
                Pais2 = document.getElementById("Pais3");
                if (check.checked) {
                    InputEstado.style.display='none';
                    ComboEstado.style.display='block';
                    Pais.style.display = 'none';
                    }
                else {
                    InputEstado.style.display='block';
                    ComboEstado.style.display='none';     
                    Pais.style.display = 'block';
                    }
                if (check1.checked) {
                    InputEstadoC.style.display='none';
                    ComboEstadoC.style.display='block';
                    Pais1.style.display = 'none';
                    }
                else {
                    InputEstadoC.style.display='block';
                    ComboEstadoC.style.display='none';
                    Pais1.style.display = 'block';
                    }
                if (check2.checked) {
                    InputEstadoE.style.display='none';
                    ComboEstadoE.style.display='block';
                    Pais2.style.display = 'none';
                    }
                else {
                    InputEstadoE.style.display='block';
                    ComboEstadoE.style.display='none';
                    Pais2.style.display = 'block';
                    }
                }
            </script>     
     <?php include_once("footer.php");?>