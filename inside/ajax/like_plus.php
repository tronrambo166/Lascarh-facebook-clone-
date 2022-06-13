<?php   
session_start();
include "../../admin/universals/sessions.php";
include "../../admin/universals/class.php";


 if(isset($_GET['like_id'])) { $like_id=$_GET['like_id']; $_SESSION['like_id']=$_GET['like_id']; 

$sel="select * from posts where post_id='$like_id' ";  $row=$db->select($sel)->fetch_assoc(); $like=$row['likes']+1;
	 $up="update posts set likes='$like' where post_id='$like_id' ";  $run=$db->update($up); 

header('location:../home.php#open-here'.$like_id);
	 }
	

	 
	  if(isset($_GET['unlike_id'])) { $unlike_id=$_GET['unlike_id']; $_SESSION['unlike_id']=$_GET['unlike_id']; 

$sel="select * from posts where post_id='$unlike_id' ";  $row=$db->select($sel)->fetch_assoc(); $like=$row['likes']-1;
	 $up="update posts set likes='$like' where post_id='$unlike_id' ";  $run=$db->update($up); 
 
	
	header('location:../home.php#open-here'.$unlike_id);
	
	  }	
?>