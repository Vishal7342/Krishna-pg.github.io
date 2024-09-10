<!-- <nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">

		<li class="ts-label">Main</li>
		?PHP if (isset($_SESSION['id'])) { ?>
			<li><a href="dashboard.php"><i class="fa fa-desktop"></i>Dashboard</a></li>

			<li><a href="book-hostel.php"><i class="fa fa-file-o"></i>Book Hostel</a></li>
			<li><a href="room-details.php"><i class="fa fa-file-o"></i>Room Details</a></li>
			<li><a href="my-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
			<li><a href="change-password.php"><i class="fa fa-files-o"></i>Change Password</a></li>
			<li><a href="access-log.php"><i class="fa fa-file-o"></i>Access log</a></li>
		?php } else { ?>

			<li><a href="registration.php"><i class="fa fa-files-o"></i> User Registration</a></li>
			<li><a href="index.php"><i class="fa fa-users"></i> User Login</a></li>
			<li><a href="admin"><i class="fa fa-user"></i> Admin Login</a></li>
		?php } ?>

	</ul>
</nav> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="ts-sidebar">
	<ul class="list-group list-group-flush">

		<?PHP if (isset($_SESSION['id'])) { ?>
			<li class=" ts-sidebar-menu"><a href="dashboard.php"><i class="fa fa-desktop"></i>Dashboard</a></li>
			<li class=" ts-sidebar-menu"><a href="book-hostel.php"><i class="fa fa-file-o"></i>Book Hostel</a></li>
			<li class=" ts-sidebar-menu"><a href="room-details.php"><i class="fa fa-file-o"></i>Room Details</a></li>
			<li class=" ts-sidebar-menu"><a href="my-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
			<li class=" ts-sidebar-menu"><a href="change-password.php"><i class="fa fa-files-o"></i>Change Password</a></li>
			<li class=" ts-sidebar-menu"><a href="access-log.php"><i class="fa fa-file-o"></i>Access log</a></li>
		<?php } else { ?>

			<li class=" ts-sidebar-menu"><a href="registration.php"><i class="fa fa-files-o"></i> User Registration</a></li>
			<li class=" ts-sidebar-menu"><a href="index.php"><i class="fa fa-users"></i> User Login</a></li>
			<li class=" ts-sidebar-menu"><a href="admin"><i class="fa fa-user"></i> Admin Login</a></li>
			<li class=" ts-sidebar-menu"><a href="dashboard.php"><i class="fa fa-desktop"></i>Dashboard</a></li>
	</ul>
<?php } ?>
</nav>