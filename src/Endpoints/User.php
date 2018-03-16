<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Objects\Name;
use Ch0c01dxyz\InstaToken\Objects\UserId;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Interfaces\UserInterface;
use Ch0c01dxyz\InstaToken\Exceptions\UserException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class User implements UserInterface
{
	/**
	 * @var \Ch0c01dxyz\InstaToken\Objects\AccessToken
	 */
	protected $accessToken;

	/**
	 * @var \Http\Client\HttpClient
	 */
	protected $httpClient;

	/**
	 * @var \Http\Message\RequestFactory
	 */
	protected $requestFactory;

	/**
	 * New instance of User class
	 *
	 * @param \Http\Client\HttpClient|null $httpClient
	 * @param \Http\Message\RequestFactory|null $requestFactory
	 */
	public function __construct ( HttpClient $httpClient = null, RequestFactory $requestFactory = null )
	{
		$this->httpClient = $httpClient ?: HttpClientDiscovery::find ();

		$this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find ();
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
	 * @return object Access Token
	 */
	public function getToken () : AccessToken
	{
		return $this->accessToken;
	}

	/**
	 * Get User Information from Access Token
	 *
	 * @return array
	 */
	public function getSelf () : array
	{
		$uri = sprintf ( "https://api.instagram.com/v1/users/self/?access_token=%s", $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new UserException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get User Information from UserId
	 *
	 * @return array
	 */
	public function getInfo ( UserId $userId ) : array
	{
		if ( false === ( $userId instanceof UserId ) )
		{
			throw new UserException ( "Current param isn't instance of UserId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/users/%s/?access_token=%s", ( string ) $userId->__toInt(), $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new UserException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get User Media
	 *
	 * @return array
	 */
	public function getMedia () : array
	{
		$uri = sprintf ( "https://api.instagram.com/v1/users/self/media/recent?access_token=%s", $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new UserException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get Media liked by User
	 *
	 * @return array
	 */
	public function getLiked () : array
	{
		$uri = sprintf ( "https://api.instagram.com/v1/users/self/media/liked?access_token=%s", $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new UserException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Search user by Name in Application
	 *
	 * @param object Name $name
	 * @return array
	 */
	public function searchUser ( Name $name ) : array
	{
		if ( false === ( $name instanceof Name ) )
		{
			throw new UserException ( "Current param isn't instance of Name Class." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/users/search?q=%s&access_token=%s", $name->__toString (), $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new UserException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get recent media from given User
	 *
	 * @return array
	 */
	public function readUserMedia ( UserId $userId ) : array
	{
		if ( false === ( $userId instanceof UserId ) )
		{
			throw new UserException ( "Current param isn't instance of UserId Class." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/users/%s/media/recent/?access_token=%s", $userId->__toInt (), $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new UserException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}
}
