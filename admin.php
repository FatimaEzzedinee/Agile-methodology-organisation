<?php
require("functions.php");
?>
						
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Logistica</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	</head>
	<body>
	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
			<h1 id="colorlib-logo"><a href="index.php">Logistica</a></h1>
			<nav id="colorlib-main-menu" role="navigation">
				<ul>
					<li class="colorlib-active"><a href="index.php">Home</a></li>
					<li><a href="admin.php?pg=c">Add coach</a></li>
					<li><a href="admin.php?pg=acc">Create Account</a></li>
					<li><a href="admin.php?pg=f">Create Form</a></li>
					<li><a href="admin.php?pg=sf">Send Form</a></li>
					<li><a href="admin.php?pg=pend">Who haven't submitted yet</a></li>
					<li><a href="admin.php?pg=chart">Charts Analysis </a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>
			<div class="colorlib-footer">
				<ul>
					<li><a href="#"><i class="icon-facebook2"></i></a></li>
					<li><a href="#"><i class="icon-twitter2"></i></a></li>
					<li><a href="#"><i class="icon-instagram"></i></a></li>
					<li><a href="#"><i class="icon-linkedin2"></i></a></li>
				</ul>
			</div>
		</aside>
		<div id="colorlib-main">
			<div class="col-md-6">
					
							<?php
							$conn=DBConn();
							echo"<div class='desc'>
									<h1 class=\"colorlib-heading\">Hello Admin: ".$_SESSION['username']." !! </h1>";
							echo "</div>";




						if(isset($_GET['pg'])){

							if($_GET['pg']=='chart')
							{
								 $q="Select * from form_question";
								 $stmt=$conn->prepare($q);
                  				 $stmt->execute();
                   				 $all=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

								echo"<form method='get' action='pChart2.0-for-PHP7-master/examples/MyRadar.php'>";
                   				 echo "<select name='chart'>";
                   				 foreach ($all as $key => $value) {
                   				 	# code...

                   				 	$q="Select * from project where IdProject='".$value['ProjetId']."'";
                   				 	$stmt=$conn->prepare($q);
                  				    $stmt->execute();
                  				    $v=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                   				 	echo"<option value='".$value['IdForm']."'>"."Form ID :".$value['IdForm']." on the Project ".$v['0']['Title']."</option>";
                   				        }

                   				        echo"</select>";
						echo"<br><br><input type='submit' Name='Schart' class='btn btn-primary btn-send-message' value='See Chart!'>";
							}


							if($_GET['pg']=='pend')
							{

								 $q="SELECT * from pending";
								 $stmt=$conn->prepare($q);
                  				 $stmt->execute();
                   				 $pending=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
									echo"<table border='5'>";
									echo"<tr><th><h2>User</h2></th><th><h2>Form Id</h2></th></tr>";
									foreach ($pending as $key => $value) {
									# code...
										echo"<tr><td><h3>".$value['Username']."</h3></td><td><h3>".$value['idForm']."</h3></td></tr>";

									}

								echo "</table>";


							}


							if ($_GET['pg']=='f'){
													
							echo "<br><h2>To create a form Please fill this form : </h2>";
							echo "<form method='get'>";
							echo "Question 1 <input type='text' class='form-control' placeholder='Question' Name='Q1' style=\"background-color: #fdd017;\">
							 Question 2<input type='text' class='form-control' placeholder='Question' Name='Q2' style=\"background-color: #fdd017;\">
							 Question 3<input type='text' class='form-control' placeholder='Question' Name='Q3' style=\"background-color: #fdd017;\">
							 Question 4<input type='text' class='form-control' placeholder='Question' Name='Q4' style=\"background-color: #fdd017;\">
							 Question 5<input type='text' class='form-control' placeholder='Question' Name='Q5' style=\"background-color: #fdd017;\">
							 Question 6<input type='text' class='form-control' placeholder='Question' Name='Q6' style=\"background-color: #fdd017;\">
							 Question 7<input type='text' class='form-control' placeholder='Question' Name='Q7' style=\"background-color: #fdd017;\">
							 Question 8<input type='text' class='form-control' placeholder='Question' Name='Q8' style=\"background-color: #fdd017;\">
							 Question 9<input type='text' class='form-control' placeholder='Question' Name='Q9' style=\"background-color: #fdd017;\">
							 Question 10<input type='text' class='form-control' placeholder='Question' Name='Q10' style=\"background-color: #fdd017;\">
							 ";


                   $f ="Select * from project";
				   $stmt=$conn->prepare($f);
                   $stmt->execute();
                   $scrums=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
 echo"<h2>Project Topics :</h2> <center><select name='pro'></center>";
						foreach ($scrums as $key => $value) {
                           	# code...
                           	echo"<option value='".$value['IdProject']."'>".$value['Title']."</option>";
                             }
                             echo"</select>";

							echo"<br><br><input type='submit' Name='createForm' class='btn btn-primary btn-send-message' value='Create Form'>";
							
//echo"</form>";
}


if ($_GET['pg']=='sf'){
echo "<form method='get'>";
							echo"<h1> Do you want to send a question form ?</h1>";
                            echo"<center><h2>   Select a Team :</h2></center>";
                            $conn=DBConn();
                            $q="Select * from team";
                            $stmt=$conn->prepare($q);
                            $stmt->execute();
                            $teams=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            echo"<br><center><select name='teams'></center>";
                            foreach ($teams as $key => $value) {
                           	# code...
                           	echo"<option value='".$value['IdTeam']."'>".$value['TeamName']."</option>";
                           }
                             echo"</select>";

                   $f ="Select * from form_question";
				   $stmt=$conn->prepare($f);
                   $stmt->execute();
                   $forms=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                   echo"<h2>   Select a Form :</h2>";
 					echo"<center><select name='forms'></center>";
						foreach ($forms as $key => $value) {
                           	# code...
                           	echo"<option value='".$value['IdForm']."'>".$value['IdForm']."</option>";
                           }
                            echo"</select>";

     echo"<br><br><input type='submit' Name='SendMails' class='btn btn-primary btn-send-message' value='Send Mails to this team'>";
                  

                 
//echo "</form>";
}





if($_GET['pg']=='acc')
{
	echo"<div class='desc'>
									<h2>If you want to add an account please fill this form </h2>";
									echo "<form method='get' action=''>";
									echo "<h3> Enter the username</h3>";
									echo"<input type='text'  class='form-control' placeholder='Name' Name='Name' style=\"background-color: #fdd017;\"><br>";
									echo"<h3>Enter the password</h3>";
									echo"<input type='password'  class='form-control' placeholder='password' Name='password' style=\"background-color: #fdd017;\"><br>";
									echo"<h3>Confirm your password</h3>";
									echo"<input type='text' class='form-control' placeholder='Password Confirmation' Name='conf' style=\"background-color: #fdd017;\"><br>";
									echo"<h3>This employee type </h3>";
									echo"<select class='form-control' name='type2' style=\"background-color: #fdd017;\">";
									echo"<option class='form-control'value='admin'>admin</option>";
									echo"<option class='form-control' value='developper'>developper</option>";
									echo"<option class='form-control' value='owner'>owner</option>";
									echo"<option  class='form-control'value='scrum'>scrum</option>";
									echo"<option class='form-control' value='coach'>coach</option></select><br><br>";
							echo"<input type='submit' Name='create' class='btn btn-primary btn-send-message' value='Create'>";
}


if ($_GET['pg']=='c'){

echo "<form method='get'>";
echo "<br><br><br><h1>Add a coach ?</h1> ";
echo "<br><input type='text' class='form-control' placeholder='Coach Name ' Name='CName' style=\"background-color: #fdd017;\">";
echo "<br><input type='text' class='form-control' placeholder='Coach Salary ' Name='CSalaire' style=\"background-color: #fdd017;\">";
echo "<br><input type='text' class='form-control' placeholder='Coach Email ' Name='CEmail' style=\"background-color: #fdd017;\">";
echo "<br><input type='text' class='form-control' placeholder='Coach Specialite ' Name='CSpec' style=\"background-color: #fdd017;\">";
echo "<br><input type='text' class='form-control' placeholder='Username ' Name='us' style=\"background-color: #fdd017;\">";

echo"<br><br><input type='submit' Name='AddCoach' class='btn btn-primary btn-send-message' value='Add Coach'>";

//echo"</form>";
}
}


if(isset($_GET['create']))
							{
								$user=$_GET['Name'];
								$p=$_GET['password'];
								$conf=$_GET['conf'];

								if($p!=$conf)
									echo "<h1>Password Confirmation Failed</h1>";
								else{
									//$conn=DBConn();
							        $query="Insert into onlineaccount values(?,?,?)";
							        $stmt=$conn->prepare($query);
							        $stmt->bind_param("sss",$user,$p,$_GET['type2']);
							        $stmt->execute();
								}

							}
							
if(isset($_GET['createForm']))
							{
								$conn=DBConn();
								$query="Insert into form_question(Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,Q9,Q10,ProjetId)values(?,?,?,?,?,?,?,?,?,?,?)";
								$stmt=$conn->prepare($query);
								$stmt->bind_param("ssssssssssi",$_GET['Q1'],$_GET['Q2'],$_GET['Q3'],$_GET['Q4'],$_GET['Q5'],$_GET['Q6'],$_GET['Q7'],$_GET['Q8'],$_GET['Q9'],$_GET['Q10'],$_GET['pro']);
								$stmt->execute();
							}


if(isset($_GET['AddCoach']))
{
	if (userExist($_GET['us']))
	{
		echo "UserName already exists!";
	}
	else{
		$f ="INSERT Into onlineaccount(Username,Password,Type) values ('".$_GET['us']."','123','coach')";
		$stmt=$conn->prepare($f);
        $stmt->execute();
		$message = "Hello Coach! your Account has been activated, Change your Password! (use ".$_GET['us']." as username and 123 as temporary Password)";
        SendMail($message,$_GET['CEmail'] );
		$qd="insert into coach(Nom,Salaire,Email,Specialite,Username) values (?,?,?,?,?)";
		$stmt=$conn->prepare($qd);
		$stmt->bind_param("sisss",$_GET['CName'],$_GET['CSalaire'],$_GET['CEmail'],$_GET['CSpec'],$_GET['us']);
		$stmt->execute();
	}
}




 if(isset($_GET['SendMails'])){
                   $q="Select * from team where IdTeam='".$_GET['teams']."'";
                   $stmt=$conn->prepare($q);
                   $stmt->execute();
                   $arr=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);


                   $owner=$arr['0']['OwnerId'];
                   $coach=$arr['0']['CoachId'];
                   $scrum=$arr['0']['IdTeam'];

                   $id=$_GET['forms'];
                   $devsQuery="Select * from developper where IdTeam='".$scrum."'";
                   $stmt=$conn->prepare($devsQuery);
                   $stmt->execute();

				   $developpers=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

				   $message="Go check you account, you have new Form to submit";
				   foreach ($developpers as $key => $value) {
				   	# code...
				   	
					SendMail($message,$value['email']);

					$q="INSERT INTO pending values('".$id."','".$value['IdAccount']."')";
					$stmt=$conn->prepare($q);
                    $stmt->execute();

                  }

                   $q="Select * from owner where Username='".$owner."'";
                   $stmt=$conn->prepare($q);
                   $stmt->execute();
                   $arr=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
				   

                   if(count($arr)!=0)
                  SendMail($message,$arr['0']['Email']);
                    $q="INSERT INTO pending values('".$id."','".$owner."')";
					$stmt=$conn->prepare($q);
                    $stmt->execute();


                   $q="Select * from coach where CochId='".$coach."'";
                   $stmt=$conn->prepare($q);
                   $stmt->execute();
                   $arr=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if(count($arr)!=0){
                    $q="INSERT INTO pending values('".$id."','".$arr['0']['Username']."')";
					$stmt=$conn->prepare($q);
                    $stmt->execute();
                    SendMail($message,$arr['0']['Email']);
                }
              } 


?>


			
		

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Sticky Kit -->
	<script src="js/sticky-kit.min.js"></script>
	<!-- Owl carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Counters -->
	<script src="js/jquery.countTo.js"></script>	
	<!-- MAIN JS -->
	<script src="js/main.js"></script>
</body>
</html>