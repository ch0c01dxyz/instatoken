<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Auth;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Auth\TokenAccessorTrait;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;

class TokenAccessorTraitTest extends TestCase
{
	use TokenAccessorTrait;

	public function testCanGetInstanceOfAccessToken()
	{
		$this->assertInstanceOf(AccessToken::class, new AccessToken);
	}

	public function testCanSetAccessToken()
	{
		$this->token = new AccessToken;
		$this->assertInstanceOf(AccessToken::class, $this->token);
		$this->setAccessToken('this_is_a_dummy_token');
		$this->assertInternalType('string', $this->getAccessToken());
		$this->assertNotEmpty($this->getAccessToken());
	}

	public function testCanGetAccessToken()
	{
		$this->token = new AccessToken;
		$this->assertInstanceOf(AccessToken::class, new AccessToken);
		$this->setAccessToken('this_is_a_dummy_token');
		$this->assertInternalType('string', $this->getAccessToken());
		$this->assertNotEmpty($this->getAccessToken());
	}
}