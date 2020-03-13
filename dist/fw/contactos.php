<?php
 session_start();
 error_reporting(E_ALL);
ini_set('display_errors', '0');
// 	include "config.php";
	require_once "classes/Conexion.php";
     $opc = $_POST['opc'];
	if ($opc == '' || $opc == 'undefined' || $opc == null) {
	    echo json_encode(false);
	    die();
	}
	elseif ($opc == 'guardar_contacto') {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){

            $strQuery = "INSERT INTO Contactos (Nombre,Apellidos,Cargo,Celular,Tel,
						Fax,Ext,Email,CondicionesClienteAdmon,Activo,CreadorPor)
						VALUES('".$datos->Nombre."','".$datos->Apellidos."','".$datos->Cargo."','".$datos->Celular."','".$datos->Tel."','".$datos->Fax."','".$datos->Ext."','".$datos->Email."','".$datos->Condiciones."','".$datos->Activo."',".$_SESSION['iduser'].")";
        }
        else{
			$strQuery = "UPDATE Contactos SET 
            Nombre = '".$datos->Nombre."',
            Apellidos = '".$datos->Apellidos."',
            Cargo = '".$datos->Cargo."',
            Celular = '".$datos->Celular."',
            Tel = '".$datos->Tel."',
            Ext = '".$datos->Ext."',
            Fax = '".$datos->Fax."',
            Email = '".$datos->Email."',
            Condiciones = '".$datos->Condiciones."',
            Activo = '".$datos->Activo."',
            FechaModificacion = getdate(),
            ModificadoPor = ".$_SESSION['iduser']."
         WHERE ClaveContacto = '".$datos->ClaveContacto."'";
        }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}

	elseif($opc == 'obtener_registros'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM [SAM].[dbo].[Contactos] where ClaveContacto < '1000' ";
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
        $strQuery = "SELECT * FROM Contactos WHERE ClaveContacto = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }
    elseif($opc == 'obtener_empresas'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM Empresas";
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