<?php
/* Including the files needed for the database, post, and user account. */
include "inc/create_db.php";
include "lib/posts_class.php";
include "lib/accounts_class.php";

/* Stating all of the information on the users profile. */
$ID = $_POST['ID'];
$FName = $_POST['FName'];
$LName = $_POST['LName'];
$Gender = $_POST['Gender'];
$BDay = $_POST['Birthday'];
$Email = $_POST['Email'];

/* Getting all of the information on the users profile. */
$info['ID'] = $ID;
$info['FName'] = $FName;
$info['LName'] = $LName;
$info['Gender'] = $Gender;
$info['Birthday'] = $BDay;
$info['Email'] = $Email;

/* Editing the certain information on the users profile. */
Accounts::EditAccount($info);

header("Location:profile.php");
exit;
?>
