<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<link rel="stylesheet" href="dist/css/base.css">
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script> 
<div class="app-main__outer"> <!-- DIV PRINCIPAL -->
    <div class="app-main__inner"> <!-- DIV PAPP_INNER -->
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-sunny-morning">
                        </i>
                    </div>
                    <div>Servicios
                        <div class="page-title-subheading">Crea y modifica los servicios utilizados en Metas SA. de CV.
                        </div>
                    </div>
                </div>
            </div>
        </div>            
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                    <span>Nuevo</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                    <span>Consultar</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- **************************************************** AQUI EMPIEZA EL TAB 0  *************************************************************************-->
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <form id="signupForm">
                        <div class="card-body">
                            <div id="smartwizard3" class="forms-wizard-vertical">
                                <ul class="forms-wizard">
                                    <li>
                                        <a href="#step-122">
                                            <em>1</em><span>Información del Equipo</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-222">
                                            <em>2</em><span>Acreditamiento y Referencias</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-444">
                                            <em>2</em><span>Observaciones, Comentarios, etc...</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-322">
                                            <em>3</em><span>Terminar</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="form-wizard-content"> <!-- AQUI EMPIEZA EL DIV QUE CONTIENE TODO EL FORM -->
                                    <div id="step-122"><!-- *************************************** EMPIEZA EL DIV DE LA SECCION "INFORMACION DEL EQUIPO *******************************************" -->
                                        <div class="card-body">
                                            <!-- =================================== AQUI COMIENZA EL PRIMER RENGLON DE "INFORORMACION DEL EQUIPO" ================================================= -->
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">NoCatalogo</label>
                                                        <input type="text" class="form-control" id="NoCatalogo" name="NoCatalogo" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="position-relative form-group">
                                                        <label for="examplePassword11" class="">Instrumento</label>
                                                        <input name="Instrumento" id="Instrumento" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleCustomSelect" class="">Laboratorio</label>
                                                        <select type="select" id="Laboratorio" class="custom-select">
                                                            <option></option>
                                                            <option value="Densidad">Densidad</option>
                                                            <option value="Dimensional">Dimensional</option>
                                                            <option value="Eléctrica">Eléctrica</option>
                                                            <option value="Humedad">Humedad</option>
                                                            <option value="Masa">Mediciones Especiales</option>
                                                            <option value="Óptica">Óptica</option>
                                                            <option value="Presión & Vacío">Presión & Vacío</option>
                                                            <option value="Temperatura">Temperatura</option>
                                                            <option value="Temperatura de Radiancia">Temperatura de Radiancia</option>
                                                            <option value="Vibraciones">Vibraciones</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =================================== AQUI TERMINA EL PRIMER RENGLON DE "INFORORMACION DEL EQUIPO" ================================================= -->
                                            <!-- =================================== AQUI INICIA EL SEGUNDO RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <div class="form-row">  
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleCustomSelect" class="">Lugar de calibración</label>
                                                        <select type="select" id="LugardeCalibracion" class="custom-select">
                                                            <option></option>
                                                            <option value="En Campo">En Campo</option>
                                                            <option value="Laboratorio">Laboratorio</option>
                                                            <option value="Laboratorio/En Campo">Laboratorio/En Campo</option>
                                                            <option value="Servicio en LAB MetAs QRO">Servicio en LAB MetAs QRO</option>
                                                        </select>
                                                    </div>
                                                </div>   
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleCustomSelect" class="">Magnitud</label>
                                                        <select type="select" id="Magnitud" name="Magnitud" class="custom-select">
                                                            <option></option>
                                                            <option value="Densidad.">Densidad</option>
                                                            <option value="Dimensional">Dimensional</option>
                                                            <option value="Eléctrica">Eléctrica</option>
                                                            <option value="Humedad">Humedad</option>
                                                            <option value="Masa">Mediciones Especiales</option>
                                                            <option value="Óptica">Óptica</option>
                                                            <option value="Presión & Vacío">Presión & Vacío</option>
                                                            <option value="Temperatura">Temperatura</option>
                                                            <option value="Temperatura de Radiancia">Temperatura de Radiancia</option>
                                                            <option value="Vibraciones">Vibraciones</option>
                                                            <option value="Aceleración Alternate">Aceleración Alternate</option>
                                                            <option value="Densidad Absoluta.">Densidad Absoluta.</option>
                                                            <option value="Densidad relativa ó absoluta.">Densidad relativa ó absoluta.</option>
                                                            <option value="Densidad relativa.">Densidad relativa.</option>
                                                            <option value="Dimensional.">Dimensional.</option>
                                                            <option value="Frecuencia de Rotación.">Frecuencia de Rotación.</option>
                                                            <option value="Humedad en equilibrio.">Humedad en equilibrio.</option>
                                                            <option value="Humedad relativa en aire.">Humedad relativa en aire.</option>
                                                            <option value="Icc, Vcc, Ica, Vca, Resistencia, Cap (F), simulación eléctrica (TC, RTD).">Icc, Vcc, Ica, Vca, Resistencia, Cap (F), simulación eléctrica (TC, RTD).</option>
                                                            <option value="Icc, Vcc, Ica, Vca, Resistencia.">Icc, Vcc, Ica, Vca, Resistencia.</option>
                                                            <option value="Masa Convencional & Volumen de Sólidos (pesas >= 1 g).">Masa Convencional & Volumen de Sólidos (pesas >= 1 g).</option>
                                                            <option value="Masa Convencional &">Masa Convencional &</option>
                                                            <option value="Volumen de Sólidos (pesas >= 1 g).">Volumen de Sólidos (pesas >= 1 g).</option>
                                                            <option value="Masa Convencional .">Masa Convencional .</option>
                                                            <option value="Masa Convencional.">Masa Convencional.</option>
                                                            <option value="Med. & Gen: Vcc; Icc; Fem; Res; 1 TC; 1 RTD.">Med. & Gen: Vcc; Icc; Fem; Res; 1 TC; 1 RTD.</option>
                                                            <option value="Óptica.">Óptica.</option>
                                                            <option value="Presión: Absoluta.">Presión: Absoluta.</option>
                                                            <option value="Presión: Atmosférica (Absoluta).">Presión: Atmosférica (Absoluta).</option>
                                                            <option value="Presión: Diferencial, Absoluta.">Presión: Diferencial, Absoluta.</option>
                                                            <option value="Presión: Diferencial.">Presión: Diferencial.</option>
                                                            <option value="Presión: Relativa, Absoluta o diferencial.">Presión: Relativa, Absoluta o diferencial.</option>
                                                            <option value="Presión: Relativa, Diferencial, Absoluta.">Presión: Relativa, Diferencial, Absoluta.</option>
                                                            <option value="Presión: Relativa, Diferencial.">Presión: Relativa, Diferencial.</option>
                                                            <option value="Presión: Relativa, Negativa, Diferencial.">Presión: Relativa, Negativa, Diferencial.</option>
                                                            <option value="Presión: Relativa, positiva & negativa.">Presión: Relativa, positiva & negativa.</option>
                                                            <option value="Presión: Relativa.">Presión: Relativa.</option>
                                                            <option value="Temperatura de punto de rocío.">Temperatura de punto de rocío.</option>
                                                            <option value="Temperatura de Radiancia.">Temperatura de Radiancia.</option>
                                                            <option value="Temperatura">Temperatura</option>
                                                            <option value="Humedad.">Humedad.</option>
                                                            <option value="Temperatura.">Temperatura.</option>
                                                            <option value="Unidades de ingeniería, pH (mV)">Unidades de ingeniería, pH (mV)</option>
                                                            <option value="Conductividad (S).">Conductividad (S).</option>
                                                            <option value="Volumen.">Volumen.</option>
                                                        </select>
                                                    </div>
                                                </div>  
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleCustomSelect" class="">Modalidad</label>
                                                        <select type="select" id="Modalidad" class="custom-select">
                                                            <option></option>
                                                            <option value="Laboratorio/En Campo">Laboratorio/En Campo</option>
                                                            <option value="Servicio en Campo">Servicio en Campo</option>
                                                            <option value="Servicio en LAB MetAs (ordinario)">Servicio en LAB MetAs (ordinario)</option>
                                                            <option value="Servicio en LAB MetAs (ordinario) ó CAMPO">Servicio en LAB MetAs (ordinario) ó CAMPO</option>
                                                            <option value="Servicio en LAB MetAs QRO (ordinario)">Servicio en LAB MetAs QRO (ordinario)</option>
                                                            <option value="Servicio en LAB MetAs QRO ó CAMPO">Servicio en LAB MetAs QRO ó CAMPO</option>
                                                            <option value="Servicio en MetAs (temporal) ó CAMPO">Servicio en MetAs (temporal) ó CAMPO</option>
                                                        </select>
                                                    </div>
                                                </div>  
                                            </div>
                                            <!-- =================================== AQUI TERMINA EL SEGUNDO RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <!-- =================================== AQUI INICIA EL TERCER RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <div class="form-row">    
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Precio Base</label>
                                                        <input type="text" class="form-control" id="PrecioBase" name="PrecioBase" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Precio Opción</label>
                                                        <input type="text" class="form-control" id="PrecioOpcion" name="PrecioOpcion"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Precio Campo</label>
                                                        <input type="text" class="form-control" id="PrecioCampo" name="PrecioCampo"/>
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- =================================== AQUI TERMINA EL TERCER RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <!-- =================================== AQUI INICIA EL CUARTO RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <div class="form-row">    
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Alcance</label>
                                                        <input type="text" class="form-control" id="Alcance"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Clase de Exactitud</label>
                                                        <input type="text" class="form-control" id="ClasedeExactitud"/>
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- =================================== AQUI TERMINA EL CUARTO RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <!-- =================================== AQUI INICIA EL QUINTO RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <div class="form-row">    
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Ajuste</label>
                                                        <input type="text" class="form-control" id="Ajuste"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Capacidad de Medición</label>
                                                        <input type="text" class="form-control" id="CapacidaddeMedicion"/>
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- =================================== AQUI TERMINA EL QUINTO RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <!-- =================================== AQUI INICIA EL SEXTO RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                            <div class="form-row">    
                                                <div class="col-md-12">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Puntos de Calibración</label>
                                                        <input type="text" class="form-control" id="Puntos"/>
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- =================================== AQUI TERMINA EL SEXTO RENGLON DE "INFORMACION DEL EQUIPO" ================================================== -->
                                        </div><!-- DIV CARD BODY -->
                                    </div> <!-- *************** AQUI TERMINA EL DIV DE LA SECCION "INFORMACION DEL EQUIPO ****************************" -->
                                    <div id="step-222"> <!-- *************** AQUI INICIA EL DIV DE LA SECCION ACREDITAMIENTO Y REFERENCIAS ****************************" -->
                                        <div class="card-body">
                                            <!-- =================================== AQUI INICIA EL PRIMER RENGLON DE "ACREDITAMINETO Y REFERENCIAS" ================================================== -->
                                            <div class="form-row">    
                                                <div class="col-md-12">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail11" class="">Acreditamiento</label>
                                                        <input type="text" class="form-control" id="Acreditamiento"/>
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- =================================== AQUI TERMINA EL PRIMER RENGLON DE "ACREDITAMIENTO Y REFERENCIAS" ================================================== -->
                                            <!-- =================================== AQUI INICIA EL SEGUNDO RENGLON DE "ACREDITAMINETO Y REFERENCIAS" ================================================== -->
                                            <div class="form-row">  
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleText" class="">Método de Calibración</label>
                                                        <textarea name="Observaciones" id="MetododeCalibracion" class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleText" class="">Resultados de Informe</label>
                                                        <textarea name="Observaciones" id="ResultadosdeInforme" class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =================================== AQUI TERMINA EL SEGUNDO RENGLON DE "ACREDITAMIENTO Y REFERENCIAS" ================================================== -->
                                            <!-- =================================== AQUI INICIA EL TERCER RENGLON DE "ACREDITAMINETO Y REFERENCIAS" ================================================== -->
                                            <div class="form-row">  
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleText" class="">Normas de Referencia</label>
                                                        <textarea name="Observaciones" id="NormasdeReferencia" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleText" class="">Patrones de Referencia</label>
                                                        <textarea name="Observaciones" id="PatronesdeReferencia" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =================================== AQUI TERMINA EL TERCER RENGLON DE "ACREDITAMIENTO Y REFERENCIAS" ================================================== -->
                                        </div><!-- DIV CARD BODY -->
                                    </div> <!-- *************** AQUI TERMINA EL DIV DE LA SECCION ACREDITAMIENTO Y REFERENCIAS ****************************" -->
                                    <div id="step-444"> <!-- *************** AQUI INICIA EL DIV DE LA SECCION OBSERVACIONES Y COMENTARIOS ****************************" -->
                                        <div class="card-body">
                                            
                                            <!-- =================================== AQUI INICIA EL TERCER RENGLON DE "ACREDITAMINETO Y REFERENCIAS" ================================================== -->
                                            <div class="form-row">  
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleText" class="">Observación Temporal</label>
                                                        <textarea name="Observaciones" id="ObservacionTemporal" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleText" class="">Comentarios</label>
                                                        <textarea name="Observaciones" id="Comentarios" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =================================== AQUI TERMINA EL TERCER RENGLON DE "OBSERVACIONES Y COMENTARIOS" ================================================== -->
                                            <!-- =================================== AQUI INICIA EL PRIMER RENGLON DE "OBSERVACIONES Y COMENTARIOS" ================================================== -->
                                            <div class="form-row">    
                                                <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                        <label for="exampleText" class="">Observaciones de los Modelos</label>
                                                        <textarea name="Observaciones" id="ObservacionesModelos" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- =================================== AQUI TERMINA EL PRIMER RENGLON DE "ACREDITAMIENTO Y REFERENCIAS" ================================================== -->
                                        
                                        </div><!-- DIV CARD BODY -->
                                    </div> <!-- *************** AQUI TERMINA EL DIV DE LA SECCION OBSERVACIONES Y COMENTARIOS ****************************" -->
                                    <div id="step-322"> <!-- *************** AQUI INICIA EL DIV DE LA SECCION DE GUARDADO  ****************************" -->
                                        <div class="no-results">
                                            <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                <span class="swal2-success-line-tip"></span>
                                                <span class="swal2-success-line-long"></span>
                                                <div class="swal2-success-ring"></div>
                                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                            </div>
                                            <div class="results-subtitle mt-4">Casi Terminado!</div>
                                            <div class="results-title">¿Deseas guardar los datos del servicio?</div>
                                            <div class="mt-3 mb-3"></div>
                                            <div class="text-center">
                                                <button class="btn-shadow btn-wide btn btn-success btn-lg " id="btn_nuevo_0">Guardar</button>
                                                <button class="btn-shadow btn-wide btn btn-success btn-lg btnEditarG">Editar</button>
                                            </div>
                                        </div>
                                    </div> <!-- *************** AQUI TERMINA EL DIV DE LA SECCION DE GUARDADO ****************************" -->
                                </div><!-- AQUI TERMINA EL DIV QUE CONTIENE TODO EL FORM -->
                            </div> <!-- div  id="smartwizard3" class="forms-wizard-vertical" -->
                            <div class="divider"></div>
                            <div class="clearfix">
                                <button type="button" id="reset-btn22" class="btn-shadow float-left btn btn-link">Reset</button>
                                <button type="button" id="next-btn22" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Next</button>
                                <button type="button" id="prev-btn22" class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-outline-secondary">Previous</button>
                            </div>
                        </div><!-- DIV DEL CAR BODY TAB 2 -->
                    </form>
                </div><!-- DIV class="main-card mb-3 card" --> 
            </div><!-- **************************************************** AQUI TERMINA EL TAB 0  *************************************************************************-->
            <!-- *********************************************** AQUI EMPIEZA EL CODIGO DEL EL TAB 1  ****************************************************************-->
            <!-- ===================================AQUI EMPIEZA EL CODIGO DE LAS COSULTAS ====================================================================== -->
            <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                <div  class="main-card mb-3 card">
                    <div id="div_registros" class="box-body">
                        <!-- <table id="example" class="table table-bordered table-striped"> -->
                        <table id="table_registros" class="table table-bordered table-striped dataTable">
                            <thead>
                            <tr>
                                <th>N° Catálogo</th>
                                <th>Instrumento</th>
                                <th>Alcance</th>
                                <th>Clase de Exactitud</th>
                                <th>Puntos de Calibración</th>
                                <th>Método de Calibración</th>
                                <th>Patrones de Referencia</th>
                                <th>Precio Base</th>
                                <th>Editar</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>  
                <!-- =================================== Codigo para la animacion de cargado ==========================-->
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
                <!-- ============================Codigo para la animacion de cargado ================================-->
            </div><!-- AQUI TERMINA EL DIV DEL TAB 1 -->
        </div><!-- DIV DEL TAB PRICIPAL (TAB CONTENTD)-->
    </div> <!-- TERMINA EL DIV PAPP_INNER -->
</div> <!-- DIV PRINCIPAL -->
    <script src="dist/js/servicios.js"></script>
    <?php include_once("footer.php");?>