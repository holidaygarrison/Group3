<?php
/* Including the needed files for the database, posts, account, and friends of the user. */
include("inc/create_db.php");
include("lib/posts_class.php");
include("lib/accounts_class.php");
include("lib/friends_class.php");

/* Two users: one to send the request of the other user. */
$user1 = $_POST['User1'];
$user2 = $_POST['User2'];

/* Distinguishes the two users. */
$user1 = Accounts::GetAccountInfo($user1);
$user2 = Accounts::GetAccountInfo($user2);

/* Setting these users as friends. */
$user1['Friends'] .= ($user1['Friends'] ? "," : "").$user2['Username'];
$user2['Friends'] .= ($user2['Friends'] ? "," : "").$user1['Username'];

/* Editing the two user's accounts to show that they are friends on their profile. */
Accounts::EditAccount( $user1 );
Accounts::EditAccount( $user2 );

/* If wanted, the user will be able to delete the friend request. */
Friends::DeleteRequestsFor( $user1['Username'], $user2['Username'] );

header( "Location:profile.php?d=".$user2['Username'] );
exit;
?>
