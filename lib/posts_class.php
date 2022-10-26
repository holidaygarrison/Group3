<?php
class Posts
{

	static public function CreatePost( $uid, $msg=null, $img=null )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		if( !$msg && !$img )
			return FALSE;

		$sql = "INSERT INTO posts (ID, Date, User, Msg, Img) VALUES (NULL, '".date("Y-m-d")."', '$uid', ".($msg ? "'$msg'" : "NULL").", ".($img ? "'$img'" : "NULL").");";
		$MHDB->query($sql);

		$id = $MHDB->insert_id;

		return $id;
	}

	static public function EditPost( $pid, $msg=null, $img=null )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$msg && !$img )
			return FALSE;

		$sql = "UPDATE posts SET ".($msg ? "Msg = '".$msg."'" : "").
			($msg && $img ? ", " : "").
			($img ? "Img = '".$img."'" : "").
			"WHERE posts.ID = '$pid'";
		$MHDB->query($sql);

		return TRUE;

		
	}

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
		}else{
			return FALSE;
		}
		 
	}

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
		}else{
			return FALSE;
		}
		 
	}

	static public function SharePost( $uname, $pid, $msg=null )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$uname || !$pid )
			return FALSE;

		$sql = "INSERT INTO posts (ID, Date, User, Msg, Img, Share) VALUES (NULL, '".date("Y-m-d")."', '$uname', ".($msg ? "'$msg'" : "NULL").", NULL, '$pid')";
		$MHDB->query($sql);
		$id = $MHDB->insert_id;

		return $id;
	}

	static public function MakeComment( $uname, $pid, $msg )
	{
		global $MHDB;
		if(!$MHDB)
			return FALSE;

		if( !$uname || !$pid || !$msg )
			return FALSE;

		$sql = "INSERT INTO comments (ID, Date, User, Post, Msg) VALUES (NULL, '".date("Y-m-d")."', '$uname', '$pid', '$msg')";
		$MHDB->query($sql);
		$id = $MHDB->insert_id;

		return $id;
	}

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
