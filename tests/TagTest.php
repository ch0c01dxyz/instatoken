<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Ch0c01dxyz\InstaToken\Endpoints\Tag;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\TagName;
use Ch0c01dxyz\InstaToken\Exception\TagException;
use PHPUnit\Framework\TestCase;

class TestTag extends TestCase
{
	public function testCanGetInstance ()
	{
		$tag = new Tag ();

		$this->assertInstanceOf ( Tag::class, $tag );
	}

	public function testCanGetObjectAccessTokenInstance ()
	{
		$accessToken = new AccessToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$this->assertInternalType ( "object", $accessToken );

		$this->assertInstanceOf ( AccessToken::class, $accessToken );

		$this->assertEquals ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50", $accessToken->__toString () );
	}

	public function testcanGetObjectTagNameInstance ()
	{
		$tagName = new TagName ( "Test" );

		$this->assertInternalType ( "object", $tagName );

		$this->assertInstanceOf ( TagName::class, $tagName );

		$this->assertEquals ( "Test", $tagName->__toString () );
	}

	public function testCanGetListTag ()
	{
		$tag = new Tag ();

		$this->assertInternalType ( "object", $tag );

		$this->assertInstanceOf ( Tag::class, $tag );

		$tag->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$tagName = new TagName ( "test" );

		$this->assertInternalType ( "object", $tagName );

		$this->assertInstanceOf ( TagName::class, $tagName );

		$output = $tag->listTag ( $tagName );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanGetInfoTag ()
	{
		$tag = new Tag ();

		$this->assertInternalType ( "object", $tag );

		$this->assertInstanceOf ( Tag::class, $tag );

		$tag->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$tagName = new TagName ( "test" );

		$this->assertInternalType ( "object", $tagName );

		$this->assertInstanceOf ( TagName::class, $tagName );

		$output = $tag->infoTag ( $tagName );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanSearchTag ()
	{
		$tag = new Tag ();

		$this->assertInternalType ( "object", $tag );

		$this->assertInstanceOf ( Tag::class, $tag );

		$tag->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$tagName = new TagName ( "test" );

		$this->assertInternalType ( "object", $tagName );

		$this->assertInstanceOf ( TagName::class, $tagName );

		$output = $tag->searchTag ( $tagName );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}
}