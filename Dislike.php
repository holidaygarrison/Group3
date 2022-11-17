<?php
/* Includes the needed files to create the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* Getting the certain post and user to dislike. */
$post = $_GET['post'];
$user = $_GET['user'];

/* Disliking that specified post. */
Posts::DislikePost($user, $post);

/* Get the posts to add to the dislike accumulator. */
$post = Posts::GetPostInfo($post);
echo $post['Dislikes'];

?>
