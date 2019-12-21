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
					<li><a href="owner.php?pg=p">My Projects</a></li>
					<li><a href="owner.php?pg=ed">Edit Infos</a></li>
					<li><a href="owner.php?pg=cff">See pending forms</a></li>
					<li><a href="owner.php?pg=py">Payement info</a></li>
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

	/*$f ="SELECT * from owner where IdAccount='".$_SESSION['username']."'";
	$stmt=$conn->prepare($f);
	$stmt->execute();
	$myOwner=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	$Owner=$myOwner['0']['Username'];*/

		echo"<div class='desc'>
				<h1 class=\"colorlib-heading\">Hello Owner: ".$_SESSION['username']." !! </h1>";
				

			if(isset($_GET['chEm']))
			{
			$em=$_GET["Nass"];
			$q="UPDATE owner set Email='".$em."'where Username='".$_SESSION['username']."'";
			$stmt=$conn->prepare($q);
	        $stmt->execute();
	        header('Location:owner.php');
	    }

	        if(isset($_GET['ha']))

	        {
	        $h=$_GET['happy'];
	        $q="UPDATE owner set happy='".$h."'where Username='".$_SESSION['username']."'";
			$stmt=$conn->prepare($q);
	        $stmt->execute();										
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
			
			echo "</div>";	
	if (isset($_GET['pg']))
	{
			if($_GET['pg']=='p')
			{

									
				$f ="SELECT * from project where IdOwner='".$_SESSION['username']."'";
				$stmt=$conn->prepare($f);
	            $stmt->execute();
	            $projects=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			
						//echo"<form method='get'>";
				foreach ($projects as $k => $v) {
					
	            		echo "<h2>".$v['Title']."</h2>";

	            		$f ="SELECT * from team where IdTeam='".$v['IdTeam']."'";
						$stmt=$conn->prepare($f);
			            $stmt->execute();
			            $team=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

	            		echo "<h3>Team in charge: ".$team['0']['TeamName']."</h3>";
	            		if ($v['Req']==1)
	            			echo "<img src='images/1.jpg' height='20' witdh='20'>";
	            			else echo "<img src='images/3.jpg' height='20' witdh='20'>";
	            		echo " Requirement<br>";
	            		if ($v['Design']==1)
	            			echo "<img src='images/1.jpg' height='20' witdh='20'>";
	            			else echo "<img src='images/3.jpg' height='20' witdh='20'>";
	            		echo " Design<br>";
	            		if ($v['Imp1']==1)
	            			echo "<img src='images/1.jpg' height='20' witdh='20'>";
	            			else echo "<img src='images/3.jpg' height='20' witdh='20'>";
	            		echo " Implementation 1<br>";	
	            		if ($v['Imp2']==1)
	            			echo "<img src='images/1.jpg' height='20' witdh='20'>";
	            			else echo "<img src='images/3.jpg' height='20' witdh='20'>";
	            		echo " Implementation 2<br>";
	            		if ($v['Imp3']==1)
	            			echo "<img src='images/1.jpg' height='20' witdh='20'>";
	            			else echo "<img src='images/3.jpg' height='20' witdh='20'>";
	            		echo " Implementation 3<br>";
	            		if ($v['Releasee']==1)
	            			echo "<img src='images/1.jpg' height='20' witdh='20'>";
	            			else echo "<img src='images/3.jpg' height='20' witdh='20'>";
	            		echo" Release <br>";
	            		echo "<br><br><br>";

	            	}

	       
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

	if ($_GET['pg']=='py')
	{
				$f ="SELECT * from project where IdOwner='".$_SESSION['username']."'";
				$stmt=$conn->prepare($f);
	            $stmt->execute();
	            $projects=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

	            foreach ($projects as $key => $value) {
	            	# code...
	            	echo "<form method='get'";
	            	echo $value['Title'];
	            	echo"<br><h2>You have payed : " .$value['payed']."</h2>";
	            	echo"<br><h2>Total : ".$value['TotalPrice']."</h2>";
	            	echo"<br><h2>Do you want to pay ?"."</h2>";
	            	echo "How much ? <input type='text' class='form-control' placeholder='$$' Name='". $value['IdProject']."'style=\"background-color: #fdd017;\">";

	            	echo"<br><br><input type='submit' Name='Pay".$value['IdProject']."'class='btn btn-primary btn-send-message' value='Pay'>";

	            }
	}

}


$f ="SELECT * from project where IdOwner='".$_SESSION['username']."'";
				$stmt=$conn->prepare($f);
	            $stmt->execute();
	            $projects=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

	            foreach ($projects as $key => $value) {
                if(isset($_GET["Pay".$value['IdProject']]))
                {


					$amount=$_GET[$value['IdProject']];
					$Total=$value['TotalPrice'];
					$payed=$value['payed'];
					$diff=$Total-$payed;

					if($amount>$diff)
					{
						echo "<h1> You are paying more than you should</h1>";
					}

					else{
						$pay=$payed+$amount;
						$q="UPDATE project SET payed='".$pay."' where IdProject='".$value['IdProject']."'";
						$stmt=$conn->prepare($q);
	           			$stmt->execute();

	           			echo  "<h1>Payement succeed</h1>" ;
	           
					}
				
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