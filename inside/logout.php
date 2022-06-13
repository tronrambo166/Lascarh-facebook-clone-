<?php   
include "../admin/universals/sessions.php";
include "../admin/universals/class.php";

session_start(); $id=session_id();
session_destroy();
setcookie('user_login','logged',time()-(86400*30),'/');
				setcookie('user_name',$row['Name'],time()-(86400*30),'/');
				setcookie('user_id',$row['ID'],time()-(86400*30),'/');
				
	
	
	 
	session_start();
	$_SESSION['logout']="logged out!";
    header('location:../index.php');



?>