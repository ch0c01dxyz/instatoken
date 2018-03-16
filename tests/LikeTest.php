<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Ch0c01dxyz\InstaToken\Endpoints\Like;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Exception\LikeException;
use PHPUnit\Framework\TestCase;

class TestLike extends TestCase
{
	public function testCanGetInstance ()
	{
		$like = new Like ();

		$this->assertInstanceOf ( Like::class, $like );
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

	public function testGetlistLike ()
	{
		$like = new Like ();

		$this->assertInternalType ( "object", $like );

		$this->assertInstanceOf ( Like::class, $like );

		$like->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$mediaId = new MediaId ( "1646083434600705789_4702717189" );

		$this->assertInternalType ( "object", $mediaId );

		$this->assertInstanceOf ( MediaId::class, $mediaId );

		$output = $like->listLike ( $mediaId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testSendLike ()
	{
		$like = new Like ();

		$this->assertInternalType ( "object", $like );

		$this->assertInstanceOf ( Like::class, $like );

		$like->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$mediaId = new MediaId ( "1646083434600705789_4702717189" );

		$this->assertInternalType ( "object", $mediaId );

		$this->assertInstanceOf ( MediaId::class, $mediaId );

		$output = $like->sendLike ( $mediaId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testDeleteLike ()
	{
		$like = new Like ();

		$this->assertInternalType ( "object", $like );

		$this->assertInstanceOf ( Like::class, $like );

		$like->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$mediaId = new MediaId ( "1646083434600705789_4702717189" );

		$this->assertInternalType ( "object", $mediaId );

		$this->assertInstanceOf ( MediaId::class, $mediaId );

		$output = $like->deleteLike ( $mediaId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}
}