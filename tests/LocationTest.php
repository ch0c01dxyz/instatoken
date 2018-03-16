<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Ch0c01dxyz\InstaToken\Endpoints\Location;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Objects\Map;
use Ch0c01dxyz\InstaToken\Objects\LocationId;
use Ch0c01dxyz\InstaToken\Exception\LocationException;
use PHPUnit\Framework\TestCase;

class TestLocation extends TestCase
{
	public function testCanGetInstance ()
	{
		$location = new Location ();

		$this->assertInstanceOf ( Location::class, $location );
	}

	public function testCanGetObjectAccessTokenInstance ()
	{
		$accessToken = new AccessToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$this->assertInternalType ( "object", $accessToken );

		$this->assertInstanceOf ( AccessToken::class, $accessToken );

		$this->assertEquals ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50", $accessToken->__toString () );
	}

	public function testCanGetObjectLocationIdInstance ()
	{
		$locationId = new LocationId ( 399201265 );

		$this->assertInternalType ( "object", $locationId );

		$this->assertInstanceOf ( LocationId::class, $locationId );

		$this->assertEquals ( 399201265, $locationId->__toString () );
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

	public function testGetInfoLocation ()
	{
		$location = new Location ();

		$this->assertInternalType ( "object", $location );

		$this->assertInstanceOf ( Location::class, $location );

		$location->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$locationId = new LocationId ( 399201265 );

		$this->assertInternalType ( "object", $locationId );

		$this->assertInstanceOf ( LocationId::class, $locationId );

		$output = $location->infoLocation ( $locationId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testGetlistMediaLocation ()
	{
		$location = new Location ();

		$this->assertInternalType ( "object", $location );

		$this->assertInstanceOf ( Location::class, $location );

		$location->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$locationId = new LocationId ( 399201265 );

		$this->assertInternalType ( "object", $locationId );

		$this->assertInstanceOf ( LocationId::class, $locationId );

		$output = $location->listMediaLocation ( $locationId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testSearchLocation ()
	{
		$location = new Location ();

		$this->assertInternalType ( "object", $location );

		$this->assertInstanceOf ( Location::class, $location );

		$location->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$map = new Map ( -6.75, 107.5, 100 );

		$this->assertInternalType ( "object", $map );

		$this->assertInstanceOf ( Map::class, $map );

		$output = $location->searchLocation ( $map );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}
}