<?php
class Accounts
{
	static public function CreateAccount( $uname, $pwd, $fname, $lname, $gen, $bday, $email )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		if( !$uname || !$pwd )
			return FALSE;

		$sql = "INSERT INTO accounts (ID, Username, PWD, FName, LName, Gender, Birthday, Email) VALUES (NULL, '$uname', '$pwd', '$fname', '$lname', '$gen', '$bday', '$email');";
		$MHDB->query($sql);

		$id = $MHDB->insert_id;

		return $id;
	}

	static public function GetAccountInfo( $id )
	{
		global $MHDB;
                if( !$MHDB )
			return FALSE;

		$sql = "SELECT * FROM accounts WHERE ID = '".$id."' OR Username = '".$id."'";
		$result = $MHDB->query($sql)->fetch_assoc();

		return $result;
	}

	static public function EditAccount( $info )
	{
		global $MHDB;
		if( !$MHDB )
			return FALSE;

		$sql = "UPDATE accounts SET ";
		foreach( $info as $key => $data ){
			if( !is_numeric($key) ){
				$sql.= "$key = '$data', ";
			}
		}
		$sql = substr( $sql, 0, -2 );
		$sql .= " WHERE ID = '".$info['ID']."'";

		$MHDB->query($sql);

		return TRUE;
	}

	static public function GetAllAccounts()
	{
		global $MHDB;
	        if(!$MHDB)
	                return FALSE;

		$sql = "SELECT * FROM accounts";
		$result = $MHDB->query($sql);
		$res = [];
		while( $row = $result->fetch_assoc() ){
			$res[] = $row;
		}

		return $res;

	}

	static public function CheckPWD( $uname, $pwd )
	{
		global $MHDB;
                if( !$MHDB )
			return FALSE;

		$sql = "SELECT PWD FROM accounts WHERE Username = '".$uname."'";
		$res = $MHDB->query($sql)->fetch_assoc();
		$realPwd = $res['PWD'];

		if( $realPwd == $pwd )
			return TRUE;
		else
			return FALSE;
	}

	static public function DeleteAccount( $uname )
	{
		global $MHDB;
                if( !$MHDB )
			return FALSE;

		$sql = "DELETE FROM accounts WHERE ID = '".$uname."'";
		$MHDB->query($sql);

		Posts::DeleteUsersPosts($uname);

		//$sql = "DELETE FROM friendreq WHERE Sender = '".$uname."' OR Receiver = '".$uname."'";
		//$MHDB->query($sql);

		return TRUE;


	}

}





?>
