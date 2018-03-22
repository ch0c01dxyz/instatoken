<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder\Endpoint;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Like;

class LikeTest extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(Like::class, new Like);
	}

	public function testCanGetURIWithMediaSubpath()
	{
		$q = (new Like)
			->withMedia();
		$this->assertInstanceOf(Like::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithMediaIDSubpath()
	{
		$q = (new Like)
			->withMediaId((string)(new \Ch0c01dxyz\InstaToken\Objects\MediaId('sjdfngsj')));
		$this->assertInstanceOf(Like::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithLikesSubpath()
	{
		$q = (new Like)
			->withLikes();
		$this->assertInstanceOf(Like::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}
}