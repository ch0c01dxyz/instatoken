<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder\Endpoint;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\OAuth2;

class OAuth2Test extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(OAuth2::class, new OAuth2);
	}

	public function testCanGetURIWithOAuthSubpath()
	{
		$q = (new OAuth2)
			->withOAuth();
		$this->assertInstanceOf(OAuth2::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithAuthorizeSubpath()
	{
		$q = (new OAuth2)
			->withAuthorize();
		$this->assertInstanceOf(OAuth2::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}

	public function testCanGetURIWithAccessTokenSubpath()
	{
		$q = (new OAuth2)
			->withAccessToken();
		$this->assertInstanceOf(OAuth2::class, $q);
		$this->assertInternalType('array', $q->build());
		$this->assertInternalType('string', (string)$q);
		$this->assertNotEmpty($q->build());
	}
}