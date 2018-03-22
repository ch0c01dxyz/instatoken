<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\Tests\InstaToken\Builder;

use PHPUnit\Framework\TestCase;
use Ch0c01dxyz\InstaToken\Builder\CredentialBuilder;

class CredentialBuilderTest extends TestCase
{
	public function testCanGetInstance()
	{
		$this->assertInstanceOf(CredentialBuilder::class, new CredentialBuilder);
	}

	public function testCanSetAppID()
	{
		$q = (new CredentialBuilder)
			->setAppID('3453426345');
		$this->assertInstanceOf(CredentialBuilder::class, $q);
		$this->assertNotEmpty($q->getAppID());
	}

	public function testCanSetAppSecret()
	{
		$q = (new CredentialBuilder)
			->setAppSecret(md5(uniqid()));
		$this->assertInstanceOf(CredentialBuilder::class, $q);
		$this->assertNotEmpty($q->getAppSecret());
	}

	public function testCanSetAppCallback()
	{
		$q = (new CredentialBuilder)
			->setAppCallback('http://example.com/shit/?a=1&b=2');
		$this->assertInstanceOf(CredentialBuilder::class, $q);
		$this->assertNotEmpty($q->getAppCallback());
	}

	public function testCanSetAppScope()
	{
		$q = (new CredentialBuilder)
			->setAppScope('sandbox');
		$this->assertInstanceOf(CredentialBuilder::class, $q);
		$this->assertNotEmpty($q->getAppScope());
	}

	/**
	 * @expectedException \RuntimeException
	 */
	public function testCanRaiseExceptionWhenGetUnexistedAppID()
	{
		$q = new CredentialBuilder;
		$this->assertInstanceOf(CredentialBuilder::class, $q);
		$q->getAppID();
	}

	/**
	 * @expectedException \RuntimeException
	 */
	public function testCanRaiseExceptionWhenGetUnexistedAppSecret()
	{
		$q = new CredentialBuilder;
		$this->assertInstanceOf(CredentialBuilder::class, $q);
		$q->getAppSecret();
	}

	/**
	 * @expectedException \RuntimeException
	 */
	public function testCanRaiseExceptionWhenGetUnexistedAppCallback()
	{
		$q = new CredentialBuilder;
		$this->assertInstanceOf(CredentialBuilder::class, $q);
		$q->getAppCallback();
	}

	/**
	 * @expectedException \RuntimeException
	 */
	public function testCanRaiseExceptionWhenGetUnexistedAppScope()
	{
		$q = new CredentialBuilder;
		$this->assertInstanceOf(CredentialBuilder::class, $q);
		$q->getAppScope();
	}
}