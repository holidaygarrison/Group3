<?php

include( "/mnt/c/xampp/htdocs/software_engineering/inc/create_db.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/posts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/accounts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/friends_class.php" );

use PHPUnit\Framework\TestCase;

final class FriendsTest extends TestCase
{
	/* This tests to see if the friend request went through properly. */
	public function testInitiateRequest()
	{
		$requestor = "TestUser1";
		$requestee = "TestUser2";

		$id = Friends::InitiateRequest( $requestor, $requestee );

		$info = Friends::GetRequestInfo($id);

		$this->assertSame( strval($id), $info['ID'] );
		$this->assertSame( date("Y-m-d"), $info['Date'] );
		$this->assertSame( $requestor, $info['Sender'] );
		$this->assertSame( $requestee, $info['Receiver'] );
	}

	/* This checks to make sure that the friend request went through to the correct friend. */
	public function testCheckRequest()
	{
		$requestor = "TestUser1";
		$requestee = "TestUser2";
		$other = "TestUser3";

		$this->assertSame( 1, Friends::CheckRequest($requestor, $requestee) );
		$this->assertSame( 2, Friends::CheckRequest($requestee, $requestor) );
		$this->assertSame( 0, Friends::CheckRequest($requestee, $other) );
	}

	/* This tests to see that the friend request was right. */
	public function testGetRequestsFor()
	{
		$requestor = "TestUser1";
		$requestee = "TestUser2";

		$requests = Friends::GetRequestsFor($requestee);

		$this->assertSame( 1, count($requests) );
		$this->assertSame( $requestor, $requests[0]['Sender'] );
	}

	/* This checks to make sure that friend was actually deleted. */
	public function testDeleteRequestsFor()
	{
		$requestor = "TestUser1";
		$requestee = "TestUser2";

		$this->assertTrue(Friends::DeleteRequestsFor( $requestor, $requestee ));
	}
}
