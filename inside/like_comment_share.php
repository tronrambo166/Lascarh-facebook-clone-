<?php

if(isset($_POST['post'])  ||  isset($_GET['share_id']) ){ 
	
	if( !isset($_POST['post']) ) $share_id=$_GET['share_id']; else $share_id='';
	
	$all->post($_POST,$share_id);
	
}


if(isset($_POST['up_post'])){ 
	
	$post_id=$_POST['post_id']; $content=$_POST['content']; 	$content=$db->escape($content);
	$up="update posts set content='$content' where post_id='$post_id' ";  $run=$db->update($up); header('location:home.php'); exit;
	
	//$all->post($_POST);
	
}


if(isset($_GET['post_del_id'])){ $post_del_id=$_GET['post_del_id'];
	
	$del="delete from posts where post_id='$post_del_id' "; $run=$db->delete($del); 
	if($run) echo "<script type=''>alert('Post Deleted.')</script>"; header('location:home.php'); exit;
	
}



if(isset($_GET['like_id'])){ $_SESSION['like_id']=$_GET['like_id'];  $ii=$_GET['ii'];  $like_id=$_GET['like_id'];
	
	 $sel="select * from posts where post_id='$like_id' ";  $row=$db->select($sel)->fetch_assoc(); $like=$row['likes']+1;
	 $up="update posts set likes='$like' where post_id='$like_id' ";  $run=$db->update($up); 
      header('Location: home.php#open_here'.$ii); exit;	
}



if(isset($_GET['unlike_id'])){ $_SESSION['unlike_id']=$_GET['unlike_id'];  $ii=$_GET['ii'];  $unlike_id=$_GET['unlike_id'];
	
	 $sel="select * from posts where post_id='$unlike_id' ";  $row=$db->select($sel)->fetch_assoc(); $like=$row['likes']-1;
	 $up="update posts set likes='$like' where post_id='$unlike_id' ";  $run=$db->update($up); 
      header('Location: home.php#open_here'.$ii); exit;	
}


if(isset($_POST['post_comment'])){ 
	$comment=$_POST['comment']; $comment=$db->escape($comment);
	$user_id=$_POST['com_id'];
	$post_id=$_POST['post_id'];
	$com_name=$_POST['com_name'];
	$user_image=$_POST['user_image'];
	
	$in="insert into comments (comment,user_id,com_name,post_id,user_image)
	values('$comment','$user_id','$com_name','$post_id','$user_image')"; $run=$db->insert($in);
	
    $_SESSION['show_com']=$post_id;
	header('location:home.php#comment'.$post_id);
	
}




if(isset($_GET['share_id'])){ $_SESSION['share_id']=$_GET['share_id'];  $ii=$_GET['ii'];  $share_id=$_GET['share_id'];
	
	 $sel="select * from posts where post_id='$share_id' ";  $row=$db->select($sel)->fetch_assoc(); $share=$row['shares']+1;
	 $up="update posts set shares='$share' where post_id='$share_id' ";  $run=$db->update($up); 
      
}


?>