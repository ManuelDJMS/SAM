<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
	require_once "classes/Conexion.php";
    $opc = $_POST['opc'];
    if ($opc == '' || $opc == 'undefined' || $opc == null) 
    {
	    echo json_encode(false);
	    die();
    }
    // ======================== (METODO OBTENER CONTACTOS) OBTENCION DE CONTACTOS DE INFORMACION GENERAL =======================
	elseif($opc = 1){
        $con = new Conexion();
        $con->conectarAccess("InformacionGeneral");
        $strQuery = "SELECT top 10 MetAsInf.Clavempresa, MetAsInf.Compania, RFC, DomicilioConsig, CONCAT(Nombre, ' ', Apellidos) AS Nombre, Email, Tel
                     FROM MetAsInf INNER JOIN [Contactos-Clientes-Usuarios] Contactos ON MetAsInf.Clavempresa=Contactos.Clavempresa";
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
    //=====================================================================================================================================
    //========================================= (METODO OBTENER COTS) OBTENCION DE CONTACTOS DE INFORMACION GENERAL =======================
	elseif($opc = 2){
        $anio=$_POST['anio'];
        $id=$_POST['id'];
        $con = new Conexion();
        $con->conectarAccess("[METASINF-2018]");
        $strQuery = "SELECT EntradaRegistroCot.Numcot, EntradaRegistroCot.Cliente, PartidaNo AS Fecha, Marca, Modelo, ID FROM 
        EntradaRegistroCot INNER JOIN [1Cotizar] ON EntradaRegistroCot.NumCot=[1Cotizar].NumCot where 
        EntradaRegistroCot.CveEmpresa=2";
        // $strQuery = "SELECT EntradaRegistroCot.Numcot, EntradaRegistroCot.Cliente, EntradaRegistroCot.Fecha, Marca, Modelo, ID FROM 
        //             EntradaRegistroCot INNER JOIN [1Cotizar] ON EntradaRegistroCot.NumCot=[1Cotizar].NumCot where 
        //             EntradaRegistroCot.CveEmpresa=$id";
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
    //=====================================================================================================================================