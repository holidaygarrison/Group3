<?php
include("inc/create_db.php");
include("lib/posts_class.php");
include("lib/accounts_class.php");
include("lib/friends_class.php");

$user1 = $_POST['User1'];
$user2 = $_POST['User2'];

Friends::DeleteRequestsFor($user1, $user2);

header("Location:./");
exit;
?>
