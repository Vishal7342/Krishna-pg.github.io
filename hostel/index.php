<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$emailreg = $_POST['emailreg'];
	$password = $_POST['password'];
	$stmt = $mysqli->prepare("SELECT email,password,id FROM userregistration WHERE (email=? || regNo=?) and password=? ");
	$stmt->bind_param('sss', $emailreg, $emailreg, $password);
	$stmt->execute();
	$stmt->bind_result($email, $password, $id);
	$rs = $stmt->fetch();
	$stmt->close();
	$_SESSION['id'] = $id;
	$_SESSION['login'] = $emailreg;
	$uip = $_SERVER['REMOTE_ADDR'];
	$ldate = date('d/m/Y h:i:s', time());
	if ($rs) {
		$uid = $_SESSION['id'];
		$uemail = $_SESSION['login'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$geopluginURL = 'http://www.geoplugin.net/php.gp?ip=' . $ip;
		$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
		$city = $addrDetailsArr['geoplugin_city'];
		$country = $addrDetailsArr['geoplugin_countryName'];
		$log = "insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
		$mysqli->query($log);
		if ($log) {
			header("location:dashboard.php");
		}
	} else {
		echo "<script>alert('Invalid Username/Email or password');</script>";
	}
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Student Hostel Registration</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<style>
		.center {
			position: absolute;
			top: 50%;
			left: 60%;
			transform: translate(-50%, -50%);
			width: 29vw;
			background: rgba(255, 255, 255, 0.303);
			border-radius: 10px;
		}

		.center h1 {
			text-align: center;
			padding: 0 0 20px 0;
			border-bottom: 1px solid silver;
		}

		.center form {
			padding: 20px 40px;
			box-sizing: border-box;

		}

		.container {
			margin-left: 20px;
		}

		form .txt_field {
			position: relative;
			border-bottom: 2px solid #adadad;
			margin: 30px 0;
		}

		.txt_field input {
			width: 100%;
			padding: 0 5px;
			height: 40px;
			font-size: 16px;
			border: none;
			background: none;
			outline: none;
		}

		.txt_field label {
			position: absolute;
			top: 50%;
			left: 5px;
			color: #adadad;
			transform: translateY(-50%);
			font-size: 16px;
			pointer-events: none;
		}

		.txt_field span::before {
			content: '';
			position: absolute;
			top: 40px;
			left: 0;
			width: 0px;
			height: 2px;
			background: #2691d9;
			transition: .5s;
		}

		.txt_field input:focus~label,
		.txt_field input:valid~label {
			top: -5px;
			color: #2691d9;
		}

		.txt_field input:focus~span::before,
		.txt_field input:Valid~span::before {
			width: 100%;
		}

		.pass {
			margin: -5px 0 20px 5px;
			color: #a6a6a6;
			cursor: pointer;
		}

		.pass:hover {
			text-decoration: underline;
		}

		input[type="Submit"] {
			width: 100%;
			height: 50px;
			border: 1px solid;
			border-radius: 25px;
			font-size: 18px;
			font-weight: 700;
			cursor: pointer;
		}

		input[type="Submit"]:hover {
			background: #2691d9;
			color: #e9f4fb;
			transition: .5s;
		}

		.signup_link {
			margin: 30px 0;
			text-align: center;
			font-size: 16px;
			color: #666666;
		}

		.signup_link a {
			color: #2691d9;
			text-decoration: none;
		}

		.signup_link a:hover {
			text-decoration: underline;
		}

		.HomeAbout {
			width: 100vw;
			height: 25vh;
		}
	</style>
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="js/validation.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript">
		function valid() {
			if (document.registration.password.value != document.registration.cpassword.value) {
				alert("Password and Re-Type Password Field do not match  !!");
				document.registration.cpassword.focus();
				return false;
			}
			return true;
		}
	</script>
</head>

<body>
	<?php include('includes/header.php'); ?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php'); ?>
		<div class="content-wrapper">
			<div class="container-fluid" style="background: linear-gradient(120deg, #007bff, #d0314c);height: 100vh;">

				<div class="row">
					<!-- <div class="col-md-12">

						<h2 class="page-title">User Login </h2>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<div class="well row pt-2x pb-3x bk-light">
									<div class="col-md-8 col-md-offset-2">

										<form action="" class="mt" method="post">
											<label for="" class="text-uppercase text-sm">Email / Registration Number</label>
											<input type="text" placeholder="Email / Registration Number" name="emailreg" class="form-control mb" required="true">
											<label for="" class="text-uppercase text-sm">Password</label>
											<input type="password" placeholder="Password" name="password" class="form-control mb" required="true">
											<input type="submit" name="login" class="btn btn-primary btn-block" value="login">
										</form>
									</div>
								</div>
								<div class="text-center text-light" style="color:black;">
									<a href="forgot-password.php" style="color:black;">Forgot password?</a>
								</div>
							</div>
						</div>
					</div> -->
					<div class="container">
						<div class="center">
							<h1>Login</h1>
							<form action="" class="mt" method="post">
								<div class="txt_field">
									<!-- <input type="text" name="text" required> -->
									<input type="text" name="emailreg" class="" required>
									<span></span>
									<label>Username</label>
								</div>
								<div class="txt_field">
									<!-- <input type="password" name="password" required> -->
									<input type="password" placeholder="" name="password" class="" required>
									<span></span>
									<label>Password</label>
								</div>
								<div class="pass">Forget Password?</div>
								<!-- <input name="submit" type="Submit" value="Login"> -->
								<input type="submit" name="login" class="" value="login">
								<div class="signup_link">
									Not a Member ? <a href="registration.php">registration.php</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>

</html>