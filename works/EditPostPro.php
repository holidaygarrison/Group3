<?php

include("inc/create_db.php");
include("lib/posts_class.php");

$user = $_POST['user'];
$msg = $_POST['Message'];
$post = $_POST['post'];
$del = $_POST['delete'];

if( !$user || !$post ){
	echo "<Script>alert('Error!');</script>";
	header("Location:./");
	exit;
}


if( $del == "TRUE" ){
	Posts::DeletePost( $post );
} else{
	Posts::EditPost( $post, $msg );
}



header("Location:./");
exit;
?>
