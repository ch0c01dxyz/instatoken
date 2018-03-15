<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Objects\Map;
use Ch0c01dxyz\InstaToken\Interfaces\MediaInterface;
use Ch0c01dxyz\InstaToken\Exceptions\MediaException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Media implements MediaInterface
{
	/**
	 * @var \Ch0c01dxyz\InstaToken\AccessToken
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
	 * New instance of Media class
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
	 * @param string accessToken
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
	 * Get Information from given Media Id
	 *
	 * @return array
	 */
	public function readMedia ( MediaId $mediaId ) : array
	{
		if ( false == ( $mediaId instanceof MediaId ) )
		{
			throw new MediaException ( "Current param isn't Instance of MediaId" );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/%s?access_token=%s", $mediaId, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new MediaException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get Information from given Shortcoded Media
	 *
	 * @return array
	 */
	public function infoMedia ( ShortCode $shortCode ) : array
	{
		if ( false == ( $shortCode instanceof ShortCode ) )
		{
			throw new MediaException ( "Current param isn't Instance Of ShortCode." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/shortcode/%s?access_token=%s", $shortCode, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new MediaException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Search recent Media from given Area
	 *
	 * @return array
	 */
	public function searchMedia ( Map $map ) : array
	{
		if ( false == ( $map instanceof Map ) )
		{
			throw new MediaException ( "Current param isn't Instance of Map." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/search?lat=%s&lng=%s&distance=%s&access_token=%s", $map->getLat (), $map->getLng (), $map->getDistance (), $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new MediaException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}
}