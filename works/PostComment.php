<?php

include("inc/create_db.php");
include("lib/posts_class.php");

$user = $_POST['user'];
$msg = $_POST['Message'];
$post = $_POST['post'];

if( !$user || !$post || !$msg ){
	echo "<Script>alert('Error!');</script>";
	header("Location:./");
	exit;
}


Posts::MakeComment($user, $post, $msg);
header("Location:./");
exit;
?>
