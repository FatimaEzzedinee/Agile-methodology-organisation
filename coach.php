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
					<li><a href="coach.php?pg=c">Scrum Management</a></li>
					<li><a href="coach.php?pg=acc">Team Management</a></li>
					<li><a href="coach.php?pg=f">Owner Management</a></li>
					<li><a href="coach.php?pg=ed">My Infos Management</a></li>
					<li><a href="coach.php?pg=teams">My teams</a></li>
					<li><a href="coach.php?pg=Ap">Associate a project to a team</a></li>
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
$f ="SELECT * from coach where Username='".$_SESSION['username']."'";
	$stmt=$conn->prepare($f);
	$stmt->execute();
	$myCo=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	$Co=$myCo['0']['CochId'];
							echo"<div class='desc'>
							<h1 class=\"colorlib-heading\">Hello Coach: ".$_SESSION['username']." !! </h1>";
							echo "</div>";
if(isset($_GET['pg']))
{

	if($_GET['pg']=='Ap')
	{
	 echo"<h1>Associate a project into a team </h1>" ;
	 echo "<h2>Available projects : </h2>";

	$query="Select * from project where IdTeam='0'";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$availableprojects=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	//echo $availableprojects['0']['Title'];
	echo"<form method='get'>";
echo "<select name='AvP'>";
	foreach ($availableprojects as $key => $value) {
		echo "<option value='".$value['IdProject']."'>".$value['Title']."</option>";
	}


echo"</select>";


$query="Select * from team ";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$teamss=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	//echo $availableprojects['0']['Title'];
	echo"<br><h1>Choose a team </h1>";
echo "<select name='te'>";
	foreach ($teamss as $key => $value) {
		echo "<option value='".$value['IdTeam']."'>".$value['TeamName']."</option>";
	}

echo"</select>";
echo"<br><br><input type='submit' Name='APP' class='btn btn-primary btn-send-message' value='Asoociate project'>";
		echo"</form>";

	}

if($_GET['pg']=='c')
{
//add scrum
	echo "<br><h1>Add a Scrum :</h1>";
	echo "<form method='get' action='' >";
	echo "<input type='text' class='form-control' placeholder='Scrum Name ' Name='SName' style=\"background-color: #fdd017;\">";
	echo "<input type='text' class='form-control' placeholder='Scrum Salary' Name='SSalaire' style='background-color: #fdd017;'>";
	echo "<input type='text' class='form-control' placeholder='Scrum Email ' Name='SEmail' style=\"background-color: #fdd017;\">";
	echo "<input type='text' class='form-control' placeholder='User Name ' Name='SUserName' style=\"background-color: #fdd017;\">";

		echo"<br><br><input type='submit' Name='AddS' class='btn btn-primary btn-send-message' value='Add Scrum'>";
		echo"</form>";

		echo"<br><br><h1>Associate scrum to a team</h1>";
		echo "<form method='get'>";
        $q="SELECT * from coach where Username='".$_SESSION['username']."'";
		$stmt=$conn->prepare($q);
        $stmt->execute();
        $coach=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
        $coachid=$coach['0']['CochId'] ;
        echo "<br><h2>choose a team:</h2> ";
		$q="SELECT * from team where CoachId='".$coachid."'and ScrumId='0'";
		$stmt=$conn->prepare($q);
        $stmt->execute();
        $arr=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	

		foreach ($arr as $key => $value) {
			# code...
				echo"<h2><input type = 'radio' name='IdTeam' value='".$value['IdTeam']."'>\r".$value['TeamName']."</h2><br>";
		}
        echo "<br><h2>choose a scrum: </h2>";
		$q="SELECT * from scrum where IdCoach='0'";
		$stmt=$conn->prepare($q);
        $stmt->execute();
        $arr=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
		foreach ($arr as $key => $value) {
			    # code...
				echo"<h2><input type = 'radio' name='IdScrum' value='".$value['IdScrum']."'>\r".$value['Name']."</h2><br>";
				}
		echo"<br><br><input type='submit' Name='AddTeamm' class='btn btn-primary btn-send-message' value='AddTeam'>";
		//echo "</form>";
}


if($_GET['pg']=='teams')
			{
            
            $q="SELECT * from team where CoachId='".$Co."'";
            $stmt=$conn->prepare($q);
			$stmt->execute();
			$myTeam=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);

			foreach ($myTeam as $k => $v) {
				# code..

			$idTeam=$v['IdTeam'];
			$tname=$v['TeamName'];
			echo "<h1>Team Name: ".$tname."</h1>";

			$q="Select * from scrum where IdScrum='".$v['ScrumId']."'";
			$stmt=$conn->prepare($q);
			$stmt->execute();
			$scrum=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			if (count($scrum)!=0)
				echo"<h2>Team Scrum: ".$scrum['0']['Name']."</h2>";

			$q="Select * from project where IdTeam='".$idTeam."'";
			$stmt=$conn->prepare($q);
			$stmt->execute();
			$project=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			if (count($project)!=0)
				echo"<h2>Project in Charge: ".$project['0']['Title']."</h2>";


			echo"<h2>Team Developpers:</h2><h3>";
			$q="Select * from developper where IdTeam='".$idTeam."'";
			$stmt=$conn->prepare($q);
			$stmt->execute();
			$devs=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			echo "<table class=\"colorlib-lead\" border=2 style='text-align: center;'><tr style='background-color: #fdd017;'><th width=300><center>Name</center></th><th width=500><center>Email</center></th></tr>";
			foreach ($devs as $key => $value) {
				# code...
				echo "<tr><td>".$value['Name']."</td><td>".$value['email']."</td></tr>";
			}

			echo "</table></h3><br><br>";

			

			}

		    }

if ($_GET['pg']=='ed'){

				echo"<form method='get'>";
	            echo "<br><h2>Online Account Username : ".$_SESSION['username']."</h2>";
	            echo "<br><h2>Name : </h2><input type='text'  class='form-control' placeholder='Name' Name='NewName' style=\"background-color: #fdd017;\" value='".$myCo['0']['Nom']."'>";
            	echo"<br><input type='submit' Name='chN' class='btn btn-primary btn-send-message' value='Change Name'>";
	            echo "<br><br><h2>Email:</h2><input type='text'  class='form-control' placeholder='Email' Name='Nass' style=\"background-color: #fdd017;\" value='".$myCo['0']['Email']."'>";
            	echo"<br><input type='submit' Name='chEm' class='btn btn-primary btn-send-message' value='Change Email'>";
	            echo "<br><br><br><h2>Change your acoount password ?<br> ";
	            echo"<br><input type='password'  class='form-control' placeholder='Old password' Name='Opass' style=\"background-color: #fdd017;\">";
	            echo"<br><input type='password'  class='form-control' placeholder='New password' Name='Npass' style=\"background-color: #fdd017;\">";
 			    echo"<br><input type='password'  class='form-control' placeholder='Confirm password' Name='Cpass' style=\"background-color: #fdd017;\"><br>";
				echo"<br><br><input type='submit' Name='Sub' class='btn btn-primary btn-send-message' value='Change password'></h2>";

			}
if($_GET['pg']=='acc')
{
		echo"<form  method='get'>";
		echo"<br><br><h1><center> Add a team ? </center></h1>";
		echo"<br><br><br><center><input type='submit' Name='AddTeam' class='btn btn-primary btn-send-message' value='Add Team'></center>";
		echo"</form>";

}

if($_GET['pg']=='f')
{

	echo "<form method='get'>";
	echo"<h1>Add a new Owner?</h1>";
	echo"<h2>Username</h2> ";
	echo"<input type='text'  class='form-control' placeholder='UserName' Name='OUserN'  style=\"background-color: #fdd017;\">";
	echo"<h2>Name : </h2>";
	echo"<input type='text'  class='form-control' placeholder='Name' Name='OName'  style=\"background-color: #fdd017;\">";
	echo"<h2>Email</h2>";
	echo"<input type='text'  class='form-control' placeholder='Email' Name='OEmail'   style=\"background-color: #fdd017;\">";
echo"<br><br><br><input type='submit' Name='AddOwn' class='btn btn-primary btn-send-message' value='Add Owner'>";


	$query="SELECT * from owner";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	$owners=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	


	echo "<br><h2>choose a owner : </h2> ";
	echo "<form method='get'>";
	echo"<select name='owners'>";
	foreach ($owners as $key => $value) {
		# code...
		echo"<option value='".$value['Username']."'>".$value['Username']."</option>";
	}
	echo"</select>";

	echo "<br><h2>choose a team:</h2> ";

     $q="SELECT * from coach where Username='".$_SESSION['username']."'";
		$stmt=$conn->prepare($q);
        $stmt->execute();
        $coach=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
        $coachid=$coach['0']['CochId'] ;

  
     $q="SELECT * from team where CoachId='".$coachid."' AND OwnerId='0'";
		$stmt=$conn->prepare($q);
        $stmt->execute();
        $teams=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	

	echo"<select name='tea'>";
        foreach ($teams as $key => $value) {
        	# code...
        	echo"<option value='".$value['IdTeam']."'>".$value['IdTeam']."</option>";
        }
	echo"</select>";

        echo"<br><br><br><center><input type='submit' Name='AssociateOwner' class='btn btn-primary btn-send-message' value=' Associate Owner to team'></center>";

}

}


if(isset($_GET['APP']))
{
$team=$_GET['te'];
$project=$_GET['AvP'];
$query="UPDATE project SET IdTeam='".$team."'where IdProject='".$project."'";
$stmt=$conn->prepare($query);
$stmt->execute();
}
if(isset($_GET['AddOwn']))
{

$username=$_GET['OUserN'];
$name=$_GET['OName'];
$email=$_GET['OEmail'];

$query="insert into owner(Username,Name,happy,Email) values(?,?,'0',?)";
$stmt=$conn->prepare($query);
$stmt->bind_param("sss",$username,$name,$email);
$stmt->execute();

$f ="INSERT Into onlineaccount(Username,Password,Type) values ('".$username."','123','owner')";
		$stmt=$conn->prepare($f);
        $stmt->execute();
		$message = "Hello Owner! your Account has been activated, Change your Password! (use ".$username." as username and 123 as temporary Password)";
        SendMail($message,$email);

}

if(isset($_GET['AssociateOwner']))
{
$owner=$_GET['owners'];
$team=$_GET['tea'];


	    $q="SELECT * from coach where Username='".$_SESSION['username']."'";
		$stmt=$conn->prepare($q);
        $stmt->execute();
        $coach=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
        $coachid=$coach['0']['CochId'] ;

	$query="UPDATE team SET OwnerId='".$owner."' where IdTeam='".$team."'";
	$stmt=$conn->prepare($query);
	$stmt->execute();

}

if(isset($_GET['AddS']))
{
if (userExist($_GET['SUserName']))
	{
		echo "UserName already exists!";
	}
	else{
		$f ="INSERT Into onlineaccount(Username,Password,Type) values ('".$_GET['SUserName']."','123','srcum')";
		$stmt=$conn->prepare($f);
        $stmt->execute();
        $message = "hello Scrum! your Account has been activated, Change your Password! (use ".$_GET['SUserName']." as username and 123 as temporary Password)";
        SendMail($message, $_GET['SEmail'] );
        $f ="INSERT Into scrum(IdAccount,Name,Salaire,Email,IdCoach) values (?,?,?,?,0)";
		$stmt=$conn->prepare($f);
		$stmt->bind_param("ssis",$_GET['SUserName'],$_GET['SName'],$_GET['SSalaire'],$_GET['SEmail']);
        $stmt->execute();
	}

}

if(isset($_GET['AddTeam']))
{


	$q="SELECT * from coach where Username='".$_SESSION['username']."'";
		$stmt=$conn->prepare($q);
        $stmt->execute();
        $arr=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
         $coachid=$arr['0']['CochId'] ;
		$qd="insert into team(OwnerId,CoachId) values ('0',?)";
		$stmt=$conn->prepare($qd);
		$stmt->bind_param("i",$coachid);
		$stmt->execute();
        //echo"Team created";

}

if(isset($_GET['AddTeamm'])){

	$conn=DBConn();
	$idteam=$_GET['IdTeam'];
	$idscrum=$_GET['IdScrum'];

	    $q="SELECT * from coach where Username='".$_SESSION['username']."'";
		$stmt=$conn->prepare($q);
        $stmt->execute();
        $coach=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);	
        $coachid=$coach['0']['CochId'] ;

	$query="UPDATE team SET ScrumId='".$idscrum."' where IdTeam='".$idteam."'";
	$stmt=$conn->prepare($query);
	$stmt->execute();

	$query2="UPDATE scrum SET IdCoach='".$coachid."' where IdScrum='".$idscrum."'";
	$stmt=$conn->prepare($query2);
	$stmt->execute();
}


if(isset($_GET['chEm']))
			{
			$em=$_GET["Nass"];
			$q="UPDATE coach set email='".$em."' where Username='".$_SESSION['username']."'";
			$stmt=$conn->prepare($q);
	        $stmt->execute();
	        header('Location:developper.php');
	    }

if(isset($_GET['chN']))
			{
			$name=$_GET["NewName"];
			$q="UPDATE coach set Name='".$name."' where Username='".$_SESSION['username']."'";
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