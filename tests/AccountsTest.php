<?php

include( "/mnt/c/xampp/htdocs/software_engineering/inc/create_db.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/posts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/accounts_class.php" );


use PHPUnit\Framework\TestCase;

final class AccountsTest extends TestCase
{
	/* This checks that the account was created correctly. */
	public function testCreateAccount()
	{
		$uname = "TestUser";
		$pwd = "password";

		$id = Accounts::CreateAccount( $uname, $pwd );
		$info = Accounts::GetAccountInfo($id);

		$this->assertSame( strval($id), $info['ID'] );
		$this->assertSame( $uname, $info['Username'] );
		$this->assertSame( $pwd, $info['PWD'] );
		$this->assertEmpty( $info['Friends'] );
	}

	/* This checks to make sure the username and password are correct. */
	public function testCheckPWD()
	{
		$uname = "TestUser";
		$pwd = "password";

		$this->assertTrue( Accounts::CheckPWD( $uname, $pwd ) );
	}

	/* This checks to make sure that account was deleted. */
	public function testDeleteAccount()
	{
		$uname = "TestUser";

		$this->assertTrue( Accounts::DeleteAccount( $uname ) );
	}
}
