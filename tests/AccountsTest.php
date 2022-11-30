<?php

include( "/mnt/c/xampp/htdocs/software_engineering/inc/create_db.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/posts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/accounts_class.php" );


use PHPUnit\Framework\TestCase;

final class AccountsTest extends TestCase
{


	public function testCreateAccount()
	{
		$uname = "TestUser";
		$pwd = "password";
		$fname = "Firstname";
		$lname = "Lastname";
		$gen = "Gender";
		$bday = "2000-01-01";
		$email = "email@email.com";

		$id = Accounts::CreateAccount( $uname, $pwd, $fname, $lname, $gen, $bday, $email );
		$info = Accounts::GetAccountInfo($id);

		$this->assertSame( strval($id), $info['ID'] );
		$this->assertSame( $uname, $info['Username'] );
		$this->assertSame( $pwd, $info['PWD'] );
		$this->assertSame( $fname, $info['FName']);
		$this->assertSame( $lname, $info['LName'] );
		$this->assertSame( $gen, $info['Gender'] );
		$this->assertSame( $bday, $info['Birthday'] );
		$this->assertSame( $email, $info['Email'] );
		$this->assertEmpty( $info['Friends'] );
	}


	public function testCheckPWD()
	{
		$uname = "TestUser";
		$pwd = "password";

		$this->assertTrue( Accounts::CheckPWD( $uname, $pwd ) );
	}

	public function testDeleteAccount()
	{
		$uname = "TestUser";

		$this->assertTrue( Accounts::DeleteAccount( $uname ) );
	}


}
