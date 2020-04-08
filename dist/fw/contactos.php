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
	elseif ($opc == 'guardar_contacto') {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO ContactosAcomodados (idUsuario,ClaveEmpresa, Nombre,Apellidos, Cargo, Celular, Tel, Fax, Ext, Email, CondicionesClienteAdmon)
                        VALUES (".$_SESSION['iduser'].",".$datos->ClaveEmpresa.",'".$datos->Nombre."','".$datos->Apellidos."','".$datos->Cargo."','".$datos->Celular."','".$datos->Telefono."','".$datos->Fax."','".$datos->Ext."'
                        ,'".$datos->Email."','".$datos->Condiciones."')";
        }
        else{
            $strQuery = "UPDATE ContactosAcomodados SET 
            FechaModificacion = getdate(),
            ClaveEmpresa = '".$datos->ClaveEmpresa."',
            Nombre = '".$datos->Nombre."',
            Apellidos = '".$datos->Apellidos."',
            Cargo = '".$datos->Cargo."',
            Celular = '".$datos->Celular."',
            Tel = '".$datos->Telefono."',
            Ext = '".$datos->Ext."',
            Email = '".$datos->Email."',
            CondicionesClienteAdmon = '".$datos->Condiciones."'
            WHERE ClaveContacto = '".$datos->ClaveContacto."'";
        }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}
	
	elseif($opc == 'obtener_contactos'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT ClaveContacto, Nombre, Apellidos, Email, Celular, Tel, Ext, RazonSocial, RFC, Credito
         FROM ContactosAcomodados INNER JOIN EmpresasOrdenadas ON ContactosAcomodados.ClaveEmpresa=EmpresasOrdenadas.ClaveEmpresa";
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
	elseif($opc == 'obtener_empresas'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM EmpresasOrdenadas";
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
        $strQuery = "SELECT ClaveContacto, ContactosAcomodados.ClaveEmpresa, RazonSocial, Nombre, Apellidos, Cargo, Celular, Tel, Ext, Fax, Email, CondicionesClienteAdmon 
                        FROM ContactosAcomodados INNER JOIN EmpresasOrdenadas ON ContactosAcomodados.ClaveEmpresa=EmpresasOrdenadas.ClaveEmpresa WHERE ClaveContacto = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }
	elseif($opc=="obtener_empresa"){
        $id = $_POST['id'];
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT * FROM EmpresasOrdenadas WHERE ClaveEmpresa = $id";
        $con->ejecutaQuery($strQuery);
        $obj = $con->getObjeto();
        foreach ($obj as $key => $value) {
            if(is_string($value)){
                $obj->$key = utf8_encode($value);    
            }
        }
        echo json_encode($obj);
    }
?>