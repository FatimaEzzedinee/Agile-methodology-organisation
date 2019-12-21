<?php
session_start();
require 'PHPMailer-master/PHPMailerAutoload.php';
function DBConn()
{
	$server="localhost";
	$username="root";
	$pass="";
	$db="php_project";

$mysqli_connect= new mysqli($server,$username,$pass,$db);

	if($mysqli_connect->connect_error){
   exit('Error in connection');}

   return $mysqli_connect;
}


function SendMail($message,$receiver){
$mail=new PHPMailer();
$mail->Host="smtp.gmail.com";
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Username = "projetphp71@gmail.com";
$mail->Password =  "PROJETPHP7199";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->Subject = ("Mail from work");
$mail->Body = ($message);
$mail->setFrom('flakkis1212@gmail.com','Fatu');
$mail->addAddress($receiver);

if($mail->send())
echo "Sent ";

else echo"Not sent";
}

function userExist($user){
       $conn=DBConn();
 
		    $f ="Select * from onlineaccount WHERE Username='".$user."'";
		    $stmt=$conn->prepare($f);
        $stmt->execute();
        $scrums=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($scrums)==0)
        	return false;
        else return true;

}

?>