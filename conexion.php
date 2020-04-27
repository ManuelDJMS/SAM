<?php
class Conexion 
{
  var $connectionInfo; //ALMACENA LA CADENA DE CONEXION
  var $res; // VARIABLE COMO R
  var $conn; //EJECUTA LA CONEXION
  var $dataBase; //NOMBRE DE LA BASE DE DATOS
  var $user; //uSUARIO DE LA BASE DE DATOS 
  var $password; //CONTRASEÑA DE LA BASE DE DATOS
  var $serverName; //NOMBRE DEL SERVIDOR
//   var $link;
  function conectar() 
  {
    //   
    $serverName = "IRONMAN2 ";
    $user = "sa";
    $password = "Met99011578a";
    $dataBase = "SAM";
    // ================== SE INICIALIZAN LAS VARIABLES PARA LA CONEXION ==============================================
    $this->serverName = $serverName;
    $this->user = $user;
    $this->password = $password;
    $this->dataBase = $dataBase;
    // ===============================================================================================================
    // ============================= SE CREA LA CADENA DE CONEXION ===================================================
    $this->connectionInfo = array("Database" => $this->dataBase, "UID" => $this->user, "PWD" => $this->password);
    // ===============================================================================================================
    // ============================= SE CONECTA A LA BASE DE DATOS ===================================================
    $this->conn = sqlsrv_connect($this->serverName, $this->connectionInfo);
    
    if ($this->conn) 
    {
        return $this->conn;
    } else {
        echo "Conexión no se pudo establecer.<br />";
        die(print_r(sqlsrv_errors(), true));
    }
  }
    // ===============================================================================================================
  //================================= METODO PARA HACER CONSULTAS ====================================================
  function ejecutaQuery($query, $conn = null) 
  {
      if ($this->conn == null) 
      {
          $this->conectar();
      }
      $this->res = sqlsrv_query($this->conn, $query, array(), array( "Scrollable" => 'static' ));
      if ($this->res === false) {
          die(print_r(sqlsrv_errors(), true));
      } else {
          return true;
      }
    
  }
// ===============================================================================================================
  //================================= METODO PARA HACER QUERYS (INSERT, UPDATE, ETC) ====================================================
  function ejecutaSQL($query, $params, $conn = null) 
  {
      if ($this->conn == null) 
      {
          $this->conectar();
      }
      $this->res = sqlsrv_query($this->conn, $query, $params);
      if ($this->res === false) {
          die(print_r(sqlsrv_errors(), true));
      } else {
          return true;
      }
    
  }
// ===============================================================================================================
  //================================= METODO PARA HACER QUERYS CON TRANSACCION (INSERT, UPDATE, ETC) ====================================================
  function ejecutaSQLTransac($query, $params, $conn = null) 
  {
      if ($this->conn == null) 
      {
          $this->conectar();
      }
      if ( sqlsrv_begin_transaction( $this->conn ) === false ) {
        die( print_r( sqlsrv_errors(), true ));
   }

      $this->res = sqlsrv_query($this->conn, $query, $params);
    //   if ($this->res === false) {
    //       die(print_r(sqlsrv_errors(), true));
    //   } else {
    //       return true;
    //   }
    if( $this->res ) {
        sqlsrv_commit( $this->conn );
        // echo "Transaccion consolidada.<br />";
        return true;
   } else {
        sqlsrv_rollback( $this->conn );
        die(print_r(sqlsrv_errors(), true));
   }
    
  }
// ===============================================================================================================
  function getListaObjetos(){
    
      $array = array();
      while ($obj = sqlsrv_fetch_object($this->res)) {
          $array[] = $obj;
      }
      return $array;
    
  }

  function getListaObjectos() {
      $array = array();
      while ($obj = sqlsrv_fetch_object($this->res)) {
          $array[] = $obj;
      }
      return $array;
    
  }
  
  function getListaAreglos(){
    
      $array = array();
      while ($arr = sqlsrv_fetch_array($this->res)){
          $array[] = $arr;
      }
      return $array;
    
  }

  function getObjeto() {
      return sqlsrv_fetch_object($this->res);
    
  }

  function getObjecto() {
    
      return sqlsrv_fetch_object($this->res);
    
  }
  
  function getArreglo(){
    
      return sqlsrv_fetch_array($this->res);
    
  }
  
  function cerrar(){
    
      return sqlsrv_close($this->conn);
    
  }
  
  function getNum(){
    
      return sqlsrv_num_rows($this->res);
    
  }

  function getId(){
    
      return sqlsrv_num_rows($this->res);
    
  }
}
?>