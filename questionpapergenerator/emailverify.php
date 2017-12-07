<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
 $reg_user->redirect('home.php');
}


if(isset($_POST['submit1']))
{
 $fname = trim($_POST['fname']);
 $lname = trim($_POST['lname']);
 $email = trim($_POST['email']);
 $pass = trim($_POST['password']);
 $code = md5(uniqid(rand()));
 $name = $fname.' '.$lname;
 echo "as34ad";
  if($reg_user->register($name,$email,$pass,$code))
  {    
   
   $message = "     
      Hello $name,
      <br /><br />
      Welcome to Question paper Generator<br/>
      Your code for registration is <br/>
      <h1><b>$code</b></h1>
      <br /><br />
     
      Thanks,";
      
   $subject = "Verify Email";
      
   $reg_user->send_mail($email,$message,$subject); 
    $msg = "
     <div class='alert alert-success'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>Success!</strong>  We've sent the code to $email.
                    Please Enter the code below . 
       </div>
     ";
     echo "Success";
  }
  else
  {
   echo "sorry , Registration is Unsuccessfull, Try once again";
  }  
 
}
?>