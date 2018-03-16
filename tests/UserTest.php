<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Ch0c01dxyz\InstaToken\Endpoints\User;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\UserId;
use Ch0c01dxyz\InstaToken\Objects\Name;
use PHPUnit\Framework\TestCase;

class TestUser extends TestCase
{
	public function testCanGetClassInstance ()
	{
		$user = new User ();

		$this->assertInstanceOf ( User::class, $user );
	}

	public function testCanGetObjectAccessTokenInstance ()
	{
		$accessToken = new AccessToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$this->assertInternalType ( "object", $accessToken );

		$this->assertInstanceOf ( AccessToken::class, $accessToken );

		$this->assertEquals ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50", $accessToken->__toString () );
	}

	public function testCanGetObjectUserIdInstance ()
	{
		$userId = new UserId ( 4702717189 );

		$this->assertInternalType ( "object", $userId );

		$this->assertInstanceOf ( UserId::class, $userId );

		$this->assertEquals ( 4702717189, $userId->__toInt () );
	}

	public function testCanGetObjectNameInstance ()
	{
		$name = new Name ( "test" );

		$this->assertInternalType ( "object", $name );

		$this->assertInstanceOf ( Name::class, $name );

		$this->assertEquals ( "test", $name->__toString () );
	}

	public function testCanGetSelf ()
	{
		$user = new User ();

		$this->assertInternalType ( "object", $user );

		$this->assertInstanceOf ( User::class, $user );

		$user->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$output = $user->getSelf ();

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanGetInfo ()
	{
		$user = new User ();

		$this->assertInstanceOf ( User::class, $user );

		$user->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$userId = new UserId ( 4702717189 );

		$this->assertInstanceOf ( UserId::class, $userId );

		$output = $user->getInfo ( $userId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanGetMedia ()
	{
		$user = new User ();

		$this->assertInstanceOf ( User::class, $user );

		$user->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$output = $user->getMedia ();

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanGetLiked ()
	{
		$user = new User ();

		$this->assertInstanceOf ( User::class, $user );

		$user->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$output = $user->getLiked ();

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanSearchUser ()
	{
		$user = new User ();

		$this->assertInstanceOf ( User::class, $user );

		$user->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$name = new Name ( "test" );

		$this->assertInstanceOf ( Name::class, $name );

		$output = $user->searchUser ( $name );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanReadUserMedia ()
	{
		$user = new User ();

		$this->assertInstanceOf ( User::class, $user );

		$user->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$userId = new UserId ( 4702717189 );

		$this->assertInstanceOf ( UserId::class, $userId );

		$output = $user->readUserMedia ( $userId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}
}