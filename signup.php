<?php   session_start();
include "admin/universals/sessions.php";
include "admin/universals/class.php";


if(isset($_POST['sign_up'])){
	
	$all->signup($_POST);
	
}



?>




<!DOCTYPE HTML>
<html lang="en-US">
<head> <link rel="shortcut icon" href="lascarh.ico" />
	<title>Lascarh</title>
	
	<meta charset="UTF-8">
	
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<link rel="stylesheet" href="style.css" />
<style>
	body{
		overflow-x: hidden;
	}
	.main-content{
		max-width: 50%;
		
		margin: 10px auto;
		background-color: #fff;
		border: 2px solid #e6e6e6;
		padding: 40px 50px;
	}
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		background-color: #187FAB;
	}
	#signin{
		max-width: 60%;
		border-radius: 30px;
	}
	.overlap-text{
		position: relative;
	}
	.overlap-text a{
		position: absolute;
		top: 8px;
		right: 10px;
		font-size: 14px;
		text-decoration: none;
		font-family: 'Overpass Mono', monospace;
		letter-spacing: -1px;

	}
	
  .header h3{
    color: black;
    font-weight: bold;
    font-family: monospace;
    font-size: 26px;
}
</style>

	
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
				<img style="background:#343a4017" src="images/lascarh.jpg" class="rounded-circle" title="Coding cafe" width="80px" height="80px">
				Lascarh </h1></center>
			</div>
		</div>
	</div>
	
	
	
	
	
	<div class="row">
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h3 style="text-align: center;"><strong>Join Lascarh Today</strong></h3>
                 <h5 class="text-center bg-light text-success"><?php Session::show('signup');?></h5>				
				<hr>
			</div>
			<div class="l-part">
				<form action="" method="post">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" class="form-control" placeholder="First Name" name="fname" required="required">
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" class="form-control" placeholder="Last Name" name="lname" required="required">
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="password" type="password" class="form-control" placeholder="Password" name="password" required="required">
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input id="email" type="email" class="form-control" placeholder="Email" name="email" required="required">
					    </div> <?php if(isset($_SESSION['dbl_email'])) {echo $_SESSION['dbl_email']; $_SESSION['dbl_email']=""; } ?><br> 
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
						<select class="form-control" name="country" required="required">
							<option hidden>Select your Country</option>
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
						<span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
						<select class="form-control input-md" name="gender" required="required">
							<option hidden>Select your Gender</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="others">Others</option>
						</select>
					</div><br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<input type="date" class="form-control input-md" placeholder="" name="birthdate" required="required">
					</div><br>
					<a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Signin" href="signin.php">Already have an account?</a><br><br>

					<center><button type="submit" id="signup" class="btn btn-info btn-lg" name="sign_up">Signup</button></center>
					
				</form>
			</div>
		</div>
	</div>
</div>


	
	
	</div>
	
	
	
	
	
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
</body>
</html>