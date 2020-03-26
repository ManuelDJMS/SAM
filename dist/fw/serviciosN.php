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
	elseif ($opc == 'guardar_servicio') {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO [Catalogo-Servicios] (NoCatalogo,Servicio,ComplementoServicio,Observaciones,Unidad,Porcentaje,PrecioBase,Modalidad,ComentariosInternos,Creo)
                         VALUES ('".$datos->NoCatalogo."', '".$datos->Servicio."','".$datos->ComplementoServicio."','".$datos->Observaciones."','".$datos->Unidad."'
                         ,'".$datos->Porcentaje."','".$datos->PrecioBase."','".$datos->Modalidad."','".$datos->ComentariosInternos."',".$_SESSION['iduser'].")";
        }
        else{
            $strQuery = "UPDATE [Catalogo-Servicios] SET 
            NoCatalogo = '".$datos->NoCatalogo."',
            Servicio = '".$datos->Servicio."',
            ComplementoServicio = '".$datos->ComplementoServicio."',
            Observaciones = '".$datos->Observaciones."',
            Unidad = '".$datos->Unidad."',
            Porcentaje = '".$datos->Porcentaje."',
            PrecioBase = '".$datos->PrecioBase."',
            Modalidad = '".$datos->Modalidad."',
            ComentariosInternos = '".$datos->ComentariosInternos."',
            FechaModificacion = getdate()
            WHERE IdServicio = '".$datos->IdServicio."'";
         }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}
	
	elseif($opc == 'obtener_registros'){
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
	
	elseif($opc=="obtener_servicio"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM [Catalogo-Servicios] WHERE idServicio = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }
