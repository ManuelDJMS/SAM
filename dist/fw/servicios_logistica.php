<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
	require_once "classes/Conexion.php";
	$opc = $_POST['opc'];
	// $opc = "registrar_empresa";
	if ($opc == '' || $opc == 'undefined' || $opc == null) {
	    echo json_encode(false);
	    die();
	}
	elseif ($opc == 'guardar_servicioLog') {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO CatalogoServiciosLogistica (NoCatalogo, cve, DescripcionServicio, Referencia, Unidad, PrecioBase, Observaciones)
                         VALUES ('".$datos->NoCatalogo."',".$_SESSION['iduser'].",'".$datos->Descripcion."',' ".$datos->Referencia."','".$datos->Unidad."','".$datos->Precio."','".$datos->Observaciones."')";
        }
        else{
            $strQuery = "UPDATE CatalogoServiciosLogistica SET 
            NoCatalogo = '".$datos->NoCatalogo."',
            FechaModificacion = getdate(),
            DescripcionServicio = '".$datos->Descripcion."',
            Referencia = '".$datos->Referencia."',
            Observaciones = '".$datos->Observaciones."',
            PrecioBase = ".$datos->Precio.",
            Unidad = '".$datos->Unidad."'
         WHERE idCatLog = '".$datos->idCatLog."'";
         }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}
	
	elseif($opc == 'obtener_registros'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM CatalogoServiciosLogistica";
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
	
	elseif($opc=="obtener_registro"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM CatalogoServiciosLogistica WHERE idCatLog = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }