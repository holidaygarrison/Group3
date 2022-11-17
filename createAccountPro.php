<?php
/* Including the files to create the database, posts, and accounts. */
include "inc/create_db.php";
include "lib/posts_class.php";
include "lib/accounts_class.php";

/* User Account information. */
$Username = $_POST['Username'];
$PWD = $_POST['PWD'];
$FName = $_POST['FName'];
$LName = $_POST['LName'];
$Gender = $_POST['Gender'];
$BDay = $_POST['Birthday'];
$Email = $_POST['Email'];

/* Creates account for the given information. */
$id = Accounts::CreateAccount( $Username, $PWD, $FName, $LName, $Gender, $BDay, $Email );

/* Sets a cookie for five day, keeping the user loggen in. */
if( $id ){
	session_start();
	$_SESSION['sid'] = session_id();
	$_SESSION['user'] = $Username;

	header( "Location:./" );
	exit;
} else{
	header( "Location:createAccount.php" );
	exit;
}

?>
