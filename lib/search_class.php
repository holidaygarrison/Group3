<?php
class Search
{

	static public function SearchUsers( $search )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		if( !$search )
			return NULL;

		$search = "%".str_replace( " ", "% %", $search)."%";
		$sql = "SELECT * FROM accounts WHERE ".
			"CONCAT(FName, ' ', LName) LIKE '$search' ".
			(strpos($search, " ") === FALSE ? "OR Username LIKE '$search' " : "");
		$result = $MHDB->query($sql);

		$res = [];
		while( $row = $result->fetch_assoc() )
			$res[] = $row;

		return $res;
	}

	static public function SearchPosts( $search )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		if( !$search )
			return NULL;

		$search = "%".str_replace(" ", "% %", $search)."%";
		$sql = "SELECT * FROM posts WHERE ".
			"Msg LIKE '$search'";
		$result = $MHDB->query($sql);

		$res = [];
		while( $row = $result->fetch_assoc() ){
			$row['Msg'] = Posts::TagPost($row['Msg']);
			$res[] = $row;
		}

		return $res;
	}

	static public function SearchTags( $tag )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		if( !$tag )
			return NULL;

		$tag = "%#".$tag;
		$sql = "SELECT * FROM posts WHERE ".
			"Msg LIKE '".$tag."' OR ".
			"Msg LIKE '".$tag." %' OR ".
			"MSg LIKE '".$tag."#%'";
		$result = $MHDB->query($sql);

		$res = [];
		while( $row = $result->fetch_assoc() ){
			$row['Msg'] = Posts::TagPost($row['Msg']);
			$res[] = $row;
		}

		return $res;
	}


}





?>
