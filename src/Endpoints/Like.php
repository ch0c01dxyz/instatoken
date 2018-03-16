<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Interfaces\LikeInterface;
use Ch0c01dxyz\InstaToken\Exceptions\LikeException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Like implements LikeInterface
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
	 * @var \Http\Message\MultipartStream\MultipartStreamBuilder
	 */
	protected $builder;

	/**
	 * New instance of Like class
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
	public function setToken ( string $token )
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
	 * Get list User who have likes defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function listLike ( MediaId $mediaId ) : array
	{
		if ( false == ( $mediaId instanceof MediaId ) )
		{
			throw new LikeException ( "Current param isn't instance of MediaId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/%s/likes?access_token=%s", $mediaId, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new LikeException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Send like to defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function sendLike ( MediaId $mediaId ) : array
	{
		if ( false == ( $mediaId instanceof MediaId ) )
		{
			throw new LikeException ( "Current param isn't instance of MediaId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/%s/likes", $mediaId );

		$this->builder->addResource ( "access_token", $this->accessToken );

		$request = $this->requestFactory->createRequest ( "POST", $uri, [
			"Content-Type" => 'multipart/form-data; boundary="' . $this->builder->getBoundary () . '"'
		], ( string ) $this->builder->build () );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new LikeException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Remove like from defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function deleteLike ( MediaId $mediaId ) : array
	{
		if ( false == ( $mediaId instanceof MediaId ) )
		{
			throw new LikeException ( "Current param isn't instance of MediaId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/%s/likes?access_token=%s", $mediaId->__toString (), $this->accessToken );

		$request = $this->requestFactory->createRequest ( "DELETE", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new LikeException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}
}