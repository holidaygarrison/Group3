<?php
/* Including the files to create the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* User post information. */
$user = $_POST['user'];
$msg = $_POST['Message'];
$post = $_POST['post'];

/* Error Handling. */
if( !$user || !$post ){
	echo "<Script>alert('Error!');</script>";
	header("Location:./");
	exit;
}

/* Shares the post */
$post = Posts::SharePost( $user, $post, ($msg ? $msg : NULL) );

/* Is located in the header. */
header("Location:./");
exit;
?>
