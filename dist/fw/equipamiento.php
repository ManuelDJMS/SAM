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
        $strQuery = "SELECT * FROM Empresas e INNER JOIN Direcciones d ON e.ClaveEmpresa = d.ClaveEmpresa";
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
    
    elseif($opc=="obtener_empresa"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM Empresas WHERE ClaveEmpresa = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }
    elseif($opc=="obtener_contactos"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM Empresas e INNER JOIN Direcciones d ON e.ClaveEmpresa = d.ClaveEmpresa
        INNER JOIN Contactos c ON d.idDireccion =  c.IdDireccion where e.ClaveEmpresa = $id";
        $con->ejecutaQuery($strQuery);
        $arrContactos = array();
        if($con->getNum()>0){
            $arrRespuesta = $con->getListaObjectos();
            $html = "<option value=''></option>";
            foreach ($arrRespuesta as $objCon) {
                foreach ($objCon as $key => $value){
                    if(is_string($value)){
                        $objCon->$key = utf8_encode($value);    
                    }                
                }
                $arrContactos[] = $objCon;
                $html .= '<option value="'.$objCon->ClaveContacto.'">'.$objCon->Nombre.' '.$objCon->Apellidos.'</option>';
            }
            echo json_encode($html);
        }
        else 
            echo json_encode(null);
        $con->cerrar();
    }

    elseif($opc=="obtener_laboratorio"){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "  SELECT * FROM UnidadNegocio";
        $con->ejecutaQuery($strQuery);
        $arrLaboratorios = array();
        if($con->getNum()>0){
            $arrRespuesta = $con->getListaObjectos();
            $html = "<option value=''></option>";
            foreach ($arrRespuesta as $objLab) {
                foreach ($objLab as $key => $value){
                    if(is_string($value)){
                        $objLab->$key = utf8_encode($value);    
                    }                
                }
                $arrLaboratorios[] = $objLab;
                $html .= '<option value="'.$objLab->idUnidadNegocio.'">'.$objLab->Laboratorio.'</option>';
            }
            echo json_encode($html);
        }
        else 
            echo json_encode(null);
        $con->cerrar();
    }

    elseif($opc == 'obtener_articulos'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT EquipId, EquipmentName, Mfr, Model FROM SetupEquipment";
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
    elseif($opc=="obtener_articulo"){
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
    elseif($opc=="obtener_laboratorio"){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "  SELECT * FROM UnidadNegocio";
        $con->ejecutaQuery($strQuery);
        $arrLaboratorios = array();
        if($con->getNum()>0){
            $arrRespuesta = $con->getListaObjectos();
            $html = "<option value=''></option>";
            foreach ($arrRespuesta as $objLab) {
                foreach ($objLab as $key => $value){
                    if(is_string($value)){
                        $objLab->$key = utf8_encode($value);    
                    }                
                }
                $arrLaboratorios[] = $objLab;
                $html .= '<option value="'.$objLab->idUnidadNegocio.'">'.$objLab->Laboratorio.'</option>';
            }
            echo json_encode($html);
        }
        else 
            echo json_encode(null);
        $con->cerrar();
    }
    
    elseif ($opc == 'registrar_equipamiento') {
        $obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO Equipamiento (ClaveContacto,idArticulo,MetasId,Serie,id,idUnidadNegocio,Notas,Puntos,Creo)
                         VALUES ('".$datos->ClaveContacto."', '".$datos->idArticulo."','".$datos->MetasId."','".$datos->Serie."','".$datos->id."','".$datos->Lab."','".$datos->Notas."','".$datos->Puntos."',".$_SESSION['iduser'].")";
        }
        // else{
        //     $strQuery = "UPDATE [RelacionaU-UN] SET 
        //     idUnidadNegocio = '".$datos->Laboratorio."'
        //     WHERE idUsuario = '".$datos->idUsuario."'";
        //  }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
    }
    elseif($opc == 'obtener_equipamiento'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT eq.idEquipamiento,e.RazonSocial,c.Nombre, c.Apellidos,eq.MetasId,ap.EquipmentName,ap.Mfr,ap.Model,eq.id,eq.Serie FROM Empresas e INNER JOIN Direcciones d ON e.ClaveEmpresa = d.ClaveEmpresa
        INNER JOIN Contactos c on c.IdDireccion =  d.IdDireccion
        INNER JOIN Equipamiento eq on c.ClaveContacto = eq.ClaveContacto
        INNER JOIN Articulos ap on eq.idArticulo =ap.EquipId";
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
    
    


	
	