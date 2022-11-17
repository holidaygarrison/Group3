<?php
/* Including the needed files for the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* Getting the user, text and image of the post, and ability to delete the post. */
$user = $_POST['user'];
$msg = $_POST['Message'];
$post = $_POST['post'];
$del = $_POST['delete'];

/* The selected user must have created the post. */
if( !$user || !$post ){
	echo "<Script>alert('Error!');</script>";
	header("Location:./");
	exit;
}

/* If the user does affirm to delete the post, then it will be deleted. */
if( $del == "TRUE" ) {
	Posts::DeletePost( $post );
}
/* Otherwise, the post will just be edited. */
else {
	Posts::EditPost( $post, $msg );
}

header("Location:./");
exit;
?>
