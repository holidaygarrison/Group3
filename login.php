<html>
	<head>
		<style>
			/* Container of Login */
			.container {
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				background-color: FloralWhite ;
				width: 27%;
				height: 80%;
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
			/* Spacing out Login */
			.container h1 {
				margin-top: 10px;
			}
			/* Setting spaces in between text boxes */
			.container > div {
				margin: 0px;
				padding: 10px;
				font-size: 18px;
			}
			/* Text boxes */
			.container input[type=text], input[type=password], select {
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
			.container button {
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
		<!-- Login page -->
		<div class="container">
			<img src="inc/Logo.png" alt="MemeHub">
			<p class="logoFont">memehub</p>
			<h1>Login</h1>
			<div>
				<!-- Contains spot to enter username and password. -->
				<form name="Frm" action="loginPro.php" method = "post">
					<div>	
						Username:
						<input type="text" placeholder="Enter Username" name="Username" required>
					</div>
					<br>
					<br>
					<div>
						Password:
						<input type="password" placeholder="Enter Password" name="PWD" required>
					</div>
					<br>
					<div class="btn">
						<button role="submit">Submit</button>
				</form>
			</div>
			<!-- Directs you to the Create Account page if you do not have an account. -->
			<a href="createAccount.php">Don't Have an Account?</a>
		</div>
	</body>
</html>
