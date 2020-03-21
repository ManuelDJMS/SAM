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
	elseif ($opc == 'guardar_patron') {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO EquiposYPatrones (Descripcion, Referencia, Trabajo, EquipoAuxiliar, UltimaCalibracion, ProximaCalibracion, Status, Creo)
                         VALUES ('".$datos->Descripcion."', '".$datos->Referencia."','".$datos->Trabajo."','".$datos->EquipoAuxiliar."','".$datos->UltimaCalibracion."','".$datos->ProximaCalibracion."','".$datos->Status."'
							 		           ,".$_SESSION['iduser'].")";
        }
        else{
            $strQuery = "UPDATE EquiposYPatrones SET 
            Descripcion = '".$datos->Descripcion."',
            Referencia = '".$datos->Referencia."',
            Trabajo = '".$datos->Trabajo."',
            EquipoAuxiliar = '".$datos->EquipoAuxiliar."'
         WHERE idPatron = '".$datos->idPatron."'";
         }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}
	
	elseif($opc == 'obtener_registros'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM [EquiposYPatrones]";
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
	
	elseif($opc=="obtener_patron"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM [EquiposYPatrones] WHERE idPatron = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }