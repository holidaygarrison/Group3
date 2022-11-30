<?php
class Posts
{

	public int $id;
	public string $msg = null;
	public string $img = null;
	public string $date = date("Y-m-d");
	public string $user;
	public array $likes = [];
	public array $dislikes = [];
	public int $share = null;

	static public function __construct( int $pid=null, string $uname=null, string $newmsg=null, string $newimg=null )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		if( !$pid ){
			if( !$newmsg && !$newimg )
				return FALSE;

			if( $newmsg )
				$this->msg = $newmsg;
			if( $newimg )
				$this->img = $newimg;
			$this->user = $uname;

			$sql = "INSERT INTO posts (ID, Date, User, Msg, Img) VALUES ( NULL, $date, $user, $msg, $img );";
			$MHDB->query($sql);

			$this->id = $MHDB->insert_id;
			
		} else{

			$sql = "SELECT * FROM posts WHERE ID = '$pid'";
			$result = $MHDB->query($sql)->fetch_assoc();

			$this->id = $result['ID'];
			$this->msg = $result['Msg'];
			$this->img = $result['Img'];
			$this->date = $result['Date'];
			$this->user = $result['User'];
			$this->likes = explode(",", $result['Likes']);
			$this->dislikes = explode(",", $result['Dislikes']);
			$this->share = $result['Share'];

		}
	}

	static public function UpdateDB( bool $del=FALSE )
	{
		global $MHDB;
                if(!$MHDB)
	                return FALSE;

		if( $del ){
			$sql = "DELETE FROM posts WHERE ID = '".$this->id."'";
			$MHDB->query($sql);

			$sql = "DELETE FROM comments WHERE Post = '".$this->id."'";
			$MHDB->query($sql);

			$this->id = $this->msg = $this->img = $this->date = $this->user = $this->likes = $this->dislikes = $this->share = null;

		} else{
			$sql = "UPDATE posts SET Msg = '".$this->msg."', ".
						"Img = '".$this->img."', ".
						"Likes = '".implode(",", $this->likes)."', ".
						"Dislikes = '".implode(",", $this->dislikes)."' ".
			       "WHERE posts.ID = '".$this->id."'";
			$MHDB->query($sql);
			
			return TRUE;
		}
	}

	static public function EditPost( $newmsg=null, $newimg=null )
	{
		if( $newmsg )
			$this->msg = $newmsg;
		if( $newimg )
			$this->img = $newimg;

		$this->UpdateDB();
	}

	static public function DeletePost()
	{
		$this->UpdateDB( TRUE );		
	}

	static public function LikePost( $uname )
	{
		$this->likes[] = $uname;

		$this->UpdateDB();
	}
	static public function DislikePost($uname)
	{
		$this->dislikes[] = $uname;

		$this->UpdateDB();
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
