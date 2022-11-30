<?php

include "inc/create_db.php";
include "lib/posts_class.php";
include "lib/accounts_class.php";

$ID = $_POST['ID'];
$FName = $_POST['FName'];
$LName = $_POST['LName'];
$Gender = $_POST['Gender'];
$BDay = $_POST['Birthday'];
$Email = $_POST['Email'];

$info['ID'] = $ID;
$info['FName'] = $FName;
$info['LName'] = $LName;
$info['Gender'] = $Gender;
$info['Birthday'] = $BDay;
$info['Email'] = $Email;

Accounts::EditAccount($info);

header("Location:profile.php");
exit;

?>
