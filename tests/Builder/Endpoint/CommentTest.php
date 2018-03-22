<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder\Endpoint;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Comment;

class CommentTest extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(Comment::class, new Comment);
	}

	public function testCanGetURIWithMediaSubpath()
	{
		$q = (new Comment)
			->withMedia();
		$this->assertInstanceOf(Comment::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithMediaIDSubpath()
	{
		$q = (new Comment)
			->withMediaId((string)(new \Ch0c01dxyz\InstaToken\Objects\MediaId('mbuh')));
		$this->assertInstanceOf(Comment::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithCommentSubpath()
	{
		$q = (new Comment)
			->withComment('this_is_a_comment');
		$this->assertInstanceOf(Comment::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}

	public function testCanGetURIWithCommentIDSubpath()
	{
		$q = (new Comment)
			->withCommentId((string)(new \Ch0c01dxyz\InstaToken\Objects\CommentId(3453456)));
		$this->assertInstanceOf(Comment::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty((string)$q);
	}
}