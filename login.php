<html>
<head>
	<style>
	body {
		background-color: #ffeecc;
	}
	.logoFont {
		font-family: "American Typewriter", monospace;
		font-size: 25px;
		margin: 0;
		padding: -20;
	}
	.flex-container {
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	background-color: FloralWhite ;
	width: 25%;
	height: 80%;
	margin: auto;
	border: 5px solid black;
  	border-radius: 15px;
	box-shadow: 5px 10px;
	}

	.flex-container > div {
	margin: 0px;
	padding: 10px;
	font-size: 18px;
	}
	.Btn {
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
	.Btn:hover {
  		background-color: #555555;
  		color: white;
	}
	input[type=text], input[type=password], select {
		width: 100%;
		padding: 12px 20px;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}
	</style>
</head>
<body>

<br>
<br>
<br>
<div class="flex-container">
	<img src="inc/Logo.png" alt="MemeHub" style="max-height:60px">
	<p class="logoFont">memehub</p>
	<h1>Login</h1>

	<div>
	<form name="Frm" action="loginPro.php" method = "post">
		Username:
		<input type="text" placeholder="Enter Username" name="Username" required>
	</div>
	<br>
	<div>
		Password:
		<input type="password" placeholder="Enter Password" name="PWD" required>
	</div>
	<br>
	<div>
		<button class="Btn" role="submit">Submit</button>
	</form>
	</div>

	<div>
	<a href="createAccount.php">Don't Have an Account?</a>
	</div>
</div>



</body>
</html>
