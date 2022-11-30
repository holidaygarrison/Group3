<html>
<head>
<link type="text/css" rel="stylesheet" href="css/base.css" media="all">
</head>

<body>

<br>
<br>
<br>
<div class="flex-container">
	<img src="inc/Logo.png" alt="MemeHub" style="max-height:60px">
	<p class="logoFont">memehub</p>
	<h1>Create an Account</h1>

	<div>
	<form name="Frm" action="createAccountPro.php" method = "post">
	<div>
		Username:
		<input type="text" placeholder="Enter Username" name="Username" required>
	</div>
	<br>
	<div>
		First Name:
		<input type="text" placeholder="First name" name="FName" required>
	</div>
	<br>
	<div>
		Last Name:
		<input type="text" placeholder="Last name" name="LName" required>
	</div>
	<br>
	<div>
		Gender:
		<input type="text" placeholder="Preferred gender" name="Gender" required>
	</div>
	<br>
	<div>
		Date of Birth:
		<input type="date" max="<?php echo date("Y-m-d"); ?>" name="Birthday" required>
	</div>
	<br>
	<div>
		Email:
		<input type="email" placeholder="--------@email.com" name="Email" required>
	</div>
	<br>
	<div>
		Password:
		<input type="password" placeholder="Enter Password" name="PWD" required>
	</div>
	<br>
	<div>
		<button class="Btn" role="submit">Submit</button>
	</div>
	</form>

	<div>
	<a href="login.php">Already have an Account?</a>
	</div>
</div>



</body>
</html>
