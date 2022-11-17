<?php
/* Including the needed files for the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* Gets the post and user who created the post. */
$post = $_GET['post'];
$user = $_GET['user'];

/* Likes the post. */
Posts::LikePost($user, $post);

/* Accumulates the number of likes on that post. */
$post = Posts::GetPostInfo($post);
echo $post['Likes'];

?>
