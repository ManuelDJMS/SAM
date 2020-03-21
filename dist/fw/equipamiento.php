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
	elseif ($opc == 'guardar_empresa') {
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            if($datos->Tipo=='' or $datos->Tipo==''){
                $razon=$datos->RazonSocial;
            }
            else{
                $razon=$datos->RazonSocial.", ".$datos->Tipo;
            }
            $strQuery = "if exists(select RazonSocial, RFC from EmpresasOrdenadas where RazonSocial='".$razon."' or RFC='".$datos->RFC."') begin INSERT INTO EmpresasOrdenadas 
            (idEquipamiento, idArticulo,, 
            CvaEmpresaAccess) VALUES (1,355,'error','error','error','error','error','error','error','error','error');
            end else begin INSERT INTO EmpresasOrdenadas (idUsuario,idPaqueteria,RazonSocial,RFC,Credito,CuentaMensajeria, Descuento, NumProvMetas, AdminPaq, ObservacionesEmpresa, 
            CvaEmpresaAccess) VALUES (".$_SESSION['iduser'].",".$datos->Paqueteria.",'".$razon."','".$datos->RFC."','".$datos->Credito."',
            '".$datos->CuentaMensajeria."',".$datos->Descuento.",'".$datos->NoProveedor."','".$datos->AdminPaq."','".$datos->Observaciones."',".$datos->Access."); end;";
            // $strQuery="if exists(select RazonSocial, RFC from EmpresasOrdenadas where RazonSocial='A' or RFC='A') begin RETURN;
            // end else begin INSERT INTO EmpresasOrdenadas (idUsuario,idPaqueteria,RazonSocial,RFC,Credito,CuentaMensajeria, Descuento, NumProvMetas, AdminPaq, ObservacionesEmpresa, CvaEmpresaAccess)
            //              VALUES (1,1,'B','B','C','C',0,'JSGG','H','OBS',0); end;";
        }
        else{
            $strQuery = "UPDATE EmpresasOrdenadas SET 
            RazonSocial = '".$datos->RazonSocial.", ".$datos->Tipo."',
            FechaModificacion = getdate(),
            RFC = '".$datos->RFC."',
            Credito = '".$datos->Credito."',
            CuentaMensajeria = '".$datos->CuentaMensajeria."',
            Descuento = '".$datos->Descuento."',
            NumProvMetas = '".$datos->NoProveedor."',
            AdminPaq = '".$datos->AdminPaq."',
            ObservacionesEmpresa = '".$datos->Observaciones."'
         WHERE ClaveEmpresa = '".$datos->ClaveEmpresa."'";
         }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}
	elseif ($opc == 'obtener_paqueterias'){
		$strQuery = "SELECT DISTINCT 
						idPaqueteria,
						Descripcion
					FROM 
						Paqueterias
					ORDER BY 
						idPaqueteria";
		$con = new Conexion();
	    $con->ejecutaQuery($strQuery);
	    $arrDocumentos = array();
	    //$arrDocumentos = $con->getListaObjectos();
	    $arrRespuesta = $con->getListaObjectos();
        foreach ($arrRespuesta as $objRespuesta){
            foreach ($objRespuesta as $key => $value){
                if(is_string($value)){
                    $objRespuesta->$key = utf8_encode($value);    
                }                
            }
            $arrDocumentos[] = $objRespuesta;
        }
	    $con->cerrar();
	    echo json_encode($arrDocumentos);
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