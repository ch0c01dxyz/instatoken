<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder\Endpoint;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Tag;

class TagTest extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(Tag::class, new Tag);
	}

	public function testCanGetURIWithTagsSubpath()
	{
		$q = (new Tag)
			->withTags();
		$this->assertInstanceOf(Tag::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithTagNameSubpath()
	{
		$q = (new Tag)
			->withTagName((string)(new \Ch0c01dxyz\InstaToken\Objects\TagName('dummy')));
		$this->assertInstanceOf(Tag::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithMediaSubpath()
	{
		$q = (new Tag)
			->withMedia();
		$this->assertInstanceOf(Tag::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithRecentSubpath()
	{
		$q = (new Tag)
			->withRecent();
		$this->assertInstanceOf(Tag::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithSearchSubpath()
	{
		$q = (new Tag)
			->withSearch();
		$this->assertInstanceOf(Tag::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}
}