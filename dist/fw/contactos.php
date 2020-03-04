<?php
//  @session_start();
 error_reporting(E_ALL);
ini_set('display_errors', '0');
// 	include "config.php";
	require_once "classes/Conexion.php";

	 $opc = $_POST['opc'];
	if ($opc == '' || $opc == 'undefined' || $opc == null) {
	    echo json_encode(false);
	    die();
	}
	
	if($opc == 'obtener_numeros_empleado'){
		$strQuery = "SELECT DISTINCT 
						tP.vchEmpleado,
						tP.vchNombre
					FROM 
						Personal tP
					ORDER BY 
						tP.vchNombre";
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
	elseif ($opc == 'registrar_contacto') {
        $vchIdDireccion = "1";
		$vchNombre = $_POST["Nombre"];
		$vchApellidos = $_POST["Apellidos"];
		$vchCargo = $_POST["Cargo"];
		$vchCelular = $_POST["Celular"];
		$vchTel = $_POST["Tel"];
		$vchCExt = $_POST["CExt"];
        $vchCFax = $_POST["Fax"];
        $vchEmail = $_POST["Email"];
		$vchDescuento = $_POST["Descuento"];
		$vchCondiciones = $_POST["Condiciones"];
		$vchActivo = $_POST["Activo"];
		$strQuery = "INSERT INTO Contactos
				           (IdDireccion,Nombre,Apellidos,Cargo,Celular,Tel
				           ,Fax,Ext,Email,CondicionesClienteAdmon,Descuento,Activo,FechaCreacion,CreadoPor,FechaModificacion,ModificadoPor)
				     VALUES
				           ('".$vchRazonSocial."','".$vchRFC."','".$vchCredito."','".$vchObservaciones."','".$vchCVentas."','".$vchCCursos."'
				           ,'".$vchCGestoria."')";
		$con = new Conexion();
	    $con->ejecutaQuery($strQuery);
	    $arrRespuesta = array();
		$arrRespuesta = array("respuesta" => 'ok');
	
	    $con->cerrar();
	    echo json_encode($arrRespuesta);
	}
	elseif($opc == 'obtener_registros'){
        $con = new Conexion();
        $con->conectar();
        $strQuery = "SELECT *FROM Contactos";
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