<?php

include("inc/create_db.php");
include("lib/posts_class.php");

$user = $_POST['user'];
$msg = $_POST['Message'];
$img = $_FILES['File'];

if( !$img && !$msg ){
	echo "<Script>alert('Error: need an image or message.');</script>";
	header("Location:./");
	exit;
}

// validate and move image
if($img['size'] > 0 && $img['error'] === 0){
	$fileName = strtolower($user)."-".time()."-".$img['name'];
	move_uploaded_file($img['tmp_name'], "./img/".$fileName);
}
$post = Posts::CreatePost( $user, ($msg ? $msg : NULL), ($img['size'] ? @$fileName : NULL) );

header("Location:./");
exit;
?>
