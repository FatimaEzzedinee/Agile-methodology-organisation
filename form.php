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
					<li><a href="about.html">About</a></li>
					<li><a href="blog.html">Blog</a></li>
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
         $idform=$_GET['idform'];
         $user=$_GET['iduser'];

         $conn=DBConn();
         $query="Select * from form_question where IdForm='".$idform."'";
         $stmt=$conn->prepare($query);
         $stmt->execute();
         $form=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
         echo "<h1>Please fill this form </h1>";

        if(isset($_POST['SendResults']))
		{
			//echo "hell";
			if (!isset($_POST['Q1']) || !isset($_POST['Q2']) || !isset($_POST['Q3']) || !isset($_POST['Q4']) || !isset($_POST['Q5']) || !isset($_POST['Q6']) || !isset($_POST['Q7']) || !isset($_POST['Q8']) || !isset($_POST['Q9']) || !isset($_POST['Q10']) )

				echo "<br><h3><font color='red'>Please fill all the form!</font></h3>";

			else {
				$q1=$_POST['Q1'];
				$q2=$_POST['Q2'];
				$q3=$_POST['Q3'];
				$q4=$_POST['Q4'];
				$q5=$_POST['Q5'];
				$q6=$_POST['Q6'];
				$q7=$_POST['Q7'];
				$q8=$_POST['Q8'];
				$q9=$_POST['Q9'];
				$q10=$_POST['Q10'];

				$query="Insert into form_result(IdForm,IdAccount,Q1,Q2,Q3,Q4,Q5,Q6,Q7,Q8,Q9,Q10) values(?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmt=$conn->prepare($query);
				$stmt->bind_param('isssssssssss',$idform,$user,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10);
			    $stmt->execute();

                $query="DELETE FROM pending where Username='".$user."' AND IdForm='".$idform."'";
                $stmt=$conn->prepare($query);
                $stmt->execute();

                header("Location: developper.php");

			}
		}

         echo"<h2>Remarque :<br> 1->Excellent <br> 3->Good <br> 5->Bad <br></h2>";
         echo"<form method='post' action=''>";

	echo "<br><h2>".$form['0']['Q1']."</h2>";
	echo "1<input type='radio' name='Q1' value='1'>2<input type='radio' name='Q1' value='2'> 3<input type='radio' name='Q1' value='3'>4<input type='radio' name='Q1' value='4'> 5<input type='radio' name='Q1' value='5'><br>";

	echo "<br><h2>".$form['0']['Q2']."</h2>";
	echo " 1 <input type='radio' name='Q2' value='1'>2<input type='radio' name='Q2' value='2'>  3 <input type='radio' name='Q2' value='3'>4<input type='radio' name='Q2' value='4'> 5<input type='radio' name='Q2' value='5'><br>";

	echo "<br><h2>".$form['0']['Q3']."</h2>";
	echo "1 <input type='radio' name='Q3' value='1'>2<input type='radio' name='Q3' value='2'> 3<input type='radio' name='Q3' value='3'> 4<input type='radio' name='Q3' value='4'>5<input type='radio' name='Q3' value='5'><br>";

	echo "<br><h2>".$form['0']['Q4']."</h2>";
	echo "1<input type='radio' name='Q4' value='1'>2<input type='radio' name='Q4' value='2'> 3<input type='radio' name='Q4' value='3'>4<input type='radio' name='Q4' value='4'> 5<input type='radio' name='Q4' value='5'><br>";

	echo "<br><h2>".$form['0']['Q5']."</h2>";
	echo "1<input type='radio' name='Q5' value='1'>2<input type='radio' name='Q5' value='2'> 3<input type='radio' name='Q5' value='3'>4<input type='radio' name='Q5' value='4'> 5<input type='radio' name='Q5' value='5'><br>";

	echo "<br><h2>".$form['0']['Q6']."</h2>";
	echo "1<input type='radio' name='Q6' value='1'>2<input type='radio' name='Q6' value='2'> 3<input type='radio' name='Q6' value='3'>4<input type='radio' name='Q6' value='4'> 5<input type='radio' name='Q6' value='5'><br>";

	echo "<br><h2>".$form['0']['Q7']."</h2>";
	echo "1<input type='radio' name='Q7' value='1'>2<input type='radio' name='Q7' value='2'> 3<input type='radio' name='Q7' value='3'>4<input type='radio' name='Q7' value='4'> 5<input type='radio' name='Q7' value='5'><br>";

	echo "<br><h2>".$form['0']['Q8']."</h2>";
	echo "1<input type='radio' name='Q8' value='1'>2<input type='radio' name='Q8' value='2'> 3<input type='radio' name='Q8' value='3'>4<input type='radio' name='Q8' value='4'> 5<input type='radio' name='Q8' value='5'><br>";

	echo "<br><h2>".$form['0']['Q9']."</h2>";
	echo "1<input type='radio' name='Q9' value='1'>2<input type='radio' name='Q9' value='2'> 3<input type='radio' name='Q9' value='3'> 4<input type='radio' name='Q9' value='4'>5<input type='radio' name='Q9' value='5'><br>";
	echo "<br><h2>".$form['0']['Q10']."</h2>";
	echo "1<input type='radio' name='Q10' value='1'>2<input type='radio' name='Q10' value=2> 3<input type='radio' name='Q10' value='3'>4<input type='radio' name='Q10' value='4'> 5<input type='radio' name='Q10' value='5'><br>";

   echo"<br><br><input type='submit' Name='SendResults' class='btn btn-primary btn-send-message' value='Send The form Results'>";

echo"</form>";
?>
		
		</div>

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