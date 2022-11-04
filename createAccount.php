<html>
	<head>
		<style>
			/* Background */
			.container {
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				background-color: FloralWhite;
				width: 27%;
				height: 140%;
				margin: auto;
				border: 5px solid black;
				border-radius: 15px;
				box-shadow: 5px 10px;
			}
			/* Sizing logo */
			.container img {
				max-height: 60px;
			}
			/* Setting memehub */
			.container .logoFont {
				font-family: "American Typewriter", monospace;
				font-size: 25px;
				margin: 0;
				padding: -20;
			}
			/* Spaces out the sections from one another */
			.container > div {
				margin: 0px;
				padding: 10px;
				font-size: 18px;
			}
			/* Text boxes */
			.container input[type=text], input[type=password], input[type=date], input[type=email], select {
				width: 100%;
				padding: 12px 20px;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}
			/* Center Submit button */
			.btn {
				display: flex;
  				justify-content: center;
  				align-items: center;
			}
			/* Submit button */
			button {
				background-color: white;
				border: 2px solid #555555;
				color: black;
				padding: 16px 32px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				transition-duration: 0.4s;
				cursor: pointer;
			}
			/* Mouse over submit button */
			button:hover {
				background-color: #555555;
				color: white;
			}
			/* Center link */
			a {
				display: flex;
  				justify-content: center;
  				align-items: center;
			}
		</style>
	</head>
	<body>
		<br>
		<br>
		<br>
		<div class="container">
			<img src="inc/Logo.png" alt="MemeHub">
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
						<input type="email" placeholder="----------@email.com" name="Email" required>
					</div>
					<br>
					<div>
						Password:
						<input type="password" placeholder="Enter Password" name="PWD" required>
					</div>
					<br>
					<div class="btn">
						<button role="submit">Submit</button>
					</div>
				</form>
				<div>
				<a href="login.php">Already have an Account?</a>
				</div>
			</div>
		</div>
	</body>
</html>
