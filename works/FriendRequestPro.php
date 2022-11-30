<?php
include "inc/create_db.php";
include "lib/accounts_class.php";
include "lib/friends_class.php";

$requestor = $_POST['Requestor'];
$requestee = $_POST['Requestee'];

if( $requestor == $requestee ){
	echo "<script>\n".
	     "  alert('Error: you cannot friend yourself.');\n".
	     "  window.location = 'profile.php?d=".$requestee."';\n".
	     "</script>\n";

} else{
	Friends::InitiateRequest($requestor, $requestee);

	header("Location:profile.php?d=$requestee");
	exit;
}


?>
