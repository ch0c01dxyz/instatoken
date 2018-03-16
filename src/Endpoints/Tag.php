<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\TagName;
use Ch0c01dxyz\InstaToken\Interfaces\TagInterface;
use Ch0c01dxyz\InstaToken\Exceptions\TagException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Tag implements TagInterface
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
	 * New instance of Tag class
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
	 * @param Access Token Setter
	 */
	public function setToken ( $token )
	{
		$this->accessToken = new AccessToken ( $token );
	}

	/**
	 * @return Access Token Getter
	 */
	public function getToken () : AccessToken
	{
		return $this->accessToken;
	}

	/**
	 * Get recent Tag Media
	 *
	 * @param string $tagName
	 * @return array
	 */
	public function listTag ( TagName $tagName ) : array
	{
		if ( false === ( $tagName instanceof TagName ) )
		{
			throw new TagException ( "Current param isn't instance of TagName." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/tags/%s?access_token=%s", $tagName, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new TagException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Get Information about Tag object
	 *
	 * @param string $tagName
	 * @return array
	 */
	public function infoTag ( TagName $tagName ) : array
	{
		if ( false === ( $tagName instanceof TagName ) )
		{
			throw new TagException ( "Current param isn't instance of TagName." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/tags/%s/media/recent?access_token=%s", $tagName, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new TagException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Search tag by Name
	 *
	 * @param string $tagName
	 * @return array
	 */
	public function searchTag ( TagName $tagName ) : array
	{
		if ( false === ( $tagName instanceof TagName ) )
		{
			throw new TagException ( "Current param isn't instance of TagName." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/tags/search?q=%s&access_token=%s", $tagName, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new TagException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}
}