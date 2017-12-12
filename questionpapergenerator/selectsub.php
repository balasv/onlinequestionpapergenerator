<?php
    require_once 'dbconnect.php';
    //session_start();
    $database = new Database();
    $db = $database->dbConnection(); 
    $cid = $_SESSION['customerSession']; 
    $value_result = $db->prepare("SELECT * FROM subject WHERE custid = '".$cid. "'");
    $value_result->execute();
    $value = $value_result->fetchAll();
    
?>