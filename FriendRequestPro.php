<?php
/* Including the files needed for the database, account, and friends. */
include "inc/create_db.php";
include "lib/accounts_class.php";
include "lib/friends_class.php";

/* Setting a user who sent the reuqest and the other user as the receiver of the request. */
$requestor = $_POST['Requestor'];
$requestee = $_POST['Requestee'];

/* A user cannot send a friend request to themself. */
if( $requestor == $requestee ){
	echo "<script>\n".
	     "  alert('Error: you cannot friend yourself.');\n".
	     "  window.location = 'profile.php?d=".$requestee."';\n".
	     "</script>\n";

} 
/* Otherwise, the user is sending a friend request to a different user and that is okay. */
else{
	Friends::InitiateRequest($requestor, $requestee);

	header("Location:profile.php?d=$requestee");
	exit;
}

?>
