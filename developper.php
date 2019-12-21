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
					<li><a href="developper.php?pg=c">See my messages</a></li>
					<li><a href="developper.php?pg=acc">Get Informations</a></li>
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

							$f ="SELECT * from developper where IdAccount='".$_SESSION['username']."'";
							$stmt=$conn->prepare($f);
							$stmt->execute();
							$myDev=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
							$Dev=$myDev['0']['IdDevelopper'];

							echo"<div class='desc'>
							<h1 class=\"colorlib-heading\">Hello Developper: ".$_SESSION['username']." !! </h1>";

							echo "</div>";

if(isset($_GET['pg']))
{
	if($_GET['pg']=='c')
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

if($_GET['pg']=='acc')
{


			echo"<form method='get'>";
	            echo "<br><h2>Online Account Username : ".$_SESSION['username']."</h2>";
	            echo "<br><h2>Name : </h2><input type='text'  class='form-control' placeholder='Name' Name='NewName' style=\"background-color: #fdd017;\" value='".$myDev['0']['Name']."'>";
            	echo"<br><input type='submit' Name='chN' class='btn btn-primary btn-send-message' value='Change Name'>";
	            echo "<br><br><h2>Email:</h2><input type='text'  class='form-control' placeholder='Email' Name='Nass' style=\"background-color: #fdd017;\" value='".$myDev['0']['email']."'>";
            	echo"<br><input type='submit' Name='chEm' class='btn btn-primary btn-send-message' value='Change Email'>";
	            echo "<br><br><br><h2>Change your acoount password ?<br> ";
	            echo"<br><input type='password'  class='form-control' placeholder='Old password' Name='Opass' style=\"background-color: #fdd017;\">";
	            echo"<br><input type='password'  class='form-control' placeholder='New password' Name='Npass' style=\"background-color: #fdd017;\">";
 			    echo"<br><input type='password'  class='form-control' placeholder='Confirm password' Name='Cpass' style=\"background-color: #fdd017;\"><br>";
				echo"<br><br><input type='submit' Name='Sub' class='btn btn-primary btn-send-message' value='Change password'></h2>";
}

}

if(isset($_GET['chEm']))
			{
			$em=$_GET["Nass"];
			$q="UPDATE developper set email='".$em."' where IdAccount='".$_SESSION['username']."'";
			$stmt=$conn->prepare($q);
	        $stmt->execute();
	        header('Location:developper.php');
	    }

if(isset($_GET['chN']))
			{
			$name=$_GET["NewName"];
			$q="UPDATE developper set Name='".$name."' where IdAccount='".$_SESSION['username']."'";
			$stmt=$conn->prepare($q);
	        $stmt->execute();
	        header('Location:developper.php');
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