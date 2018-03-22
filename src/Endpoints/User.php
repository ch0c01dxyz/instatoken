<?php

declare(strict_types = 1);

namespace Ch0c01dxyz\InstaToken\Endpoints;

use GuzzleHttp\Psr7\Uri;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Ch0c01dxyz\InstaToken\Auth\TokenAccessorTrait;
use Ch0c01dxyz\InstaToken\Builder\Endpoint\Users;
use Ch0c01dxyz\InstaToken\Objects\Name;
use Ch0c01dxyz\InstaToken\Objects\UserId;
use Ch0c01dxyz\InstaToken\Objects\AccessToken;
use Ch0c01dxyz\InstaToken\Interfaces\UserInterface;
use Ch0c01dxyz\InstaToken\Exceptions\UserException;

/**
 * @author Egar Rizki <ch0c01d.xyz@gmail.com>
 */
class User implements UserInterface
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
	 * New instance of User class
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
	 * Get User Information from Access Token
	 *
	 * @return array
	 */
	public function getSelf(): array
	{
		$endpoint = (new Users)
			->withUsers()
			->withSelf();
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", (string)$uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new UserException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get User Information from UserId
	 *
	 * @return array
	 */
	public function getInfo(UserId $id): array
	{
		$endpoint = (new Users)
			->withUsers()
			->withUserId((string)$id);
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", (string)$uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new UserException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get User Media
	 *
	 * @return array
	 */
	public function getMedia() : array
	{
		$endpoint = (new Users)
			->withUsers()
			->withSelf()
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

			throw new UserException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get Media liked by User
	 *
	 * @return array
	 */
	public function getLiked(): array
	{
		$endpoint = (new Users)
			->withUsers()
			->withSelf()
			->withMedia()
			->withLiked();
		$token = sprintf("access_token=%s", $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($token);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new UserException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Search user by Name in Application
	 *
	 * @param object Name $name
	 * @return array
	 */
	public function searchUser(Name $name): array
	{
		$endpoint = (new Users)
			->withUsers()
			->withSearch();
		$query = sprintf("q=%s&access_token=%s", (string)$name, $this->getAccessToken());
		$uri = (new Uri((string)$endpoint))
			->withQuery($query);
		$request = $this->requestFactory->createRequest("GET", $uri);
		$response = $this->httpClient->sendRequest($request);

		if ($response->getStatusCode() === 400) {
			$body = $this->restoreFromJson(
				(string)$response->getBody()
			);

			throw new UserException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}

	/**
	 * Get recent media from given User
	 *
	 * @return array
	 */
	public function readUserMedia(UserId $id): array
	{
		$endpoint = (new Users)
			->withUsers()
			->withUserId((string)$id)
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

			throw new UserException(
				sprintf("%s", $body->meta->error_message)
			);
		}

		return $this->restoreFromJson(
			(string)$response->getBody(),
			true
		);
	}
}
