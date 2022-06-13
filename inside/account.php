<!DOCTYPE html>
<?php
session_start();
include "../admin/universals/sessions.php";
include "../admin/universals/class.php";

if(!isset($_SESSION['user_login']) && !isset($_COOKIE['user_login']) ){
	header("location: login.php");
}


include "like_comment_share.php";

if(isset($_POST['save_info'])) {
	
	$all->editinfo($_POST); 
	
}



$u_id = $_COOKIE['user_id'];


	//-----------------------------------------------
	
		$user_id = $_COOKIE['user_id'];
		$get_user = "select * from users where ID='$user_id'";
		$run = $db->select($get_user);
		$row =$run->fetch_assoc();

		$user_name = $row['Fname'].' '.$row['Lname'];
		$date= $row['Birthdate'];
		
		$date=date_create($date);
		 $date = date_format($date,'Y-m-d'); 

	//-----------------------------------------------
		
		
			
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
	
 
		<style type="text/css"> .drop li:hover{ background:darkgrey;}
		
		.input-group-addon{ width:17%;}
		
		
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

	

<div class="row text-center bg-light border shadow my-4 py-2"><h3 class=" font-weight-light  m-auto">Edit Account Informations</h3></div>
               <h5 class="bg-info shadow text-center"><?php Session::show('save_info');?></h5>




<div class="row w-50 m-auto ">


	<form action="" method="post" class=" w-100 mb-5">
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">First Name</span>
						<input type="text" class="form-control" placeholder="First Name" name="fname" value="<?php echo $row['Fname'];?>" >
					</div><br>
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">Last Name</span>
						<input type="text" class="form-control" placeholder="Last Name" name="lname" value="<?php echo $row['Lname'];?>">
					</div><br>
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">Old Password</span>
						<input id="password" type="password" class="form-control" placeholder="Password" name="o_password" >
					</div> <span class="ml-5 pl-5"></span> <?php Session::show('pass_wrong');?><br>
					
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">New Password</span>
						<input id="password" type="password" class="form-control" placeholder="Password" name="n_password" >
					</div><br>
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">Email</span>
						<input id="email" type="email" readonly class=" form-control" placeholder="Email" name="email" value="<?php echo $row['Email'];?>">
					    </div><br> 
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">Country</span>
						<select class="form-control" name="country" > 
							<option hidden>Select your Country</option>
							<option value="<?php echo $row['Country'];?>" selected hidden> <?php echo $row['Country'];?> </option>

							<option>Pakistan</option>
							<option>United States of America</option>
							<option>India</option>
							<option>Japan</option>
							<option>UK</option>
							<option>France</option>
							<option>Germany</option>
						</select>
					</div><br>
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">Gender</span>
						<select class="form-control input-md" name="gender" >
							<option hidden>Select your Gender</option>
							<option value="<?php echo $row['Gender'];?>" selected hidden><?php echo ucfirst($row['Gender']);?></option>
							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="others">Others</option>
						</select>
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">Relationship Status</span>
                         <select class="form-control input-md" name="r_status" >
							<option hidden></option>
							<option value="<?php echo $row['R_status'];?>" selected hidden><?php echo ucfirst($row['R_status']);?></option>
							<option value="Single">Single</option>
							<option value="Married">Married</option>
							<option value="Complicated">Complicated</option>
						</select>					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon mr-4 font-weight-bold">Birthdate</span>
						<input type="date" class="form-control input-md"  name="birthdate" value="<?php echo $date;?>">
					</div><br>

					<center><button type="submit" id="save_info" class="btn rounded-circle btn-dark shadow btn-lg" name="save_info">Save info</button></center>
					
				</form>




</div>





	  
 </div>
	
	
	

        

		   
	
	
	

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	</body>
</html>
	
	