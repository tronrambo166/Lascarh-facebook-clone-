<?php 

class Session{
 public static function init(){
            session_start();
        }



 public static function show($key){
  if (isset($_SESSION[$key])) {
   echo $_SESSION[$key]; $_SESSION[$key]="";
  } else {
   return false;
  }
 }
 
 
 public static function remain($key){
  if (isset($_SESSION[$key])) {
   echo $_SESSION[$key];
  } else {
   return false;
  }
 }



 public static function destroy(){
  session_destroy();
  header("Location:login.php");
 }
 
 
 
}



?>