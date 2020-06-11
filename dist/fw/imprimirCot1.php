<?php
 session_start();
 error_reporting(E_ALL);
ini_set('display_errors', '0');
	require_once "classes/Conexion.php";

	 $opc = $_POST['opc'];
	if ($opc == '' || $opc == 'undefined' || $opc == null) {
	    echo json_encode(false);
	    die();
	}
	
	
	elseif($opc=="obtener_cot"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT [Cotizaciones].NumCot, [Cotizaciones].FechaDesde, [Cotizaciones].FechaHasta, [Contactos].Nombre +' '+ [Contactos].Apellidos as Contacto, [Contactos].Cargo, 
                            [Contactos].Tel, [Contactos].Email,[Empresas].Compania, [DireccionesAcomodadas].Domicilio, [Usuarios].Nombre +' '+ [Usuarios].Apellidos as Usuario,
                            [Usuarios].Depto, [Usuarios].Email as Email1, [Usuarios].Firma, [LugarServicio].Descripcion as Lugar, [Precios].Descripcion as Precio,
                            [TerminosPago].Descripcion as Terminos, [TiempoEntrega].Descripcion as Tiempo, [Modalidad].Descripcion as Modalidad, [Empresas].RazonSocial, [Empresas].RFC
                    FROM [Cotizaciones] 
                    INNER JOIN [Contactos]  ON [Cotizaciones].idContacto = [Contactos].ClaveContacto
                    INNER JOIN [DireccionesAcomodadas]  ON [DireccionesAcomodadas].IdDireccion = [Contactos].IdDireccion
                    INNER JOIN [Empresas] ON [Empresas].ClaveEmpresa = [DireccionesAcomodadas].ClaveEmpresa
                    INNER JOIN [Usuarios] ON [Cotizaciones].idUsuario = [Usuarios].idUsuario
                    INNER JOIN [LugarServicio] ON [Cotizaciones].idLugarServicio = [LugarServicio].idLugarServicio
                    INNER JOIN [Modalidad] ON [Cotizaciones].idModalidad = [Modalidad].idModalidad
                    INNER JOIN [TiempoEntrega] ON [Cotizaciones].idTiempoEntrega = [TiempoEntrega].idTiempoEntrega
                    INNER JOIN [TerminosPago]  ON [Cotizaciones].idTerminoPago = [TerminosPago].idTerminoPago
                    INNER JOIN [Precios]  ON [Cotizaciones].idPrecios = [Precios] .idPrecios
                    WHERE [Cotizaciones] .NumCot = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);

    }
    elseif($opc == 'obtener_partidas'){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM DetalleCotizaciones
                    INNER JOIN SetupEquipment ON DetalleCotizaciones.EquipId = SetupEquipment.EquipId 
                    INNER JOIN SetupEquipmentServiceMapping ON DetalleCotizaciones.EquipId = SetupEquipmentServiceMapping.EquipId where NumCot = $id";
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