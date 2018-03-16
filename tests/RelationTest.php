<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Ch0c01dxyz\InstaToken\Endpoints\Relation;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\UserId;
use Ch0c01dxyz\InstaToken\Objects\Action;
use Ch0c01dxyz\InstaToken\Exception\RelationException;
use PHPUnit\Framework\TestCase;

class TestRelation extends TestCase
{
	public function testCanGetInstance ()
	{
		$relation = new Relation ();

		$this->assertInstanceOf ( Relation::class, $relation );
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

	public function testCanGetObjectActionInstance ()
	{
		$action = new Action ( 1 );

		$this->assertInternalType ( "object", $action );

		$this->assertInstanceOf ( Action::class, $action );

		$this->assertEquals ( 1, $action->__toInt() );

		$this->assertEquals ( "unfollow", $action->__toString () );
	}

	public function testCanGetFollow ()
	{
		$relation = new Relation ();

		$this->assertInternalType ( "object", $relation );

		$this->assertInstanceOf ( Relation::class, $relation );

		$relation->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$output = $relation->getFollow ();

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanGetFollowedBy ()
	{
		$relation = new Relation ();

		$this->assertInternalType ( "object", $relation );

		$this->assertInstanceOf ( Relation::class, $relation );

		$relation->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$output = $relation->getFollowedBy ();

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanGetRequestedBy ()
	{
		$relation = new Relation ();

		$this->assertInternalType ( "object", $relation );

		$this->assertInstanceOf ( Relation::class, $relation );

		$relation->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$output = $relation->getRequestedBy ();

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanGetRelation ()
	{
		$relation = new Relation ();

		$this->assertInternalType ( "object", $relation );

		$this->assertInstanceOf ( Relation::class, $relation );

		$relation->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$userId = new UserId ( 4702717189 );

		$this->assertInternalType ( "object", $userId );

		$this->assertInstanceOf ( UserId::class, $userId );

		$output = $relation->getRelation ( $userId );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}

	public function testCanChangeRelation ()
	{
		$relation = new Relation ();

		$this->assertInternalType ( "object", $relation );

		$this->assertInstanceOf ( Relation::class, $relation );

		$relation->setToken ( "4702717189.0120c6f.87be117e24204ea7b06b698d45110b50" );

		$userId = new UserId ( 4702717189 );

		$this->assertInternalType ( "object", $userId );

		$this->assertInstanceOf ( UserId::class, $userId );

		$action = new Action ( 0 );

		$this->assertInternalType ( "object", $action );

		$this->assertInstanceOf ( Action::class, $action );

		$output = $relation->changeRelation ( $userId, $action );

		$this->assertInternalType ( "array", $output );

		$this->assertNotNull ( $output );
	}
}