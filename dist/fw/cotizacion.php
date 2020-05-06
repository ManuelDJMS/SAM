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
            //::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
            //-------------------------- SE ALAMCENA LA CADENA QUE GUARDA EL ENCABEZADO DE LA COT JUNTO CON LOS PARAMETROS-----------------------------------------------------
            $sql1 = "INSERT INTO Cotizaciones (idUsuario,idContacto, idLugarServicio, idModalidad, idTiempoEntrega, idTerminoPago, idPrecios, Referencia, FechaDesde,
                       FechaHasta, Observaciones, Subtotal, Iva, Total) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $params1 = array($_SESSION['iduser'],$datos->idContacto,$datos->idLugarServicio,$datos->idModalidad,$datos->idTiempoEntrega,$datos->idTerminosPago,$datos->idPrecios,$datos->Referencia,'2020-01-01','2020-01-01',$datos->ObservacionesCot,$datos->Subtotal,$datos->Iva,$datos->Total);
            //-----------------------------------------------------------------------------------------------------------------------------------------------------------------
            //,,,,,,, ARREGLO PARA LOS PARAMETROS DE LAS PARTIDAS ,,,,,,,,,,
            $params2 = array(); 
            //,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
            //#################### CICLO PARA OBTENER EL NUMERO DE PARAMETROS A INSERTAR ##############################################
            for ($i=0; $i< count($articulos); $i++)
            {
                    if ($i==(count($articulos)-1))
                    {
                        $sql2=$sql2."((Select MAX(NumCot) from Cotizaciones),?,?,?,?,?,?,?,?);";
            
                    }
                    else
                    {
                        $sql2=$sql2."((Select MAX(NumCot) from Cotizaciones),?,?,?,?,?,?,?,?),";
                    }
                array_push($params2, intval($articulos[$i]),1,intval($cantidades[$i]),1,$ids[$i],$series[$i],$observaciones[$i],$observicio[$i]);
                
            } 
            //########################################################################################################################
            if ((count($articulos)) == 1)
            {
                $sql2 = "INSERT INTO DetalleCotizaciones (NumCot,EquipId,PartidaNo,Cantidad,CantidadReal,identificadorInventarioCliente,Serie,Observaciones,ObservacionesServicios) VALUES ((Select MAX(NumCot) from Cotizaciones),?,?,?,?,?,?,?,?)";
            }
            else
            {
                $sql2= "INSERT INTO DetalleCotizaciones (NumCot,EquipId,PartidaNo,Cantidad,CantidadReal,identificadorInventarioCliente,Serie,Observaciones,ObservacionesServicios) VALUES ".$sql2;

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
    // =======================================  CODIGO PARA GUARADAR LAS DIRECCIONES ===========================================================================
    elseif ($opc == 'guardar_direccion') {
        $obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        // ========================== COSIGO PARA GUARDAR  ========================================
        if($datos->accion == 'nuevo'){
            $strQuery="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->Direccion."' and
            Domicilio='".$datos->Direccion."' and Ciudad='".$datos->Ciudad."') begin UPDATE DireccionesAcomodadas
            SET Facturacion=1 WHERE Compania='".$datos->Compania."' and Domicilio='".$datos->Direccion."' and Ciudad='".$datos->Ciudad."'; end else begin INSERT INTO DireccionesAcomodadas 
            (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
            (".$_SESSION['iduser'].",'".$datos->Compania."',".$datos->ClaveEmpresa.",'".$datos->Direccion."','".$datos->Ciudad."','".$datos->Estado."','".$datos->CP."',
            '".$datos->Pais."',1,0,0,'".$datos->Referencias."') end;";
            
            //-----------------------------------------------------------------------------------------------------------------------------------------------------------
            // $res = $con->ejecutaSQLTransac($strQuery);
        }
        // =========================================================================================================================================================
        // ========================= CODIGO PARA EDITAr ==========================================
        else{
            if($datos->Tipo=='')
            {
                $razon=$datos->Compania;
            }
            else
            {
                $razon=$datos->Compania.", ".$datos->Tipo;
            }
            $strQuery = "UPDATE DireccionesAcomodadas SET 
            Compania = '".$razon."',
            FechaModificacion = getdate(),
            Domicilio = '".$datos->Direccion."',
            Ciudad = '".$datos->Ciudad."',
            Estado = '".$datos->Estado."',
            CP = '".$datos->CP."',
            Facturacion = ".$datos->Facturacion.",
            Consignacion = ".$datos->Consig.",
            Envio = ".$datos->Envio.",
            Referencias = '".$datos->Referencias."'
            WHERE idDireccion = '".$datos->idDireccion."'";
           
        }
        $res = $con->ejecutaSQLTransac($strQuery);
        $con->cerrar();
        echo json_encode($res);
    }
    // ======================================
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
    // ======== OBTENER ARTICULOS COT =============
	elseif($opc == 'obtener_articulosCot'){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT SetupEquipment.EquipId, ItemNumber, EquipmentName, Mfr, Model, ServiceDescription, Price FROM SetupEquipment INNER JOIN SetupEquipmentServiceMapping ON 
                     SetupEquipment.EquipId=SetupEquipmentServiceMapping.EquipId where SetupEquipment.EquipId= $id";
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
        $strQuery = "SELECT Nombre, Apellidos, RazonSocial, Email, Tel, Ciudad, CP, Domicilio FROM ContactosAcomodados INNER JOIN EmpresasOrdenadas 
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