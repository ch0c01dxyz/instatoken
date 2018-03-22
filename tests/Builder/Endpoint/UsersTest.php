<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder\Endpoint;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Users;

class UsersTest extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(Users::class, new Users);
	}

	public function testCanGetURIWithUsersSubpath()
	{
		$q = (new Users)
			->withUsers();
		$this->assertInstanceOf(Users::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithSelfSubpath()
	{
		$q = (new Users)
			->withSelf();
		$this->assertInstanceOf(Users::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithUserIDSubpath()
	{
		$q = (new Users)
			->withUserId((string)(new \Ch0c01dxyz\InstaToken\Objects\UserId(235346)));
		$this->assertInstanceOf(Users::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithMediaSubpath()
	{
		$q = (new Users)
			->withMedia();
		$this->assertInstanceOf(Users::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithRecentSubpath()
	{
		$q = (new Users)
			->withRecent();
		$this->assertInstanceOf(Users::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithLikedSubpath()
	{
		$q = (new Users)
			->withLiked();
		$this->assertInstanceOf(Users::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithSearchSubpath()
	{
		$q = (new Users)
			->withSearch();
		$this->assertInstanceOf(Users::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}
}