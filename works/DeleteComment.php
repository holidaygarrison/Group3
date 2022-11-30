<?php

include("inc/create_db.php");
include("lib/posts_class.php");

$comm = $_GET['comment'];

Posts::DeleteComment($comm);

?>
