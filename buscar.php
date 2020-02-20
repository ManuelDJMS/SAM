<?php
	//=============== SE INCLUYE LA CONEXION Y SE CREA EL OBJETO =====================
	include_once("conexion.php");
	include_once("validates.php");
	$conexion=new Conexion();
	$conexion->Conectar();
	// ==============================================================================
	$salida = "";
	$query = "SELECT ClaveEmpresa, RazonSocial, RFC, Credito FROM EmpresasOrdenadas WHERE RazonSocial NOT LIKE '' ORDER By ClaveEmpresa";
	//========================= SE VERIFICA SI SE MANDARON VARIABLES A BUSCAR ===============================
	if (isset($_POST['cvempresa']) and isset($_POST['razon']) and isset($_POST['rfc'])) 
	{
		$q0 = ($_POST['cvempresa']);
		$q1 = ($_POST['razon']);
		$q2=($_POST['rfc']);
     	$query = "SELECT ClaveEmpresa, RazonSocial, RFC, Credito FROM EmpresasOrdenadas WHERE ClaveEmpresa LIKE '".$q0."%' AND RazonSocial LIKE '".$q1."%' AND RFC LIKE '".$q2."%'";
	}
	//======================== SI NO ENCUENTRA LAS VARIABLES SE MANDA LA CADENA SIN LIKE =======================
	$resultado = $conexion->ejecutaQuery($query);
	//======================== SE VERIFICA SI HAY REGISTROS CON LA CONSULTA CREADA ===================================================
	if ($conexion->getNum()>0) 
	{
		//================= SE CREA EL ENCABEZADO DE LA TABLA =========================
		$salida.="<table class='mb-0 table table-striped tabla_datos'>
			<thead>
			<tr>
			<th>Clave de Empresa</th>
			<th>Razón Social</th>
			<th>RFC</th>
			<th>Crédito</th>
			</tr>
			</thead>
			<tbody>";
		//=============================================================================
		//=================================SE CREA UN CICLO DEPENDIENDO DE LOS REGISTROS TRAIDOS DE LA ============================================
		while ($fila = $conexion->getArreglo()) 
		{
			$salida.="<tr>
					<td>
					<form action='empresas.php' method='post'>\n
					<input type='hidden' name='action' value='".$fila[0]."'></input>
					<button type='submit' class='mb-2 mr-2 btn-icon btn-square btn btn-link'><i class='lnr-pencil btn-icon-wrapper'> ".$fila[0]."</i></button>
					</form>
					</td>
					<td>".utf8_encode($fila[1])."</td>
					<td>".$fila[2]."</td>
					<td>".utf8_encode($fila[3])."</td>
					</tr>";
		}
		$salida.="</tbody></table>";
	}
	else
	{
		$salida.="NO HAY EMPRESAS :(";
	}
	echo $salida;
	
	$conexion->cerrar();
?>