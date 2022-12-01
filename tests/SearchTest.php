<?php

include( "/mnt/c/xampp/htdocs/software_engineering/inc/create_db.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/posts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/accounts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/friends_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/search_class.php" );

use PHPUnit\Framework\TestCase;

final class PostsTest extends TestCase
{

	public function testSearchUsers()
	{
		$user = "TestUser";

		$result = Search::SearchUsers( $user );

		$this->assertCount( 1, $result );
		$this->assertSame( "15", $result[0]['ID'] );
	}

	public function testSearchPosts()
	{
		$search = "#TestingTag";

		$result = Search::SearchPosts($search);

		$this->assertCount( 1, $result );
		$this->assertSame( "1", $result[0]['ID'] );
	}

	public function testSearchTags()
	{
		$tag = "TestingTag";
		$result = Search::SearchTags($tag);

		$this->assertCount( 1, $result );
		$this->assertSame( "1", $result[0]['ID'] );
	}

}
