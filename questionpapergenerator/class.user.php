<?php
require_once 'dbconnect.php';

class USER
{ 

 private $conn;
 
 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }
 
 public function runQuery($sql)
 {
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }
  public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }
    public function register($name,$email,$pass,$code) //preparing and inserting registration
    {
        try
        {
            $password = md5($pass);
            
            $stmt = $this->conn->prepare("INSERT INTO customer(name,email,pass,tokencode)
                                                VALUES(:name, :email, :pass, :code)");

            $stmt->bindparam(":name",$name); 
            $stmt->bindparam(":email",$email);
            $stmt->bindparam(":pass",$password);
            $stmt->bindparam(":code",$code);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
 public function login($email,$pass)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM customer WHERE email=:email");
   $stmt->execute(array(":email"=>$email));
   $customerRow=$stmt->fetch(PDO::FETCH_ASSOC);
   if($stmt->rowCount() > 0)
   {
    if($customerRow['status']=="Y")
    {
     if($customerRow['pass']==md5($pass))
     {
      $_SESSION['customerSession'] = $customerRow['custid'];
      
      return true;
     }
     else
     {
      echo '<script type="text/javascript">'; 
      echo "alert('Wrong email or password');"; 
      echo '</script>';
      exit;
     }
    }
    else
    {
    header("Location: login.php?inactive");
     exit;
    } 
   }
   else
   {
    header("Location: login.php?error2");
    exit;
   }  
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 
 public function is_logged_in()
 {
  if(isset($_SESSION['customerSession']))
  {
   return true;
  }
 }
 public function getvalue($select,$tablename,$colname,$colvalue){
  $value_result = $this->$conn->prepare("SELECT ".$select." FROM ".$tablename." WHERE ".$colname." = '".$colvalue. "'");
  $value_result->execute();
  $value = $value_result->fetch();
  return $value;
 }
  public function getvalueall($select,$tablename,$colname,$colvalue){
  $value_result = $this->$conn->prepare("SELECT ".$select." FROM ".$tablename." WHERE ".$colname." = '".$colvalue. "'");
  $value_result->execute();
  $value = $value_result->fetchAll();
  return $value;
 }
  public function deleteques($qno){ 
    $sql = "DELETE FROM question WHERE qno=".$qno."";
    $stmt = $this->conn->exec($sql);

 }
 public function addques($subno,$custid,$ques,$diff,$type,$marks){
  try
        { 
            $stmt = $this->conn->prepare("INSERT INTO question($subno,$custid,$ques,$diff,$type,$marks)
                                                VALUES(:subno, :custid, :ques, :diff, :type, :marks)");
            $stmt->bindparam(":subno",$subno); 
            $stmt->bindparam(":custid",$custid); 
            $stmt->bindparam(":ques",$ques);
            $stmt->bindparam(":diff",$diff);
            $stmt->bindparam(":type",$type);
            $stmt->bindparam(":marks",$marks);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
 }
 public function addsub($custid,$subname){
  try
        { 
            $stmt = $this->conn->prepare("INSERT INTO subject(custid,subname)
                                                VALUES(:custid, :subname)");
            $stmt->bindparam(":custid",$custid); 
            $stmt->bindparam(":subname",$subname);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
 }
  public function option($qno,$opt1,$opt2,$opt3,$opt4){
  try
        {
            $type='m';
            $stmt = $this->conn->prepare("INSERT INTO options($qno,$opt1)
                                                VALUES(:qno, :opt1)");
            $stmt = $this->conn->prepare("INSERT INTO options($qno,$opt2)
                                                VALUES(:qno, :opt2)");
            $stmt = $this->conn->prepare("INSERT INTO options($qno,$opt3)
                                                VALUES(:qno, :opt3)");
            $stmt = $this->conn->prepare("INSERT INTO options($qno,$opt3)
                                                VALUES(:qno, :opt3)");
              
            $stmt->bindparam(":qno",$qno);
            $stmt->bindparam(":opt1",$opt1);
            $stmt->bindparam(":opt2",$opt2);
            $stmt->bindparam(":opt3",$opt3);
            $stmt->bindparam(":opt4",$opt4);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
 }
 
 public function redirect($url)
 {
  header("Location: $url");
 }
 
 public function logout()
 {
  session_destroy();
  $_SESSION['customerSession'] = false;
 }
 
 function send_mail($email,$message,$subject)
 {      
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer();
  
  //Enable SMTP debugging.
  $mail->SMTPDebug = 1;
  //Set PHPMailer to use SMTP.
  $mail->isSMTP();
  //Set SMTP host name
  $mail->Host = "smtp.gmail.com";
  //Set this to true if SMTP host requires authentication to send email
  $mail->SMTPAuth = TRUE;
  //Provide username and password
  $mail->Username = "worldofbank@gmail.com";
  $mail->Password = "world@123";
  //If SMTP requires TLS encryption then set it
  $mail->SMTPSecure = "false";
  $mail->Port = 587;
  //Set TCP port to connect to
  
  $mail->From = "worldofbank@gmail.com";
  $mail->FromName = "World Bank";
  
  $mail->addAddress($email);
  
  $mail->isHTML(true);
 
  $mail->Subject = $subject;
  $mail->Body = $message;
  $mail->AltBody = $message;

  if(!$mail->send())
  { 
    ob_end_clean();
   echo "Mailer Error: " . $mail->ErrorInfo;
  }
  else
  {
    ob_end_clean();
  }
 } 
}