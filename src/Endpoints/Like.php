<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

use GuzzleHttp\Psr7\Uri;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Like;
use Ch0c01dxyz\InstaToken\Auth\TokenAccessorTrait;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Interfaces\LikeInterface;
use Ch0c01dxyz\InstaToken\Exceptions\LikeException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Like implements LikeInterface
{
	use EndpointTrait, TokenAccessorTrait;

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
	public function __construct(
		HttpClient $httpClient = null,
		RequestFactory $requestFactory = null,
		AccessToken $token = null
	) {
		$this->httpClient = $httpClient ?: HttpClientDiscovery::find();
		$this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
		$this->token = $token ?: new AccessToken();
		$this->builder = new MultipartStreamBuilder();
	}

	/**
	 * Get list User who have likes defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function listLike(MediaId $mediaId): array
	{
		$endpoint = (new Like)
			->withMedia()
			->withMediaId((string)$mediaId)
			->withLikes();
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new LikeException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Send like to defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function sendLike(MediaId $mediaId): array
	{
		$endpoint = (new Like)
			->withMedia()
			->withMediaId((string)$mediaId)
			->withLikes();
		$uri = new Uri((string)$endpoint);

		$this->builder->addResource("access_token", $this->getAccessToken());

		$request = $this->requestFactory->createRequest(
			"POST",
			$uri,
			[
				"Content-Type" => sprintf(
					'multipart/form-data; boundary="%s"',
					$this->builder->getBoundary()
				)
			],
			(string)$this->builder->build()
		);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new LikeException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Remove like from defined Media
	 *
	 * @param object MediaId $mediaId
	 * @return array
	 */
	public function deleteLike(MediaId $mediaId): array
	{
		$endpoint = (new Like)
			->withMedia()
			->withMediaId((string)$mediaId)
			->withLikes();
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("DELETE", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new LikeException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}
}