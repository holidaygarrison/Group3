<?php
/* Including the files needed for the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* Getting the post information that the user wants to comment on. */
$user = $_POST['user'];
$msg = $_POST['Message'];
$post = $_POST['post'];

/* The post information must be the correct comment in order to edit it. */
if( !$user || !$post || !$msg ){
	echo "<Script>alert('Error!');</script>";
	header("Location:./");
	exit;
}

/* Allows the comment to be made to the specified post. */
Posts::MakeComment($user, $post, $msg);
header("Location:./");
exit;
?>
