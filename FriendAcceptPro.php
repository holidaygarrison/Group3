<?php
include("inc/create_db.php");
include("lib/posts_class.php");
include("lib/accounts_class.php");
include("lib/friends_class.php");

$user1 = $_POST['User1'];
$user2 = $_POST['User2'];

$user1 = Accounts::GetAccountInfo($user1);
$user2 = Accounts::GetAccountInfo($user2);

$user1['Friends'] .= ($user1['Friends'] ? "," : "").$user2['Username'];
$user2['Friends'] .= ($user2['Friends'] ? "," : "").$user1['Username'];

Accounts::EditAccount( $user1 );
Accounts::EditAccount( $user2 );

Friends::DeleteRequestsFor( $user1['Username'], $user2['Username'] );

header( "Location:profile.php?d=".$user2['Username'] );
exit;
?>
