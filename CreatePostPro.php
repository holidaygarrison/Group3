<?php
/* Includes the files to create the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* Getting the things needed to create the post which is the actual post, image, and text. */
$user = $_POST['user'];
$msg = $_POST['Message'];
$img = $_FILES['File'];

/* The user must add an image and text.*/
if( !$img && !$msg ){
	echo "<Script>alert('Error: need an image or message.');</script>";
	header("Location:./");
	exit;
}

/* Validate and move the image. */
if($img['size'] > 0 && $img['error'] === 0){
	$fileName = strtolower($user)."-".time()."-".$img['name'];
	move_uploaded_file($img['tmp_name'], "./img/".$fileName);
}
$post = Posts::CreatePost( $user, ($msg ? $msg : NULL), ($img['size'] ? @$fileName : NULL) );

header("Location:./");
exit;
?>
