<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\LocationId;
use Ch0c01dxyz\InstaToken\Objects\Map;
use Ch0c01dxyz\InstaToken\Interfaces\LocationInterface;
use Ch0c01dxyz\InstaToken\Exceptions\LocationException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Location implements LocationInterface
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
	 * New instance of Location class
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
	 * Get Information about Location
	 *
	 * @return array
	 */
	public function infoLocation ( LocationId $locationId ) : array
	{
		if ( false == ( $locationId instanceof LocationId ) )
		{
			throw new LocationException ( "Current param isn't instance of LocationId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/locations/%s?access_token=%s", $locationId, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new LocationException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get list of Media object from given Location
	 *
	 * @return array
	 */
	public function listMediaLocation ( LocationId $locationId ) : array
	{
		if ( false == ( $locationId instanceof LocationId ) )
		{
			throw new LocationException ( "Current param isn't instce of LocationId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/locations/%s/media/recent?access_token=%s", $locationId, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new LocationException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Search location by given Geographic coordinate
	 *
	 * @return array
	 */
	public function searchLocation ( Map $map ) : array
	{
		if ( false == ( $map instanceof Map ) )
		{
			throw new LocationException ( "Current param isn't instance of Map." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/locations/search?lat=%s&lng=%s&distance=%s&access_token=%s", $map->getLat (), $map->getLng (), $map->getDistance (), $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new LocationException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}
}