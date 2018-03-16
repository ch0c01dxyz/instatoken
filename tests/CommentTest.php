<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Ch0c01dxyz\InstaToken\Endpoints\Comment;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Objects\CommentId;
use PHPUnit\Framework\TestCase;

class TestComment extends TestCase
{
	public function testCanGetInstance ()
	{
		$comment = new Comment ();

		$this->assertInstanceOf ( Comment::class, $comment );
	}

	public function testCanGetObjectAccessTokenInstance ()
	{
		$accessToken = new AccessToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$this->assertInternalType ( "object", $accessToken );

		$this->assertInstanceOf ( AccessToken::class, $accessToken );

		$this->assertEquals ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50", $accessToken->__toString () );
	}

	public function testCanGetObjectMediaIdInstance ()
	{
		$mediaId = new MediaId ( "1646083434600705789_4702717189" );

		$this->assertInternalType ( "object", $mediaId );

		$this->assertInstanceOf ( MediaId::class, $mediaId );

		$this->assertEquals ( "1646083434600705789_4702717189", $mediaId->__toString () );
	}

	public function testCanGetObjectCommentIdInstance ()
	{
		$commentId = new CommentId ( 17848231285217753 );

		$this->assertInternalType ( "object", $commentId );

		$this->assertInstanceOf ( CommentId::Class, $commentId );

		$this->assertEquals ( 17848231285217753, $commentId->__toInt () );
	}

	public function testGetlistComment ()
	{
		$comment = new Comment ();

		$this->assertInternalType ( "object", $comment );

		$this->assertInstanceOf ( Comment::class, $comment );

		$comment->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$mediaId = new MediaId ( "1646083434600705789_4702717189" );

		$this->assertInternalType ( "object", $mediaId );

		$this->assertInstanceOf ( MediaId::class, $mediaId );

		$output = $comment->listComment ( $mediaId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testSendComment ()
	{
		$comment = new Comment ();

		$this->assertInternalType ( "object", $comment );

		$this->assertInstanceOf ( Comment::class, $comment );

		$comment->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$mediaId = new MediaId ( "1646083434600705789_4702717189" );

		$this->assertInternalType ( "object", $mediaId );

		$this->assertInstanceOf ( MediaId::class, $mediaId );

		$textcomment = "test";

		$this->assertInternalType ( "string", $textcomment );

		$output = $comment->sendComment ( $mediaId, $textcomment );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testDeleteComment ()
	{
		$comment = new Comment ();

		$this->assertInternalType ( "object", $comment );

		$this->assertInstanceOf ( Comment::class, $comment );

		$comment->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$mediaId = new MediaId ( "1646083434600705789_4702717189" );

		$this->assertInternalType ( "object", $mediaId );

		$this->assertInstanceOf ( MediaId::class, $mediaId );

		$commentId = new CommentId ( 17848231285217753 );

		$this->assertInternalType ( "object", $commentId );

		$this->assertInstanceOf ( CommentId::class, $commentId );

		$output = $comment->deleteComment ( $mediaId, $commentId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}
}