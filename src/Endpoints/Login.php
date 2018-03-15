<?php

declare ( strict_types = 1 );

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Interfaces\LoginInterface;
use Ch0c01dxyz\InstaToken\Exceptions\LoginException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Login implements LoginInterface
{
	/**
	 * @var [type]
	 */
	protected $appId;

	/**
	 * @var [type]
	 */
	protected $appSecret;

	/**
	 * @var [type]
	 */
	protected $appCallback;

	/**
	 * @var [type]
	 */
	protected $appScope;

	/**
	 * @var [type]
	 */
	protected $responseCode;

	/**
	 * @var [type]
	 */
	protected $result;

	/**
	 * @var \Http\Client\HttpClient
	 */
	protected $httpClient;

	/**
	 * @var \Http\Message\RequestFactory
	 */
	protected $requestFactory;

	/**
	 * New instance of Login class
	 *
	 * @param string $appId
	 * @param string $appSecret
	 * @param string $appCallback
	 * @param \Http\Client\HttpClient|null $httpClient
	 * @param \Http\Message\RequestFactory|null $requestFactory
	 */
	public function __construct ( string $appId, string $appSecret, string $appCallback, HttpClient $httpClient = null, RequestFactory $requestFactory = null )
	{
		$this->appId = ( string ) $appId;

		$this->appSecret = ( string ) $appSecret;

		$this->appCallback = ( string ) $appCallback;

		$this->httpClient = $httpClient ?: HttpClientDiscovery::find ();

		$this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find ();
	}

	/**
	 * Get URL Login redirect Instagram
	 */
	public function getLogin () : string
	{
		if ( empty ( $this->appId ) )
		{
			throw new LoginException ( "AppID required." );
		}

		if ( empty ( $this->appScope ) )
		{
			throw new LoginException ( "AppScope required." );
		}

		return "https://api.instagram.com/oauth/authorize/?client_id=" . $this->appId . "&redirect_uri" . $this->appCallback . "&response_type=code" . "&scope=" . $this->appScope;
	}

	/**
	 * Get Instagram Authorization
	 *
	 * param string $code
	 */
	public function doAuth ( string $code ) : array
	{
		if ( empty ( $code ) )
		{
			throw new LoginException ( "Code required." );
		}

		$uri = "https://api.instagram.com/oauth/access_token";

		$this->builder->addResource ( "client_id", $this->appId );
		$this->builder->addResource ( "client_secret", $this->appSecret );
		$this->builder->addResource ( "grant_type", "authorization_code" );
		$this->builder->addResource ( "redirect_uri", $this->appCallback );
		$this->builder->addResource ( "code", $code );

		$request = $this->requestFactory->createRequest ( "POST", $uri, [
			"Content-Type" => 'multipart/form-data; boundary="' . $this->builder->getBoundary () . '"'
		], ( string ) $this->builder->build () );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new LoginException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}
}