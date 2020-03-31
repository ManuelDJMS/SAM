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
        else{
            $strQuery = "UPDATE Articulos SET 
            [EquipmentName]	=	'".$datos->Nombre."', 
            [Model]	=	'".$datos->Modelo."',
            [Accuracy]	=	'".$datos->Exactitud."',
            [Mfr]	=	'".$datos->Marca."',
            [SrlNo]	=	'".$datos->Serie."',
            [Dept]	=	'".$datos->Lab."',
            [CALInterval]	=	'".$datos->Intervalo."',
            [CALCycle]	=	'".$datos->Ciclo."',
            [CALDue]	=	'".$datos->DiasCalibracion."',
            [ShortNotes]	=	'".$datos->Notas."',
            [IsActive]	=	'".$datos->CActivo."',
            [ItemNumber]	=	'".$datos->itemNumber."',
            [AdditionalSepcification]	=	'".$datos->Especificaciones."',
            [TurnAroundTime]	=	'".$datos->DiasCalibracion."',
            [ApproxWeight]	=	'".$datos->PesoAproximado."',
            [RelationItemNo]	=	'".$datos->Relacion."',
            [CalibrationMethod]	=	'".$datos->Metodo."',
            [Standardization]	=	'".$datos->Estandarizacion."',
            [Accreditation]	=	'".$datos->Acreditacion."',
            [ServiceDescription]	=	'".$datos->Descripcion."',
            [Uncertainity]	=	'".$datos->Rango."',
            [FechaModificacion]	=	getdate()
            WHERE EquipId = '".$datos->EquipId."'";
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

   
    


	
	