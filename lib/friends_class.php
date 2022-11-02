<?php
class Friends
{
	static public function InitiateRequest( $requestor, $requestee )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;



		$sql = "INSERT INTO friendreq (ID, Sender, Receiver, Date) VALUES (NULL, '".$requestor."', '".$requestee."', '".date("Y-m-d")."');";
		$MHDB->query($sql);

		$id = $MHDB->insert_id;

		return $id;
	}

	static public function CheckRequest( $requestor, $requestee )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		$sql = "SELECT * FROM friendreq WHERE (Sender = '$requestor' AND Receiver = '$requestee') OR (Sender = '$requestee' AND Receiver = '$requestor')";
		$result = $MHDB->query($sql)->fetch_assoc();

		if( !$result )
			return 0;
		elseif( $result['Sender'] == $requestor )
			return 1;
		elseif( $result['Sender'] == $requestee )
			return 2;
		else
			return FALSE;

	}

	static public function DeleteRequestsFor( $u1id, $u2id )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		$sql = "DELETE FROM friendreq WHERE (Sender = '$u1id' AND Receiver = '$u2id') OR (Sender = '$u2id' AND Receiver = '$u1id')";
		$MHDB->query($sql);

		return TRUE;
	}

	static public function GetRequestsFor( $uid )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		$sql = "SELECT * FROM friendreq WHERE Receiver = '$uid'";
		$result = $MHDB->query($sql);
		$res = [];
		while( $row = $result->fetch_assoc() )
			$res[] = $row;

		return $res;
	}
	

}





?>
