<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\UserId;
use Ch0c01dxyz\InstaToken\Objects\Action;
use Ch0c01dxyz\InstaToken\Interfaces\RelationInterface;
use Ch0c01dxyz\InstaToken\Exceptions\RelationException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Relation implements RelationInterface
{
	/**
	 * @var \Ch0c01dxyz\InstaToken\Objects\AccessToken
	 */
	protected $accessToken;

	/**
	 * @var \Ch0c01dxyz\InstaToken\Objects\UserId
	 */
	protected $userId;

	/**
	 * @var \Ch0c01dxyz\InstaToken\Objects\Username
	 */
	protected $username;

	/**
	 * @var \Http\Client\HttpClient
	 */
	protected $httpClient;

	/**
	 * @var \Http\Message\RequestFactory
	 */
	protected $requestFactory;

	/**
	 * @var \Ch0c01dxyz\InstaToken\Objects\Action
	 */
	protected $action;

	/**
	 * @var \Http\Message\MultipartStream\MultipartStreamBuilder
	 */
	protected $builder;

	/**
	 * New instance of Relation class
	 *
	 * @param \Http\Client\HttpClient|null $httpClient
	 * @param \Http\Message\RequestFactory|null $requestFactory
	 */
	public function __construct ( HttpClient $httpClient = null, RequestFactory $requestFactory = null )
	{
		$this->httpClient = $httpClient ?: HttpClientDiscovery::find ();

		$this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find ();

		$this->builder = new MultipartStreamBuilder ();
	}

	/**
	 * Access Token Setter
	 *
	 * @param string $token
	 */
	public function setToken ( $token )
	{
		$this->accessToken = new AccessToken ( $token );
	}

	/**
	 * Access Token Getter
	 *
	 * @return object AccessToken
	 */
	public function getToken () : AccessToken
	{
		return $this->accessToken;
	}

	/**
	 * Get User Following
	 *
	 * @return array
	 */
	public function getFollow () : array
	{
		$uri = sprintf ( "https://api.instagram.com/v1/users/self/follows?access_token=%s", $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new RelationException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get User Follower
	 *
	 * @return array
	 */
	public function getFollowedBy () : array
	{
		$uri = sprintf ( "https://api.instagram.com/v1/users/self/followed-by?access_token=%s", $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new RelationException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get User Request Follow List
	 *
	 * @return array
	 */
	public function getRequestedBy () : array
	{
		$uri = sprintf ( "https://api.instagram.com/v1/users/self/requested-by?access_token=%s", $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new RelationException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get User Relationship
	 *
	 * @return array
	 */
	public function getRelation ( UserId $userId ) : array
	{
		if ( false == ( $userId instanceof UserId ) )
		{
			throw new RelationException ( "Current param isn't instance of UserId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/users/%s/relationship?access_token=%s", $userId->__toInt (), $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new RelationException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Change user Relationship
	 *
	 * @param object UserId $userId
	 * @param object Action $action
	 * @return array
	 */
	public function changeRelation ( UserId $userId, Action $action ) : array
	{
		if ( false == ( $action instanceof Action ) )
		{
			throw new RelationException ( "Current param isn't instance of Action." );
		}

		if ( false == ( $userId instanceof UserId ) )
		{
			throw new RelationException ( "Current param isn't instance of UserId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/users/%s/relationship?access_token=%s", $userId->__toInt (), $this->accessToken );

		$this->builder->addResource ( "action", $action );

		$request = $this->requestFactory->createRequest ( "POST", $uri, [
			"Content-Type" => 'multipart/form-data; boundary="' . $this->builder->getBoundary () . '"'
		], ( string ) $this->builder->build () );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new RelationException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}
}