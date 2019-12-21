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
					<li><a href="scrum.php?pg=dev">Developper Management</a></li>
					<li><a href="scrum.php?pg=cp">Create Project</a></li>
					<li><a href="scrum.php?pg=up">Update Project</a></li>
					<li><a href="scrum.php?pg=ed">Edit infos</a></li>
					<li><a href="scrum.php?pg=cff">See pending forms</a></li>
					<li><a href="scrum.php?pg=teams">My team</a></li>
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

	$f ="SELECT * from scrum where IdAccount='".$_SESSION['username']."'";
	$stmt=$conn->prepare($f);
	$stmt->execute();
	$myScrum=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	$Scrum=$myScrum['0']['IdScrum'];

		echo"<div class='desc'>
									<h1 class=\"colorlib-heading\">Hello Scrum: ".$_SESSION['username']." !! </h1>";
							echo "</div>";							
	if (isset($_GET['pg']))
	{

echo"<form method='get'>";
		if($_GET['pg']=='cp')
			{
              $idteam='0';
              $payed='0';
              echo "<input type='text' class='form-control' placeholder='Project Name ' Name='PN' style=\"background-color: #fdd017;\">";

              echo "<input type='number' class='form-control' placeholder='Project price' Name='PP' style=\"background-color: #fdd017;\">";

              echo "<input type='text' class='form-control' placeholder='Project owner' Name='PO' style=\"background-color: #fdd017;\">";


         echo"<br><br><br><center><input type='submit' Name='AP' class='btn btn-primary btn-send-message' value=' Add this project'></center>";
			}

		if($_GET['pg']=='teams')
			{
            
            echo "<h1>Coach : ".$myScrum['0']['IdCoach']."</h1>";

            $q="SELECT * from team where ScrumId='".$Scrum."'";
            $stmt=$conn->prepare($q);
			$stmt->execute();
			$myTeam=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

			$idTeam=$myTeam['0']['IdTeam'];
			$tname=$myTeam['0']['TeamName'];
			echo "<h1>My team Name :".$tname."</h1>";

			echo"<br><h2>My team Developpers:<br></h2><h3>";
			$q="Select * from developper where IdTeam='".$idTeam."'";
			$stmt=$conn->prepare($q);
			$stmt->execute();
			$devs=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			echo "<table class=\"colorlib-lead\" border=2 style='text-align: center;'><tr style='background-color: #fdd017;'><th width=300><center>Name</center></th><th width=500><center>Email</center></th></tr>";
			foreach ($devs as $key => $value) {
				# code...
				echo "<tr><td>".$value['Name']."</td><td>".$value['email']."</td></tr>";
			}

			echo "</table></h3>";



		    }
			if($_GET['pg']=='dev')
			{
					
				echo "<form method='get'>";
				echo "<br><br><h1>Add a developper ?</h1> ";
				//echo "<input type='text' class='form-control' placeholder='Developper Name ' Name='DName' style=\"background-color: #fdd017;\">";
				echo "<input type='text' class='form-control' placeholder='Developper Salary' Name='DSalaire' style='background-color: #fdd017;'>";
				echo "<input type='text' class='form-control' placeholder='Developper Email ' Name='DEmail' style=\"background-color: #fdd017;\">";
				echo "<input type='text' class='form-control' placeholder='Developper Username ' Name='Duser' style=\"background-color: #fdd017;\">";


				echo"<br><br><br><center><input type='submit' Name='AddDev' class='btn btn-primary btn-send-message' value=' Add this developper'></center>";

			}

			if ($_GET['pg']=='up'){

				$f ="SELECT * from project";
				$stmt=$conn->prepare($f);
	            $stmt->execute();
	            $projects=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			
						//echo"<form method='get'>";
				foreach ($projects as $k => $v) {
					
					$f ="SELECT * from team where IdTeam='".$v['IdTeam']."'";
					$stmt=$conn->prepare($f);
	            	$stmt->execute();
	            	$team=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

	            	$scrum=$team['0']['ScrumId'];

	            	if ($scrum=$Scrum) {

	            		echo"<form method ='get'>";
	            		echo "<h2>".$v['Title']."</h2><br>";
	            		echo "<input type='checkbox' name='".$v['IdProject']."1' value='1'";
	            		if ($v['Req']==1)
	            			echo "checked='checked'";
	            		echo "> Requirement<br>";
	            		echo "<input type='checkbox' name='".$v['IdProject']."2' value='2'";
	            		if ($v['Design']==1)
	            			echo "checked='checked'";
	            		echo "> Design<br>";
	            		echo "<input type='checkbox' name='".$v['IdProject']."3' value='3'";
	            		if ($v['Imp1']==1)
	            			echo "checked='checked'";
	            		echo "> Implementation 1<br>";	
	            		echo "<input type='checkbox' name='".$v['IdProject']."4'  value='4'";
	            		if ($v['Imp2']==1)
	            			echo "checked='checked'";
	            		echo "> Implementation 2<br>";
	            		echo "<input type='checkbox' name='".$v['IdProject']."5' value='5'";
	            		if ($v['Imp3']==1)
	            			echo "checked='checked'";
	            		echo "> Implementation 3<br>";
	            		echo "<input type='checkbox' name='".$v['IdProject']."6' value='6'";
	            		if ($v['Releasee']==1)
	            			echo "checked='checked'";
	            		echo "> Release <br>";
	            		echo "<br><br><center><input type='submit' Name='".$v['IdProject']."' class='btn btn-primary btn-send-message' value='Update'></center><br><br>";

	            	}

				}
				echo "</form>";

			}

if($_GET['pg']=='cff')
	{
$q="SELECT * FROM pending where Username='".$_SESSION['username']."'";
$stmt=$conn->prepare($q);
$stmt->execute();
$forms=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

if(count($forms)==0)
	echo"<h1>No new Messages</h1>";
else{
	echo"<table border='4'>";
	echo"<tr><td><h1>My Forms</h1></td></tr>";
foreach($forms as $key => $value){
echo"<tr><td><h1><a href='form.php?idform=".$value['idForm']."&iduser=".$_SESSION['username']."'>Go and submit form with the id :=".$value['idForm']."</a></h1></td></tr>";
}
}
}

			if ($_GET['pg']=='ed'){

				echo"<form method='get'>";
	            echo "<br><h2>Online Account Username : ".$_SESSION['username']."</h2>";
	            echo "<br><h2>Name : </h2><input type='text'  class='form-control' placeholder='Name' Name='NewName' style=\"background-color: #fdd017;\" value='".$myScrum['0']['Name']."'>";
            	echo"<br><input type='submit' Name='chN' class='btn btn-primary btn-send-message' value='Change Name'>";
	            echo "<br><br><h2>Email:</h2><input type='text'  class='form-control' placeholder='Email' Name='Nass' style=\"background-color: #fdd017;\" value='".$myScrum['0']['Email']."'>";
            	echo"<br><input type='submit' Name='chEm' class='btn btn-primary btn-send-message' value='Change Email'>";
	            echo "<br><br><br><h2>Change your acoount password ?<br> ";
	            echo"<br><input type='password'  class='form-control' placeholder='Old password' Name='Opass' style=\"background-color: #fdd017;\">";
	            echo"<br><input type='password'  class='form-control' placeholder='New password' Name='Npass' style=\"background-color: #fdd017;\">";
 			    echo"<br><input type='password'  class='form-control' placeholder='Confirm password' Name='Cpass' style=\"background-color: #fdd017;\"><br>";
				echo"<br><br><input type='submit' Name='Sub' class='btn btn-primary btn-send-message' value='Change password'></h2>";

			}
}

if(isset($_GET['AP']))
{
	$name=$_GET['PN'];
	$p=$_GET['PP'];
	$po=$_GET['PO'];

			$q="INSERT INTO project(IdTeam,Title,payed,TotalPrice,IdOwner,Req,Design,Imp1,Imp2,Imp3,Releasee)values('0',?,'0',?,?,'0','0','0','0','0','0')";
			$stmt=$conn->prepare($q);
			$stmt->bind_param("sis",$name,$p,$po);
	        $stmt->execute();
}

if(isset($_GET['chEm']))
			{
			$em=$_GET["Nass"];
			$q="UPDATE scrum set Email='".$em."' where IdAccount='".$_SESSION['username']."'";
			$stmt=$conn->prepare($q);
	        $stmt->execute();
	        header('Location:scrum.php');
	    }

if(isset($_GET['chN']))
			{
			$name=$_GET["NewName"];
			$q="UPDATE scrum set Name='".$name."' where IdAccount='".$_SESSION['username']."'";
			$stmt=$conn->prepare($q);
	        $stmt->execute();
	        header('Location:scrum.php');
	    }


if(isset($_GET['Sub']))
	        {
	        	$old=$_GET['Opass'];
	        	$new=$_GET["Npass"];
	        	$conf=$_GET['Cpass'];

	        	$q="Select * from onlineaccount where Username='".$_SESSION['username']."'and Password='".$old."'";
	        	$stmt=$conn->prepare($q);
	            $stmt->execute();
	            $p=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

	            if(count($p)==0 || $new!=$conf)
	            {
					echo"<h1 style='color:red'>Wrong informations about Password</h1>";
	            }

	            else{
	            	$q="UPDATE onlineaccount set Password='".$new."'where Username='".$_SESSION['username']."'";
	            	$stmt=$conn->prepare($q);
	            	$stmt->execute();
	            	echo "password changed";
	                }

	        }


				$f ="SELECT * from project";
				$stmt=$conn->prepare($f);
	            $stmt->execute();
	            $projects=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			

				foreach ($projects as $k => $v) {
					
	            		if (isset($_GET[$v['IdProject']])){

	            			if (isset($_GET[$v['IdProject'].'1']))
	            				$q1=1;
	            				else $q1=0;
	            			if (isset($_GET[$v['IdProject'].'2']))
	            				$q2=1;
	            				else $q2=0;
	            			if (isset($_GET[$v['IdProject'].'3']))
	            				$q3=1;
	            				else $q3=0;
	            			if (isset($_GET[$v['IdProject'].'4']))
	            				$q4=1;
	            				else $q4=0;
	            			if (isset($_GET[$v['IdProject'].'5']))
	            				$q5=1;
	            				else $q5=0;
	            			if (isset($_GET[$v['IdProject'].'6']))
	            				$q6=1;
	            				else $q6=0;

		            		$f ="UPDATE project SET Req='".$q1."' WHERE IdProject='".$v['IdProject']."'";
							$stmt=$conn->prepare($f);
		            		$stmt->execute();
		            		$f ="UPDATE project SET Design='".$q2."' WHERE IdProject='".$v['IdProject']."'";
							$stmt=$conn->prepare($f);
		            		$stmt->execute();

		            		$f ="UPDATE project SET Imp1='".$q3."' WHERE IdProject='".$v['IdProject']."'";
							$stmt=$conn->prepare($f);
		            		$stmt->execute();

		            		$f ="UPDATE project SET Imp2='".$q4."' WHERE IdProject='".$v['IdProject']."'";
							$stmt=$conn->prepare($f);
		            		$stmt->execute();

		            		$f ="UPDATE project SET Imp3='".$q5."' WHERE IdProject='".$v['IdProject']."'";
							$stmt=$conn->prepare($f);
		            		$stmt->execute();

		            		$f ="UPDATE project SET Releasee='".$q6."' WHERE IdProject='".$v['IdProject']."'";
							$stmt=$conn->prepare($f);
		            		$stmt->execute();

		            		header('Location:scrum.php?pg=up');
	            	}
				}


if(isset($_GET['AddDev']))
{

					   $f ="SELECT * from scrum where IdAccount='".$_SESSION['username']."'";
					   $stmt=$conn->prepare($f);
	                   $stmt->execute();
	                   $scrums=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	                   $scrumid=$scrums['0']['IdScrum'];
	                   $f ="Select * from team where ScrumId='".$scrumid."'";
					   $stmt=$conn->prepare($f);
	                   $stmt->execute();
	                   $scrums=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	                   $idteam=$scrums['0']['IdTeam'];
				if (userExist($_GET['Duser']))
					{
						echo "UserName already exists!";
					}
					else{
						$f ="INSERT Into onlineaccount(Username,Password,Type) values ('".$_GET['Duser']."','123','developper')";
						$stmt=$conn->prepare($f);
				        $stmt->execute();
				        $message = "hello Developper! your Account has been activated, Change your Password! (use ".$_GET['Duser']." as username and 123 as temporary Password)";
				        SendMail($message, $_GET['DEmail'] );
						$qd="INSERT into developper(IdAccount,Salaire,email,IdTeam,Name)values(?,?,?,?,?)";
						$stmt=$conn->prepare($qd);
						$nom="new";
						$stmt->bind_param("sisis",$_GET['Duser'],$_GET['DSalaire'],$_GET['DEmail'],$idteam,$nom);
						$stmt->execute();
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