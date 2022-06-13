<?php  


include "mysql.php";
include "helps.php";


Class Complete{
	
public $db;
	
	public function __construct(){
	$this->db=new Database();
	}
	
	
	
	
	public function edit_profile($var){
		
		$name=$var['name'];
	
		$email=$var['email'];
		$password=$var['password'];
		

	
	$up=" UPDATE `users` SET `Name`='$name',`Email`='$email',`Password`='$password'  WHERE `Email`='$email' ";
   
	$run=$this->db->update($up);
	
	if($run==true){
		
		$_SESSION['up']="Informations Updated Successfully !";
		//move_uploaded_file($_FILES['file']['tmp_name'], 'images/'.$photo);
    header('location:index.php?page=profile'); exit;	
	}

	}	
	
	
	
	
	
	
	
	
	public function signup($var){
		
		
		$error=array();
		$fname=$lname=$email=$country=$password=$gender=$birthdate="";
		
		
		if(empty($var['fname']))
		{
			$_SESSION['name_err']= "Name is required !";
			$error['name']= "Name is required !";
			
		}
		
		else
		$fname=$var['fname'];
	
	
	if(empty($var['lname']))
		{
			$_SESSION['name_err']= "Name is required !";
			$error['name']= "Name is required !";
			
		}
		
		else
		$lname=$var['lname'];
	
	
	
	if(empty($var['email'])){
			$_SESSION['email']= "Email is required !";
			$error['email']= "Email is required !";
	}
	
		else
		{
			if(!filter_var($var['email'], FILTER_VALIDATE_EMAIL)){
				  $error['email']= "Email is invalid !";
				  $_SESSION['dbl_email']= "Email is invalid !";
			}
				  
                  else
		          $email=$var['email'];
		}
		
		
		
		if(empty($var['password'])){
			$error['password']= "Password is required !";
			$_SESSION['password']= "Password is required !";
		}
		
		else{
		$password=$var['password'];
		$password=password_hash($password,PASSWORD_DEFAULT);
		
		
		}
	
	
	if($var['country']=='NULL'){
			$error['country']= "Please select a country !";
			$_SESSION['country']= "Please select a country !";
	}
	
	
	else{
		$country=$var['country'];
		
		}
	
	
	
	if(empty($var['gender'])){
$error['address']= "Address is required !";
$_SESSION['address']= "Address is required !";

}
		else{
		$gender=$var['gender'];
		}
	
	
	
	
  $birthdate= $var['birthdate'];
	
	
print_r($var);
	
	if(count($error)==0){ 
		
		
		$email_ck=" select * from users  where Email='$email' ";
		
	
			
		if($this->db->select($email_ck)->num_rows > 0) $_SESSION['dbl_email']="Email already exists !"; 
		else{
			
			$in="insert into users(Fname,Lname,Email,Password,Country,Gender,Birthdate) values('$fname','$lname','$email','$password','$country','$gender','$birthdate')";	
			
	        $run=$this->db->insert($in);
		
	    if($run == true) { 
		
		$_SESSION['signup']="Registration Successfull !";
		$_SESSION['hash']=$password;
		header('location:signup.php');
		exit;
		}
		
			
		}
		
		}
	
	}
	
	
	
	
	
	
	
	public function login($log){
		
		$email=$log['email'];
		$password=$log['password'];
		
		$sel="select * from users where Email='$email'";
		$run=$this->db->select($sel);
		$row=$run->fetch_assoc();
		
		
		if($run->num_rows >0){ 
			
			if(password_verify($password,$row['Password']) || $password==$row['Password'] ){
				
				
				if($log['remember']==1){
					setcookie('user_email',$email,time()+(86400)*30,'/');
					setcookie('user_password',$password,time()+(86400)*30,'/');
					
				}
				
				
				$_SESSION['user_login']="You are logged in!";
				$_SESSION['user_id']=$row['ID'];
				
				setcookie('user_login','logged',time()+(86400*30),'/');
				setcookie('user_name',$row['Name'],time()+(86400*30),'/');
				setcookie('user_id',$row['ID'],time()+(86400*30),'/');
				
				header('location:inside/home.php'); exit;
				
			}
			else { $_SESSION['wp']="Wrong Password"; $_SESSION['user_email']="$email"; }
		}
		else
		$_SESSION['we']="Invalid Email or Password";
		
	}
	
	
	

	
	
public function post($var,$share_id){ 
	
	if(!isset($var['content'])){
		$share_post_id=$share_id; 
	 $sel="select * from posts where post_id='$share_post_id' ";  $run=$this->db->select($sel); $row=$run->fetch_assoc();
    
		$user_id=$row['user_id'];
	    $content=$row['content'];
		    $content=$this->db->escape($content);
	    $likes=$row['likes'];
	    $shares=$row['shares'];
	    $post_date=$row['post_date'];
	    $post_image=$row['image'];
	    $share_ck=$_COOKIE['user_id'];
		
  $in="insert into posts(user_id,content,image,share_ck,shares,post_date) 
  values('$user_id','$content','$post_image','$share_ck','$shares','$post_date')";
		
		 $run=$this->db->insert($in);
	    if($run == true) { 
		echo $_SESSION['post']="Post Successfull !";  header('location:home.php'); exit;
		}
		
	}
	
	else{
	
	$user_id=$_COOKIE['user_id'];
	$content=$var['content'];
	     $content=$this->db->escape($content);
	$post_image=$_FILES['post_image']['name'];
	
	
	if($post_image=='')
                 $in="insert into posts(user_id,content) values('$user_id','$content')";
    
	else 	{ $in="insert into posts(user_id,content,image) values('$user_id','$content','$post_image')";
                  move_uploaded_file($_FILES['post_image']['tmp_name'], 'p_images/'.$post_image); }
		   
			
	        $run=$this->db->insert($in);
		
	    if($run == true) { 
		
		echo $_SESSION['post']="Post Successfull !";
	 header('location:home.php'); exit;
		}
		}

		
		}
	
	
	
	
	
public function editinfo($var){ 	
		
		$fname=$var['fname'];
		$lname=$var['lname'];
		$o_password=$var['o_password'];
		$n_password=password_hash($var['n_password'],PASSWORD_DEFAULT);
		$country=$var['country'];
		$gender=$var['gender'];
		$r_status=$var['r_status'];
	    $birthdate= $var['birthdate'];
	    $email= $var['email'];
	
	
//print_r($var);		
		
		$email_ck=" select * from users  where Email='$email' ";
			
		if($this->db->select($email_ck)->num_rows > 0) { $pass_ck=$this->db->select($email_ck)->fetch_assoc();  	
		
		
		  if( empty($o_password)) {
			  
			  
	   $up="update users set
	   Fname='$fname',Lname='$lname',R_status='$r_status',Country='$country',Gender='$gender',Birthdate='$birthdate'
                  where Email='$email'	";
	
			
	        $run=$this->db->update($up);
		
	    if($run == true) { 
		
		$_SESSION['save_info']="Profile Updated !";
		
		header('location:account.php');
		exit;
		}
			  
		  }
		
		
		
         elseif( password_verify($o_password, $pass_ck['Password'] ) ) {

			$up="update users set
	Fname='$fname',Lname='$lname',R_status='$r_status',Password='$n_password',Country='$country',Gender='$gender',Birthdate='$birthdate'
                  where Email='$email'	";
	
			
	        $run=$this->db->update($up);
		
	    if($run == true) { 
		
		$_SESSION['save_info']="Profile Updated !";
		
		header('location:account.php');
		exit;
		}
		
			
		}
		
		else $_SESSION['pass_wrong']='<b class="text-danger">Wrong Password !</b> ';
		
		
	
	}
	
}







}

$all=new Complete();

?>