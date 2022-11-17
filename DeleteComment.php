<?php
/* Including the needed files to create the database and posts. */
include("inc/create_db.php");
include("lib/posts_class.php");

/* Getting the comment the user wants to delete. */
$comm = $_GET['comment'];

/* Deleting the selected comment. */
Posts::DeleteComment($comm);

?>
