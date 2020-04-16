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
    // ======== GUARDAR EMPRESAS =============
    elseif ($opc == 'guardar_empresa') 
    {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        // ========================== COSIGO PARA GUARDAR  ========================================
        if($datos->accion == 'nuevo')
        {
            // ---------------------------------------- CODIGO PARA GUARDAR LAS EMPRESAS NUEVAS ----------------------------------------------------------------------
            if($datos->Tipo=='')
            {
                $razon=$datos->RazonSocial;
            }
            else
            {
                $razon=$datos->RazonSocial.", ".$datos->Tipo;
            }
            $strQuery = "if exists(select RazonSocial, RFC from EmpresasOrdenadas where RazonSocial='".$razon."' or RFC='".$datos->RFC."') begin INSERT INTO EmpresasOrdenadas 
            (idUsuario,idPaqueteria,RazonSocial,RFC,Credito,CuentaMensajeria, Descuento, NumProvMetas, AdminPaq, ObservacionesEmpresa, 
            CvaEmpresaAccess) VALUES (1,355,'error','error','error','error','error','error','error','error','error');
            end else begin INSERT INTO EmpresasOrdenadas (idUsuario,idPaqueteria,RazonSocial,RFC,Credito,CuentaMensajeria, Descuento, NumProvMetas, AdminPaq, ObservacionesEmpresa, 
            CvaEmpresaAccess) VALUES (".$_SESSION['iduser'].",".$datos->Paqueteria.",'".$razon."','".$datos->RFC."','".$datos->Credito."',
            '".$datos->CuentaMensajeria."',".$datos->Descuento.",'".$datos->NoProveedor."','".$datos->AdminPaq."','".$datos->Observaciones."',".$datos->Access."); end;";
            //-----------------------------------------------------------------------------------------------------------------------------------------------------------
            // -------------------------------------------- CODIGO PARA GUARDAR LAS DIRECCIONES NUEVAS -------------------------------------------------------------------
            if ($datos->Facturacion ==1 && $datos->Consignacion==1 && $datos->Envio==1)
            {
                $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionFiscal."' and
                Domicilio='".$datos->DireccionFiscal."' and Ciudad='".$datos->CiudadFiscal."') begin UPDATE DireccionesAcomodadas
                SET Facturacion=1 WHERE Compania='".$datos->CompaniaFiscal."' and Domicilio='".$datos->DireccionFiscal."' and Ciudad='".$datos->CiudadFiscal."'; end else begin INSERT INTO DireccionesAcomodadas 
                (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                (".$_SESSION['iduser'].",'".$datos->CompaniaFiscal."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionFiscal."','".$datos->CiudadFiscal."','".$datos->EstadoFiscal."','".$datos->CPFiscal."',
                '".$datos->PaisFiscal."',1,0,0,'".$datos->ReferenciasFiscal."'),
                (".$_SESSION['iduser'].",'".$datos->CompaniaConsig."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionConsig."','".$datos->CiudadConsig."','".$datos->EstadoConsig."','".$datos->CPConsig."',
                '".$datos->PaisConsig."',0,1,0,'".$datos->ReferenciasConsig."'),
                (".$_SESSION['iduser'].",'".$datos->CompaniaEnvio."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionEnvio."','".$datos->CiudadEnvio."','".$datos->EstadoEnvio."','".$datos->CPEnvio."',
                '".$datos->PaisEnvio."',0,0,1,'".$datos->ReferenciasEnvio."'); end;";
            }
            else if($datos->Facturacion==1 && $datos->Consignacion==0 && $datos->Envio==0)
            {
                $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionFiscal."' and
                Domicilio='".$datos->DireccionFiscal."' and Ciudad='".$datos->CiudadFiscal."') begin UPDATE DireccionesAcomodadas
                SET Facturacion=".$datos->Facturacion." WHERE Compania='".$datos->CompaniaFiscal."' and Domicilio='".$datos->DireccionFiscal."' and Ciudad='".$datos->CiudadFiscal."'; end else begin INSERT INTO DireccionesAcomodadas 
                (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                (".$_SESSION['iduser'].",'".$datos->CompaniaFiscal."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionFiscal."','".$datos->CiudadFiscal."','".$datos->EstadoFiscal."','".$datos->CPFiscal."',
                '".$datos->PaisFiscal."',1,0,0,'".$datos->ReferenciasFiscal."'); end;";
            }
            else if($datos->Facturacion==0 && $datos->Consignacion==1 && $datos->Envio==0)
            {
                $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionConsig."' and
                ClaveEmpresa=1 and Domicilio='".$datos->DireccionConsig."' and Ciudad='".$datos->CiudadConsig."') begin UPDATE DireccionesAcomodadas
                SET Consignacion=".$datos->Consignacion." WHERE Compania='".$datos->CompaniaConsig."' and Domicilio='".$datos->DireccionConsig."' and Ciudad='".$datos->CiudadConsig."'; end else begin INSERT INTO DireccionesAcomodadas 
                (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                (".$_SESSION['iduser'].",'".$datos->CompaniaConsig."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionConsig."','".$datos->CiudadConsig."','".$datos->EstadoConsig."','".$datos->CPConsig."',
                '".$datos->PaisConsig."',0,1,0,'".$datos->ReferenciasConsig."'); end;";
            }
            else if($datos->Facturacion==0 && $datos->Consignacion==0 && $datos->Envio==1)
            {
                $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionEnvio."' and
                ClaveEmpresa=1 and Domicilio='".$datos->DireccionEnvio."' and Ciudad='".$datos->CiudadEnvio."') begin UPDATE DireccionesAcomodadas
                SET Envio=".$datos->Envio." WHERE Compania='".$datos->CompaniaEnvio."' and Domicilio='".$datos->DireccionEnvio."' and Ciudad='".$datos->CiudadEnvio."'; end else begin INSERT INTO DireccionesAcomodadas 
                (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                (".$_SESSION['iduser'].",'".$datos->CompaniaEnvio."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionEnvio."','".$datos->CiudadEnvio."','".$datos->EstadoEnvio."','".$datos->CPEnvio."',
                '".$datos->PaisEnvio."',0,0,1,'".$datos->ReferenciasEnvio."'); end;";
            }
            else if($datos->Facturacion==1 && $datos->Consignacion==1 && $datos->Envio==0)
            {
                if ($datos->DireccionCombi=="" || $datos->DireccionCombi == 'undefined' || $datos->DireccionCombi == null)
                {
                    $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionFiscal."' and
                    ClaveEmpresa=1 and Domicilio='".$datos->DireccionFiscal."' and Ciudad='".$datos->CiudadFiscal."') begin UPDATE DireccionesAcomodadas
                    SET Facturacion=1 WHERE Compania='".$datos->CompaniaFiscal."' and Domicilio='".$datos->DireccionFiscal."' and Ciudad='".$datos->CiudadFiscal."'; end else begin INSERT INTO DireccionesAcomodadas 
                    (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                    (".$_SESSION['iduser'].",'".$datos->CompaniaFiscal."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionFiscal."','".$datos->CiudadFiscal."','".$datos->EstadoFiscal."','".$datos->CPFiscal."',
                    '".$datos->PaisFiscal."',1,0,0,'".$datos->ReferenciasFiscal."'),
                    (".$_SESSION['iduser'].",'".$datos->CompaniaConsig."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionConsig."','".$datos->CiudadConsig."','".$datos->EstadoConsig."','".$datos->CPConsig."',
                    '".$datos->PaisConsig."',0,1,0,'".$datos->ReferenciasConsig."'); end;";
                }
                else
                {
                    $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionCombi."' and
                    ClaveEmpresa=1 and Domicilio='".$datos->DireccionCombi."' and Ciudad='".$datos->CiudadCombi."') begin UPDATE DireccionesAcomodadas
                    SET Facturacion=".$datos->Facturacion." WHERE Compania='".$datos->CompaniaCombi."' and Domicilio='".$datos->DireccionCombi."' and Ciudad='".$datos->CiudadCombi."'; end else begin INSERT INTO DireccionesAcomodadas 
                    (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                    (".$_SESSION['iduser'].",'".$datos->CompaniaCombi."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionCombi."','".$datos->CiudadCombi."','".$datos->EstadoCombi."','".$datos->CPCombi."',
                    '".$datos->PaisCombi."',1,1,0,'".$datos->ReferenciasCombi."'); end;";
                }
                
            }
            else if($datos->Facturacion==0 && $datos->Consignacion==1 && $datos->Envio==1)
            {
                if ($datos->DireccionCombi=="" || $datos->DireccionCombi == 'undefined' || $datos->DireccionCombi == null)
                {
                    $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionConsig."' and
                    ClaveEmpresa=1 and Domicilio='".$datos->DireccionConsig."' and Ciudad='".$datos->CiudadConsig."') begin UPDATE DireccionesAcomodadas
                    SET Facturacion=1 WHERE Compania='".$datos->CompaniaConsig."' and Domicilio='".$datos->DireccionConsig."' and Ciudad='".$datos->CiudadConsig."'; end else begin INSERT INTO DireccionesAcomodadas 
                    (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                    (".$_SESSION['iduser'].",'".$datos->CompaniaConsig."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionConsig."','".$datos->CiudadConsig."','".$datos->EstadoConsig."','".$datos->CPConsig."',
                    '".$datos->PaisConsig."',0,1,0,'".$datos->ReferenciasConsig."'),
                    (".$_SESSION['iduser'].",'".$datos->CompaniaEnvio."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionEnvio."','".$datos->CiudadEnvio."','".$datos->EstadoEnvio."','".$datos->CPEnvio."',
                    '".$datos->PaisEnvio."',0,0,1,'".$datos->ReferenciasEnvio."'); end;";
                }
                else
                {
                    $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionCombi."' and
                    ClaveEmpresa=1 and Domicilio='".$datos->DireccionCombi."' and Ciudad='".$datos->CiudadCombi."') begin UPDATE DireccionesAcomodadas
                    SET Consignacion=".$datos->Consignacion." WHERE Compania='".$datos->CompaniaCombi."' and Domicilio='".$datos->DireccionCombi."' and Ciudad='".$datos->CiudadCombi."'; end else begin INSERT INTO DireccionesAcomodadas 
                    (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                    (".$_SESSION['iduser'].",'".$datos->CompaniaCombi."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionCombi."','".$datos->CiudadCombi."','".$datos->EstadoCombi."','".$datos->CPCombi."',
                    '".$datos->PaisCombi."',0,1,1,'".$datos->ReferenciasCombi."'); end;";
                }
            }
            else if($datos->Facturacion==1 && $datos->Consignacion==0 && $datos->Envio==1)
            {
                if ($datos->DireccionCombi=="" || $datos->DireccionCombi == 'undefined' || $datos->DireccionCombi == null)
                {
                    $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionFiscal."' and
                    ClaveEmpresa=1 and Domicilio='".$datos->DireccionFiscal."' and Ciudad='".$datos->CiudadFiscal."') begin UPDATE DireccionesAcomodadas
                    SET Facturacion=1 WHERE Compania='".$datos->CompaniaFiscal."' and Domicilio='".$datos->DireccionFiscal."' and Ciudad='".$datos->CiudadFiscal."'; end else begin INSERT INTO DireccionesAcomodadas 
                    (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                    (".$_SESSION['iduser'].",'".$datos->CompaniaFiscal."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionFiscal."','".$datos->CiudadFiscal."','".$datos->EstadoFiscal."','".$datos->CPFiscal."',
                    '".$datos->PaisFiscal."',1,0,0,'".$datos->ReferenciasFiscal."'),
                    (".$_SESSION['iduser'].",'".$datos->CompaniaEnvio."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionEnvio."','".$datos->CiudadEnvio."','".$datos->EstadoEnvio."','".$datos->CPEnvio."',
                    '".$datos->PaisEnvio."',0,0,1,'".$datos->ReferenciasEnvio."'); end;";
                }
                else
                {
                    $strQuery2="if exists(SELECT Compania, ClaveEmpresa, Domicilio, Ciudad from DireccionesAcomodadas WHERE Compania='".$datos->DireccionCombi."' and
                    ClaveEmpresa=1 and Domicilio='".$datos->DireccionCombi."' and Ciudad='".$datos->CiudadCombi."') begin UPDATE DireccionesAcomodadas
                    SET Facturacion=".$datos->Facturacion." WHERE Compania='".$datos->CompaniaCombi."' and Domicilio='".$datos->DireccionCombi."' and Ciudad='".$datos->CiudadCombi."'; end else begin INSERT INTO DireccionesAcomodadas 
                    (idUsuario, Compania, ClaveEmpresa, Domicilio, Ciudad, Estado, CP, Pais, Facturacion, Consignacion, Envio, Referencias) VALUES 
                    (".$_SESSION['iduser'].",'".$datos->CompaniaCombi."',(Select MAX(ClaveEmpresa) from EmpresasOrdenadas),'".$datos->DireccionCombi."','".$datos->CiudadCombi."','".$datos->EstadoCombi."','".$datos->CPCombi."',
                    '".$datos->PaisCombi."',1,0,1,'".$datos->ReferenciasCombi."'); end;";
                }
            }
            //-----------------------------------------------------------------------------------------------------------------------------------------------------------
            $res = $con->ejecutaSQLTransacEmpresas($strQuery, $strQuery2);
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
        $strQuery = "SELECT EquipId, ItemNumber, EquipmentName, Mfr, Model, ServiceDescription FROM SetupEquipment where EquipId= $id";
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