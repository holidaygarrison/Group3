<?php

include("inc/create_db.php");
include("lib/posts_class.php");

$post = $_GET['post'];
$user = $_GET['user'];

Posts::LikePost($user, $post);

$post = Posts::GetPostInfo($post);
echo $post['Likes'];

?>
