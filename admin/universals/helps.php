<?php 


Class format{
	
	 public function formatDate($date){
     return date('F j, Y, g:i a', strtotime($date));
    }
 
 
	public function seemore($content, $limit){
		
		$content= substr($content, 0, $limit);
		$content= substr($content, 0, strrpos($content, ' '));
		$content=$content.'...';
		return $content;
		
	}
	
	
	public function validation($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
   return $data;
         }

 public function title(){
  $path = $_SERVER['SCRIPT_FILENAME'];
  $title = basename($path, '.php');
  //$title = str_replace('_', ' ', $title);
  if ($title == 'index') {
   $title = 'home';
  }elseif ($title == 'contact') {
   $title = 'contact';
  }
  return $title = ucfirst($title);
   }
	
	
}




?>