<?php
include( "inc/create_db.php" );
include( "lib/posts_class.php" );
include( "lib/accounts_class.php" );
include( "lib/friends_class.php" );

$user1 = $_POST['User1'];
$user2 = $_POST['User2'];

$user1 = Accounts::GetAccountInfo($user1);
$user2 = Accounts::GetAccountInfo($user2);

$friends = explode(",", $user1['Friends']);
$index = array_search( $user2['Username'], $friends );
if( $index !== FALSE ) unset($friends[$index]);
$user1['Friends'] = implode(",", $friends);
Accounts::EditAccount($user1);

$friends = explode(",", $user2['Friends']);
$index = array_search($user1['Username'], $friends);
if( $index !== FALSE ) unset($friends[$index]);
$user2['Friends'] = implode(",", $friends);
Accounts::EditAccount($user2);

header("Location:profile.php?d=".$user2['Username']);
exit;
?>
