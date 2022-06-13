<?php   session_start();
include "admin/universals/sessions.php";
include "admin/universals/class.php";


if(!isset($_SESSION['user_login']) && !isset($_COOKIE['user_login']) ){
	
} 
else header("location: inside/home.php");

?>




<!DOCTYPE HTML>
<html lang="en-US">
<head>
 <link rel="shortcut icon" href="lascarh.ico" />
	<title>Lascarh</title>
	
	<meta charset="UTF-8">
	<title></title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<link rel="stylesheet" href="style.css" />


	
	<style>
	body{
		overflow-x: hidden;
	}
	
	.headings h3{  background:#1e7e3414 ; border: 1px solid #fff; color: #000;   font-family:arial; }
	.title {  font-family:cursive; }
	
	#signup{
		max-width: 60%;
		border-radius: 30px;
			background-color: #000;
			color: white;
			border: 1px solid #fff
	}
	#login{
		max-width: 60%;
		background-color: #fff;
		border: 1px solid #1da1f2;
		color: black;
		border-radius: 30px;
	}
	
	.well{
		background-color: rgba(0, 123, 255, 0.08);;
	}

</style>

	<link rel="stylesheet" href="css/font-awesome.min.css" />
	
</head>



<body>
	
	
	<div class="container-fluid one bg-light">
	

	<div class="row">
		<div class="col-sm-12 px-0">
			<div class="well w-100"> 
			
				<center><h1 class="py-4 title text-dark font-weight-bold font-italic" >
				<img style="background:#343a4017" src="images/lascarh.jpg" class="rounded-circle" title="" width="80px" height="80px">
				Lascarh</h1></center>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6" >
			<img src="images/unnamed.jpg" class="img-fluid rounded" title="Coding cafe"  style=" height:565px">
			</div>
		<div class="col-sm-6" >
			
			<h4 class="ml-3 mb-5"><strong>join Lascarh Today.</strong></h4>
			<form method="post" action="">
				<button id="signup" class="w-100 btn  btn-sm-lg" name="signup">Sign up</button><br><br>
				<?php
					if(isset($_POST['signup'])){
						header('location:signup.php'); exit;
					}
				?>
				<button id="login" class="w-100 btn  btn-sm-lg" name="login">Login</button><br><br>
				<?php
					if(isset($_POST['login'])){
					header('location:signin.php'); exit;
					}
				?>
			</form>
			
			
			<div class="headings mt-1">
				<h3 class="mb-1  w-100 rounded py-3 text-left pl-4 font-weight-bold">Follow your favorite stars</h3>
			
				<h3 class=" mt-1  w-100 rounded py-3 text-left pl-4 font-weight-bold">Join the conversations</h3>
			</div>
			
			
		</div>
	</div>

	
	
	</div>
	
	
	
	
	
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
</body>
</html>