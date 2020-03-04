<?php
//  @session_start();
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
	elseif ($opc == 'guardar_empresa') {
		// $vchRazonSocial = $_POST["RazonSocial"];
		// $vchRFC = $_POST["RFC"];
		// $vchCredito = $_POST["Credito"];
		// $vchObservaciones = $_POST["Observaciones"];
		// $vchCVentas = $_POST["CVentas"];
		// $vchCCursos = $_POST["CCursos"];
		// $vchCGestoria = $_POST["CGestoria"];
		// $strQuery = "INSERT INTO EmpresasOrdenadas
		// 		           (RazonSocial,RFC,Credito,ObservacionesEmpresa,Ventas,Cursos
		// 		           ,Gestoria)
		// 		     VALUES
		// 		           ('".$vchRazonSocial."','".$vchRFC."','".$vchCredito."','".$vchObservaciones."','".$vchCVentas."','".$vchCCursos."'
		// 		           ,'".$vchCGestoria."')";
		// $con = new Conexion();
	    // $con->ejecutaQuery($strQuery);
	    // $arrRespuesta = array();
		// $arrRespuesta = array("respuesta" => 'ok');
	
	    // $con->cerrar();
		// echo json_encode($arrRespuesta);
		$obj = $_POST['obj'];
        $datos = json_decode($obj); 
        foreach ($datos as $key => $value)$datos->$key = utf8_decode($value);
        $con = new Conexion();
        $con->conectar();
        if($datos->accion == 'nuevo'){
            $strQuery = "INSERT INTO EmpresasOrdenadas (RazonSocial,RFC,Credito,ObservacionesEmpresa,Ventas,Cursos,Gestoria)
                         VALUES ('".$datos->RazonSocial."','".$datos->RFC."','".$datos->Credito."','".$datos->Observaciones."','".$datos->CVentas."','".$datos->CCursos."'
							 		           ,'".$datos->CGestoria."')";
        }
        else{
            $strQuery = "UPDATE Magnitudes SET 
                            vchCodigo = '".$datos->vchCodigo."',
                            vchDescripcion = '".$datos->vchDescripcion."'
                         WHERE id = '".$datos->iIdMagnitud."'";
        }

        $res = $con->ejecutaQuery($strQuery);
        $con->cerrar();
        echo json_encode($res);
	}
	// elseif ($opc == 'registrar_empresa') {
	// 	$vchRazonSocial = "Empresa";
	// 	$vchRFC = "RFFC";
	// 	$vchCredito = "Credito";
	// 	$vchObservaciones = "dsasad";
	// 	$vchCVentas = 1;
	// 	$vchCCursos = 1;
	// 	$vchCGestoria = 1;
	// 	$strQuery = "INSERT INTO EmpresasOrdenadas
	// 			           (RazonSocial,RFC,Credito,ObservacionesEmpresa,Ventas,Cursos
	// 			           ,Gestoria)
	// 			     VALUES
	// 			           ('".$vchRazonSocial."','".$vchRFC."','".$vchCredito."','".$vchObservaciones."','".$vchCVentas."','".$vchCCursos."'
	// 			           ,'".$vchCGestoria."')";
	// 	$con = new Conexion();
	//     $con->ejecutaQuery($strQuery);
	//     $arrRespuesta = array();
	//     $arrRespuesta = array("respuesta" => 'ok');
	//     $con->cerrar();
	//     echo json_encode($arrRespuesta);
	// }
	// elseif($opc == 'obtener_usuarios'){
	// 	$strQuery = "SELECT DISTINCT
	// 					tU.vchEmpleado,
	// 					tU.vchPerfil,
	// 					tP.vchNombre,
	// 					tU.vchFoto,
	// 					tU.id
	// 				FROM 
	// 					Usuarios tU
	// 					INNER JOIN 
	// 					Personal tP
	// 					ON tU.vchEmpleado = tP.vchEmpleado
	// 				ORDER BY tP.vchNombre";
	// 	$con = new Conexion();
	//     $con->ejecutaQuery($strQuery);
	//     $arrDocumentos = array();
	//     $arrDocumentos = $con->getListaObjectos();
	//     $con->cerrar();
	//     echo json_encode($arrDocumentos);
	// }
	// elseif($opc == 'elimina_usuario'){
	// 	$id_registro = $_POST["id_registro"];
	//     $strQuery = "SELECT * FROM Usuarios WHERE id = ".$id_registro;
	//     $con = new Conexion();
	//     $con->ejecutaQuery($strQuery);
	//     $objDocumento = $con->getObjeto();
	//     $arrRespuesta = array();
	//     if(trim($id_registro) != ""){
	//         $strQueryDelete = "DELETE FROM Usuarios WHERE id = ".$id_registro;
	//         $con->ejecutaQuery($strQueryDelete);
	//         $strQuery = "SELECT * FROM Usuarios WHERE id = ".$id_registro;
	//         $con->ejecutaQuery($strQuery);
	//         if($con->getNum() > 0)
	//         {
	//             $arrRespuesta = array("resultado" => 'false');
	//             echo json_encode($arrRespuesta);
	//         }
	//         else
	//         {
	//             $path = $upload_folder."/fotos/".$objDocumento->vchFoto;
	//             if(is_file($path)){
	//                 unlink($path);    
	//             }
	//             $arrRespuesta = array("resultado" => 'true');
	//             echo json_encode($arrRespuesta);
	//         }
	//     }
	//     else{
	//         $arrRespuesta = array("resultado" => 'false');
	//         echo json_encode($arrRespuesta);
	//     }
	//     $con->cerrar();
	// }
	// elseif($opc == 'actualiza_foto'){
	// 	$vchFoto = $_POST["vchFoto"];
	// 	$id = $_POST["id"];
	// 	if(trim($id) != ""){
	// 		$con = new Conexion();
	// 		$strQuery = "SELECT * FROM Usuarios WHERE id = ".$id;
	//         $con->ejecutaQuery($strQuery);
	//         $path = $upload_folder."/fotos/".$objDocumento->vchFoto;
	//         if(is_file($path)){
    //             unlink($path);    
    //         }
	// 		$strQueryUpdate = "UPDATE Usuarios SET vchFoto = '".trim($vchFoto)."' WHERE id = ".trim($id);
	//     	$con->ejecutaQuery($strQueryUpdate);
	// 	    $con->cerrar();
	// 	    $arrRespuesta = array("resultado" => 'true');
	//         echo json_encode($arrRespuesta);
	// 	}
	// }
	elseif($opc == 'obtener_registros'){
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