<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder\Endpoint;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Location;

class LocationTest extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(Location::class, new Location);
	}

	public function testCanGetURIWithLocationsSubpath()
	{
		$q = (new Location)
			->withLocations();
		$this->assertInstanceOf(Location::class, $q);
		$this->assertInternalType('string', (string)$q);
		$this->assertInternalType('array', $q->build());
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithLocationIdSubpath()
	{
		$q = (new Location)
			->withLocationId('1344634234');
		$this->assertInstanceOf(Location::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithMediaSubpath()
	{
		$q = (new Location)
			->withMedia();
		$this->assertInstanceOf(Location::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithRecentSubpath()
	{
		$q = (new Location)
			->withRecent();
		$this->assertInstanceOf(Location::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithSearchSubpath()
	{
		$q = (new Location)
			->withSearch();
		$this->assertInstanceOf(Location::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}
}