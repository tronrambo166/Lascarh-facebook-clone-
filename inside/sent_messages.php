<!DOCTYPE html>
<?php
session_start();
include "../admin/universals/sessions.php";
include "../admin/universals/class.php";

if(!isset($_SESSION['user_login']) && !isset($_COOKIE['user_login']) ){
	header("location: login.php");
}


include "like_comment_share.php";

	
	

	
	if(isset($_GET['to_id'])) $to_id=$_GET['to_id'];
	
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
	



   

			
		
		
		 // Sent Messages
		
		if(isset($_POST['message_sent'])){

				$from_id = $user_id;  
				$to_id = $_GET['to_id'];  
				$message = $_POST['message'];  
				$message=$db->escape($message);
	
				
					$in="insert into messages(from_id,to_id,message) values('$from_id','$to_id','$message')";
					$run = $db->insert($in);

					if($run){
					
					 header('location:sent_messages.php?to_id='.$to_id ) ; exit();
					}
				}

			
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
	
 
		<style type="text/css"> 
		.drop li:hover{ background:darkgrey;}
		#scroll_msg {max-height:450px; overflow:scroll;}
		
		
		</style>
	
	
	
	
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
					<li class="nav-item py-1 px-3 "><a href="messages.php" class="text-secondary nav-link">Messages
					
					
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

	
	
	
	<h3 class="font-italic bg-light border py-2  text-center">Recent Conversations</h3>
	
	

<div id="scroll_msg" >
	
<?php  $select="select * from messages"; $result=$db->select($select);


while( $row_msg=$result->fetch_assoc() ) { /// main while loop 

  $msg_id=$row_msg['message_id']; 


//incoming
 $sel="select messages.*, users.* from messages, users where 
 (messages.to_id='$user_id' AND messages.from_id='$to_id' AND messages.from_id=users.ID AND messages.message_id='$msg_id'  ) "; 
 
 $run=$db->select($sel);   $i=0;  

          if( $run->num_rows > 0) {  $row=$run->fetch_assoc(); ?>
		  

	
	<div class="row w-50 m-auto" >
	
	
	
	 
<img class="rounded mr-2 d-inline " width="45px" height="45px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	



<div class="col-sm-12 pt-1">
	
	<div class="row">
		
		<div class="col-sm-7">
		
		<p class="bg-light shodow rounded p-2 mb-0">  <?php echo $row['message']; ?> </p>
		
		
		</div>
		
		<div class="col-sm-2 pl-0 pt-2">
		
		 <?php  list($date)= explode(' ', $row['time']);  $time= explode(' ', $row['time']);  
        $time=end($time); list($hr)=explode(':', $time);   $time=date_create($time); $time = date_format($time,'h:i'); 
		$date=date_create($date); $date = date_format($date,'M d');   if($hr<12) $hr='am'; else $hr='pm';     
         ?>
		
		 <p class="msg_time" ><?php echo $date.', '.$time.$hr; ?> </p>
		</div>
		
	</div>
	
	</div>


	</div>
	
	
	
	
	
		  <?php  }       ////outcoming


	$sel2="select messages.*, users.* from messages, users where (messages.to_id='$to_id' AND messages.from_id='$user_id' AND messages.from_id=users.ID AND
	messages.message_id='$msg_id'  ) "; 
 $run2=$db->select($sel2);   $i=0; 

  if( $run2->num_rows > 0) {   $row2=$run2->fetch_assoc();  ?>
 
 
	<div class="row w-50 m-auto">
	
	

<img class="rounded ml-auto d-inline  " width="45px" height="45px" src="u_images/<?php echo $row2['Photo']; ?>" alt="" />	



<div class="col-sm-12 pt-1">
	
	<div class="row">
		<div class="col-sm-3"></div>
		
		
		<div class="col-sm-2 pr-0 pt-2">
		
		 <?php  list($date)= explode(' ', $row2['time']);  $time= explode(' ', $row2['time']);  
        $time=end($time); list($hr)=explode(':', $time);   $time=date_create($time); $time = date_format($time,'h:i'); 
		$date=date_create($date); $date = date_format($date,'M d');   if($hr<12) $hr='am'; else $hr='pm';     
         ?>
		
		 <p class="msg_time float-right" > <?php echo $date.', '.$time.$hr; ?> </p>
		</div>
		
		
		
		<div class="col-sm-7">
		
		<p style="background:rgba(0, 123, 255, 0.15)"class=" rounded p-2 mb-0">  <?php echo $row2['message']; ?> </p>
		
		
		</div>
	</div>
	
	

</div>

		</div>
	
	
	
	
	
<?php }  } ?>
	

	
		</div>
	
	
	
	
	
		
	
		
	
	
	
	

<div class="row text-center mx-auto  mt-3 shadow border  font-weight-bold w-50"><h3 class="px-5  h5 text-success m-auto">Sent a Message</h3></div>



<?php $get_messenger = "select * from users where ID='$to_id'";  $run_messenger = $db->select($get_messenger);
		$messenger =$run_messenger->fetch_assoc();          ?>
		


<div class="row w-50 mx-auto post_top my-3 shadow" id="<?php  ?>">
            <div class="  col-sm-4"> <h3 class=" h5 bg-light text-center">To : </h3>
	</div>

<div class="  col-sm-8 "> 
<img class="rounded mr-2 d-inline" width="30px" height="30px" src="u_images/<?php echo $messenger['Photo']; ?>" alt="" />	

<a href="others_profile.php?others_profile_id=<?php echo $messenger['ID']; ?>" 
class="text-dark  profile_link"><h4 class=" d-inline "><?php echo $messenger['Fname'].' '.$messenger['Lname']; ?>  </h4> </a>



	</div>
	
	
	
	<div class="col-sm-12 pb-3">
	
	<form action="" method="POST">
	
	<textarea style=" z-index:1 " name="message" id="" cols="30" rows="2" class="form-control w-100 mt-4" placeholder="Write a message..."></textarea>
	
	<input style=" z-index:10;  " type="submit" name="message_sent" value="Send" class="btn btn-primary float-right " />
	</form>
	
	</div>
	
	
	
	

           </div>

		   
	
	
	

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	<script>
	
	document.querySelector("#scroll_msg").scrollTop = document.querySelector("#scroll_msg").scrollHeight;
	
	</script>
	
	
	
	</body>
</html>
	
	