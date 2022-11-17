<?php
/* Include the files to create the database, posts, and accounts. */
include "inc/create_db.php";
include "lib/posts_class.php";
include "lib/accounts_class.php";

/* User's username and password */
$Username = $_POST['Username'];
$PWD = $_POST['PWD'];

/* If username and password are correct, user is logged in. */
/* If not, error message is printed stating password is incorrect. */
if( Accounts::CheckPWD( $Username, $PWD ) )
{
	session_start();
	$_SESSION['sid']=session_id();
	$_SESSION['user'] = $Username;


	header("Location:./");
	exit;
} else{
	echo "<Script>\n".
	     "  alert('The password you entered was incorrect. Please try again.');\n".
	     "  window.location = 'login.php';\n".
	     "</script>\n";
}


?>
