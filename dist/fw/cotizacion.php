<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
	require_once "classes/Conexion.php";
    $opc = $_POST['opc'];
    if ($opc == '' || $opc == 'undefined' || $opc == null) 
    {
	    echo json_encode(false);
	    die();
    }
    // *************************************************************** CODIGO PARA GUARDAR LA COTIZACION ***********************************************************************************************
    elseif ($opc == 'guardar_cot') 
    {
        $obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        // ========================== COSIGO PARA GUARDAR  ========================================
        if($datos->accion == 'nuevo')
        {
            //:::::::::::::::: SE OPTIENEN LOS ARREGLOS CON DATOS DE LA COT ::::::::::::::::::::::
            $articulos = $_POST['articulos'];
            $observaciones = $_POST['observaciones'];
            $cantidades = $_POST['cantidades'];
            $ids = $_POST['ids'];
            $series = $_POST['series'];
            $observicio = $_POST['observicio'];
            $precios = $_POST['precios'];
            $origen = $_POST['origen'];
            //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
            //-------------------------- SE ALAMCENA LA CADENA QUE GUARDA EL ENCABEZADO DE LA COT JUNTO CON LOS PARAMETROS-----------------------------------------------------
            $sql1 = "INSERT INTO Cotizaciones (idUsuario,idContacto, idLugarServicio, idModalidad, idTerminoPago, idPrecios, Referencia, FechaDesde,
                       FechaHasta, Observaciones, Subtotal, Iva, Total) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $params1 = array($_SESSION['iduser'],$datos->idContacto,$datos->idLugarServicio,$datos->idModalidad,$datos->idTerminosPago,$datos->idPrecios,$datos->Referencia,'2020-01-01','2020-01-01',$datos->ObservacionesCot,$datos->Subtotal,$datos->Iva,$datos->Total);
            //-----------------------------------------------------------------------------------------------------------------------------------------------------------------
            //,,,,,,, ARREGLO PARA LOS PARAMETROS DE LAS PARTIDAS ,,,,,,,,,,
            $params2 = array(); 
            //,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
            //#################### CICLO PARA OBTENER EL NUMERO DE PARAMETROS A INSERTAR ##############################################
            for ($i=0; $i< count($articulos); $i++)
            {
                    if ($i==(count($articulos)-1))
                    {
                        $sql2=$sql2."((Select MAX(NumCot) from Cotizaciones),?,?,?,?,?,?,?,?,?,?);";
            
                    }
                    else
                    {
                        $sql2=$sql2."((Select MAX(NumCot) from Cotizaciones),?,?,?,?,?,?,?,?,?,?),";
                    }
                array_push($params2, intval($articulos[$i]),1,intval($cantidades[$i]),1,$ids[$i],$series[$i],$observaciones[$i],$observicio[$i], $precios[$i], $origen[$i]);
                
            } 
            //########################################################################################################################
            if ((count($articulos)) == 1)
            {
                $sql2 = "INSERT INTO DetalleCotizaciones (NumCot,EquipId,PartidaNo,Cantidad,CantidadReal,identificadorInventarioCliente,Serie,Observaciones,ObservacionesServicios, PrecioUnitario, Origen) VALUES ((Select MAX(NumCot) from Cotizaciones),?,?,?,?,?,?,?,?,?,?)";
            }
            else
            {
                $sql2 = "INSERT INTO DetalleCotizaciones (NumCot,EquipId,PartidaNo,Cantidad,CantidadReal,identificadorInventarioCliente,Serie,Observaciones,ObservacionesServicios, PrecioUnitario, Origen) VALUES ".$sql2;

            }
            $res = $con->ejecutaSQLTransacCot($sql1,$sql2, $params1, $params2);
            // ------------------------------------------------------------------------------------------------------------------------------------------------------------------ 
        }
        else{
            if($datos->Tipo=='')
            {
                $razon=$datos->RazonSocial;
            }
            else
            {
                $razon=$datos->RazonSocial.", ".$datos->Tipo;
            }
            $strQuery = "UPDATE EmpresasOrdenadas SET 
            RazonSocial = '".$razon."',
            idPaqueteria = ".$datos->Paqueteria.",
            FechaModificacion = getdate(),
            RFC = '".$datos->RFC."',
            Credito = '".$datos->Credito."',
            CuentaMensajeria = '".$datos->CuentaMensajeria."',
            Descuento = '".$datos->Descuento."',
            NumProvMetas = '".$datos->NoProveedor."',
            AdminPaq = '".$datos->AdminPaq."',
            ObservacionesEmpresa = '".$datos->Observaciones."'
            WHERE ClaveEmpresa = '".$datos->ClaveEmpresa."'";
            $res = $con->ejecutaSQLTransac($strQuery);
        }
        
        $con->cerrar();
        echo json_encode($res);
        
    }
    // ======================================
    // *************************************************************** CODIGO PARA GUARDAR ARTICICULOS ACCESS ***********************************************************************************************
    elseif ($opc == 'guardar_articulosAccess') 
    {
        $obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        $strQuery="if exists(select ItemNumber from [EquiposLocales] where ItemNumber='".$datos->ItemNumber."') 
                    begin 
                        if exists(select ItemNumber from [EquiposLocales] where ItemNumber='".$datos->ItemNumber."' and 
                        PuntosdeCalibracion=(select Alcance from [HistorialCotizacionesMetAs].[dbo].[UNION-COTIZACIONES] WHERE Numcot=".$datos->NumCot." and [Partida No]=".$datos->Partida." and year(Fecha)=".$datos->Fecha.")) 
                            begin 
                                update EquiposLocales set NumCot=".$datos->NumCot." where NumCot=".$datos->NumCot."
                            end
                        else
                            begin
                                INSERT INTO [SAM2].[dbo].[EquiposLocales] (ItemNumber, NombreEquipo, Modelo, Exactitud, Marca, NoCatalogo, Trazabilidad, NormasdeReferencia, Acreditamiento, 
                                MetododeCalibracion,Alcance, PuntosdeCalibracion, Precio) (SELECT CONCAT(('A-'),SUBSTRING(UPPER(Marca),0,4),'-Q',Modelo,'/',
                                (select isnull(Max(CAST((SUBSTRING(ItemNumber,CHARINDEX('/',ItemNumber)+1,10))+1 AS int )),1) from EquiposLocales where 
                                SUBSTRING(ItemNumber,0,CHARINDEX('/',ItemNumber))='".$datos->ItemNumber."')) as ItemNumber, Tipo, Modelo, ClaseDeExactitud, Marca, [Serv-Catalogo], Trazabilidad,
                                NormasdeReferencia, Acreditamiento, MetododeCalibracion, Servs.Alcance, Cots.Alcance, [Punitario-cot] 
                                from [HistorialCotizacionesMetAs].[dbo].[UNION-COTIZACIONES] Cots INNER JOIN [METASINF-2020].[dbo].[Catalogo-Calibracion-Laboratorios] Servs on 
                                Cots.[Serv-Catalogo]=Servs.NoCatalogo where year(Fecha)=".$datos->Fecha." and NumCot=".$datos->NumCot." and [Partida No]=".$datos->Partida.")
                            end
                        end
                    else
                        begin
                            INSERT INTO [SAM2].[dbo].[EquiposLocales] (ItemNumber, NombreEquipo, Modelo, Exactitud, Marca, NoCatalogo, Trazabilidad, NormasdeReferencia, Acreditamiento, 
                            MetododeCalibracion,Alcance, PuntosdeCalibracion, Precio) (SELECT CONCAT(('A-'),SUBSTRING(UPPER(Marca),0,4),'-Q',Modelo) as ItemNumber, Tipo, Modelo, ClaseDeExactitud, Marca,  [Serv-Catalogo], Trazabilidad,
                            NormasdeReferencia, Acreditamiento, MetododeCalibracion, Servs.Alcance, Cots.Alcance, [Punitario-cot] 
                            from [HistorialCotizacionesMetAs].[dbo].[UNION-COTIZACIONES] Cots INNER JOIN [METASINF-2020].[dbo].[Catalogo-Calibracion-Laboratorios] Servs on 
                            Cots.[Serv-Catalogo]=Servs.NoCatalogo where year(Fecha)=".$datos->Fecha." and NumCot=".$datos->NumCot." and [Partida No]=".$datos->Partida.")	
                        end";
        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
    }
    // ======== OPTENER LUGARSERVICIO =============
    elseif ($opc == 'obtener_lugarServicio')
    {
		$strQuery = "SELECT DISTINCT 
						idLugarServicio,
						Descripcion
					FROM 
                        LugarServicio
					ORDER BY 
						idLugarServicio";
		$con = new Conexion();
	    $con->ejecutaQuery($strQuery);
	    $arrDocumentos = array();
	    $arrRespuesta = $con->getListaObjectos();
        foreach ($arrRespuesta as $objRespuesta){
            foreach ($objRespuesta as $key => $value){
                if(is_string($value)){
                    $objRespuesta->$key = utf8_encode($value);    
                }                
            }
            $arrDocumentos[] = $objRespuesta;
        }
	    $con->cerrar();
	    echo json_encode($arrDocumentos);
    }
    // =====================================
    // ======== OPTENER LUGARSERVICIO =============
    elseif ($opc == 'obtener_tiempoEntrega')
    {
		$strQuery = "SELECT DISTINCT 
						idTiempoEntrega,
						Descripcion
					FROM 
                        TiempoEntrega
					ORDER BY 
						idTiempoEntrega";
		$con = new Conexion();
	    $con->ejecutaQuery($strQuery);
	    $arrDocumentos = array();
	    $arrRespuesta = $con->getListaObjectos();
        foreach ($arrRespuesta as $objRespuesta){
            foreach ($objRespuesta as $key => $value){
                if(is_string($value)){
                    $objRespuesta->$key = utf8_encode($value);    
                }                
            }
            $arrDocumentos[] = $objRespuesta;
        }
	    $con->cerrar();
	    echo json_encode($arrDocumentos);
    }
    // =====================================
    // ======== OPTENER LUGARSERVICIO =============
    elseif ($opc == 'obtener_terminosPago')
    {
		$strQuery = "SELECT DISTINCT 
						idTerminoPago,
						Descripcion
					FROM 
                        TerminosPago";
		$con = new Conexion();
	    $con->ejecutaQuery($strQuery);
	    $arrDocumentos = array();
	    $arrRespuesta = $con->getListaObjectos();
        foreach ($arrRespuesta as $objRespuesta){
            foreach ($objRespuesta as $key => $value){
                if(is_string($value)){
                    $objRespuesta->$key = utf8_encode($value);    
                }                
            }
            $arrDocumentos[] = $objRespuesta;
        }
	    $con->cerrar();
	    echo json_encode($arrDocumentos);
    }
    // =====================================
    // ======== OPTENER LUGARSERVICIO =============
    elseif ($opc == 'obtener_modalidad')
    {
		$strQuery = "SELECT DISTINCT 
						idModalidad,
						Descripcion
					FROM 
                        Modalidad";
		$con = new Conexion();
	    $con->ejecutaQuery($strQuery);
	    $arrDocumentos = array();
	    $arrRespuesta = $con->getListaObjectos();
        foreach ($arrRespuesta as $objRespuesta){
            foreach ($objRespuesta as $key => $value){
                if(is_string($value)){
                    $objRespuesta->$key = utf8_encode($value);    
                }                
            }
            $arrDocumentos[] = $objRespuesta;
        }
	    $con->cerrar();
	    echo json_encode($arrDocumentos);
    }
    // =====================================
    // ======== OPTENER LUGARSERVICIO =============
    elseif ($opc == 'obtener_precios')
    {
		$strQuery = "SELECT DISTINCT 
						idPrecios,
						Descripcion
					FROM 
                        Precios";
		$con = new Conexion();
	    $con->ejecutaQuery($strQuery);
	    $arrDocumentos = array();
	    $arrRespuesta = $con->getListaObjectos();
        foreach ($arrRespuesta as $objRespuesta){
            foreach ($objRespuesta as $key => $value){
                if(is_string($value)){
                    $objRespuesta->$key = utf8_encode($value);    
                }                
            }
            $arrDocumentos[] = $objRespuesta;
        }
	    $con->cerrar();
	    echo json_encode($arrDocumentos);
    }
    // =====================================
    // ======== OBTENER CONTACTOS =============
	elseif($opc == 'obtener_contactos'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT ClaveContacto, Nombre, Apellidos, RazonSocial, RFC, Email, Tel  FROM ContactosAcomodados INNER JOIN EmpresasOrdenadas 
                    ON ContactosAcomodados.ClaveEmpresa=EmpresasOrdenadas.ClaveEmpresa";
        $con->ejecutaQuery($strQuery);
        if($con->getNum()>0){
            $arrDatos = $con->getListaObjectos();
            foreach ($arrDatos as $objDato) {
                foreach ($objDato as $key => $value){
                    if(is_string($value)){
                        $objDato->$key = utf8_encode($value);
                    }
                }
                $arrRespuesta[] = $objDato;
            }
            echo json_encode($arrRespuesta);
        }
        else{
            echo json_encode(false);
        }
        $con->cerrar();
    }
    //=======================================
    // ======== OBTENER ARTICULOS =============
	elseif($opc == 'obtener_articulos'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT EquipId, ItemNumber, EquipmentName, Mfr, Model, ServiceDescription FROM SetupEquipment";
        $con->ejecutaQuery($strQuery);
        if($con->getNum()>0){
            $arrDatos = $con->getListaObjectos();
            foreach ($arrDatos as $objDato) {
                foreach ($objDato as $key => $value){
                    if(is_string($value)){
                        $objDato->$key = utf8_encode($value);
                    }
                }
                $arrRespuesta[] = $objDato;
            }
            echo json_encode($arrRespuesta);
        }
        else{
            echo json_encode(false);
        }
        $con->cerrar();
	}
	//========================================
    // ======== OBTENER ARTICULOS SAM =============
	elseif($opc == 'obtener_articulosLocales'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT idEquipo, ItemNumber, NombreEquipo, Marca, Modelo, CONCAT(MetododeCalibracion, ' PUNTOS: ', Alcance) as Metodo FROM EquiposLocales";
        $con->ejecutaQuery($strQuery);
        if($con->getNum()>0){
            $arrDatos = $con->getListaObjectos();
            foreach ($arrDatos as $objDato) {
                foreach ($objDato as $key => $value){
                    if(is_string($value)){
                        $objDato->$key = utf8_encode($value);
                    }
                }
                $arrRespuesta[] = $objDato;
            }
            echo json_encode($arrRespuesta);
        }
        else{
            echo json_encode(false);
        }
        $con->cerrar();
	}
	//========================================
    // ======== OBTENER HISTORIAL COTS =============
	elseif($opc == 'obtener_historialcots'){

        $con = new Conexion();
        $con->conectarAccess();
        $de = $_POST['de'];
        $a = $_POST['a']+1;
        $strQuery = "SELECT TOP (10) NumCot, Cvempresa, Cliente, SUBSTRING(CONVERT(VARCHAR,Fecha),0,12) as Fecha, [Serv-Catalogo] AS ServCatalogo, [Partida No] AS PartidaNo, Tipo, Marca, Modelo, Alcance, ID, Cant, [Punitario-cot] as 
        Precio FROM [UNION-COTIZACIONES] WHERE Fecha between '".$de."-01-01' and '".$a."-12-31'";
        $con->ejecutaQuery($strQuery);
        if($con->getNum()>0){
            $arrDatos = $con->getListaObjectos();
            foreach ($arrDatos as $objDato) {
                foreach ($objDato as $key => $value){
                    if(is_string($value)){
                        $objDato->$key = utf8_encode($value);
                    }
                }
                $arrRespuesta[] = $objDato;
            }
            echo json_encode($arrRespuesta);
        }
        else{
            echo json_encode(false);
        }
        $con->cerrar();
	}
	//========================================
    // ======== OBTENER ARTICULOS COT =============
	elseif($opc == 'obtener_articulosCot'){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT SetupEquipment.EquipId, ItemNumber, EquipmentName, Mfr, Model, ServiceDescription, Price FROM SetupEquipment INNER JOIN SetupEquipmentServiceMapping ON 
                     SetupEquipment.EquipId=SetupEquipmentServiceMapping.EquipId where SetupEquipment.EquipId=$id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
	}
	elseif($opc == 'obtener_articulosCotLIMS'){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT SetupEquipment.EquipId, ItemNumber, EquipmentName, Mfr, Model, ServiceDescription, Price FROM SetupEquipment INNER JOIN SetupEquipmentServiceMapping ON 
                     SetupEquipment.EquipId=SetupEquipmentServiceMapping.EquipId where ItemNumber='".$id."'";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
	}
	//========================================
    // ======== OBTENER ARTICULOS COT =============
	elseif($opc == 'obtener_articulosCotLocales'){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT idEquipo, ItemNumber, NombreEquipo, Marca, Modelo, CONCAT(MetododeCalibracion, ' ', PuntosdeCalibracion) as MetododeCalibracion, Precio FROM
                    EquiposLocales WHERE idEquipo= $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
	}
	//========================================
    // ======== OBTENER ARTICULOS COT =============
	elseif($opc == 'obtener_articulosENTERSAM'){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT idEquipo, ItemNumber, NombreEquipo, Marca, Modelo, CONCAT(MetododeCalibracion, ' ', PuntosdeCalibracion) as MetododeCalibracion, Precio FROM
                    EquiposLocales WHERE ItemNumber='".$id."'";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
	}
	//========================================
    // ======== OBTENER ARTICULOS COT ACCESS =============
	elseif($opc == 'obtener_articulosCotAccess'){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT TOP 1 idEquipo, ItemNumber, NombreEquipo, Marca, Modelo, CONCAT(MetododeCalibracion, ' ', PuntosdeCalibracion) as MetododeCalibracion, Precio FROM 
        EquiposLocales WHERE ItemNumber='".$id."'";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
	}
	//========================================
    // ======== OBTENER COTIZACVIONES SAM =============
	elseif($opc == 'obtener_articulosCotSAM'){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "select distinct *from(	
            SELECT idContacto, DetalleCotizaciones.EquipId, DetalleCotizaciones.NumCot, PartidaNo, ItemNumber, NombreEquipo as Equipo, Marca, Modelo, 
                    identificadorInventarioCliente AS ID, Serie, CONCAT(MetododeCalibracion, ' ', PuntosdeCalibracion) as MetododeCalibracion, 
                    DetalleCotizaciones.Observaciones, ObservacionesServicios, Cantidad, PrecioUnitario, Origen FROM 
                    DetalleCotizaciones INNER JOIN EquiposLocales ON DetalleCotizaciones.EquipId=EquiposLocales.IdEquipo 
                    INNER JOIN Cotizaciones ON DetalleCotizaciones.NumCot=Cotizaciones.NumCot WHERE Origen='ACCESS'
                    union
            SELECT idContacto, DetalleCotizaciones.EquipId, DetalleCotizaciones.NumCot, PartidaNo, ItemNumber, EquipmentName as Equipo, Mfr as Marca, Model as Modelo, 
                    identificadorInventarioCliente AS ID, Serie, CalibrationMethod as MetododeCalibracion, 
                    DetalleCotizaciones.Observaciones, ObservacionesServicios, Cantidad, PrecioUnitario, Origen FROM 
                    DetalleCotizaciones INNER JOIN SetupEquipment on DetalleCotizaciones.EquipId=SetupEquipment.EquipId 
                    INNER JOIN Cotizaciones ON DetalleCotizaciones.NumCot=Cotizaciones.NumCot WHERE Origen='LIMS'
            )x WHERE idContacto=".$id." order by NumCot ";
        $con->ejecutaQuery($strQuery);
        if($con->getNum()>0){
            $arrDatos = $con->getListaObjectos();
            foreach ($arrDatos as $objDato) {
                foreach ($objDato as $key => $value){
                    if(is_string($value)){
                        $objDato->$key = utf8_encode($value);
                    }
                }
                $arrRespuesta[] = $objDato;
            }
            echo json_encode($arrRespuesta);
        }
        else{
            echo json_encode(false);
        }
        $con->cerrar();
	}
	//========================================
	elseif($opc=="obtener_contacto"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT Nombre, Apellidos, RazonSocial, Email, Tel FROM ContactosAcomodados INNER JOIN EmpresasOrdenadas 
        ON ContactosAcomodados.ClaveEmpresa=EmpresasOrdenadas.ClaveEmpresa WHERE ClaveContacto = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
    }
	//========================================
	elseif($opc=="obtener_contactoPlus"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT Nombre, Apellidos, RazonSocial, Email, Tel, RazonSocial, CP, Domicilio FROM ContactosAcomodados INNER JOIN EmpresasOrdenadas 
              ON ContactosAcomodados.ClaveEmpresa=EmpresasOrdenadas.ClaveEmpresa INNER JOIN DireccionesAcomodadas on EmpresasOrdenadas.ClaveEmpresa=DireccionesAcomodadas.ClaveEmpresa 
              WHERE Facturacion=1 and ClaveContacto =$id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
    }
	//========================================
	elseif($opc=="obtener_contactoH"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT Nombre, Apellidos, RazonSocial, (select count(*) from Cotizaciones WHERE idContacto=$id) as Cotizaciones FROM ContactosAcomodados INNER JOIN EmpresasOrdenadas 
              ON ContactosAcomodados.ClaveEmpresa=EmpresasOrdenadas.ClaveEmpresa INNER JOIN DireccionesAcomodadas on EmpresasOrdenadas.ClaveEmpresa=DireccionesAcomodadas.ClaveEmpresa 
              WHERE Facturacion=1 and ClaveContacto =$id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
    }
	elseif($opc=="obtener_direccion"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM DireccionesAcomodadas WHERE idDireccion = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
        $con->cerrar();
    }
?>