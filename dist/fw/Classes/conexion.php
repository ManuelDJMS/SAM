<?php
class Conexion {
    var $objMysql;
    var $connectionInfo;
    var $res;
    var $conn;
    var $dataBase;
    var $user;
    var $password;
    var $serverName;
    var $link;
    var $motor = "mssql";
  
    function conectar() {
      if($this->motor == "mysql"){
        $this->objMysql = new mysqli("localhost", 'usuario', 'contraseña', 'nombre_bd');      
        if (mysqli_connect_errno()) {
            die("Falló la conexión: ".mysqli_connect_error());
        }else{
          return $this->objMysql;
        }
      }
      else{
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
    }

    function SqlExec($query,$conn=null){
      if($this->motor == "mysql"){
        if ($this->objMysql == null) {
            $this->conectar();
        }
        $this->res = mysqli_query($this->objMysql, $query);
        if ($this->res === false) {
            return false;
        } else {
            return $this->res;
        }
      }
      else{
        if ($this->conn == null) {
            $this->conectar();
        }
        $this->res = sqlsrv_query($conn, $query, array(), array( "Scrollable" => 'static' ));
        if ($this->res === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            return true;
        }
      }
    }
    
    function ejecutaQuery($query, $conn = null) {
      if($this->motor == "mysql"){
        if ($this->objMysql == null) {
            $this->conectar();
        }
        $this->res = mysqli_query($this->objMysql, $query);
        if ($this->res === false) {
            return false;
        } else {
            return $this->res;
        }
      }
      else{
        if ($this->conn == null) {
            $this->conectar();
        }
        $this->res = sqlsrv_query($this->conn, $query, array(), array( "Scrollable" => 'static' ));
        if ($this->res === false) {
            // die(print_r(sqlsrv_errors(), true));
            return false;
        } else {
            return true;
        }
      }
    }

    function getListaObjetos(){
      if($this->motor == "mysql"){
        $array = array();
        while ($obj = mysqli_fetch_object($this->res)) {
            $array[] = $obj;
        }
        return $array;
        mysqli_free_result($this->res);
      }
      else{
        $array = array();
        while ($obj = sqlsrv_fetch_object($this->res)) {
            $array[] = $obj;
        }
        return $array;
      }
    }

    function getListaObjectos() {
      if($this->motor == "mysql"){
        $array = array();
        while ($obj = mysqli_fetch_object($this->res)) {
            $array[] = $obj;
        }
        return $array;
        mysqli_free_result($this->res);
      }
      else{
        $array = array();
        while ($obj = sqlsrv_fetch_object($this->res)) {
            $array[] = $obj;
        }
        return $array;
      }
    }
    
    function getListaAreglos(){
      if($this->motor == "mysql"){
        $array = array();
        while ($arr = mysqli_fetch_array($this->res, MYSQLI_BOTH)){
            $array[] = $arr;
        }
        return $array;
      }
      else{
        $array = array();
        while ($arr = sqlsrv_fetch_array($this->res)){
            $array[] = $arr;
        }
        return $array;
      }
    }

    function getObjeto() {
      if($this->motor == "mysql"){
        return mysqli_fetch_object($this->res);
      }
      else{
        return sqlsrv_fetch_object($this->res);
      }
    }

    function getObjecto() {
      if($this->motor == "mysql"){
        return mysqli_fetch_object($this->res);
      }
      else{
        return sqlsrv_fetch_object($this->res);
      }
    }
    
    function getArreglo(){
      if($this->motor == "mysql"){
        return  mysqli_fetch_array($this->res, MYSQLI_BOTH);
      }
      else{
        return sqlsrv_fetch_array($this->res);
      }
    }
    
    function cerrar(){
      if($this->motor == "mysql"){
        @mysqli_close($this->objMysql);
      }
      else{
        return sqlsrv_close($this->conn);
      }
    }
    
    function getNum(){
      if($this->motor == "mysql"){
        return mysqli_num_rows($this->res);
      }
      else{
        return sqlsrv_num_rows($this->res);
      }
    }


    function getId(){
      if($this->motor == "mysql"){
        return mysqli_insert_id();
      }
      else{
        return sqlsrv_num_rows($this->res);
      }
    }
}