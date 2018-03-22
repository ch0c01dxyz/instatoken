<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder\Endpoint;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Relationship;

class RelationshipTest extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(Relationship::class, new Relationship);
	}

	public function testCanGetURIWithUsersSubpath()
	{
		$q = (new Relationship)
			->withUsers();
		$this->assertInstanceOf(Relationship::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithSelfSubpath()
	{
		$q = (new Relationship)
			->withSelf();
		$this->assertInstanceOf(Relationship::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithFollowsSubpath()
	{
		$q = (new Relationship)
			->withFollows();
		$this->assertInstanceOf(Relationship::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithFollowedBySubpath()
	{
		$q = (new Relationship)
			->withFollowedBy();
		$this->assertInstanceOf(Relationship::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithRequestedBySubpath()
	{
		$q = (new Relationship)
			->withRequestedBy();
		$this->assertInstanceOf(Relationship::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithUserIDSubpath()
	{
		$q = (new Relationship)
			->withUserId((string)(new \Ch0c01dxyz\InstaToken\Objects\UserId(53465)));
		$this->assertInstanceOf(Relationship::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithRelationshipSubpath()
	{
		$q = (new Relationship)
			->withRelationship();
		$this->assertInstanceOf(Relationship::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}
}