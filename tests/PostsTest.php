<?php

include( "/mnt/c/xampp/htdocs/software_engineering/inc/create_db.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/posts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/accounts_class.php" );
include( "/mnt/c/xampp/htdocs/software_engineering/lib/friends_class.php" );

use PHPUnit\Framework\TestCase;

final class PostsTest extends TestCase
{

	public function testCreatePost()
	{
		$user = "testuser";
		$msg = "testmsg";
		$img = "testimg";

		$id = Posts::CreatePost( $user, $msg, $img );

		$post = Posts::GetPostInfo( $id );

		$this->assertSame( strval($id), $post['ID'] );
		$this->assertSame( date("Y-m-d"), $post['Date'] );
		$this->assertSame( $user, $post['User'] );
		$this->assertSame( $msg, $post['Msg']);
		$this->assertSame( $img, $post['Img']);
		$this->assertEmpty( $post['Likes'] );
		$this->assertEmpty( $post['Dislikes'] );
		$this->assertEmpty( $post['Share'] );

	}

	public function testEditPost()
	{
		$id = Posts::GetPostsFor("testuser");
		$id = $id[0]['ID'];

		$oldPost = Posts::GetPostInfo( $id );

		$msg = "new testmsg";
		$img = "new testimg";

		Posts::EditPost( $id, $msg, $img );

		$post = Posts::GetPostInfo( $id );

		$this->assertSame( $oldPost['ID'], $post['ID'] );
		$this->assertSame( $oldPost['Date'], $post['Date'] );
		$this->assertSame( $oldPost['User'], $post['User'] );
		$this->assertSame( $msg, $post['Msg']);
		$this->assertSame( $img, $post['Img']);
		$this->assertSame( $oldPost['Likes'], $post['Likes'] );
		$this->assertSame( $oldPost['Dislikes'], $post['Dislikes'] );
		$this->assertSame( $oldPost['Share'], $post['Share'] );

	}


	public function testLikePost()
	{
		$id = Posts::GetPostsFor("testuser");
		$id = $id[0]['ID'];
		$uname = "TestLike";

		$post = Posts::GetPostInfo( $id );
		$this->assertTrue(Posts::LikePost( $uname, $id ));
		$post = Posts::GetPostInfo( $id );

		$this->assertContains( $uname, $post['Likes'] );
		$this->assertCount( 1, explode( ",", $post['Likes'] ) );

		
	}

	public function testSharePost()
	{
		$id = Posts::GetPostsFor("testuser");
		$id = $id[0]['ID'];

		$uname = "testuser";
		$msg = "testmsg";

		$newid = Posts::SharePost( $uname, $id, $msg );
		$post = Posts::GetPostInfo( $newid );

		$this->assertSame( strval($newid), $post['ID'] );
		$this->assertSame( $msg, $post['Msg'] );
		$this->assertSame( strval($id), $post['Share'] );
		
	}

	public function testMakeComment()
	{
		$uname = "testuser";
		$id = Posts::GetPostsFor("testuser");
		$id = $id[0]['ID'];
		$msg = "testmsg";

		$cid = Posts::MakeComment( $uname, $id, $msg );
		$comm = Posts::GetCommentInfo( $cid );

		$this->assertSame( strval( $cid ), $comm['ID'] );
		$this->assertSame( date("Y-m-d"), $comm['Date'] );
		$this->assertSame( $uname, $comm['User'] );
		$this->assertSame( strVal( $id ), $comm['Post'] );
		$this->assertSame( $msg, $comm['Msg'] );

	}

	
	public function testDeletePost()
	{
		$id = Posts::GetPostsFor("testuser");
		$id = $id[0]['ID'];

		Posts::DeletePost( $id );

		$post = Posts::GetPostInfo($id);
		$this->assertEmpty( $post );
		$this->assertEmpty( Posts::GetCommentsForPost( $id ) );
	}



}
