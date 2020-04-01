<?php
 session_start();
 error_reporting(E_ALL);
ini_set('display_errors', '0');
// 	include "config.php";
	require_once "classes/Conexion.php";

	 $opc = $_POST['opc'];
	// $opc = "registrar_empresa";
	if ($opc == '' || $opc == 'undefined' || $opc == null) {
	    echo json_encode(false);
	    die();
	}
	elseif($opc == 'obtener_registros'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM Articulos";
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
        $strQuery = "SELECT * FROM Articulos WHERE EquipId = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }

    elseif ($opc == 'registrar_articulo_servicio') {
        $obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery1 = "INSERT INTO Articulos ([EquipmentName],[Model],[Accuracy],[Mfr],[SrlNo],[Dept],[CALInterval],[CALCycle],[CALDue]
                                                ,[ShortNotes],[IsActive],[ItemNumber],[AdditionalSepcification],[TurnAroundTime],[ApproxWeight]
                                                ,[RelationItemNo],[CalibrationMethod],[Standardization],[Accreditation],[ServiceDescription],[Uncertainity],[Creo])
                         VALUES ('".$datos->Nombre."', '".$datos->Modelo."','".$datos->Exactitud."','".$datos->Marca."','".$datos->Serie."',
                                 '".$datos->Lab."','".$datos->Intervalo."','".$datos->Ciclo."','".$datos->DiasCalibracion."',
                                '".$datos->Notas."','".$datos->CActivo."','".$datos->itemNumber."','".$datos->Especificaciones."',
                                '".$datos->DiasCalibracion."','".$datos->PesoAproximado."','".$datos->Relacion."','".$datos->Metodo."',
                                '".$datos->Estandarizacion."','".$datos->Acreditacion."','".$datos->Descripcion."','".$datos->Rango."',".$_SESSION['iduser'].")";
            $strQuery2 = "INSERT INTO [RelacionServ-Articulos] (idServicio, idArticulo,Precio)
                        VALUES ('".$datos->IdServicio."',(Select MAX(EquipId) from Articulos),'".$datos->Precio."')";
        }
        $res = $con->ejecutaSQLTransacaArticulos($strQuery1,$strQuery2);
        $con->cerrar();
        echo json_encode($res);
    }

    elseif ($opc == 'registrar_articulo') {
        $obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO Articulos ([EquipmentName],[Model],[Accuracy],[Mfr],[SrlNo],[Dept],[CALInterval],[CALCycle],[CALDue]
                                                ,[ShortNotes],[IsActive],[ItemNumber],[AdditionalSepcification],[TurnAroundTime],[ApproxWeight]
                                                ,[RelationItemNo],[CalibrationMethod],[Standardization],[Accreditation],[ServiceDescription],[Uncertainity],[Creo])
                         VALUES ('".$datos->Nombre."', '".$datos->Modelo."','".$datos->Exactitud."','".$datos->Marca."','".$datos->Serie."',
                                 '".$datos->Lab."','".$datos->Intervalo."','".$datos->Ciclo."','".$datos->DiasCalibracion."',
                                '".$datos->Notas."','".$datos->CActivo."','".$datos->itemNumber."','".$datos->Especificaciones."',
                                '".$datos->DiasCalibracion."','".$datos->PesoAproximado."','".$datos->Relacion."','".$datos->Metodo."',
                                '".$datos->Estandarizacion."','".$datos->Acreditacion."','".$datos->Descripcion."','".$datos->Rango."',".$_SESSION['iduser'].")";
        }
        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
    }

    elseif($opc=="obtener_servicios"){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM [Catalogo-Servicios]";
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

    elseif($opc=="agregar_servicio"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM [Catalogo-Servicios] WHERE IdServicio = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }

   
    


	
	