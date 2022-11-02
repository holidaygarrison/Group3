<?php

include "inc/create_db.php";
include "lib/posts_class.php";
include "lib/accounts_class.php";

$Username = $_POST['Username'];
$PWD = $_POST['PWD'];
$FName = $_POST['FName'];
$LName = $_POST['LName'];
$Gender = $_POST['Gender'];
$BDay = $_POST['Birthday'];
$Email = $_POST['Email'];

$id = Accounts::CreateAccount( $Username, $PWD, $FName, $LName, $Gender, $BDay, $Email );

if( $id ){
	// set a cookie for five days keeping the user logged in
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
