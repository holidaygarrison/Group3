<?php

// delete login cookie
setcookie( "user", "", time() - 3600, "/" );

// redirect
header("Location:./");
exit;

?>
