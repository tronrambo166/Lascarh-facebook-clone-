<!DOCTYPE html>
<?php
session_start();
include "../admin/universals/sessions.php";
include "../admin/universals/class.php";

if(!isset($_SESSION['user_login']) && !isset($_COOKIE['user_login']) ){
	header("location: login.php");
}


include "like_comment_share.php";

	
	
	
	
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
	



       // COVER

			if(isset($_POST['update_cover'])){

				$u_cover = $_FILES['select_cover']['name'];
				$image_tmp = $_FILES['select_cover']['tmp_name'];
				

				if($u_cover==''){
					$_SESSION['blank_cover']="Please select an image !";
               header('location:profile.php') ; exit();
					
				}
				
				else{
					move_uploaded_file($image_tmp, "u_images/".$u_cover);
					$update = "update users set Cover='$u_cover' where ID='$user_id'";

					$run = $db->update($update);

					if($run){
					echo "<script>alert('Your Cover Updated')</script>";
					 header('location:profile.php') ; exit();
					}
				}

			}

		
		
		
		
		 // Profile
		
		if(isset($_POST['update_profile'])){

				$u_profile = $_FILES['select_profile']['name'];
				$image_tmp = $_FILES['select_profile']['tmp_name'];
				

				if($u_profile==''){
					$_SESSION['blank_pro']="Please select an image !";
                   header('location:profile.php') ; exit();
					
				}
				
				else{
					move_uploaded_file($image_tmp, "u_images/".$u_profile);
					$update = "update users set Photo='$u_profile' where ID='$user_id'";

					$run = $db->update($update);

					if($run){
					echo "<script>alert('Your Profile Updated')</script>";
					 header('location:profile.php') ; exit();
					}
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


<div class="row text-center bg-success mb-5 py-2 font-weight-bold "><h3 class="m-auto">Find peoples here</h3></div>



<?php if(isset($_GET['search'])){   $name=$_GET['user_search'];
		
		 $sel="select * from users where Fname LIKE '%$name%'  OR  Lname LIKE '%$name%' ";  $res=$db->select($sel); 
		  ?> 
 <div class="row mx-auto border mb-4 bg-primary"><b class="p-2 font-weight-bold bg-light mx-auto"> Search resutls for: <?php echo $name; ?> </b></div>	  
		   
		   
	<?php	   while($row=$res->fetch_assoc()){   ?>
		


<div class="row w-50 mx-auto post_top my-5 shadow" id="<?php  ?>">
            <div class="  col-sm-3">
<img class="rounded-circle mr-2" width="90px" height="85px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	
	</div>

<div class="  col-sm-9 mt-2">
<a href="others_profile.php?others_profile_id=<?php echo $row['ID']; ?>" 
class="text-dark  profile_link"><h4 class=" w-100"><?php echo $row['Fname'].' '.$row['Lname']; ?>   </a>



</h4>

	</div>

           </div>

		   
	<?php }   }        else { ?>   <div class="row mx-auto border mb-4 bg-primary"><b class="p-2 font-weight-bold bg-light mx-auto">People you may know </b></div>		  




<?php  
$sel="select * from users order by ID DESC ";  $res=$db->select($sel); 
		   while($row=$res->fetch_assoc()){   if($row['ID'] != $_COOKIE['user_id'] ) { ?>
		


<div class="row w-50 mx-auto post_top border my-5" id="<?php  ?>">
            <div class="  col-sm-3">
<img class="rounded-circle mr-2" width="90px" height="85px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	
	</div>

<div class="  col-sm-9 mt-2">
<a href="others_profile.php?others_profile_id=<?php echo $row['ID']; ?>" 
class="text-dark  profile_link"><h4 class=" w-100"><?php echo $row['Fname'].' '.$row['Lname']; ?>   </a>


</h4>

	</div>

           </div>
           </div>

		   
	<?php } }  } ?>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	</body>
</html>
	
	