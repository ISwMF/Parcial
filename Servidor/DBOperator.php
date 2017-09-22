<?php
class DBOperator{
	private $host;
	private $dbName;
	private $userName;
	private $password;
  private $mysqliObj;
  private $charset;

	function __construct($host, $userName, $dbName, $password, $charset){
		$this->host=$host;
		$this->dbName=$dbName;
		$this->userName=$userName;
		$this->password=$password;

    $this->mysqliObj=new mysqli($this->host, $this->userName, $this->password, $this->dbName);
    $this->charset=$charset;
    $this->mysqliObj->query("SET NAMES '".$this->charset."'");
	}

	function setHost($host=""){
		$this->host=$host;
	}
	function setDbName($dbName=""){
		$this->dbName=$dbName;
	}
	function setUserName($userName=""){
		$this->userName=$userName;
	}
	function setPassword($password=""){
		$this->password=$password;
	}
        function setCharset($charset=""){
		$this->charset=$charset;
	}

	function getHost(){
		return $this->host;
	}
	function getDbName(){
		return $this->dbName;
	}
	function getUserName(){
		return $this->userName;
	}
	function getPassword(){
		return $this->password;
	}
        function getCharset(){
		return $this->charset;
	}

	function consult($mySqlOrder, $capture){
    $consult=$this->mysqliObj->query($mySqlOrder);
    if ($capture=="yes"){
      $rowValues=Array();
      while ($linea = mysqli_fetch_array($consult,MYSQLI_ASSOC)) {
        foreach ($linea as $valor_col) {
          $rowValues[]=$valor_col;
        }
      }
      $this->mysqliObj=new mysqli($this->host, $this->userName, $this->password, $this->dbName);
      $this->mysqliObj->query("SET NAMES '".$this->charset."'");
      return $rowValues;
    }
	}
  function close(){
    $this->mysqliObj->close();
  }
}
