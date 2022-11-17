<?php
/* Includes the needed files to create the database, posts, account, and friends. */
include("inc/create_db.php");
include("lib/posts_class.php");
include("lib/accounts_class.php");
include("lib/friends_class.php");

/* The two users for the first user to delete the second user's friend request. */
$user1 = $_POST['User1'];
$user2 = $_POST['User2'];

/* Request is deleted. */
Friends::DeleteRequestsFor($user1, $user2);

header("Location:./");
exit;
?>
