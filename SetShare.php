<?php
/* Including the needed files for the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* Getting the post the user wants to share. */
$post = $_GET['post'];

/* Displays the post the user wanted to share. */
$post = Posts::GetPostInfo($post);
echo ($post['Msg'] ? "<p class='txt text-dark'>".$post['Msg']."</p>" : "").
     ($post['Img'] ? "<img src='img/".$post['Img']."' alt='img'>" : "");

?>
