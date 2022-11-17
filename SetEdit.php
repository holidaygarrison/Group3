<?php
/* This includes the needed files for the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* Gets the post the user wants to edit. */
$post = $_GET['post'];

/* Allows the user to edit the post. */
$post = Posts::GetPostInfo($post);
echo $post['Msg']."-;;-".$post['Img'];

?>
