<?php

include("inc/create_db.php");
include("lib/posts_class.php");

$user = $_POST['user'];
$msg = $_POST['Message'];
$post = $_POST['post'];

if( !$user || !$post ){
	echo "<Script>alert('Error!');</script>";
	header("Location:./");
	exit;
}

$post = Posts::SharePost( $user, $post, ($msg ? $msg : NULL) );

header("Location:./");
exit;
?>
