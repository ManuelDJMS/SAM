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
	elseif ($opc == 'guardar_usuario') {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO Usuarios (Nombre,Apellidos,Email,Depto,Ext,password,Firma,Responsable,Metrologo,Auxiliar,Creo)
                         VALUES ('".$datos->Nombre."', '".$datos->Apellidos."','".$datos->Email."','".$datos->Depto."','".$datos->Ext."'
                         ,'".$datos->password."','".$datos->Firma."','".$datos->Responsable."','".$datos->Metrologo."','".$datos->Auxiliar."',".$_SESSION['iduser'].")";
        }
        else{
            $strQuery = "UPDATE Usuarios SET 
            Nombre = '".$datos->Nombre."',
            Apellidos = '".$datos->Apellidos."',
            Depto = '".$datos->Depto."',
            Ext = '".$datos->Ext."',
            password = '".$datos->password."',
            Responsable = '".$datos->Responsable."',
            Metrologo = '".$datos->Metrologo."',
            Auxiliar = '".$datos->Auxiliar."',
            FechaModificacion = getdate()
            WHERE idUsuario = '".$datos->idUsuario."'";
         }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}
	
	elseif($opc == 'obtener_registros'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM Usuarios";
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
	
	elseif($opc=="obtener_usuario"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM Usuarios WHERE idUsuario = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }

    elseif($opc=="obtener_cve"){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT TOP(1) cve from Usuarios order by cve desc";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }