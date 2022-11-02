<doctype html>
<html>
	<head>
		<title>Login Page </title>
</head>
<body>
<div class = "container">
   <div class = "main-body">
      <div class = "login-card">
         <div class = "image">
            <img src = "inc/Logo.png" class = "rounded-circle">
         </div>           
         <logoFont> Memehub </logoFont>
         <div class = "login-h1">
            <h1>Login to your account</h1>
         </div>
         <form name="Frm" action="loginPro.php" method = "post">
	         Username:
            <input type="text" name="Username" required>
         <br>
	         Password:
            <input type="password" name="PWD" required>
         <br>
            <button class = "btn-md" role="submit">Submit</button>
         </form>
         <p class = "small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href = "#!">
            <a href="createAccount.php">Create an Account</a>   
		</div>
	</div>
</div>
</body>
</html>
