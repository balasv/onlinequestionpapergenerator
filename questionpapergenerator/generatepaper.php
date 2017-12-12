<?php
require_once 'vendor/autoload.php';
session_start();
require_once 'class.user.php';
$user = new USER();
if(!$user->is_logged_in())
{
 $user->redirect('index.php');
}
if(isset($_POST['submit']))
{
    
}

?>