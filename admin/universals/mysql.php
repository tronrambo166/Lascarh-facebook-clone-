<?php 



Class Database{
 public $host   = 'localhost';
 public $user   = 'root';
 public $pass   = 'kane1111';
 public $dbname = 'social_media';
 
 
 public $connect;
 public $error;
 
public function __construct (){
 $this->connect = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
 
 if($this->connect){ }
     else 
 {
   $this->error ="Connection fail".$this->connect->connect_error;
  return false;
 }
 }
 
 
 
 
 ////real escape
 
 public function escape($variable){
  $result=$this->connect->real_escape_string($variable) or die($this->connect->error.__LINE__);
  if($result==true) return $result;
  
  else return false;
 }
 
 
 
// Select or Read data
public function select($query){
  $result=$this->connect->query($query) or die($this->connect->error.__LINE__);
  if($result==true) return $result;
  
  else return false;
 }
 
 
// Insert data
public function insert($query){
 $result=$this->connect->query($query) or die($this->connect->error.__LINE__);
  if($result==true) return $result;
  
  else return false;
 }
  
  
// Update data
 public function update($query){
 $result=$this->connect->query($query) or die($this->connect->error.__LINE__);
  if($result==true) return $result;
  
  else return false;
 }
  
  
// Delete data
 public function delete($query){
$result=$this->connect->query($query) or die($this->connect->error.__LINE__);
  if($result==true) return $result;
  
  else return false;
 }
 
 
}

$db=new Database();



?>