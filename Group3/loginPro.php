<?php

include "inc/create_db.php";
include "lib/posts_class.php";
include "lib/accounts_class.php";

$Username = $_POST['Username'];
$PWD = $_POST['PWD'];

if( Accounts::CheckPWD( $Username, $PWD ) )
{
	setcookie( 'user', $Username, time() + (86400 * 5), "/" );

	header("Location:./");
	exit;
} else{
	echo "<Script>\n".
	     "  alert('The password you entered was incorrect. Please try again.');\n".
	     "  window.location = 'login.php';\n".
	     "</script>\n";
}


?>
