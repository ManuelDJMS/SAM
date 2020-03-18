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
            $strQuery = "INSERT INTO Contactos (Nombre,Apellidos, Cargo, Celular, Telefono, Fax, Ext, Email, Condiciones, )
                         VALUES (".$_SESSION['iduser'].",'".$datos->RazonSocial.", ".$datos->Tipo."','".$datos->RFC."','".$datos->Credito."','".$datos->Observaciones."','".$datos->CVentas."','".$datos->CCursos."'
							 		           ,'".$datos->CGestoria."')";
        }
        else{
            $strQuery = "UPDATE EmpresasOrdenadas SET 
            RazonSocial = '".$datos->RazonSocial.", ".$datos->Tipo."',
            FechaModificacion = getdate(),
            RFC = '".$datos->RFC."',
            Credito = '".$datos->Credito."',
            ObservacionesEmpresa = '".$datos->Observaciones."',
            Ventas = '".$datos->CVentas."',
            Cursos = '".$datos->CCursos."',
            Gestoria = '".$datos->CGestoria."'
         WHERE ClaveEmpresa = '".$datos->ClaveEmpresa."'";
         }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}
	
	elseif($opc == 'obtener_registros'){
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