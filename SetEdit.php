<?php

include("inc/create_db.php");
include("lib/posts_class.php");

$post = $_GET['post'];

$post = Posts::GetPostInfo($post);
echo $post['PlainMsg']."-;;-".$post['Img'];

?>
