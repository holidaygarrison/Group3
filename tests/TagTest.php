<?php

include( "/mnt/c/xampp/htdocs/software_engineering/inc/create_db.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/posts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/accounts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/friends_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/search_class.php" );

use PHPUnit\Framework\TestCase;

final class TagTest extends TestCase
{
	public function testTagPost()
	{
		$msg = "this is a #test";
		$tagmsg = "this is a <a href='tags.php?t=test'>#test</a> ";

		$this->assertSame( $tagmsg, Posts::TagPost($msg) );
	}

	public function testSearchTags()
	{
		$tag = "TestingTag";

		$search = Search::SearchTags( $tag );

		$this->assertCount( 1, $search );
		$this->assertSame( "1", $search[0]['ID'] );	
	}

	public function testSearchTags2()
	{
		$tag = "test";

		$search = Search::SearchTags($tag);

		$this->assertFalse( array_search( "95", array_column($search, "ID") ) );
	}


}
