<?php

include "inc/create_db.php";
include "lib/posts_class.php";
include "lib/accounts_class.php";

$Username = $_POST['Username'];
$PWD = $_POST['PWD'];

$id = Accounts::CreateAccount( $Username, $PWD );

if( $id ){
	// set a cookie for five days keeping the user logged in
	setcookie( "user", $Username, time() + (86400 * 5 ), "/");

	header( "Location:./" );
	exit;
} else{
	header( "Location:createAccount.php" );
	exit;
}

?>
