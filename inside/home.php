<!DOCTYPE html>
<?php  
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

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
		$user_image = $row['Photo'];
		
	

	//-----------------------------------------------
	
	        $mes="select * from messages where messages.to_id='$user_id' "; $msg_no=$db->select($mes)->num_rows;
			$all_msg= $msg_no; 
       		if(isset($_COOKIE['old_msg'.$user_id]))	$old_msg=$_COOKIE['old_msg'.$user_id]; else $old_msg=0;
	
	        $new_msg=($all_msg)-($old_msg);
            
           
           $_SESSION['new_msg']= $new_msg;
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
			<li class="nav-item py-1 px-3 "><a href="messages.php?msg_no=<?php echo $msg_no; ?>" class="text-secondary nav-link">Messages
					
					
		<?php	if(isset($_SESSION['new_msg'])) { if($_SESSION['new_msg']>0) {	?>
		<span class="msg_no text-white px-1"><?php echo $_SESSION['new_msg']; ?></span> <?php } else { ?>  <span class="px-1 text-white px-1"> </span>  <?php } } else { ?>
		<span class="msg_no text-white px-1"><?php echo $new_msg; ?></span> <?php } ?>
					
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
	<div id="insert_post" class="col-sm-12">
		<center>
		<form action="home.php" method="post" id="f" enctype="multipart/form-data">
		<textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind?"></textarea><br>
		<label class="btn btn-info" id="upload_image_button">Select Image
		<input type="file" name="post_image" size="30">
		</label>
		<button type="submit" id="btn-post" class="btn text-dark font-weight-bold" name="post">Post</button>
		</form>
		
		</center>
	</div>
</div>


<div class="row">
	<div class="w-50 mx-auto feed mt-4">
	
	
	


	
	
	
		<center><h2 class="py-1"><strong>News Feed</strong></h2><br></center>
		
	</div>
</div>





<?php  if(isset($_GET['page'])) { $int=$_GET['page'];                     //Pagination 1st part
			
			$select=" select * from posts";
			$res=$db->select($select);
			$page=ceil(($res->num_rows)/8);
			
			
			
			
								$perpage=8;
								$start=(($int*$perpage)-$perpage)+1;
								$start=$start-1;
								
								
								//$sel=" select * from posts LIMIT $start,$perpage ";
								
			


 $sel="select posts.*, users.*  from posts, users where posts.user_id=users.ID  order by posts.post_id DESC LIMIT  $start,$perpage"; 
 $run=$db->select($sel);
    $i=0;    while($row=$run->fetch_assoc() ){ $i++;

		list($date)= explode(' ', $row['post_date']);  $time=		 explode(' ', $row['post_date']);
        $time=end($time); list($hr)=explode(':', $time);   $time=date_create($time); $time = date_format($time,'h:i');	 $share_ck=$row['share_ck']; 
		$date=date_create($date); $date = date_format($date,'M d, Y');   if($hr<12) $hr='am'; else $hr='pm';        

     $sel3="select * from users"; $run3=$db->select($sel3); 


 while($shared_user=$run3->fetch_assoc()) {		if($share_ck==$shared_user['ID']) {          ?> 
		
		
		
		<div class="row w-50 mx-auto border shadow mb-5">

	<div class="col-sm-12" id="<?php echo 'comment'.$row['post_id']; ?>">
	
			
			<div class="row post_top mb-3 border bg-light" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
            <img class="rounded ml-2" width="60px" height="60px" src="u_images/<?php echo $shared_user['Photo']; ?>" alt="" />	
	         </div>

               <div class="  col-sm-4 mt-2">
			   
			   <a href="others_profile.php?others_profile_id=<?php echo $shared_user['ID']; ?>" 
                class="text-dark  profile_link"><h4 class=" w-100"><?php echo $shared_user['Fname'].' '.$shared_user['Lname']; ?>   </a>


</div>  <div class="col-sm-5"><p class="pt-2 font-italic">Shared <b><?php echo $row['Fname'].' '.$row['Lname']; ?></b>'s post.</p></div>

           </div>
	
	
	
	
		<div class="row post_top mb-3" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
<img class="rounded-circle mr-2" width="90px" height="85px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	
	</div>

<div class="  col-sm-9 mt-2">
<a href="others_profile.php?others_profile_id=<?php echo $row['ID']; ?>" 
class="text-dark  profile_link"><h4 class=" w-100"><?php echo $row['Fname'].' '.$row['Lname']; ?>   </a>


		


<p class="text-secondary font-weight-normal" style="font-size:15px">Posted on: <?php echo $date.' at '.$time.$hr; ?></p>	
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
		
		
		
		
 <?php }  }             if($row['share_ck']==0) { ?>
		

		
		
		
		
		
<div class="row w-50 mx-auto border shadow mb-5">

	<div class="col-sm-12" id="<?php echo 'comment'.$row['post_id']; ?>">
		<div class="row post_top mb-3" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
<img class="rounded-circle mr-2" width="90px" height="85px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	
	</div>

<div class="  col-sm-9 mt-2">
<a href="others_profile.php?others_profile_id=<?php echo $row['ID']; ?>" 
class="text-dark  profile_link"><h4 class=" w-100"><?php echo $row['Fname'].' '.$row['Lname']; ?>   </a>
  
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
		


<p class="text-secondary" >Posted on: <?php echo $date.' at '.$time.$hr; ?></p>	
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




</div>

<?php    }     }   }                                                       








else  {  //Pagination 2nd part






          $int=1;
			
			$select=" select * from posts";
			$res=$db->select($select);
			$page=ceil(($res->num_rows)/8);
			
			
			
			
								$perpage=8;
								$start=(($int*$perpage)-$perpage)+1;
								$start=$start-1;
								
								
								//$sel=" select * from posts LIMIT $start,$perpage ";
								
			


 $sel="select posts.*, users.*  from posts, users where posts.user_id=users.ID  order by posts.post_id DESC LIMIT  $start,$perpage"; 
 $run=$db->select($sel);
    $i=0;    while($row=$run->fetch_assoc() ){ $i++;

		list($date)= explode(' ', $row['post_date']);  $time=		 explode(' ', $row['post_date']);
        $time=end($time); list($hr)=explode(':', $time);   $time=date_create($time); $time = date_format($time,'h:i');	 $share_ck=$row['share_ck']; 
		$date=date_create($date); $date = date_format($date,'M d, Y');   if($hr<12) $hr='am'; else $hr='pm';        

     $sel3="select * from users"; $run3=$db->select($sel3); 


 while($shared_user=$run3->fetch_assoc()) {		if($share_ck==$shared_user['ID']) {          ?> 
		
		
		
		<div class="row w-50 mx-auto border shadow mb-5">

	<div class="col-sm-12" id="<?php echo 'comment'.$row['post_id']; ?>">
	
			
			<div class="row post_top mb-3 border bg-light" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
            <img class="rounded ml-2" width="60px" height="60px" src="u_images/<?php echo $shared_user['Photo']; ?>" alt="" />	
	         </div>

               <div class="  col-sm-4 mt-2">
			  <a href="others_profile.php?others_profile_id=<?php echo $shared_user['ID']; ?>" 
class="text-dark  profile_link"><h4 class=" w-100"><?php echo $shared_user['Fname'].' '.$shared_user['Lname']; ?>   </a>


</div>  <div class="col-sm-5"><p class="pt-2 font-italic">Shared <b><?php echo $row['Fname'].' '.$row['Lname']; ?></b>'s post.</p></div>

           </div>
	
	
	
	
		<div class="row post_top mb-3" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
<img class="rounded-circle mr-2" width="90px" height="85px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	
	</div>

<div class="  col-sm-9 mt-2">
<a href="others_profile.php?others_profile_id=<?php echo $row['ID']; ?>" 
class="text-dark  profile_link"><h4 class=" w-100"><?php echo $row['Fname'].' '.$row['Lname']; ?>   </a>
  



</h4>

		


<p class="text-secondary">Posted on: <?php echo $date.' at '.$time.$hr; ?></p>	
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
		
		
		
		
 <?php }  }             if($row['share_ck']==0) { ?>
		

		
		
		
		
		
<div class="row w-sm-50 mx-auto border shadow mb-5">

	<div class="col-sm-12" id="<?php echo 'comment'.$row['post_id']; ?>">
		<div class="row post_top mb-3" id="<?php echo "open_here".$i; ?>">
            <div class="  col-sm-3">
<img class="rounded-circle mr-2" width="90px" height="85px" src="u_images/<?php echo $row['Photo']; ?>" alt="" />	
	</div>

<div class="  col-sm-9 mt-2">
<a href="others_profile.php?others_profile_id=<?php echo $row['ID']; ?>" 
class="text-dark  profile_link"><h4 class=" w-100"><?php echo $row['Fname'].' '.$row['Lname']; ?>   </a>

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
		


<p class="text-secondary">Posted on: <?php echo $date.' at '.$time.$hr; ?></p>	
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




</div>

<?php    }     } } ?>









	
	
	
	
	 <!-- Pagination -->
	
	<div class="text-center py-5"> 
								<?php
								if($int>1) { ?>
								<a href="home.php?page=<?php echo $int-1;?>" class="ml-0 btn btn-dark text-light">Prev</a>
							
								<?php  }
								else { ?>
								<a href="" class="btn btn-dark text-light disabled ml-0">Prev</a>
								
								<?php }

								
								
								
								for($a=1;$a<=$page;$a++){ if($a==$int){ ?>
										
										
										
											<a href="home.php?page=<?php echo $a;?>" class=" d-inline ml-0 btn btn-light active " ><?php echo $a?></a>

																			
										
										<?php
								}
										else { ?>	<a href="home.php?page=<?php echo $a;?>" class=" d-inline ml-0 btn btn-light  " ><?php echo $a?></a>

										<?php	}}

								?>	
								
								<?php
								if($int<$a-1) { ?>
								<a href="home.php?page=<?php echo $int+1;?>" class="ml-0 btn btn-dark text-light">Next</a>
							
								<?php  }
								else { ?>
								<a href="" class="btn btn-dark text-light disabled ml-0">Next</a>
								
								<?php } ?>

			</div>	
		    <!-- Pagination -->
				
			


</div>






<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
<script type="text/javascript">



</script>



</body>
</html>