<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Auth\TokenAccessorTrait;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Tag;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Objects\TagName;
use Ch0c01dxyz\InstaToken\Interfaces\TagInterface;
use Ch0c01dxyz\InstaToken\Exceptions\TagException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class Tag implements TagInterface
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
	 * New instance of Tag class
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
	 * Get recent Tag Media
	 *
	 * @param string $tagName
	 * @return array
	 */
	public function listTag(TagName $tagName): array
	{
		$endpoint = (new Tag)
			->withTags()
			->withTagName((string)$tagName);
		$token = \Ch0c01dxyz\InstaToken\buildURLQuery(['access_token' => $this->getAccessToken()]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new TagException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get Information about Tag object
	 *
	 * @param string $tagName
	 * @return array
	 */
	public function infoTag(TagName $tagName): array
	{
		$endpoint = (new Tag)
			->withTags()
			->withTagName((string)$tagName)
			->withMedia()
			->withRecent();
		$token = \Ch0c01dxyz\InstaToken\buildURLQuery(['access_token' => $this->getAccessToken()]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new TagException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Search tag by Name
	 *
	 * @param string $tagName
	 * @return array
	 */
	public function searchTag(TagName $tagName): array
	{
		$endpoint = (new Tag)
			->withTags()
			->withSearch();
		$query = \Ch0c01dxyz\InstaToken\buildURLQuery([
			'q' => (string)$tagName,
			'access_token' => $this->getAccessToken()
		]);
		$uri = (new Uri((string)$endpoint))
			->withQuery($query);
		$request = $this->requestFactory->createRequest("GET", (string)$uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new TagException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}
}