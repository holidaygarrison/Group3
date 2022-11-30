<?php

include("inc/create_db.php");
include("lib/posts_class.php");

$post = $_GET['post'];

$post = Posts::GetPostInfo($post);
echo ($post['Msg'] ? "<p class='txt text-dark'>".$post['Msg']."</p>" : "").
     ($post['Img'] ? "<img src='img/".$post['Img']."' alt='img'>" : "");

?>
