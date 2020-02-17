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
    $serverName = "10.10.10.254\COMPAC2";
    $user = "sa";
    $password = "Met99011578a";
    $dataBase = "SAM";

    $this->serverName = $serverName;
    $this->user = $user;
    $this->password = $password;
    $this->dataBase = $dataBase;
    $this->connectionInfo = array("Database" => $this->dataBase, "UID" => $this->user, "PWD" => $this->password);
    $this->conn = sqlsrv_connect($this->serverName, $this->connectionInfo);

    if ($this->conn) {
        return $this->conn;
    } else {
        echo "Conexión no se pudo establecer.<br />";
        die(print_r(sqlsrv_errors(), true));
    }
  }

//   function SqlExec($query,$conn=null){
//       if ($this->conn == null) {
//           $this->conectar();
//       }
//       $this->res = sqlsrv_query($conn, $query, array(), array( "Scrollable" => 'static' ));
//       if ($this->res === false) {
//           die(print_r(sqlsrv_errors(), true));
//       } else {
//           return true;
//       }
//   }
  
  function ejecutaQuery($query, $conn = null) {
      if ($this->conn == null) {
          $this->conectar();
      }
      $this->res = sqlsrv_query($this->conn, $query, array(), array( "Scrollable" => 'static' ));
      if ($this->res === false) {
          die(print_r(sqlsrv_errors(), true));
      } else {
          return true;
      }
    
  }

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