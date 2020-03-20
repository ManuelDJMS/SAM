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

	elseif($opc == 'obtener_registros'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM UnidadNegocio";
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
    
    elseif($opc == 'obtener_signatarios'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM UnidadNegocio u  INNER JOIN [RelacionaU-UN] r on u.idUnidadNegocio =  r.idUnidadNegocio
        INNER JOIN [Usuarios] US ON r.idUsuario = US.idUsuario";
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
    
    elseif($opc=="obtener_unidad"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM UnidadNegocio WHERE idUnidadNegocio = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }

    elseif($opc=="obtener_personal"){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "  SELECT * FROM Usuarios where Depto <> 'SISTEMAS' AND Depto <> 'VENTAS' AND Depto <> 'LOGISTICA' AND Depto <> 'OPERADORES'";
        $con->ejecutaQuery($strQuery);
        $arrEmpleados = array();
        if($con->getNum()>0){
            $arrRespuesta = $con->getListaObjectos();
            $html = "<option value=''></option>";
            foreach ($arrRespuesta as $objUsuario) {
                foreach ($objUsuario as $key => $value){
                    if(is_string($value)){
                        $objUsuario->$key = utf8_encode($value);    
                    }                
                }
                $arrEmpleados[] = $objUsuario;
                $html .= '<option value="'.$objUsuario->idUsuario.'">'.$objUsuario->idUsuario.'</option>';
            }
            echo json_encode($html);
        }
        else 
            echo json_encode(null);
        $con->cerrar();
    }

    elseif ($opc == 'guardar_signatario') {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO RelacionaU-UN (idUsuario,idUnidadNegocio)
                         VALUES ('".$datos->idUsuario."', '".$datos->idUnidadNegocio."')";
        }
        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}