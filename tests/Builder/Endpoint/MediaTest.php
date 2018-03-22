<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder\Endpoint;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Media;

class MediaTest extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(Media::class, new Media);
	}

	public function testCanGetURIWithMediaSubpath()
	{
		$q = (new Media)
			->withMedia();
		$this->assertInstanceOf(Media::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithMediaIDSubpath()
	{
		$q = (new Media)
			->withMediaId((string)(new \Ch0c01dxyz\InstaToken\Objects\MediaId('@235236234')));
		$this->assertInstanceOf(Media::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithShortcodeSubpath()
	{
		$q = (new Media)
			->withShortcode((string)(new \Ch0c01dxyz\InstaToken\Objects\ShortCode('sdjfgnk')));
		$this->assertInstanceOf(Media::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithSearchSubpath()
	{
		$q = (new Media)
			->withSearch();
		$this->assertInstanceOf(Media::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}
}