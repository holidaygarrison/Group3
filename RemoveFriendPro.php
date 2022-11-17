<?php
/* Includes the needed files for the database, posts, account, and friends. */
include( "inc/create_db.php" );
include( "lib/posts_class.php" );
include( "lib/accounts_class.php" );
include( "lib/friends_class.php" );

/* Sets the two users. */
$user1 = $_POST['User1'];
$user2 = $_POST['User2'];

/* Gets the correct account information for the two users. */
$user1 = Accounts::GetAccountInfo($user1);
$user2 = Accounts::GetAccountInfo($user2);

/* This will delete user 2 from the first users account. */
$friends = explode(",", $user1['Friends']);
$index = array_search( $user2['Username'], $friends );
if( $index !== FALSE ) unset($friends[$index]);
$user1['Friends'] = implode(",", $friends);
Accounts::EditAccount($user1);

/* This will delete user 1 from the second users account. */
$friends = explode(",", $user2['Friends']);
$index = array_search($user1['Username'], $friends);
if( $index !== FALSE ) unset($friends[$index]);
$user2['Friends'] = implode(",", $friends);
Accounts::EditAccount($user2);

header("Location:profile.php?d=".$user2['Username']);
exit;
?>
