<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

use GuzzleHttp\Psr7\Uri;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Media;
use Ch0c01dxyz\InstaToken\Auth\TokenAccessorTrait;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\MediaId;
use Ch0c01dxyz\InstaToken\Objects\ShortCode;
use Ch0c01dxyz\InstaToken\Objects\Map;
use Ch0c01dxyz\InstaToken\Interfaces\MediaInterface;
use Ch0c01dxyz\InstaToken\Exceptions\MediaException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Media implements MediaInterface
{
	use TokenAccessorTrait, EndpointTrait;

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
	public function __construct(
		HttpClient $httpClient = null,
		RequestFactory $requestFactory = null,
		AccessToken $token = null
	) {
		$this->httpClient = $httpClient ?: HttpClientDiscovery::find();
		$this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
		$this->token = $token ?: new AccessToken();
	}

	/**
	 * Get Information from given Media Id
	 *
	 * @return array
	 */
	public function readMedia(MediaId $mediaId): array
	{
		$endpoint = (new Media)
			->withMedia()
			->withMediaId((string)$mediaId);
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new MediaException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get Information from given Shortcoded Media
	 *
	 * @return array
	 */
	public function infoMedia(ShortCode $shortCode): array
	{
		$endpoint = (new Media)
			->withMedia()
			->withShortcode((string)$shortCode);
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new MediaException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Search recent Media from given Area
	 *
	 * @return array
	 */
	public function searchMedia(Map $map): array
	{
		$endpoint = (new Media)
			->withMedia()
			->withSearch();
		$query = \Ch0c01dxyz\InstaToken\buildURLQuery([
			'lat' => $map->getLatitude(),
			'lng' => $map->getLongitude(),
			'distance' => $map->getDistance(),
			'access_token' => $this->getAccessToken()
		]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($query);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new MediaException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}
}