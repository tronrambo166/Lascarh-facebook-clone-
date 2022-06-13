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
	
	<style type="text/css"> .drop li:hover{ background:darkgrey;}
	
	<style>
	#cover-img{
		height: 400px;
		width: 100%;
	}#profile-img{
		position: absolute;
		top: 160px;
	
	}
	#update_profile{
		position: relative;
		top: -33px;
		cursor: pointer;
		left: 93px;
		border-radius: 4px;
		background-color: rgba(0,0,0,0.1);
		transform: translate(-50%, -50%);
	}
	#button_profile{
		position: absolute;
		top: 82%;
		left: 50%;
		cursor: pointer;
		transform: translate(-50%, -50%);
	}
</style>
	
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




			
	






<div class="row">
	<div class="col-sm-1">	
	</div>
	<div class="col-sm-8 ml-3"  style="
    min-height: 395px">
	
			
			<div>
				<div><img height="320px" id='cover-img' class='img-rounded w-100' 
				src='u_images/<?php if($row['Cover']=='') echo 'cover.png';  else echo $row['Cover']; ?>' alt='cover'></div>
				
				<form action='' method='post' enctype='multipart/form-data'>

				<ul class='nav pull-left' style='position:absolute; top:1px'>
					<li class=''>
						<div id="cover" class=''>
							
							<label class='btn btn-light text-dark my-0 px-3'> Select Cover
							<input type='file' name='select_cover' size='60' />
							</label><br>
							<button type="submit" name='update_cover' class='btn btn-dark'>Update Cover</button>
							
						</div>
					</li>
				</ul>

				</form>
			</div>
			<div id='profile-img' class="w-50">
				<img src='u_images/<?php if($row['Photo']=='') echo 'profile-placeholder.jpg';  else echo $row['Photo']; ?>' 
				alt='Profile' class='rounded mt-2 mb-1 d-inline' width='165px' height='150px'>
				
				<div class="d-inline-block p_name ml-5" style="height:100px font-family:cursive">
				<h4 style=" font-family:cursive" class="d-inline text-white font-weight-bold"><?php echo $user_name;?></h4></div>
				
				<form action='' method='post' enctype='multipart/form-data'>

				<label class='btn btn-light text-dark my-0 px-3'> Select Profile
							<input type='file' name='select_profile' size='60' />
							</label>
							<button name='update_profile' class='btn btn-dark'>Update Profile</button>
										</form>  
										
							<h4 class="h5 ml-4 bg-light text-danger"><?php Session::show('blank_cover'); Session::show('blank_pro');?></h4>
			</div><br>
			
		
		
		
		
	<div class="col-sm-2">
	</div>
</div>

</div>





<div class="row mt-4">
	<div id="insert_post" class="col-sm-12">
		<center>
		<form action="home.php" method="post" id="f" enctype="multipart/form-data">
		<textarea class="form-control" id="content" rows="3" name="content" placeholder="What's in your mind?"></textarea><br>
		<label class="btn btn-info" id="upload_image_button">Select Image
		<input type="file" name="post_image" size="30">
		</label>
		<button type="submit" id="btn-post" class="btn text-dark font-weight-bold" name="post">Post</button>
		</form>
		
		</center>
	</div>
</div>






<div class="row my-2 w-100">
	
	<div class="col-sm-3  text-left ml-4"  style="text-align: center;left: 0.9%;border-radius: 5px;">
		
		<div class="row">
			<div class="col-sm-2" ></div>
			<div class="col-sm-8 " style="background-color: #e6e6e6">
			
			
			<h2 class=" h4 d-inline"><strong>(About) </strong></h2><strong><?php echo $user_name;?></strong> <div class="my-3 border border-info"></div>
			<p><strong><i style='color:grey;'><?php echo $row['Description'];?></i></strong></p><br>
			<p><strong>Relationship Status: </strong> <?php echo $row['R_status'];?></p><br>
			<p><strong>Lives In: </strong> <?php echo $row['Country'];?></p><br>
			<p><strong>Member Since: </strong> <?php echo $date;?></p><br>
			<p><strong>Gender: </strong> <?php echo $row['Gender'];?></p><br>
			<p><strong>Date of Birth: </strong> <?php echo $row['Birthdate'];?></p><br>
			
			</div>
			
			
				<div class="col-sm-2" ></div>
		</div>
		
	</div>
	
	
	
	
		<div class="col-sm-6   mb-5">
	   <?php   //My Posts
	
	$sel="select posts.*, users.*  from posts, users where posts.user_id=users.ID  order by posts.post_id DESC "; 
 $run=$db->select($sel);
    $i=0;    while($row=$run->fetch_assoc() ){ $i++;

		list($date)= explode(' ', $row['post_date']);  $time=		 explode(' ', $row['post_date']);
        $time=end($time);$time=date_create($time); $time = date_format($time,'h:i');	 $share_ck=$row['share_ck']; 
		$date=date_create($date); $date = date_format($date,'M d, Y');          

     $sel3="select * from users"; $run3=$db->select($sel3); 


	 
	 
 while($shared_user=$run3->fetch_assoc()) {		if($share_ck==$shared_user['ID'] && $user_id ==$shared_user['ID'] ) {          ?> 
		
		
		
	
       <div class="row  border shadow">
	<div class="col-sm-12" id="<?php echo 'comment'.$row['post_id']; ?>">
	
			
			<div class="row post_top mb-3 border bg-light" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
            <img class="rounded ml-2" width="60px" height="60px" src="u_images/<?php echo $shared_user['Photo']; ?>" alt="" />	
	         </div>

               <div class="  col-sm-4 mt-2">
              <h4 class=" w-100"><?php echo $shared_user['Fname'].' '.$shared_user['Lname']; ?>  </h4>

</div>  <div class="col-sm-5"><p class="pt-2 font-italic">Shared <b><?php echo $row['Fname'].' '.$row['Lname']; ?></b>'s post.</p></div>

           </div>
	
	
	
	
		<div class="row post_top mb-3" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
<img class="rounded-circle mr-2" width="90px" height="85px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	
	</div>

<div class="  col-sm-9 mt-2">
<h4 class=" w-100"><?php echo $row['Fname'].' '.$row['Lname']; ?>   



</h4>

		


<p class="text-secondary">Posted on: <?php echo $date.' at '.$time; ?></p>	
	</div>

           </div>




<div class="row post_body ">
         <p class="text-justify px-4 pb-1"><?php echo $row['content']; ?></p>
         

           </div>

  <?php if($row['image']!='') { ?>
<div class="row post_image ">
        <img src="p_images/<?php echo $row['image']; ?>" style="width:100%; height:300px"alt="" class="rounded" />

           </div>
		   
  <?php } ?>

	</div>
	


<div  class="col-sm-12 pt-1 border mt-3 bg-light">
	<div class="row">
		<div class="col-sm-8">Likes: <?php echo $row['likes'];?></div>
		
		
		<?php  $p_id=$row['post_id']; $sel="select * from comments where post_id='$p_id' ";  $cmnt_no=$db->select($sel)->num_rows; 
		   $select="select * from comments where post_id='$p_id' order by com_id DESC ";  $coms=$db->select($select); ?>
		
		<div class="col-sm-4"> <pre><?php echo  $cmnt_no;?> Comments    <?php echo $row['shares']+1;?> Shares</pre></div>
	</div>
</div>



<div class="col-sm-12   like my-2 " >
	<div class="row">
		<div class="col-6 pl-0"><?php if(isset($_SESSION['like_id'])&& $_SESSION['like_id']==$row['post_id']) {?> 
		<a href="home.php?unlike_id=<?php echo $row['post_id'];?>&ii=<?php echo $i; ?>"
		class="btn ">Unlike</a> <?php unset($_SESSION['like_id']); } else { ?> 
		<a href="home.php?like_id=<?php echo $row['post_id'];?>&ii=<?php echo $i; ?>" class="btn ">Like</a> <?php }?></div>
		
		
<div class="col-6 text-center pr-0"><a href="#<?php echo 'cmnt'.$row['post_id']; ?>" data-toggle="collapse" class=" btn">Comment</a></div>


<?php if(isset($_SESSION['share_id'])&& $_SESSION['share_id']==$row['post_id']) { ?> <div class="col-sm-4  pr-0"><a href="" class=" disabled float-right btn">Shared</a></div> <?php } else {?>

<div class="col-sm-4  pr-0"></div>
<?php }?>
	
	
		<div class="comment collapse w-100 <?php if(isset($_SESSION['show_com']) && $_SESSION['show_com']==$row['post_id']){ ?> show 
		<?php   }   ?>" id="<?php echo 'cmnt'.$row['post_id']; ?>">
		
		<?php while($show_coms=$coms->fetch_assoc()) { ?>
		
		<div class="row mt-2">
			<div class="col-sm-1"><img height="35px" width="35px" class="ml-3 rounded" src="u_images/<?php echo $show_coms['user_image']; ?>" alt="" /></div>
			<div class="col-sm-10"> <b class="text-success font-italic"><?php echo $show_coms['com_name']; ?> </b>
			<p class="ml-2 bg-light text-dark text-justify"><?php echo $show_coms['comment']; ?></p></div>
		</div>
		
		<?php  } ?>
		
		
		
		 <form action="" method="POST">
				
                  <textarea name="comment" id="" placeholder="Write a comment..." cols="30" rows="3" class="form-control"></textarea>
             
				<input type="number" hidden name="post_id" value="<?php echo $row['post_id']; ?>" />
				<input type="text" hidden name="com_name" value="<?php echo $user_name; ?>" />
				<input type="number" hidden name="com_id" value="<?php echo $user_id; ?>" />
				<input type="text" hidden name="user_image" value="<?php echo $user_image; ?>" />
				
                  <button  type="submit" name="post_comment"  class="btn btn-info float-right px-4 font-weight-bold">Post</button>
				  	</form>
                </div>
		
		
		</div>
	</div>
</div>

		
		
		
		
 <?php }  }  ?>                      <?php       if($row['share_ck']==0  &&  $user_id ==$row['ID']) { ?>
		

		
		
		
		
		
		
   <div class="row mt-5 border shadow">
		
		
	<div class="col-sm-12" id="<?php echo 'comment'.$row['post_id']; ?>">
		<div class="row post_top mb-3" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
<img class="rounded-circle mr-2" width="90px" height="85px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	
	</div>

<div class="  col-sm-9 mt-2">
<h4 class=" w-100"><?php echo $row['Fname'].' '.$row['Lname']; ?>   
<a href="#<?php echo 'edit'.$i; ?>" data-toggle="collapse" class="d-inline-block float-right"><span class=" ">...</span></a>

<div id="<?php echo 'edit'.$i; ?>" class="collapse post_edit float-right">
 <a  data-toggle="modal" href="#<?php echo 'modal'.$i; ?>" class="edit btn btn-light py-0">Edit</a>
  <a onclick="return confirm('Are you sure to delete this post?')" href="home.php?post_del_id=<?php echo $row['post_id']; ?>" 
  class="delete btn btn-light py-0">Delete</a>

</div>

</h4>


<div class="modal  " id="<?php echo 'modal'.$i; ?>" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
            <div class="modal-dialog  vertical-align-center  w-100 m-auto">
              <div class="modal-content w-100 m-auto">
               
                <form action="home.php" method="POST">
				
				<div class="modal-body">
                    <textarea name="content" id="" cols="30" rows="4" class="form-control"><?php echo $row['content']; ?></textarea>
                </div>
				
                <div class="modal-footer">
				<input type="number" hidden name="post_id" value="<?php echo $row['post_id']; ?>" />
				
                    <button  type="submit" name="up_post"  class="btn btn-success">Update</button>
                </div>
				
				</form>
				
              </div>
            </div>
        </div>
		


<p class="text-secondary">Posted on: <?php echo $date.' at '.$time; ?></p>	
	</div>

           </div>




<div class="row post_body ">
         <p class="text-justify px-4 pb-1"><?php echo $row['content']; ?></p>
         

           </div>

  <?php if($row['image']!='') { ?>
<div class="row post_image ">
        <img src="p_images/<?php echo $row['image']; ?>" style="width:100%; height:300px"alt="" class="rounded" />

           </div>
		   
  <?php } ?>

	</div>


<div  class="col-sm-12 pt-1 border mt-3 bg-light">
	<div class="row">
		<div class="col-sm-8">Likes: <?php echo $row['likes'];?></div>
		
		
		<?php  $p_id=$row['post_id']; $sel="select * from comments where post_id='$p_id' ";  $cmnt_no=$db->select($sel)->num_rows; 
		   $select="select * from comments where post_id='$p_id' order by com_id DESC ";  $coms=$db->select($select); ?>
		
		<div class="col-sm-4"> <pre><?php echo  $cmnt_no;?> Comments    <?php echo $row['shares'];?> Shares</pre></div>
	</div>
</div>



<div class="col-sm-12   like my-2 " >
	<div class="row">
		<div class="col-3 pl-0"><?php if(isset($_SESSION['like_id'])&& $_SESSION['like_id']==$row['post_id']) {?> 
		<a href="home.php?unlike_id=<?php echo $row['post_id'];?>&ii=<?php echo $i; ?>"
		class="btn ">Unlike</a> <?php unset($_SESSION['like_id']); } else { ?> 
		<a href="home.php?like_id=<?php echo $row['post_id'];?>&ii=<?php echo $i; ?>" class="btn ">Like</a> <?php }?></div>
		
		
<div class="col-6 text-center"><a href="#<?php echo 'cmnt'.$row['post_id']; ?>" data-toggle="collapse" class=" btn">Comment</a></div>


<?php if(isset($_SESSION['share_id'])&& $_SESSION['share_id']==$row['post_id']) { ?> <div class="col-sm-4  pr-0"><a href="" class=" disabled float-right btn">Shared</a></div> <?php } else {?>

<div class="col-3  pr-0"><a href="home.php?share_id=<?php echo $row['post_id'];?>&ii=<?php echo $i; ?>" class="float-right btn">Share</a></div>
<?php }?>
	
	
		<div class="comment collapse w-100 <?php if(isset($_SESSION['show_com']) && $_SESSION['show_com']==$row['post_id']){ ?> show 
		<?php   }   ?>" id="<?php echo 'cmnt'.$row['post_id']; ?>">
		
		<?php while($show_coms=$coms->fetch_assoc()) { ?>
		
		<div class="row mt-2">
			<div class="col-sm-1"><img height="35px" width="35px" class="ml-3 rounded" src="u_images/<?php echo $show_coms['user_image']; ?>" alt="" /></div>
			<div class="col-sm-10"> <b class="text-success font-italic"><?php echo $show_coms['com_name']; ?> </b>
			<p class="ml-2 bg-light text-dark text-justify"><?php echo $show_coms['comment']; ?></p></div>
		</div>
		
		<?php  } ?>
		
		
		
		 <form action="" method="POST">
				
                  <textarea name="comment" id="" placeholder="Write a comment..." cols="30" rows="3" class="form-control"></textarea>
             
				<input type="number" hidden name="post_id" value="<?php echo $row['post_id']; ?>" />
				<input type="text" hidden name="com_name" value="<?php echo $user_name; ?>" />
				<input type="number" hidden name="com_id" value="<?php echo $user_id; ?>" />
				<input type="text" hidden name="user_image" value="<?php echo $user_image; ?>" />
				
                  <button  type="submit" name="post_comment"  class="btn btn-info float-right px-4 font-weight-bold">Post</button>
				  	</form>
                </div>
		
		
		</div>
	</div>
</div>







<?php    }     }  // end of posts col-sm-6 ?>         </div>

	
	
	
	<div class="col-sm-2 text-info mt-5 ml-5 text-center">
  <div class="row">
  	<div class="col-sm-12 bg-dark ">
	
	<b class="border-bottom">Google Ads Section</b>
	
	<div class="row "><p class=" w-100 text-center">This is a sidebar</p></div>
	<div class="row "><p class=" w-100 text-center">This is a sidebar</p></div>
	<div class="row "><p class=" w-100 text-center">This is a sidebar</p></div>
	
	
	
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