<?php
/* This controls the posts stored in the database. */
class Posts
{
	/* When the user adds an image and text to the create post popup, it will be stored in the database. */
	static public function CreatePost( $uid, $msg=null, $img=null )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		if( !$msg && !$img )
			return FALSE;

		$msg = htmlspecialchars($msg);


		$sql = "INSERT INTO posts (ID, Date, User, Msg, Img) VALUES (NULL, '".date("Y-m-d")."', '$uid', ".($msg ? "'$msg'" : "NULL").", ".($img ? "'$img'" : "NULL").");";
		$MHDB->query($sql);

		$id = $MHDB->insert_id;

		return $id;
	}

	/* When the user changes anything with the Edit Post popup, it will be updated in the database. */
	static public function EditPost( $pid, $msg=null, $img=null )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$msg && !$img )
			return FALSE;

		$msg = htmlspecialchars($msg);

		$sql = "UPDATE posts SET ".($msg ? "Msg = '".$msg."'" : "").
			($msg && $img ? ", " : "").
			($img ? "Img = '".$img."'" : "").
			"WHERE posts.ID = '$pid'";
		$MHDB->query($sql);

		return TRUE;	
	}

	/* When the user selects the delete button for a post and goes through with it, the post information will be deleted from the database. */
	static public function DeletePost( $pid )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$pid )
			return FALSE;

		$sql = "DELETE FROM posts WHERE ID = '".$pid."'";
		$MHDB->query($sql);

		$sql = "DELETE FROM comments WHERE Post = '".$pid."'";
		$MHDB->query($sql);

		return TRUE;
	}

	/* This is what pulls information about a post to display on the website. */
	static public function GetPostInfo( $pid )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$pid )
			return FALSE;

		$sql = "SELECT * FROM posts WHERE ID = '$pid'";
		$result = $MHDB->query($sql)->fetch_assoc();

		return $result;
	}

	/* This selects all of the posts in the database. */
	static public function GetAllPosts()
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		$sql = "SELECT * FROM posts";
		$result = $MHDB->query($sql);

		$res = [];
		while( $row = $result->fetch_assoc() )
			$res[] = $row;

		return $res;
	}

	/* This will select a specific number or range of posts from the database. */
	static public function GetPostsFor( $uid )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$uid )
			return FALSE;

		$sql = "SELECT * FROM posts WHERE User = '$uid' ORDER BY posts.Date DESC";
		$result = $MHDB->query($sql);
		$res = [];
		while($row = $result->fetch_assoc())
			$res[] = $row;

		return $res;
	}

	/* This will the delete the specified users post from their profile. */
	static public function DeleteUsersPosts( $uname )
	{
		global $MHDB;
                if(!$MHDB)
                        return FALSE;

		$posts = self::GetPostsFor($uname);
		foreach( $posts as $post )
		{
			self::DeletePost($post['ID']);
		}

		$sql = "DELETE FROM comments WHERE User = '".$uname."'";
		$MHDB->query($sql);

		return TRUE;
	}

	/* This accumulates the number of likes a post has. */
	static public function LikePost( $uname, $pid )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$uname || !$pid )
			return FALSE;

		$sql = "SELECT Likes FROM posts WHERE ID = '$pid'";
		$result = $MHDB->query($sql);

		if( $result->num_rows > 0 ){
			$likes = $result->fetch_assoc();
			$likes = $likes['Likes'];

			$likes = $likes.($likes ? "," : "").$uname;
			$sql = "UPDATE posts SET Likes = '$likes' WHERE posts.ID = '$pid'";
			$MHDB->query($sql);
			return TRUE;
		}
		else
			return FALSE; 
	}

	/* This accumulates the number of dislikes a post has. */
	static public function DislikePost( $uname, $pid )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$uname || !$pid )
			return FALSE;

		$sql = "SELECT Dislikes FROM posts WHERE ID = '$pid'";
		$result = $MHDB->query($sql);

		if( $result->num_rows > 0 ){
			$dislikes = $result->fetch_assoc();
			$dislikes = $dislikes['Dislikes'];

			$dislikes = $dislikes.($dislikes ? "," : "").$uname;
			$sql = "UPDATE posts SET Dislikes = '$dislikes' WHERE posts.ID = '$pid'";
			$MHDB->query($sql);
			return TRUE;
		}
		else
			return FALSE;
	}

	/* This accumulates the number of shares a post has. */
	static public function SharePost( $uname, $pid, $msg=null )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$uname || !$pid )
			return FALSE;

		$msg = htmlspecialchars($msg);

		$sql = "INSERT INTO posts (ID, Date, User, Msg, Img, Share) VALUES (NULL, '".date("Y-m-d")."', '$uname', ".($msg ? "'$msg'" : "NULL").", NULL, '$pid')";
		$MHDB->query($sql);
		$id = $MHDB->insert_id;

		return $id;
	}

	/* This stores the comment the user made in the database. */
	static public function MakeComment( $uname, $pid, $msg )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$uname || !$pid || !$msg )
			return FALSE;

		$msg = htmlspecialchars($msg);

		$sql = "INSERT INTO comments (ID, Date, User, Post, Msg) VALUES (NULL, '".date("Y-m-d")."', '$uname', '$pid', '$msg')";
		$MHDB->query($sql);
		$id = $MHDB->insert_id;

		return $id;
	}

	/* This gets the inputted comment information from the database to display it on the website. */
	static public function GetCommentInfo( $cid )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if(!$cid)
			return FALSE;

		$sql = "SELECT * FROM comments WHERE ID = '".$cid."'";
		$result = $MHDB->query($sql)->fetch_assoc();

		return $result;
	}

	/* This deletes a comment from the database. */
	static public function DeleteComment( $cid )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if(!$cid)
			return FALSE;

		$sql = "DELETE FROM comments WHERE ID = '".$cid."'";
		$MHDB->query($sql);

		return TRUE;
	}

	/* This gets the comments linked to a specific post. */
	static public function GetCommentsForPost( $pid )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if(!$pid)
			return FALSE;

		$sql = "SELECT * FROM comments WHERE Post = '$pid'";
		$result = $MHDB->query($sql);

		$res = [];
		while($row = $result->fetch_assoc())
			$res[] = $row;

		return $res;
	}
}

?>
