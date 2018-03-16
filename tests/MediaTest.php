<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Ch0c01dxyz\InstaToken\Endpoints\Media;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Objects\ShortCode;
use Ch0c01dxyz\InstaToken\Objects\Map;
use Ch0c01dxyz\InstaToken\Exception\MediaException;
use PHPUnit\Framework\TestCase;

class TestMedia extends TestCase
{
	public function testCanGetInstance ()
	{
		$media = new Media ();

		$this->assertInstanceOf ( Media::class, $media );
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

	public function testCanGetObjectShortCodeInstance ()
	{
		$shortCode = new ShortCode ( "A" );

		$this->assertInternalType ( "object", $shortCode );

		$this->assertInstanceOf ( ShortCode::class, $shortCode );

		$this->assertEquals ( "A", $shortCode->__toString () );
	}

	public function testCanGetObjectMapInstance ()
	{
		$map = new Map ( -6.8909203, 108.729098, 100 );

		$this->assertInternalType ( "object", $map );

		$this->assertInstanceOf ( Map::class, $map );

		$this->assertEquals ( -6.8909203, $map->getLat () );

		$this->assertEquals ( 108.729098, $map->getLng () );

		$this->assertEquals ( 100, $map->getDistance () );
	}

	public function testCanReadMedia ()
	{
		$media = new Media ();

		$this->assertInternalType ( "object", $media );

		$this->assertInstanceOf ( Media::class, $media );

		$media->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$mediaId = new MediaId ( "1646083434600705789_4702717189" );

		$this->assertInternalType ( "object", $mediaId );

		$this->assertInstanceOf ( MediaId::class, $mediaId );

		$output = $media->readMedia ( $mediaId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanGetInfoMedia ()
	{
		$media = new Media ();

		$this->assertInternalType ( "object", $media );

		$this->assertInstanceOf ( Media::class, $media );

		$media->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$shortCode = new ShortCode ( "BbYECmWB679" );

		$this->assertInternalType ( "object", $shortCode );

		$this->assertInstanceOf ( ShortCode::class, $shortCode );

		$output = $media->infoMedia ( $shortCode );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanSearchMedia ()
	{
		$media = new Media ();

		$this->assertInternalType ( "object", $media );

		$this->assertInstanceOf ( Media::class, $media );

		$media->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$map = new Map ( -6.8909203, 108.729098, 100 );

		$this->assertInternalType ( "object", $map );

		$this->assertInstanceOf ( Map::class, $map );

		$output = $media->searchMedia ( $map );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}
}