<?php

// delete login cookie
//setcookie( "user", "", time() - 3600, "/" );
session_Start();
session_Destroy();

// redirect
header("Location:./");
exit;

?>
