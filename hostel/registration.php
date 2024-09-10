<?php
session_start();
include('includes/config.php');
if (isset($_POST['submit'])) {
	$regno = $_POST['regno'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	$contactno = $_POST['contact'];
	$emailid = $_POST['email'];
	$password = $_POST['password'];
	$result = "SELECT count(*) FROM userRegistration WHERE email=? || regNo=?";
	$stmt = $mysqli->prepare($result);
	$stmt->bind_param('ss', $email, $regno);
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();
	if ($count > 0) {
		echo "<script>alert('Registration number or email id already registered.');</script>";
	} else {

		$query = "insert into  userRegistration(regNo,firstName,middleName,lastName,gender,contactNo,email,password) values(?,?,?,?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$rc = $stmt->bind_param('sssssiss', $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $password);
		$stmt->execute();
		echo "<script>alert('Student Succssfully register');</script>";
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
	<title>User Registration</title>
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
			margin-top: 80px;
			top: 50%;
			left: 55%;
			transform: translate(-50%, -50%);
			width: 69vw;
			height: 100%;
			background: rgba(255, 255, 255, 0.303);
			border-radius: 10px;
		}

		.center h1 {
			text-align: center;
			padding: 0 0 10px 0;
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

		/* input[type="Submit"] {
			width: 100%;
			height: 50px;
			border: 1px solid;
			border-radius: 25px;
			font-size: 18px;
			font-weight: 700;
			cursor: pointer; 
		}*/

		input[type="Submit"]:hover {
			background: #2691d9;
			color: #e9f4fb;
			transition: .5s;
		}

		.signup_link {
			margin: 10px 0;
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
			width: 10vw;
			height: 15vh;
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
			<div class="container-fluid" style=" background: linear-gradient(120deg, #007bff, #d0314c); height: 200vw;">

				<div class="row">
					<!-- <div class="col-md-12 ">

						<h2 class="page-title">Student Registration </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">Fill all Info</div>
									<div class="panel-body">


									</div>
								</div>
							</div>
						</div>
					</div> -->


					<div class="container" >
						<div class="center" style="margin-bottom: 20px;">
							
								<h1>Student Registration</h1>
								<!-- <form action="" class="mt" method="post">
								<div class="txt_field">
									<-- <input type="text" name="text" required> --
									<input type="text" name="emailreg" class="" required>
									<span></span>
									<label>Username</label>
								</div>
								<div class="txt_field">
									<-- <input type="password" name="password" required> --
									<input type="password" placeholder="" name="password" class="" required>
									<span></span>
									<label>Password</label>
								</div>
								<div class="pass">Forget Password?</div>
								<-- <input name="submit" type="Submit" value="Login"> --
								<input type="submit" name="login" class="" value="login">
								<div class="signup_link">
									Not a Member ? <a href="registration.php">registration.php</a>
								</div>
							</form> -->
								<form method="post" action="" name="registration" class="form-horizontal" onSubmit="return valid();">

									<div class="form-group">
										<label class="col-sm-2 control-label"> Registration No : </label>
										<div class="col-sm-8">
											<input type="text" name="regno" id="regno" class="form-control" required="required" onBlur="checkRegnoAvailability()">
											<span id="user-reg-availability" style="font-size:12px;"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">First Name : </label>
										<div class="col-sm-8">
											<input type="text" name="fname" id="fname" class="form-control" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Middle Name : </label>
										<div class="col-sm-8">
											<input type="text" name="mname" id="mname" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Last Name : </label>
										<div class="col-sm-8">
											<input type="text" name="lname" id="lname" class="form-control" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Gender : </label>
										<div class="col-sm-8">
											<select name="gender" class="form-control" required="required">
												<option value="">Select Gender</option>
												<option value="male">Male</option>
												<option value="female">Female</option>
												<option value="others">Others</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Contact No : </label>
										<div class="col-sm-8">
											<input type="text" name="contact" id="contact" class="form-control" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Email id: </label>
										<div class="col-sm-8">
											<input type="email" name="email" id="email" class="form-control" onBlur="checkAvailability()" required="required">
											<span id="user-availability-status" style="font-size:12px;"></span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Password: </label>
										<div class="col-sm-8">
											<input type="password" name="password" id="password" class="form-control" required="required">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Confirm Password : </label>
										<div class="col-sm-8">
											<input type="password" name="cpassword" id="cpassword" class="form-control" required="required">
										</div>
									</div>

									<div class="col-sm-5 col-sm-offset-5" style="align-items: center;">
										<button class="btn btn-primary" type="reset">Reset</button>
										<input type="submit" name="submit" Value="Register" class="btn btn-primary">
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
<script>
	function checkAvailability() {

		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data: 'emailid=' + $("#email").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {
				event.preventDefault();
				alert('error');
			}
		});
	}
</script>
<script>
	function checkRegnoAvailability() {

		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data: 'regno=' + $("#regno").val(),
			type: "POST",
			success: function(data) {
				$("#user-reg-availability").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {
				event.preventDefault();
				alert('error');
			}
		});
	}
</script>

</html>