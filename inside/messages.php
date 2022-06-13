<!DOCTYPE html>
<?php
session_start();
include "../admin/universals/sessions.php";
include "../admin/universals/class.php";

if(!isset($_SESSION['user_login']) && !isset($_COOKIE['user_login']) ){
	header("location: login.php");
}


include "like_comment_share.php";

$u_id = $_COOKIE['user_id'];


	//-----------------------------------------------
	
		$user_id = $_COOKIE['user_id'];
		$get_user = "select * from users where ID='$user_id'";
		$run = $db->select($get_user);
		$row =$run->fetch_assoc();

		$user_name = $row['Fname'].' '.$row['Lname'];
		list($date)= explode(' ', $row['date']);
		
		$date=date_create($date);
		 $date = date_format($date,'M, Y');
	

	//-----------------------------------------------
		
		
		 $mes="select * from messages where messages.to_id='$u_id' "; $all_msg=$db->select($mes)->num_rows;
			
	
	if(isset($_GET['msg_no'])){
		
		
		 setcookie('old_msg'.$user_id, $_GET['msg_no'], time()+(86400)*30,'/');
		
	
	   $_SESSION['new_msg']= $all_msg-$_GET['msg_no'];
} 

else    {  $_SESSION['new_msg']= $all_msg-$_COOKIE['old_msg'.$user_id]; }

	
			
	?>









<html>
<head>
	
 <link rel="shortcut icon" href="lascarh.ico" />
	<title>Lascarh</title>
		<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


	<link rel="stylesheet" type="text/css" href="home_style2.css">
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	
 
		<style type="text/css"> .drop li:hover{ background:darkgrey;}</style>
	
	
	
	
</head>


<body>



<?php

?>

<div class="container-fliud">
	<div class="row top">
	
<div class="col-sm-3 pt-2 text-center"><a class="  text-dark p-2 font-italic " href="home.php" style="  "></a>
	<img width="80px" height="42px" class="rounded mb-2" src="../images/lascarh.jpg" alt="" />
	
	</div>		
	
		<div class="col-sm-5">
		
		
		<div class="navbar navbar-expand-sm p-0 w-100 navy menus ">
				<ul class="navbar-nav ">
					<li class="nav-item py-1 px-3   "><a href="profile.php" class="text-secondary nav-link">
			<img class="rounded-circle mr-2" width="28px" height="26px" src="u_images/<?php echo $row['Photo']; ?>" alt="" /><?php echo $row['Fname']; ?></a></li>
					
					<li class="nav-item py-1 px-3  "><a href="home.php" class="text-secondary nav-link">Home</a></li>
					<li class="nav-item py-1 px-3  "><a href="find.php" class="text-secondary nav-link">Find People</a></li>
					<li class="nav-item py-1 px-3 "><a href="messages.php?msg_no=<?php echo $all_msg; ?>" class="text-secondary nav-link">Messages
					
		<?php	if(isset($_SESSION['new_msg'])) { if($_SESSION['new_msg']>0) {	?>
		<span class="msg_no text-white px-1"><?php echo $_SESSION['new_msg']; ?></span> <?php } else { ?>  <span class="px-1 text-white px-1"> </span>  <?php } } ?>
					
					</a></li>
				
			


					

						<li class='dropdown nav-item py-1 px-3 mt-2'>
							<a href='#' class='dropdown-toggle bg-dark pr-1' data-toggle='dropdown' role='button' ><span></span></a>
							<ul class='dropdown-menu drop mt-2 py-0' style="margin-left: -50px">
					<li class="nav-item py-0 px-3   "><a href="profile.php" class="text-secondary nav-link">My Posts</a></li>
					<li class="nav-item py-0 px-3 "><a href="account.php" class="text-secondary nav-link">Edit Accounts</a></li>
					<li class="nav-item py-0 px-3 "><a href="logout.php" class="text-secondary nav-link">Logout</a></li>
				
							</ul>
						</li>
					
				</ul>
			</div>
		
		
		</div>
		
		
		<div class="col-sm-4">
		
		
			
					<form class="navbar-form navbar-left" method="get" action="find.php">
						<div class="mb-2 mt-2">
							<input type="text" class="form-control  w-50 d-inline" name="user_search" placeholder="Search">
						
						<button type="submit" class="mb-1 btn py-1 btn-info d-inline" name="search">Search</button>
						</div>
						
					</form>
				
		
		</div>
	</div>


<div class="row text-center bg-primary mb-5 py-2 font-weight-bold "><h3 class="m-auto">Messages</h3></div>



<?php 		$sel2="select messages.*, users.* from messages, users where (messages.to_id='$user_id' AND messages.from_id=users.ID) ORDER BY messages.message_id DESC "; 
 $run2=$db->select($sel2);
 while($messages=$run2->fetch_assoc() ) {   ?>
		


<div class="row w-50 mx-auto post_top my-5 shadow" id="<?php  ?>">
           

<div class="  col-sm-12 "> 
<img class="rounded mr-2 d-inline" width="45px" height="45px" src="u_images/<?php echo $messages['Photo']; ?>" alt="" />	

<a href="sent_messages.php?to_id=<?php echo $messages['from_id']; ?>" 
class="text-dark  profile_link"><h4 class=" d-inline "><?php echo $messages['Fname'].' '.$messages['Lname']; ?>  </h4>  </a>


	</div>
	
	
	
	<div class="col-sm-12 pb-3">
	
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-7">
		
		
		<p class="bg-light shadow rounded p-2">  <?php echo $messages['message']; ?> </p>
		
		
		</div>
		
		<div class="col-sm-2 pl-0"> 
		
		<?php  list($date)= explode(' ', $messages['time']);  $time= explode(' ', $messages['time']);  
        $time=end($time); list($hr)=explode(':', $time);   $time=date_create($time); $time = date_format($time,'h:i'); 
		$date=date_create($date); $date = date_format($date,'M d');   if($hr<12) $hr='am'; else $hr='pm';     
         ?>
		 
		 <p class="msg_time" style="font-size:12px"><?php echo $date.', '.$time.$hr; ?> </p>
		 </div>
		
	</div>
	
	</div>
	   </div>
	  
	  
 <?php } ?>
	
	
	

        

		   
	
	
	

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	</body>
</html>
	
	