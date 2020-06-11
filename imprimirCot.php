<?php
     include_once("header.php");
     include_once("validates.php");
     include_once("banner.php");
?>
<!-- SE PONE EN COMENTARIOS PARA UN MEJOR DISEÑO -->
<!-- <link rel="stylesheet" href="dist/css/base.css"> -->
<script src="plugins/datatables/jquery.dataTablesN.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.min.js"></script> 
<script type="text/javascript" src="dist/js/jspdf.min.js"></script>
<script src="dist/js/jspdf.debug.js"></script>
<script src="dist/js/mitubachi-normal.js"></script>
<script src="dist/js/jspdf.plugin.autotable.js"></script>
<script src="dist/js/faker.min.js"></script>

<!-- 
<script src="examples/examples.js"></script> -->


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="lnr-user icon-gradient bg-malibu-beach">
                        </i>
                    </div>
                    <div>Usuarios
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
        </ul>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Informacion General</h5>
                        <form form name="formulario" method="post">
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <label for="examplePassword11" class="">Email</label>
                                    <input name="Cot" id="Cot" class="form-control">
                                </div>
                            </div>
                            <button class="mt-2 btn btn-primary btnGuardar" id="btnImprimir">Guardar</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <script>
    var numCot 
     $(document).ready(function () {   
        var doc = new jsPDF('p','mm','letter')
        var cot, desde, hasta, contacto, puesto,tel, emailC, empresa, direccion, 
            gestor, depto, correo, lugar,precios,terminos,tiempo,modalidad,obser, rfc, razon
        var totalPagesExp = '{total_pages_count_string}'
        doc.page = 1;
            $('#btnImprimir').click(function () {
                numCot = $.trim($('#Cot').val());
                obtener_registros();
                doc.autoTable({
                    didDrawPage: function (data) {
                    inicioPagina();
                    doc.setTextColor(83, 120, 247);
                    doc.setFontSize(9);
                    doc.text('Contacto:',15, 40)
                    doc.setTextColor(0,0,0);
                    doc.text(numCot,32, 40)
                    doc.text(puesto, 32, 44)
                    doc.text(tel,32, 48)
                    doc.text(emailC,32, 52)

                    doc.setTextColor(83, 120, 247);
                    doc.text('Empresa:',110, 40)
                    doc.setTextColor(0,0,0);
                    doc.text(empresa,130, 40)
                    doc.text(direccion,130, 44)

                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 55, 205, 55)

                    doc.setDrawColor(83, 120, 247)
                    doc.line(100, 36, 100, 54) 

                    doc.setFontSize(9);
                    doc.text('Agradeciendo su preferencia, sometemos a sus consideración la siguiente cotización. Para cualquier duda o aclaracion favor de contactarnos.',10, 60)

         
                    var finalY = doc.previousAutoTable.finalY || 10
                    doc.autoTable({
                        startY: finalY + 55,
                        // head: [['Partidad','Cantidad','Articulos','Descripción','P.Unitario','SubTotal']],
                        // body: [bodyRows()
                        
                        // ],
                        // theme: 'grid',
                        head: headRows(),
                        body: bodyRows(),
                    })

                    doc.setFontSize(12);
                    doc.setFontType("bold");
                    doc.setFontSize(9);
                    doc.text('Atentamente',35, 180)
                    doc.setDrawColor(0,0,0)
                    doc.line(25, 190, 70, 190)
                    doc.setFontSize(8);
                    doc.text(gestor,36, 194)
                    doc.text(depto,40, 198)
                    doc.text(correo,32, 202)

                    doc.setFontSize(9);
                    doc.text('Acepto las condiciones de servicio \n que se describen en la cotización',130, 180)
                    doc.setDrawColor(0,0,0)
                    doc.line(130, 190, 180, 190)
                    doc.setFontSize(9);
                    doc.text(contacto,135, 194)
                    doc.text('COT ' + cot,145, 198)
                    piePagina();

                    doc.addPage();

                    inicioPagina();
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(10);
                    doc.setTextColor(83, 120, 247);
                    doc.text('CONDICIONES COMERCIALES',75, 40)
                    doc.setTextColor(0,0,0);
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(9);
                    doc.text('DATOS BANCARIOS: ',10, 48)
                    doc.text('A NOMBRE DE: MetAs, S.A. de C.V. BANAMEX Cta. 48800004325 Suc.4880 \nCLABE #00234288000043251',48, 48)
                    doc.text('Lugar de servicio: ',10, 56)
                    doc.text(lugar,48, 56)
                    doc.text('Precios: ',10, 60)
                    doc.text(precios,48, 60)
                    doc.text('Términos de pago: ',10, 64)
                    doc.text(terminos,48, 64,0,80)
                    // doc.text('Tiempo de entrega: ',10, 70)
                    // doc.text(tiempo,48, 70)
                    doc.text('Modalidad: ',10, 75)
                    doc.text(modalidad,48, 75)
                    doc.text('Observaciones: ',10, 80)
                    doc.text('Observaciones:',48, 80)
                    
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(10);
                    doc.setTextColor(83, 120, 247);
                    doc.text('DATOS DE FACTURACIÓN',75, 105)
                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 110, 205, 110)
                    doc.setTextColor(0,0,0);
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(9);
                    doc.text('Domicilio: ',10, 115)
                    doc.text(direccion,48, 115)
                    doc.text('RFC: ',10, 120)
                    doc.text(rfc,48, 120)
                    doc.text('Razón social: ',10, 125)
                    doc.text(razon,48, 125)
                    piePagina();

                    doc.addPage();

                    inicioPagina();
                    doc.setFontSize(9);
                    doc.text('Solicitamos que las condiciones de servicios que se describen a continuación sean leídas y aceptadas, con la finalidad de ofrecer un mejor servicio.',7, 40)
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(10);
                    doc.setTextColor(83, 120, 247);
                    doc.text('Cotización y servicios adicionales',75, 44)
                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 46, 205, 46)
                    doc.setTextColor(0,0,0);
                    doc.setFontSize(9);
                    doc.text('»',10, 50)
                    doc.text('La cotización tiene una validez de 30 días naturales a partir de su fecha de emisión.',15, 50)
                    doc.text('»',10, 54)
                    doc.text('Servicio Ordinario de Calibración: Tiempo de entrega 10 o 15 días hábiles (según equipo) a partir de la recepción de equipos en nuestras \ninstalaciones o según cantidad de equipos a recibir por remesa. No aplica cuando el equipo requiera ajuste mayor, mantenimiento o reparación.',15, 54)
                    doc.text('»',10, 61)
                    doc.text('Servicio Urgente de calibración: Tiempo de entrega de 3 a 5 días hábiles a partir de la recepción de equipos en nuestras instalaciones, previa \ndisponibilidad de laboratorio. No aplica cuando el equipo requiera ajuste mayor, mantenimiento o reparación. \nIncremento de costo al 100% sobre costo base de calibración.',15, 61)
                    doc.text('»',10, 72)
                    doc.text('Servicios con tiempo de entrega especial: Algunos de nuestros servicios se ofertan con tiempos de entrega especiales, para los cuales se tendrá \nque revisar el tiempo indicado en la parte interna de calibración “Información técnica complementaria”.',15, 72)
                    doc.text('»',10, 80)
                    doc.text('Todo servicio cancelado por el cliente antes o durante el proceso de calibración para equipos recibidos en nuestras instalaciones o servicios en \ninstalaciones del cliente, generará al menos un costo de 25 % sobre el servicio de calibración.',15, 80)
                    doc.text('»',10, 87)
                    doc.text('En caso estar realizando un servicio de calibración en instalaciones del cliente y presentarse un atraso por causar ajenas a metas, \nse cobrará un monto adicional a lo cotizado, el cual estará sujeto a cantidad de días adicionales.',15, 87)
                    doc.text('»',10, 95)
                    doc.text('Nuestras cotización para servicios en metas y del cliente, incluyen solamente el "ajuste usual" y acostumbrado de los equipos, por lo \nque si el instrumento requiere un ajuste mayor para llevar al equipo dentro de especificaciones y tolerancias, así como limpieza, \nmantenimiento preventivo o reparación se generara un costo adicional, mismo que será definido por el catálogo de servicios adicionales, \ny el cliente deberá proporcionar los manuales de operación y ajuste del instrumento.',15, 95)
                    doc.text('»',10, 109)
                    doc.text('Los costos para la devolución de equipos de MetAs a instalaciones del cliente por mensajería, deberán ser cubiertos por el cliente, \ncon un costo adicional indicado en nuestra cotización.',15, 109)
                    doc.text('»',10, 116)
                    doc.text('Los servicios de paquetería incluidos en nuestra cotización, no contemplan costo de mensajería con seguro, en caso de requerir él envió \nasegurado, el cliente deberá indicar el monto por el cual desea que se aseguren sus instrumentos.',15, 116)
                    doc.text('»',10, 124)
                    doc.text('Al existir un error en datos del instrumento ó del cliente en el certificado de calibración por causas ajenas a MetAs, se cobrará por la \nsegunda emisión la cantidad de $85 + mensajería + IVA. Pago 100 % contra entrega.',15, 124)
                    
                    doc.setFontSize(9);
                    doc.setTextColor(83, 120, 247);
                    doc.text('Entrega y Recepción de Equipos en Instalaciones de MetAs:',65, 133)
                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 135, 205, 135)
                    doc.setTextColor(0,0,0);
                    doc.setFontSize(9);
                    doc.text('»',10, 139)
                    doc.text('La emisión de orden de compra o pedido a favor de MetAs da por hecho que nuestros términos y condiciones han sido aceptados en su totalidad.',15, 139)
                    doc.text('»',10, 143) 
                    doc.text('Es indispensable la recepción de su carta de autorización o Carta membretada por su empresa donde se incluyan los datos completos para la \nemisión de su certificado, factura, así como indicar el domicilio a donde deberán enviarse los equipos.',15, 143) 
                    doc.text('»',10, 150) 
                    doc.text('Se recomienda que sus instrumentos estén acompañados por el manual de operación y accesorios como: fuente de poder, cables, conexiones, \nbaterías, líquidos o soluciones, etc. para no extender el tiempo de entrega en caso de necesitarse.',15, 150) 
                    doc.text('»',10, 158) 
                    doc.text('El equipo será entregado o enviado al cliente en las mismas o mejores condiciones de empaque en las cuales fue recibido en MetAs, por lo cual, \nse recomienda que inspeccione las condiciones de empaque para envío de sus equipos a nuestras instalaciones.',15, 158) 
                    doc.text('»',10, 166) 
                    doc.text('Se recomienda que la transportación de sus equipos, se realice mediante entrega personal en MetAs o servicios de mensajería especializados.',15, 166) 
                    
                    doc.setFontSize(9);
                    doc.setTextColor(83, 120, 247);
                    doc.text('Ejecución de Servicios de calibración en Instalaciones del Cliente:',60, 172)
                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 174, 205, 174)
                    doc.setTextColor(0,0,0);
                    doc.text('»',10, 180) 
                    doc.text('Todo servicio de calibración en instalaciones del cliente será programado siempre y cuando se haya recibido una orden de compra o pedido.',15, 180)
                    doc.text('»',10, 184) 
                    doc.text('Los certificados de Calibración no son elaborados ni entregados en instalaciones del cliente, estos serán entregado entre 5… 8 días \nhábiles después del servicio.',15, 184)  
                    doc.text('»',10, 191) 
                    doc.text('Los instrumentos deberán ser desmontados y entregados al personal de MetAs por parte del cliente, en condiciones de limpieza y funcionamiento \nadecuados para su calibración.',15, 191) 
                    doc.text('»',10, 199) 
                    doc.text('El cliente deberá proporcionar un contacto técnico para las operaciones de logística, acceso a las instalaciones, liberación, desmontaje y montaje \nde instrumentos, así como su programa de libranza para el sensor tomando en cuenta el tiempo necesario para poder trabajar en el mismo.',15, 199) 
                    doc.text('»',10, 206) 
                    doc.text('Para la ejecución del servicio se requiere alimentación de 127 v.c.a. cerca del área en donde se realizara la calibración.',15, 206) 
                    doc.text('»',10, 210) 
                    doc.text('MetAs solo considera el uso de los siguientes accesorios de protección personal: casco, botas, lentes, vestimenta de algodón, manga larga y \nguantes de látex, en caso de requerirse equipo especial adicional de limpieza y/o protección para acceso a las instalaciones, éste deberá ser \nproporcionados por el cliente.',15, 210) 
                    doc.text('»',10, 221)
                    doc.text('Para algunos servicios de calibración de las magnitudes de eléctrica, temperatura y óptica, el cliente deberá facilitar un área de trabajo con \ncondiciones ambientales controladas, así como mesa de trabajo, suministro eléctrico, iluminación y limpieza adecuado, solo algunos servicios \nde calibración de instrumentación ordinaria o de baja exactitud se podrán realizar directamente en proceso o línea, de acuerdo a las condiciones \nde montaje y facilidad de acceso ya que el servicio tiene el alcance para calibrar a una altura no mayor de 1 metro del piso.',15, 221) 
                    piePagina();   
                    doc.addPage()

                    inicioPagina()
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(10);
                    doc.setTextColor(83, 120, 247);
                    doc.text('Responsabilidades durante la calibración para servicios de calibración en Metas e Instalaciones del cliente:',25, 40)
                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 42, 205, 42)
                    doc.setTextColor(0,0,0);
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(9);
                    doc.text('»',10, 48)
                    doc.text('MetAs no se hace responsable en caso de siniestro ocurridos a los equipos durante su transportación hacia o desde MetAs, \nya que nuestra responsabilidad se limita únicamente a los instrumentos recibidos en nuestras instalaciones.',20, 48) 
                    doc.text('»',10, 56)
                    doc.text('MetAs no se hace responsable en caso de daños debido a vicios ocultos de los instrumentos durante el proceso de calibración. \nLa responsabilidad de MetAs es en daños por causantes de inadecuada operación y manejo de instrumentos, \ncon límite de responsabilidad obligada en lo dispuesto del valor del costo de reparación o en su caso la sustitución del mismo.',20, 56) 
  

                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(10);
                    doc.setTextColor(83, 120, 247);
                    doc.text('Protocolo de atención para quejas y/o reclamaciones:',60, 70)
                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 72, 205, 72)
                    doc.setTextColor(0,0,0);
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(9);
                    doc.text('»',10, 76)
                    doc.text('Toda queja y/o reclamación deberá ser presentada por escrito al correo calidad@metas.com.mx .',20, 76) 
                    doc.text('»',10, 80)
                    doc.text('Para los casos de supuestos daños y/o extravió de equipo, el cliente cuenta con 2 días hábiles a partir de la recepción de los mismos, \npara ingresar su queja y/o reclamación y que ésta sea atendida.',20, 80) 
                    doc.text('»',10, 87)
                    doc.text('Para los casos de supuestos errores en los resultados de servicios metrológicos (calibración, caracterización), el cliente cuenta con \n20 días hábiles a partir de la recepción de sus equipos para ingresar su queja y/o reclamación,  y que ésta sea atendida.',20, 87) 


                    doc.setFontSize(10);
                    doc.setTextColor(83, 120, 247);
                    doc.text('Términos y Condiciones de Pago:',75, 98)
                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 100, 205, 100)
                    doc.setTextColor(0,0,0);
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(9);
                    doc.text('»',10, 105)
                    doc.text('Para aclaración de crédito o envió de comprobante de pago, favor de contactar al departamento de cobranza en el correo electrónico: \ncobranza@metas.mx.',20, 105) 
                    doc.text('»',10, 112)
                    doc.text('Favor de verificar con el área de cobranza el estatus de adeudo de su empresa para evitar atrasos en el retorno de sus equipos.',20, 112) 
                    doc.text('»',10, 116)
                    doc.text('Todas las facturas deberán ser pagadas el mismo año de su emisión.',20, 116) 


                    doc.setFontSize(10);
                    doc.setTextColor(83, 120, 247);
                    doc.text('Acreditaciones:',90, 125)
                    doc.setDrawColor(83, 120, 247)
                    doc.line(5, 127, 205, 127)
                    doc.setTextColor(0,0,0);
                    doc.setFont("times");
                    doc.setFontType("normal");
                    doc.setFontSize(9);
                    doc.text('»',10, 131)
                    doc.text('Todas las acreditaciones y CMC´S con trazabilidad y patron nacionales. (Consulte página ema, a.c. www.ema.org.mx)',20, 131) 
                     var finalY = doc.previousAutoTable.finalY 
                    doc.autoTable({
                        startY: finalY -20,
                        head: [['Magnitud', 'N° Acreditación', 'Acreditacion vigente desde']],
                        body: [
                        ['Acústica, Vibraciones y Ultrasonido', 'A-05', '2012/10/22'],
                        ['Densidad', 'DEN-09', '2011/09/21'],
                        ['Eléctrica', 'E-67', '2012/08/20'],
                        ['Humedad', 'H-05', '2012/03/29'],
                        ['Masa', 'M-129', '2011/09/07'],
                        ['Mediciones Especiales', 'ME-15', '2017/11/17'],
                        ['Presión', 'P-44', '2012/04/19'],
                        ['Temperatura', 'A-05', '2012/03/29'],
                        ['Tiempo y Frecuencia', 'TF-22', '2017/11/06'],
                        ['Volumen', 'V-33', '2011-08-26'],
                        ['Óptica', 'OP-05', '2011-09-21'],
                        ['Dimensional', 'D-159', '2019-07-17']
                        ],
                        theme: 'per',
                    })
                    piePagina();

                },
                })
              
                doc.save('Usec.pdf');
            });

            function piePagina (){
                doc.setFont("times");
                doc.setFontType("normal");
                doc.setFontSize(8);
                // doc.setFont('Century Gothic');
                doc.text('Gestor de servicio:'+ gestor,15, 255)
                doc.text('Cotizacion:'+cot ,150, 255)
                doc.text (180,255, 'página ' + doc.page);
                doc.setDrawColor(0,0,0)
                doc.line(5, 257, 205, 257)
                doc.text('MetAs-Matriz',15, 260)
                doc.text('Antonio Caso #246',15, 263)
                doc.text('Col. Centro',15, 266)
                doc.text('Cd. Guzmán, Jalisco 49 000',15, 269)
                doc.text('Tel:(341)413 61 23 multilinea',15, 272)
                doc.text('Email:metas@metas.com.mx',15, 275)
                doc.text('MA-FORM-05105/17',85, 269)
                doc.text('MetAs-Óptica',180, 260)
                doc.text('Av. Luis Vega y Monroy #322-6 Planta Baja',146, 263)
                doc.text('Col.Plazas del Sol 1a Sección',163, 266)
                doc.text('Querétaro, Qro 76099',172, 269)
                doc.text('Tel:(422) 223 45 27',173, 272)
                doc.page ++;
            }

            function inicioPagina(){
                 var image = "data:image/png;base64,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";
                    doc.addImage(image, 10, 7);

                    doc.setFontSize(12);
                    // doc.setFont("Berlin Sans FB");
                    doc.setFontType("bold");
                    doc.text('Centro de Metrología',80, 22)

                    doc.setFontSize(12);
                    doc.setTextColor(128,128,0);
                    doc.setFont("times");
                    doc.setFontType("italic");
                    doc.setFontSize(12);
                    doc.text('Apasionados por la Metrología',150, 10)
                        
                    doc.setFontSize(12);
                    // doc.setFont("Berlin Sans FB");
                    doc.setFontType("bold");
                    doc.setFillColor(156,172,240)
                    doc.roundedRect(37, 22, 25, 10, 3, 3, 'FD')
                    doc.setTextColor(0,0,0);
                    doc.text('Cotizacion',40, 27)
                    doc.text(cot,47, 31)

                    doc.setFont("times");
                    doc.setFontType("italic");
                    doc.setFontSize(10);
                    doc.setFontType("bold");
                    doc.text('Vigente',156, 27)
                    doc.text('Desde:',130, 31)
                    doc.text('2020-01-01', 144, 31)
                    doc.text('Hasta',165, 31)
                    doc.text('2020-01-01', 177, 31)

                    doc.setDrawColor(23, 147, 1)
                    doc.line(5, 35, 205, 35)
            }

            function bodyRows() {
                var cantidad, r, articulos, descripcion, unitario, sub
                $Num = numCot
                <?php
                    $con = new Conexion();
                    $con->conectar();
                    $strQuery ="SELECT (count(*)) as r FROM  [SAM2].[dbo].[DetalleCotizaciones] where NumCot = '2'";
                    $con->ejecutaQuery($strQuery);
                    $obj = $con->getObjeto();    
                            $renglon = $obj->r;
                ?>

                r ='<?php echo $renglon; ?>';    
                rowCount = r
                // for (var j = 1; j <= rowCount; j++) {
                        <?php
                        $clientes = array();
                        $n=0;
                            $con = new Conexion();
                            $con->conectar();
                            $strQuery ="SELECT Cantidad,([EquipmentName] + '. MARCA: ' + Mfr + '. MODELO: ' +Model) as articulos,
                                        S.ServiceDescription +', ' + [TurnAroundTime]+' dias para calibración' as Descripcion, ss.Price, ss.[Price] * Cantidad AS sub
                                            FROM  [SAM2].[dbo].[DetalleCotizaciones] d
                                            INNER JOIN SetupEquipment S on d.EquipId = s.EquipId
                                            INNER JOIN SetupEquipmentServiceMapping ss ON ss.EquipId = s.EquipId 
                                            where d.NumCot = '2'";
                            $con->ejecutaQuery($strQuery);
                            $obj = $con->getObjeto();
                            foreach ($obj as $key => $value) {
                                if(is_string($value)){
                                    $obj->$key = utf8_encode($value);    
                                }
                            }
                                    $can = $obj->Cantidad;
                                    $articulos = $obj->articulos;
                                    $descripcion = $obj->Descripcion;
                                    $precio = $obj->Price;
                                    $sub = $obj->sub;   
                        ?>

                        cantidad='<?php echo $can; ?>';      
                        articulos ='<?php echo $articulos; ?>';
                        descripcion ='<?php echo $descripcion; ?>';         
                        unitario ='<?php echo $precio; ?>';  
                        sub ='<?php echo $sub; ?>';  

                    
                        var body = []
                        for (var j = 1; j <= r; j++) {
                            body.push({
                            partidad: j,
                            cantidad: cantidad,
                            articulos: articulos,
                            descripcion: descripcion,
                            pUnitario: unitario,
                            subtotal: sub,
                            })
                        }
                // }
                return body
            }
            

            
            function headRows() {
                    return [
                        { partidad: 'Partidad', cantidad: 'Cantidad', articulos: 'Artículos', descripcion: 'Descripción', pUnitario: 'P. Unitario', subtotal: 'Subtotal'},
                    ]
            }
            
            function obtener_registros(){
                <?php
                $con = new Conexion();
                $con->conectar();
                $strQuery = "SELECT [Cotizaciones].NumCot, [Cotizaciones].FechaDesde, [Cotizaciones].FechaHasta, [Contactos].Nombre +' '+ [Contactos].Apellidos as Contacto, [Contactos].Cargo, 
                [Contactos].Tel, [Contactos].Email,[Empresas].Compania, [DireccionesAcomodadas].Domicilio, [Usuarios].Nombre +' '+ [Usuarios].Apellidos as Usuario,
                [Usuarios].Depto, [Usuarios].Email as Email1, [Usuarios].Firma, [LugarServicio].Descripcion as Lugar, [Precios].Descripcion as Precio,
                [TerminosPago].Descripcion as Terminos, [Modalidad].Descripcion as Modalidad, [Empresas].RazonSocial, [Empresas].RFC
                FROM [Cotizaciones] 
                INNER JOIN [Contactos]  ON [Cotizaciones].idContacto = [Contactos].ClaveContacto
                INNER JOIN [DireccionesAcomodadas]  ON [DireccionesAcomodadas].IdDireccion = [Contactos].IdDireccion
                INNER JOIN [Empresas] ON [Empresas].ClaveEmpresa = [DireccionesAcomodadas].ClaveEmpresa
                INNER JOIN [Usuarios] ON [Cotizaciones].idUsuario = [Usuarios].idUsuario
                INNER JOIN [LugarServicio] ON [Cotizaciones].idLugarServicio = [LugarServicio].idLugarServicio
                INNER JOIN [Modalidad] ON [Cotizaciones].idModalidad = [Modalidad].idModalidad
                INNER JOIN [TerminosPago]  ON [Cotizaciones].idTerminoPago = [TerminosPago].idTerminoPago
                INNER JOIN [Precios]  ON [Cotizaciones].idPrecios = [Precios] .idPrecios
                WHERE [Cotizaciones].NumCot = '2'";
                            $con->ejecutaQuery($strQuery);
                            $obj = $con->getObjeto();
                            foreach ($obj as $key => $value) {
                                if(is_string($value)){
                                    $obj->$key = utf8_encode($value);    
                                }
                                  }
                            $cot = $obj->NumCot;
                            $contacto = $obj->Contacto;
                            $puesto = $obj->Cargo;
                            $tel = $obj->Tel;
                            $email = $obj->Email;
                            $empresa = $obj->Compania;
                            $dir = $obj->Domicilio;
                            $gestor = $obj->Usuario;
                            $depto = $obj->Depto;
                            $correo = $obj->Email1;
                            $lugar = $obj->Lugar;
                            $precios = $obj->Precio;
                            $terminos = $obj->Terminos;
                          
                            $modalidad = $obj->Modalidad;
                            $razon = $obj->RazonSocial;
                            $rfc = $obj->RFC;
                        
                    
                            ?>
                            cot='<?php echo $cot; ?>';
                            contacto='<?php echo $contacto; ?>';
                            puesto='<?php echo $puesto; ?>';
                            emailC='<?php echo $email; ?>';
                            tel='<?php echo $tel; ?>';
                            empresa='<?php echo $empresa; ?>';
                            direccion='<?php echo $dir; ?>';
                            gestor='<?php echo $gestor; ?>';
                            depto='<?php echo $depto; ?>';
                            correo='<?php echo $correo; ?>';
                            lugar='<?php echo $lugar; ?>';
                            precios='<?php echo $precios; ?>';
                            terminos='<?php echo $terminos; ?>';
                           
                            modalidad='<?php echo $modalidad; ?>';
                            razon='<?php echo $razon; ?>';
                            rfc='<?php echo $rfc; ?>';
                         
            }
    });

    </script>
    <!-- <iframe id="request" frameborder="0" ></iframe>  -->
    <!-- <script src="dist/js/usuarios.js"></script> -->
    <?php include_once("footer.php");?>