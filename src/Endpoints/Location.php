<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

use GuzzleHttp\Psr7\Uri;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Auth\TokenAccessorTrait;
use Ch0c01dxyz\InstaToken\Builder\Location;
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
	 * New instance of Location class
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
		$this->token = $token ?: new AccessToken;
	}

	/**
	 * Get Information about Location
	 *
	 * @return array
	 */
	public function infoLocation(LocationId $locationId): array
	{
		$endpoint = (new Comment)
			->withLocations()
			->withLocationId((string)$locationId);
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest ($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new LocationException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get list of Media object from given Location
	 *
	 * @return array
	 */
	public function listMediaLocation(LocationId $locationId): array
	{
		$endpoint = (new Location)
			->withLocations()
			->withLocationId((string)$locationId)
			->withMedia()
			->withRecent();
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new LocationException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Search location by given Geographic coordinate
	 *
	 * @return array
	 */
	public function searchLocation(Map $map): array
	{
		$endpoint = (new Location)
			->withLocations()
			->withSearch();
		$query = sprintf(
			"lat=%s&lng=%s&distance=%s&access_token=%s",
			$map->getLatitude(),
			$map->getLongitude(),
			$map->getDistance(),
			$this->getAccessToken()
		);
		$uri = (new Uri((string)$endpoint))
			->withQuery($query);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new LocationException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}
}