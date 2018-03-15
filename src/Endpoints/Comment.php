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
use Ch0c01dxyz\InstaToken\Objects\CommentId;
use Ch0c01dxyz\InstaToken\Interfaces\CommentInterface;
use Ch0c01dxyz\InstaToken\Exceptions\CommentException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Comment implements CommentInterface
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
	 * New instance of Comment class
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
	 * Get List recent comments on defined Media
	 *
	 * @return array
	 */
	public function listComment ( MediaId $mediaId ) : array
	{
		if ( false == ( $mediaId instanceof MediaId ) )
		{
			throw new CommentException ( "Current param isn't instance of MediaId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/%s/comments?access_token=%s", ( int ) $mediaId, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "GET", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new InstagramException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Send comment to Media
	 *
	 * @return array
	 */
	public function sendComment ( MediaId $mediaId, string $comment ) : array
	{
		if ( false == ( $mediaId instanceof MediaId ) )
		{
			throw new CommentException ( "Current param isn't instance of MediaId." );
		}

		if ( empty ( $comment ) )
		{
			throw new CommentException ( "Comment required." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/%s/comments?access_token=", $mediaId, $this->accessToken );

		$this->builder->addResource ( "text", $comment );

		$request = $this->requestFactory->createRequest ( "POST", $uri, [
			"Content-Type" => 'multipart/form-data; boundary="' . $this->builder->getBoundary () . '"'
		], ( string ) $this->builder->build () );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new CommentException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}

	/**
	 * Delete comment on Media
	 *
	 * @return array
	 */
	public function deleteComment ( MediaId $mediaId, CommentId $commentId ) : array
	{
		if ( false == ( $mediaId instanceof MediaId ) )
		{
			throw new CommentException ( "Current param isn't instance of MediaId." );
		}

		if ( false == ( $commentId instanceof CommentId ) )
		{
			throw new CommentException ( "Current param isn't instance of MediaId." );
		}

		$uri = sprintf ( "https://api.instagram.com/v1/media/%s/comments/%s?access_token=", $mediaId, $commentId, $this->accessToken );

		$request = $this->requestFactory->createRequest ( "DELETE", $uri );

		$response = $this->httpClient->sendRequest ( $request );

		if ( $response->getStatusCode () === 400 )
		{
			$body = json_decode ( ( string ) $response->getBody () );

			throw new CommentException ( $body->meta->error_message );
		}

		return json_decode ( ( string ) $response->getBody ()->getContents (), true );
	}
}