<?php
/* Including the files to create the database, posts, accounts, and friends. */
include("inc/create_db.php");
include("lib/posts_class.php");
include("lib/accounts_class.php");
include("lib/friends_class.php");

/* Two users because one to send request and the other to accept the request. */
$user1 = $_POST['User1'];
$user2 = $_POST['User2'];

/* Gets information of the two users accounts. */
$user1 = Accounts::GetAccountInfo($user1);
$user2 = Accounts::GetAccountInfo($user2);

/* Setting the two users as friends. */
$user1['Friends'] .= ($user1['Friends'] ? "," : "").$user2['Username'];
$user2['Friends'] .= ($user2['Friends'] ? "," : "").$user1['Username'];

/* Edit the two users accounts to add each other as friends. */
Accounts::EditAccount( $user1 );
Accounts::EditAccount( $user2 );

/* Deletes the things done above if the user hits to delete the request. */
Friends::DeleteRequestsFor( $user1['Username'], $user2['Username'] );

/* Is located in the header. */
header( "Location:./" );
exit;
?>
